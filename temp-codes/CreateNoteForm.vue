<template>
    <!-- <form method="POST" class="navbar-form" action="/notes" id="form-create-note"> -->
    <form class="navbar-form navbar-left">
        <!-- 
        <input type="hidden" id="note_content_id" name="note_content_id" />
        <input type="hidden" id="note_type_id" name="note_type_id" />
        <input type="hidden" name="_action" id="action" />
         
        <input type="text" v-model="an" @input="debouncer()" class="form-control" autocomplete="off" placeholder="AN" />
        -->
        <div :class="statusClass">
            <input
                placeholder="AN to create note"
                data-toggle="tooltip"
                class="form-control"
                @input="checkAn()"
                autocomplete="off"
                v-model="an"
                type="text"
                id="an"/>
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
                validator : new RegExp(this.pattern),
                statusClass: 'form-group has-feedback',
                iconStatusClass: 'form-control-feedback',
                isTooltip: false
            }
        },
        methods : {
            checkAn () {

            },
            assignTooltip (message) {
                $('#an').attr('data-original-title', message)
                if (message != '') {
                    if ( !this.isTooltip ) {
                        $('#an').tooltip('show')
                        this.isTooltip = true
                    }
                } else {
                    if ( this.isTooltip ) {
                        $('#an').tooltip('hide')
                        this.isTooltip = false
                    }
                }
            }
        },
        mounted () {
            this.checkAn = _.debounce( () => {
                if (!this.validator.test(this.an)) {
                    this.$emit('invalid-an')
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
                    this.$emit('valid-an')
                    this.statusClass = 'form-group has-feedback has-success'
                    this.iconStatusClass = 'form-control-feedback fa fa-check'
                    this.assignTooltip('')
                }
            }, 800)
            $('#an').tooltip({
                placement: "bottom",
                trigger: "hover",
                delay: { "show": 100, "hide": 500 }
            })
        }
    }
</script>
