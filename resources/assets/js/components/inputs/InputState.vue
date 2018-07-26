<template>
    <div :class="divState">
        <label for="" class="control-label">{{ label }}</label>
        <input type="text"
               class="form-control"
               @input="oninput()"
               @blur="checkState()"
               @focus="focus()"
               v-model="userInput"
               :disabled="inputDisable">
        <span :class="iconStateClass"></span>
        <span class="help-block"><i>{{ helpText }}</i></span>
    </div>
</template>

<script>
    export default {
        props: {
            label: { default: 'label'},
            field: { default: 'data' },
            serviceUrl: { default: null },
            initHelpText: { default: null },
            pattern: { default: '.' },
            inputValue: {
                type: String,
                required: true
            },
            isValid: {
                type: Boolean,
                required: true
            },
            inputDisable: {
                type: String,
                required: false
            }
        },
        data() {
            return {
                divState: 'form-group-sm has-feedback',
                helpText: '',
                iconStateClass: 'form-control-feedback',
                userInput: ''
            }
        },
        computed: {
            regex() {
                if ( this.pattern !== undefined ) {
                    if ( this.pattern == 'email' ) {
                        return new RegExp(/(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9]))\.){3}(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9])|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/)
                    }
                    return new RegExp(this.pattern)
                }
                return new RegExp(/./)
            }
        },
        mounted() {
            if ( this.initHelpText !== undefined ) {
                this.helpText = this.initHelpText
            }

            this.onkeypress = _.debounce(() => {
                this.checkState()
            }, 800)

            if ( this.inputDisable === undefined ) {
                this.inputDisable = null
            }

        },
            $infomed_host = config('app.infomed_host');
            $infomed_username = config('app.infomed_username');
            $infomed_password = config('app.infomed_password');
        methods: {
            checkStateWithApi() {
                axios.post(this.serviceUrl, {
                        field: this.field,
                        value: this.userInput
                     })
                     .then((response) => {
                        let valid = false;
                        this.divState = 'form-group-sm has-feedback has-' + response.data.state
                        this.iconStateClass = 'glyphicon form-control-feedback '
                        switch (response.data.state) {
                            case 'success':
                                this.setOKState()
                                valid = true
                                break
                            case 'warning':
                                this.iconStateClass += 'glyphicon-warning-sign'
                                this.helpText = response.data.reply_text
                                break
                            case 'error':
                                this.iconStateClass += 'glyphicon-remove'
                                this.helpText = response.data.reply_text
                                break
                            default:
                                this.iconStateClass += 'glyphicon-remove'
                                this.helpText = 'Whoops, someting went wrong. Plase try again.'
                                break
                        }
                        this.$emit('update:isValid', valid)
                     })
                     .catch((error) => {
                        console.log(error)
                     })
            },
            checkState() {
                if ( this.userInput !== '' ) {
                    this.$emit('update:inputValue', this.userInput)
                    if ( this.userInput.match(this.regex) !== null ) {
                        if ( this.serviceUrl !== undefined ) {
                            this.checkStateWithApi()
                        } else {
                            this.setOKState()
                            this.$emit('update:isValid', true)
                        }
                    } else {
                        this.divState = 'form-group-sm has-feedback has-error'
                        this.iconStateClass = 'glyphicon form-control-feedback glyphicon-remove'
                        this.helpText = 'invalid input format'
                        this.$emit('update:isValid', false)
                    }
                } else {
                    this.focus()
                    this.$emit('update:isValid', false)
                }
            },
            focus() {
                this.divState = 'form-group-sm has-feedback'
                this.iconStateClass = 'form-control-feedback'
                if ( this.initHelpText !== null ) {
                    this.helpText = this.initHelpText
                }
            },
            oninput() {
                this.onkeypress()
            },
             onkeypress() {
                // define on mounted
            },
            setOKState() {
                this.divState = 'form-group-sm has-feedback has-success'
                this.iconStateClass = 'glyphicon form-control-feedback glyphicon-ok'
                this.helpText = ''
            }
        }
    }
</script>
