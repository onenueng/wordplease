<template>
    <div>
        <div class="form-group-sm">
            <label class="control-label">{{ label }}</label>
            <a @click="reset()" role="button" v-show="showReset"><i class="fa fa-remove"></i></a>
            <label class="radio-inline" v-for="option in JSON.parse(options)">
                <input
                    type="radio"
                    :name="field"
                    :value="option.value"
                    @click="check(option.value)"
                    :checked="option.value == currentValue" /> {{ option.label }}
            </label>
        </div>

        <transition name="slide-fade">
            <div v-if="showExtra">
                <slot></slot>
            </div>
        </transition>
    </div>

</template>

<script>
    export default {
        props: ['field','label', 'options'],
        data () {
            return {
                showReset: false,
                currentValue: -1,
                showExtra: false
            }
        },
        methods: {
            check(value) {
                if(!this.showReset) {
                    this.showReset = true;
                }
                this.currentValue = value;
                console.log(value);
                if (this.hasDefaultSlot) {
                    this.showExtra = true;
                }
            },
            reset() {
                this.showReset = false;
                this.currentValue = -1;
                if (this.hasDefaultSlot) {
                    this.showExtra = false;
                }
            }
        },
        mounted () {
            
        },
        computed: {
            hasDefaultSlot() {
                return !!this.$slots.default;
            }
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
</style>
