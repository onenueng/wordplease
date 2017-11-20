<template>
    <div class="form-group-sm">
        <label class="control-label">{{ label }}</label>
        <input-check 
            v-for="check in JSON.parse(checks)"
            :key="check.field"
            :field="check.field"
            :label="check.label"
            :label-description="check.labelDescription"
            :checked="check.checked"
            :emit-on-check="check.emitOnCheck"
            :trigger-event="check.triggerEvent"
            :setter-event="check.setterEvent"
            :need-sync="needSync">
        </input-check>
    </div>
</template>

<script>
    export default {
        // props: ['label','checks', 'needSync']
        props: {
            label: {
                type: String,
                required: false
            },
            // JSON input-check excluded needSync
            checks: {
                type: String,
                required: true
            },
            // need to sync value with database on render or not ['needSync' or undefined].
            needSync: {
                type: String,
                required: false
            }
        }
    }
</script>
