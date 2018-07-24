<template>
    <div class="modal fade" tabindex="-1" role="dialog" id="modal-dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="fa fa-comment-o"></span> {{ heading }}
                </div>
                <div class="modal-body">
                    {{ message }}
                </div>
                <div class="modal-footer">
                    <button-app
                        size="lg"
                        :label="buttonLabel"
                        @click="closeDialog"
                        status="draft">
                    </button-app>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import ButtonApp from '../buttons/ButtonApp.vue'

    export default {
        components: {
            'button-app': ButtonApp
        },
        data () {
            return {
                heading: '',
                message: '',
                buttonLabel: ''
            }
        },
        mounted() {
            EventBus.$on('toggle-modal-dialog', (message,
                                                 heading = 'Wordplease says',
                                                 buttonLabel = 'OK',
                                                 toggle = 'toggle') => {
                if ( message === undefined ) {
                    $('#modal-dialog').modal('hide')
                } else {
                    this.message = message
                    this.heading = heading
                    this.buttonLabel = buttonLabel
                    this.toggle = toggle
                    $('#modal-dialog').modal(toggle)
                }
            })

            EventBus.$on('show-common-dialog', (code = '') => {
                switch (code) {
                    case 'error-419':
                        this.message = 'Your are now logged off, Please reload this page or loss your data.'
                        this.heading = 'Attention please !!'
                        this.buttonLabel = 'Got it'
                        $('#modal-dialog').modal('show')
                        break
                    case 'error-500':
                        this.message = 'Server error, Please try again later or get the Helpdesk.'
                        this.heading = 'Attention please !!'
                        this.buttonLabel = 'Got it'
                        $('#modal-dialog').modal('show')
                        break
                    defualt :
                        this.message = '01110111 01101111 01110010 01100100 01110000 01101100 01100101 01100001 01110011 01100101'
                        this.heading = 'Attention please !!'
                        this.buttonLabel = 'Got it'
                        $('#modal-dialog').modal('show')
                        break
                }
            })
        },
        methods: {
            closeDialog () {
                $('#modal-dialog').modal('hide')
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
