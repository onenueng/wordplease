<template>
    <div :class="getGrid()">
        <div class="form-group-sm">
            <label  class="control-label"
                    v-if="label != undefined"
                    :for="field">
                    {{ label }}
            </label>
            <textarea   :class="controlClass"
                        :readonly="readonly"
                        :name="field"
                        :id="field"
                        :maxlength="maxChars" 
                        :placeholder="placeholderNew"
                        v-model="userInput"
                        @input="oninput()"
                        @blur="autosave()"
                        @focus="onfocus()"
                        rows="1">
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
            placeholder: {
                type: String,
                required: false
            },
            maxChars: {
                type: String,
                required: false
            },
            setterEvent: {
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
                charsRemaining: 0,
                placeholderNew: '',
            }
        },
        mounted () {
            if (this.value === undefined)
                this.userInput = ''
            else
                this.userInput = this.value

            if (this.placeholder !== undefined) {
                if (this.placeholder !== undefined) {
                    this.placeholderNew = this.placeholder + ' - ' + this.getMaxChars + ' chars max'
                } else {
                    this.placeholderNew = this.placeholder
                }
            }

            if (this.setterEvent !== undefined) {
                EventBus.$on(this.setterEvent, (value, mode = 'put') => {
                    if (mode == 'put') {
                        this.userInput = value;
                    } else {
                        if (this.userInput == '') {
                            this.userInput += (value)
                        } else {
                            this.userInput += ('\n' + value)
                        }
                    }
                    this.dirty = true
                    this.autosave()
                })
            }

            autosize($(this.domRef))
            this.onkeypress = _.debounce(() => {
                let countChars = this.userInput.length
                if (countChars > (.5*this.getMaxChars)) {
                    this.charsRemaining = this.getMaxChars - this.userInput.length
                    this.showCharsRemaining = true
                    if (countChars > (.75*this.getMaxChars)) {
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
                let divClass = ''
                if (this.grid == undefined) {
                    divClass = ''
                } else {
                    // let grid = this.grid.split('-').map((x) => 12/x)
                    let grid = this.grid.split('-')
                    divClass = 'col-xs-' + (grid[0]) + ' col-sm-' + (grid[1]) + ' col-md-' + (grid[2])
                }

                if (this.label === undefined) {
                    divClass += ' fix-margin'
                }
                return divClass
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

                // seem like Vue delay update so, we delay autosize process to take effect
                setTimeout(() => { autosize.update($(this.domRef)) }, 100)

            },
            oninput() {

                if (!this.dirty && (this.userInput.length < this.getMaxChars)) {
                    this.dirty = true
                }
                
                
                if (this.showCharsRemaining) {
                    this.charsRemaining = this.getMaxChars - this.userInput.length
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
                if(this.userInput.length == this.getMaxChars) {
                    this.toggleStatus('danger')
                }
            }
        },
        computed: {
            getMaxChars() {
                return (this.maxChars === undefined) ? 255 : this.maxChars
            }
        }
    }
</script>

<style>
    .fix-margin {
        margin-top: .3em;
    }

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
