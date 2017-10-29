<template>
    <transition name="slide-fade">
        <div id="alert-box">
            <div :class="this.class" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">
                        <span class="fa fa-times-circle"></span>
                    </span>
                </button>
                <span :class="this.setIcon()" id="alert-icon"></span>
                <p><slot></slot></p>
            </div>
        </div>
    </transition>
</template>

<script>
    export default {
        props: ['status', 'duration'],
        data () {
            return {
                class: "alert alert-dismissible fade in alert-" + this.status,
                icon: ''
            }
        },
        mounted () {
            this._timeout = setTimeout(() => { app.$data.showAlertbox = false }, this.duration);
            this.setIcon();
        },
        methods: {
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

    .slide-fade-enter-active {
      /*transition: all .3s ease;*/
      transition: all .8s ease;
    }
    .slide-fade-leave-active {
      /*transition: all .8s cubic-bezier(1.0, 0.5, 0.8, 1.0);*/
      transition: all .3s cubic-bezier(1.0, 0.5, 0.8, 1.0);
    }
    .slide-fade-enter, .slide-fade-leave-to
    /* .slide-fade-leave-active below version 2.1.8 */ {
      transform: translateX(10px);
      opacity: 0;
    }
</style>
