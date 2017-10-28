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
        props: ['field', 'value', 'label', 'grid', 'serviceUrl'],
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
                minChars: 1,
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

