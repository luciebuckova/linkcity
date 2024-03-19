<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use function Roots\bundle;

class AssetsServiceProvider extends ServiceProvider
{

    /**
     * Register assets services.
     */
    public function register(): void
    {
        /**
         * Register the theme assets.
         */
        add_action('wp_enqueue_scripts', function (): void {
            bundle('app')->enqueue();

            /**
             * Remove unnecessary WP stuff from important pages
             */
            if (is_front_page()) {
                wp_dequeue_style( 'global-styles' );
                wp_dequeue_style( 'wp-block-library' );
                wp_dequeue_style( 'wp-block-library-theme' );
                wp_dequeue_style( 'classic-theme-styles' );

                remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );
            }
        }, 100);

        /**
         * Register the theme assets with the block editor.
         */
        add_action('enqueue_block_editor_assets', function (): void {
            bundle('editor')->enqueue();
        }, 100);

        /**
         * Add the type="module" attribute to theme bundle script tags
         *
         */
        add_filter('script_loader_tag', function (string $tag, $handle, $src): string {
            $templateName = get_template();
            $isThemeModuleScript = str_contains($src, "$templateName/public/");

            if ((is_user_logged_in() && is_admin()) || ! $isThemeModuleScript) {
                return $tag;
            }

            return str_replace(' src=', ' type=module src=', $tag);
        }, 10, 3);

        /**
         * Remove default theme.json styles.
         *
         * @link   https://developer.wordpress.org/block-editor/reference-guides/filters/global-styles-filters/
         */
        add_action('after_setup_theme', function (): void {
            if (is_admin()) {
                return;
            }

            add_filter('wp_theme_json_data_default', function (\WP_Theme_JSON_Data $theme_json) {
                return new \WP_Theme_JSON_Data([]);
            });
        });
    }
}
