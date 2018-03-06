<template>
    <transition name="slide-fade">
        <li v-if="true"><a href=""><span class="fa fa-circle-o-notch fa-spin"></span></a></li>
        <li class="dropdown hvr-bounce-to-bottom" v-if="false">
            <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" disabled><u>{{ patientName }}</u> | Create <span class="fa fa-file-text"></span></a>
            <ul class="dropdown-menu">
                <li v-for="note in notes">
                    <a  :title="note.title" data-toggle="tooltip" :class="getClass(note.title)"  
                    :style="note.style" @click="action(note.base, note.as)" v-html="note.label"></a>
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
        data () {
            return {
                notes: axios.get('/get-creatable-notes/' + this.an)
                            .then( (response) => {
                                this.notes = response.data
                            }).catch( (error) => {
                                console.log(error)
                            }),

                patientName: axios.get('/admit/' + this.an)
                                  .then( (response) => {
                                      this.patientName = 'HN ' + response.data.hn + ' ' + response.data.patient_name
                                  }).catch( (error) => {
                                      console.log(error)
                                  }),
            }   
        },
        methods: {
            action (base, as) {
                if (base != 0) {
                    alert("create " + base + " as " + as)
                }
            },
            getClass (title) {
                return (title == '') ? 'hvr-underline-from-left' : 'creatable-note-title'
            }
        },
        updated () {
            $('.creatable-note-title').tooltip({
                container: "body",
                placement: "bottom",
                trigger: "hover",
                delay: { "show": 100, "hide": 500 }
            });
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
