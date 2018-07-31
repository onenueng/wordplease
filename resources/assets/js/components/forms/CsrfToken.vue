<template>
    <input 
        type="hidden"
        name="_token"
        :value="token" />
</template>

<script>
    export default {
        created () {
            this.token = document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    }
</script>
