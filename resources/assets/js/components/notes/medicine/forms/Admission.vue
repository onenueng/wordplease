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
                    action="comorbid-negative-all"
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
                        setter-event="set-comorbid_DM"
                        :trigger-value="comorbidExtrasTriggerValue"
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
                        setter-event="set-comorbid_valvular_heart_disease"
                        :trigger-value="comorbidExtrasTriggerValue"
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
                        setter-event="set-comorbid_asthma"
                        :value="note.detail.comorbid_asthma">
                    </input-radio>
                </div><!-- asthma comorbid -->
                <div><hr class="line" /></div>

                <div class="material-box">
                    <input-radio
                        field="comorbid_cirrhosis"
                        label="Cirrhosis :"
                        :options="comorbidOptions"
                        setter-event="set-comorbid_cirrhosis"
                        :value="note.detail.comorbid_cirrhosis"
                        :trigger-value="comorbidExtrasTriggerValue"
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
                        label="HCV :"
                        :options="comorbidOptions"
                        setter-event="set-comorbid_HCV"
                        :value="note.detail.comorbid_HCV"
                        store-data='note-store-data'>
                    </input-radio>
                </div><!-- HCV comorbid -->
                <div><hr class="line" /></div>

                <div class="material-box">
                    <input-radio
                        field="comorbid_lukemia"
                        label="Lukemia"
                        :options="comorbidOptions"
                        setter-event="set-comorbid_lukemia"
                        :value="note.detail.comorbid_lukemia"
                        :trigger-value="comorbidExtrasTriggerValue"
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
                        :options="comorbidOptions"
                        setter-event="set-comorbid_ICD"
                        :value="note.detail.comorbid_ICD"
                        label-description="Implantable Cardioverter Defibrillator"
                        :trigger-value="comorbidExtrasTriggerValue"
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
                        label="SLE "
                        :options="comorbidOptions"
                        setter-event="set-comorbid_SLE"
                        :value="note.detail.comorbid_SLE">
                    </input-radio>
                </div><!-- comorbid SLE -->
                <div><hr class="line" /></div>

                <div class="material-box">
                    <input-radio
                        field="comorbid_dementia"
                        label="Dementia :"
                        :options="comorbidOptions"
                        setter-event="set-comorbid_dementia"
                        :value="note.detail.comorbid_dementia"
                        :trigger-value="comorbidExtrasTriggerValue"
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
                        setter-event="set-comorbid_HT"
                        :options="comorbidOptions">
                    </input-radio>
                </div><!-- HT comorbid -->
                <div><hr class="line" /></div>

                <div class="material-box">
                    <input-radio
                        field="comorbid_stroke"
                        :value="note.detail.comorbid_stroke"
                        label="Stroke : "
                        setter-event="set-comorbid_stroke"
                        :options="comorbidOptions"
                        :trigger-value="comorbidExtrasTriggerValue"
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
                        setter-event="set-comorbid_CKD"
                        :options="comorbidOptions"
                        label-description="Chronic Kidney Disease"
                        :trigger-value="comorbidExtrasTriggerValue"
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
                        setter-event="set-comorbid_coagulopathy"
                        :options="comorbidOptions">
                    </input-radio>
                </div> <!-- coagulopathy comorbid -->
                <div><hr class="line" /></div>

                <div class="material-box">
                    <input-radio
                        field="comorbid_HIV"
                        :value="note.detail.comorbid_HIV"
                        label="HIV :"
                        setter-event="set-comorbid_HIV"
                        :options="comorbidOptions"
                        :trigger-value="comorbidExtrasTriggerValue"
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
                        setter-event="set-comorbid_lymphoma"
                        :options="comorbidOptions"
                        :trigger-value="comorbidExtrasTriggerValue"
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
                        setter-event="set-comorbid_cancer"
                        :options="comorbidOptions"
                        :trigger-value="comorbidExtrasTriggerValue"
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
                        setter-event="set-comorbid_other_autoimmune_disease"
                        :options="comorbidOptions"
                        :trigger-value="comorbidExtrasTriggerValue"
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

                <div class="material-box">
                    <input-radio
                        field="comorbid_psychiatric_illness"
                        :value="note.detail.comorbid_psychiatric_illness"
                        label="Psychiatric illness :"
                        setter-event="set-comorbid_psychiatric_illness"
                        :options="comorbidOptions"
                        :trigger-value="comorbidExtrasTriggerValue"
                        emit-on-update="reset-comorbid_psychiatric_illness-extras">
                        <input-check-group
                            :checks="psychiatricIllnessChecks">
                        </input-check-group>
                        <input-text
                            field="comorbid_psychiatric_illness_other"
                            :value="note.detail.comorbid_psychiatric_illness_other"
                            placeholder="Other specific, type here.">
                        </input-text>
                    </input-radio>
                </div><!-- Psychiatric illness comorbid -->
                <div><hr class="line" /></div>
            </div><!-- comorbid HT, Stroke, CKD, Coagulopathy, HIV -->

            <div class="col-xs-12 col-sm-6 col-md-4">

                <div class="material-box">
                    <input-radio
                        field="comorbid_CAD"
                        :value="note.detail.comorbid_CAD"
                        label="CAD "
                        setter-event="set-comorbid_CAD"
                        :options="comorbidOptions"
                        label-description="Coronary Artery Disease"
                        :trigger-value="comorbidExtrasTriggerValue"
                        emit-on-update="reset-comorbid_CAD-extras">
                        
                        <div class="form-inline">
                            <input-select
                                field="comorbid_CAD_specific"
                                :value="note.detail.comorbid_CAD_specific_text"
                                label="Specify :"
                                size="normal">
                            </input-select>
                        </div><!-- CAD specify -->
                    </input-radio>
                </div><!-- CAD comorbid and its extra contents -->
                <div><hr class="line" /></div>

                <div class="material-box">
                    <input-radio
                        field="comorbid_COPD"
                        :value="note.detail.comorbid_COPD"
                        label="COPD :"
                        setter-event="set-comorbid_COPD"
                        :options="comorbidOptions">
                    </input-radio>
                </div><!-- COPD comorbid -->
                <div><hr class="line" /></div>

                <div class="material-box">
                    <input-radio
                        field="comorbid_hyperlipidemia"
                        :value="note.detail.comorbid_hyperlipidemia"
                        label="Hyperlipidemia : "
                        setter-event="set-comorbid_hyperlipidemia"
                        :options="comorbidOptions"
                        :trigger-value="comorbidExtrasTriggerValue"
                        emit-on-update="reset-comorbid_hyperlipidemia-extras">
                        
                        <div class="form-inline">
                            <input-select
                                field="comorbid_hyperlipidemia_specific"
                                :value="note.detail.comorbid_hyperlipidemia_specific"
                                label="Specify :"
                                size="normal"
                                not-allow-other>
                            </input-select>
                        </div><!-- hyperlipidemia specify -->
                    </input-radio><!-- hyperlipidemia comorbid and its extra contents -->
                </div><!-- hyperlipidemia comorbid and its extra contents -->
                <div><hr class="line" /></div>

                <div class="material-box">
                    <input-radio
                        field="comorbid_HBV"
                        :value="note.detail.comorbid_HBV"
                        label="HBV infection :"
                        setter-event="set-comorbid_HBV"
                        :options="comorbidOptions"
                        store-data='note-store-data'>
                    </input-radio>
                </div><!-- HBV comorbid -->
                <div><hr class="line" /></div>

                <div class="material-box">
                    <input-radio
                        field="comorbid_epilepsy"
                        :value="note.detail.comorbid_epilepsy"
                        label="Epilepsy :"
                        setter-event="set-comorbid_epilepsy"
                        :options="comorbidOptions"
                        :trigger-value="comorbidExtrasTriggerValue"
                        emit-on-update="reset-comorbid_epilepsy-extras">

                        <!-- epilepsy specify -->
                        <div class="form-inline">
                            <input-select
                                field="comorbid_epilepsy_specific"
                                :value="note.detail.comorbid_epilepsy_specific_text"
                                label="Specify :"
                                size="normal">
                            </input-select>
                        </div>
                    </input-radio>
                </div><!-- epilepsy comorbid -->
                <div><hr class="line" /></div>

                <div class="material-box">
                    <input-radio
                        field="comorbid_pacemaker_implant"
                        :value="note.detail.comorbid_pacemaker_implant"
                        label="Pacemaker implant :"
                        setter-event="set-comorbid_pacemaker_implant"
                        :options="comorbidOptions"
                        :trigger-value="comorbidExtrasTriggerValue"
                        emit-on-update="reset-comorbid_pacemaker_implant-extras">
                        
                        <input-radio 
                            field="comorbid_pacemaker_implant_specific"
                            :value="note.detail.comorbid_pacemaker_implant_specific"
                            label="Specify :"
                            options='[
                                {
                                    "label": "DDDR", "value": 1,
                                    "labelDescription": "dual-chamber, rate-modulated"
                                },
                                {   "label": "VI", "value": 2   }
                            ]'>
                        </input-radio>
                    </input-radio><!-- Pacemaker implant Child-Pugh's score -->
                </div><!-- Pacemaker implant cirrhosis -->
                <div><hr class="line" /></div>

                <div class="material-box">
                    <input-radio
                        field="comorbid_chronic_arthritis"
                        :value="note.detail.comorbid_chronic_arthritis"
                        label="Chronic arthritis :"
                        setter-event="set-comorbid_chronic_arthritis"
                        :options="comorbidOptions"
                        :trigger-value="comorbidExtrasTriggerValue"
                        emit-on-update="reset-comorbid_chronic_arthritis-extras">
                        
                        <input-check-group 
                            :checks="chronicArthritisSpecificChecks">
                        </input-check-group><!-- Chronic arthritis specify Lung Liver Colon Breast Prostate Cervix Pancreas Brain  -->

                        <input-text
                            field="comorbid_chronic_arthritis_other"
                            :value="note.detail.comorbid_chronic_arthritis_other"
                            size="normal"
                            placeholder="Other specific, type here.">
                        </input-text><!-- Chronic arthritis specify other -->
                    </input-radio>
                </div><!-- comorbid Chronic arthritis -->
                <div><hr class="line" /></div>

                <div class="material-box">
                    <input-radio
                        field="comorbid_TB"
                        :value="note.detail.comorbid_TB"
                        label="TB :"
                        setter-event="set-comorbid_TB"
                        :options="comorbidOptions"
                        :trigger-value="comorbidExtrasTriggerValue"
                        emit-on-update="reset-comorbid_TB-extras">
                        
                        <input-check-group 
                            :checks="TBSpecificChecks">
                        </input-check-group><!-- TB specify  -->

                        <input-text
                            field="comorbid_TB_other"
                            :value="note.detail.comorbid_TB_other"
                            size="normal"
                            placeholder="Other specific, type here.">
                        </input-text><!-- TB specify other -->
                    </input-radio>
                </div><!-- comorbid TB -->
                <div><hr class="line" /></div>
            </div><!-- CAD, COPD, Hyperlipidemia, HBV -->
            
            <input-textarea
                field="other_comorbid"
                :value="note.detail.other_comorbid"
                label="Other comorbid :"
                grid="12-12-12"
                max-chars="1000">
            </input-textarea><!-- other comorbid  -->
            <div class="col-xs-12"><hr class="line" /></div>

            <input-textarea
                field="history_of_present_illness"
                :value="note.detail.history_of_present_illness"
                label="History of present illness :"
                grid="12-12-6"
                max-chars="2000" >
            </input-textarea><!-- history of present illness  -->
            <input-textarea
                field="history_of_past_illness"
                :value="note.detail.history_of_past_illness"
                label="History of past illness :"
                grid="12-12-6"
                max-chars="2000" >
            </input-textarea><!-- history of past illness  -->
        </div><!-- wrap content with row class -->
    </panel><!-- Panel Hisroty -->
    <panel heading="Personal and Social history">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-4" v-if="note.admission.patient.gender == 0">
                <div class="material-box">
                    <input-radio
                        field="pregnancy"
                        :value="note.detail.pregnancy"
                        label="Pregnant : "
                        options='[
                            {"label": "No", "value": "0"},
                            {"label": "Yes", "value": "1"},
                            {"label": "Uncertain", "value": "2"}
                        ]'
                        :trigger-value="comorbidExtrasTriggerValue"
                        emit-on-update="reset-pregnancy-extras">
                        <input-text-addon
                            field="gestation_weeks"
                            :value="note.detail.gestation_weeks"
                            front-addon="Gestation"
                            pattern="^([1-9]|[123]\d|40)$"
                            invalid-text="Data could not be saved, Accept 1 to 40 weeks only."
                            rear-addon="Weeks">
                        </input-text-addon>
                    </input-radio>

                    <input-text-addon
                        field="LMP"
                        :value="note.detail.LMP"
                        front-addon='LMP <a role="button" data-toggle="tooltip" title="ลงข้อมูล LMP เป็นวันที่ในรูปแบบ dd/mm/yyyy หรือหากไม่ทราบให้บรรยายเช่น 10 ปีที่ผ่านมา เป็นต้น"><i class="fa fa-info-circle"></i></a>'>
                    </input-text-addon><!-- LMP -->
                </div><!-- pregnancy -->
            </div><!-- Female's Extras -->

            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="material-box">
                    <input-radio
                        field="alcohol"
                        :value="note.detail.alcohol"
                        label="Alcohol : "
                        options='[
                            {"label": "No", "value": "0"},
                            {"label": "Yes", "value": "1"},
                            {"label": "Ex-drinker", "value": "2"}
                        ]'
                        trigger-value="[1,2]"
                        emit-on-update="reset-alcohol-extras">
                        
                        <input-textarea
                            field="alcohol_description"
                            :value="note.detail.alcohol_description"
                            placeholder="description">
                        </input-textarea><!-- alcohol_description  -->
                    </input-radio>
                </div>
            </div><!-- alcohol -->

            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="material-box">
                    <input-radio
                        field="cigarette_smoking"
                        :value="note.detail.cigarette_smoking"
                        label="Cigarette smoking : "
                        options='[
                            {"label": "No", "value": "0"},
                            {"label": "Yes", "value": "1"},
                            {"label": "Ex-smoker", "value": "2"}
                        ]'
                        trigger-value="[1,2]"
                        emit-on-update="reset-cigarette_smoking-extras">
                        
                        <input-textarea
                            field="smoke_description"
                            :value="note.detail.smoke_description"
                            placeholder="description">
                        </input-textarea><!-- smoke_description  -->
                    </input-radio>
                </div>
            </div><!-- smoke -->

            <div class="col-xs-12"><hr class="line" /></div><!-- seperate line -->

            <input-textarea
                field="personal_social_history"
                :value="note.detail.personal_social_history"
                placeholder="personal and social history description"
                grid="12-12-12"
                max-chars="2000" >
            </input-textarea><!-- personal social history -->
        </div><!-- wrap content with row class -->
    </panel><!-- panel Personal and Social history -->
    <panel heading="Special requirement">
        <div class="row">
            <div class="col-xs-12">
                <input-check-group
                    :checks="specialRequirementChecks">
                </input-check-group>
            </div>

            <input-textarea
                field="other_special_requirement"
                :value="note.detail.other_special_requirement"
                placeholder="Other requirement, type here"
                grid="12-12-12">
            </input-textarea><!-- other special requirement -->
        </div><!-- wrap with row -->
    </panel><!-- panel Special requirement -->
    <panel heading="Family history">
        <div class="row">
            <input-textarea
                field="family_history"
                :value="note.detail.family_history"
                grid="12-12-12"
                max-chars="2000">
            </input-textarea>
        </div><!-- wrap with row -->
    </panel><!-- panel Family history -->
    <panel heading="Current medications">
        <div class="row">
            <input-suggestion
                ref="current_medications_helper"
                target-id="current_medications_helper"
                store-data="store-data"
                setterEvent="set-current_medications_helper"
                grid="8-8-4"
                service-url="autocomplete/drug"
                placeholder="search drug using generic, trade or synonym name">
            </input-suggestion><!-- drug search helper -->

            <button-app
                action="append-current_medications"
                label="Append"
                status="draft"
                size="sm">
            </button-app><!-- med append button -->

            <button-app
                action="put-current_medications"
                label="Put"
                status="draft"
                size="sm">
            </button-app><!-- med put button -->
            
            <input-textarea
                field="current_medications"
                :value="note.detail.current_medications"
                setter-event="set-current_medications"
                max-chars="1000"
                grid="12-12-12">
            </input-textarea><!-- current medications -->
        </div><!-- wrap with row -->
    </panel><!-- panel Current medications -->
    <panel heading="Allergy/Adverse event (Drug, Food, Chemical)">
        <div class="row">
            <input-textarea
                field="allergy"
                :value="note.detail.allergy"
                grid="12-12-12">
            </input-textarea><!-- allergy -->
        </div><!-- wrap with row -->
    </panel><!-- Panel allergy -->
    <panel heading="Review of systems">
        <div class="row">
            <input-textarea
                field="general_symptoms"
                :value="note.detail.general_symptoms"
                label="General symptoms :"
                grid="12-12-12">
            </input-textarea><!-- General symptoms -->
            <div class="col-xs-12"><hr class="line" /></div>

            <div class="col-xs-12 col-md-6">
                <div class="col-xs-12">
                    <input-radio
                        field="review_system_hair_and_skin"
                        :value="note.detail.review_system_hair_and_skin"
                        label="Hair and Skin :"
                        :options="reviewSystemPhysicalExamOptions">
                    </input-radio>
                </div><!-- review_system_hair_and_skin -->
                <input-textarea
                    field="review_system_hair_and_skin_description"
                    :value="note.detail.review_system_hair_and_skin_description"
                    placeholder="description"
                    max-chars="1000"
                    grid="12-12-12">
                </input-textarea><!-- review_system_hair_and_skin_description -->
                <div class="col-xs-12"><hr class="line" /></div>

                <div class="col-xs-12">
                    <input-radio
                        field="review_system_head"
                        :value="note.detail.review_system_head"
                        label="Head :"
                        :options="reviewSystemPhysicalExamOptions">
                    </input-radio>
                </div><!-- review_system_head -->
                <input-textarea
                    field="review_system_head_description"
                    :value="note.detail.review_system_head_description"
                    placeholder="description"
                    max-chars="1000"
                    grid="12-12-12">
                </input-textarea><!-- review_system_head_description -->
                <div class="col-xs-12"><hr class="line" /></div>

                <div class="col-xs-12">
                    <input-radio
                        field="review_system_eye_ENT"
                        :value="note.detail.review_system_eye_ENT"
                        label="Eye/ENT :"
                        :options="reviewSystemPhysicalExamOptions">
                    </input-radio>
                </div><!-- review_system_eye_ENT -->
                <input-textarea
                    field="review_system_eye_ENT_description"
                    :value="note.detail.review_system_eye_ENT_description"
                    placeholder="description"
                    max-chars="1000"
                    grid="12-12-12">
                </input-textarea><!-- review_system_eye_ENT_description -->
                <div class="col-xs-12"><hr class="line" /></div>

                <div class="col-xs-12">
                    <input-radio
                        field="review_system_breast"
                        :value="note.detail.review_system_breast"
                        label="Breast :"
                        :options="reviewSystemPhysicalExamOptions">
                    </input-radio>
                </div><!-- review_system_breast -->
                <input-textarea
                    field="review_system_breast_description"
                    :value="note.detail.review_system_breast_description"
                    placeholder="description"
                    max-chars="1000"
                    grid="12-12-12">
                </input-textarea><!-- review_system_breast_description -->
                <div class="col-xs-12"><hr class="line" /></div>

                <div class="col-xs-12">
                    <input-radio
                        field="review_system_CVS"
                        :value="note.detail.review_system_CVS"
                        label="CVS :"
                        :options="reviewSystemPhysicalExamOptions">
                    </input-radio>
                </div><!-- review_system_CVS -->
                <input-textarea
                    field="review_system_CVS_description"
                    :value="note.detail.review_system_CVS_description"
                    placeholder="description"
                    max-chars="1000"
                    grid="12-12-12">
                </input-textarea><!-- review_system_CVS_description -->
                <div class="col-xs-12"><hr class="line" /></div>

                <div class="col-xs-12">
                    <input-radio
                        field="review_system_RS"
                        :value="note.detail.review_system_RS"
                        label="RS :"
                        :options="reviewSystemPhysicalExamOptions">
                    </input-radio>
                </div><!-- review_system_RS -->
                <input-textarea
                    field="review_system_RS_description"
                    :value="note.detail.review_system_RS_description"
                    placeholder="description"
                    max-chars="1000"
                    grid="12-12-12">
                </input-textarea><!-- review_system_RS_description -->
                <div class="col-xs-12"><hr class="line" /></div>
            </div>

            <div class="col-xs-12 col-md-6">
                <div class="col-xs-12">
                    <input-radio
                        field="review_system_GI"
                        :value="note.detail.review_system_GI"
                        label="GI :"
                        :options="reviewSystemPhysicalExamOptions">
                    </input-radio>
                </div><!-- review_system_GI -->
                <input-textarea
                    field="review_system_GI_description"
                    :value="note.detail.review_system_GI_description"
                    placeholder="description"
                    max-chars="1000"
                    grid="12-12-12">
                </input-textarea><!-- review_system_GI_description -->
                <div class="col-xs-12"><hr class="line" /></div>

                <div class="col-xs-12">
                    <input-radio
                        field="review_system_GU"
                        :value="note.detail.review_system_GU"
                        label="GU :"
                        :options="reviewSystemPhysicalExamOptions">
                    </input-radio>
                </div><!-- review_system_GU -->
                <input-textarea
                    field="review_system_GU_description"
                    :value="note.detail.review_system_GU_description"
                    placeholder="description"
                    max-chars="1000"
                    grid="12-12-12">
                </input-textarea><!-- review_system_GU_description -->
                <div class="col-xs-12"><hr class="line" /></div>

                <div class="col-xs-12">
                    <input-radio
                        field="review_system_musculoskeletal"
                        :value="note.detail.review_system_musculoskeletal"
                        label="Musculoskeletal :"
                        :options="reviewSystemPhysicalExamOptions">
                    </input-radio>
                </div><!-- review_system_musculoskeletal -->
                <input-textarea
                    field="review_system_musculoskeletal_description"
                    :value="note.detail.review_system_musculoskeletal_description"
                    placeholder="description"
                    max-chars="1000"
                    grid="12-12-12">
                </input-textarea><!-- review_system_musculoskeletal_description -->
                <div class="col-xs-12"><hr class="line" /></div>

                <div class="col-xs-12">
                    <input-radio
                        field="review_system_nervous_system"
                        :value="note.detail.review_system_nervous_system"
                        label="Nervous system :"
                        :options="reviewSystemPhysicalExamOptions">
                    </input-radio>
                </div><!-- review_system_nervous_system -->
                <input-textarea
                    field="review_system_nervous_system_description"
                    :value="note.detail.review_system_nervous_system_description"
                    placeholder="description"
                    max-chars="1000"
                    grid="12-12-12">
                </input-textarea><!-- review_system_nervous_system_description -->
                <div class="col-xs-12"><hr class="line" /></div>

                <div class="col-xs-12">
                    <input-radio
                        field="review_system_psychological_symptoms"
                        :value="note.detail.review_system_psychological_symptoms"
                        label="Psychological symptoms :"
                        :options="reviewSystemPhysicalExamOptions">
                    </input-radio>
                </div><!-- review_system_psychological_symptoms -->
                <input-textarea
                    field="review_system_psychological_symptoms_description"
                    :value="note.detail.review_system_psychological_symptoms_description"
                    placeholder="description"
                    max-chars="1000"
                    grid="12-12-12">
                </input-textarea><!-- review_system_psychological_symptoms_description -->
                <div class="col-xs-12"><hr class="line" /></div>
            </div>
        </div><!-- wrap with row -->
    </panel><!-- Review of systems -->
    <panel heading="Vital signs">
        <div class="row">
            <input-text-addon
                field="temperature_celsius"
                :value="note.detail.temperature_celsius"
                label="Temperature :"
                pattern="^((([234]\d{1})?([.]?\d?)?)|50([.]?0*)?)$"
                invalid-text="Data could not be saved. Accept range [20, 50], Integer or 1 point decimal only"
                rear-addon="&deg;C"
                placeholder="Integer or 1 point decimal only"
                grid="12-6-3">
            </input-text-addon><!-- Temperature valid xx.y[20, 50] -->
            <input-text-addon
                field="pulse_rate_per_min"
                :value="note.detail.pulse_rate_per_min"
                label="Pulse :"
                pattern="^([23456789]\d|[1][01]\d|120)$"
                invalid-text="Data could not be saved. Accept range [20, 120], Integer only"
                rear-addon="/min"
                placeholder="Integer only"
                grid="12-6-3">
            </input-text-addon><!-- Pulse -->
            <input-text-addon
                field="respiratory_rate_per_min"
                :value="note.detail.respiratory_rate_per_min"
                label="Respiratory rate :"
                pattern="^([1]\d|[23]\d|40)$"
                invalid-text="Data could not be saved. Accept range [10, 40], Integer only"
                rear-addon="/min"
                placeholder="Integer only"
                grid="12-6-3">
            </input-text-addon><!-- Respiratory rate -->
            <input-text-addon
                field="BP"
                :value="note.detail.BP"
                label="Blood presure :"
                rear-addon="mmHg"
                placeholder="SBP/DBP"
                pattern="^([89]\d|1[123]\d|140)\/([5678]\d|90)$"
                invalid-text="Data could not be saved. Accept range [80, 140]/[50, 90], in SBP/DBP format"
                grid="12-6-3">
            </input-text-addon><!-- BP -->
            <input-text-addon
                field="height_cm"
                :value="note.detail.height_cm"
                label="Height :"
                :front-addon="estimatedHeightTemplate"
                rear-addon="cm"
                emit-on-update="BMI-updates"
                placeholder="Integer or 1 point decimal only"
                store-data="note-store-data"
                pattern="^([5-9]\d([.]?\d)?|[1]\d{2}([.]?\d)?|[2][0-7]\d([.]?\d)?|280([.]?0*)?)$"
                invalid-text="Data could not be saved. Accept range [50, 280], Integer or 1 point decimal only"
                grid="12-6-3">
            </input-text-addon><!-- height_cm -->
            <input-text-addon
                field="weight_kg"
                :value="note.detail.weight_kg"
                label="Weight :"
                :front-addon="estimatedWeightTemplate"
                rear-addon="kg"
                emit-on-update="BMI-updates"
                placeholder="Integer or 1 point decimal only"
                store-data="note-store-data"
                pattern="^([2-9]\d([.]?\d)?|[1-5]\d{2}([.]?\d)?|600([.]?0*)?)$"
                invalid-text="Data could not be saved. Accept range [20, 600], Integer or 1 point decimal only"
                grid="12-6-3">
            </input-text-addon><!-- weight_kg -->
            <input-text-addon
                :value="autoCalculateBMI"
                label="BMI "
                ref="BMI"
                label-description="Auto calculate"
                rear-addon="kg/m<sup>2</sup>"
                grid="12-6-3"
                setter-event="update-BMI"
                readonly>
            </input-text-addon><!-- BMI -->
            <input-text-addon
                field="SpO2"
                :value="note.detail.SpO2"
                label='SpO<sub>2</sub> '
                label-description="as indicated"
                pattern="^([3-9]\d|100)$"
                invalid-text="Data could not be saved. Accept range [30, 100], Integer only"
                rear-addon="%"
                grid="12-6-3">
            </input-text-addon><!-- SpO2 -->
            <div class="col-xs-12 col-md-6">
                <div class="material-box">
                    <input-radio
                        field="breathing"
                        label="Breathing :"
                        :value="note.detail.breathing"
                        options='[
                            {"label": "Room air", "value": 1},
                            {"label": "O<sub>2</sub>-Canula", "value": 2},
                            {"label": "O<sub>2</sub>-Mask with bag", "value": 3},
                            {"label": "O<sub>2</sub>-On ventilator", "value": 4}
                        ]'
                        trigger-value="[2,3,4]"
                        store-data="note-store-data"
                        emit-on-update="reset-breathing-extras">
                        <div class="form-inline">
                            <input-text-addon
                                field="O2_rate"
                                :value="note.detail.O2_rate"
                                front-addon="O<sub>2</sub> rate"
                                :rear-addon="O2RateRearAddon"
                                pattern="^((\d{1,2})([.]\d)?)$"
                                invalid-text="Data could not be saved. Accept range [0, 99.9], Integer or 1 point decimal only">
                            </input-text-addon>
                        </div>
                    </input-radio>
                </div><!-- breathing -->
                <div class="material-box">
                    <input-radio
                        field="mental_evaluation"
                        :value="note.detail.mental_evaluation"
                        label="Mental evaluation :"
                        options='[
                            {"label": "Awake", "value": 1},
                            {"label": "Drowsy", "value": 2},
                            {"label": "Stuporous", "value": 3},
                            {"label": "Unconscious", "value": 4}
                        ]'>
                    </input-radio>
                    <input-check-group
                        label="Mental orientation :"
                        :checks="mentalOrientationChecks">
                    </input-check-group>
                </div><!-- Mental evaluation -->
            </div>
            <div class="col-xs-12 col-md-6">
                <div class="material-box">
                    <input-radio
                        field="level_of_consciousness"
                        :value="note.detail.level_of_consciousness"
                        label="Level of consciousness :"
                        options='[
                            {"label": "Appropriate", "value": 1},
                            {"label": "Retardation", "value": 2},
                            {"label": "Depressed", "value": 3},
                            {"label": "Psychotic", "value": 4}
                        ]'>
                    </input-radio>
                    <div class="form-inline">
                        <input-text
                            placeholder="Glassglow coma score:Auto Calculate"
                            :value="autoCalculateGCS"
                            readonly
                            setter-event="update-GCS">
                        </input-text>
                    </div>
                    <div class="form-inline">
                        <input-select
                            field="GCS_E"
                            :value="note.detail.GCS_E_text"
                            size="normal"
                            not-allow-other
                            placeholder="select GCS - E"
                            store-data="note-store-data"
                            emit-on-update="GCS-updates">
                        </input-select>
                    </div>
                    <div class="form-inline">
                        <input-select
                            field="GCS_V"
                            :value="note.detail.GCS_V_text"
                            size="normal"
                            not-allow-other
                            placeholder="select GCS - V"
                            store-data="note-store-data"
                            emit-on-update="GCS-updates">
                        </input-select>
                    </div>
                    <div class="form-inline">
                        <input-select
                            field="GCS_M"
                            :value="note.detail.GCS_M_text"
                            size="normal"
                            not-allow-other
                            placeholder="select GCS - M"
                            store-data="note-store-data"
                            emit-on-update="GCS-updates">
                        </input-select>
                    </div>
                </div>
            </div><!-- Level of consciousness -->
        </div><!-- wrap with row -->
    </panel><!-- Vital signs -->
    <panel heading="Physical examinations">
        <div class="row">
            <input-textarea
                field="general_appearance"
                :value="note.detail.general_appearance"
                label="General appearance :"
                placeholder="Specify important findings"
                max-chars="2000"
                grid="12-12-12">
            </input-textarea><!-- General appearance -->

            <div class="col-xs-12"><hr class="line" /></div>
            
            <div class="col-xs-12 col-md-6">
                <div class="col-xs-12">
                    <input-radio
                        field="physical_exam_skin"
                        :value="note.detail.physical_exam_skin"
                        label="Skin :"
                        :options="reviewSystemPhysicalExamOptions">
                    </input-radio>
                </div><!-- exam skin -->
                <input-textarea
                    field="physical_exam_skin_description"
                    :value="note.detail.physical_exam_skin_description"
                    placeholder="description"
                    max-chars="2000"
                    grid="12-12-12">
                </input-textarea>
                <div class="col-xs-12"><hr class="line" /></div>
                <div class="col-xs-12">
                    <input-radio
                        field="physical_exam_head"
                        :value="note.detail.physical_exam_head"
                        label="Head :"
                        :options="reviewSystemPhysicalExamOptions">
                    </input-radio>
                </div><!-- exam head -->
                <input-textarea
                    field="physical_exam_head_description"
                    :value="note.detail.physical_exam_head_description"
                    placeholder="description"
                    max-chars="2000"
                    grid="12-12-12">
                </input-textarea>
                <div class="col-xs-12"><hr class="line" /></div>
                <div class="col-xs-12">
                    <input-radio
                        field="physical_exam_eye_ENT"
                        :value="note.detail.physical_exam_eye_ENT"
                        label="Eye/ENT :"
                        :options="reviewSystemPhysicalExamOptions">
                    </input-radio>
                </div><!-- exam eye_ENT -->
                <input-textarea
                    field="physical_exam_eye_ENT_description"
                    :value="note.detail.physical_exam_eye_ENT_description"
                    placeholder="description"
                    max-chars="2000"
                    grid="12-12-12">
                </input-textarea>
                <div class="col-xs-12"><hr class="line" /></div>
                <div class="col-xs-12">
                    <input-radio
                        field="physical_exam_neck"
                        :value="note.detail.physical_exam_neck"
                        label="Neck :"
                        :options="reviewSystemPhysicalExamOptions">
                    </input-radio>
                </div><!-- exam neck -->
                <input-textarea
                    field="physical_exam_neck_description"
                    :value="note.detail.physical_exam_neck_description"
                    placeholder="description"
                    max-chars="2000"
                    grid="12-12-12">
                </input-textarea>
                <div class="col-xs-12"><hr class="line" /></div>
                <div class="col-xs-12">
                    <input-radio
                        field="physical_exam_heart"
                        :value="note.detail.physical_exam_heart"
                        label="Heart :"
                        :options="reviewSystemPhysicalExamOptions">
                    </input-radio>
                </div><!-- exam heart -->
                <input-textarea
                    field="physical_exam_heart_description"
                    :value="note.detail.physical_exam_heart_description"
                    placeholder="description"
                    max-chars="2000"
                    grid="12-12-12">
                </input-textarea>
                <div class="col-xs-12"><hr class="line" /></div>
                <div class="col-xs-12">
                    <input-radio
                        field="physical_exam_lung"
                        :value="note.detail.physical_exam_lung"
                        label="Lung :"
                        :options="reviewSystemPhysicalExamOptions">
                    </input-radio>
                </div><!-- exam lung -->
                <input-textarea
                    field="physical_exam_lung_description"
                    :value="note.detail.physical_exam_lung_description"
                    placeholder="description"
                    max-chars="2000"
                    grid="12-12-12">
                </input-textarea>
                <div class="col-xs-12"><hr class="line" /></div>
                <div class="col-xs-12">
                    <input-radio
                        field="physical_exam_abdomen"
                        :value="note.detail.physical_exam_abdomen"
                        label="Abdomen :"
                        :options="reviewSystemPhysicalExamOptions">
                    </input-radio>
                </div><!-- exam abdomen -->
                <input-textarea
                    field="physical_exam_abdomen_description"
                    :value="note.detail.physical_exam_abdomen_description"
                    placeholder="description"
                    max-chars="2000"
                    grid="12-12-12">
                </input-textarea>
                <div class="col-xs-12"><hr class="line" /></div>
            </div><!-- exam skin, head, eye_ENT, neck, heart, lung, abdomen -->
            <div class="col-xs-12 col-md-6">
                <div class="col-xs-12">
                    <input-radio
                        field="physical_exam_nervous_system"
                        :value="note.detail.physical_exam_nervous_system"
                        label="Nervous system :"
                        :options="reviewSystemPhysicalExamOptions">
                    </input-radio>
                </div><!-- exam nervous_system -->
                <input-textarea
                    field="physical_exam_nervous_system_description"
                    :value="note.detail.physical_exam_nervous_system_description"
                    placeholder="description"
                    max-chars="2000"
                    grid="12-12-12">
                </input-textarea>
                <div class="col-xs-12"><hr class="line" /></div>
                <div class="col-xs-12">
                    <input-radio
                        field="physical_exam_extremities"
                        :value="note.detail.physical_exam_extremities"
                        label="Extremities :"
                        :options="reviewSystemPhysicalExamOptions">
                    </input-radio>
                </div><!-- exam extremities -->
                <input-textarea
                    field="physical_exam_extremities_description"
                    :value="note.detail.physical_exam_extremities_description"
                    placeholder="description"
                    max-chars="2000"
                    grid="12-12-12">
                </input-textarea>
                <div class="col-xs-12"><hr class="line" /></div>
                <div class="col-xs-12">
                    <input-radio
                        field="physical_exam_lymph_nodes"
                        :value="note.detail.physical_exam_lymph_nodes"
                        label="Lymph nodes :"
                        :options="reviewSystemPhysicalExamOptions">
                    </input-radio>
                </div><!-- exam lymph_nodes -->
                <input-textarea
                    field="physical_exam_lymph_nodes_description"
                    :value="note.detail.physical_exam_lymph_nodes_description"
                    placeholder="description"
                    max-chars="2000"
                    grid="12-12-12">
                </input-textarea>
                <div class="col-xs-12"><hr class="line" /></div>
                <div class="col-xs-12">
                    <input-radio
                        field="physical_exam_breasts"
                        :value="note.detail.physical_exam_breasts"
                        label="Breasts :"
                        :options="reviewSystemPhysicalExamOptions">
                    </input-radio>
                </div><!-- exam breasts -->
                <input-textarea
                    field="physical_exam_breasts_description"
                    :value="note.detail.physical_exam_breasts_description"
                    placeholder="description"
                    max-chars="2000"
                    grid="12-12-12">
                </input-textarea>
                <div class="col-xs-12"><hr class="line" /></div>
                <div class="col-xs-12">
                    <input-radio
                        field="physical_exam_genitalia"
                        :value="note.detail.physical_exam_genitalia"
                        label="Genitalia :"
                        :options="reviewSystemPhysicalExamOptions">
                    </input-radio>
                </div><!-- exam genitalia -->
                <input-textarea
                    field="physical_exam_genitalia_description"
                    :value="note.detail.physical_exam_genitalia_description"
                    placeholder="description"
                    max-chars="2000"
                    grid="12-12-12">
                </input-textarea>
                <div class="col-xs-12"><hr class="line" /></div>
                <div class="col-xs-12">
                    <input-radio
                        field="physical_exam_rectal_examination"
                        :value="note.detail.physical_exam_rectal_examination"
                        label="Rectal examination :"
                        :options="reviewSystemPhysicalExamOptions">
                    </input-radio>
                </div><!-- exam rectal_examination -->
                <input-textarea
                    field="physical_exam_rectal_examination_description"
                    :value="note.detail.physical_exam_rectal_examination_description"
                    placeholder="description"
                    max-chars="2000"
                    grid="12-12-12">
                </input-textarea>
                <div class="col-xs-12"><hr class="line" /></div>
            </div><!-- exam nervous_system, extremities, lymph_nodes, breasts, genitalia, rectal_examination -->
        </div><!-- wrap with row -->
    </panel><!-- Physical examinations -->
</div>
</template>

<script>
    import Panel from '../../../Panel.vue'
    import InputText from '../../../inputs/InputText.vue'
    import InputCheck from '../../../inputs/InputCheck.vue'
    import InputRadio from '../../../inputs/InputRadio.vue'
    import InputSelect from '../../../inputs/InputSelect.vue'
    import InputTextarea from '../../../inputs/InputTextarea.vue'
    import InputTextAddon from '../../../inputs/InputTextAddon.vue'
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
            'input-text-addon' : InputTextAddon,
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
                store: {},
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

            this.comorbidExtrasTriggerValue = 1

            this.cirrhosisLabelAction = {
                emit: "toggle-modal-child-pugh-score-detail",
                icon: "question-circle",
                title: "Click to learn more about Child-Pugh's Score"
            }

            this.reviewSystemPhysicalExamOptions = [
                { label: "Normal", value: 1 },
                { label: "Abnormal", value: 2 }
            ]
        },
        mounted () {
            EventBus.$on('comorbid-negative-all', () => { this.setComorbidAll(0) })

            EventBus.$on('comorbid-no-data-all', () => { this.setComorbidAll(255) })

            EventBus.$on('store-data', (field, value) => { this.store[field] = value })

            EventBus.$on('note-store-data', (field, value) => { this.note.detail[field] = value })

            EventBus.$on('reset-comorbid_DM-extras', (value) => {
                if ( value != this.comorbidExtrasTriggerValue ) {
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
                if ( value != this.comorbidExtrasTriggerValue ) {
                    this.note.detail.comorbid_valvular_heart_disease_AS = false
                    this.note.detail.comorbid_valvular_heart_disease_AR = false
                    this.note.detail.comorbid_valvular_heart_disease_MS = false
                    this.note.detail.comorbid_valvular_heart_disease_MR = false
                    this.note.detail.comorbid_valvular_heart_disease_TR = false
                    this.note.detail.comorbid_valvular_heart_disease_other = null
                }
            })

            EventBus.$on('reset-comorbid_cirrhosis-extras', (value) => {
                if ( value != this.comorbidExtrasTriggerValue ) {
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

            EventBus.$on('click-comorbid_HBV', (value) => {
                if (value && this.note.detail.comorbid_HBV !== 1) {
                    EventBus.$emit('set-comorbid_HBV', 1)
                    EventBus.$emit('toggle-alert-box', 'HBV infection also checked')
                }
            })

            EventBus.$on('reset-comorbid_lukemia-extras', (value) => {
                if ( value != this.comorbidExtrasTriggerValue ) {
                    this.note.detail.comorbid_lukemia_specific = null
                }
            })

            EventBus.$on('reset-comorbid_ICD-extras', (value) => {
                if ( value != this.comorbidExtrasTriggerValue ) {
                    this.note.detail.comorbid_ICD_other = null
                }
            })

            EventBus.$on('reset-comorbid_dementia-extras', (value) => {
                if ( value != this.comorbidExtrasTriggerValue ) {
                    this.note.detail.comorbid_dementia_vascular = false
                    this.note.detail.comorbid_dementia_alzheimer = false
                    this.note.detail.comorbid_dementia_other = null
                }
            })

            EventBus.$on('reset-comorbid_stroke-extras', (value) => {
                if ( value != this.comorbidExtrasTriggerValue ) {
                    this.note.detail.comorbid_stroke_ischemic_text = null
                    this.note.detail.comorbid_stroke_hemorrhagic_text = null
                    this.note.detail.comorbid_stroke_iembolic_text = null
                }
            })

            EventBus.$on('reset-comorbid_CKD-extras', (value) => {
                if ( value != this.comorbidExtrasTriggerValue ) {
                    this.note.detail.comorbid_CKD_stage_text = null
                }
            })

            EventBus.$on('reset-comorbid_HIV-extras', (value) => {
                if ( value != this.comorbidExtrasTriggerValue ) {
                    this.note.detail.comorbid_HIV_other = null
                    this.note.detail.comorbid_HIV_TB = false
                    this.note.detail.comorbid_HIV_PCP = false
                    this.note.detail.comorbid_HIV_candidiasis = false
                    this.note.detail.comorbid_HIV_CMV = false
                }
            })

            EventBus.$on('reset-comorbid_lymphoma-extras', (value) => {
                if ( value != this.comorbidExtrasTriggerValue ) {
                    this.note.detail.comorbid_lymphoma_specific_text = null
                }
            })

            EventBus.$on('reset-comorbid_cancer-extras', (value) => {
                if ( value != this.comorbidExtrasTriggerValue ) {
                    this.note.detail.comorbid_cancer_lung = false
                    this.note.detail.comorbid_cancer_liver = false
                    this.note.detail.comorbid_cancer_colon = false
                    this.note.detail.comorbid_cancer_breast = false
                    this.note.detail.comorbid_cancer_prostate = false
                    this.note.detail.comorbid_cancer_cervix = false
                    this.note.detail.comorbid_cancer_pancreas = false
                    this.note.detail.comorbid_cancer_brain = false
                    this.note.detail.comorbid_cancer_other = null
                }
            })

            EventBus.$on('reset-comorbid_other_autoimmune_disease-extras', (value) => {
                if ( value != this.comorbidExtrasTriggerValue ) {
                    this.note.detail.comorbid_other_autoimmune_disease_UCTD = false
                    this.note.detail.comorbid_other_autoimmune_disease_sjrogren_syndrome = false
                    this.note.detail.comorbid_other_autoimmune_disease_MCTD = false
                    this.note.detail.comorbid_other_autoimmune_disease_DMPM = false
                    this.note.detail.comorbid_other_autoimmune_disease_other = null
                }
            })

            EventBus.$on('reset-comorbid_psychiatric_illness-extras', (value) => {
                if ( value != this.comorbidExtrasTriggerValue ) {
                    this.note.detail.comorbid_psychiatric_illness_schizophrenia = false
                    this.note.detail.comorbid_psychiatric_illness_major_depression = false
                    this.note.detail.comorbid_psychiatric_illness_bipolar_disorder = false
                    this.note.detail.comorbid_psychiatric_illness_adjustment_disorder = false
                    this.note.detail.comorbid_psychiatric_illness_obcessive_compulsive_disorder = false
                    this.note.detail.comorbid_psychiatric_illness_other = null
                }
            })

            EventBus.$on('reset-comorbid_CAD-extras', (value) => {
                if ( value != this.comorbidExtrasTriggerValue ) {
                    this.note.detail.comorbid_CAD_specific_text = null
                }
            })

            EventBus.$on('reset-comorbid_epilepsy-extras', (value) => {
                if ( value != this.comorbidExtrasTriggerValue ) {
                    this.note.detail.comorbid_epilepsy_specific_text = null
                }
            })

            EventBus.$on('reset-comorbid_pacemaker_implant-extras', (value) => {
                if ( value != this.comorbidExtrasTriggerValue ) {
                    this.note.detail.comorbid_pacemaker_implant_specific = null
                }
            })

            EventBus.$on('reset-comorbid_chronic_arthritis-extras', (value) => {
                if ( value != this.comorbidExtrasTriggerValue ) {
                    this.note.detail.comorbid_chronic_arthritis_CPPD = false
                    this.note.detail.comorbid_chronic_arthritis_rheumatoid = false
                    this.note.detail.comorbid_chronic_arthritis_OA = false
                    this.note.detail.comorbid_chronic_arthritis_spondyloarthropathy = false
                    this.note.detail.comorbid_chronic_arthritis_other = null
                }
            })

            EventBus.$on('reset-comorbid_TB-extras', (value) => {
                if ( value != this.comorbidExtrasTriggerValue ) {
                    this.note.detail.comorbid_TB_pulmonary = false
                    this.note.detail.comorbid_TB_other = null
                }
            })

            EventBus.$on('reset-pregnancy-extras', (value) => {
                if ( value != this.comorbidExtrasTriggerValue ) {
                    this.note.detail.gestation_weeks = null
                }
            })

            EventBus.$on('reset-alcohol-extras', (value) => {
                if ( value == 0 ) {
                    this.note.detail.alcohol_description = null
                }
            })

            EventBus.$on('reset-cigarette_smoking-extras', (value) => {
                if ( value == 0 ) {
                    this.note.detail.smoke_description = null
                }
            })

            EventBus.$on('append-current_medications', () => { this.setCurrentMedications('append') })

            EventBus.$on('put-current_medications', () => { this.setCurrentMedications('put') })

            EventBus.$on('BMI-updates', () => {
                EventBus.$emit('update-BMI', this.autoCalculateBMI)
                if ( this.autoCalculateBMI !== null ) {
                    EventBus.$emit('toggle-alert-box', 'BMI updated')
                }
            })

            EventBus.$on('reset-breathing-extras', (value) => {
                if ( value == 1 || value == null ) {
                    this.note.detail.O2_rate = null
                }
            })

            EventBus.$on('GCS-updates', () => {
                EventBus.$emit('update-GCS', this.autoCalculateGCS)
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
                        emitOnUpdate: 'click-comorbid_cirrhosis_none_cryptogenic,click-comorbid_HBV',
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
            },
            psychiatricIllnessChecks () {
                return [
                    {
                        field: "comorbid_psychiatric_illness_schizophrenia",
                        checked: this.note.detail.comorbid_psychiatric_illness_schizophrenia,
                        label: "Schizophrenia"
                    },
                    {
                        field: "comorbid_psychiatric_illness_major_depression",
                        checked: this.note.detail.comorbid_psychiatric_illness_major_depression,
                        label: "Major depression"
                    },
                    {
                        field: "comorbid_psychiatric_illness_bipolar_disorder",
                        checked: this.note.detail.comorbid_psychiatric_illness_bipolar_disorder,
                        label: "Bipolar disorder"
                    },
                    {
                        field: "comorbid_psychiatric_illness_adjustment_disorder",
                        checked: this.note.detail.comorbid_psychiatric_illness_adjustment_disorder,
                        label: "Adjustment disorder"
                    },
                    {
                        field: "comorbid_psychiatric_illness_obcessive_compulsive_disorder",
                        checked: this.note.detail.comorbid_psychiatric_illness_obcessive_compulsive_disorder,
                        label: "Obcessive compulsive disorder"
                    }
                ]
            },
            chronicArthritisSpecificChecks () {
                return [
                    {
                        field: "comorbid_chronic_arthritis_CPPD",
                        checked: this.note.detail.comorbid_chronic_arthritis_CPPD,
                        label: "CPPD",
                        labelDescription: "Calcium pryophosphate dihydrate"
                    },
                    {
                        field: "comorbid_chronic_arthritis_rheumatoid",
                        checked: this.note.detail.comorbid_chronic_arthritis_rheumatoid,
                        label: "Rheumatoid"
                    },
                    {
                        field: "comorbid_chronic_arthritis_OA",
                        checked: this.note.detail.comorbid_chronic_arthritis_OA,
                        label: "OA",
                        labelDescription: "Osteoarthritis"
                    },
                    {
                        field: "comorbid_chronic_arthritis_spondyloarthropathy",
                        checked: this.note.detail.comorbid_chronic_arthritis_spondyloarthropathy,
                        label: "Spondyloarthropathy"
                    }
                ]
            },
            TBSpecificChecks () {
                return [
                    {
                        field: "comorbid_TB_pulmonary",
                        checked: this.note.detail.comorbid_TB_pulmonary,
                        label: "Pulmonary"
                    }
                ]
            },
            specialRequirementChecks () {
                return [
                    {
                        field: "NG_tube",
                        checked: this.note.detail.NG_tube,
                        label: "NG tube"
                    },
                    {
                        field: "NG_suction",
                        checked: this.note.detail.NG_suction,
                        label: "NG suction"
                    },
                    {
                        field: "gastrostomy_feeding",
                        checked: this.note.detail.gastrostomy_feeding,
                        label: "Gastrostomy feeding"
                    },
                    {
                        field: "urinary_cath_care",
                        checked: this.note.detail.urinary_cath_care,
                        label: "Urinary cath. care"
                    },
                    {
                        field: "tracheostomy_care",
                        checked: this.note.detail.tracheostomy_care,
                        label: "Tracheostomy care"
                    },
                    {
                        field: "hearing_impaiment",
                        checked: this.note.detail.hearing_impaiment,
                        label: "Hearing impaiment"
                    },
                    {
                        field: "isolation_room",
                        checked: this.note.detail.isolation_room,
                        label: "Isolation room"
                    }
                ]
            },
            estimatedHeightTemplate () {
                let template  = '<input type="checkbox" '
                    template += 'name="estimated_height" '
                    template += this.note.detail.estimated_height != 0 ? 'checked' : ''
                    template += '/> <span class="estimated" data-target="estimated_height">estimated</span>'
                return template
            },
            estimatedWeightTemplate () {
                let template  = '<input type="checkbox" '
                    template += 'name="estimated_weight" '
                    template += this.note.detail.estimated_weight != 0 ? 'checked' : ''
                    template += '/> <span class="estimated" data-target="estimated_weight">estimated</span>'
                return template
            },
            autoCalculateBMI () {
                if ( this.note.detail.height_cm == null || this.note.detail.weight_kg == null ) {
                    return null
                }

                let BMI = (this.note.detail.weight_kg / Math.pow((this.note.detail.height_cm / 100), 2)).toFixed(2)
                return BMI == '0.00' ? null : BMI
            },
            O2RateRearAddon () {
                switch (this.note.detail.breathing)  {
                    case 2:
                    case 3:
                        return 'L/min'
                    case 4:
                        return 'FiO<sub>2</sub>'
                    default:
                        return ''
                }
            },
            mentalOrientationChecks () {
                return [
                    {
                        field: "mental_orientation_to_time",
                        checked: this.note.detail.mental_orientation_to_time,
                        label: "to Time"
                    },
                    {
                        field: "mental_orientation_to_place",
                        checked: this.note.detail.mental_orientation_to_place,
                        label: "to Place"
                    },
                    {
                        field: "mental_orientation_to_person",
                        checked: this.note.detail.mental_orientation_to_person,
                        label: "to Person"
                    },
                ]
            },
            autoCalculateGCS () {
                let E, V, M
                if ( typeof this.note.detail.GCS_E == 'number'
                     && typeof this.note.detail.GCS_V == 'number'
                     && typeof this.note.detail.GCS_M == 'number'
                   ) {
                    E = this.note.detail.GCS_E
                    V = this.note.detail.GCS_V
                    M = this.note.detail.GCS_M
                } else {
                    let value
                    value = String(this.note.detail.GCS_E)
                    E = value !== null
                        ? parseInt(((value.split(' ')[0]).replace('[','')).replace(']',''))
                        : null
                    value = String(this.note.detail.GCS_V)
                    V = value !== null
                        ? parseInt(((value.split(' ')[0]).replace('[','')).replace(']',''))
                        : null
                    value = String(this.note.detail.GCS_M)
                    M = value !== null
                        ? parseInt(((value.split(' ')[0]).replace('[','')).replace(']',''))
                        : null
                }

                let gcsLabel
                if ($.isNumeric(E) && $.isNumeric(V) && $.isNumeric(M)) {
                    let sum = E + V + M
                    if (sum < 9) {
                        gcsLabel = 'Severe [GCS < 9]'
                        EventBus.$emit('toggle-alert-box', gcsLabel, 'danger')
                    } else if (sum < 13) {
                        gcsLabel = 'Moderate [9 <= GCS < 13]'
                        EventBus.$emit('toggle-alert-box', gcsLabel, 'warning')
                    } else {
                        gcsLabel = 'Minor [13 <= GCS <= 15]'
                        EventBus.$emit('toggle-alert-box', gcsLabel)
                    }
                } else {
                    gcsLabel = null
                }
                return gcsLabel
            }
        },
        methods : {
            setComorbidAll (value) {
                EventBus.$emit('set-comorbid_DM', value)
                EventBus.$emit('set-comorbid_valvular_heart_disease', value)
                EventBus.$emit('set-comorbid_asthma', value)
                EventBus.$emit('set-comorbid_cirrhosis', value)
                EventBus.$emit('set-comorbid_HCV', value)
                EventBus.$emit('set-comorbid_lukemia', value)
                EventBus.$emit('set-comorbid_ICD', value)
                EventBus.$emit('set-comorbid_SLE', value)
                EventBus.$emit('set-comorbid_dementia', value)
                EventBus.$emit('set-comorbid_HT', value)
                EventBus.$emit('set-comorbid_stroke', value)
                EventBus.$emit('set-comorbid_CKD', value)
                EventBus.$emit('set-comorbid_coagulopathy', value)
                EventBus.$emit('set-comorbid_HIV', value)
                EventBus.$emit('set-comorbid_lymphoma', value)
                EventBus.$emit('set-comorbid_cancer', value)
                EventBus.$emit('set-comorbid_other_autoimmune_disease', value)
                EventBus.$emit('set-comorbid_psychiatric_illness', value)
                EventBus.$emit('set-comorbid_CAD', value)
                EventBus.$emit('set-comorbid_COPD', value)
                EventBus.$emit('set-comorbid_hyperlipidemia', value)
                EventBus.$emit('set-comorbid_HBV', value)
                EventBus.$emit('set-comorbid_epilepsy', value)
                EventBus.$emit('set-comorbid_pacemaker_implant', value)
                EventBus.$emit('set-comorbid_chronic_arthritis', value)
                EventBus.$emit('set-comorbid_TB', value)
            },
            setCurrentMedications (mode) {
                EventBus.$emit('set-current_medications', this.store.current_medications_helper, mode)
                EventBus.$emit('set-current_medications_helper', '')
                this.$refs.current_medications_helper.$el.children[0].children[0].children[1].focus()
            }
        }


        // implement input-text sync data
        // window.location.href
        // window.location.hostname
        // window.location.pathname
    }

    // handle estimated_height and estimated_weight
    $(() => {
        $('span.estimated').click( function() {
            $('input[name=' + $(this).attr('data-target') + ']').click()
        })

        $('span.estimated').mouseover( function() {
            $(this).css({'cursor': 'pointer', 'font-style': 'italic'})
        })

        $('span.estimated').mouseout( function() {
            $(this).css({'cursor': '', 'font-style': ''})
        })

        $('input[name^=estimated_]').click( function () {
            EventBus.$emit('autosave', $(this).attr('name'), $(this).prop('checked'))
        })
    })
</script>
