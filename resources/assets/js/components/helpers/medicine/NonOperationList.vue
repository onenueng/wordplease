<template>
    <div class="material-box">
        <div class="row">
            <div class="col-xs-12">
                <label><i>Non-operation helper :</i></label>
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
                    action="append-non-operation-helper"
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
                    { label: 'Anti-coagulation', field: 'non_operation_list-Anti-coagulation' },
                    { label: 'bronchoscope', field: 'non_operation_list-bronchoscope' },
                    { label: 'CAPD', field: 'non_operation_list-CAPD' },
                    { label: 'CBI', field: 'non_operation_list-CBI' },
                    { label: 'change tracheotomy', field: 'non_operation_list-change tracheotomy' },
                    { label: 'Cpap/Bipap', field: 'non_operation_list-Cpap/Bipap' },
                    { label: 'CPR', field: 'non_operation_list-CPR' },
                    { label: 'cryopre/factor VIII', field: 'non_operation_list-cryopre/factor VIII' },
                    { label: 'Debridement', field: 'non_operation_list-Debridement' },
                    { label: 'Dressing', field: 'non_operation_list-Dressing' },
                    { label: 'EGD c biop', field: 'non_operation_list-EGD c biop' },
                    { label: 'ERCP c stent c dilat', field: 'non_operation_list-ERCP c stent c dilat' },
                    { label: 'EET on venti>96', field: 'non_operation_list-EET_on_venti>96' },
                    { label: 'EET on venti<96', field: 'non_operation_list-EET_on_venti<96' },
                    { label: 'Extract tooth', field: 'non_operation_list-Extract_tooth' },
                    { label: 'Feeding', field: 'non_operation_list-Feeding' },
                    { label: 'FFP', field: 'non_operation_list-FFP' },
                    { label: 'Filling tooth', field: 'non_operation_list-Filling tooth' },
                    { label: "Foley'cath", field: "non_operation_list-Foley'cath" },
                    { label: 'Harvest stem cell', field: 'non_operation_list-Harvest stem cell' },
                    { label: 'HD', field: 'non_operation_list-HD' },
                    { label: 'holter monitor', field: 'non_operation_list-holter monitor' },
                    { label: 'Hypothermia', field: 'non_operation_list-Hypothermia' },
                    { label: 'ICD', field: 'non_operation_list-ICD' },
                    { label: 'IT Chemo', field: 'non_operation_list-IT Chemo' },
                    { label: 'IV chemo', field: 'non_operation_list-IV chemo' },
                    { label: 'IVIG', field: 'non_operation_list-IVIG' },
                    { label: 'monitor EKG', field: 'non_operation_list-monitor EKG' },
                    { label: 'NB', field: 'non_operation_list-NB' },
                    { label: 'NG-lavage', field: 'non_operation_list-NG-lavage' },
                    { label: 'Off tube', field: 'non_operation_list-Off tube' },
                    { label: 'percardiocentesis', field: 'non_operation_list-percardiocentesis' },
                    { label: 'Perm cath/DLC/CLC', field: 'non_operation_list-Perm cath/DLC/CLC' },
                    { label: 'PFT', field: 'non_operation_list-PFT' },
                    { label: 'platelets', field: 'non_operation_list-platelets' },
                    { label: 'platelets pheresis', field: 'non_operation_list-platelets pheresis' },
                    { label: 'pleurodesis+chemo', field: 'non_operation_list-pleurodesis+chemo' },
                    { label: 'pleurodesis+talc', field: 'non_operation_list-pleurodesis+talc' },
                    { label: 'pleurodesis+tetra', field: 'non_operation_list-pleurodesis+tetra' },
                    { label: 'PRC', field: 'non_operation_list-PRC' },
                    { label: 'rehabi', field: 'non_operation_list-rehabi' },
                    { label: 'Rituximab', field: 'non_operation_list-Rituximab' },
                    { label: 'RT', field: 'non_operation_list-RT' },
                    { label: 'rtPA', field: 'non_operation_list-rtPA' },
                    { label: 'Scan', field: 'non_operation_list-Scan' },
                    { label: 'Suture', field: 'non_operation_list-Suture' },
                    { label: 'Swan-Ganz', field: 'non_operation_list-Swan-Ganz' },
                    { label: 'Tap jiont', field: 'non_operation_list-Tap jiont' },
                    { label: 'TPE', field: 'non_operation_list-TPE' },
                    { label: 'TPN', field: 'non_operation_list-TPN' },
                    { label: 'tracheotomy', field: 'non_operation_list-tracheotomy' },
                    { label: 'U/S doppler', field: 'non_operation_list-U/S doppler' }
                ]
            }
        },
        mounted () {
            EventBus.$on('append-non-operation-helper', () => {
                let appendText = ''
                $('[id^=non_operation_list]').each( (index, item) => {
                    if ( $(item).prop('checked') ) {
                        appendText += $(item).prop('id').replace('non_operation_list-', '') + '\n'
                    }
                })
                EventBus.$emit('set-non_operation-change', appendText)
                console.log(appendText)
            })
        }
    }
</script>
