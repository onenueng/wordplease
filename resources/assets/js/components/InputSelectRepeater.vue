<template>
    <input-select v-for="field in JSON.parse(fields)"
        :field="field.field"
        :value="field.value"
        :service-url="field.serviceUrl"
        min-chars="0"
        label="Ischemic :"
        size="normal"
        not-allow-other
        need-sync>
    </input-select>
</template>

<script>
    export default {
        props: ['fields']
    }
</script>
