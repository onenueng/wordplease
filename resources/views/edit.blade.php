<!DOCTYPE html>
<html lang="th-TH">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/app.css">
    <title>$AN@$NOTE-NAME</title>
</head>
<body>

    <!-- Vue app -->
    <div id="app">
        <!-- app alert box -->
        <alert-box
            v-if="showAlertbox"
            :status="alertStatus"
            :duration="alertDuration"
            :message="alertboxMessage">
        </alert-box>

        <!-- app modal diaglog -->
        <modal-dialog
            :heading="dialogHeading"
            :message="dialogMessage"
            :button-label="dialogButtonLabel">
        </modal-dialog>

        {{-- *** NOTE SPECIFIC COMPONENTS *** --}}
        <!-- Child-Pugh's score -->
        <modal-document></modal-document>

        <!-- edit note navbar -->
        <navbar
            note-name="Admission Note @ 57119617"
            patient-data="HN: 53383923 น.ส. ลั่นทม กรประเสริฐ <i class='fa fa-mars'></i>"
            username="koramit"
            :show-saving="autosaving">
        </navbar>

        <!-- note content -->
        <div class="container-fluid">
            
            <panel heading='Admission data'><!-- Panel Admission Data -->
                
                <!-- wrap content with row class -->
                <div class="row">
                    
                    <!-- datetime_admit -->
                    <input-text
                        value="12-Jun-2015 12:35"
                        label="Admit :"
                        grid="12-6-3"
                        readonly>
                    </input-text>
                    
                    <!-- datetime_discharge -->
                    <input-text
                        value="22-Jun-2015 12:35"
                        label="Discharge :"
                        grid="12-6-3"
                        readonly>
                    </input-text>
                    
                    <!-- Length of stay -->
                    <input-text
                        value="30 days"
                        label="Length of stay :"
                        grid="12-6-3"
                        readonly>
                    </input-text>
                    
                    <!-- ward -->
                    <input-suggestion
                        field="ward"
                        label="Ward :"
                        grid="12-6-3"
                        min-chars="2">
                    </input-suggestion>

                    <!-- attending -->
                    <input-suggestion
                        field="attending"
                        value=""
                        label="Attending :"
                        grid="12-6-3">
                    </input-suggestion>

                    <!-- devision -->
                    <input-suggestion
                        field="division"
                        value=""
                        label="Specialty :"
                        grid="12-6-3"
                        min-chars="2">
                    </input-suggestion>

                    <!-- admit reason -->
                    <input-select
                        field="admit_reason"
                        label="Reason to admit :"
                        placeholder="if other choice, type here"
                        grid="12-6-3">
                    </input-select>
                </div><!-- wrap content with row class -->
            </panel><!-- Panel Admission Data -->

            <panel heading='History'><!-- Panel Hisroty -->
                <div class="row"><!-- wrap content with row class -->
                    
                    <!-- chief complaint -->
                    <input-textarea
                        field="chief_complaint"
                        value="Lorem ipsum dolor sit amet."
                        label="Chief complaint :"
                        grid="12-12-12"
                        max-chars="50" >
                    </input-textarea>

                    <div class="col-xs-12"><hr class="line" /></div>

                    <div class="col-xs-12 form-inline">
                        <!-- comorbid no data all -->
                        <button-app
                            action="comorbid-no-data-all"
                            status="draft"
                            label="No Data"
                            size="sm">
                        </button-app>

                        <!-- comorbid no at all -->
                        <button-app
                            action="comorbid-no-at-all"
                            status="draft"
                            label="No comorbids"
                            size="sm">
                        </button-app>
                    </div>

                    <?php 
                        $comorbidOptions = '[
                            {"label": "No data", "value": 255},
                            {"label": "No", "value": 0},
                            {"label": "Yes", "value": 1}
                        ]';
                    ?>

                    <div class="col-xs-12 col-sm-6 col-md-4"><!-- comorbid DM, VHD, Asthma, Cirrhosis, HCV -->
                        
                        <!-- DM comorbid and its extra contents -->
                        <div class="material-box">
                            <input-radio 
                                field="comorbid_DM"
                                label="DM :"
                                options="{{ $comorbidOptions }}"
                                trigger-value="1">
                                
                                <!-- DM type -->
                                <input-radio 
                                    field="comorbid_DM_type"
                                    label="Type : "
                                    options='[
                                        {"label": "I", "value": 1},
                                        {"label": "II", "value": 2}
                                    ]'
                                    need-sync>
                                </input-radio>

                                <!-- DM complications DR, Nephropathy, Neuropathy -->
                                <input-check-group 
                                    label="Complication : "
                                    checks='[
                                        {"field": "comorbid_DM_DR", "label": "DR"},
                                        {"field": "comorbid_DM_nephropathy", "label": "Nephropathy"},
                                        {"field": "comorbid_DM_neuropathy", "label": "Neuropathy"}
                                    ]'
                                    need-sync>
                                </input-check-group>

                                <!-- DM treatments Diet, Oral Meds, Insulin -->
                                <input-check-group 
                                    label="Treatment : "
                                    checks='[
                                        {"field": "comorbid_DM_diet", "label": "Diet", "checked": "checked"},
                                        {"field": "comorbid_DM_oral_meds", "label": "Oral Meds"},
                                        {"field": "comorbid_DM_insulin", "label": "Insulin"}
                                    ]'
                                    need-sync>
                                </input-check-group>
                            </input-radio><!-- DM comorbid and its extra contents -->
                        </div>
                        <div><hr class="line" /></div>

                        <!-- valvular heart disease comorbid -->
                        <div class="material-box">
                            <input-radio 
                                field="comorbid_valvular_heart_disease"
                                label="Valvular heart disease :"
                                options="{{ $comorbidOptions }}"
                                trigger-value="1">
                                <!-- valvular heart disease specify AS, AR, MS, MR, TR  -->
                                <input-check-group
                                    label="Specify : "
                                    checks='[
                                        {"field": "comorbid_valvular_heart_disease_AS", "label": "AS"},
                                        {"field": "comorbid_valvular_heart_disease_AR", "label": "AR"},
                                        {"field": "comorbid_valvular_heart_disease_MS", "label": "MS"},
                                        {"field": "comorbid_valvular_heart_disease_MR", "label": "MR"},
                                        {"field": "comorbid_valvular_heart_disease_TR", "label": "TR"}
                                    ]'
                                    need-sync>
                                </input-check-group>

                                <!-- valvular heart disease specify other -->
                                <input-text
                                    field="comorbid_valvular_heart_disease_other"
                                    value=""
                                    size="normal"
                                    placeholder="Other specific, type here."
                                    need-sync>
                                </input-text>
                            </input-radio><!-- comorbid valvular heart disease -->
                        </div><!-- comorbid valvular heart disease -->
                        <div><hr class="line" /></div>

                        <!-- asthma comorbid -->
                        <div class="material-box">
                            <input-radio
                                field="comorbid_asthma"
                                label="Asthma :"
                                options="{{ $comorbidOptions }}">
                            </input-radio>
                        </div><!-- asthma comorbid -->
                        <div><hr class="line" /></div>

                        <!-- cirrhosis comorbid -->
                        <div class="material-box">
                            <input-radio
                                field="comorbid_cirrhosis"
                                label="Cirrhosis :"
                                options="{{ $comorbidOptions }}"
                                trigger-value="1">
                                <!-- cirrhosis Child-Pugh's score -->
                                <input-radio 
                                    field="comorbid_cirrhosis_child_pugh_score"
                                    label="Child-Pugh's Score :"
                                    label-action='{
                                        "emit": "show-child-pugh-score", 
                                        "icon": "question-circle", 
                                        "title": "Click to learn more about Child-Pugh&rsquo;s Score"
                                    }'
                                    options='[
                                        {"label": "A", "value": "A"},
                                        {"label": "B", "value": "B"},
                                        {"label": "C", "value": "C"}
                                    ]'>
                                </input-radio>
                                <!-- cirrhosis specify HBV, HCV, NASH, Cryptogenic  -->
                                <input-check-group 
                                    label="Specify : "
                                    checks='[
                                        {
                                            "field": "comorbid_cirrhosis_HBV",
                                            "label": "HBV",
                                            "emitOnUpdate": [
                                                ["HBV-checked","checked",1],
                                                ["cirrhosis-cryptogenic-unchecked","checked",""]
                                            ],
                                            "setterEvent": "cirrhosis-specify-unchecked"
                                        },
                                        {
                                            "field": "comorbid_cirrhosis_HCV",
                                            "label": "HCV",
                                            "emitOnUpdate": [
                                                ["HCV-checked","checked",1],
                                                ["cirrhosis-cryptogenic-unchecked","checked",""]
                                            ],
                                            "setterEvent": "cirrhosis-specify-unchecked"
                                        },
                                        {
                                            "field": "comorbid_cirrhosis_NASH",
                                            "label": "NASH",
                                            "emitOnUpdate": [["cirrhosis-cryptogenic-unchecked","checked",""]],
                                            "setterEvent": "cirrhosis-specify-unchecked"
                                        },
                                        {
                                            "field": "comorbid_cirrhosis_cryptogenic",
                                            "label": "Cryptogenic",
                                            "emitOnUpdate": [["cirrhosis-specify-unchecked","checked",""]],
                                            "setterEvent": "cirrhosis-cryptogenic-unchecked"
                                        }
                                    ]'
                                    need-sync>
                                </input-check-group>

                                <!-- cirrhosis specify other -->
                                <input-text
                                    field="comorbid_cirrhosis_other"
                                    value=""
                                    size="normal"
                                    placeholder="Other specific, type here."
                                    need-sync>
                                </input-text>
                            </input-radio>
                        </div><!-- comorbid cirrhosis -->
                        <div><hr class="line" /></div>

                        <!-- HCV comorbid -->
                        <div class="material-box">
                            <input-radio
                                field="comorbid_HCV"
                                label="HCV infection :"
                                options="{{ $comorbidOptions }}"
                                setter-event='HCV-checked'>
                            </input-radio>
                        </div>
                        <div><hr class="line" /></div>

                        <!-- lukemia comorbid -->
                        <div class="material-box">
                            <input-radio
                                field="comorbid_lukemia"
                                label="Lukemia :"
                                options="{{ $comorbidOptions }}"
                                trigger-value="1">
                                <!-- lukemia Child-Pugh's score -->
                                <input-radio 
                                    field="comorbid_lukemia_specific"
                                    label="Specify :"
                                    options='[
                                        {"label": "ALL", "value": 1},
                                        {"label": "AML", "value": 2},
                                        {"label": "CLL", "value": 3},
                                        {"label": "CML", "value": 4}
                                    ]'>
                                </input-radio>
                            </input-radio>
                        </div><!-- lukemia cirrhosis -->
                        <div><hr class="line" /></div>

                        <!-- ICD comorbid -->
                        <div class="material-box">
                            <input-radio 
                                field="comorbid_ICD"
                                label="ICD "
                                label-description="Implantable Cardioverter Defibrillator"
                                options="{{ $comorbidOptions }}"
                                trigger-value="1">

                                <!-- ICD specify other -->
                                <input-text
                                    field="comorbid_ICD_other"
                                    value=""
                                    size="normal"
                                    placeholder="Specific ICD type."
                                    need-sync>
                                </input-text>
                            </input-radio>
                        </div><!-- comorbid ICD -->
                        <div><hr class="line" /></div>

                        <!-- SLE comorbid -->
                        <div class="material-box">
                            <input-radio 
                                field="comorbid_SLE"
                                label="SLE "
                                options="{{ $comorbidOptions }}"
                                trigger-value="1">
                            </input-radio>
                        </div><!-- comorbid SLE -->
                        <div><hr class="line" /></div>

                        <!-- dementia comorbid -->
                        <div class="material-box">
                            <input-radio
                                field="comorbid_dementia"
                                label="Dementia :"
                                options="{{ $comorbidOptions }}"
                                trigger-value="1">
                                
                                <!-- dementia specify Vascular Alzheimer  -->
                                <input-check-group 
                                    checks='[
                                        {"field": "comorbid_dementia_vascular", "label": "Vascular"},
                                        {"field": "comorbid_dementia_alzheimer", "label": "Alzheimer"}
                                    ]'
                                    need-sync>
                                </input-check-group>

                                <!-- dementia specify other -->
                                <input-text
                                    field="comorbid_dementia_other"
                                    value=""
                                    size="normal"
                                    placeholder="Other specific, type here."
                                    need-sync>
                                </input-text>
                            </input-radio>
                        </div><!-- comorbid dementia -->
                        <div><hr class="line" /></div>

                    </div><!-- comorbid DM, VHD, Asthma, Cirrhosis, HCV -->

                    <div class="col-xs-12 col-sm-6 col-md-4"><!-- comorbid HT, Stroke, CKD, Coagulopathy, HIV -->
                        
                        <!-- HT comorbid -->
                        <div class="material-box">
                            <input-radio
                                field="comorbid_HT"
                                label="HT :"
                                options="{{ $comorbidOptions }}">
                            </input-radio>
                        </div>
                        <div><hr class="line" /></div>

                        <!-- stroke comorbid and its extra contents -->
                        <div class="material-box">
                            <input-radio
                                field="comorbid_stroke"
                                label="Stroke : "
                                options="{{ $comorbidOptions }}"
                                trigger-value="1">
                                
                                <!-- foreach stroke symptom -->
                                @foreach ( ['Ischemic', 'Hemorrhagic', 'Iembolic'] as $symptom )
                                    <div class="form-inline">
                                        <input-select
                                            field="comorbid_stroke_{{ strtolower($symptom) }}"
                                            value=""
                                            label="{{ $symptom }} :"
                                            size="normal"
                                            not-allow-other
                                            need-sync>
                                        </input-select>
                                    </div>
                                @endforeach
                            </input-radio><!-- stroke comorbid and its extra contents -->
                        </div>

                        <div><hr class="line" /></div>

                        <!-- CKD comorbid and its extra contents -->
                        <div class="material-box">
                            <input-radio
                                field="comorbid_CKD"
                                label="CKD "
                                label-description="Chronic Kidney Disease"
                                options="{{ $comorbidOptions }}"
                                trigger-value="1">
                                
                                <!-- CKD stage -->
                                <div class="form-inline">
                                    <input-select
                                        field="comorbid_CKD_stage"
                                        label="Stage :"
                                        size="normal"
                                        not-allow-other
                                        need-sync>
                                    </input-select>
                                </div>
                            </input-radio><!-- CKD comorbid and its extra contents -->
                        </div>
                        <div><hr class="line" /></div>

                        <!-- coagulopathy comorbid -->
                        <div class="material-box">
                            <input-radio
                                field="comorbid_coagulopathy"
                                label="Coagulopathy :"
                                options="{{ $comorbidOptions }}">
                            </input-radio>
                        </div>
                        <div><hr class="line" /></div>

                        <!-- HIV comorbid -->
                        <div class="material-box">
                            <input-radio
                                field="comorbid_HIV"
                                label="HIV :"
                                options="{{ $comorbidOptions }}"
                                trigger-value="1">

                                <!-- HIV Previous opportunistic infection TB, PCP, Candidiasis, CMV -->
                                <input-check-group 
                                    label="Previous opportunistic infection : "
                                    checks='[
                                        {"field": "comorbid_DM_DR", "label": "TB"},
                                        {"field": "comorbid_DM_nephropathy", "label": "PCP"},
                                        {"field": "comorbid_DM_neuropathy", "label": "Candidiasis"},
                                        {"field": "comorbid_DM_nephropathy", "label": "CMV"}
                                    ]'
                                    need-sync>
                                </input-check-group>

                                <!-- HIV specify other -->
                                <input-text
                                    field="comorbid_HIV_other"
                                    value=""
                                    size="normal"
                                    placeholder="Other specific, type here."
                                    need-sync>
                                </input-text>
                            </input-radio>
                        </div>
                        <div><hr class="line" /></div>

                        <!-- lymphoma comorbid -->
                        <div class="material-box">
                            <input-radio
                                field="comorbid_lymphoma"
                                label="Lymphoma :"
                                options="{{ $comorbidOptions }}"
                                trigger-value="1">

                                <!-- lymphoma specify -->
                                <div class="form-inline">
                                    <input-select
                                        field="comorbid_lymphoma_specific"
                                        value=""
                                        label="Specify :"
                                        size="normal"
                                        need-sync>
                                    </input-select>
                                </div>
                            </input-radio>
                        </div><!-- lymphoma comorbid -->
                        <div><hr class="line" /></div>

                        <!-- cancer comorbid -->
                        <div class="material-box">
                            <input-radio
                                field="comorbid_cancer"
                                label="Cancer :"
                                options="{{ $comorbidOptions }}"
                                trigger-value="1">
                                
                                <!-- cancer specify Lung Liver Colon Breast Prostate Cervix Pancreas Brain  -->
                                <input-check-group 
                                    checks='[
                                        {"field": "comorbid_cancer_lung", "label": "Lung"},
                                        {"field": "comorbid_cancer_liver", "label": "Liver"},
                                        {"field": "comorbid_cancer_colon", "label": "Colon"},
                                        {"field": "comorbid_cancer_breast", "label": "Breast"},
                                        {"field": "comorbid_cancer_prostate", "label": "Prostate"},
                                        {"field": "comorbid_cancer_cervix", "label": "Cervix"},
                                        {"field": "comorbid_cancer_pancreas", "label": "Pancreas"},
                                        {"field": "comorbid_cancer_brain", "label": "Brain"}
                                    ]'
                                    need-sync>
                                </input-check-group>

                                <!-- cancer specify other -->
                                <input-text
                                    field="comorbid_cancer_other"
                                    value=""
                                    size="normal"
                                    placeholder="Other specific, type here."
                                    need-sync>
                                </input-text>
                            </input-radio>
                        </div><!-- comorbid cancer -->
                        <div><hr class="line" /></div>

                        <!-- Other Autoimmune Disease comorbid -->
                        <div class="material-box">
                            <input-radio
                                field="comorbid_other_autoimmune_disease"
                                label="Other Autoimmune Disease :"
                                options="{{ $comorbidOptions }}"
                                trigger-value="1">
                                
                                <!-- Other Autoimmune Disease specify Lung Liver Colon Breast Prostate Cervix Pancreas Brain  -->
                                <input-check-group 
                                    checks='[
                                        {
                                            "field": "comorbid_other_autoimmune_disease_UCTD",
                                            "label": "UCTD",
                                            "labelDescription": "Undifferentiated connective tissue disease"
                                        },
                                        {
                                            "field": "comorbid_other_autoimmune_disease_sjrogren_syndrome", "label": "Sjrögren syndrome"
                                        },
                                        {
                                            "field": "comorbid_other_autoimmune_disease_MCTD",
                                            "label": "MCTD",
                                            "labelDescription": "Mixed connective tissue disease"
                                        },
                                        {
                                            "field": "comorbid_other_autoimmune_disease_DMPM",
                                            "label": "DMPM",
                                            "labelDescription": "Dermatomyositis polymyositis"
                                        }
                                    ]'
                                    need-sync>
                                </input-check-group>

                                <!-- Other Autoimmune Disease specify other -->
                                <input-text
                                    field="comorbid_other_autoimmune_disease_other"
                                    value=""
                                    size="normal"
                                    placeholder="Other specific, type here."
                                    need-sync>
                                </input-text>
                            </input-radio>
                        </div><!-- comorbid Other Autoimmune Disease -->
                        <div><hr class="line" /></div>

                        <!-- Psychiatric illness comorbid -->
                        <div class="material-box">
                            <input-radio
                                field="comorbid_psychiatric_illness"
                                label="Psychiatric illness :"
                                options="{{ $comorbidOptions }}"
                                trigger-value="1">
                                <input-check-group
                                    checks= '[
                                        {
                                            "field": "comorbid_psychiatric_illness_schizophrenia",
                                            "label": "Schizophrenia"
                                        },
                                        {
                                            "field": "comorbid_psychiatric_illness_major_depression",
                                            "label": "Major depression"
                                        },
                                        {
                                            "field": "comorbid_psychiatric_illness_bipolar_disorder",
                                            "label": "Bipolar disorder"
                                        },
                                        {
                                            "field": "comorbid_psychiatric_illness_adjustment_disorder",
                                            "label": "Adjustment disorder"
                                        },
                                        {
                                            "field": "comorbid_psychiatric_illness_obcessive_compulsive_disorder",
                                            "label": "Obcessive compulsive disorder"
                                        }
                                    ]'
                                    need-sync>
                                </input-check-group>
                                <input-text
                                    field="comorbid_psychiatric_illness_other"
                                    placeholder="Other specific, type here."
                                    need-sync>
                                </input-text>
                            </input-radio>
                        </div><!-- Psychiatric illness comorbid -->
                        <div><hr class="line" /></div>

                    </div><!-- comorbid HT, Stroke, CKD, Coagulopathy, HIV -->

                    <div class="col-xs-12 col-sm-6 col-md-4"><!-- CAD, COPD, Hyperlipidemia, HBV -->
                        
                        <!-- CAD comorbid and its extra contents -->
                        <div class="material-box">
                            <input-radio
                                field="comorbid_CAD"
                                label="CAD "
                                label-description="Coronary Artery Disease"
                                options="{{ $comorbidOptions }}"
                                trigger-value="1">
                                
                                <!-- CAD specify -->
                                <div class="form-inline">
                                    <input-select
                                        field="comorbid_CAD_specific"
                                        value="apple"
                                        label="Specify :"
                                        size="normal"
                                        need-sync>
                                    </input-select>
                                </div>
                            </input-radio><!-- CAD comorbid and its extra contents -->
                        </div>
                        <div><hr class="line" /></div>

                        <!-- COPD comorbid -->
                        <div class="material-box">
                            <input-radio
                                field="comorbid_COPD"
                                label="COPD :"
                                options="{{ $comorbidOptions }}">
                            </input-radio>
                        </div>
                        <div><hr class="line" /></div>

                        <!-- hyperlipidemia comorbid and its extra contents -->
                        <div class="material-box">
                            <input-radio
                                field="comorbid_hyperlipidemia"
                                label="Hyperlipidemia : "
                                options="{{ $comorbidOptions }}"
                                trigger-value="1">
                                
                                <!-- hyperlipidemia specify -->
                                <div class="form-inline">
                                    <input-select
                                        field="comorbid_hyperlipidemia_specific"
                                        value=""
                                        label="Specify :"
                                        size="normal"
                                        not-allow-other
                                        need-sync>
                                    </input-select>
                                </div>
                            </input-radio><!-- hyperlipidemia comorbid and its extra contents -->
                        </div>
                        <div><hr class="line" /></div>

                        <!-- HBV comorbid -->
                        <div class="material-box">
                            <input-radio
                                field="comorbid_HBV"
                                label="HBV infection :"
                                options="{{ $comorbidOptions }}"
                                setter-event='HBV-checked'>
                            </input-radio>
                        </div>
                        <div><hr class="line" /></div>

                        <!-- epilepsy comorbid -->
                        <div class="material-box">
                            <input-radio
                                field="comorbid_epilepsy"
                                label="Epilepsy :"
                                options="{{ $comorbidOptions }}"
                                trigger-value="1">

                                <!-- epilepsy specify -->
                                <div class="form-inline">
                                    <input-select
                                        field="comorbid_epilepsy_specific"
                                        value=""
                                        label="Specify :"
                                        size="normal"
                                        need-sync>
                                    </input-select>
                                </div>
                            </input-radio>
                        </div><!-- epilepsy comorbid -->
                        <div><hr class="line" /></div>

                        <!-- Pacemaker implant comorbid -->
                        <div class="material-box">
                            <input-radio
                                field="comorbid_pacemaker_implant"
                                label="Pacemaker implant :"
                                options="{{ $comorbidOptions }}"
                                trigger-value="1">
                                <!-- Pacemaker implant Child-Pugh's score -->
                                <input-radio 
                                    field="comorbid_pacemaker_implant_specific"
                                    label="Specify :"
                                    options='[
                                        {
                                            "label": "DDDR", "value": 1,
                                            "labelDescription": "dual-chamber, rate-modulated"
                                        },
                                        {   "label": "VI", "value": 2   }
                                    ]'>
                                </input-radio>
                            </input-radio>
                        </div><!-- Pacemaker implant cirrhosis -->
                        <div><hr class="line" /></div>

                        <!-- Chronic arthritis comorbid -->
                        <div class="material-box">
                            <input-radio
                                field="comorbid_chronic_arthritis"
                                label="Chronic arthritis :"
                                options="{{ $comorbidOptions }}"
                                trigger-value="1">
                                
                                <!-- Chronic arthritis specify Lung Liver Colon Breast Prostate Cervix Pancreas Brain  -->
                                <input-check-group 
                                    checks='[
                                        {
                                            "field": "comorbid_chronic_arthritis_CPPD",
                                            "label": "CPPD",
                                            "labelDescription": "Calcium pryophosphate dihydrate"
                                        },
                                        {
                                            "field": "comorbid_chronic_arthritis_rheumatoid", "label": "Rheumatoid"
                                        },
                                        {
                                            "field": "comorbid_chronic_arthritis_OA",
                                            "label": "OA",
                                            "labelDescription": "Osteoarthritis"
                                        },
                                        {
                                            "field": "comorbid_chronic_arthritis_spondyloarthropathy",
                                            "label": "Spondyloarthropathy"
                                        }
                                    ]'
                                    need-sync>
                                </input-check-group>

                                <!-- Chronic arthritis specify other -->
                                <input-text
                                    field="comorbid_chronic_arthritis_other"
                                    value=""
                                    size="normal"
                                    placeholder="Other specific, type here."
                                    need-sync>
                                </input-text>
                            </input-radio>
                        </div><!-- comorbid Chronic arthritis -->
                        <div><hr class="line" /></div>

                        <div class="material-box"><!-- TB comorbid -->
                            <input-radio
                                field="comorbid_TB"
                                label="TB :"
                                options="{{ $comorbidOptions }}"
                                trigger-value="1">
                                
                                <!-- TB specify  -->
                                <input-check-group 
                                    checks='[
                                        {"field": "comorbid_TB_pulmonary", "label": "Pulmonary"}
                                    ]'
                                    need-sync>
                                </input-check-group>

                                <!-- TB specify other -->
                                <input-text
                                    field="comorbid_TB_other"
                                    value=""
                                    size="normal"
                                    placeholder="Other specific, type here."
                                    need-sync>
                                </input-text>
                            </input-radio>
                        </div><!-- comorbid TB -->
                        <div><hr class="line" /></div>

                    </div><!-- CAD, COPD, Hyperlipidemia, HBV -->

                    <!-- other comorbid  -->
                    <input-textarea
                        field="other_comorbid"
                        value="Lorem ipsum dolor sit amet."
                        label="Other comorbid :"
                        grid="12-12-12"
                        max-chars="50" >
                    </input-textarea>
                    <div class="col-xs-12"><hr class="line" /></div>

                    <!-- history of present illness  -->
                    <input-textarea
                        field="history_of_present_illness"
                        label="History of present illness :"
                        grid="12-12-6"
                        max-chars="50" >
                    </input-textarea>
                    
                    <!-- history of past illness  -->
                    <input-textarea
                        field="history_of_past_illness"
                        label="History of past illness :"
                        grid="12-12-6"
                        max-chars="50" >
                    </input-textarea>
                    
                </div><!-- wrap content with row class -->
            </panel><!-- Panel Hisroty -->

            <panel heading="Personal and Social history"><!-- panel Personal and Social history -->
                <div class="row">
                    
                    <div class="col-xs-12 col-sm-6 col-md-4">
                        <div class="material-box">
                            <input-radio
                                field="pregnancy"
                                label="Pregnant : "
                                options='[
                                    {"label": "No", "value": "0"},
                                    {"label": "Yes", "value": "1"},
                                    {"label": "Uncertain", "value": "2"}
                                ]'
                                trigger-value="1">
                                <input-text-addon
                                    field="gastation_weeks"
                                    front-addon="Gastation"
                                    rear-addon="Weeks">
                                </input-text-addon>
                            </input-radio>

                            <input-text-addon
                                field="LMP"
                                front-addon='LMP <a role="button" data-toggle="tooltip" title="ลงข้อมูล LMP เป็นวันที่ในรูปแบบ dd/mm/yyyy หรือหากไม่ทราบให้บรรยายเช่น 10 ปีที่ผ่านมา เป็นต้น"><i class="fa fa-info-circle"></i></a>'>
                            </input-text-addon>
                        </div>    
                    </div>
                    
                    <div class="col-xs-12 col-sm-6 col-md-4">
                        <div class="material-box">
                            <input-radio
                                field="alcohol"
                                label="Alcohol : "
                                options='[
                                    {"label": "No", "value": "0"},
                                    {"label": "Yes", "value": "1"},
                                    {"label": "Ex-drinker", "value": "2"}
                                ]'
                                trigger-value="[1,2]">
                                <!-- alcohol_description  -->
                                <input-textarea
                                    field="alcohol_description"
                                    placeholder="description">
                                </input-textarea>
                            </input-radio>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-6 col-md-4">
                        <div class="material-box">
                            <input-radio
                                field="cigarette_smoking"
                                label="Cigarette smoking : "
                                options='[
                                    {"label": "No", "value": "0"},
                                    {"label": "Yes", "value": "1"},
                                    {"label": "Ex-smoker", "value": "2"}
                                ]'
                                trigger-value="[1,2]">
                                <!-- smoke_description  -->
                                <input-textarea
                                    field="smoke_description"
                                    placeholder="description">
                                </input-textarea>
                            </input-radio>
                        </div>
                    </div>
                    <div class="col-xs-12"><hr class="line" /></div>
                    <!-- personal social history -->
                    <input-textarea
                        field="personal_social_history"
                        placeholder="personal and social history description"
                        grid="12-12-12"
                        max-chars="50" >
                    </input-textarea>
                </div>
            </panel><!-- panel Personal and Social history -->

            <panel heading="Special requirement"><!-- panel Special requirement -->
                <div class="row"><!-- wrap with row -->
                    <div class="col-xs-12">
                        <input-check-group
                            checks='[
                                {"label": "NG tube", "field": "NG_tube"},
                                {"label": "NG suction", "field": "NG_suction"},
                                {"label": "Gastrostomy feeding", "field": "gastrostomy_feeding"},
                                {"label": "Urinary cath. care", "field": "urinary_cath_care"},
                                {"label": "Tracheostomy care", "field": "tracheostomy_care"},
                                {"label": "Hearing impaiment", "field": "hearing_impaiment"},
                                {"label": "Isolation room", "field": "isolation_room"}
                            ]'>
                        </input-check-group>
                    </div>

                    <!-- other special requirement -->
                    <input-textarea
                        field="other_special_requirement"
                        placeholder="Other requirement, type here"
                        grid="12-12-12"
                        max-chars="50" >
                    </input-textarea>
                </div><!-- wrap with row -->
            </panel><!-- panel Special requirement -->

            <panel heading="Family history"><!-- panel Family history -->
                <div class="row"><!-- wrap with row -->
                    <!-- family history -->
                    <input-textarea
                        field="family_history"
                        grid="12-12-12"
                        max-chars="50">
                    </input-textarea>
                </div><!-- wrap with row -->
            </panel><!-- panel Family history -->

            <panel heading="Current medications"><!-- panel Current medications -->
                <div class="row"><!-- wrap with row -->
                    <!-- drug search helper -->
                    <input-suggestion
                        target-id="current_medications_helper"
                        grid="8-8-4"
                        service-url="autocomplete/drug"
                        placeholder="search drug using generic, trade or synonym name">
                    </input-suggestion>

                    <!-- med append button -->
                    <button-app
                        action="append-current-medications"
                        label="Append"
                        status="draft"
                        size="sm">
                    </button-app>

                    <!-- med put button -->
                    <button-app
                        action="put-current-medications"
                        label="Put"
                        status="draft"
                        size="sm">
                    </button-app>

                    <!-- current medications -->
                    <input-textarea
                        field="current_medications"
                        setter-event="set-current-medications"
                        grid="12-12-12">
                    </input-textarea>
                    
                </div><!-- wrap with row -->
            </panel><!-- panel Current medications -->
            
            <panel heading="Allergy/Adverse event (Drug, Food, Chemical)"><!-- Panel allergy -->
                <div class="row"><!-- wrap with row -->
                    <!-- allergy -->
                    <input-textarea
                        field="allergy"
                        grid="12-12-12">
                    </input-textarea>
                </div><!-- wrap with row -->
            </panel><!-- Panel allergy -->

            <?php 
                $examChoice = '[{"label": "Normal", "value": 1}, {"label": "Abnormal", "value": 2}]';
                $reviewFields = [
                    ["label" => "Hair and Skin :","field" => "review_system_hair_and_skin"],
                    ["label" => "Head :","field" => "review_system_head"],
                    ["label" => "Eye/ENT :","field" => "review_system_eye_ENT"],
                    ["label" => "Breast :","field" => "review_system_breast"],
                    ["label" => "CVS :","field" => "review_system_CVS"],
                    ["label" => "RS :","field" => "review_system_RS"],
                    ["label" => "GI :","field" => "review_system_GI"],
                    ["label" => "GU :","field" => "review_system_GU"],
                    ["label" => "Musculoskeletal :","field" => "review_system_musculoskeletal"],
                    ["label" => "Nervous system :","field" => "review_system_nervous_system"],
                    ["label" => "Psychological symptoms :","field" => "review_system_psychological_symptoms"],
                ];
            ?>
            <panel heading="Review of systems"><!-- Review of systems -->
                <div class="row"><!-- wrap with row -->
                    <!-- General symptoms -->
                    <input-textarea
                        field="general_symptoms"
                        label="General symptoms :"
                        grid="12-12-12">
                    </input-textarea>

                    <div class="col-xs-12"><hr class="line" /></div>

                    <div class="col-xs-12 col-md-6">
                        @foreach($reviewFields as $index => $field)
                        @if($index < (count($reviewFields)/2))
                            <div class="col-xs-12">
                                <!-- {{ $field['label'] }} -->
                                <input-radio
                                    field="{{ $field['field'] }}"
                                    label="{{ $field['label'] }}"
                                    options="{{ $examChoice }}">
                                </input-radio>
                            </div>
                            <!-- {{ $field['label'] }} description -->
                            <input-textarea
                                field="{{ $field['field'] }}_description"
                                placeholder="description"
                                grid="12-12-12">
                            </input-textarea>

                            <div class="col-xs-12"><hr class="line" /></div>
                        @endif
                        @endforeach
                    </div>
                    
                    <div class="col-xs-12 col-md-6">
                        @foreach($reviewFields as $index => $field)
                        @if($index >= (count($reviewFields)/2))
                        <div class="col-xs-12">
                            <!-- {{ $field['label'] }} -->
                            <input-radio
                                field="{{ $field['field'] }}"
                                label="{{ $field['label'] }}"
                                options="{{ $examChoice }}">
                            </input-radio>
                        </div>
                        <!-- {{ $field['label'] }} description -->
                        <input-textarea
                            field="{{ $field['field'] }}_description"
                            placeholder="description"
                            grid="12-12-12">
                        </input-textarea>

                        <div class="col-xs-12"><hr class="line" /></div>
                        @endif
                        @endforeach
                    </div>

                    <!-- Others -->
                    <input-textarea
                        field="review_system_oters"
                        placeholder="Ohters system review"
                        grid="12-12-12">
                    </input-textarea>
                </div><!-- wrap with row -->
            </panel><!-- Review of systems -->

            <panel heading="Vital signs">
                <div class="row"><!-- wrap with row -->
                    <!-- Temperature -->
                    <input-text-addon
                        field="temperature_celsius"
                        label="Temperature :"
                        rear-addon="&deg;C"
                        grid="12-6-3">
                    </input-text-addon>

                    <!-- Pulse -->
                    <input-text-addon
                        field="pulse_rate_per_min"
                        label="Pulse :"
                        rear-addon="/min"
                        grid="12-6-3">
                    </input-text-addon>

                    <!-- Respiratory rate -->
                    <input-text-addon
                        field="respiratory_rate_per_min"
                        label="Respiratory rate :"
                        rear-addon="/min"
                        grid="12-6-3">
                    </input-text-addon>

                    <!-- BP -->
                    <input-text-addon
                        field="BP"
                        label="Blood presure :"
                        rear-addon="mmHg"
                        placeholder="SBP/DBP"
                        pattern='[1-9]\d{1,2}/[1-9]\d{1,2}'
                        grid="12-6-3">
                    </input-text-addon>
                    
                    <!-- Height -->
                    <input-text-addon
                        field="height_cm"
                        label="Height :"
                        front-addon='<input type="checkbox" name="estimated_height" /> <span class="estimated" data-target="estimated_height">estimated</span>'
                        rear-addon="cm"
                        emit-on-update='["BMI-updates-height"]'
                        grid="12-6-3">
                    </input-text-addon>

                    <!-- Weight -->
                    <input-text-addon
                        field="weight_kg"
                        label="Weight :"
                        front-addon='<input type="checkbox" name="estimated_weight" /> <span class="estimated" data-target="estimated_weight">estimated</span>'
                        rear-addon="kg"
                        emit-on-update='["BMI-updates-weight"]'
                        grid="12-6-3">
                    </input-text-addon>

                    <!-- BMI -->
                    <input-text-addon
                        label="BMI "
                        label-description="Auto calculate"
                        rear-addon="kg/m<sup>2</sup>"
                        grid="12-6-3"
                        setter-event="BMI-updates"
                        readonly>
                    </input-text-addon>

                    <!-- SpO2 -->
                    <input-text-addon
                        field="SpO2"
                        label='SpO<sub>2</sub> '
                        label-description="as indicated"
                        rear-addon="%"
                        grid="12-6-3">
                    </input-text-addon>

                    <div class="col-xs-12 col-md-6">
                        <div class="material-box">
                            <input-radio
                                field="breathing"
                                label="Breathing :"
                                options='[
                                    {"label": "Room air", "value": 1},
                                    {"label": "O<sub>2</sub>-Canula", "value": 2},
                                    {"label": "O<sub>2</sub>-Mask with bag", "value": 3},
                                    {"label": "O<sub>2</sub>-On ventilator", "value": 4}
                                ]'
                                trigger-value="[2,3,4]"
                                emit-on-update="breathing-updates">
                                <div class="form-inline">
                                    <input-text-addon
                                        field="O2_rate"
                                        front-addon="O<sub>2</sub> rate"
                                        rear-addon="L/min"
                                        setter-rear-addon="set-o2-rate-rear-addon">
                                    </input-text-addon>
                                </div>
                            </input-radio>
                        </div>

                        <div class="material-box">
                            <!-- Mental evaluation -->
                            <input-radio
                                field="mental_evaluation"
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
                                checks='[
                                    {"field": "mental_orientation_to_time", "label": "to Time"},
                                    {"field": "mental_orientation_to_place", "label": "to Place"},
                                    {"field": "mental_orientation_to_person", "label": "to Person"}
                                ]'>
                                
                            </input-check-group>
                        </div>
                    </div>

                    <div class="col-xs-12 col-md-6">
                        <div class="material-box">
                            <input-radio
                                field="level_of_consciousness"
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
                                    readonly
                                    setter-event="GCS-updated">
                                </input-text>
                            </div>
                            <div class="form-inline">
                                <input-select
                                    field="GCS_E"
                                    size="normal"
                                    not-allow-other
                                    placeholder="select GCS - E"
                                    emit-on-update="GCS-updates-E">
                                </input-select>
                            </div>
                            <div class="form-inline">
                                <input-select
                                    field="GCS_V"
                                    size="normal"
                                    not-allow-other
                                    placeholder="select GCS - V"
                                    emit-on-update="GCS-updates-V">
                                </input-select>
                            </div>
                            <div class="form-inline">
                                <input-select
                                    field="GCS_M"
                                    size="normal"
                                    not-allow-other
                                    placeholder="select GCS - M"
                                    emit-on-update="GCS-updates-M">
                                </input-select>
                            </div>
                        </div>
                    </div>

                </div><!-- wrap with row -->
            </panel>

            
            <?php 
                $examFields = [
                    ["label" => "Skin :","field" => "physical_exam_skin"],
                    ["label" => "Head :","field" => "physical_exam_head"],
                    ["label" => "Eye/ENT :","field" => "physical_exam_eye_ENT"],
                    ["label" => "Neck :","field" => "physical_exam_neck"],
                    ["label" => "Heart :","field" => "physical_exam_heart"],
                    ["label" => "Lung :","field" => "physical_exam_lang"],
                    ["label" => "Abdomen :","field" => "physical_exam_abdomen"],
                    ["label" => "Nervous system :","field" => "physical_exam_nervous_system"],
                    ["label" => "Extremities :","field" => "physical_exam_extremities"],
                    ["label" => "Lymph nodes :","field" => "physical_exam_lymph_nodes"],
                    ["label" => "Breasts :","field" => "physical_exam_breasts"],
                    ["label" => "Genitalia :","field" => "physical_exam_genitalia"],
                    ["label" => "Rectal examination :","field" => "physical_exam_rectal_examination"],
                ];
            ?>
            <panel heading="Physical examinations"><!-- Physical examinations -->
                <div class="row"><!-- wrap with row -->
                    <!-- General appearance -->
                    <input-textarea
                        field="general_appearance"
                        label="General appearance :"
                        placeholder="Specify important findings"
                        grid="12-12-12">
                    </input-textarea>

                    <div class="col-xs-12"><hr class="line" /></div>
                    
                    <div class="col-xs-12 col-md-6">
                        @foreach($examFields as $index => $field)
                        @if($index < (count($examFields)/2))
                        <div class="col-xs-12">                    
                            <!-- {{ $field['label'] }} -->
                            <input-radio
                                field="{{ $field['field'] }}"
                                label="{{ $field['label'] }}"
                                options="{{ $examChoice }}">
                            </input-radio>
                        </div>
                        <!-- {{ $field['label'] }} description -->
                        <input-textarea
                            field="{{ $field['field'] }}_description"
                            placeholder="description"
                            grid="12-12-12">
                        </input-textarea>
                        
                        <div class="col-xs-12"><hr class="line" /></div>
                        @endif
                        @endforeach
                    </div>

                    <div class="col-xs-12 col-md-6">
                        @foreach($examFields as $index => $field)
                        @if($index >= (count($examFields)/2))
                        <div class="col-xs-12">                    
                            <!-- {{ $field['label'] }} -->
                            <input-radio
                                field="{{ $field['field'] }}"
                                label="{{ $field['label'] }}"
                                options="{{ $examChoice }}">
                            </input-radio>
                        </div>
                        <!-- {{ $field['label'] }} description -->
                        <input-textarea
                            field="{{ $field['field'] }}_description"
                            placeholder="description"
                            grid="12-12-12">
                        </input-textarea>
                        
                        <div class="col-xs-12"><hr class="line" /></div>
                        @endif
                        @endforeach
                    </div>

                    <!-- Pertinent investigation -->
                    <input-textarea
                        field="pertinent_investigation"
                        label="Pertinent investigation : (Please see more detail in laboratory sheet, X-ray report, etc.)"
                        grid="12-12-12">
                    </input-textarea>
                </div><!-- wrap with row -->
            </panel><!-- Physical examinations -->

            <?php
                $plans = [
                    ["label" => "Problem list :", "field" => "problem_list"],
                    ["label" => "Discussion :", "field" => "discussion"],
                    ["label" => "Provisional diagnosis :", "field" => "provisional_diagnosis"],
                    ["label" => "Plan of investigation :", "field" => "investigation_plan"],
                    ["label" => "Plan of management :", "field" => "management_plan"],
                    ["label" => "Plan of consultation :", "field" => "consultation_plan"],
                ];
            ?>

            <panel heading="Problem list, Discussion and Plan"><!-- Problem list, Discussion and Plan -->
                <div class="row"><!-- wrap with row -->
                    <div class="col-xs-12 col-md-6">
                        @foreach($plans as $index => $plan)
                        @if($index < (count($plans)/2))
                            <!-- {{ $plan['label'] }} -->
                            <input-textarea
                                field="{{ $plan['field'] }}"
                                label="{{ $plan['label'] }}">
                            </input-textarea>
                            <div><hr class="line" /></div>
                        @endif
                        @endforeach
                    </div>

                    <div class="col-xs-12 col-md-6">
                        @foreach($plans as $index => $plan)
                        @if($index >= (count($plans)/2))
                            <!-- {{ $plan['label'] }} -->
                            <input-textarea
                                field="{{ $plan['field'] }}"
                                label="{{ $plan['label'] }}">
                            </input-textarea>
                            <div><hr class="line" /></div>
                        @endif
                        @endforeach
                    </div>

                    <div class="col-xs-12 col-md-6">
                        <input-select
                            field="CPG_special_group"
                            label="Special group (accoring to CPG) :"
                            not-allow-other>
                        </input-select>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <input-text
                            field="estimated_length_of_stay"
                            label="Estimated dulation of hospitalization "
                            label-description="enter approximate length of stay(days) or leave blank if cannot be presently determined">
                        </input-text>
                    </div>
                </div><!-- wrap with row -->
            </panel><!-- Problem list, Discussion and Plan -->

            <panel heading="MD note"><!-- MD Note -->
                <div class="row">
                    <input-textarea
                        field="MD_note"
                        grid="12-12-12">
                    </input-textarea>
                </div>
            </panel><!-- MD Note -->
        </div><!-- note content -->
    </div><!-- Vue app -->

    <script src="/js/manifest.js"></script>
    <script src="/js/vendor.js"></script>
    <script src="/js/edit-note.js"></script>
</body>
</html>
