<template>
    <div class="form-group-sm">
        <label class="control-label">{{ label }}</label>
        <input-check
            :key="index"
            :field="check.field"
            :label="check.label"
            :label-description="check.labelDescription"
            v-for="(check, index) in checks"
            v-model="models[check.checked]"
        ></input-check>
    </div>
</template>

<script>
import InputCheck from '../inputs/InputCheck.vue'
export default {
components: { InputCheck },
props: {
    label: { default: null },
    checks: { required: true, type: Array },
    models: { required: true, type: Object }
}
}
</script>
