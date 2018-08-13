<template>
<div :class="componentGrid">
    <div class="form-group-sm">
        <label
            class="control-label topped"
            :for="field"
            v-html="label"
            v-if="label !== null"
        ></label>
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-lightbulb-o"></i></span>
            <input
                class="form-control"
                type="text"
                :id="field"
                :name="field"
                :placeholder="placeholder"
                :readonly="readonly"
                :value="value"
                ref="input" />
        </div>
    </div>
</div>
</template>

<script>
require("devbridge-autocomplete/dist/jquery.autocomplete.min.js") // jQuery plugin
export default {
    props: {
        field: { default: Date.now() + '-' + Math.floor(Math.random()*1000) },
        grid: { default: null },
        label: { default: null },
        minChars: { default: 3 },
        placeholder: { default: null },
        readonly: { default: false },
        serviceUrl: { default: null },
        value: { required: true } // model
    },
    data () {
        return { lastSave: null }
    },
    computed: {
        componentGrid() {
            if ( this.grid === null ) return 'col-xs-12'
            let grid = this.grid.split('-')
            return 'col-xs-' + (grid[0]) + ' col-sm-' + (grid[1]) + ' col-md-' + (grid[2])
        }
    },
    mounted () {
        $('#' + this.field).autocomplete({ // initial autocomplete instance
            // setup service endpoint
            serviceUrl: '/lists/autocomplete/' + ((this.serviceUrl !== null) ? this.serviceUrl : this.field ),
            beforeRender: (container, suggestions) => { // format suggestions
                for (let i = 0; i < container.children().length; i++) {
                    let strHTML = container.children().eq(i).html()
                    // custom format if there is not aleardy formatted
                    if (strHTML.search('<strong>') < 0 && strHTML.search(this.$refs.input.value[0]) >= 0 ) {
                        let strHTMLNew = ''
                        let lastPos = 0 // last sub string position
                        for (let j = 0; j < this.$refs.input.value.length; j++) {
                            for (let k = lastPos; k < strHTML.length; k++) {
                                // apply strong element to highlight matched character
                                if (strHTML[k] == this.$refs.input.value[j]) {
                                    strHTMLNew += '<strong>' + this.$refs.input.value[j] + '</strong>'
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
                this.$refs.input.value = suggestion.value
                this.$emit('input', this.$refs.input.value)
                this.autosave()
            },
            minChars: this.minChars,
            maxHeight: 240
        })
    },
    methods: {
        autosave() {
            if ( (this.value !== undefined) && !this.readonly && (this.value != this.lastSave) ) {
                this.$emit('autosave', this.field)
                this.lastSave = this.value
            }
        }
    }
}
</script>
