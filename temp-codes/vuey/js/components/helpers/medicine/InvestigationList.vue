<template>
    <div class="material-box">
        <div class="row">
            <div class="col-xs-12">
                <label><i>Investigation helper :</i></label>
            </div>
            <div class="col-xs-6 col-sm-4 col-md-3" v-for="check in checks" :key="check.field">
                <div class="form-group-sm">
                    <input-check
                        :label="check.label"
                        :field="check.field"
                        no-save>
                    </input-check>
                </div>
            </div>
            <div class="col-xs-12">
                <button-app
                    action="append-investigation-helper"
                    status="info"
                    label="Append"
                    size="lg">
                </button-app>
            </div>
        </div>
    </div>
</template>
<script>
    import InputCheck from '../../inputs/InputCheck.vue'

    export default {
        components: {
            'input-check': InputCheck
        },
        data () {
            return {
                checks: [
                    { label: 'A-line', field: 'non_operation_list-A-line' },
                    { label: 'ABG', field: 'non_operation_list-ABG' },
                    { label: 'Biopsy', field: 'non_operation_list-Biopsy' },
                    { label: 'CT', field: 'non_operation_list-CT' },
                    { label: 'CVP', field: 'non_operation_list-CVP' },
                    { label: 'EEG', field: 'non_operation_list-EEG' },
                    { label: 'LP', field: 'non_operation_list-LP' },
                    { label: 'MRI', field: 'non_operation_list-MRI' },
                    { label: 'NG - Tube', field: 'non_operation_list-NG - Tube' },
                    { label: 'NP wash', field: 'non_operation_list-NP wash' },
                    { label: 'OCT', field: 'non_operation_list-OCT' },
                    { label: 'port A', field: 'non_operation_list-port A' },
                    { label: 'PR', field: 'non_operation_list-PR' },
                    { label: 'tap Abd', field: 'non_operation_list-tap Abd' },
                    { label: 'tap lung', field: 'non_operation_list-tap lung' },
                    { label: 'TCCD', field: 'non_operation_list-TCCD' },
                    { label: 'U/S', field: 'non_operation_list-U/S' }
                ]
            }
        },
        mounted () {
            EventBus.$on('append-investigation-helper', () => {
                let appendText = ''
                $('[id^=non_operation_list]').each( (index, item) => {
                    if ( $(item).prop('checked') ) {
                        appendText += $(item).prop('id').replace('non_operation_list-', '') + '\n'
                    }
                })
                EventBus.$emit('set-investigation-change', appendText)
                console.log(appendText)
            })
        }
    }
</script>
