<!DOCTYPE html>
<html lang="th-TH">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CDN -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script
      src="https://code.jquery.com/jquery-3.2.1.js"
      integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
      crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <style>
        .material-radio-group {
          cursor: pointer;
        }
        .material-radiobox {
          display: none;
        }
        /*radio control*/
        .material-radio-group-check-radio {
          width: 16px;
          height: 16px;
          border-radius: 50%;
          border: 2px solid;
          position: relative;
          -webkit-transition: border-color 0.2s linear 0s;
          transition: border-color 0.2s linear 0s;
        }
        .material-radio-group-check-radio:after {
          content: "";
          display: block;
          width: 8px;
          height: 8px;
          border-radius: 50%;
          position: absolute;
          left: 50%;
          top: 50%;
          -webkit-transform: translate(-50%, -50%) scale(0);
          transform: translate(-50%, -50%) scale(0);
          -webkit-transition: transform 0.2s linear 0s;
          transition: transform 0.2s linear 0s;
        }
        .material-radio-group-element {
          display: inline-block;
          vertical-align: middle;
        }
        .material-radio-group-caption {
          font-size: 14px;
          margin-left: 4px;
          -webkit-user-select: none;
          -moz-user-select: none;
          -ms-user-select: none;
        }
        .material-radiobox:disabled ~ .material-radio-group-caption,
        .material-radiobox:disabled ~ .material-radio-group-check-radio {
          cursor: no-drop;
        }
        .material-radiobox:checked ~ .material-radio-group-check-radio:after {
          -webkit-transform: translate(-50%, -50%) scale(2);
          transform: translate(-50%, -50%) scale(2);
        }
        .material-radio-group .material-radio-group-check-radio {
          border-color: #636b6f;
        }
        .material-radio-group .material-radio-group-check-radio:after {
          background-color: #636b6f;
        }
        .material-radiobox:disabled ~ .material-radio-group-caption {
          color: #eee;
        }
        .material-radio-group_primary .material-radio-group-check-radio {
          border-color: #4092d9;
        }
        .material-radio-group_primary .material-radio-group-check-radio:after {
          background-color: #4092d9;
        }
        .material-radio-group_success .material-radio-group-check-radio {
          border-color: #68c368;
        }
        .material-radio-group_success .material-radio-group-check-radio:after {
          background-color: #68c368;
        }
        .material-radio-group_info .material-radio-group-check-radio {
          border-color: #8bdaf2;
        }
        .material-radio-group_info .material-radio-group-check-radio:after {
          background-color: #8bdaf2;
        }
        .material-radio-group_warning .material-radio-group-check-radio {
          border-color: #f2a12e;
        }
        .material-radio-group_warning .material-radio-group-check-radio:after {
          background-color: #f2a12e;
        }
        .material-radio-group_danger .material-radio-group-check-radio {
          border-color: #f3413c;
        }
        .material-radio-group_danger .material-radio-group-check-radio:after {
          background-color: #f3413c;
        }
    </style>

</head>
<body>
    <h3>Radiobox</h3>
    <div class="main-container__section">
        <label class="main-container__column material-radio-group" for="radio1">
            <input type="radio" name="radiobox" id="radio1" class="material-radiobox"/>
            <span class="material-radio-group-element material-radio-group-check-radio"></span>
            <span class="material-radio-group-element material-radio-group-caption">Default</span>
        </label>
        <label class="main-container__column material-radio-group material-radio-group_primary" for="radio2">
            <input type="radio" name="radiobox" id="radio2" class="material-radiobox"/>
            <span class="material-radio-group-element material-radio-group-check-radio"></span>
            <span class="material-radio-group-element material-radio-group-caption">Primary</span>
        </label>
        <label class="main-container__column material-radio-group material-radio-group_success" for="radio3">
            <input type="radio" name="radiobox" id="radio3" class="material-radiobox"/>
            <span class="material-radio-group-element material-radio-group-check-radio"></span>
            <span class="material-radio-group-element material-radio-group-caption">Success</span>
        </label>
        <label class="main-container__column material-radio-group material-radio-group_info" for="radio4">
            <input type="radio" name="radiobox" id="radio4" class="material-radiobox"/>
            <span class="material-radio-group-element material-radio-group-check-radio"></span>
            <span class="material-radio-group-element material-radio-group-caption">Info</span>
        </label>
        <label class="main-container__column material-radio-group material-radio-group_danger" for="radio5">
            <input type="radio" name="radiobox" id="radio5" class="material-radiobox"/>
            <span class="material-radio-group-element material-radio-group-check-radio"></span>
            <span class="material-radio-group-element material-radio-group-caption">Danger</span>
        </label>
        <label class="main-container__column material-radio-group material-radio-group_warning" for="radio6">
            <input type="radio" name="radiobox" id="radio6" class="material-radiobox"/>
            <span class="material-radio-group-element material-radio-group-check-radio"></span>
            <span class="material-radio-group-element material-radio-group-caption">Warning</span>
        </label>
        <label class="main-container__column material-radio-group" for="radio7">
            <input type="radio" name="radiobox" id="radio7" class="material-radiobox" disabled />
            <span class="material-radio-group-element material-radio-group-check-radio"></span>
            <span class="material-radio-group-element material-radio-group-caption">Disabled</span>
        </label>
    
    </div> 
    
</body>
</html>
