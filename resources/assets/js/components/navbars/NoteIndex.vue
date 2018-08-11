<template>
    <navbar :brand="brand"><!-- Main Navbar -->
        <ul
            class="nav navbar-nav"
            slot="navbar-left">
            <an-form
                placeholder="AN to create note"
                :pattern="anPattern"
                :disabled="disabled"
                :tooltip="tooltip"
                v-model="an"
                @validated="validAn" />
            <transition name="slide-fade">
                <creatable-notes
                    v-if="showCreatableNotes"
                    @noteSelected="showConfirmation"
                    @error="handleError" />
            </transition>
        </ul><!-- Navbar Left Actions -->

        <navbar-right slot="navbar-right" /><!-- Navbar Right Actions -->
    </navbar>
</template>

<script>
    import CreatableNotes from './components/CreatableNotes.vue'
    import NavbarRight from './AuthenticatedNavbarRight.vue'
    import AnForm from './components/TextInputForm.vue'
    import Navbar from './Navbar.vue'

    export default {
        components: {
            CreatableNotes,
            NavbarRight,
            AnForm,
            Navbar
        },
        props: {
            brand: { reqiured: true }
        },
        data () {
            return {
                an: '', // v-model

                disabled: false,
                tooltip: '',
                showCreatableNotes: false,

                value: '',

                anPattern: store.anPattern
            }
        },
        methods: {
            validAn (valid) {
                if (valid) {
                    this.disabled = true
                    axios.post('/get-admission/' + this.an)
                         .then((response) => {
                            if ( response.data.reply_code != 0 ) {
                                this.tooltip = response.data.reply_text

                            } else {
                                this.showCreatableNotes = true
                                this.tooltip = ''
                                store.admission = response.data
                            }
                            this.disabled = false
                         })
                         .catch((error) => {
                            this.$emit('error', error)
                         })
                } else {
                    this.showCreatableNotes = false
                }
            },
            handleError(error) {
                this.$emit('error', error)
            },
            showConfirmation(note) {
                if ( note.creatable ) {
                    let body  = '<div class="row"><div class="col-xs-4 text-right">Create : </div>'
                        body += '<div class="col-xs-8 text-left"><b>' + note.label + '</b></div></div>'
                        body += '<div class="row"><div class="col-xs-4 text-right">Hn : </div>'
                        body += '<div class="col-xs-8 text-left"><b>' + store.admission.hn + '</b></div></div>'
                        body += '<div class="row"><div class="col-xs-4 text-right">Name : </div>'
                        body += '<div class="col-xs-8 text-left"><b>' + store.admission.patient_name + '</b></div></div>'
                        body += '<div class="row"><div class="col-xs-4 text-right">Gender : </div>'
                        body += '<div class="col-xs-8 text-left"><b>' + (store.admission.gender == 1 ? 'Male':'Female') + '</b></div></div>'
                        body += '<div class="row"><div class="col-xs-4 text-right">Attending : </div>'
                        body += '<div class="col-xs-8 text-left"><b>' + store.admission.attending_name + '</b></div></div>'
                        body += '<div class="row"><div class="col-xs-4 text-right">Datetime Admit : </div>'
                        body += '<div class="col-xs-8 text-left"><b>' + store.admission.datetime_admit + '</b></div></div>'
                        body += '<div class="row"><div class="col-xs-4 text-right">Datetime Discharge : </div>'
                        body += '<div class="col-xs-8 text-left"><b>' + store.admission.datetime_discharge + '</b></div></div>'
                    store.noteSelected = note
                    this.$emit('showConfirmation', body)
                }
            }
        }
    }
</script>

<style>
    /* Enter and leave animations can use different */
    /* durations and timing functions.              */
    .slide-fade-enter-active {
      /*transition: all .3s ease;*/
      transition: all .8s ease;
    }
    .slide-fade-leave-active {
      /*transition: all .8s cubic-bezier(1.0, 0.5, 0.8, 1.0);*/
      transition: all .3s cubic-bezier(1.0, 0.5, 0.8, 1.0);
    }
    .slide-fade-enter, .slide-fade-leave-to
    /* .slide-fade-leave-active below version 2.1.8 */ {
      transform: translateX(10px);
      opacity: 0;
    }
</style>
