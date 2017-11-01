<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<title>@yield('doc_title')</title>
	<!-- Fonts -->
	{{-- <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'> --}}
	
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

	<!-- multiple-select -->
<link rel="stylesheet" href="{{ url('/assets/styles/multiple-select.css') }}">
<!-- Bootstrap -->
<link rel="stylesheet" href="{{ url('/assets/styles/bootstrap-3.3.5/css/bootstrap.min.css') }}">
<!-- bootstrap-datetimepicker.css -->
<link rel="stylesheet" href="{{ url('/assets/styles/bootstrap-datetimepicker/css/bootstrap-datetimepicker.css') }}">
<!-- jquery-ui.css -->
<link rel="stylesheet" href="{{ url('/assets/styles/jquery-ui-1.11.3.css') }}">

<!-- script -->
<!-- jQuery.js -->
<script src="{{ url('/assets/script/jquery-1.11.3.min.js') }}"></script>
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
<!-- jquery-ui.js -->
<script src="{{ url('/assets/script/jquery-ui-1.11.3.min.js') }}"></script>
<!-- jquery.multiple.select.js -->
<script src="{{ url('/assets/script/jquery.multiple.select.js') }}"></script>
<!-- textarea auto expand -->
<script src="{{ url('/assets/script/autosize.min.js') }}"></script>

<link rel="stylesheet" href="{{ url('/assets/styles/auth.css') }}">
<style>
@font-face {
				font-family: 'Roboto';
				src: url('/assets/fonts/Roboto-Light.ttf');
			}
body {
    /*background-image: url("/assets/images/dog-paw-print.jpg");
    background-repeat: repeat;*/
    /*
    -webkit-filter: grayscale(100%); /* Chrome, Safari, Opera 
		filter: grayscale(100%);262728
		*/
		font-family: 'Roboto';
		background: #293f50;
}
</style>

</head>
<body >
<body>{{-- 293f50 --}}
	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand">Si IPD MD Note</a>
			</div>
<!-- 
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/home') }}">Home</a></li>
				</ul>

				<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
						<li><a href="{{ url('/auth/login') }}">Login</a></li>
						<li><a href="{{ url('/auth/register') }}">Sign up</a></li>
					@else
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('/auth/logout') }}">Sign out</a></li>
							</ul>
						</li>
					@endif
				</ul>
			</div> -->
		</div>
	</nav>

	@yield('content')

	<!-- Scripts -->
	<!-- 
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	 -->
	 <!-- 
	<script src="{{ url('/assets/script/jquery-1.11.3.min.js') }}"></script>
	 -->
<!-- 
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.4/js/bootstrap.min.js"></script>
	 -->
<!-- 
	<script src="{{ url('/assets/styles/bootstrap-3.3.5/js/bootstrap.min.js') }}"></script>
	 -->
	 <script type="text/javascript">
	 	// auto calculate year from Buddhist
    function handleYear(tmpDate){
    	if (tmpDate == '')
    		return '';
    	else {
    		var dateArr = tmpDate.split('-');
    		return (dateArr[2] > 2400) ? dateArr[0] + '-' + dateArr[1] + '-' + (dateArr[2] - 543) : dateArr[0] + '-' + dateArr[1] + '-' + dateArr[2];
    	}
    }
	 </script>
</body>
</html>