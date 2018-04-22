<template>
    <transition name="custom-classes-transition"
                enter-active-class="animated bounceIn"
                leave-active-class="animated bounceOut">
        <div  v-if="show"
              role="alert"
              id="alert-box"
              :class="boxClass">
            <button type="button"
                    class="close"
                    @click="show = false">
                    <span class="fa fa-times-circle"></span>
            </button>
            <span :class="setIcon" id="alert-icon"></span>
            <p v-html="message" class="bigger-font-25"></p>
        </div>
    </transition>
</template>

<script>
    export default {
        data () {
            return {
                icon: '',
                show: false,
                status: '',
                message: '',
                duration: 5000
            }
        },
        mounted () {
            EventBus.$on('toggle-alert-box', (message = '', status = 'info', duration = 5000) => {
                this.setIcon()
                this.show = true
                this.status = status
                this.message = message
                this.duration = duration
                setTimeout(() => { this.show = false }, this.duration)
            })
        },
        methods: {
            setIcon() {
                switch (this.status) {
                    case 'warning':
                        return 'fa fa-exclamation-circle'
                    case 'danger':
                        return 'fa fa-warning'
                    default:
                        return 'fa fa-info-circle'
                }
            }
        },
        computed : {
            boxClass () {
                return "alert alert-dismissible fade in alert-" + this.status
            }
        }
    }
</script>

<style>
    #alert-box {
        width: 400px;
        position: fixed;
        top: 0px;
        right: 15px;
        z-index: 99999;
        border: 3px double;
        -webkit-box-shadow: 0 10px 6px -6px #777;
              -moz-box-shadow: 0 10px 6px -6px #777;
                   box-shadow: 0 10px 6px -6px #777;
    }

    #alert-icon {
        float:left;
        margin-right: .5em;
    }
</style>
