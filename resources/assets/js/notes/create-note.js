require('../bootstrap')

// use global event bus
window.EventBus = new Vue()

Vue.component('data-sheet', require('../components/datasheets/NotesIndex.vue'))
Vue.component('modal-action', require('../components/modals/SingleAction.vue'))
Vue.component('page-navbar', require('../components/navbars/CreateNote.vue'))
Vue.component('modal-dialog', require('../components/modals/Dialog.vue'))
Vue.component('alert-box', require('../components/alerts/AlertBox.vue'))

window.app = new Vue({
    el: '#app',
    data: {
        lastActiveSessionCheck: 0,
        createNoteConfig: null
    },
    mounted() {
        /* *** Handle session timeout *** */
        this.lastActiveSessionCheck = Date.now()
        $(window).on("focus", (e) => {
            let timeDiff = Date.now() - this.lastActiveSessionCheck
            if ( (timeDiff) > (window.SESSION_LIFETIME)) {
                axios.get('/is-session-active')
                     .then((response) => {
                        if ( !response.data.active ) {
                            EventBus.$emit('show-common-dialog', 'error-419')
                        }
                     })
            }
        })

        EventBus.$on('show-create-note-confirmation', (data) => {
            EventBus.$emit('toggle-modal-action', data.body,'Please confirm','Confirm','note-create-conformed')
            this.createNoteConfig = data
        })

        EventBus.$on('note-create-conformed', () => {
            EventBus.$emit('modal-action-processing', true)
            axios.post('/try-create-note', {
                    an: this.createNoteConfig.an,
                    noteTypeId: this.createNoteConfig.noteTypeId,
                    class: this.createNoteConfig.class,
                    retitle: this.createNoteConfig.retitle
                 })
                 .then((response) => {
                    EventBus.$emit('toggle-modal-action')
                    if ( response.data.reply_code == 0 ) {
                        window.location.href = response.data.reply_text
                    } else {
                        EventBus.$emit('toggle-modal-dialog', response.data.reply_text)
                    }
                 })
                 .catch((error) => {
                    console.log(error)
                 })
        })

        $('#page-loader').remove()
    }
})
