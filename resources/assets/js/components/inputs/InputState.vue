<template>
    <div :class="state.themeClass"><!-- class provide state border color -->
        <label class="control-label">{{ label }}</label>
        <input 
            :type="type"
            class="form-control"
            :value="value"
            :disabled="disabled"
            @input="oninput"
            @keydown="onkeydown"
            ref="input" />
        <span :class="state.iconClass"></span><!-- class provide state icon -->
        <span class="help-block" v-if="state.text != ''"><!-- show help text if necessary -->
            <i>{{ state.text }}</i>
        </span>
    </div>
</template>

<script>
    export default {
        props: {
            type: { default: 'text'},                       // input's type
            value: { required: true },                      // input's value
            label: { default: 'label'},                     // input's label
            name: { default: 'data' },                      // input's name 
            serviceUrl: { default: null },                  // endpoint for database validation if necessary
            pattern: { default: '.' },                      // pattern for format validation
            disabled: { default: false },                   // disable input or not
            placeholderStateText: { default: '' },          // placholer as state text
            invalidResponseText: { default: 'invalid input format' }
        },
        data() {
            return {
                state: {
                    themeClass: 'form-group-sm has-feedback',
                    iconClass: 'form-control-feedback',
                    text: ''
                }
            }
        },
        computed: {
            regex() {
                if ( this.pattern == 'email' ) {
                    return new RegExp(/(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9]))\.){3}(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9])|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/)
                }
                return new RegExp(this.pattern)
            }
        },
        watch: {
            pattern(pattern) {
                this.onkeydown()
            }
        },
        created () {
            this.onkeydown = _.debounce(this.validate, 800)
            this.state.text = this.placeholderStateText
        },
        methods: {
            validate() {
                if ( this.$refs.input.value != '' ) {
                    if ( this.$refs.input.value.match(this.regex) !== null ) { // valid pattern
                        if ( this.serviceUrl ) { // perform backend validation if needed
                            this.state.iconClass = 'fa fa-circle-o-notch fa-spin form-control-feedback'
                            this.$emit('disabled', true)
                            axios.post(this.serviceUrl, {
                                    field: this.name,
                                    value: this.$refs.input.value
                                 })
                                 .then((response) => {
                                    this.$emit('disabled', false)
                                    switch (response.data.state) {
                                        case 'success':
                                            this.setState({
                                                theme: 'has-success',
                                                icon: 'glyphicon glyphicon-ok',
                                                text: '',
                                                payload: response.data.payload
                                            })
                                            break
                                        case 'warning':
                                            this.setState({
                                                    theme: 'has-warning',
                                                    icon: 'glyphicon glyphicon-warning-sign',
                                                    text: response.data.reply_text,
                                                    payload: response.data.payload
                                                })
                                            break
                                        case 'error':
                                            this.setState({
                                                    theme: 'has-error',
                                                    icon: 'glyphicon glyphicon-remove',
                                                    text: response.data.reply_text,
                                                    payload: response.data.payload
                                                })
                                            break
                                        default:
                                            this.setState({ 
                                                    theme: 'has-error',
                                                    icon: 'glyphicon glyphicon-remove',
                                                    text: 'Whoops, someting went wrong. Plase try again.'
                                                })
                                            break
                                    }
                                 })
                                 .catch((error) => {
                                    this.$emit('error', error)
                                    this.$emit('disabled', false)
                                    this.state.iconClass = 'form-control-feedback'
                                 })
                        } else {
                            this.setState({ theme: 'has-success', icon: 'glyphicon glyphicon-ok', text: '' })
                        }
                    } else {
                        this.setState({
                                theme: 'has-error',
                                icon: 'glyphicon glyphicon-remove',
                                text: this.invalidResponseText
                            })
                    }
                } else {
                    this.setState({ theme: '', icon: '', text: this.placeholderStateText })
                }
            },
            oninput () {
                this.setState({ theme: '', icon: '', text: this.placeholderStateText })
                this.$emit('input', this.$refs.input.value)
            },
            setState(state) {
                this.state.themeClass = 'form-group-sm has-feedback ' + state.theme
                this.state.iconClass = 'form-control-feedback ' + state.icon
                this.state.text = state.text
                if ( state.payload !== undefined ) {
                    this.$emit('validated', (state.theme == 'has-success'), state.payload)
                } else {
                    this.$emit('validated', (state.theme == 'has-success'))
                }                
            }
        }
    }
</script>
