<template>
    <div>
        <div class="form-group-sm">
            <label class="control-label">{{ label }}
                <a v-if="labelAction !== undefined" role="button" @click="emitLabelActionEvent()" data-toggle="tooltip" :title="labelActionTitle">
                    <i :class="labelActionIcon"></i>
                </a>
                <a v-if="labelDescription !== undefined" role="button" data-toggle="tooltip" :title="labelDescription">
                    <i class="fa fa-info-circle"></i>
                </a>
                <span v-if="labelDescription !== undefined">:</span>
            </label>
            <transition name="slide-fade">
                <a @click="reset()" role="button" v-show="showReset"><i class="fa fa-remove"></i></a>
            </transition>
            <label class="radio-inline" v-for="option in JSON.parse(options)">
                <input
                    type="radio"
                    :name="field"
                    :value="option.value"
                    @click="check(option.value)"
                    :checked="option.value == currentValue" />
                 {{ option.label }}
            </label>
        </div>

        <transition name="slide-fade">
            <div v-if="showExtra" class="form-group-sm extra">
                <slot></slot>
            </div>
        </transition>
    </div>

</template>

<script>
    export default {
        props: ['field','label', 'options', 'triggerValue', 'needSync', 'labelDescription', 'labelAction', 'setterEvent'],
        data () {
            return {
                showReset: false,
                currentValue: null,
                showExtra: false
            }
        },
        methods: {
            autosave() {
                app.$data.autosaving = true;
                axios.post('/autosave', JSON.parse('{"' + this.field + '": ' + JSON.stringify(this.currentValue) + '}'))
                     .then((response) => { console.log(response.data); this.dirty = false; app.$data.autosaving = false; })
                     .catch((error) => { console.log(error); app.$data.autosaving = false; });
            },
            check(value) {
                if (this.hasDefaultSlot) {
                    if (this.isTriggerExtra(value)) {
                        if (!this.showExtra) {
                            this.showExtra = true;
                        }
                    } else {
                        if (this.showExtra) {
                            this.showExtra = false;
                            // in case of need to use global event bus
                            // EventBus.$emit(this.emitCloseExtra);
                        }
                    }
                }

                if (!this.showReset) {
                    this.showReset = true;
                }

                if (this.currentValue != value) {
                    this.currentValue = value;
                    this.autosave();
                }
            },
            reset() {
                this.showReset = false;
                this.currentValue = null;
                if (this.hasDefaultSlot) {
                    this.showExtra = false;
                }
                this.autosave();
            },
            isTriggerExtra(value) {
                return (value == this.triggerValue)
            },
            emitLabelActionEvent() {
                EventBus.$emit(this.labelActionEmitEventName);
            }
        },
        mounted () {
            // in case of need to use global event bus
            // if (this.onCloseExtra !== undefined) {    
            //     EventBus.$on(this.onCloseExtra, () => {
            //         axios.post('/autosave', JSON.parse('{"' + this.field + '": ' + JSON.stringify(null) + '}'))
            //              .then((response) => { console.log(response.data); this.dirty = false; app.$data.autosaving = false; })
            //              .catch((error) => { console.log(error); app.$data.autosaving = false; });
            //         console.log(this.field);
            //     });
            // }

            if (this.needSync !== undefined) {
                console.log(this.field + ' need sync');
            }

            if (this.labelDescription !== undefined) {
                $('a[title="' + this.labelDescription + '"]').tooltip();
            }

            if (this.labelAction !== undefined) {
                $('a[title="' + this.labelActionTitle + '"]').tooltip();
            }

            if (this.setterEvent !== undefined) {
                EventBus.$on(this.setterEvent, (value) => {
                    this.check(value)
                });
            }
        },
        computed: {
            hasDefaultSlot() {
                return !!this.$slots.default;
            },
            labelActionEmitEventName() {
                if (this.labelAction !== undefined) {
                    return JSON.parse(this.labelAction).emit;
                }
                return '';
            },
            labelActionIcon() {
                if (this.labelAction !== undefined) {
                    return 'fa fa-' + JSON.parse(this.labelAction).icon;
                }
                return '';
            },
            labelActionTitle() {
                if (this.labelAction !== undefined) {
                    return JSON.parse(this.labelAction).title;
                }
                return '';
            }
        },
        beforeDestroy() {
            
        }
    }
</script>

<style>
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
    div.extra {
        font-style: italic;
        color: #757575;
    }
</style>
