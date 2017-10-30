<template>
    <div>
        <div class="form-group-sm">
            <label class="control-label">{{ label }}</label>
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
        props: ['field','label', 'options', 'triggerValue', 'needSync'],
        data () {
            return {
                showReset: false,
                currentValue: -1,
                showExtra: false
            }
        },
        methods: {
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
                    app.$data.autosaving = true;
                    this.currentValue = value;

                    axios.post('/autosave', JSON.parse('{"' + this.field + '": ' + JSON.stringify(value) + '}'))
                         .then((response) => { console.log(response.data); this.dirty = false; app.$data.autosaving = false; })
                         .catch((error) => { console.log(error); app.$data.autosaving = false; });
                }
            },
            reset() {
                this.showReset = false;
                this.currentValue = -1;
                if (this.hasDefaultSlot) {
                    this.showExtra = false;
                }
            },
            isTriggerExtra(value) {
                return (value == this.triggerValue)
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
        },
        computed: {
            hasDefaultSlot() {
                return !!this.$slots.default;
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
