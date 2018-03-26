<template>

<div class="container-fluid"><!-- note content -->
    <panel heading='Admission data'><!-- Panel Admission Data -->
        <div class="row"><!-- wrap content with row class -->
            <input-text
                label="Admit :"
                field='datetime_admit'
                grid="12-6-3"
                :value="note.admission.datetime_admit_formated"
                readonly>
            </input-text><!-- datetime_admit -->
            <input-text
                label="Discharge :"
                field='datetime_discharge'
                grid="12-6-3"
                :value="note.admission.datetime_discharge_formated"
                readonly>
            </input-text><!-- datetime_discharge -->
            <input-text
                label="Length of stay :"
                field='lenght_of_stay'
                grid="12-6-3"
                :value="note.admission.lenght_of_stay"
                readonly>
            </input-text><!-- datetime_discharge -->
            <input-suggestion
                field="ward"
                label="Ward :"
                grid="12-6-3"
                min-chars="2"
                :value="note.ward_name">
            </input-suggestion><!-- ward -->
            <input-suggestion
                field="attending"
                label="Attending :"
                grid="12-6-3"
                min-chars="3"
                :value="note.attending_name">
            </input-suggestion><!-- attending -->
            <input-suggestion
                field="division"
                label="Specialty :"
                grid="12-6-3"
                min-chars="3"
                :value="note.division_name">
            </input-suggestion><!-- division -->
            <input-select
                field="admit_reason"
                label="Reason to admit :"
                placeholder="if other choice, type here"
                grid="12-6-3"
                :value="note.detail.admit_reason_text">
            </input-select><!-- admit_reason -->
        </div>
    </panel><!-- Panel Admission Data -->

    <panel heading='History'><!-- Panel Hisroty -->
        <div class="row"><!-- wrap content with row class -->
            <input-textarea
                field="chief_complaint"
                label="Chief complaint :"
                grid="12-12-12"
                max-chars="50"
                :value="note.detail.chief_complaint">
            </input-textarea><!-- chief complaint -->
            <div class="col-xs-12"><hr class="line" /></div><!-- separate line -->
            <div class="col-xs-12 form-inline">
                <button-app
                    action="comorbid-no-data-all"
                    status="draft"
                    label="No Data"
                    size="sm">
                </button-app><!-- set all comorbids to no data -->
                <button-app
                    action="comorbid-no-at-all"
                    status="draft"
                    label="No comorbids"
                    size="sm">
                </button-app><!-- set all comorbids to negative -->
            </div><!--  format content to fit left margin -->
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="material-box">
                    <input-radio 
                        field="comorbid_DM"
                        label="DM :"
                        :options="comorbidOptions"
                        trigger-value="1"
                        :value="note.detail.comorbid_DM">
                        
                        <input-radio 
                            field="comorbid_DM_type"
                            label="Type : "
                            options='[
                                {"label": "I", "value": 1},
                                {"label": "II", "value": 2}
                            ]'
                            :value="note.detail.comorbid_DM_type">
                        </input-radio><!-- DM type -->

                        <input-check-group 
                            label="Complication : "
                            :checks="DMComplicationChecks">
                        </input-check-group><!-- DM complications DR, Nephropathy, Neuropathy -->

                        <input-check-group 
                            label="Treatment : "
                            :checks="DMTreatmentChecks">
                        </input-check-group><!-- DM treatments Diet, Oral Meds, Insulin -->
                    </input-radio><!-- DM comorbid and its extra contents -->
                </div><!-- DM comorbid and its extra contents -->
                <div><hr class="line" /></div>
            </div><!-- comorbid DM, VHD, Asthma, Cirrhosis, HCV -->
        </div><!-- wrap content with row class -->
    </panel><!-- Panel Hisroty -->
</div>
</template>

<script>
    import Panel from '../../../Panel.vue'
    import InputText from '../../../inputs/InputText.vue'
    import InputCheck from '../../../inputs/InputCheck.vue'
    import InputRadio from '../../../inputs/InputRadio.vue'
    import InputSelect from '../../../inputs/InputSelect.vue'
    import InputTextarea from '../../../inputs/InputTextarea.vue'
    import InputSuggestion from '../../../inputs/InputSuggestion.vue'
    import InputCheckGroup from '../../../inputs/InputCheckGroup.vue'

    export default {
        components: {
            'panel': Panel,
            'input-text' : InputText,
            'input-check' : InputCheck,
            'input-radio': InputRadio,
            'input-select' : InputSelect,
            'input-textarea' : InputTextarea,
            'input-suggestion' : InputSuggestion,
            'input-check-group' : InputCheckGroup
        },
        props: {
            serializedNote: {
                type: String,
                required: true
            }
        },
        data () {
            return { 
                note: {},
                comorbidOptions: [
                    { label: "No data", value: 255 },
                    { label: "No", value: 0 },
                    { label: "Yes", value: 1 }
                ],
                DMComplicationChecks: {},
                getDataUrl: "/note-data/" + window.location.pathname.split("/")[2]
            }
        },
        created () {
            this.note = JSON.parse(this.serializedNote)
            this.DMComplicationChecks = [
                {field: "comorbid_DM_DR", label: "DR", checked: this.note.detail.comorbid_DM_DR},
                {field: "comorbid_DM_nephropathy", label: "Nephropathy", checked: this.note.detail.comorbid_DM_nephropathy},
                {field: "comorbid_DM_neuropathy", label: "Neuropathy", checked: this.note.detail.comorbid_DM_neuropathy}
            ],
            this.DMTreatmentChecks = [
                {field: "comorbid_DM_diet", label: "Diet", checked: this.note.detail.comorbid_DM_diet},
                {field: "comorbid_DM_oral_meds", label: "Oral Meds", checked: this.note.detail.comorbid_DM_oral_meds},
                {field: "comorbid_DM_insulin", label: "Insulin", checked: this.note.detail.comorbid_DM_insulin}
            ]
        }

        // implement input-text sync data
        // window.location.href
        // window.location.hostname
        // window.location.pathname
    }
</script>
