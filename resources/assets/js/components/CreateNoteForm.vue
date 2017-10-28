<template>
    <form method="POST" class="navbar-form navbar-left" action="/notes" id="form-create-note">
        <!-- 
        <input type="hidden" id="note_content_id" name="note_content_id" />
        <input type="hidden" id="note_type_id" name="note_type_id" />
        <input type="hidden" name="_action" id="action" />
         
        <input type="text" v-model="an" @input="debouncer()" class="form-control" autocomplete="off" placeholder="AN" />
        -->
        <div :class="statusClass">
            <input
                id="an"
                type="text"
                class="form-control"
                autocomplete="off"
                placeholder="AN to create note"
                data-toggle="tooltip"
                v-model="an"
                @input="debouncer()" />
            <span :class="iconStatusClass"></span>
        </div>
    </form>
</template>

<script>
    export default {
        props: ['pattern', 'isValidAn'],
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
            debouncer () {

            },
            assignTolltip (message) {
                $('#an').attr('data-original-title', message);
                if (message != '') {
                    if (!this.isTooltip) {
                        $('#an').tooltip('show');
                        this.isTooltip = true;
                    }
                } else {
                    if (this.isTooltip) {
                        $('#an').tooltip('hide');
                        this.isTooltip = false;
                    }
                }
            }
        },
        mounted () {
            this.debouncer = _.debounce( () => {
                if (!this.validator.test(this.an)) {
                    this.$emit('invalidAn');
                    if (this.an == '') {
                        this.statusClass = 'form-group has-feedback';
                        this.iconStatusClass = 'form-control-feedback';
                        this.assignTolltip('');
                        
                    } else {
                        this.statusClass = 'form-group has-feedback has-warning';
                        this.iconStatusClass = 'form-control-feedback fa fa-warning';
                        this.assignTolltip('an ที่ใส่มาไม่ถูกต้องตามรูปแบบนะจ๊ะ');
                    }
                } else {
                    this.$emit('validAn');
                    this.statusClass = 'form-group has-feedback has-success';
                    this.iconStatusClass = 'form-control-feedback fa fa-check';
                    this.assignTolltip('');
                }
            }, 500);
            $('#an').tooltip({
                placement: "bottom",
                trigger: "hover",
                delay: { "show": 100, "hide": 500 }
            });
        }
    }
</script>
