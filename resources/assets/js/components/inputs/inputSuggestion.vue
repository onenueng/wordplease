<template>
    <div :class="getGrid()">
        <div class="form-group-sm">
            <label  class="control-label topped"
                    :for="id"
                    v-if="label !== undefined">
                {{ label }}
            </label>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-lightbulb-o"></i>
                </span>
                <input  type="text"
                        class="form-control"
                        :name="field"
                        :id="id"
                        :placeholder="placeholder"
                        v-model="userInput"
                        @focus="saved = false"
                        @blur="tryAutosave()" />
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
            // need to sync value with database on render or not ['needSync' or undefined].
            needSync: {
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
            },
            setterEvent: {
                type: String,
                required: false
            },
            storeData: {
                type: String,
                required: false
            },
            targetId: {
                type: String,
                required: false  
            }
        },
        data () {
            return {
                userInput: '',
                lastData: '',
                saved: false
            }
        },
        mounted () {
            // initial data
            if (this.value === undefined || this.value === null) {
                this.lastData = this.userInput = ''
            }
            else {
                this.lastData = this.userInput = this.value
            }

            if (this.setterEvent !== undefined) {
                EventBus.$on(this.setterEvent, (value) => {
                    this.userInput = value
                })
            }

            // initial autocomplete instance
            $('#' + this.id).autocomplete({
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
                minChars: this.minChars == undefined ? 3 : Number(this.minChars),
                maxHeight: 240
            })

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
        },
        methods: {
            getGrid() {
                if (this.grid == undefined) {
                    return 'col-xs-12'
                }
                let grid = this.grid.split('-')
                return 'col-xs-' + (grid[0]) + ' col-sm-' + (grid[1]) + ' col-md-' + (grid[2])
            },
            autosave() {
                if (this.field !== undefined && this.userInput != this.lastData) {
                    EventBus.$emit('autosave', this.field, this.userInput)
                    this.lastData = this.userInput
                    this.saved = true
                }
            },
            tryAutosave() {
                if ( this.storeData !== undefined ) {
                    EventBus.$emit(this.storeData, this.id, this.userInput)
                }
                setTimeout( () => {
                    if ( !this.saved ) {
                        this.autosave()
                    }
                }, 1000)
            }
        },
        computed: {
            getServiceUrl() {
                if (this.serviceUrl == undefined) {
                    return '/lists/autocomplete/' + this.field
                }
                return  '/lists/' + this.serviceUrl
            },
            id() {
                if (this.targetId !== undefined) {
                    return this.targetId
                }
                
                if (this.field !== undefined) {
                    return this.field
                }
                
                return Date.now() + this.serviceUrl.replace(new RegExp('/', 'g'), '')
            }
        }
    }
</script>

