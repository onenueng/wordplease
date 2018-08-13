<template>
<div :class="componentGrid">
    <a role="button"
       :style="isMaxWidthReset"
       v-if="label === null"
       v-show="showReset"
       @click="reset"
    ><i class="fa fa-remove"></i></a>
    <div :class="componentSize"
         :style="isMaxWidthDiv">
        <label
            class="control-label topped"
            :for="field"
            v-if="label !== null">
            <span v-html="label"></span>
            <a  v-if="labelDescription !== null"
                role="button"
                data-toggle="tooltip"
                :title="labelDescription"
            ><i class="fa fa-info-circle"></i></a>
            <span v-if="labelDescription !== null">:</span>
            <a role="button"
               v-show="showReset"
               @click="reset"
            ><i class="fa fa-remove"></i></a>
        </label>
        <input
            type="text"
            class="form-control cursor-pointer"
            :id="field"
            :name="field"
            :onkeydown="allowOther?'return true':'return false'"
            :placeholder="placeholder"
            :readonly="readonly"
            :style="isMaxWidthInput"
            :value="value === undefined ? currentData:value"
            ref="input"
            @blur="autosave" />
        <span class="fa fa-chevron-down form-control-feedback"></span>
    </div>
</div>
</template>

<script>
require("devbridge-autocomplete/dist/jquery.autocomplete.min.js") // jQuery plugin
export default {
    props: {
        allowOther: { default:false },
        field: { default: Date.now() + '-' + Math.floor(Math.random()*1000) },
        grid: { default: null },
        label: { default: null },
        labelDescription: { default: null },
        placeholder: { default: null },
        readonly: { default: false },
        serviceUrl: { default: null },
        size: { default: 'small' },
        value: { required: true } // model
    },
    data () {
        return {
            showReset: false,
            currentData: '',
            lastSave: null
        }
    },
    computed: {
        componentGrid() {
            if ( this.grid === null ) return 'col-xs-12'
            let grid = this.grid.split('-')
            return 'col-xs-' + (grid[0]) + ' col-sm-' + (grid[1]) + ' col-md-' + (grid[2])
        },
        componentSize() {
            if ( this.size == 'small' ) {
                return 'form-group-sm has-feedback'
            } else if ( this.size == 'normal' ) {
                return 'form-group has-feedback'
            } else if ( this.size == 'large' ) {
                return 'form-group-lg has-feedback'
            } else {
                return ''
            }
        },
        isMaxWidthDiv() {  // style max width for div input
            return ( this.label === null ) ? "width: 95%;" : ""
        },
        isMaxWidthInput() { // style max width for input
            return ( this.label === null ) ? "width: 100%;" : ""
        },
        isMaxWidthReset() { // style max width for reset icon
            return ( this.label === null ) ? "width: 5%;" : ""
        }
    },
    mounted () {
        if (this.labelDescription !== null) { // init label tooltip if available.
            $('a[title="' + this.labelDescription + '"]').tooltip()
        }
        $('#' + this.field).autocomplete({ // initial autocomplete instance
            serviceUrl: (this.serviceUrl === null) ? '/lists/select/' + this.field : '/lists/' + this.serviceUrl,
            onSelect: (suggestion) => {
                this.$refs.input.value = this.currentData = suggestion.value
                this.$emit('input', this.$refs.input.value)
                this.showReset = true
                this.autosave()
            },
            minChars: 0, // render options on focus
            maxHeight: 240
        })
    },
    methods: {
        reset() {
            this.lastSave = this.currentData = this.$refs.input.value = null
            this.$emit('input', null)
            this.$emit('autosave', this.field)
            this.showReset = false
        },
        autosave() {
            if ( (this.value !== undefined) && !this.readonly && (this.value != this.lastSave) ) {
                this.$emit('autosave', this.field)
                this.lastSave = this.value
            }
        }
    }
    
}
</script>

<style>
.cursor-pointer {
    cursor:pointer;
}
</style>
