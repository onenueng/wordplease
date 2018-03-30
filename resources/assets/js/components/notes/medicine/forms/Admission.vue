<template>

<div class="container-fluid"><!-- note content -->
    <modal-child-pugh-score-detail></modal-child-pugh-score-detail>
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
                            :checks="valvularHeartDiseaseChecks">
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

                <div class="material-box">
                    <input-radio
                        field="comorbid_asthma"
                        label="Asthma :"
                        :options="comorbidOptions"
                        :value="note.detail.comorbid_asthma">
                    </input-radio>
                </div><!-- asthma comorbid -->
                <div><hr class="line" /></div>

                <div class="material-box">
                    <input-radio
                        field="comorbid_cirrhosis"
                        label="Cirrhosis :"
                        :options="comorbidOptions"
                        :value="note.detail.comorbid_cirrhosis"
                        :trigger-value="inputRadioExtrasTriggerValue"
                        emit-on-update="reset-comorbid_cirrhosis-extras">

                        <input-radio
                            field="comorbid_cirrhosis_child_pugh_score"
                            :value="note.detail.comorbid_cirrhosis_child_pugh_score"
                            label="Child-Pugh's Score :"
                            :label-action="cirrhosisLabelAction"
                            options='[
                                {"label": "A", "value": "A"},
                                {"label": "B", "value": "B"},
                                {"label": "C", "value": "C"}
                            ]'>
                        </input-radio><!-- cirrhosis Child-Pugh's score -->

                        <input-check-group
                            label="Specify : "
                            :checks="cirrhosisSpecificChecks">
                        </input-check-group><!-- cirrhosis specify HBV, HCV, NASH, Cryptogenic  -->

                        <input-text
                            field="comorbid_cirrhosis_other"
                            :value="note.detail.comorbid_cirrhosis_other"
                            size="normal"
                            placeholder="Other specific, type here.">
                        </input-text><!-- cirrhosis specify other -->
                    </input-radio>
                </div><!-- comorbid cirrhosis -->
                <div><hr class="line" /></div>

                <div class="material-box">
                    <input-radio
                        field="comorbid_HCV"
                        label="HCV infection :"
                        :value="note.detail.comorbid_HCV"
                        :options="comorbidOptions"
                        setter-event='set-comorbid_HCV'
                        store-data='note-store-data'>
                    </input-radio>
                </div><!-- HBV comorbid -->
                <div><hr class="line" /></div>

                <div class="material-box">
                    <input-radio
                        field="comorbid_lukemia"
                        label="Lukemia :"
                        :options="comorbidOptions"
                        :value="note.detail.comorbid_lukemia"
                        :trigger-value="inputRadioExtrasTriggerValue"
                        emit-on-update="reset-comorbid_lukemia-extras">

                        <input-radio
                            field="comorbid_lukemia_specific"
                            label="Specify :"
                            :value="note.detail.comorbid_lukemia_specific"
                            options='[
                                {"label": "ALL", "value": 1},
                                {"label": "AML", "value": 2},
                                {"label": "CLL", "value": 3},
                                {"label": "CML", "value": 4}
                            ]'>
                        </input-radio><!-- lukemia specific -->
                    </input-radio>
                </div><!-- lukemia cirrhosis -->
                <div><hr class="line" /></div>

                <div class="material-box">
                    <input-radio
                        field="comorbid_ICD"
                        label="ICD "
                        label-description="Implantable Cardioverter Defibrillator"
                        :options="comorbidOptions"
                        :value="note.detail.comorbid_ICD"
                        :trigger-value="inputRadioExtrasTriggerValue"
                        emit-on-update="reset-comorbid_ICD-extras">

                        <input-text
                            field="comorbid_ICD_other"
                            :value="note.detail.comorbid_ICD_other"
                            size="normal"
                            placeholder="Specific ICD type.">
                        </input-text><!-- ICD specify other -->
                    </input-radio>
                </div><!-- comorbid ICD -->
                <div><hr class="line" /></div>

                <div class="material-box">
                    <input-radio
                        field="comorbid_SLE"
                        :value="note.detail.comorbid_SLE"
                        label="SLE "
                        :options="comorbidOptions">
                    </input-radio>
                </div><!-- comorbid SLE -->
                <div><hr class="line" /></div>

                <div class="material-box">
                    <input-radio
                        field="comorbid_dementia"
                        :value="note.detail.comorbid_dementia"
                        label="Dementia :"
                        :options="comorbidOptions"
                        :trigger-value="inputRadioExtrasTriggerValue"
                        emit-on-update="reset-comorbid_dementia-extras">

                        <input-check-group
                            checks='[
                                {"field": "comorbid_dementia_vascular", "label": "Vascular"},
                                {"field": "comorbid_dementia_alzheimer", "label": "Alzheimer"}
                            ]'>
                        </input-check-group><!-- dementia specify Vascular Alzheimer  -->

                        <input-text
                            field="comorbid_dementia_other"
                            :value="note.detail.comorbid_dementia_other"
                            size="normal"
                            placeholder="Other specific, type here.">
                        </input-text><!-- dementia specify other -->
                    </input-radio>
                </div><!-- comorbid dementia -->
                <div><hr class="line" /></div>
            </div><!-- comorbid DM, VHD, Asthma, Cirrhosis, HCV -->

            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="material-box">
                    <input-radio
                        field="comorbid_HT"
                        :value="note.detail.comorbid_HT"
                        label="HT :"
                        :options="comorbidOptions">
                    </input-radio>
                </div><!-- HT comorbid -->
                <div><hr class="line" /></div>

                <div class="material-box">
                    <input-radio
                        field="comorbid_stroke"
                        :value="note.detail.comorbid_stroke"
                        label="Stroke : "
                        :options="comorbidOptions"
                        :trigger-value="inputRadioExtrasTriggerValue"
                        emit-on-update="reset-comorbid_stroke-extras">

                        <div class="form-inline">
                            <input-select
                                v-for="symptom in strokeSymptoms"
                                :key="symptom.field"
                                :field="symptom.field"
                                :value="symptom.value"
                                :label="symptom.label"
                                size="normal"
                                not-allow-other>
                            </input-select>
                        </div><!-- foreach stroke symptom -->
                    </input-radio><!-- stroke comorbid and its extra contents -->
                </div><!-- stroke comorbid and its extra contents -->
                <div><hr class="line" /></div>

                <div class="material-box">
                    <input-radio
                        field="comorbid_CKD"
                        :value="note.detail.comorbid_CKD"
                        label="CKD "
                        label-description="Chronic Kidney Disease"
                        :options="comorbidOptions"
                        :trigger-value="inputRadioExtrasTriggerValue"
                        emit-on-update="reset-comorbid_CKD-extras">

                        <div class="form-inline">
                            <input-select
                                field="comorbid_CKD_stage"
                                :value="note.detail.comorbid_CKD_stage_text"
                                label="Stage :"
                                size="normal"
                                not-allow-other>
                            </input-select><!-- CKD stage -->
                        </div>
                    </input-radio><!-- CKD comorbid and its extra contents -->
                </div><!-- CKD comorbid and its extra contents -->
                <div><hr class="line" /></div>

                <div class="material-box">
                    <input-radio
                        field="comorbid_coagulopathy"
                        :value="note.detail.comorbid_coagulopathy"
                        label="Coagulopathy :"
                        :options="comorbidOptions">
                    </input-radio>
                </div> <!-- coagulopathy comorbid -->
                <div><hr class="line" /></div>

                <div class="material-box">
                    <input-radio
                        field="comorbid_HIV"
                        :value="note.detail.comorbid_HIV"
                        label="HIV :"
                        :options="comorbidOptions"
                        :trigger-value="inputRadioExtrasTriggerValue"
                        emit-on-update="reset-comorbid_HIV-extras">

                        <input-check-group
                            label="Previous opportunistic infection : "
                            :checks="HIVPreviousOpportunisticInfectionChecks">
                        </input-check-group><!-- HIV Previous opportunistic infection TB, PCP, Candidiasis, CMV -->

                        <input-text
                            field="comorbid_HIV_other"
                            :value="note.detail.comorbid_HIV_other"
                            size="normal"
                            placeholder="Other specific, type here.">
                        </input-text><!-- HIV specify other -->
                    </input-radio>
                </div><!-- HIV comorbid -->
                <div><hr class="line" /></div>

                <div class="material-box">
                    <input-radio
                        field="comorbid_lymphoma"
                        :value="note.detail.comorbid_lymphoma"
                        label="Lymphoma :"
                        :options="comorbidOptions"
                        :trigger-value="inputRadioExtrasTriggerValue"
                        emit-on-update="reset-comorbid_lymphoma-extras">

                        <div class="form-inline">
                            <input-select
                                field="comorbid_lymphoma_specific"
                                :value="note.detail.comorbid_lymphoma_specific_text"
                                label="Specify :"
                                size="normal">
                            </input-select>
                        </div><!-- lymphoma specify -->
                    </input-radio>
                </div><!-- lymphoma comorbid -->
                <div><hr class="line" /></div>

                <div class="material-box">
                    <input-radio
                        field="comorbid_cancer"
                        :value="note.detail.comorbid_cancer"
                        label="Cancer :"
                        :options="comorbidOptions"
                        :trigger-value="inputRadioExtrasTriggerValue"
                        emit-on-update="reset-comorbid_cancer-extras">

                        <!-- cancer specify Lung Liver Colon Breast Prostate Cervix Pancreas Brain  -->
                        <input-check-group
                            :checks="cancerOrganChecks">
                        </input-check-group>

                        <!-- cancer specify other -->
                        <input-text
                            field="comorbid_cancer_other"
                            :value="note.detail.comorbid_cancer_other"
                            size="normal"
                            placeholder="Other specific, type here.">
                        </input-text>
                    </input-radio>
                </div><!-- comorbid cancer -->
                <div><hr class="line" /></div>

                <div class="material-box">
                    <input-radio
                        field="comorbid_other_autoimmune_disease"
                        :value="note.detail.comorbid_other_autoimmune_disease"
                        label="Other Autoimmune Disease :"
                        :options="comorbidOptions"
                        :trigger-value="inputRadioExtrasTriggerValue"
                        emit-on-update="reset-comorbid_other_autoimmune_disease-extras">
                        
                        <input-check-group
                            :checks="otherAutoimmuneDiseaseChecks">
                        </input-check-group><!-- Other Autoimmune Disease specify Lung Liver Colon Breast Prostate Cervix Pancreas Brain  -->
                        
                        <input-text
                            field="comorbid_other_autoimmune_disease_other"
                            :value="note.detail.comorbid_other_autoimmune_disease_other"
                            size="normal"
                            placeholder="Other specific, type here.">
                        </input-text><!-- Other Autoimmune Disease specify other -->
                    </input-radio>
                </div><!-- comorbid Other Autoimmune Disease -->
                <div><hr class="line" /></div>
            </div><!-- comorbid HT, Stroke, CKD, Coagulopathy, HIV -->
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
    import ChildPughScore from '../../../modals/Medicine/ChildPughScore.vue'

    export default {
        components: {
            'panel': Panel,
            'input-text' : InputText,
            'input-check' : InputCheck,
            'input-radio': InputRadio,
            'input-select' : InputSelect,
            'input-textarea' : InputTextarea,
            'input-suggestion' : InputSuggestion,
            'input-check-group' : InputCheckGroup,
            'modal-child-pugh-score-detail' : ChildPughScore
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
                states: [],
                getDataUrl: "/note-data/" + window.location.pathname.split("/")[2]
            }
        },
        created () {
            this.note = JSON.parse(this.serializedNote)

            this.comorbidOptions = [
                { label: "No data", value: 255 },
                { label: "No", value: 0 },
                { label: "Yes", value: 1 }
            ]

            this.inputRadioExtrasTriggerValue = 1

            EventBus.$on('note-store-data', (field, value) => {
                this.note.detail[field] = value
            })

            EventBus.$on('reset-comorbid_DM-extras', (value) => {
                if ( value != this.inputRadioExtrasTriggerValue ) {
                    this.note.detail.comorbid_DM_type = null
                    this.note.detail.comorbid_DM_DR = false
                    this.note.detail.comorbid_DM_nephropathy = false
                    this.note.detail.comorbid_DM_neuropathy = false
                    this.note.detail.comorbid_DM_diet = false
                    this.note.detail.comorbid_DM_oral_meds = false
                    this.note.detail.comorbid_DM_insulin = false
                }
            })

            EventBus.$on('reset-comorbid_valvular_heart_disease-extras', (value) => {
                if ( value != this.inputRadioExtrasTriggerValue ) {
                    this.note.detail.comorbid_valvular_heart_disease_AS = false
                    this.note.detail.comorbid_valvular_heart_disease_AR = false
                    this.note.detail.comorbid_valvular_heart_disease_MS = false
                    this.note.detail.comorbid_valvular_heart_disease_MR = false
                    this.note.detail.comorbid_valvular_heart_disease_TR = false
                    this.note.detail.comorbid_valvular_heart_disease_other = null
                }
            })

            this.cirrhosisLabelAction = {
                emit: "toggle-modal-child-pugh-score-detail",
                icon: "question-circle",
                title: "Click to learn more about Child-Pugh's Score"
            }

            EventBus.$on('reset-comorbid_cirrhosis-extras', (value) => {
                if ( value != this.inputRadioExtrasTriggerValue ) {
                    this.note.detail.comorbid_cirrhosis_child_pugh_score = null
                    this.note.detail.comorbid_cirrhosis_HBV = false
                    this.note.detail.comorbid_cirrhosis_HCV = false
                    this.note.detail.comorbid_cirrhosis_NASH = false
                    this.note.detail.comorbid_cirrhosis_cryptogenic = false
                    this.note.detail.comorbid_cirrhosis_other = null
                }
            })

            EventBus.$on('click-comorbid_cirrhosis_none_cryptogenic', (value) => {
                if (value) {
                    EventBus.$emit('set-cirrhosis_cryptogenic', false)
                }
            })

            EventBus.$on('click-comorbid_cirrhosis_cryptogenic', (value) => {
                if (value) {
                    EventBus.$emit('set-cirrhosis_HBV', false)
                    EventBus.$emit('set-cirrhosis_HCV', false)
                    EventBus.$emit('set-cirrhosis_NASH', false)
                }
            })

            EventBus.$on('click-comorbid_HCV', (value) => {
                if (value && this.note.detail.comorbid_HCV !== 1) {
                    EventBus.$emit('set-comorbid_HCV', 1)
                    EventBus.$emit('toggle-alert-box', 'HCV infection also checked')
                }
            })

            EventBus.$on('reset-comorbid_lukemia-extras', (value) => {
                if ( value != this.inputRadioExtrasTriggerValue ) {
                    this.note.detail.comorbid_lukemia_specific = null
                }
            })

            EventBus.$on('reset-comorbid_ICD-extras', (value) => {
                if ( value != this.inputRadioExtrasTriggerValue ) {
                    this.note.detail.comorbid_ICD_other = null
                }
            })

            EventBus.$on('reset-comorbid_dementia-extras', (value) => {
                if ( value != this.inputRadioExtrasTriggerValue ) {
                    this.note.detail.comorbid_dementia_vascular = false
                    this.note.detail.comorbid_dementia_alzheimer = false
                    this.note.detail.comorbid_dementia_other = null
                }
            })

            EventBus.$on('reset-comorbid_stroke-extras', (value) => {
                if ( value != this.inputRadioExtrasTriggerValue ) {
                    this.note.detail.comorbid_stroke_ischemic_text = null
                    this.note.detail.comorbid_stroke_hemorrhagic_text = null
                    this.note.detail.comorbid_stroke_iembolic_text = null
                }
            })

            EventBus.$on('reset-comorbid_CKD-extras', (value) => {
                if ( value != this.inputRadioExtrasTriggerValue ) {
                    this.note.detail.comorbid_CKD_stage_text = null
                }
            })

            EventBus.$on('reset-comorbid_HIV-extras', (value) => {
                if ( value != this.inputRadioExtrasTriggerValue ) {
                    this.note.detail.comorbid_HIV_other = null
                    this.note.detail.comorbid_HIV_TB = false
                    this.note.detail.comorbid_HIV_PCP = false
                    this.note.detail.comorbid_HIV_candidiasis = false
                    this.note.detail.comorbid_HIV_CMV = false
                }
            })

            EventBus.$on('reset-comorbid_lymphoma-extras', (value) => {
                if ( value != this.inputRadioExtrasTriggerValue ) {
                    this.note.detail.comorbid_lymphoma_specific_text = null
                }
            })

            EventBus.$on('reset-comorbid_cancer-extras', (value) => {
                this.note.detail.comorbid_cancer_lung = false
                this.note.detail.comorbid_cancer_liver = false
                this.note.detail.comorbid_cancer_colon = false
                this.note.detail.comorbid_cancer_breast = false
                this.note.detail.comorbid_cancer_prostate = false
                this.note.detail.comorbid_cancer_cervix = false
                this.note.detail.comorbid_cancer_pancreas = false
                this.note.detail.comorbid_cancer_brain = false
                this.note.detail.comorbid_cancer_other = null
            })

            EventBus.$on('reset-comorbid_other_autoimmune_disease-extras', (value) => {
                this.note.detail.comorbid_other_autoimmune_disease_UCTD = false
                this.note.detail.comorbid_other_autoimmune_disease_sjrogren_syndrome = false
                this.note.detail.comorbid_other_autoimmune_disease_MCTD = false
                this.note.detail.comorbid_other_autoimmune_disease_DMPM = false
                this.note.detail.comorbid_other_autoimmune_disease_other = null
            })

        },
        computed : {
            DMComplicationChecks () {
                return [
                            {
                                field: "comorbid_DM_DR", label: "DR",
                                checked: this.note.detail.comorbid_DM_DR,
                            },
                            {
                                field: "comorbid_DM_nephropathy",
                                label: "Nephropathy",
                                checked: this.note.detail.comorbid_DM_nephropathy
                            },
                            {
                                field: "comorbid_DM_neuropathy",
                                label: "Neuropathy",
                                checked: this.note.detail.comorbid_DM_neuropathy
                            }
                        ]
            },
            DMTreatmentChecks () {
                return [
                    {
                        field: "comorbid_DM_diet",
                        label: "Diet",
                        checked: this.note.detail.comorbid_DM_diet
                    },
                    {
                        field: "comorbid_DM_oral_meds",
                        label: "Oral Meds",
                        checked: this.note.detail.comorbid_DM_oral_meds
                    },
                    {
                        field: "comorbid_DM_insulin",
                        label: "Insulin",
                        checked: this.note.detail.comorbid_DM_insulin
                    }
                ]
            },
            valvularHeartDiseaseChecks () {
                return [
                    {
                        field: "comorbid_valvular_heart_disease_AS",
                        label: "AS",
                        checked: this.note.detail.comorbid_valvular_heart_disease_AS
                    },
                    {
                        field: "comorbid_valvular_heart_disease_AR",
                        label: "AR",
                        checked: this.note.detail.comorbid_valvular_heart_disease_AR
                    },
                    {
                        field: "comorbid_valvular_heart_disease_MS",
                        label: "MS",
                        checked: this.note.detail.comorbid_valvular_heart_disease_MS
                    },
                    {
                        field: "comorbid_valvular_heart_disease_MR",
                        label: "MR",
                        checked: this.note.detail.comorbid_valvular_heart_disease_MR
                    },
                    {
                        field: "comorbid_valvular_heart_disease_TR",
                        label: "TR",
                        checked: this.note.detail.comorbid_valvular_heart_disease_TR
                    }
                ]
            },
            cirrhosisSpecificChecks () {
                return [
                    {
                        field: "comorbid_cirrhosis_HBV",
                        label: "HBV",
                        checked: this.note.detail.comorbid_cirrhosis_HBV,
                        emitOnUpdate: 'click-comorbid_cirrhosis_none_cryptogenic',
                        setterEvent: "set-cirrhosis_HBV"
                    },
                    {
                        field: "comorbid_cirrhosis_HCV",
                        label: "HCV",
                        checked: this.note.detail.comorbid_cirrhosis_HCV,
                        emitOnUpdate: 'click-comorbid_cirrhosis_none_cryptogenic,click-comorbid_HCV',
                        setterEvent: "set-cirrhosis_HCV"
                    },
                    {
                        field: "comorbid_cirrhosis_NASH",
                        label: "NASH",
                        checked: this.note.detail.comorbid_cirrhosis_NASH,
                        emitOnUpdate: 'click-comorbid_cirrhosis_none_cryptogenic',
                        setterEvent: "set-cirrhosis_NASH"
                    },
                    {
                        field: "comorbid_cirrhosis_cryptogenic",
                        label: "Cryptogenic",
                        checked: this.note.detail.comorbid_cirrhosis_cryptogenic,
                        emitOnUpdate: 'click-comorbid_cirrhosis_cryptogenic',
                        setterEvent: "set-cirrhosis_cryptogenic"
                    }
                ]
            },
            dementiaSpecificChecks () {
                return [
                    {
                        field: "comorbid_dementia_vascular",
                        value: this.note.detail.comorbid_dementia_vascular,
                        label: "Vascular"
                    },
                    {
                        field: "comorbid_dementia_alzheimer",
                        value: this.note.detail.comorbid_dementia_alzheimer,
                        label: "Alzheimer"
                    }
                ]
            },
            strokeSymptoms () {
                return  [
                    {
                        field: 'comorbid_stroke_ischemic',
                        value: this.note.detail.comorbid_stroke_ischemic_text,
                        label: 'Ischemic :'
                    },
                    {
                        field: 'comorbid_stroke_hemorrhagic',
                        value: this.note.detail.comorbid_stroke_hemorrhagic_text,
                        label: 'Hemorrhagic :'
                    },
                    {
                        field: 'comorbid_stroke_iembolic',
                        value: this.note.detail.comorbid_stroke_iembolic_text,
                        label: 'Iembolic :'
                    }
                ]
            },
            HIVPreviousOpportunisticInfectionChecks () {
                return [
                    {
                        field: "comorbid_HIV_TB",
                        checked: this.note.detail.comorbid_HIV_TB,
                        label: "TB"
                    },
                    {
                        field: "comorbid_HIV_PCP",
                        checked: this.note.detail.comorbid_HIV_PCP,
                        label: "PCP"
                    },
                    {
                        field: "comorbid_HIV_candidiasis",
                        checked: this.note.detail.comorbid_HIV_candidiasis,
                        label: "Candidiasis"
                    },
                    {
                        field: "comorbid_HIV_CMV",
                        checked: this.note.detail.comorbid_HIV_CMV,
                        label: "CMV"
                    }
                ]
            },
            cancerOrganChecks () {
                return [
                    {
                        field: "comorbid_cancer_lung",
                        checked: this.note.detail.comorbid_cancer_lung,
                        label: "Lung"
                    },
                    {
                        field: "comorbid_cancer_liver",
                        checked: this.note.detail.comorbid_cancer_liver,
                        label: "Liver"
                    },
                    {
                        field: "comorbid_cancer_colon",
                        checked: this.note.detail.comorbid_cancer_colon,
                        label: "Colon"
                    },
                    {
                        field: "comorbid_cancer_breast",
                        checked: this.note.detail.comorbid_cancer_breast,
                        label: "Breast"
                    },
                    {
                        field: "comorbid_cancer_prostate",
                        checked: this.note.detail.comorbid_cancer_prostate,
                        label: "Prostate"
                    },
                    {
                        field: "comorbid_cancer_cervix",
                        checked: this.note.detail.comorbid_cancer_cervix,
                        label: "Cervix"
                    },
                    {
                        field: "comorbid_cancer_pancreas",
                        checked: this.note.detail.comorbid_cancer_pancreas,
                        label: "Pancreas"
                    },
                    {
                        field: "comorbid_cancer_brain",
                        checked: this.note.detail.comorbid_cancer_brain,
                        label: "Brain"
                    }
                ]
            },
            otherAutoimmuneDiseaseChecks () {
                return [
                    {
                        field: "comorbid_other_autoimmune_disease_UCTD",
                        label: "UCTD",
                        checked: this.note.detail.comorbid_other_autoimmune_disease_UCTD,
                        labelDescription: "Undifferentiated connective tissue disease"
                    },
                    {
                        field: "comorbid_other_autoimmune_disease_sjrogren_syndrome",
                        label: "Sjrögren syndrome",
                        checked: this.note.detail.comorbid_other_autoimmune_disease_sjrogren_syndrome,
                    },
                    {
                        field: "comorbid_other_autoimmune_disease_MCTD",
                        label: "MCTD",
                        checked: this.note.detail.comorbid_other_autoimmune_disease_MCTD,
                        labelDescription: "Mixed connective tissue disease"
                    },
                    {
                        field: "comorbid_other_autoimmune_disease_DMPM",
                        label: "DMPM",
                        checked: this.note.detail.comorbid_other_autoimmune_disease_DMPM,
                        labelDescription: "Dermatomyositis polymyositis"
                    }
                ]
            }
        }


        // implement input-text sync data
        // window.location.href
        // window.location.hostname
        // window.location.pathname
    }
</script>
