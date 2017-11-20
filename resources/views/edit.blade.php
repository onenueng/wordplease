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
            
            <!-- Panel Admission Data -->
            <panel heading='Admission data'>
                
                <!-- wrap content with row class -->
                <div class="row">
                    
                    <!-- datetime_admit -->
                    <input-text
                        value="12-Jun-2015 12:35"
                        label="Admit :"
                        grid="1-2-4"
                        readonly>
                    </input-text>
                    
                    <!-- datetime_discharge -->
                    <input-text
                        value="22-Jun-2015 12:35"
                        label="Discharge :"
                        grid="1-2-4"
                        readonly>
                    </input-text>
                    
                    <!-- Length of stay -->
                    <input-text
                        value="30 days"
                        label="Length of stay :"
                        grid="1-2-4"
                        readonly>
                    </input-text>
                    
                    <!-- ward -->
                    <input-suggestion
                        field="ward"
                        value=""
                        label="Ward :"
                        grid="1-2-4"
                        min-chars="2">
                    </input-suggestion>

                    <!-- attending -->
                    <input-suggestion
                        field="attending"
                        value=""
                        label="Attending :"
                        grid="1-2-4">
                    </input-suggestion>

                    <!-- devision -->
                    <input-suggestion
                        field="division"
                        value=""
                        label="Specialty :"
                        grid="1-2-4"
                        min-chars="2">
                    </input-suggestion>

                    <!-- admit reason -->
                    <input-select
                        field="admit_reason"
                        value=""
                        label="Reason to admit :"
                        grid="1-2-4">
                    </input-select>
                </div><!-- wrap content with row class -->
            </panel><!-- Panel Admission Data -->

            <panel heading='History'>
                <div class="row"><!-- wrap content with row class -->
                    
                    <!-- chief complaint -->
                    <input-textarea
                        field="chief_complaint"
                        value="Lorem ipsum dolor sit amet."
                        label="Chief complaint :"
                        grid="1-1-1"
                        max-chars="50" >
                    </input-textarea>

                    <div class="col-xs-12"><hr class="line" /></div>

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
                        <div><hr class="line"></div>

                        <!-- valvular heart disease comorbid -->
                        <div class="material-box">
                            <input-radio 
                                field="comorbid_valvular_heart_disease"
                                label="Valvular heart disease :"
                                options="{{ $comorbidOptions }}"
                                trigger-value="1">
                                <!-- valvular heart disease specify AS, Ar, MS, MR, TR  -->
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
                        <div><hr class="line"></div>

                        <!-- asthma comorbid -->
                        <div class="material-box">
                            <input-radio
                                field="comorbid_asthma"
                                label="Asthma :"
                                options="{{ $comorbidOptions }}">
                            </input-radio>
                        </div><!-- asthma comorbid -->
                        <div><hr class="line"></div>

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
                                            "emitOnCheck": [
                                                ["HBV-checked",1,1],
                                                ["cirrhosis-cryptogenic-unchecked",1,""]
                                            ],
                                            "setterEvent": "cirrhosis-specify-unchecked"
                                        },
                                        {
                                            "field": "comorbid_cirrhosis_HCV",
                                            "label": "HCV",
                                            "emitOnCheck": [
                                                ["HCV-checked",1,1],
                                                ["cirrhosis-cryptogenic-unchecked",1,""]
                                            ],
                                            "setterEvent": "cirrhosis-specify-unchecked"
                                        },
                                        {
                                            "field": "comorbid_cirrhosis_NASH",
                                            "label": "NASH",
                                            "emitOnCheck": [["cirrhosis-cryptogenic-unchecked",1,""]],
                                            "setterEvent": "cirrhosis-specify-unchecked"
                                        },
                                        {
                                            "field": "comorbid_cirrhosis_cryptogenic",
                                            "label": "Cryptogenic",
                                            "emitOnCheck": [["cirrhosis-specify-unchecked",1,""]],
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
                        <div><hr class="line"></div>

                        <!-- HCV comorbid -->
                        <div class="material-box">
                            <input-radio
                                field="comorbid_HCV"
                                label="HCV infection :"
                                options="{{ $comorbidOptions }}"
                                setter-event='HCV-checked'>
                            </input-radio>
                        </div>
                        <div><hr class="line"></div>

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
                        <div><hr class="line"></div>

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
                        <div><hr class="line"></div>

                        <!-- SLE comorbid -->
                        <div class="material-box">
                            <input-radio 
                                field="comorbid_SLE"
                                label="SLE "
                                options="{{ $comorbidOptions }}"
                                trigger-value="1">
                            </input-radio>
                        </div><!-- comorbid SLE -->
                        <div><hr class="line"></div>

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
                        <div><hr class="line"></div>

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
                        <div><hr class="line"></div>

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

                        <div><hr class="line"></div>

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
                                        value=""
                                        label="Stage :"
                                        size="normal"
                                        not-allow-other
                                        need-sync>
                                    </input-select>
                                </div>
                            </input-radio><!-- CKD comorbid and its extra contents -->
                        </div>
                        <div><hr class="line"></div>

                        <!-- coagulopathy comorbid -->
                        <div class="material-box">
                            <input-radio
                                field="comorbid_coagulopathy"
                                label="Coagulopathy :"
                                options="{{ $comorbidOptions }}">
                            </input-radio>
                        </div>
                        <div><hr class="line"></div>

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
                        <div><hr class="line"></div>

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
                        <div><hr class="line"></div>

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
                        <div><hr class="line"></div>

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
                        <div><hr class="line"></div>

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
                        <div><hr class="line"></div>

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
                        <div><hr class="line"></div>

                        <!-- COPD comorbid -->
                        <div class="material-box">
                            <input-radio
                                field="comorbid_COPD"
                                label="COPD :"
                                options="{{ $comorbidOptions }}">
                            </input-radio>
                        </div>
                        <div><hr class="line"></div>

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
                        <div><hr class="line"></div>

                        <!-- HBV comorbid -->
                        <div class="material-box">
                            <input-radio
                                field="comorbid_HBV"
                                label="HBV infection :"
                                options="{{ $comorbidOptions }}"
                                setter-event='HBV-checked'>
                            </input-radio>
                        </div>
                        <div><hr class="line"></div>

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
                        <div><hr class="line"></div>

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
                        <div><hr class="line"></div>

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
                        <div><hr class="line"></div>

                        <!-- TB comorbid -->
                        <div class="material-box">
                            <input-radio
                                field="comorbid_TB"
                                label="TB :"
                                options="{{ $comorbidOptions }}"
                                trigger-value="1">
                                
                                <!-- TB specify  -->
                                <input-check-group 
                                    checks='[
                                        {
                                            "field": "comorbid_TB_pulmonary", "label": "Pulmonary"
                                        }
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
                        <div><hr class="line"></div>

                    </div><!-- CAD, COPD, Hyperlipidemia, HBV -->
                </div>
            </panel><!-- Panel Hisroty -->
        </div><!-- note content -->
    </div><!-- Vue app -->


    <script src="/js/manifest.js"></script>
    <script src="/js/vendor.js"></script>
    <script src="/js/edit-note.js"></script>
</body>
</html>
