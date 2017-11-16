<template>
    <div :class="getGrid()">
        <div class="form-group-sm">
            <label class="control-label" :for="field">{{ label }}</label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lightbulb-o"></i></span>
                <input
                    type="text"
                    class="form-control"
                    :name="field"
                    v-model="userInput"
                    @blur="autosave()" />
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['field', 'value', 'label', 'grid', 'serviceUrl', 'minChars'],
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
            // min chars to trigger suggestions.
            minChars: {
                type: String,
                required: true  
            },
        },
        data () {
            return {
                userInput: '',
                domRef: 'input[name=' + this.field + ']',
                data: ''
            }
        },
        mounted () {
            this.userInput = this.value;
            $(this.domRef).autocomplete({
                serviceUrl: "/get-ajax",
                onSelect: (suggestion) => {
                    this.data = suggestion.data;
                    this.autosave();
                },
                minChars: this.minChars === undefined ? 1 : this.minChars,
                maxHeight: 200
            });
        },
        methods: {
            getGrid() {
                let grid = this.grid.split('-').map((x) => 12/x);
                return 'col-xs-' + (grid[0]) + ' col-sm-' + (grid[1]) + ' col-md-' + (grid[2]);
            },
            autosave() {
                if ( this.data != '') {
                    axios.post('/autosave', JSON.parse('{"' + this.field + '": "' + this.data + '"}'))
                         .then((response) => { console.log(response.data) })
                         .catch((error) => { console.log(error) })
                }
            },
            getRegex() {
                return 'hello regex';
            }
        }
    }
</script>

