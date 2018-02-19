require('../bootstrap')

// use global event bus
window.EventBus = new Vue()

Vue.component('register-by-email', require('../components/auth/RegisterByEmail.vue'))
Vue.component('register-by-id', require('../components/auth/RegisterById.vue'))
Vue.component('register-page', require('../components/auth/RegisterPage.vue'))
Vue.component('input-state', require('../components/inputs/InputState.vue'))
Vue.component('modal-dialog', require('../components/ModalDialog.vue'))
Vue.component('button-app', require('../components/ButtonApp.vue'))
Vue.component('alert', require('../components/Alert.vue'))

window.app = new Vue({
    el: '#app',
    data: {
        dialogHeading: 'Wordplease Say',
        dialogMessage: 'Hello world!!',
        dialogButtonLabel: 'OK',

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
