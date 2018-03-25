<template>
    <div :class="componentGrid">
        <a v-if="label === undefined" @click="reset()" role="button" v-show="showReset" :style="isMaxWidthReset">
            <i class="fa fa-remove"></i>
        </a>
        <div :class="componentSize" :style="isMaxWidthDiv">
            <label class="control-label topped" :for="field" v-if="label !== undefined">
                <span v-html="label"></span>
                <a  v-if="labelDescription !== undefined"
                    role="button"
                    data-toggle="tooltip"
                    :title="labelDescription">
                    <i class="fa fa-info-circle"></i>
                </a>
                <span v-if="labelDescription !== undefined">:</span>
                <a @click="reset()" role="button" v-show="showReset">
                    <i class="fa fa-remove"></i>
                </a>
            </label>
            <input  type="text"
                    class="form-control cursor-pointer"
                    :name="field"
                    :id="field"
                    v-model="userInput"
                    @blur="autosave()"
                    @input="showReset = (userInput != '')"
                    :onkeypress="isAllowOther"
                    :placeholder="placeholder"
                    :style="isMaxWidthInput" />
            <span class="fa fa-chevron-down form-control-feedback"></span>
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
                type: [String, Number],
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
            },
            placeholder: {
                type: String,
                required: false
            },
            emitOnUpdate: {
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
            
            // init label tooltip if available.
            if (this.labelDescription !== undefined) {
                $('a[title="' + this.labelDescription + '"]').tooltip()
            }

            if (this.needSync !== undefined) {
                // let url = '/note-data/' + window.location.pathname.split("/")[2] + '/' + this.field
                let url = this.needSync + '/' + this.field
                axios.get(url)
                     .then( (response) => {
                        this.userInput = response.data
                     })
                     .catch( (error) => {
                        this.userInput = 'error'
                     })
            }

            if ( this.value === undefined || this.value === null ) {
                this.lastData = this.userInput = null
                this.showReset = false
            } else {
                this.lastData = this.userInput = this.value
                this.showReset = true
            }

            // init autocomplete.
            $(this.domRef).autocomplete({
                // width: this.maxWid,
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
            reset() {
                this.showReset = false
                this.userInput = ''
                this.autosave()
            },
            autosave() {
                if (this.field !== undefined && this.userInput != this.lastData) {
                    EventBus.$emit('autosave', this.field, this.userInput)
                    this.lastData = this.userInput

                    if ( this.emitOnUpdate !== undefined ) {
                        EventBus.$emit(this.emitOnUpdate, this.userInput)
                    }
                }
            }
        },
        computed: {
            getServiceUrl() {
                if (this.serviceUrl === undefined) {
                    return '/lists/select/' + this.field
                }

                return  '/lists/' + this.serviceUrl
            },
            componentGrid() {
                if (this.grid === undefined) {
                    return ''
                }
                // let grid = this.grid.split('-').map((x) => 12/x)
                let grid = this.grid.split('-')
                return 'col-xs-' + (grid[0]) + ' col-sm-' + (grid[1]) + ' col-md-' + (grid[2])
            },
            componentSize() {
                if (this.size == 'normal') {
                    return 'form-group has-feedback'
                }
                return 'form-group-sm has-feedback'
            },
            isAllowOther() {
                return this.notAllowOther === undefined ? 'return true;' : 'return false;'
            },
            isMaxWidthDiv() {
                if ( this.label === undefined ) {
                    return "width: 95%;"
                }
                return ""
            },
            isMaxWidthInput() {
                if ( this.label === undefined ) {
                    return "width: 100%;"
                }
                return ""
            },
            isMaxWidthReset() {
                if ( this.label === undefined ) {
                    return "width: 5%;"
                }
                return ""
            }
        }
    }
</script>

<style>
    .cursor-pointer {
        cursor:pointer;
    }
</style>
