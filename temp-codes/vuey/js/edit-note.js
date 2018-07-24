require('./bootstrap')

// in case of need to use global event bus
window.EventBus = new Vue()

Vue.component('alert-box', require('./components/Alertbox.vue'))
Vue.component('button-app', require('./components/ButtonApp.vue'))
Vue.component('modal-dialog', require('./components/ModalDialog.vue'))
Vue.component('navbar', require('./components/EditNoteNavbar.vue'))
Vue.component('appbar-right', require('./components/AppbarRight.vue'))
Vue.component('panel', require('./components/Panel.vue'))
Vue.component('input-text', require('./components/InputText.vue'))
Vue.component('input-suggestion', require('./components/InputSuggestion.vue'))
Vue.component('input-select', require('./components/InputSelect.vue'))
Vue.component('input-textarea', require('./components/InputTextarea.vue'))
Vue.component('input-radio', require('./components/InputRadio.vue'))
Vue.component('input-check', require('./components/InputCheck.vue'))
Vue.component('input-check-group', require('./components/InputCheckGroup.vue'))
Vue.component('input-text-addon', require('./components/InputTextAddon.vue'))
Vue.component('loggable', require('./components/inputs/InputLoggable.vue'))
Vue.component('non-operation-list', require('./components/helpers/medicine/NonOperationList.vue'))
Vue.component('investigation-list', require('./components/helpers/medicine/InvestigationList.vue'))
Vue.component('input-rows', require('./components/inputs/InputRows.vue'))
Vue.component('modal-document', require('./components/ModalDocument.vue'))
Vue.component('review-discharge', require('./components/forms/ReviewDischarge.vue'))


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

        lastActiveSessionCheck: 0,

        /**
         * Note specific data.
         */
        height: null,
        weight: null,
        GCS_E: null,
        GCS_V: null,
        GCS_M: null
    },
    mounted() {
        /**
         * Note specific events.
         */
        EventBus.$on('show-child-pugh-score', () => {
            $('#modal-child-pugh-score').modal('show')
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

        EventBus.$on('append-current-medications', () => {
            EventBus.$emit('set-current-medications', $('#current_medications_helper').val(), 'append')
            $('#current_medications_helper').val('')
            $('#current_medications_helper').focus()
        })

        EventBus.$on('put-current-medications', () => {
            EventBus.$emit('set-current-medications', $('#current_medications_helper').val(), 'put')
            $('#current_medications_helper').val('')
            $('#current_medications_helper').focus()
        })

        EventBus.$on('BMI-updates-height', (value) => {
            this.height = value
            this.calculateBMI()
        })

        EventBus.$on('BMI-updates-weight', (value) => {
            this.weight = value
            this.calculateBMI()
        })

        EventBus.$on('breathing-updates', (value) => {
            if (value == 2 || value == 3) {
                EventBus.$emit('set-o2-rate-rear-addon', 'L/min')
            } else if (value == 4) {
                EventBus.$emit('set-o2-rate-rear-addon', 'FiO<sub>2</sub>')
            }
        })

        EventBus.$on('GCS-updates-E', (value) => {
            this.calculateGCS(value, 'E')
        })

        EventBus.$on('GCS-updates-V', (value) => {
            this.calculateGCS(value, 'V')
        })

        EventBus.$on('GCS-updates-M', (value) => {
            this.calculateGCS(value, 'M')
        })

        /**
         * Common events.
         */

        EventBus.$on('show-alert', (message, status, duration = 5000) => {
            if (! this.showAlertbox) {
                this.alertboxMessage = message
                this.alertStatus = status
                this.alertDuration = duration
                this.showAlertbox = true
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
            this.autosaving = true
            axios.post('/autosave', JSON.parse('{"' + field + '": ' + JSON.stringify(value) + '}'))
                 .then((response) => {
                    console.log(response.data)
                    // remove timeout later
                    setTimeout(() => { this.autosaving = false }, 1000)
                 })
                 .catch((error) => {
                    this.autosaving = false;
                    if (error.response) {
                        // The request was made and the server responded with a status code
                        // that falls out of the range of 2xx
                        console.log(error.response.data)
                        console.log(error.response.status)
                        console.log(error.response.headers)
                        if (error.response.status == 419) {
                            EventBus.$emit('error-419');
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
        /**
         * Note specific methods.
         */
        calculateBMI() {
            let BMI
            if ($.isNumeric(this.height) && $.isNumeric(this.weight)) {
                BMI = (this.weight / ((this.height / 100) * (this.height / 100))).toPrecision(4)
            } else {
                BMI = ''
            }
            EventBus.$emit('BMI-updates', BMI)
        },
        calculateGCS(value, factor) {
            let score = value === null ? null : parseInt(((value.split(' ')[0]).replace('[','')).replace(']',''))
            if (factor == 'E') {
                this.GCS_E = score
            } else if (factor == 'V') {
                this.GCS_V = score
            } else {
                this.GCS_M = score
            }

            if ($.isNumeric(this.GCS_E) && $.isNumeric(this.GCS_V) && $.isNumeric(this.GCS_M)) {
                let sum = this.GCS_E + this.GCS_V + this.GCS_M
                let gcs, gcsLabel
                if (sum < 9) {
                    gcs = 3;
                    gcsLabel = 'Severe [GCS < 9]';
                } else if (sum < 13) {
                    gcs = 2;
                    gcsLabel = 'Moderate [9 <= GCS < 13]';
                } else {
                    gcs = 1;
                    gcsLabel = 'Minor [13 <= GCS <= 15]'
                }

                EventBus.$emit('GCS-updated', gcsLabel)
            } else {
                EventBus.$emit('GCS-updated', null)
            }
        }
    }
})

/**
 * Note specific scripts.
 */
// seem like jQuery not support ES6 syntax so, code jQuery in ES5
$(function() {
    $('span.estimated').click( function() {
        $('input[name=' + $(this).attr('data-target') + ']').click();
    });

    $('span.estimated').mouseover( function() {
        $(this).css({'cursor': 'pointer', 'font-style': 'italic'});
    });

    $('span.estimated').mouseout( function() {
        $(this).css({'cursor': '', 'font-style': ''});
    });

    $('input[name^=estimated_]').click( function () {
        EventBus.$emit('autosave', $(this).attr('name'), $(this).prop('checked'));
    });
});
