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
    <div id="app">
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

        <!-- Form content -->
        <div class="container-fluid">
            <panel heading='Admission data'>
                <!-- wrap content with row class -->
                <div class="row">
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
                </div>
            </panel>

            <panel>
                <div class="row">
                    <!-- chief complaint -->
                    <input-textarea
                        field="chief_complaint"
                        value="Lorem ipsum dolor sit amet."
                        label="Chief complaint :"
                        grid="1-1-1"
                        max-chars="50" >
                    </input-textarea>

                    <div class="col-xs-12"><hr class="line"></div>
                </div>
            </panel>

            <input-radio
                field="dm"
                label="Radio :"
                options='[
                    {"label": "champ", "value": 1},
                    {"label": "toon", "value": 2}
                ]'>
                <input-radio
                    field="type"
                    label="Type :"
                    options='[
                        {"label": "I", "value": 1},
                        {"label": "II", "value": 2}
                    ]'>
                </input-radio>                
            </input-radio>
            <input type="text" class="form-control">
            <input type="text" class="form-control">
            <input type="text" class="form-control">
        </div>
    </div>

    <script src="/js/manifest.js"></script>
    <script src="/js/vendor.js"></script>
    <script src="/js/edit-note.js"></script>

    <script>
        
    </script>
</body>
</html>
