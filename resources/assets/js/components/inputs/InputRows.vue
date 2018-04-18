<template>
    <div class="form-horizontal">
        <div class="form-group-sm">
            <div class="col-xs-11">
                <textarea class="form-control input-sm" v-model="value" rows="1" @keydown.enter.prevent="submit"></textarea>
            </div>
            <div class="col-xs-1" style="padding-top: 4px; padding-left: 4px;">
                <span class="badge badge-info" role="button"><i class="fa fa-plus"></i></span>
                <span class="badge badge-danger" role="button"><i class="fa fa-trash"></i></span>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                value: null
            }
        },
        methods: {
            submit () {
                // e.preventDefault()
                console.log(this.value)
                // this.value.toString().replace(/(?:\r\n|\r|\n)/g, '')
                // autosize.update($('textarea'))
                // console.log(this.value)
            }
        }
    }
</script>
