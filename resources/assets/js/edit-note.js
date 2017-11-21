require('./bootstrap');

// in case of need to use global event bus
window.EventBus = new Vue();


Vue.component('alert-box', require('./components/Alertbox.vue'));
Vue.component('button-app', require('./components/ButtonApp.vue'));
Vue.component('modal-dialog', require('./components/ModalDialog.vue'));
Vue.component('navbar', require('./components/EditNoteNavbar.vue'));
Vue.component('appbar-right', require('./components/AppbarRight.vue'));
Vue.component('panel', require('./components/Panel.vue'));
Vue.component('input-text', require('./components/InputText.vue'));
Vue.component('input-suggestion', require('./components/InputSuggestion.vue'));
Vue.component('input-select', require('./components/InputSelect.vue'));
Vue.component('input-textarea', require('./components/InputTextarea.vue'));
Vue.component('input-radio', require('./components/InputRadio.vue'));
Vue.component('input-check', require('./components/InputCheck.vue'));
Vue.component('input-check-group', require('./components/InputCheckGroup.vue'));

Vue.component('modal-document', require('./components/ModalDocument.vue'));


window.app = new Vue({
    el: '#app',
    data: {
        showAlertbox: false,
        alertboxMessage: "Hello World",
        alertStatus: "warning",
        alertDuration: 5000,
        autosaving: false,

        dialogHeading: 'Wordplease Say',
        dialogMessage: 'Hello world!!',
        dialogButtonLabel: 'OK',

        lastActiveSessionCheck: 0
    },
    mounted() {
        /**
         * Note specific events.
         */
        EventBus.$on('show-child-pugh-score', () => {
            $('#modal-child-pugh-score').modal('show');
        });

        EventBus.$on('comorbid-no-data-all', () => {
            $("input[type=radio][name^=comorbid_]").each((index, el) => {
                EventBus.$emit(el.name, 255)
            })
        })

        EventBus.$on('comorbid-no-at-all', () => {
            $("input[type=radio][name^=comorbid_]").each((index, el) => {
                EventBus.$emit(el.name, 0)
            })
        })

        /**
         * Common events.
         */

        EventBus.$on('show-alert', (message, status, duration = 5000) => {
            if (! this.showAlertbox) {
                this.alertboxMessage = message
                this.alertStatus = status;
                this.alertDuration = duration;
                this.showAlertbox = true;
            }
        })

        EventBus.$on('close-alert', () => {
            this.showAlertbox = false
        })

        EventBus.$on('error-419', () => {
            this.dialogHeading = 'Attention please !!'
            this.dialogMessage = 'Your are now logged off, Please reload this page or loss your data.'
            this.dialogButtonLabel = 'Got it'
            $('#modal-dialog').modal('show')
        });

        EventBus.$on('autosave', (field, value, ref) => {
            if (ref === undefined) {
                
            }
            axios.post('/autosave', JSON.parse('{"' + field + '": ' + JSON.stringify(value) + '}'))
                 .then((response) => {
                    console.log(response.data);
                    this.autosaving = false;
                 })
                 .catch((error) => {
                    this.autosaving = false;
                    if (error.response) {
                        // The request was made and the server responded with a status code
                        // that falls out of the range of 2xx
                        console.log(error.response.data);
                        console.log(error.response.status);
                        console.log(error.response.headers);
                        if (error.response.status == 419) {
                            EventBus.$emit('error-419');
                        }
                    } else if (error.request) {
                        // The request was made but no response was received
                        // `error.request` is an instance of XMLHttpRequest in the browser and an instance of
                        // http.ClientRequest in node.js
                        console.log(error.request);
                    } else {
                        // Something happened in setting up the request that triggered an Error
                        console.log('Error', error.message);
                    }
                    console.log(error.config);
                 })
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
    },
    methods: {
        nodataAll() {
            
        },
        noComorbidAll() {
            $("input[type=radio][name^=comorbid_]").each((index, el) => {
                EventBus.$emit(el.name, 0)
            })
        }
    }
});
