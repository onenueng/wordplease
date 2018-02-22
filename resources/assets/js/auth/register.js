require('../bootstrap')

// use global event bus
window.EventBus = new Vue()

Vue.component('register-by-email', require('../components/auth/RegisterByEmail.vue'))
Vue.component('register-by-id', require('../components/auth/RegisterById.vue'))
Vue.component('register-page', require('../components/auth/RegisterPage.vue'))
Vue.component('input-state', require('../components/inputs/InputState.vue'))
Vue.component('modal-dialog', require('../components/ModalDialog.vue'))
Vue.component('navbar', require('../components/navbars/Navbar.vue'))
Vue.component('button-app', require('../components/ButtonApp.vue'))
Vue.component('alert', require('../components/Alert.vue'))

window.app = new Vue({
    el: '#app',
    data: {
        dialogHeading: '',
        dialogMessage: '',
        dialogButtonLabel: '',

        lastActiveSessionCheck: 0
    },
    mounted() {
        /* *** Handle session timeout *** */
        EventBus.$on('error-419', () => {
            this.dialogHeading = 'Attention please !!'
            this.dialogMessage = 'Session timeout, Please reload this page to continue using.'
            this.dialogButtonLabel = 'Got it'
            $('#modal-dialog').modal('show')
        })
        this.lastActiveSessionCheck = Date.now()
        $(window).on("focus", (e) => {
            let timeDiff = Date.now() - this.lastActiveSessionCheck
            if ((timeDiff) > (window.SESSION_LIFETIME)) {
                axios.get('/is-session-active')
                    .then((response) => {
                        if (!response.data.active) {
                            EventBus.$emit('error-419')
                        }
                    })
            }
        })

        $('#page-loader').remove()
    }
})
