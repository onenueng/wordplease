<template>
    <div class="modal fade" tabindex="-1" role="dialog" id="modal-action" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" v-if="!processing">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">{{ heading }}</h4>
                </div>
                <div class="modal-body bigger-font-25" v-html="content">
                </div>
                <div class="modal-footer" style="height: 80px;">
                    <transition name="slide-fade">
                        <div v-if="!processing">
                            <button-app
                                size="lg"
                                :label="label"
                                :action="action"
                                status="info">
                            </button-app>
                            <button-app
                                size="lg"
                                label="Cancle"
                                action="toggle-modal-action"
                                status="draft">
                            </button-app>
                        </div>
                    </transition>
                    <transition name="slide-fade">
                        <div class="centered" v-if="processing">
                            <i class="fa fa-circle-o-notch fa-spin fa-4x"></i>
                        </div>
                    </transition>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            label: {
                type: String,
                required: true
            },
            heading: {
                type: String,
                required: true
            },
            action: {
                type: String,
                required: true
            },
            content: {
                type: String,
                required: true
            }
        },
        data() {
            return {
                processing: false
            }
        },
        mounted() {
            EventBus.$on('toggle-modal-action', (config) => {
                $('#modal-action').modal((config == undefined ? 'hide' : config))
            })

            EventBus.$on('modal-action-processing', (processing) => {
                this.processing = processing
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
