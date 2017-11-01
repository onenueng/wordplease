<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="@yield('description')">
	<meta name="author" content="@yield('author')">
	<title>@yield('doc_title')</title>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="{{ url('/assets/styles/bootstrap-3.3.5/css/bootstrap.min.css') }}">
	<!-- font awesome -->
	<link rel="stylesheet" type="text/css" href="/css/font-awesome.min.css">
	<!-- jQuery -->
	<script src="{{ url('/assets/script/jquery-1.11.3.min.js') }}"></script>
	<!-- Bootstrap JS -->
	<script src="{{ url('/assets/styles/bootstrap-3.3.5/js/bootstrap.min.js') }}"></script>
	<!-- Fabric -->
	<script src="{{ url('/assets/script/fabric.js') }}"></script>

	<style type="text/css">
		.canvas-container {
			margin:0 auto ;
		} /*set center fabric canvas */
		/*style for form*/
		body {
			/*font-family: "Roboto", Helvetica, Arial, sans-serif;*/
			font-size: 14px;
			line-height: 1.42857143;
			color: #333333;
			padding-top: 70px;
			background: #293f50;
			/*background: #3366CC;*/
		}
		.color-plalet {
			color: transparent;
			font-size: 13px;
			margin: 2px 2px 2px 2px;
		}
		.well {
			padding: 5px;
		}
		.extra-tools-div {
			padding: 2px 1px 2px 1px;
		}
	</style>
</head>
<body>
	<div class="container-fluid">
		<button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Tooltip on left">Tooltip on left</button>	
	</div>
	
</body>
<script type="text/javascript">
	$(function () {
	  $('[data-toggle="tooltip"]').tooltip()
	});
</script>
</html>