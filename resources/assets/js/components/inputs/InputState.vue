<template>
    <div :class="divState">
        <label for="" class="control-label">{{ label }}</label>
        <input type="text" class="form-control" @blur="checkState()" @focus="focus()" v-model="userInput">
        <span :class="iconStateClass"></span>
        <span class="help-block"><i>{{ helpText }}</i></span>
    </div>
</template>

<script>
    export default {
        props: {
            label: {
                type: String,
                required: true
            },
            field: {
                type: String,
                required: true
            },
            serviceUrl: {
                type: String,
                required: false
            },
            initHelpText: {
                type: String,
                required: false
            },
            pattern: {
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
                if ( this.pattern !== null ) {
                    if ( this.pattern == 'email' ) {
                        return new RegExp(/(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9]))\.){3}(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9])|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/)
                    }
                    return new RegExp(this.pattern)
                }
                return new RegExp(/./)
            }
        },
        mounted() {
            if ( this.initHelpText != undefined ) {
                this.helpText = this.initHelpText
            }
        },
        methods: {
            checkState() {
                if ( this.userInput != '' && this.regex != null ) {
                    if ( this.userInput.match(this.regex) !== null ) {
                        console.log('valid ' + this.field)
                        axios.post(this.serviceUrl, {
                            field: this.field,
                            value: this.userInput
                        })
                        .then((response) => {
                            console.log(response.data)
                            let valid = false;
                            this.divState = 'form-group-sm has-feedback has-' + response.data.state
                            this.iconStateClass = 'glyphicon form-control-feedback '
                            switch (response.data.state) {
                                case 'success':
                                    this.iconStateClass += 'glyphicon-ok'
                                    this.helpText = ''
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
                            EventBus.$emit( this.field + '-state', valid )
                            if (valid) {
                                EventBus.$emit( this.field + '-value', this.userInput )
                            }
                        })
                        .catch((error) => {
                            console.log(error)
                        })
                    } else {
                        this.divState = 'form-group-sm has-feedback has-error'
                        this.iconStateClass = 'glyphicon form-control-feedback glyphicon-remove'
                        this.helpText = 'invalid input format'
                    }
                }
            },
            focus() {
                this.divState = 'form-group-sm has-feedback'
                this.iconStateClass = 'form-control-feedback'
                if ( this.initHelpText !== null ) {
                    this.helpText = this.initHelpText
                }
            }
        }
    }
</script>
