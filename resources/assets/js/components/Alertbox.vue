<template>
    <transition name="slide-fade">
        <div  :class="this.class" role="alert" id="alert-box">
            <button type="button" class="close" @click="noShow()" aria-label="Close">
                <span aria-hidden="true">
                    <span class="fa fa-times-circle"></span>
                </span>
            </button>
            <span :class="this.setIcon()" id="alert-icon"></span>
            <p v-html="message"></p>
        </div>
    </transition>
</template>

<script>
    export default {
        props: ['message', 'status', 'duration'],
        data () {
            return {
                class: "alert alert-dismissible fade in alert-" + this.status,
                icon: ''
            }
        },
        mounted () {
            this.timer = setTimeout(() => { EventBus.$emit('close-alert') }, this.duration);
            this.setIcon();
        },
        methods: {
            noShow() {
                clearTimeout(this.timer)
                EventBus.$emit('close-alert')
            },
            setIcon() {
                switch (this.status) {
                    case 'warning':
                        return 'fa fa-exclamation-circle';
                    case 'danger':
                        return 'fa fa-warning';
                    default:
                        return 'fa fa-info-circle';    
                }
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
