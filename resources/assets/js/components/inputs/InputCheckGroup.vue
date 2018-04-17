<template>
    <div class="form-group-sm">
        <label class="control-label">{{ label }}</label>
        <!-- set key to prevent Vue warning -->
        <input-check 
            v-for="check in checkObjects"
            :key="check.field"
            :field="check.field"
            :label="check.label"
            :label-description="check.labelDescription"
            :checked="check.checked"
            :emit-on-update="check.emitOnUpdate"
            :setter-event="check.setterEvent"
            :need-sync="needSync"
            :no-save="check.noSave">
        </input-check>
    </div>
</template>

<script>
    import InputCheck from '../inputs/InputCheck.vue'
    export default {
        components: {
            'input-check': InputCheck,
        },
        props: {
            label: {
                type: String,
                required: false
            },
            // JSON input-check excluded needSync
            checks: {
                type: [String, Array],
                required: true
            },
            // need to sync value with database on render or not ['needSync' or undefined].
            needSync: {
                type: String,
                required: false
            }
        },
        created () {
            this.checkObjects = (typeof this.checks == 'string') ? JSON.parse(this.checks) : this.checks
        }
    }
</script>
