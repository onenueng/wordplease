<template>
    <div class="modal fade" tabindex="-1" role="dialog" id="modalAction" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">{{ heading }}</h4>
                </div>
                <div class="modal-body" v-html="content">
                    
                </div>
                <div class="modal-footer">
                    <button-app
                        size="lg"
                        :label="label"
                        :action="action"
                        status="info">
                    </button-app>
                    <button-app
                        size="lg"
                        label="Cancle"
                        action="modalAction-dismiss"
                        status="draft">
                    </button-app>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                label: '',
                action: '',
                content: '',
                heading: ''
            }
        },
        mounted() {
            EventBus.$on('modalAction-dismiss', () => {
                $('#modalAction').modal('hide')
            })

            EventBus.$on('create-note-confirmation', (heading, content, action, label) => {
                this.label = label
                this.action = action
                this.content = content
                this.heading = heading
                $('#modalAction').modal('show')
            })
        }
    }
</script>
