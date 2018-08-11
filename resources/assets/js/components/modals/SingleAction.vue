<template>
    <div class="modal fade" tabindex="-1" role="dialog" id="modal-action" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" v-if="!busy">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">{{ heading }}</h4>
                </div>
                <div class="modal-body bigger-font-25" v-html="body">
                </div>
                <div class="modal-footer" style="height: 80px;">
                    <transition name="slide-fade">
                        <div v-if="!busy">
                            <button-app
                                size="lg"
                                status="info"
                                :label="actionButtonLabel"
                                @click="$emit('confirmed')" />

                            <button-app
                                size="lg"
                                label="Cancle"
                                status="draft"
                                @click="$emit('dismiss')" />
                        </div>
                    </transition>
                    <transition name="slide-fade">
                        <div class="centered" v-if="busy">
                            <i class="fa fa-circle-o-notch fa-spin fa-4x"></i>
                        </div>
                    </transition>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import ButtonApp from '../buttons/ButtonApp.vue'

    export default {
        components: {
            ButtonApp
        },
        props: {
            actionButtonLabel: { default: 'OK' },
            heading: { default: "What's up!" },
            toggle: { default: false },
            busy: { default: false },
            body: { default: '' }
        },
        watch: {
            toggle(toggle) {
                $('#modal-action').modal(toggle ? 'show' : 'hide')
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
