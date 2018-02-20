require('../bootstrap')

// use global event bus
window.EventBus = new Vue()

Vue.component('login-page', require('../components/auth/LoginPage.vue'))
Vue.component('modal-dialog', require('../components/ModalDialog.vue'))
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
        EventBus.$on('error-419', () => {
            this.dialogHeading = 'Attention please !!'
            this.dialogMessage = 'Session timeout, Please reload this page to continue using.'
            this.dialogButtonLabel = 'Got it'
            $('#modal-dialog').modal('show')
        })

        this.lastActiveSessionCheck = Date.now()
        $(window).on("focus", (e) => {
            let timeDiff = Date.now() - this.lastActiveSessionCheck
            if ((timeDiff) > (1000 * 60 * 60)) {
                axios.get('/is-session-active')
                     .then((response) => {
                        if (response.data.active) {
                            this.lastActiveSessionCheck = Date.now()
                        } else {
                            EventBus.$emit('error-419')
                        }
                     })
            }
        })

        $('#page-loader').remove()
    }
})
