require('../bootstrap')

// use global event bus
window.EventBus = new Vue()

Vue.component('navbar-right', require('../components/navbars/NavbarRight.vue'))
Vue.component('navbar-left', require('../components/navbars/NavbarLeft.vue'))
Vue.component('login-page', require('../components/auth/LoginPage.vue'))
Vue.component('modal-dialog', require('../components/modals/Dialog.vue'))
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
        this.lastActiveSessionCheck = Date.now()
        $(window).on("focus", (e) => {
            let timeDiff = Date.now() - this.lastActiveSessionCheck
            if ( (timeDiff) > (window.SESSION_LIFETIME) ) {
                axios.get('/is-session-active')
                     .then((response) => {
                        if ( !response.data.active ) {
                            this.dialogHeading = 'Attention please !!'
                            this.dialogMessage = 'Session timeout, Please reload this page to continue using.'
                            this.dialogButtonLabel = 'Got it'
                            EventBus.$emit('toggle-modal-dialog', 'show')
                        }
                     })
            }
        })

        $('#page-loader').remove()
    }
})
