<template>
    <form class="navbar-form navbar-left">
        <div :class="state.themeClass">
            <input
                class="form-control"
                type="text"
                id="an-input"
                data-toggle="tooltip"
                placeholder="AN to create note"
                :disabled="state.disabled"
                v-model="an"
                @keydown="onkeydown"
                
                @focus="onfocus()" />
                <!-- @input="checkAn()" -->
            <span :class="state.iconClass"></span>
        </div>
    </form>
</template>

<script>
    export default {
        props: {
            pattern: { default: "^[0-9]{8}$" }
        },
        data () {
            return {
                an : '',
                disabled: false,
                isTooltip: false,
                statusClass: 'form-group has-feedback',
                iconStatusClass: 'form-control-feedback',

                validAn: ''
            }
        },
        computed : {
            regex () {
                return new RegExp(this.pattern)
            },
            state () {
                if ( this.validAn === true ) {
                    return {
                        disabled: false,
                        themeClass: 'form-group has-feedback has-success',
                        iconClass: 'form-control-feedback fa fa-check'
                    }
                } else if ( this.validAn === false ) {
                    return {
                        disabled: false,
                        themeClass: 'form-group has-feedback has-warning',
                        iconClass: 'form-control-feedback fa fa-warning'
                    }
                } else if ( this.validAn == 'busy' ) {

                } else { // default
                    return {
                        disabled: false,
                        themeClass: 'form-group has-feedback',
                        iconClass: 'form-group has-feedback'
                    }
                }
            }
        },
        created () {
            this.onkeydown = _.debounce(this.validate, 800)
        },
        methods : {
            validate() {
                if ( this.an != '' ) {
                    if ( this.an.match(this.regex) !== null ) {
                        this.validAn = true
                    } else {
                        this.validAn = false
                    }
                } else {
                    this.validAn = ''
                }
            },
            ////////
            checkAn () {
                // defind on mounted
            },
            onfocus () {
                this.an = ''
                this.statusClass = 'form-group has-feedback'
                this.iconStatusClass = 'form-control-feedback'
                this.assignTooltip('')
                // EventBus.$emit('an-checked', false, '')
            },
            assignTooltip (message) {
                $('#an-input').attr('data-original-title', message)
                if (message != '') {
                    if ( !this.isTooltip ) {
                        $('#an-input').tooltip('show')
                        this.isTooltip = true
                    }
                } else {
                    if ( this.isTooltip ) {
                        $('#an-input').tooltip('hide')
                        this.isTooltip = false
                    }
                }
            }
        },
        mounted () {
            this.checkAn = _.debounce( () => {
                if ( !this.validator.test(this.an) ) {
                    // EventBus.$emit('an-checked', false, this.an)
                    if (this.an == '') {
                        this.statusClass = 'form-group has-feedback'
                        this.iconStatusClass = 'form-control-feedback'
                        this.assignTooltip('')

                    } else {
                        this.statusClass = 'form-group has-feedback has-warning'
                        this.iconStatusClass = 'form-control-feedback fa fa-warning'
                        this.assignTooltip('an ที่ใส่มาไม่ถูกต้องตามรูปแบบนะจ๊ะ')
                    }
                } else {
                    // EventBus.$emit('an-checked', true, this.an)
                    this.disabled = ''
                    this.statusClass = 'form-group has-feedback'
                    this.iconStatusClass = 'form-control-feedback fa fa-circle-o-notch fa-spin'
                    this.assignTooltip('')
                }
            }, 800)

            $('#an-input').tooltip({
                placement: "bottom",
                trigger: "hover",
                delay: { "show": 100, "hide": 500 }
            })

            // EventBus.$on('anSearched', (canCreate) => {
            //     this.disabled = null
            //     if ( canCreate ) {
            //         this.statusClass = 'form-group has-feedback has-success'
            //         this.iconStatusClass = 'form-control-feedback fa fa-check'
            //     } else {
            //         this.statusClass = 'form-group has-feedback has-warning'
            //         this.iconStatusClass = 'form-control-feedback fa fa-warning'
            //     }
            // })
        }
    }
</script>
