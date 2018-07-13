require('../bootstrap-min')

import InputTextarea from "../draft/InputTextarea.vue"
import InputDatetime from "../draft/InputDatetime.vue"
import DrawingCanvas from "../draft/DrawingCanvas.vue"

window.app = new Vue({
    el: '#app',
    components: {
        InputTextarea,
        InputDatetime,
        DrawingCanvas
    }
})
