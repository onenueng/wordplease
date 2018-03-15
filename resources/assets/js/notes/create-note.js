require('../bootstrap')

// use global event bus
window.EventBus = new Vue()

Vue.component('data-sheet', require('../components/datasheets/NotesIndex.vue'))
Vue.component('modal-action', require('../components/modals/SingleAction.vue'))
Vue.component('page-navbar', require('../components/navbars/CreateNote.vue'))
Vue.component('modal-dialog', require('../components/ModalDialog.vue'))
Vue.component('button-app', require('../components/ButtonApp.vue'))

window.app = new Vue({
    el: '#app',
    data: {
        dialogHeading: '',
        dialogMessage: '',
        dialogButtonLabel: '',

        lastActiveSessionCheck: 0,

        actionModalHeading: '',
        actionModalEvent: '',
        actionModalButtonLabel: '',
        actionModalContent: ''
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

        EventBus.$on('show-create-note-confirmation', (data) => {
            this.actionModalHeading = 'Please confirm'
            this.actionModalButtonLabel = 'Confirm'
            this.actionModalContent = data.body
            this.actionModalEvent = 'action-xyz'
            EventBus.$emit('toggle-modal-action', 'show')
        })

        EventBus.$on('action-xyz', () => {
            EventBus.$emit('modal-action-processing', true)
            // create note if success redirect or feedback user
            EventBus.$emit('toggle-modal-action', 'hide')
            EventBus.$emit('modal-action-processing', false)
        })

        $('#page-loader').remove()
    }
})
