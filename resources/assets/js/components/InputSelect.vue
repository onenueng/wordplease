<template>
    <div :class="getGrid()">
        <div :class="getSize()">
            <label class="control-label" :for="field" v-if="label !== undefined">
                {{ label }}
                <a @click="reset()" role="button" v-show="showReset">
                    <i class="fa fa-remove"></i>
                </a>
            </label>
            <input  type="text"
                    class="form-control"
                    :name="field"
                    :id="field"
                    v-model="userInput"
                    @blur="autosave()"
                    @input="showReset = (userInput != '')"
                    :onkeypress="isAllowOther()" />
            <span class="fa fa-chevron-down form-control-feedback" aria-hidden="true"></span>
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
            // endpoint to get options.
            serviceUrl: {
                type: String,
                required: false  
            },
            // initial value.
            value: {
                type: String,
                required: false
            },
            // allow user type-in or not, Just mention this option.
            notAllowOther: {
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
            }
        },
        data () {
            return {
                userInput: '',
                domRef: 'input[name=' + this.field + ']',
                showReset: false,
                lastData: ''
            }
        },
        mounted () {
            
            if (this.needSync !== undefined) {
                console.log(this.field + ' need sync')
            }

            if (this.value === undefined)
                this.lastData = this.userInput = this.value = ''
            else
                this.lastData = this.userInput = this.value

            this.showReset = (this.value != '')

            // init autocomplete.
            $(this.domRef).autocomplete({
                serviceUrl: this.getServiceUrl,
                onSelect: (suggestion) => {
                    this.showReset = true
                    this.data = suggestion.data
                    this.userInput = suggestion.value
                    this.autosave()
                },
                minChars: 0, // render options on focus
                maxHeight: 240
            })
        },
        methods: {
            getGrid() {
                if (this.grid === undefined) {
                    return ''
                }
                let grid = this.grid.split('-').map((x) => 12/x)
                return 'col-xs-' + (grid[0]) + ' col-sm-' + (grid[1]) + ' col-md-' + (grid[2])
            },
            getSize() {
                if (this.size == 'normal') {
                    return 'form-group has-feedback'
                }
                return 'form-group-sm has-feedback'
            },
            reset() {
                this.showReset = false
                this.userInput = ''
                this.autosave()
            },
            isAllowOther() {
                return this.notAllowOther === undefined ? 'return true;' : 'return false;'
            },
            autosave() {
                if (this.field !== undefined && this.userInput != this.lastData) {
                    EventBus.$emit('autosave', this.field, this.userInput)
                    this.lastData = this.userInput
                }
            }
        },
        computed: {
            getServiceUrl() {
                if (this.serviceUrl === undefined) {
                    return '/lists/select/' + this.field
                }

                return  '/lists/' + this.serviceUrl
            }
        }
    }
</script>
