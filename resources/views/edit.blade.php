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
            <panel heading='genderal data'>
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

            <div class="form-group-sm has-feedback">
                <label class="control-label">Username</label>
                <input type="text" class="form-control" placeholder="Username" id="ajax" onkeypress="return false;" />
                <i class="fa fa-chevron-down form-control-feedback"></i>
            </div>
        </div>
    </div>

    <script src="/js/manifest.js"></script>
    <script src="/js/vendor.js"></script>
    <script src="/js/edit-note.js"></script>

    <script>
        $('#ajax').autocomplete({
            serviceUrl: '/get-ajax',
            minChars: 0
        });
    </script>
</body>
</html>
