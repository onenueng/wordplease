<!DOCTYPE html>
<html lang="th-TH">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CDN -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <style>
        @import url(https://fonts.googleapis.com/css?family=Roboto:500);
        h1,p{
            font-family: 'Roboto', sans-serif;
            text-align:center;
        }
        button{
            font-family: 'Roboto', sans-serif;
            text-transform: uppercase;
        }

        button:focus {
          outline: none !important;
        }
        .btn {
          border-radius: 2px;
          border: 0;
          transition: .2s ease-out;
          color: #fff;
          margin: 6px;
          box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
        }

        .btn:hover {
          color: #fff;
          box-shadow: 0 5px 11px 0 rgba(0, 0, 0, 0.18), 0 4px 15px 0 rgba(0, 0, 0, 0.15);
        }

        .btn:active, .btn:focus, .btn.active {
          outline: 0;
          color: #fff;
        }

        /*Primary*/
        .btn-primary {
          background: #4285F4;
        }

        .btn-primary:hover, .btn-primary:focus {
          background-color: #5a95f5 !important;
        }

        .btn-primary.active {
          background-color: #0b51c5 !important;
        }
        /*Secondary*/
        .btn-secondary {
          background-color: #aa66cc;
        }
        .btn-secondary:hover, .btn-secondary:focus {
          background-color: #b579d2 !important;
          color: #fff;
        }
        .btn-secondary.active {
          background-color: #773399 !important;
        }
        .btn-secondary.active:hover {
          color: #fff;
        }
        .btn-secondary.active:focus {
          color: #fff;
        }

        /*Default*/
        .btn-default {
          background: #2BBBAD;
        }
        .btn-default:hover, .btn-default:focus {
          background-color: #30cfc0 !important;
        }
        .btn-default.active {
          background-color: #186860 !important;
        }

        /*Success*/
        .btn-success {
          background: #00C851;
        }
        .btn-success:hover, .btn-success:focus {
          background-color: #00d255 !important;
        }
        .btn-success.active {
          background-color: #006228 !important;
        }

        /*Info*/
        .btn-info {
          background: #33b5e5;
        }
        .btn-info:hover, .btn-info:focus {
          background-color: #4abde8 !important;
        }
        .btn-info.active {
          background-color: #14799e !important;
        }

        /*Warning*/
        .btn-warning {
          background: #FF8800;
        }
        .btn-warning:hover, .btn-warning:focus {
          background-color: #ff961f !important;
        }
        .btn-warning.active {
          background-color: #cc8800 !important;
        }

        /*Danger*/
        .btn-danger {
          background: #CC0000;
        }
        .btn-danger:hover, .btn-danger:focus {
          background-color: #db0000 !important;
        }
        .btn-danger.active {
          background-color: maroon !important;
        }

        /*Link*/
        .btn-link {
          background-color: transparent;
          color: #000;
        }
        .btn-link:hover, .btn-link:focus {
          background-color: transparent;
          color: #000;
        }
    </style>
    <title>Button Material</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="jumbotron">
                <h1>MATERIAL DESIGN BUTTONS</h1>
                <p>Buttons based on default Boostrap classes edited to look like Google's Material Design.</p>
            </div>
            <center>
                <button class="btn btn-lg btn-default">Default</button>
                <button class="btn btn-lg btn-secondary">Secondary</button>
                <button class="btn btn-lg btn-primary">Primary</button>
                <button class="btn btn-lg btn-info">Info</button>
                <button class="btn btn-lg btn-warning">Warning</button>
                <button class="btn btn-lg btn-danger">Danger</button>
                <button class="btn btn-lg btn-success">Success</button>
                <button class="btn btn-lg btn-link">Link</button>
            </center>
        </div>
    </div>
</body>
</html>
