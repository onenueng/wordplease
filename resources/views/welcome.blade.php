<html>
	<head>
		<title>Siriraj Wordplease</title>
		<link href='//fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>

		<style>
			
			@font-face {
		font-family: 'CSPraJad';
		src: url('/assets/fonts/CSPraJad.otf');
	}

	@font-face {
		font-family: 'Lato';
		src: url('/assets/fonts/Lato-Light.ttf');
	}
	/*
			@font-face {
				font-family: 'Roboto';
				src: url('/assets/fonts/Roboto-Light.ttf');
			}*/
/*
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
			}*/
			body {
				margin: 0;
				padding: 0;
				width: 100%;
				height: 100%;
				color: #B0BEC5;
				display: table;
				font-weight: 100;
				font-family: 'Lato';
				background: #293f50;
				/*background-image: url("/assets/images/weather.png");
				background-repeat: repeat;*/
				/*
				-webkit-filter: grayscale(100%); /* Chrome, Safari, Opera 
				filter: grayscale(100%);
				background: #262728;
				*/
			}

			.container {
				text-align: center;
				display: table-cell;
				vertical-align: middle;
			}

			.content {
				text-align: center;
				display: inline-block;
			}

			.title {
				font-size: 96px;
				margin-bottom: 40px;
			}

			.quote {
				font-size: 24px;
			}

			a.nounderline:link {  
				text-decoration:none;
				color: #0174DF;
			}

			/* visited link */
			a:visited {
				/*color: #0000EE;*/
				color: #0174DF;
			}

			a:hover {
				color: #93E5FF;
			}
		</style>
	</head>
	<body>
		<div class="container">
			<div class="content">
				@if (Auth::guest())
				<div class="title"><a class='nounderline' href="auth/login">Si MD IPD Note</a></div>
				@else
				<div class="title"><a class='nounderline' href="notes">Si MD IPD Note</a></div>
				@endif
				<div class="quote">{{ App\Wordpleasing::quote() }}</div>
			</div>
		</div>
	</body>
</html>
