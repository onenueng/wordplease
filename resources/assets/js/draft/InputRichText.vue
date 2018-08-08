<template>
    
<div class="container-fluid">
    <div class="col-xs-12 col-sm-10 col-sm-offset-1" ref="target">
        <input id="x" type="hidden" name="content">
        <trix-editor input="x"></trix-editor>
    </div>
</div>

</template>

<script>
import trix from 'trix'
import "trix/dist/trix.css"

export default {
    // mounted () {
    //     this.trix = $(`<input id="x" type="hidden" name="content"><trix-editor input="x"></trix-editor>`)
    //     this.trix.insertAfter(this.$refs.target)
    // }
}
</script>
