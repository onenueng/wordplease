<template>
    <div :class="getGrid()">
        <div class="form-group-sm">
            <label class="control-label" :for="field">{{ label }}</label>
            <textarea :class="controlClass"
                      :readonly="readonly"
                      :name="field"
                      :id="field"
                      v-model="userInput"
                      @input="oninput()"
                      @blur="autosave()"
                      @focus="onfocus()"
                      rows="1"
                      :maxlength="maxChars" >
            </textarea>
            <transition name="slide-fade">
                <p :class="helperClass" v-if="showCharsRemaining"><strong>{{ charsRemaining }} chars remain.</strong></p>
            </transition>
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
            // allow user type-in or not, Just mention this option.
            readonly: {
                type: String,
                required: false
            },
            maxChars: {
                type: String,
                required: false  
            }
        },
        data () {
            return {
                userInput: '',
                domRef: 'textarea[name=' + this.field + ']',
                dirty: false,
                controlClass: 'form-control',
                helperClass: 'text-muted',
                showCharsRemaining: false,
                charsRemaining: 0
            }
        },
        mounted () {
            if (this.value === undefined)
                this.userInput = ''
            else
                this.userInput = this.value

            autosize($(this.domRef))
            this.onkeypress = _.debounce(() => {
                let countChars = this.userInput.length
                if (countChars > (.5*this.maxChars)) {
                    this.charsRemaining = this.maxChars - this.userInput.length
                    this.showCharsRemaining = true
                    if (countChars > (.75*this.maxChars)) {
                        this.toggleStatus('danger')
                    } else {
                        this.toggleStatus('warning')
                    }
                } else {
                    this.toggleStatus('')
                }
            }, 300);
            this.onkeypressSave = _.debounce(() => { this.autosave() }, 5000)
        },
        methods: {
            getGrid() {
                let grid = this.grid.split('-').map((x) => 12/x)
                return 'col-xs-' + (grid[0]) + ' col-sm-' + (grid[1]) + ' col-md-' + (grid[2])
            },
            autosave() {
                if ( this.readonly != '' && this.dirty) {
                    EventBus.$emit('autosave', this.field, this.userInput)
                    this.dirty = false
                    this.showCharsRemaining = false
                    this.toggleStatus('')
                }

                if(this.showCharsRemaining) {
                    this.showCharsRemaining = false
                }
            },
            oninput() {
                if(!this.dirty && (this.userInput.length < this.maxChars)) {
                    this.dirty = true
                }
                
                if(this.showCharsRemaining) {
                    this.charsRemaining = this.maxChars - this.userInput.length
                }
                this.onkeypress()
                this.onkeypressSave()
            },
            onkeypress() {
                // define on mounted
            },
            onkeypressSave() {
                // define on mounted
            },
            toggleStatus(status) {
                let baseClass = ''
                let subClass = ''
                let show = false
                switch (status) {
                    case 'warning':
                        baseClass = 'form-control textarea-warning'
                        subClass = 'text-warning'
                        show = true
                        break
                    case 'danger':
                        baseClass = 'form-control textarea-danger'
                        subClass = 'text-danger'
                        show = true
                        break
                    default :
                        baseClass = 'form-control'
                        subClass = 'text-muted'
                }
                if (this.controlClass != baseClass) {
                    this.controlClass = baseClass
                    this.helperClass = subClass
                    this.showCharsRemaining = show
                }
            },
            onfocus() {
                if(this.userInput.length == this.maxChars) {
                    this.toggleStatus('danger')
                }
            }
        }
    }
</script>

<style>
    .textarea-warning {
        /*Important stuff here*/
        -webkit-transition: flash-warning 3s ease-out;
        -moz-transition: flash-warning 3s ease-out;
        -o-transition: flash-warning 3s ease-out;
        transition: flash-warning 3s ease-out;
        animation: flash-warning 3s forwards linear normal;
    }
    @keyframes flash-warning {
        0% {
            background:#fff;
        }
        50% {
            background:#f0ad4e;
        }
        100% {
            background:#fff;
        }
    }
    .textarea-danger {
        /*Important stuff here*/
        -webkit-transition: flash-danger 3s ease-out;
        -moz-transition: flash-danger 3s ease-out;
        -o-transition: flash-danger 3s ease-out;
        transition: flash-danger 3s ease-out;
        animation: flash-danger 3s forwards linear normal;
    }
    @keyframes flash-danger {
        0% {
            background:#fff;
        }
        50% {
            background:#d9534f;
        }
        100% {
            background:#fff;
        }
    }
</style>
