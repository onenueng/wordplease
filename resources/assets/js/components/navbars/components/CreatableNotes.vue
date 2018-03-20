<template>
    <transition name="slide-fade">
        <li class="dropdown hvr-bounce-to-bottom" v-if="typeof this.patientName == 'string'">
            <a class="dropdown-toggle bigger-font-25" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" disabled>
                <u>{{ patientName }}</u>
                <span v-if="showCreatableNotes"> | Create <i class="fa fa-file-text"></i></span>
            </a>
            <ul class="dropdown-menu" v-if="showCreatableNotes">
                <li v-for="note in notes" :key="note.label">
                    <a
                        data-toggle="tooltip"
                        :title="note.title"
                        :class="getClass(note.creatable)"
                        :style="getCursorStyle(note.creatable)"
                        @click="createNote(note)"
                        v-html="note.label">
                    </a>
                </li>
            </ul>
        </li>
    </transition>
</template>

<script>
    export default {
        props: {
            an: {
                type: String,
                required: true
            }
        },
        data() {
            return {
                notes: null,
                admission: null,
                patientName: null,
                showCreatableNotes: false
            }
        },
        mounted() {
            axios.post('/get-admission/' + this.an)
                .then( (response) => {
                    if ( response.data.hn == undefined ) {
                        this.patientName = 'an data not found, please try again.'
                        EventBus.$emit('anSearched', false)
                        this.admission = null
                    } else {
                        this.patientName = 'HN ' + response.data.hn + ' ' + response.data.patient_name
                        EventBus.$emit('anSearched', true)
                        this.admission = response.data
                        axios.post('/get-creatable-notes/' + this.an)
                            .then( (response) => {
                                this.notes = response.data
                                this.showCreatableNotes = true
                            }).catch( (error) => {
                                console.log(error)
                                EventBus.$emit('anSearched', false)
                            })
                    }
                }).catch( (error) => {
                    console.log(error)
                    this.admission = null
                })
        },
        methods: {
            createNote(note) {
                if ( note.creatable ) {
                    let body  = '<div class="row"><div class="col-xs-4 text-right">Create : </div>'
                        body += '<div class="col-xs-8 text-left"><b>' + note.label + '</b></div></div>'
                        body += '<div class="row"><div class="col-xs-4 text-right">Hn : </div>'
                        body += '<div class="col-xs-8 text-left"><b>' + this.admission.hn + '</b></div></div>'
                        body += '<div class="row"><div class="col-xs-4 text-right">Name : </div>'
                        body += '<div class="col-xs-8 text-left"><b>' + this.admission.patient_name + '</b></div></div>'
                        body += '<div class="row"><div class="col-xs-4 text-right">Gender : </div>'
                        body += '<div class="col-xs-8 text-left"><b>' + (this.admission.gender == 1 ? 'Male':'Female') + '</b></div></div>'
                        body += '<div class="row"><div class="col-xs-4 text-right">Attending : </div>'
                        body += '<div class="col-xs-8 text-left"><b>' + this.admission.attending_name + '</b></div></div>'
                        body += '<div class="row"><div class="col-xs-4 text-right">Datetime Admit : </div>'
                        body += '<div class="col-xs-8 text-left"><b>' + this.admission.datetime_admit + '</b></div></div>'
                        body += '<div class="row"><div class="col-xs-4 text-right">Datetime Discharge : </div>'
                        body += '<div class="col-xs-8 text-left"><b>' + this.admission.datetime_discharge + '</b></div></div>'

                    let data = {
                        an: this.admission.an,
                        body: body,
                        class: note.class,
                        retitle: note.retitle,
                        noteTypeId: note.noteTypeId,
                    }

                    EventBus.$emit('show-create-note-confirmation', data)
                }
            },
            getClass(creatable) {
                return creatable ? 'hvr-underline-from-left' : 'unable-to-create-title disabled'
            },
            getCursorStyle(creatable) {
                return creatable ?
                       'cursor: pointer;' :
                       'text-decoration: line-through; cursor: not-allowed!important;'
            }
        },
        updated() {
            $('.unable-to-create-title').tooltip({
                container: "body",
                placement: "bottom",
                trigger: "hover",
                delay: { "show": 100 }
            })
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
