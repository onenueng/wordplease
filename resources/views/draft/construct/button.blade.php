<!DOCTYPE html>
<html lang="th-TH">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script   src="https://code.jquery.com/jquery-3.2.1.js"   integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="   crossorigin="anonymous"></script>

    <!-- Bootstrap CDN -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    
    
    <style>
        .material-checkbox-group-label {
                  position: relative;
                  display: block;
                  cursor: pointer;
                  height: 20px;
                  line-height: 20px;
                  padding-left: 30px;
                }
                .material-checkbox-group-label:after {
                  content: "";
                  display: block;
                  width: 4px;
                  height: 12px;
                  opacity: .9;
                  border-right: 2px solid #eee;
                  border-top: 2px solid #eee;
                  position: absolute;
                  left: 4px;
                  top: 12px;
                  -webkit-transform: scaleX(-1) rotate(135deg);
                  transform: scaleX(-1) rotate(135deg);
                  -webkit-transform-origin: left top;
                  transform-origin: left top;
                }
                .material-checkbox-group-label:before {
                  content: "";
                  display: block;
                  border: 2px solid;
                  width: 20px;
                  height: 20px;
                  position: absolute;
                  left: 0;
                }
                .material-checkbox-group-label {
                  font-size: 14px;
                  -webkit-user-select: none;
                  -moz-user-select: none;
                  -ms-user-select: none;
                }
                .material-checkbox:disabled ~ .material-checkbox-group-label {
                  cursor: no-drop;
                }
                .material-checkbox {
                  display: none;
                }
                .material-checkbox-group .material-checkbox:checked + .material-checkbox-group-label:after {
                  -webkit-animation: check 0.8s;
                  animation: check 0.8s;
                  opacity: 1;
                }
                .material-checkbox-group .material-checkbox:checked + .material-checkbox-group-label:after {
                  border-color: #636b6f;
                }
                .material-checkbox-group .material-checkbox:checked + .material-checkbox-group-label:before {
                  background-color: #eee;
                }
                .material-checkbox-group .material-checkbox-group-label:before {
                  border-color: #636b6f;
                }
                .material-checkbox:disabled ~ .material-checkbox-group-label {
                  color: #eee;
                }
                .material-checkbox-group_primary .material-checkbox:checked + .material-checkbox-group-label:after {
                  border-color: #fff;
                }
                .material-checkbox-group_primary .material-checkbox:checked + .material-checkbox-group-label:before {
                  background-color: #4092d9;
                }
                .material-checkbox-group_primary .material-checkbox-group-label:before {
                  border-color: #4092d9;
                }
                .material-checkbox-group_success .material-checkbox:checked + .material-checkbox-group-label:after {
                  border-color: #fff;
                }
                .material-checkbox-group_success .material-checkbox:checked + .material-checkbox-group-label:before {
                  background-color: #68c368;
                }
                .material-checkbox-group_success .material-checkbox-group-label:before {
                  border-color: #68c368;
                }
                .material-checkbox-group_info .material-checkbox:checked + .material-checkbox-group-label:after {
                  border-color: #fff;
                }
                .material-checkbox-group_info .material-checkbox:checked + .material-checkbox-group-label:before {
                  background-color: #8bdaf2;
                }
                .material-checkbox-group_info .material-checkbox-group-label:before {
                  border-color: #8bdaf2;
                }
                .material-checkbox-group_warning .material-checkbox:checked + .material-checkbox-group-label:after {
                  border-color: #fff;
                }
                .material-checkbox-group_warning .material-checkbox:checked + .material-checkbox-group-label:before {
                  background-color: #f2a12e;
                }
                .material-checkbox-group_warning .material-checkbox-group-label:before {
                  border-color: #f2a12e;
                }
                .material-checkbox-group_danger .material-checkbox:checked + .material-checkbox-group-label:after {
                  border-color: #fff;
                }
                .material-checkbox-group_danger .material-checkbox:checked + .material-checkbox-group-label:before {
                  background-color: #f3413c;
                }
                .material-checkbox-group_danger .material-checkbox-group-label:before {
                  border-color: #f3413c;
                }
                @-webkit-keyframes check {
                  0% {
                    height: 0;
                    width: 0;
                  }
                  25% {
                    height: 0;
                    width: 4px;
                  }
                  50% {
                    height: 12px;
                    width: 4px;
                  }
                }
                @keyframes check {
                  0% {
                    height: 0;
                    width: 0;
                  }
                  25% {
                    height: 0;
                    width: 4px;
                  }
                  50% {
                    height: 12px;
                    width: 4px;
                  }
                }
    </style>
    <title>TEST Material</title>
</head>
<body>
  <div class="material-checkbox-group">
      <input type="checkbox" id="checkbox0" name="checkbox" class="material-checkbox">
      <label class="material-checkbox-group-label" for="checkbox0">Do you like it?</label>
  </div>
</body>
</html>
