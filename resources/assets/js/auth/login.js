require('../bootstrap')

// use global event bus
window.EventBus = new Vue()

Vue.component('navbar-right', require('../components/navbars/NavbarRight.vue')) // in component
Vue.component('navbar-left', require('../components/navbars/NavbarLeft.vue')) // in component
Vue.component('modal-dialog', require('../components/modals/Dialog.vue')) // app
Vue.component('login-page', require('../components/auth/LoginPage.vue')) // this page
Vue.component('alert-box', require('../components/alerts/AlertBox.vue')) // app
Vue.component('navbar', require('../components/navbars/Navbar.vue')) // in component
Vue.component('button-app', require('../components/ButtonApp.vue')) // in component
Vue.component('alert', require('../components/Alert.vue')) // in component


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
            if ( true || (timeDiff) > (window.SESSION_LIFETIME) ) {
                axios.get('/is-session-active')
                     .then((response) => {
                        if ( !response.data.active ) {
                            this.showDialog('419')
                        }
                     })
            }
        })

        $('#page-loader').remove()
    },

    methods: {
        showDialog(code) {
            switch (code) {
                case '419':
                    EventBus.$emit('toggle-modal-dialog',
                                   'Your are now logged off, Please reload this page or loss your data.',
                                   'Attention please !!',
                                   'Got it',
                                   'show')
                    break
                case '500':
                    EventBus.$emit('toggle-modal-dialog',
                                   'Server error, Please try again later or get the Helpdesk.',
                                   'Attention please !!',
                                   'Got it',
                                   'show')
                    break
                defualt :
                    break
            }
        }
    }
})
