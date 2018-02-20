<template>
    <div :class="componentGrid">
        <div :class="componentSize" :style="isMaxWidth">
            <label v-if="hasLabel"
                   class="control-label"
                   :for="field">
                <span v-html="label"></span>
                <a  v-if="labelDescription !== undefined"
                    role="button"
                    data-toggle="tooltip"
                    :title="labelDescription">
                    <i class="fa fa-info-circle"></i>
                </a>
                <span v-if="labelDescription !== undefined">:</span>
            </label>
            <input type="text"
                   :class="inputClass"
                   :readonly="readonly"
                   :name="field"
                   :id="field"
                   :placeholder="placeholder"
                   v-model="userInput"
                   @blur="onblur()"
                   :style="isMaxWidth" />
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            // field name on database.
            field: {
                type: String,
                required: false
            },
            // input type default is text
            format: {
                type: String,
                required: false
            },
            label: {
                type: String,
                required: false  
            },
            labelDescription: {
                type: String,
                required: false  
            },
            // define Bootstrap grid class in mobile-tablet-desktop order
            grid: {
                type: String,
                required: false  
            },
            // initial value.
            value: {
                type: String,
                required: false
            },
            // allow user type-in or not, Just mention this option.
            readonly: {
                type: String,
                required: false
            },
            // define Bootstrap form-group has-feedback which size of form-group should use.
            size: {
                type: String,
                required: false
            },
            // need to sync value with database on render or not ['needSync' or undefined].
            needSync: {
                type: String,
                required: false
            },
            placeholder: {
                type: String,
                required: false
            },
            setterEvent: {
                type: String,
                required: false  
            },
            pattern: {
                type: String,
                required: false
            },
            invalidText: {
                type: String,
                required: false
            }
        },
        data () {
            return {
                userInput: '',
                lastSave: '',
                type: 'text',
                inputClass: 'form-control'
            }
        },
        mounted () {
            // init label tooltip if available.
            if (this.labelDescription !== undefined) {
                $('a[title="' + this.labelDescription + '"]').tooltip()
            }

            if ( this.format !== undefined ) {
                this.type = this.format
            }

            if (this.needSync !== undefined) {
                console.log(this.field + ' need sync')
            }

            if (this.value === undefined)
                this.lastSave = this.userInput = ''
            else
                this.lastSave = this.userInput = this.value

            if ( this.setterEvent !== undefined ) {
                EventBus.$on(this.setterEvent, (value) => {
                    this.userInput = value
                    this.autosave()
                })
            }
        },
        methods: {
            autosave() {
                if ( this.readonly != '' && (this.userInput != this.lastSave)) {
                    EventBus.$emit('autosave', this.field, this.userInput)
                    this.lastSave = this.userInput
                }
            },
            isValidate() {
                if ( this.pattern !== null ) {
                    if ( this.userInput.match(this.regex) !== null ) {
                        $(this.inputDom).attr('data-original-title', '')
                        $(this.inputDom).tooltip('hide')
                        this.inputClass = 'form-control'
                        return true
                    } else {
                        return false
                    }
                }
                return true
            },
            onblur() {
                if ( this.isValidate() ) {
                    this.autosave()
                } else {
                    $(this.inputDom).attr('data-original-title', this.invalidTextComputed)
                    $(this.inputDom).tooltip('show')
                    this.inputClass = 'form-control invalid-input'
                }
            }
        },
        computed: {
            hasLabel() {
                return !(this.label === undefined)
            },
            componentSize() {
                if (this.size == 'normal') {
                    return 'form-group'
                }
                return 'form-group-sm'
            },
            componentGrid() {
                if (this.grid === undefined) {
                    return ''
                }
                let grid = this.grid.split('-')
                return 'col-xs-' + (grid[0]) + ' col-sm-' + (grid[1]) + ' col-md-' + (grid[2])
            },
            isMaxWidth() {
                if ( this.label === undefined ) {
                    return "width: 100%;"
                }
                return ""
            },
            regex() {
                if ( this.pattern !== null ) {
                    return new RegExp(this.pattern)
                }
                return null
            },
            inputDom() {
                return ( this.field !== undefined ) ? ('#' + this.field) : ''
            },
            invalidTextComputed() {
                let defaultText = 'Invalid format. Data cannot be saved.'
                return ( this.invalidText === undefined ) ? defaultText : this.invalidText
            }
        }
    }
</script>
