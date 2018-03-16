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
                    let body  = 'Create : <b>' + note.title + '</b><br/>'
                        body += 'Hn : <b>' + this.admission.hn + '</b><br/>'
                        body += 'Name : <b>' + this.admission.patient_name + '</b><br/>'
                        body += 'Gender : <b>' + (this.admission.gender == 1 ? 'Male':'Female') + '</b><br/>'

                    let data = {
                        body: body,
                        an: this.admission.an
                    }
// an:"57305678"
// attending_name:"ผศ.นพ. ปัญญา ลักษณะพฤกษา"
// datetime_admit:"2017-08-31 13:20:00"
// datetime_dc:"2017-09-20 13:00:00"
// discharge_status:"2"
// discharge_status_name:"IMPROVED"
// discharge_type:"1"
// discharge_type_name:"WITH APPROVAL"
// dob:"1971-11-27"
// gender:1
// hn:"53701921"
// patient_dept:""
// patient_dept_name:""
// patient_name:"นาย หน่อย จันทร์รอด"
// patient_sub_dept:""
// patient_sub_dept_name:""
// reply_code:"0"
// reply_text:"success."
// ward_name:"เฉลิมพระเกียรติ์ 10 ใต้"
// ward_name_short:"ฉก.10 ใต้"

                    EventBus.$emit('show-create-note-confirmation', data)
                }
            },
            getClass(creatable) {
                return creatable ? 'hvr-underline-from-left creatable-tooltip' : 'creatable-tooltip disabled'
            },
            getCursorStyle(creatable) {
                return creatable ?
                       'cursor: pointer;' :
                       'text-decoration: line-through; cursor: not-allowed!important;'
            }
        },
        updated() {
            $('.creatable-tooltip').tooltip({
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
