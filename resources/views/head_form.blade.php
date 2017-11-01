<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="@yield('description')">
<meta name="author" content="@yield('author')">
<title>@yield('doc_title')</title>

<!-- Declare Bootstrap CSS and JS after jQuery UI to override tooltip functionality -->
<!-- jquery-ui.css -->
<link rel="stylesheet" href="{{ url('/assets/styles/jquery-ui-1.11.3.css') }}">
<!-- multiple-select -->
{{-- <link rel="stylesheet" href="{{ url('/assets/styles/multiple-select.css') }}"> --}}
<!-- Bootstrap -->
<link rel="stylesheet" href="{{ url('/assets/styles/bootstrap-3.3.5/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ url('/css/font-awesome.min.css') }}">
<!-- bootstrap-datetimepicker.css -->
<link rel="stylesheet" href="{{ url('/assets/styles/bootstrap-datetimepicker/css/bootstrap-datetimepicker.css') }}">




<!-- script -->
<!-- jQuery.js -->
<script src="{{ url('/assets/script/jquery-1.11.3.min.js') }}"></script>
<!-- jquery-ui.js -->
<script src="{{ url('/assets/script/jquery-ui-1.11.3.min.js') }}"></script>
<!-- moment.js -->
<script src="{{ url('/assets/script/moment-with-locales.min.js') }}"></script>
<!-- transition.js -->
<script src="{{ url('/assets/styles/bootstrap-3.3.5/js/transition.js') }}"></script>
<!-- collapse.js -->
<script src="{{ url('/assets/styles/bootstrap-3.3.5/js/collapse.js') }}"></script>
<!-- bootstrap.min.js -->
<script src="{{ url('/assets/styles/bootstrap-3.3.5/js/bootstrap.min.js') }}"></script>
<!-- bootstrap-datetimepicker.min.js -->
<script src="{{ url('/assets/styles/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>

<!-- jquery.multiple.select.js -->
{{-- <script src="{{ url('/assets/script/jquery.multiple.select.js') }}"></script> --}}
<!-- textarea auto expand -->
<script src="{{ url('/assets/script/autosize.min.js') }}"></script>
<!-- sticky.js -->
{{-- <script src="{{ url('/assets/script/jquery.sticky.js') }}"></script> --}}


<link rel="stylesheet" href="{{ url('/css/bootstrap-select.min.css') }}">
<script src="{{ url('/js/bootstrap-select.min.js') }}"></script>

<!-- style -->
<!-- font -->
<style type="text/css">
/*
	@font-face {
		font-family: 'CSPraJad';
		src: url('/assets/fonts/CSPraJad.otf');
	}

	@font-face {
		font-family: 'CSPraJad';
		src: url('/assets/fonts/CSPraJad-bold.otf');
		font-weight: bold;
	}

	@font-face {
		font-family: 'CSPraJad';
		src: url('/assets/fonts/CSPraJad-Italic.otf');
		font-style: italic;
	}

	@font-face {
		font-family: 'CSPraJad';
		src: url('/assets/fonts/CSPraJad-boldItalic.otf');
		font-style: italic;
		font-weight: bold;
	}
*/
	@font-face {
		font-family: 'Roboto';
		src: url('/assets/fonts/Roboto-Regular.ttf');
	}

	@font-face {
		font-family: 'Roboto';
		src: url('/assets/fonts/Roboto-Bold.ttf');
		font-weight: bold;
	}

	@font-face {
		font-family: 'Roboto';
		src: url('/assets/fonts/Roboto-Italic.ttf');
		font-style: italic;
	}

	@font-face {
		font-family: 'Roboto';
		src: url('/assets/fonts/Roboto-BoldItalic.ttf');
		font-style: italic;
		font-weight: bold;
	}

/*
	@font-face {
		font-family: 'Roboto Light';
		src: url('http://www.fontsaddict.com/fontface/roboto-light.ttf');
	}

	@font-face {
		font-family: 'Roboto Italic';
		src: url('http://www.fontsaddict.com/fontface/roboto-italic.ttf');
	}

	@font-face {
		font-family: 'Roboto';
		font-style: normal;
		font-weight: 300;
		src: local('Roboto Light'), local('Roboto-Light'), url('./assets/fonts/Roboto-Light.ttf') format('ttf');
	}

	@font-face {
		font-family: 'Roboto';
		font-style: normal;
		font-weight: 400;
		src: local('Roboto'), local('Roboto-Regular'), url('./assets/fonts/Roboto-Regular.ttf') format('ttf');
	}
	*/

	/*<!-- form style -->*/

	/*style for autocomplete vertical scroll*/
	.ui-autocomplete {
		font-family: "Roboto", Helvetica, Arial, sans-serif;
		max-height: 200px;
		overflow-y: auto;
		/* prevent horizontal scrollbar */
		overflow-x: hidden;
	}

	/* IE 6 doesn't support max-height
	 * we use height instead, but this forces the menu to always be this tall
	 */
	* html .ui-autocomplete {
		height: 200px;
	}

	.ui-menu .ui-menu-item a {
		background: rgb(38, 50, 56);
		color: rgb(176, 170, 197);
	}

	/*.ui-menu .ui-menu-item:hover {
		background: rgb(51, 67, 75);
		color: rgb(255, 255, 255);
	}*/


/*



.ui-menu .ui-menu-item a
*/

	/*.ui-state-active,
	.ui-menu .ui-menu-item a.ui-state-focus, 
	.ui-menu .ui-menu-item a.ui-state-active, 
	.ui-menu-item, .ui-menu-item:hover,
	.ui-menu-item a, .ui-menu-item a:hover,
	.ui-autocomplete, .ui-autocomplete:hover,
	.ui-widget-content .ui-state-active,
.ui-widget-header .ui-state-active, 
.ui-autocomplete, .ui-autocomplete:hover,
.ui-widget-content .ui-state-focus,
.ui-widget-header .ui-state-focus,
.ui-widget-content .ui-state-hover,
.ui-widget-header .ui-state-hover,*/
	/*.ui-menu .ui-menu-item:active {
	background: rgb(51, 67, 75);
	color: rgb(255, 255, 255);
	font-weight: bold;
	}*/



	.ui-menu .ui-menu-item {
		background: rgb(38, 50, 56);
		color: rgb(176, 170, 197);
		font-weight: normal;
	}

	.ui-state-focus {
		background: rgb(51, 67, 75)!important;
		color: rgb(255, 255, 255)!important;
		/*border: none!important;
		font-weight: normal!important;*/
	}

	.ui-state-highlight {
		background: none!important;
		color: rgb(128, 203, 196)!important;
		border: none!important;
		font-weight: bold!important;
	}

	/*.ui-tooltip {
	    background: #666;
	    color: white;
	    border: none;
	    padding: 10;
	    opacity: 1;
	    font-size: 12px;
	}*/

	/*btn-group for text generator*/
	.btn-group.gen{
	    margin-top:5px;
	    margin-bottom:2px;
	    margin-right: 8px;
	    margin-left: 2px;
	    border-radius:5px;
	}

	.btn-group-in-well { /*padding for template choices div*/
	padding: 2px 1px 2px 1px;
}
	
	/*style for form*/
	body {
		font-family: "Roboto", Helvetica, Arial, sans-serif;
		font-size: 14px;
		line-height: 1.42857143;
		color: #333333;
		/*padding-top: 70px;*/
		/*background: #293f50;
		-webkit-filter: grayscale(100%);*/ /* Chrome, Safari, Opera */
		/*filter: grayscale(100%);*/
		/*background: #3366CC;*/
	}
</style>



<script>
	// smooth scroll
	$(function() {
	  $('a[href*="#"]:not([href^="#collapse"])').click(function() {
	    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
	      var target = $(this.hash);
	      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
	      if (target.length) {
	        $('html, body').animate({
	          scrollTop: target.offset().top - 150
	        }, 600, function () {
	      //$(this).focus();
	          $('#' + target.prop('id')).focus();
	      //alert(target.prop('id'));
	        });
	        return false;
	      }
	    }
	  });
	});

	$(function () { $('[data-toggle="tooltip"]').tooltip() }); // Initiate tooltip.
	// $(function() {
	// 	jQuery tool tip
	//     $( document ).tooltip();
	// });

	

	// auto calculate year from Buddhist
	// function handleYear(tmpDate){
	// 	if (tmpDate == '') return '';
	// 	var dateArr = tmpDate.split('-');
	// 	return (dateArr[2] > 2400) ? dateArr[0] + '-' + dateArr[1] + '-' + (dateArr[2] - 543) : dateArr[0] + '-' + dateArr[1] + '-' + dateArr[2];
	// }
	// Bhuddish year to christian year.
	function handleYear(tmpDate){
		if (tmpDate == '')
			return '';
		if (tmpDate.length <= 10) {
			var dateArr = tmpDate.split('-');
			return (dateArr[2] > 2400) ? dateArr[0] + '-' + dateArr[1] + '-' + (dateArr[2] - 543) : dateArr[0] + '-' + dateArr[1] + '-' + dateArr[2];
		}
		var dateArr = tmpDate.split('-');
		var yearTime = dateArr[2].split(' ');
		// console.log(yearTime[1]);
		return (yearTime[0] > 2400) ? dateArr[0] + '-' + dateArr[1] + '-' + (yearTime[0] - 543) + ' ' + yearTime[1] : dateArr[0] + '-' + dateArr[1] + '-' + yearTime[0] + ' ' + yearTime[1];
	}

	$(document).ready(function() { autosize($('textarea')); }); // Initiate textarea auto size.
</script>