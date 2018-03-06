require('../bootstrap')

// use global event bus
window.EventBus = new Vue()

Vue.component('page-navbar', require('../components/navbars/CreateNote.vue'));
Vue.component('modal-dialog', require('../components/ModalDialog.vue'))

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
            if ( (timeDiff) > (window.SESSION_LIFETIME) ) {
                axios.get('/is-session-active')
                     .then((response) => {
                        if ( !response.data.active ) {
                            EventBus.$emit('error-419')
                        }
                     })
            }
        })

        $('#page-loader').remove()
    }
})
