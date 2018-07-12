<template>
    <!-- <h1>hello</h1> -->
    <textarea name="" id="" rows="1" ref="autosizeTextarea"></textarea>
</template>

<script>
    import autosize from "autosize"
    export default {
        mounted () {
            autosize(this.$refs.autosizeTextarea)
        }
    }
</script>
