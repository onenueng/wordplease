<template>
    <div :class="getGrid()">
        <div :class="getSize()">
            <label v-if="hasLabel" class="control-label" :for="field">{{ label }}</label>
            <input type="text"
                   class="form-control"
                   :readonly="readonly"
                   :name="field"
                   :id="field"
                   :placeholder="placeholder"
                   v-model="userInput"
                   @blur="autosave()" />
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
            }
        },
        data () {
            return {
                userInput: '',
                lastSave: '',
            }
        },
        mounted () {
            if (this.needSync !== undefined) {
                console.log(this.field + ' need sync')
            }

            if (this.value === undefined)
                this.lastSave = this.userInput = ''
            else
                this.lastSave = this.userInput = this.value
        },
        methods: {
            getGrid() {
                if (this.grid === undefined) {
                    return ''
                }
                let grid = this.grid.split('-').map((x) => 12/x)
                return 'col-xs-' + (grid[0]) + ' col-sm-' + (grid[1]) + ' col-md-' + (grid[2])
            },
            autosave() {
                if ( this.readonly != '' && (this.userInput != this.lastSave)) {
                    EventBus.$emit('autosave', this.field, this.userInput)
                    this.lastSave = this.userInput
                }
            },
            getSize() {
                if (this.size == 'normal') {
                    return 'form-group has-feedback'
                }
                return 'form-group-sm has-feedback'
            }
        },
        computed: {
            hasLabel() {
                return !(this.label === undefined)
            }
        }
    }
</script>
