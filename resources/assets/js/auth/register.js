require('../bootstrap')

window.EventBus = new Vue() // use global event bus

Vue.component('register-page', require('../components/auth/RegisterPage.vue'))
Vue.component('modal-dialog', require('../components/modals/Dialog.vue'))
Vue.component('alert-box', require('../components/alerts/AlertBox.vue'))

window.app = new Vue({
    el: '#app',
    data: {
        lastActiveSessionCheck: 0
    },
    mounted() {
        /* *** Handle session timeout *** */
        this.lastActiveSessionCheck = Date.now()
        $(window).on("focus", (e) => {
            let timeDiff = Date.now() - this.lastActiveSessionCheck
            if ( (timeDiff) > (window.SESSION_LIFETIME) ) {
                axios.get('/is-session-active')
                    .then((response) => {
                        if (!response.data.active) {
                            EventBus.$emit('show-common-dialog', 'error-419')
                        }
                    })
            }
        })

        $('#page-loader').remove()
    }
})
