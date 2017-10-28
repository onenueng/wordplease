<template>
    <div :class="getGrid()">
        <div class="form-group-sm">
            <label class="control-label" :for="field">{{ label }}</label>
            <input
                type="text"
                class="form-control"
                :readonly="readonly"
                :name="field"
                v-model="userInput"
                @input="fx()"
                @blur="autosave()" />
        </div>
    </div>
</template>

<script>
    export default {
        props: ['field', 'value', 'label', 'grid', 'readonly'],
        data () {
            return {
                userInput: ''
            }
        },
        mounted () {
            this.userInput = this.value;
        },
        methods: {
            getGrid() {
                let grid = this.grid.split('-').map((x) => 12/x);
                return 'col-xs-' + (grid[0]) + ' col-sm-' + (grid[1]) + ' col-md-' + (grid[2]);
            },
            autosave() {
                if ( this.readonly != '') {
                    axios.post('/autosave', JSON.parse('{"' + this.field + '": "' + this.userInput + '"}'))
                         .then((response) => { console.log(response.data) })
                         .catch((error) => { console.log(error) })
                }
            }
        }
    }
</script>
