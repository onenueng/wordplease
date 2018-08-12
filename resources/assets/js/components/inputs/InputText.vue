<template>
    <div :class="componentGrid">
        <div :class="componentSize"
             :style="isMaxWidth">
            <label v-if="label !== null"
                   class="control-label topped"
                   :for="field">
                <span v-html="label"></span>
                <a  v-if="labelDescription !== null"
                    role="button"
                    data-toggle="tooltip"
                    :title="labelDescription">
                    <i class="fa fa-info-circle"></i>
                </a>
                <span v-if="labelDescription !== null">:</span>
            </label>
            <input
                :type="type"
                :class="inputClass"
                :readonly="readonly"
                :name="field"
                :id="field"
                :placeholder="placeholder"
                :style="isMaxWidth"
                :value="value"
                ref="input"
                @input="oninput"
                @blur="onblur()" />
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            type: { default: 'text' },
            label: { default: null },
            labelDescription: { default: null },
            grid: { default: null },
            size: { default: 'small' },
            value: { default: null }, // model
            readonly: { default: false },
            placeholder: { default: null },
            pattern: { default: '.' },
            invalidResponseText: { default: 'Invalid format. Data cannot be saved.' },
            field: { default: Date.now() + Math.floor(Math.random()*1000) },
        },
        data () {
            return {
                lastSave: null,
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
                if ( this.grid === null ) {
                    return ''
                }
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
        },
        methods: {
            oninput() {
                if ( this.validate() ) {
                    this.$emit('input', this.$refs.input.value)
                    this.resetTheme()
                } else {
                    this.setInvalidTheme()
                }
            },
            validate() {
                if ( this.$refs.input.value != '' ) {
                    if ( this.$refs.input.value.match(this.regex) !== null ) { // valid pattern
                        this.resetTheme()
                        return true
                    } else {
                        return false
                    }
                }
                return true
            },
            autosave() {
                if ( !this.readonly && (this.value != this.lastSave) ) {
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
