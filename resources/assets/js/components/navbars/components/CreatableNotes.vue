<template>
    <transition name="slide-fade">
        <!-- <li v-if="typeof this.patientName == 'object'"><a href=""><span class="fa fa-circle-o-notch fa-spin"></span></a></li> -->
        <li class="dropdown hvr-bounce-to-bottom" v-if="typeof this.patientName == 'string'">
            <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" disabled>
                <u>{{ patientName }}</u><span v-if="showCreatableNotes"> | Create <i class="fa fa-file-text"></i></span>
            </a>
            <ul class="dropdown-menu" v-if="showCreatableNotes">
                <li v-for="note in notes" :key="note.label">
                    <a
                        data-toggle="tooltip"
                        :title="note.title"
                        :class="getClass(note.creatable)"
                        :style="note.style"
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
                notes: axios.get('/get-creatable-notes/' + this.an)
                            .then( (response) => {
                                this.notes = response.data
                            }).catch( (error) => {
                                console.log(error)
                            }),

                patientName: axios.post('/admit/' + this.an)
                                  .then( (response) => {
                                      if ( response.data.hn == undefined ) {
                                          this.patientName = 'an data not found, please try again.'
                                          EventBus.$emit('anSearched', false)
                                      } else {
                                          this.patientName = 'HN ' + response.data.hn + ' ' + response.data.patient_name
                                          EventBus.$emit('anSearched', true)
                                          this.showCreatableNotes = true
                                      }

                                  }).catch( (error) => {
                                      console.log(error)
                                  }),

                showCreatableNotes: false
            }
        },
        methods: {
            createNote(note) {
                if ( note.creatable ) {
                    EventBus.$emit('create-note-confirmation', 'Please confirm', 'body', 'create-confirmed', 'Create')
                }
            },
            getClass(creatable) {
                return creatable ? 'hvr-underline-from-left creatable-tooltip' : 'unable-to-create creatable-tooltip disabled'
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

    .unable-to-create {
        text-decoration: line-through;
        cursor: not-allowed!important;
    }
</style>
