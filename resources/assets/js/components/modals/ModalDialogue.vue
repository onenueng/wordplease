<template>
    <div class="modal fade"
         tabindex="-1"
         role="dialog"
         id="modal-dialogue"
         data-backdrop="static"
         data-keyboard="false">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header"><span class="fa fa-comment-o"></span> {{ heading }}</div>
                <div class="modal-body">{{ message }}</div>
                <div class="modal-footer">
                    <button-app
                        size="lg"
                        :label="buttonLabel"
                        @click="$emit('modalDialogueDismiss')"
                        status="draft" />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import ButtonApp from '../buttons/ButtonApp.vue'

    export default {
        components: {
            ButtonApp
        },
        props: {
            toggle: { default: false },
            heading: { default: 'hello' },
            message: { default: '01110111 01101111 01110010 01100100 01110000 01101100 01100101 01100001 01110011 01100101'},
            buttonLabel: { default: 'Got it'}
        },
        watch: {
            toggle(toggle) {
                $('#modal-dialogue').modal(toggle ? 'show' : 'hide')
            }
        }
    }
</script>

<style>
    .modal {
      text-align: center;
      padding: 0!important;
    }

    .modal:before {
      content: '';
      display: inline-block;
      height: 100%;
      vertical-align: middle;
      margin-right: -4px;
    }

    .modal-dialog {
      display: inline-block;
      text-align: left;
      vertical-align: middle;
    }
</style>
