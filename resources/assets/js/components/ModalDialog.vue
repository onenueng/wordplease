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
                    <button class="btn btn-default" data-dismiss="modal">{{ buttonLabel }}</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['heading', 'message', 'buttonLabel']
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
