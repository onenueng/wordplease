<template>
    <div class="modal fade" tabindex="-1" role="dialog" id="modal-dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    {{ heading }}
                </div>
                <div class="modal-body">
                    {{ message }}
                </div>
                <div class="modal-footer">
                    <button-app
                        size="lg"
                        :label="buttonLabel"
                        action="toggle-modal-dialog"
                        status="draft">
                    </button-app>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            heading: {
                type: String,
                required: true
            },
            message: {
                type: String,
                required: true
            },
            buttonLabel: {
                type: String,
                required: true
            },
        },
        mounted() {
            EventBus.$on('toggle-modal-dialog', (toggle) => {
                $('#modal-dialog').modal(toggle === undefined ? 'toggle' : toggle)
            })
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
