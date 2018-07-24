<template>
    <div>
    <input ref="flatpickrInput" /><i>61</i>
    </div>

</template>

<script>
    import flatpickr from "flatpickr";
    import "flatpickr/dist/themes/dark.css"
    export default {
        mounted () {
            flatpickr(this.$refs.flatpickrInput, {

            })
        }
    }
</script>
