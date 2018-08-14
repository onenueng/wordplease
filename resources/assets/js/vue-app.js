require('./bootstrap')

import pageTextWatermark from "./modules/page-text-watermark.js"
import formHelper from "./modules/form-helper.js"

//
Vue.component("page-navbar", require("./components/navbars/Navbar.vue"))
Vue.component("navbar-left", require("./components/navbars/NavbarLeft.vue"))
Vue.component("navbar-right", require("./components/navbars/NavbarRight.vue"))
Vue.component("panel", require("./components/containers/Panel.vue"))
Vue.component("input-text", require("./components/inputs/InputText.vue"))
Vue.component("input-text-addon", require("./components/inputs/InputTextAddon.vue"))
Vue.component("input-suggestion", require("./components/inputs/InputSuggestion.vue"))
Vue.component("input-select", require("./components/inputs/InputSelect.vue"))
Vue.component("input-textarea", require("./components/inputs/InputTextarea.vue"))
Vue.component("button-app", require("./components/buttons/ButtonApp.vue"))
Vue.component("input-radio", require("./components/inputs/InputRadio.vue"))
Vue.component("input-check", require("./components/inputs/InputCheck.vue"))
Vue.component("input-check-group", require("./components/inputs/InputCheckGroup.vue"))
//
Vue.component("input-rich-text", require("./draft/InputRichText.vue"))
Vue.component("toggle", require("./draft/Toggle.vue"))

window.app = new Vue({
    el: '#app',
    data: {
        inputText: null,
        inputSuggestion: null,
        inputSelect: null,
        inputTextarea: null,
        inputRadio: null,
        inputCheck: true,
        checkModels: {},
        checks: [
            { label: 'option a', checked: 'op_a' },
            { label: 'option b', checked: 'op_b' }
        ],
        inputCheckGroupA: false,
        inputCheckGroupB: true
    },
    mounted() {
        formHelper.loaded()
    },
    methods: {
        clicked () {alert('hello clicked')}
    }
})
