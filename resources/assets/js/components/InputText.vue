<template>
    <div :class="getGrid()">
        <div :class="getSize()">
            <label v-if="hasLabel" class="control-label" :for="field">{{ label }}</label>
            <input
                type="text"
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
        props: ['field', 'value', 'label', 'grid', 'readonly', 'size', 'needSync', 'placeholder'],
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
            this.userInput = this.value
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
                    axios.post('/autosave', JSON.parse('{"' + this.field + '": "' + this.userInput + '"}'))
                         .then((response) => {
                            console.log(response.data)
                            this.lastSave = this.userInput
                         })
                         .catch((error) => { console.log(error) })
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
