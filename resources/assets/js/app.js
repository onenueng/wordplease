require('./bootstrap')

import pageTextWatermark from "./modules/page-text-watermark.js"
import formHelper from "./modules/form-helper.js"
// import InputRichText from "./draft/InputRichText.vue"

Vue.component("input-rich-text", require("./draft/InputRichText.vue"))

window.app = new Vue({
    el: '#app',
    mounted () {
        formHelper.loaded()
        pageTextWatermark.watermark('nalinee@2216')
    }
})
