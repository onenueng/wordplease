<template>
    <div :class="gridClass">
        <div :class="sizeClass">
            <label  v-if="hasLabel"
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
            <div class="input-group">
                <span   v-if="frontAddon !== undefined"
                        class="input-group-addon"
                        v-html="frontAddonHtml">
                </span>
                <input  type="text"
                        class="form-control"
                        :readonly="readonly"
                        :placeholder="placeholder"
                        :name="field"
                        :id="field"
                        v-model="userInput"
                        @input="oninput()"
                        @blur="autosave()" />
                <span   v-if="rearAddon !== undefined"
                        class="input-group-addon"
                        v-html="rearAddonHtml">
                </span>
            </div>
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
            label: {
                type: String,
                required: false  
            },
            labelDescription: {
                type: String,
                required: false  
            },
            placeholder: {
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
            frontAddon: {
                type: String,
                required: false  
            },
            rearAddon: {
                type: String,
                required: false  
            },
            // event emit when checked/unchecked.
            emitOnUpdate: {
                
                required: false
            },
            // event emit when checked/unchecked.
            setterEvent: {
                type: String,
                required: false
            },
            setterFrontAddon: {
                type: String,
                required: false
            },
            setterRearAddon: {
                type: String,
                required: false
            }
        },
        data () {
            return {
                userInput: '',
                lastSave: '',
                frontAddonHtml: '',
                rearAddonHtml: ''
            }
        },
        mounted () {
            // init label tooltip if available.
            if (this.labelDescription !== undefined) {
                $('a[title="' + this.labelDescription + '"]').tooltip()
            }

            if (this.frontAddon !== undefined && this.frontAddon.search('data-toggle="tooltip"') >= 0) {
                $('span.input-group-addon a[data-toggle=tooltip]').tooltip()
            } else {
                if (this.rearAddon !== undefined && this.rearAddon.search('data-toggle="tooltip"') >= 0) {
                    $('span.input-group-addon a[data-toggle=tooltip]').tooltip()
                }    
            }

            if (this.setterEvent !== undefined) {
                EventBus.$on(this.setterEvent, (value) => {
                    if (value != this.userInput) {
                        this.userInput = value
                        this.autosave()
                    }
                })
            }

            if (this.rearAddon !== undefined) {
                this.rearAddonHtml = this.rearAddon
            }

            if (this.frontAddon !== undefined) {
                this.frontAddonHtml = this.frontAddon
            }

            if (this.setterRearAddon !== undefined) {
                EventBus.$on(this.setterRearAddon, (html) => {
                    this.rearAddonHtml = html
                })
            }

            if (this.setterFrontAddon !== undefined) {
                EventBus.$on(this.setterFrontAddon, (html) => {
                    this.frontAddonHtml = html
                })   
            }

            if (this.needSync !== undefined) {
                console.log(this.field + ' need sync')
            }

            if (this.value === undefined)
                this.lastSave = this.userInput = ''
            else
                this.lastSave = this.userInput = this.value
        },
        methods: {
            autosave() {
                if ( this.readonly != '' && (this.userInput != this.lastSave)) {
                    EventBus.$emit('autosave', this.field, this.userInput)
                    this.lastSave = this.userInput
                }
            },
            oninput() {
                if ( this.emitOnUpdateEvents !== null) {
                    this.emitOnUpdateEvents.forEach((event) => {
                        EventBus.$emit(event, this.userInput)
                    })
                }
            }
        },
        computed: {
            hasLabel() {
                return !(this.label === undefined)
            },
            sizeClass() {
                if (this.size == 'normal') {
                    return 'form-group add-margin-bottom'
                }
                return 'form-group-sm add-margin-bottom'
            },
            gridClass() {
                if (this.grid === undefined) {
                    return ''
                }
                let grid = this.grid.split('-')
                return 'col-xs-' + (grid[0]) + ' col-sm-' + (grid[1]) + ' col-md-' + (grid[2])
            },
            emitOnUpdateEvents() {
                if ( this.emitOnUpdate !== undefined) {
                    return JSON.parse(this.emitOnUpdate)
                }
                return null
            }
        }
    }
</script>

<style>
    .add-margin-bottom {
        margin-bottom: 5px;
    }
</style>
