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
                        :trigger-value="inputRadioExtrasTriggerValue"
                        :value="note.detail.comorbid_DM"
                        emit-on-update="reset-comorbid_DM-extras">

                        <input-radio
                            field="comorbid_DM_type"
                            label="Type : "
                            options='[
                                {"label": "I", "value": 1},
                                {"label": "II", "value": 2}
                            ]'
                            :value="note.detail.comorbid_DM_type"
                            setter-event="set-comorbid_DM_type">
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

                <div class="material-box">
                    <input-radio
                        field="comorbid_valvular_heart_disease"
                        label="Valvular heart disease :"
                        :options="comorbidOptions"
                        :trigger-value="inputRadioExtrasTriggerValue"
                        :value="note.detail.comorbid_valvular_heart_disease"
                        emit-on-update="reset-comorbid_valvular_heart_disease-extras">
                        
                        <input-check-group
                            label="Specify : "
                            :checks="ValvularHeartDiseaseChecks">
                        </input-check-group><!-- valvular heart disease specify AS, AR, MS, MR, TR  -->

                        <input-text
                            field="comorbid_valvular_heart_disease_other"
                            :value="note.detail.comorbid_valvular_heart_disease_other"
                            size="normal"
                            placeholder="Other specific, type here.">
                        </input-text><!-- valvular heart disease specify other -->
                    </input-radio><!-- comorbid valvular heart disease -->
                </div><!-- valvular heart disease comorbid and its extra contents -->
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
                // DMComplicationChecks: {},
                inputRadioExtrasTriggerValue: 1,
                getDataUrl: "/note-data/" + window.location.pathname.split("/")[2]
            }
        },
        created () {
            this.note = JSON.parse(this.serializedNote)
            this.DMComplicationChecks = [
                {
                    field: "comorbid_DM_DR", label: "DR",
                    checked: this.note.detail.comorbid_DM_DR,
                    setterEvent: 'set-comorbid_DM_DR'
                },
                {
                    field: "comorbid_DM_nephropathy",
                    label: "Nephropathy",
                    checked: this.note.detail.comorbid_DM_nephropathy,
                    setterEvent: 'set-comorbid_DM_nephropathy'
                },
                {
                    field: "comorbid_DM_neuropathy",
                    label: "Neuropathy",
                    checked: this.note.detail.comorbid_DM_neuropathy,
                    setterEvent: 'set-comorbid_DM_neuropathy'
                }
            ]
            this.DMTreatmentChecks = [
                {
                    field: "comorbid_DM_diet",
                    label: "Diet",
                    checked: this.note.detail.comorbid_DM_diet,
                    setterEvent: 'set-comorbid_DM_diet'
                },
                {
                    field: "comorbid_DM_oral_meds",
                    label: "Oral Meds",
                    checked: this.note.detail.comorbid_DM_oral_meds,
                    setterEvent: 'set-comorbid_DM_oral_meds'
                },
                {
                    field: "comorbid_DM_insulin",
                    label: "Insulin",
                    checked: this.note.detail.comorbid_DM_insulin,
                    setterEvent: 'set-comorbid_DM_insulin'
                }
            ]
            this.ValvularHeartDiseaseChecks = [
                {
                    field: "comorbid_valvular_heart_disease_AS",
                    label: "AS",
                    checked: this.note.detail.comorbid_valvular_heart_disease_AS,
                    setterEvent: "set-comorbid_valvular_heart_disease_AS"
                },
                {
                    field: "comorbid_valvular_heart_disease_AR",
                    label: "AR",
                    checked: this.note.detail.comorbid_valvular_heart_disease_AR,
                    setterEvent: "set-comorbid_valvular_heart_disease_AR"
                },
                {
                    field: "comorbid_valvular_heart_disease_MS",
                    label: "MS",
                    checked: this.note.detail.comorbid_valvular_heart_disease_MS,
                    setterEvent: "set-comorbid_valvular_heart_disease_MS"
                },
                {
                    field: "comorbid_valvular_heart_disease_MR",
                    label: "MR",
                    checked: this.note.detail.comorbid_valvular_heart_disease_MR,
                    setterEvent: "set-comorbid_valvular_heart_disease_MR"
                },
                {
                    field: "comorbid_valvular_heart_disease_TR",
                    label: "TR",
                    checked: this.note.detail.comorbid_valvular_heart_disease_TR,
                    setterEvent: "set-comorbid_valvular_heart_disease_TR"
                }
            ]
        },
        mounted () {
            EventBus.$on('reset-comorbid_DM-extras', (value) => {
                if ( value != this.inputRadioExtrasTriggerValue ) {
                    EventBus.$emit('set-comorbid_DM_type', null)
                    this.note.detail.comorbid_DM_DR = null
                    EventBus.$emit('set-comorbid_DM_DR', 0)
                    this.note.detail.comorbid_DM_DR = 0
                    EventBus.$emit('set-comorbid_DM_nephropathy', 0)
                    this.note.detail.comorbid_DM_nephropathy = 0
                    EventBus.$emit('set-comorbid_DM_neuropathy', 0)
                    this.note.detail.comorbid_DM_neuropathy = 0
                    EventBus.$emit('set-comorbid_DM_diet', 0)
                    this.note.detail.comorbid_DM_diet = 0
                    EventBus.$emit('set-comorbid_DM_oral_meds', 0)
                    this.note.detail.comorbid_DM_oral_meds = 0
                    EventBus.$emit('set-comorbid_DM_insulin', 0)
                    this.note.detail.comorbid_DM_insulin = 0
                }
            })

            EventBus.$on('reset-comorbid_valvular_heart_disease-extras', (value) => {
                if ( value != this.inputRadioExtrasTriggerValue ) {
                    EventBus.$emit('set-comorbid_valvular_heart_disease_AS', 0)
                    this.note.detail.comorbid_valvular_heart_disease_AS = 0
                    EventBus.$emit('set-comorbid_valvular_heart_disease_AR', 0)
                    this.note.detail.comorbid_valvular_heart_disease_AR = 0
                    EventBus.$emit('set-comorbid_valvular_heart_disease_MS', 0)
                    this.note.detail.comorbid_valvular_heart_disease_MS = 0
                    EventBus.$emit('set-comorbid_valvular_heart_disease_MR', 0)
                    this.note.detail.comorbid_valvular_heart_disease_MR = 0
                    EventBus.$emit('set-comorbid_valvular_heart_disease_TR', 0)
                    this.note.detail.comorbid_valvular_heart_disease_TR = 0
                }
            })
        }
        // computed: {
        //     DMComplicationChecks() {
        //         return [
        //             {field: "comorbid_DM_DR", label: "DR", checked: this.note.detail.comorbid_DM_DR},
        //             {field: "comorbid_DM_nephropathy", label: "Nephropathy", checked: this.note.detail.comorbid_DM_nephropathy},
        //             {field: "comorbid_DM_neuropathy", label: "Neuropathy", checked: this.note.detail.comorbid_DM_neuropathy}
        //         ]
        //     },
        //     DMTreatmentChecks() {
        //         return [
        //             {field: "comorbid_DM_diet", label: "Diet", checked: this.note.detail.comorbid_DM_diet},
        //             {field: "comorbid_DM_oral_meds", label: "Oral Meds", checked: this.note.detail.comorbid_DM_oral_meds},
        //             {field: "comorbid_DM_insulin", label: "Insulin", checked: this.note.detail.comorbid_DM_insulin}
        //         ]
        //     }
        // }

        // implement input-text sync data
        // window.location.href
        // window.location.hostname
        // window.location.pathname
    }
</script>
