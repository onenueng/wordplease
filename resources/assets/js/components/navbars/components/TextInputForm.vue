<template>
    <form class="navbar-form navbar-left">
        <div :class="state.themeClass">
            <input
                class="form-control"
                type="text"
                id="text-input-form"
                data-toggle="tooltip"
                autocomplete="off"
                :placeholder="placeholder"
                :disabled="disabled"
                v-model="value"
                @keydown="onkeydown"
                @focus="onfocus()"
                @input="assignTooltip('')" />
            <span :class="state.iconClass"></span>
        </div>
    </form>
</template>

<script>
    export default {
        props: {
            pattern: { default: "." },
            disabled: { default: false },
            placeholder: { default: '' },
            tooltip: { default: '' }
        },
        data () {
            return {
                value: '',
                state: {
                    themeClass: 'form-group has-feedback ',
                    iconClass: 'form-control-feedback '
                },
                lastState: {}
            }
        },
        watch: {
            disabled (disabled) {
                if ( disabled ) {
                    this.lastState.themeClass = this.state.themeClass
                    this.lastState.iconClass  = this.state.iconClass
                    this.state.themeClass = 'form-group has-feedback',
                    this.state.iconClass  = 'form-control-feedback fa fa-circle-o-notch fa-spin'
                } else {
                    this.state.themeClass = this.lastState.themeClass
                    this.state.iconClass  = this.lastState.iconClass
                }
            },
            tooltip (tooltip) {
                if (tooltip !== '') {
                    this.state.themeClass = 'form-group has-feedback has-warning',
                    this.state.iconClass  = 'form-control-feedback fa fa-warning'
                    this.assignTooltip(tooltip)
                }
            }
        },
        computed : {
            regex () {
                return new RegExp(this.pattern)
            }
        },
        created () {
            this.onkeydown = _.debounce(this.validate, 800)
        },
        methods : {
            validate() {
                this.$emit('input', this.value)
                if ( this.value != '' ) {
                    if ( this.value.match(this.regex) !== null ) {
                        this.state.themeClass = 'form-group has-feedback has-success',
                        this.state.iconClass  = 'form-control-feedback fa fa-check'
                        this.$emit('validated', true)
                        this.assignTooltip('')
                    } else {
                        this.state.themeClass = 'form-group has-feedback has-warning',
                        this.state.iconClass  = 'form-control-feedback fa fa-warning'
                        this.$emit('validated', false)
                        this.assignTooltip('Invalid format')
                    }
                } else {
                    this.onfocus()
                }
            },
            onfocus () {
                this.value = ''
                this.state.themeClass = 'form-group has-feedback'
                this.state.iconClass  = 'form-control-feedback'
                this.$emit('validated', false)
                this.assignTooltip('')
            },
            assignTooltip (message) {
                if (message != '') {
                    $('#text-input-form').attr('data-original-title', message)
                    $('#text-input-form').tooltip('show')
                } else {
                    this.state.themeClass = 'form-group has-feedback'
                    this.state.iconClass  = 'form-control-feedback'
                    $('#text-input-form').tooltip('hide')
                }
            }
        },
        mounted () {
            $('#text-input-form').tooltip({
                placement: "bottom",
                trigger: "hover",
                delay: { "show": 100, "hide": 500 }
            })
        }
    }
</script>
