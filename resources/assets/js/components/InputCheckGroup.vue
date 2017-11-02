<template>
    <div class="form-group-sm">
        <label class="control-label">{{ label }}</label>
        <input-check v-for="check in JSON.parse(checks)"
                     :key="check.field"
                     :field="check.field"
                     :label="check.label"
                     :checked="check.checked"
                     :emit-on-check="check.emitOnCheck"
                     :trigger-event="check.triggerEvent"
                     :need-sync="needSync">
        </input-check>
    </div>
</template>

<script>
    export default {
        props: ['label','checks', 'needSync']
    }
</script>
