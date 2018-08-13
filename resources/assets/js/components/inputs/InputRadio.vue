<template>
<div>
    <div class="form-group-sm">
        <label class="control-label">
            <span v-html="label"></span>
            <a  data-toggle="tooltip"
                role="button"
                :title="labelAction.title"
                v-if="labelAction !== {}"
                @click="$emit(labelAction.event)"
            ><i :class="labelAction.icon"></i></a>
            <a  data-toggle="tooltip"
                role="button"
                v-if="labelDescription !== null"
                :title="labelDescription"
            ><i class="fa fa-info-circle"></i></a>
            <span v-if="labelDescription !== null">:</span>
        </label>
        <transition name="slide-fade">
            <a  role="button"
                v-show="showReset"
                @click="reset"
            ><i class="fa fa-remove"></i></a>
        </transition>
        <label class="radio-inline" v-for="option in options" :key="option.label">
            <input
                type="radio"
                :checked="option.value == (value === undefined ? checkedValue:value)"
                :name="field"
                :value="option.value"
                @click="check(option.value)" />
            <span v-html="option.label"></span>
            <a  data-toggle="tooltip"
                role="button"
                :title="option.labelDescription"
                v-if="option.labelDescription !== undefined"
            ><i class="fa fa-info-circle"></i></a>
        </label>
    </div>

    <transition name="slide-fade">
        <div class="form-group-sm extra"
             v-if="showExtra"
        ><slot></slot></div>
    </transition>
</div>
</template>

<script>
export default {
    props: {
        field: { default: Date.now() + '-' + Math.floor(Math.random()*1000) },
        label: { default: null },
        labelDescription: { default: null },
        labelAction: { default: () => { return {} } },
        options: { required: true, type: Array },
        value: { required: true },
        
        triggerValues: { required: false, type: Array }, // value to trigger extra content.
    },
    data () {
        return {
            showReset: false,
            checkedValue: null,
            showExtra: false
        }
    },
    computed: {
        hasDefaultSlot() { // check if has content in default slot.
            return this.$slots.default === undefined ? false : true
        }
        // ,
        // triggerValues() {
        //     if (this.triggerValue !== undefined) {
        //         return JSON.parse(this.triggerValue)
        //     }
        //     return null
        // }
    },
    methods: {
        autosave() {
            if (this.field !== undefined) {
                // EventBus.$emit('autosave', this.field, this.checkedValue)
                if ( this.storeData !== undefined ) {
                    // EventBus.$emit(this.storeData, this.field, this.checkedValue)
                }
            }

            if ( this.emitOnUpdate !== undefined ) {
                // EventBus.$emit(this.emitOnUpdate, this.checkedValue)
            }
        },

        check(value) {
            this.$emit('input', value)
            // check if has extra contents.
            if (this.hasDefaultSlot) {
                if (this.isTriggerExtra(value)) {
                    if (!this.showExtra) {
                        this.showExtra = true
                    }
                } else {
                    if (this.showExtra) {
                        this.showExtra = false
                    }
                }
            }

            // show reset icon.
            if (!this.showReset) {
                this.showReset = true
            }

            // check if value change.
            if (this.checkedValue != value) {
                this.checkedValue = value
                this.autosave()
            }

            // check if need to store
        },
        // reset to unchecked all options.
        reset() {
            this.$emit('input', null)
            this.showReset = false
            this.checkedValue = null
            if (this.hasDefaultSlot) {
                this.showExtra = false
            }
            this.autosave()
        },
        // return checked value is trigger value or not.
        isTriggerExtra(value) {
            /*MAYBE WE CAN USE LODASH FOR THIS SHIT*/
            if ((typeof this.triggerValues) == 'object') {
                let show = false
                this.triggerValues.forEach((eachValue) => {
                    if (eachValue == value) {
                        show = true
                    }
                })
                return show
            }
            return (value == this.triggerValues)
        }
    },
    mounted () {
        if (this.labelDescription !== null) { // init label tooltip if available.
            $('a[title="' + this.labelDescription + '"]').tooltip()
        }

        if (this.labelAction !== {}) { // init label action icon tooltip if available.
            $('a[title="' + this.labelAction.title + '"]').tooltip()
        }

        this.options.forEach((option) => { // init each option label tooltip if available.
            if (option.labelDescription !== undefined) {
                $('a[title="' + option.labelDescription + '"]').tooltip()
            }
        })

        // // listen to event to set option value.
        // if (this.setterEvent !== undefined) {
        //     // let eventName = this.setterEvent != '' ? this.setterEvent : 'set-' + this.field
            
        //     EventBus.$on(this.setterEvent, (value) => {
        //         this.check(value)
        //     })
        // }

        if (this.value !== undefined && this.value !== null) {

            this.checkedValue = this.value

            this.showReset = true

            /* MAYBE SHOWEXTRA SHOULD BE COMPUTED */
            if (this.hasDefaultSlot) {
                this.showExtra = this.isTriggerExtra(this.value)
            } else {
                this.showExtra = false
            }
        }

        // if (this.needSync !== undefined) {
        //     let url = '/note-data/' + window.location.pathname.split("/")[2] + '/' + this.field
        //         axios.get(url)
        //              .then( (response) => {
        //                 check(response.data)
        //              })
        //              .catch( (error) => {
        //                 console.log(error)
        //              })
        // }
    }
}
</script>

<style>
div.extra {
    font-style: italic;
    color: #757575;
}
</style>
