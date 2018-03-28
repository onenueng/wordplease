require('../bootstrap')

// use global event bus
window.EventBus = new Vue()

Vue.component('note', require('../components/notes/medicine/forms/Admission.vue'))
Vue.component('page-navbar', require('../components/navbars/EditNote.vue'))
Vue.component('modal-dialog', require('../components/modals/Dialog.vue'))
Vue.component('button-app', require('../components/ButtonApp.vue'))

window.app = new Vue({
    el: '#app',
    data: {
        autosaveIcon: 'hide',

        dialogHeading: '',
        dialogMessage: '',
        dialogButtonLabel: '',

        lastActiveSessionCheck: 0
    },
    created () {

        /* *** Handle session timeout *** */
        this.lastActiveSessionCheck = Date.now()
        $(window).on("focus", (e) => {
            let timeDiff = Date.now() - this.lastActiveSessionCheck
            if ( (timeDiff) > (window.SESSION_LIFETIME) ) {
                axios.get('/is-session-active')
                     .then((response) => {
                        if ( !response.data.active ) {
                            this.dialogHeading = 'Attention please !!'
                            this.dialogMessage = 'Your are now logged off, Please reload this page or loss your data.'
                            this.dialogButtonLabel = 'Got it'
                            EventBus.$emit('toggle-modal-dialog', 'show')
                        }
                     })
            }
        })

        /* *** *** */
        EventBus.$on('autosave', (field, value) => {
            this.autosaveIcon = 'show'
            // axios.post('/note/autosave', { field: field, value: value })
            axios.post('/note/' + window.location.pathname.split("/")[2] + '/autosave', { field: field, value: value })
                 .then((response) => {
                    console.log(response.data)

                    // remove timeout later
                    // setTimeout(() => { this.autosaveIcon = 'hide' }, 1000)
                    this.autosaveIcon = 'hide'
                 })
                 .catch((error) => {
                    this.autosaveIcon = 'hide'
                    if (error.response) {
                        // The request was made and the server responded with a status code
                        // that falls out of the range of 2xx
                        console.log(error.response.data)
                        console.log(error.response.status)
                        console.log(error.response.headers)
                        if (error.response.status == 419) {
                            this.dialogHeading = 'Attention please !!'
                            this.dialogMessage = 'Your are now logged off, Please reload this page or loss your data.'
                            this.dialogButtonLabel = 'Got it'
                            EventBus.$emit('toggle-modal-dialog', 'show')
                        }
                    } else if (error.request) {
                        // The request was made but no response was received
                        // `error.request` is an instance of XMLHttpRequest in the browser and an instance of
                        // http.ClientRequest in node.js
                        console.log(error.request)
                    } else {
                        // Something happened in setting up the request that triggered an Error
                        console.log('Error', error.message)
                    }
                    console.log(error.config)
                 })
        })

        $('#page-loader').remove()
    }
})
