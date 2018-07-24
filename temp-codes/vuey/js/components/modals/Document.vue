<template>
    <div class="modal fade" :id="modalId" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header alert alert-default" style="margin-bottom: 0px;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <p class="modal-title"><span class="fa fa-comment-o" aria-hidden="true"></span> {{ heading }}</p>
                </div>
                <div class="modal-body" style="max-height: calc(100vh - 10vh); overflow-y: auto; padding: 5px;">
                    <slot name="body"></slot>
                </div>
                <div class="modal-footer" style="padding: 5px;">
                    <slot name="footer"></slot>
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
            }
        },
        computed: {
            dashLowerCaseHeading () {
                return this.heading.replace(/ /g, '-').toLowerCase()
            },
            modalId () {
                return 'modal-' + this.dashLowerCaseHeading
            }
        },
        mounted () {
            $('#' + this.modalId).modal('show')
        }
    }
</script>
