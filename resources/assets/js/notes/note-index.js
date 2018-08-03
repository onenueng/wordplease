require('../bootstrap')

import app from "../components/notes/Index.vue"

window.app = new Vue({
    el: '#app',
    components: {
        app
    }
})