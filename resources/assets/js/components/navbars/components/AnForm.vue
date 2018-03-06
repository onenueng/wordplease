<template>
    <form class="navbar-form navbar-left">
        <div :class="statusClass">
            <input
                placeholder="AN to create note"
                data-toggle="tooltip"
                class="form-control"
                @input="checkAn()"
                id="an-input"
                v-model="an"
                type="text"/>
            <span :class="iconStatusClass"></span>
        </div>
    </form>
</template>

<script>
    export default {
        props: {
            pattern: {
                type: String,
                required: true
            }
        },
        data () {
            return {
                an : '',
                isTooltip: false,
                statusClass: 'form-group has-feedback',
                iconStatusClass: 'form-control-feedback',
            }
        },
        computed : {
            validator() {
                return new RegExp(this.pattern)
            }
        },
        methods : {
            checkAn () {
                // defind on mounted
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
                    EventBus.$emit('an-checked', false, this.an)
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
                    EventBus.$emit('an-checked', true, this.an)
                    this.statusClass = 'form-group has-feedback has-success'
                    this.iconStatusClass = 'form-control-feedback fa fa-check'
                    this.assignTooltip('')
                }
            }, 800)

            $('#an-input').tooltip({
                placement: "bottom",
                trigger: "hover",
                delay: { "show": 100, "hide": 500 }
            })
        }
    }
</script>
