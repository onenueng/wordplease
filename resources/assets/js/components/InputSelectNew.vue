<template>
    <div :class="getGrid()">
        <div class="form-group has-feedback">
            <label class="control-label" for="inputSuccess4">Input with success</label>
            
            <input
                type="text"
                class="form-control"
                :name="field"
                v-model="userInput"
                @blur="onblur()"
                @input="showReset = (userInput != '')"
                :onkeypress="isAllowOther()" />
            <span class="fa fa-check form-control-feedback" aria-hidden="true"></span>
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
                lastData: ''
            }
        },
        mounted () {
            this.lastData = this.userInput = this.value;
            this.showReset = (this.value != '');
            $(this.domRef).autocomplete({
                serviceUrl: this.serviceUrl,
                onSelect: (suggestion) => {
                    this.showReset = true;
                    this.data = suggestion.data;
                    this.userInput = suggestion.value;
                    this.autosave();
                },
                minChars: this.minChars,
                maxHeight: 200
            });
            this.autosave = _.debounce( () => {
                if ( this.field != '') {
                    app.$data.autosaving = true;
                    if (this.userInput != this.lastData) {
                        axios.post('/autosave', JSON.parse('{"' + this.field + '": "' + this.userInput + '"}'))
                             .then((response) => { console.log(response.data); app.$data.autosaving = false; })
                             .catch((error) => { console.log(error); app.$data.autosaving = false; });
                        this.lastData = this.userInput;
                    } else {
                        app.$data.autosaving = false;
                    }
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
            reset() {
                this.showReset = false;
                this.userInput = '';
                this.onblur();
            },
            isAllowOther() {
                return this.notAllowOther === undefined ? 'return true;' : 'return false;' ;
            },
            onblur() {
                this.autosave();
            },
            focusInput() {
                $('input[name=' + this.field + ']').focus();
            }
        }
    }
</script>
