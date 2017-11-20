<template>
    <div :class="getGrid()">
        <div class="form-group-sm">
            <label class="control-label" :for="field">{{ label }}</label>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-lightbulb-o"></i>
                </span>
                <input  type="text"
                        class="form-control"
                        :name="field"
                        :id="field"
                        v-model="userInput"
                        @blur="autosave()" />
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
            // endpoint to get options.
            serviceUrl: {
                type: String,
                required: false  
            },
            // min chars to trigger suggestions.
            minChars: {
                type: String,
                required: false  
            }
        },
        data () {
            return {
                userInput: '',
                domRef: 'input[name=' + this.field + ']',
                lastData: ''
            }
        },
        mounted () {
            // initial data
            if (this.value === undefined)
                this.lastData = this.userInput = ''
            else
                this.lastData = this.userInput = this.value

            // initial autocomplete instance
            $(this.domRef).autocomplete({
                // setup sservice endpoint
                serviceUrl: this.getServiceUrl,
                // format suggestions
                beforeRender: (container, suggestions) => {
                    for (let i = 0; i < container.children().length; i++) {
                        let strHTML = container.children().eq(i).html()
                        // custom format if there is not aleardy formatted
                        if (strHTML.search('<strong>') < 0 && strHTML.search(this.userInput[0]) >= 0 ) {
                            let strHTMLNew = ''
                            let lastPos = 0 // last sub string position
                            for (let j = 0; j < this.userInput.length; j++) {
                                for (let k = lastPos; k < strHTML.length; k++) {
                                    // apply strong element to highlight matched character
                                    if (strHTML[k] == this.userInput[j]) {
                                        strHTMLNew += '<strong>' + this.userInput[j] + '</strong>'
                                        lastPos = k+1
                                        break
                                    } else {
                                        strHTMLNew += strHTML[k]
                                    }
                                }
                            }
                            // concat remain string
                            for (let k = lastPos; k < strHTML.length; k++) {
                                strHTMLNew += strHTML[k]
                            }
                            container.children().eq(i).html(strHTMLNew)
                        }
                    }
                },
                onSelect: (suggestion) => {
                    this.userInput = suggestion.value
                    this.autosave()
                },
                minChars: this.minChars === undefined ? 3 : this.minChars,
                maxHeight: 240
            });
        },
        methods: {
            getGrid() {
                let grid = this.grid.split('-').map((x) => 12/x)
                return 'col-xs-' + (grid[0]) + ' col-sm-' + (grid[1]) + ' col-md-' + (grid[2])
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
                    return '/lists/autocomplete/' + this.field
                }

                return  '/lists/' + this.serviceUrl
            }
        }
    }
</script>

