<template>
    <div class="form-group-sm">
        <label class="control-label">{{ label }}</label>
        <input-check v-for="check in JSON.parse(checks)" :key="check.field" :field="check.field" :label="check.label"></input-check>
    </div>
</template>

<script>
    export default {
        props: ['label','checks']
    }
</script>
