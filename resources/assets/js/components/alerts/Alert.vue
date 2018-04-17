<template>
    <div :class="animatedClass">
        <div :class="alertState" role="alert" id="xxx">
            <div class="row vertical-centered">
                <div class="col-xs-2 text-center">
                    <i :class="icon"></i>
                </div>
                <div class="col-xs-10" v-html="content">
                </div>
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
            },
            animated: {
                type: String,
                required: false
            }
        },
        data() {
            return {
                alertState: 'alert alert-' + this.state
            }
        },
        mounted() {
            if ( this.animated !== undefined ) {
                this.alertState = this.alertState + ' animated ' + this.animated
            }
        },
        computed: {
            animatedClass() {
                if ( this.animated !== undefined ) {
                    return 'animated ' + this.animated
                }
                return ''
            }
        }
    }
</script>
