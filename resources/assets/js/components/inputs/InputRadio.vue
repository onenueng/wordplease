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
    field: { required: false },
    label: { default: null },
    labelDescription: { default: null },
    labelAction: { default: () => { return {} } },
    options: { required: true, type: Array },
    value: { required: true },
    triggerValues: { required: false, type: Array }, // value to trigger extra content.
},
data () {
    return { checkedValue: null }
},
computed: {
    showReset () {
        return ( (this.value !== undefined && this.value != null) || this.checkedValue != null )
    },
    showExtra () {
        if ( this.$slots.default === undefined || this.triggerValues === undefined ) { return false }
        return false || this.triggerValues.some((value) => { return value == this.checkedValue })
    }
},
created () {
    if (this.field === undefined ) { this.id = Date.now() + '-' + Math.floor(Math.random()*1000) }
},
mounted () {
    if ( this.value !== undefined ) { this.checkedValue = this.value }
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
},
methods: {
    check(value) {
        this.$emit('input', value)
        if (this.checkedValue != value) { // check if value change.
            this.checkedValue = value
            this.autosave()
        }
    },
    autosave() {
        if ( this.value !== undefined ) { this.$emit('autosave', this.field) }
    },
    reset() { // reset to unchecked all options.
        this.$emit('input', null)
        this.checkedValue = null
        this.autosave()
    }
}
}
</script>

<style>
div.extra {
    font-style: italic;
    color: #757575;
}
</style>
