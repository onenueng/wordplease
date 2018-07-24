require('../bootstrap')

import app from "../components/auth/LoginPage.vue"

window.app = new Vue({
    el: '#app',
    components: {
        app
    }
})
