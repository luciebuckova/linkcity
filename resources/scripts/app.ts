import {createApp} from "petite-vue";

import.meta.glob([ '@images/**' ])
import "@styles/app.sass"

interface Header {
    opened: boolean
    handleOpenedHeader(state: boolean): void
}

const headerEl = document.querySelector('[data-header]'),
    headerScope: Header = {
        opened: false,
        handleOpenedHeader(state) {
            document.body.classList.toggle("u-hiddenOverflow", state)
        }
    }

headerEl && createApp(headerScope).mount(headerEl)