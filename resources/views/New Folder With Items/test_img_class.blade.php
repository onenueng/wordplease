<html>
<head>
<title>ImaJS</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="@yield('description')">
    <meta name="author" content="@yield('author')">
    <link rel="stylesheet" href="{{ URL::asset('assets/styles/bootstrap-3.3.5/css/bootstrap.min.css') }}">
    <script src="{{ url('/assets/script/jquery-1.11.3.min.js') }}"></script>
	<style type="text/css">
	.btn-group{
	    margin-top:2px;
	    margin-bottom:2px;
	    margin-right: 2px;
	    margin-left: 2px;
	    border-radius:5px;
	}
</style>
</head>

<body>
@include('wordplease_js')<!-- paint js -->

<!-- img_@name WordPaint is required -->
<div class="well">
	<!-- tools button -->
	<button onclick="newPaint.resetCanvas()" type="button" class="btn btn-danger">Reset</button>
	<div class="btn-group" role="group" aria-label="...">
		<button type="button" class="active btn btn-default tools" id="marker">Marker</button>
		<button type="button" class="btn btn-default tools" id="label">Label</button>
		<button type="button" class="btn btn-default tools" id="eraser">Eraser</button>
	</div>

	<!-- tool script -->
	<script type="text/javascript">
		 $(".tools").click(function(){
		 	$(".tools").removeClass("active");
		 	$(this).addClass("active");
		 	curTool = $(this).prop('id');
		});
	</script>

	<!-- color button -->
	<div class="btn-group" role="group" aria-label="...">
		<button type="button" class="active btn btn-default colors" id="#FF0000">Red</button>
		<button type="button" class="btn btn-default colors" id="#00FFFF">Blue</button>
		<button type="button" class="btn btn-default colors" id="#006600">Green</button>
		<button type="button" class="btn btn-default colors" id="#000000">Black</button>
	</div>

	<!-- color script -->
	<script type="text/javascript">
	 	$(".colors").click(function(){
		 	$(".colors").removeClass("active");
		 	$(this).addClass("active");
		 	curColor = $(this).prop('id');
		});
	</script>

	<!-- brush size -->
	<div class="btn-group" role="group" aria-label="...">
		<button type="button" class="btn btn-default brushSize" id="small">Small</button>
		<button type="button" class="active btn btn-default brushSize" id="normal">Normal</button>
		<button type="button" class="btn btn-default brushSize" id="large">Large</button>
		<button type="button" class="btn btn-default brushSize" id="huge">Huge</button>
	</div>
	
	<!-- brush size script -->
	<script type="text/javascript">
	 	$(".brushSize").click(function(){
		 	$(".brushSize").removeClass("active");
		 	$(this).addClass("active");
		 	curSize = $(this).prop('id');
		});
	</script>

</div>

<!-- newPaint -->
<div id="newPaintDiv">
	<script type="text/javascript">
	var newPaint;
	$(document).ready(function() {
		newPaint = new WordPaint('newPaintDiv',540,720,'newPaint');
		newPaint.createCanvas();

		// add mousedown event
		$('#newPaint').mousedown(function(e){
			var mouseX = e.pageX - this.offsetLeft;
			var mouseY = e.pageY - this.offsetTop;
				
			Paint = true;
			AddClick(e.pageX - this.offsetLeft, e.pageY - this.offsetTop, newPaint);
			Redraw(newPaint);
		});

		// add mousemove event
		$('#newPaint').mousemove(function(e){
			if(Paint){
				AddClick(e.pageX - this.offsetLeft, e.pageY - this.offsetTop, newPaint,true);
				Redraw(newPaint);
			}
		});
	});
	</script>
</div><!-- end newPaint -->

<div class='col-md-12'><hr/></div>

<!-- newPaint1 -->
<div id="newPaint1Div">
	<script type="text/javascript">
	var newPaint1;
	$(document).ready(function() {
		newPaint1 = new WordPaint('newPaint1Div',540,720,'newPaint1');
		newPaint1.createCanvas('/assets/images/frontdermatome.png');

		// add mousedown event
		$('#newPaint1').mousedown(function(e){
			var mouseX = e.pageX - this.offsetLeft;
			var mouseY = e.pageY - this.offsetTop;
				
			Paint = true;
			AddClick(e.pageX - this.offsetLeft, e.pageY - this.offsetTop, newPaint1);
			Redraw(newPaint1);
		});

		// add mousemove event
		$('#newPaint1').mousemove(function(e){
			if(Paint){
				AddClick(e.pageX - this.offsetLeft, e.pageY - this.offsetTop, newPaint1,true);
				Redraw(newPaint1);
			}
		});
	});
	</script>
</div><!-- end newPaint1 -->
</body>
</html>