<template>
    <div :class="getGrid()">
        <div class="form-group-sm has-feedback">
            <label class="control-label" :for="field">
                {{ label }}
                <a @click="reset()" role="button" v-show="showReset"><i class="fa fa-remove"></i></a>
            </label>
            <input
                type="text"
                class="form-control"
                :name="field"
                v-model="userInput"
                @blur="onblur()"
                @input="showReset = (userInput != '')"
                :onkeypress="this.isAllowOther()" />
            <i class="fa fa-chevron-down form-control-feedback"></i>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['field', 'value', 'label', 'grid', 'serviceUrl', 'minChars', 'notAllowOther'],
        data () {
            return {
                userInput: '',
                domRef: 'input[name=' + this.field + ']',
                showReset: false,
                data: '',
                lastData: ''
            }
        },
        mounted () {
            this.userInput = this.value;
            $(this.domRef).autocomplete({
                serviceUrl: this.serviceUrl,
                onSelect: (suggestion) => {
                    this.showReset = true;
                    this.data = suggestion.data;
                    this.userInput = suggestion.value;
                    app.$data.autosaving = true;
                    this.autosave();

                },
                minChars: this.minChars,
                maxHeight: 200
            });
            this.autosave = _.debounce( () => {
                if ( this.field != '') {
                    let value = (this.data != '') ? this.data : this.userInput;
                    axios.post('/autosave', JSON.parse('{"' + this.field + '": "' + value + '"}'))
                         .then((response) => { console.log(response.data); app.$data.autosaving = false; })
                         .catch((error) => { console.log(error); app.$data.autosaving = false; });
                    this.lastData = this.data;
                    this.data = '';
                }
            }, 1000);
        },
        methods: {
            getGrid() {
                let grid = this.grid.split('-').map((x) => 12/x);
                return 'col-xs-' + (grid[0]) + ' col-sm-' + (grid[1]) + ' col-md-' + (grid[2]);
            },
            autosave() {
                
            },
            getRegex() {
                return 'hello regex';
            },
            reset() {
                this.showReset = false;
                this.userInput = '';
                this.onblur();
            },
            isAllowOther() {
                return this.notAllowOther === undefined ? 'return true;' : 'return false;' ;
            },
            onblur() {
                app.$data.autosaving = true;
                this.autosave();
            }
        }
    }
</script>
