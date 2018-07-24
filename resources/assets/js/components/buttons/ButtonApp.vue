<template>
    <button :id="id"
            @click="click"
            v-html="label"
            :tabindex="tabStop"
            :class="buttonClass"
            :disabled="disable ? '' : null"
    ></button>
</template>

<script>
    export default {
        props: {
            action: { default: () => ({ event: 'click', payload: null }) },
            size: { default: false },
            label: { required: true },
            disable: { default: null },
            status: { required: true },
            noTapStop: { required: false }
        },
        computed: {
            id () {
                return Date.now() + '-' + Math.floor(Math.random() * (1000 - 0 + 1)) + 0
            },
            buttonClass () {
                return 'btn-app btn-app-' + this.status + ( !this.size ? '' : (' btn-' + this.size))
            },
            tabStop () {
                return ( this.noTapStop === undefined ) ? null : -1
            }
        },
        methods: {
            click(e) {

                this.$emit(this.action.event, this.action.payload)

                const element = $('#' + this.id)

                if (element.find(".circle").length == 0) {
                    element.prepend("<span class='circle'></span>")
                }

                const circle = element.find(".circle")
                circle.removeClass("animate")

                if (!circle.height() && !circle.width()) {
                    const d = Math.max(element.outerWidth(), element.outerHeight())
                    circle.css({height: d, width: d})
                }

                const x = e.pageX - element.offset().left - circle.width()/2
                const y = e.pageY - element.offset().top - circle.height()/2

                circle.css({top: y+'px', left: x+'px'}).addClass("animate")
            }
        }
    }
</script>

<style>

    button {
        overflow: hidden;
        outline: none;
        /*display: block;*/
        user-select: none;
        position: relative;
        overflow: hidden;
    }

    .circle {
        /*display: block; */
        position: absolute;
        background: rgba(0,0,0,.075);
        border-radius: 50%;
        transform: scale(0);
    }

    .circle.animate {
        animation: effect 0.65s linear;
    }

    @keyframes effect {
        100% {
            opacity: 0;
            transform: scale(2.5);
        }
    }
    /* end click effect */
    button:focus {
        outline: none !important;
    }

    .btn-app {

        border-radius: 2px;
        border: 0;
        transition: .2s ease-out;
        color: #fff;
        margin-bottom: 10px;

        -webkit-box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
        -moz-box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
        box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
        transition: all 0.3s cubic-bezier(.25,.8,.25,1);
    }

    .btn-app:hover {
        color: #616161 !important;

        -webkit-box-shadow: 0 4px 8px rgba(0,0,0,0.25), 0 5px 5px rgba(0,0,0,0.22);
        -moz-box-shadow: 0 4px 8px rgba(0,0,0,0.25), 0 5px 5px rgba(0,0,0,0.22);
        box-shadow: 0 4px 8px rgba(0,0,0,0.25), 0 5px 5px rgba(0,0,0,0.22);

        -webkit-transition: color .3s ease-out;
        -moz-transition: color .3s ease-out;
        -o-transition: color .3s ease-out;
        transition: color .3s ease-out;
    }

    .btn-app:active, .btn-app:focus, .btn-app.active {
        outline: 0;
    }

    /*draft*/
    .btn-app-draft {
        color: #636b6f !important;
        background: #f5f5f5 !important;
    }
    .btn-app-draft:hover, .btn-app-draft:focus {
        color: #fff !important;
        background: #eee !important;
    }
    .btn-app-draft.active {
        color: #fff !important;
        background: #eee !important;
    }

    /*Default*/
    .btn-app-default {
        color: #fff !important;
        background: #2BBBAD !important;
    }
    .btn-app-default:hover, .btn-app-default:focus {
        background: #30cfc0 !important;
    }
    .btn-app-default.active {
        background: #186860 !important;
    }

    /*Primary*/
    .btn-app-primary {
        background: #4285F4 !important;
    }

    .btn-app-primary:hover, .btn-app-primary:focus {
        background-color: #5a95f5 !important;
    }

    .btn-app-primary.active {
        background-color: #0b51c5 !important;
    }

    /*Secondary*/
    .btn-app-secondary {
        background-color: #aa66cc !important;
    }
    .btn-app-secondary:hover, .btn-app-secondary:focus {
        background-color: #b579d2 !important;
        color: #fff;
    }
    .btn-app-secondary.active {
        background-color: #773399 !important;
    }
    .btn-app-secondary.active:hover {
        color: #fff;
    }

    /*Success*/
    .btn-app-success {
        background: #00C851;
    }
    .btn-app-success:hover, .btn-app-success:focus {
        background-color: #00d255 !important;
    }
    .btn-app-success.active {
        background-color: #006228 !important;
    }

    /*Info*/
    .btn-app-info {
        background: #33b5e5;
    }
    .btn-app-info:hover, .btn-app-info:focus {
        background-color: #4abde8 !important;
    }
    .btn-app-info.active {
        background-color: #14799e !important;
    }

    /*Warning*/
    .btn-app-warning {
        background: #FF8800;
    }
    .btn-app-warning:hover, .btn-app-warning:focus {
        background-color: #ff961f !important;
    }
    .btn-app-warning.active {
        background-color: #cc8800 !important;
    }

    /*Danger*/
    .btn-app-danger {
        background: #CC0000;
    }
    .btn-app-danger:hover, .btn-app-danger:focus {
        background-color: #db0000 !important;
    }
    .btn-app-danger.active {
        background-color: maroon !important;
    }

    /*Link*/
    .btn-app-link {
        background-color: transparent;
        color: #000;
    }
    .btn-app-link:hover, .btn-app-link:focus {
        background-color: transparent;
        color: #000;
    }
</style>
