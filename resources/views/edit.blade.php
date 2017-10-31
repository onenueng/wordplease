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
    <div id="app"><!-- Vue app -->
        <!-- app alert box -->
        <alert-box
            v-if="showAlertbox"
            :status="alertStatus"
            :duration="alertDuration">
            @{{ alertboxMessage }}
        </alert-box>

        <!-- edit note navbar -->
        <navbar
            note-name="Admission Note @ 57119617"
            patient-data="HN: 53383923 น.ส. ลั่นทม กรประเสริฐ <i class='fa fa-mars'></i>"
            username="koramit"
            :show-saving="autosaving">
        </navbar>

        <div class="container-fluid"><!-- note content -->
            
            <panel heading='Admission data'>
                
                <div class="row"><!-- wrap content with row class -->
                    
                    <!-- datetime_admit -->
                    <input-text
                        field=""
                        value="12-Jun-2015 12:35"
                        label="Admit :"
                        grid="1-2-4"
                        readonly>
                    </input-text>
                    
                    <!-- datetime_discharge -->
                    <input-text
                        field=""
                        value="22-Jun-2015 12:35"
                        label="Discharge :"
                        grid="1-2-4"
                        readonly>
                    </input-text>
                    
                    <!-- Length of stay -->
                    <input-text
                        field=""
                        value="30 days"
                        label="Length of stay :"
                        grid="1-2-4"
                        readonly>
                    </input-text>
                    
                    <!-- ward -->
                    <input-suggestion
                        field="ward"
                        value="84"
                        service-url="/get-ajax"
                        label="Ward :"
                        grid="1-2-4"
                        >
                    </input-suggestion>

                    <!-- attending -->
                    <input-suggestion
                        field="attending"
                        value="john"
                        service-url="/get-ajax"
                        label="Attending :"
                        grid="1-2-4"
                        >
                    </input-suggestion>

                    <!-- devision -->
                    <input-suggestion
                        field="devision"
                        value="med"
                        service-url="/get-ajax"
                        label="Specialty :"
                        grid="1-2-4"
                        >
                    </input-suggestion>

                    <!-- admit reason -->
                    <input-select
                        field="admit_reason"
                        value="hello"
                        service-url="/get-ajax"
                        min-chars="0"
                        label="Reason to admit :"
                        grid="1-2-4"
                        >
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

                    <div class="col-xs-12 col-sm-6 col-md-4">
                        
                        <!-- DM comorbid and its extra contents -->
                        <input-radio field="comorbid_DM"
                                     label="DM :"
                                     options='[
                                        {"label": "No data", "value": 255},
                                        {"label": "No", "value": 0},
                                        {"label": "Yes", "value": 1}
                                     ]'
                                     trigger-value="1">
                            
                            <!-- DM type -->
                            <input-radio field="comorbid_DM_type"
                                         label="Type : "
                                         options='[
                                            {"label": "I", "value": 1},
                                            {"label": "II", "value": 2}
                                         ]'
                                         need-sync>
                            </input-radio>

                            <!-- DM complications DR, Nephropathy, Neuropathy -->
                            <input-check-group label="Complication : "
                                               checks='[
                                                    {"field": "comorbid_DM_DR", "label": "DR"},
                                                    {"field": "comorbid_DM_nephropathy", "label": "Nephropathy"},
                                                    {"field": "comorbid_DM_neuropathy", "label": "Neuropathy"}
                                               ]'
                                               need-sync>
                            </input-check-group>

                            <!-- DM treatments Diet, Oral Meds, Insulin -->
                            <input-check-group label="Treatment : "
                                               checks='[
                                                    {"field": "comorbid_DM_diet", "label": "Diet", "checked": "checked"},
                                                    {"field": "comorbid_DM_oral_meds", "label": "Oral Meds"},
                                                    {"field": "comorbid_DM_insulin", "label": "Insulin"}
                                               ]'
                                               need-sync>
                            </input-check-group><!-- DM comorbid and its extra contents -->
                        </input-radio>
                        
                        <div><hr class="line"></div>
                    </div>

                    <div class="col-xs-12 col-sm-6 col-md-4">
                        
                        <!-- HT comorbid -->
                        <input-radio field="comorbid_HT"
                                     label="HT :"
                                     options='[
                                        {"label": "No data", "value": 255},
                                        {"label": "No", "value": 0},
                                        {"label": "Yes", "value": 1}
                                     ]'>
                        </input-radio>

                        <div><hr class="line"></div>
                    </div>

                    <div class="col-xs-12 col-sm-6 col-md-4">
                        
                        <!-- CAD comorbid and its extra contents -->
                        <input-radio field="comorbid_CAD"
                                     label="CAD "
                                     label-description="Coronary Artery Disease"
                                     options='[
                                        {"label": "No data", "value": 255},
                                        {"label": "No", "value": 0},
                                        {"label": "Yes", "value": 1}
                                     ]'
                                     trigger-value="1">
                            
                            <!-- CAD specify -->
                            <div class="form-inline">
                                <input-select
                                    field="comorbid_CAD_specify"
                                    value="apple"
                                    service-url="/get-ajax"
                                    min-chars="0"
                                    label="Specify :"
                                    size="normal"
                                    not-allow-other
                                    need-sync>
                                </input-select>
                            </div>
                        </input-radio><!-- CAD comorbid and its extra contents -->
                        
                        <div><hr class="line"></div>
                    </div>
                </div>
            </panel><!-- Panel Hisroty -->
        </div><!-- note content -->
    </div><!-- Vue app -->


    <script src="/js/manifest.js"></script>
    <script src="/js/vendor.js"></script>
    <script src="/js/edit-note.js"></script>

    <script>
        
    </script>
</body>
</html>
