<template>
    <div :class="alertState" role="alert">
        <div class="row vertical-centered">
            <div class="col-xs-2 text-center">
                <i :class="icon"></i> 
            </div>
            <div class="col-xs-10" v-html="content">
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            state: {
                type: String,
                required: true
            },
            icon: {
                type: String,
                required: true
            },
            content: {
                type: String,
                required: true
            }
        },
        data() {
            return {
                alertState: 'alert alert-' + this.state
            }
        }
    }
</script>

<style>
    
</style>
