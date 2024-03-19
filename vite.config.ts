import { ConfigEnv, defineConfig, loadEnv, UserConfigExport, type Plugin } from 'vite'
import fs from "fs"
import * as path from 'path'
import outputManifestRawImport, {type OutputManifestParam, type KeyValueDecorator} from "rollup-plugin-output-manifest"

type OutputManifestPlugin = (param?: OutputManifestParam) => Plugin;
const outputManifest = (outputManifestRawImport as any).default as OutputManifestPlugin;

const assets = {
    base: './resources',
    images: './resources/images',
    scripts: './resources/scripts',
    styles: './resources/styles'
}

const outputDir = './public'
const themeDirName = path.basename(__dirname)

const entries: { [key: string]: string } = {}
fs.readdirSync(path.resolve(__dirname, assets.scripts))?.forEach((file) => {
    const isFile = fs.lstatSync(path.resolve(assets.scripts, file)).isFile()
    if (isFile && !file.includes('.d.ts')) {
        const fileBaseName = path.basename(file, path.extname(file))
        entries[fileBaseName] = path.resolve(assets.scripts, file)
    }
})

const formatName = (name: string): string => (name.substring(0, name.lastIndexOf('.')) || name)
    .replace(`${assets.scripts}/`, '')

export default defineConfig(({ mode }: ConfigEnv) => {
    const devServerConfig = loadEnv(mode, process.cwd(), 'HMR')
    const dev = mode === 'development'
    const config: UserConfigExport = {
        appType: 'custom',
        publicDir: false,
        base: dev ? '/' : `/wp-content/themes/${themeDirName}/${outputDir}/`,
        resolve: {
            alias: {
                '@': path.resolve(__dirname, assets.base),
                '@images': path.resolve(__dirname, assets.images),
                '@scripts': path.resolve(__dirname, assets.scripts),
                '@styles': path.resolve(__dirname, assets.styles)
            }
        },
        css: {
            devSourcemap: true
        },
        build: {
            sourcemap: 'inline',
            manifest: false,
            outDir: outputDir,
            assetsDir: '',
            rollupOptions: {
                input: entries,
                output: {
                    //entryFileNames: "[name]-[hash].mjs",
                    //chunkFileNames: "[name]-[hash].mjs",
                    sourcemap: true
                },
                plugins: [
                    outputManifest({
                        fileName: 'manifest.json',
                        generate:
                            (keyValueDecorator: KeyValueDecorator, seed: object, opt: OutputManifestParam) => chunks =>
                                chunks.reduce((manifest, { name, fileName }) => {
                                    return name ? { ...manifest, ...keyValueDecorator(formatName(name), fileName, opt) } : manifest
                                }, seed)
                    }),
                    outputManifest({
                        fileName: 'entrypoints.json',
                        nameWithExt: true,
                        generate: (_: KeyValueDecorator, seed: object) => chunks =>
                            chunks.reduce((manifest, { name, fileName }) => {
                                name = name && formatName(name)

                                const output = {}
                                const js = manifest[name] ? manifest[name].js : []
                                const css = manifest[name] ? manifest[name].css : []
                                const dependencies = manifest[name] ? manifest[name].dependencies : []

                                fileName.match(/.js$/gm) && js.push(fileName)
                                fileName.match(/.css$/gm) && css.push(fileName)

                                name && Object.keys(entries).includes(name)
                                && (output[name] = { js, css, dependencies })

                                return { ...manifest, ...output }
                            }, seed)
                    })
                ]
            }
        }
    }

    if (dev) {
        config.server = {
            host: '0.0.0.0',
            strictPort: true,
            fs: {
                strict: true,
                allow: ['node_modules', assets.base]
            }
        }

        devServerConfig.HMR_HOST && (config.server.host = devServerConfig.HMR_HOST)
        devServerConfig.HMR_PORT && (config.server.port = parseInt(devServerConfig.HMR_PORT))
        devServerConfig.HMR_HTTPS_KEY &&
        devServerConfig.HMR_HTTPS_CERT &&
        (config.server.https = {
            key: devServerConfig.HMR_HTTPS_KEY,
            cert: devServerConfig.HMR_HTTPS_CERT
        })
    }

    return config
})