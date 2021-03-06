<template>
<div :class="componentGrid">
    <div :class="componentSize"
         :style="isMaxWidth">
        <label
            class="control-label topped"
            :for="field !== undefined ? field:id"
            v-if="label !== null">
            <span v-html="label"></span>
            <a  data-toggle="tooltip"
                role="button"
                :title="labelDescription"
                v-if="labelDescription !== null"
            ><i class="fa fa-info-circle"></i></a>
            <span v-if="labelDescription !== null">:</span>
        </label>
        <div class="input-group">
            <span
                class="input-group-addon"
                v-if="addonFront !== undefined"
                v-html="addonFront"
            ></span>
            <input
                :class="inputClass"
                :id="field !== undefined ? field:id"
                :name="field !== undefined ? field:id"
                :placeholder="placeholder"
                :readonly="readonly"
                :style="isMaxWidth"
                :type="type"
                :value="value === undefined ? currentValue:value"
                ref="input"
                @input="oninput"
                @blur="onblur" />
            <span
                class="input-group-addon"
                v-if="addonRear !== undefined"
                v-html="addonRear"    
            ></span>
        </div>
    </div>
</div>
</template>

<script>
export default {
props: {
    addonFront: { required: false },
    addonRear: { required: false },
    field: { required: false },
    grid: { default: null },
    invalidResponseText: { default: 'Invalid format. Data cannot be saved.' },
    label: { default: null },
    labelDescription: { default: null },
    pattern: { default: '.' },
    placeholder: { default: null },
    readonly: { default: false },
    size: { default: 'small' },
    type: { default: 'text' },
    value: { required: true } // model
},
data () {
    return {
        lastSave: null,
        currentValue: null,
        inputClass: 'form-control'
    }
},
computed: {
    componentSize() {
        if ( this.size == 'small' ) {
            return 'form-group-sm'
        } else if ( this.size == 'normal' ) {
            return 'form-group'
        } else if ( this.size == 'large' ) {
            return 'form-group-lg'
        } else {
            return ''
        }
    },
    componentGrid() {
        if ( this.grid === null ) return 'col-xs-12'
        let grid = this.grid.split('-')
        return 'col-xs-' + (grid[0]) + ' col-sm-' + (grid[1]) + ' col-md-' + (grid[2])
    },
    isMaxWidth() {
        return ( this.label === null ) ? "width: 100%;" : ""
    },
    regex() {
        return new RegExp(this.pattern)
    }
},
created () {
    if (this.field === undefined ) { this.id = Date.now() + '-' + Math.floor(Math.random()*1000) }
},
mounted () {
    if (this.labelDescription !== null) {
        $('a[title="' + this.labelDescription + '"]').tooltip()
    }

    if ( this.pattern !== '.') {
        $('#' + this.field).tooltip({
            placement: "bottom",
            trigger: "hover",
            delay: { "show": 100, "hide": 500 }
        })
    }

    if (this.addonFront !== undefined && this.addonFront.search('data-toggle="tooltip"') >= 0) {
        setTimeout(() => { $('span.input-group-addon a[data-toggle=tooltip]').tooltip() }, 100)
    }
    if (this.addonRear !== undefined && this.addonRear.search('data-toggle="tooltip"') >= 0) {
        setTimeout(() => { $('span.input-group-addon a[data-toggle=tooltip]').tooltip() }, 100)
    }    
},
methods: {
    oninput () {
        this.currentValue = this.$refs.input.value
        this.$emit('input', this.$refs.input.value)
        if ( this.validate() ) {
            this.resetTheme()
        } else {
            this.setInvalidTheme()
        }
    },
    validate() {
        if ( this.$refs.input.value != '' ) {
            if ( this.$refs.input.value.match(this.regex) !== null ) { // valid pattern
                return true
            } else {
                return false
            }
        }
        return true
    },
    autosave() {
        if ( (this.value !== undefined) && !this.readonly && (this.value != this.lastSave) ) {
            this.$emit('autosave', this.field)
            this.lastSave = this.value
        }
    },
    onblur() {
        if ( this.validate() ) {
            this.resetTheme()
            this.autosave()
        } else {
            this.setInvalidTheme()
        }
    },
    resetTheme () {
        $('#' + this.field).attr('data-original-title', '')
        $('#' + this.field).tooltip('hide')
        this.inputClass = 'form-control'
    },
    setInvalidTheme () {
        $('#' + this.field).attr('data-original-title', this.invalidResponseText)
        $('#' + this.field).tooltip('show')
        this.inputClass = 'form-control invalid'
    }
}
}
</script>
