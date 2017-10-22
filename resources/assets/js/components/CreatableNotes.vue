<template>
    <transition name="slide-fade">
        <li class="dropdown hvr-bounce-to-bottom" title="hello world">
            <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" disabled v-if="isShow">Create <span class="fa fa-file-text"></span></a>
            <ul class="dropdown-menu">
                <li v-for="note in notes" :title="note.label">
                    <a @click="action(note.base, note.as)">{{ note.label }}</a>
                </li>
                <!-- 
                <li><a role="button" class="hvr-underline-from-center" onclick="tryCreateNote(99,99);">Admission note</a></li>
                <li role="separator" class="divider"></li>
                <li><a role="button" class="hvr-underline-from-left" onclick="tryCreateNote(1,1);">as On service note</a></li>
                <li><a role="button" class="hvr-underline-from-left" onclick="tryCreateNote(1,1);">as Off service note</a></li>
                <li><a role="button" class="hvr-underline-from-left" onclick="tryCreateNote(1,1);">as Transfer note</a></li>
                <li><span class="fa fa-elipsis-h"></span></li>
                <li><a role="button" class="hvr-underline-from-center" onclick="tryCreateNote(88,88);">Discharge summary</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#">Create Note 1</a></li>
                <li><a href="#">Create Note 2</a></li>
                <li><a href="#">Create Note 3</a></li>
                <li><a href="#">Create Note 4 as Note 1</a></li>
                <li><a href="#">Create Note 5 as Note 1</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#">Another link</a></li>
                 -->
            </ul>
        </li>
    </transition>
</template>

<script>
    export default {
        data () {
            return {
                isShow: true,
                notes: axios.get('/get-creatable-notes')
                            .then( (response) => {
                                this.notes = response.data;
                            }).catch( (error) => {
                                console.log(error);
                            })
            }
        },
        methods: {
            action (base, as) {
                alert("create " + base + " as " + as)
            }
        }
    }
</script>

<style>
    /* Enter and leave animations can use different */
    /* durations and timing functions.              */
    .slide-fade-enter-active {
      /*transition: all .3s ease;*/
      transition: all 5s ease;
    }
    .slide-fade-leave-active {
      /*transition: all .8s cubic-bezier(1.0, 0.5, 0.8, 1.0);*/
      transition: all 5s cubic-bezier(1.0, 0.5, 0.8, 1.0);
    }
    .slide-fade-enter, .slide-fade-leave-to
    /* .slide-fade-leave-active below version 2.1.8 */ {
      transform: translateX(10px);
      opacity: 0;
    }
</style>
