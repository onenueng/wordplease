<!DOCTYPE html>
<html lang="th-TH">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/app.css">
    <title>$USERNAME@worplease</title>
</head>
<body>
    <!-- modal component -->

    <div id="app">
        <!-- Create note Navbar -->
        <navbar
            home-link="/"
            department-name="Medicine"
            app-name="IPD Note"
            username="koramit"
            pattern="^[0-9]{8}$">
        </navbar>
    
    
        <div class="container-fluid">
            <input-text name="an" value="12345678" label="an :" ></input-text>
            
            <div class="form-group form-group-sm has-success has-feedback" id="xxx">
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">AN</span>
                    <input type="text" class="form-control" id="inputGroupSuccess1" aria-describedby="inputGroupSuccess1Status">
                </div>
                <span class="fa fa-check form-control-feedback" aria-hidden="true" id="xxxicon"></span>
                <span id="inputGroupSuccess1Status" class="sr-only">(success)</span>
            </div>
        </div>

    </div>

    <script src="/js/manifest.js"></script>
    <script src="/js/vendor.js"></script>
    <script src="/js/create-note.js"></script>
</body>
</html>
