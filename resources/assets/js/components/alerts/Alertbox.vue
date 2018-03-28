<template>
    <transition name="slide-fade">
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
        font-size: 1em;
        width: 400px;
        position: fixed;
        top: 105px;
        right: 15px;
        z-index:10;
    }

    #alert-icon {
        font-size:2em;
        float:left;
        margin-right: .5em;
    }
</style>
