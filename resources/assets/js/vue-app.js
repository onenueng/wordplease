require('./bootstrap')

import pageTextWatermark from "./modules/page-text-watermark.js"
import formHelper from "./modules/form-helper.js"

Vue.component("input-rich-text", require("./draft/InputRichText.vue"))
Vue.component("toggle", require("./draft/Toggle.vue"))

window.app = new Vue({
    el: '#app',
    data: {
        gender: false
    },
    mounted() {
        formHelper.loaded()
        pageTextWatermark.watermark('nalinee@' + Date.now())
    }
})
