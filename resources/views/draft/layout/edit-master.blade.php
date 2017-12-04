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

            @yield('content')

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
