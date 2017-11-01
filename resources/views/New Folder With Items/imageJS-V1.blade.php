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
<div class="well">
	<!-- tools button -->
	<button onclick="reset@nameCanvas()" type="button" class="btn btn-danger">Reset</button>
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

<div id="@nameCanvasDiv"></div>
<script type="text/javascript"> 
	$(document).ready(function() {
		create@nameCanvas();
	});

	// variables
	
    var colorPurple = "#00FFFF"; //common
	var colorGreen = "#006600"; //common
	var colorYellow = "#000000"; //common
	var colorBrown = "#00FFFF"; //common
	var colorRed = "#FF0000"; //common
	var colorWhite = "white"; //common
	var radius = 5; //common
	var curColor = colorRed; //common
	var curSize = "normal"; //common
	var curTool = "marker"; //common

	var @nameCanvasWidth =  540; //individual
    var @nameCanvasHeight = 720; //individual
	var @nameClickColor = new Array(); //individual
	var @nameClickX = new Array(); //individual
	var @nameClickY = new Array(); //individual
	var @nameClickDrag = new Array(); //individual
	var @namePaint = false; //individual
	var @nameClickSize = new Array(); //individual
	
	var @nameCanvas; //individual
	var @nameContext; //individual
	//var clickTool = new Array(); //individual
	var @nameOutlineImage = new Image(); //individual

	var @nameLabX = new Array(); //individual
	var @nameLabY = new Array(); //individual
	var @nameLabTxt  = new Array(); //individual
	var @nameLabColor  = new Array(); //individual
	var @nameLabSize  = new Array(); //individual
	var tmpX; //common
	var tmpY; //common
	var fontSize = 14; //common

	function create@nameCanvas(){
	    var canvasDiv = document.getElementById('@nameCanvasDiv');

	    // create @nameCanvas
		@nameCanvas = document.createElement('canvas');
		@nameCanvas.setAttribute('width', @nameCanvasWidth);
		@nameCanvas.setAttribute('height', @nameCanvasHeight);
		@nameCanvas.setAttribute('id', '@nameCanvas');
		@nameCanvas.style.border = "solid";
		canvasDiv.appendChild(@nameCanvas);
		if(typeof G_vmlCanvasManager != 'undefined') {
			@nameCanvas = G_vmlCanvasManager.initElement(@nameCanvas);
		}
		@nameContext = @nameCanvas.getContext("2d");

		// load outline image
		//@nameOutlineImage.src = window.location.origin + "/assets/images/frontdermatome.png";
		@nameOutlineImage.src = "{{ url('/assets/images/frontdermatome.png') }}";
		if (@nameOutlineImage.complete) {
			@nameDrawFit();
		} else {
		    @nameOutlineImage.onload = function () {
		        @nameDrawFit();
		    };
		}

		// add mousedown event
		$('#@nameCanvas').mousedown(function(e){
			var mouseX = e.pageX - this.offsetLeft;
			var mouseY = e.pageY - this.offsetTop;
				
			@namePaint = true;
			@nameAddClick(e.pageX - this.offsetLeft, e.pageY - this.offsetTop);
			@nameRedraw();
		});

		// add mousemove event
		$('#@nameCanvas').mousemove(function(e){
			if(@namePaint){
				@nameAddClick(e.pageX - this.offsetLeft, e.pageY - this.offsetTop, true);
				@nameRedraw();
			}
		});

		// add mouseup event
		$('#@nameCanvas').mouseup(function(e){
		 	@namePaint = false;
		});

		// add mouseleave event
		$('#@nameCanvas').mouseleave(function(e){
  			@namePaint = false;
		});
	}

	// draw outline image fit to @nameCanvas
	function @nameDrawFit(){

		@nameContext.drawImage(@nameOutlineImage, 0, 0, @nameOutlineImage.width, @nameOutlineImage.height, 0, 0, @nameCanvas.width, @nameCanvas.height);
	}

	// reset @nameCanvas
	function reset@nameCanvas(){
		// clear @nameCanvas
		@nameContext.clearRect(0,0,@nameCanvas.width,@nameCanvas.height);
		@nameCanvas.width = @nameCanvas.width;

	    // clear data arrays
	    @nameClickX = new Array();
	    @nameClickY = new Array();
	    @nameClickDrag = new Array();
	    @nameClickColor = new Array();
	    @nameClickSize = new Array();

	    @nameLabX = new Array();
	    @nameLabY = new Array();
	    @nameLabTxt = new Array();
	    @nameLabColor = new Array();
	    @nameLabSize = new Array();

	    @nameDrawFit();
	}

	function dl@nameCanvas() {
		var dt = @nameCanvas.toDataURL('image/png');
		/* Change MIME type to trick the browser to downlaod the file instead of displaying it */
		dt = dt.replace(/^data:image\/[^;]*/, 'data:application/octet-stream');

		/* In addition to <a>'s "download" attribute, you can define HTTP-style headers */
		dt = dt.replace(/^data:application\/octet-stream/, 'data:application/octet-stream;headers=Content-Disposition%3A%20attachment%3B%20filename=@nameCanvas.png');

		this.href = dt;
	};
	document.getElementById("@name_dl_btn").addEventListener('click', dl@nameCanvas, false);

	function @nameAddClick(x, y, dragging){
		if (curTool == "label") {
			if (!dragging){
				tmpX = x;
				tmpY = y;
				@nameAddlabel();
			}
		} else {
			@nameClickX.push(x);
			@nameClickY.push(y);
			@nameClickDrag.push(dragging);

			if(curTool == "eraser"){
				@nameClickColor.push("white");
			}else{
				@nameClickColor.push(curColor);
			}
			@nameClickSize.push(curSize);
		}
	}
	
	// Clears the @nameCanvas
	function clear@nameCanvas(){
		@nameContext.clearRect(0, 0, @nameCanvasWidth, @nameCanvasHeight);
	}	

	function @nameAddlabel() {
		var str = prompt('Enter text :');
		if (str != '' && str != null) {
			@nameContext.fillStyle = curColor;

			if(curSize == "small"){
				fontSize = 8;
			}else if(curSize == "normal"){
				fontSize = 14;
			}else if(curSize == "large"){
				fontSize = 25;
			}else if(curSize == "huge"){
				fontSize = 40;
			}else{
				alert("Error: fontSize is zero for click " + i);
				fontSize = 14;	
			}

			@nameContext.font = fontSize + "px tahoma";
			// @nameContext.font = '14px tahoma';
			@nameContext.fillText(str, tmpX, tmpY);
			@nameLabX.push(tmpX);
			@nameLabY.push(tmpY);
			@nameLabColor.push(curColor);
			@nameLabSize.push(fontSize);
			@nameLabTxt.push(str);
		}
	}

	function @nameRedraw(){
			
		clear@nameCanvas();

		@nameContext.lineJoin = "round";
		
		for(var i=0; i < @nameLabTxt.length; i++) {
			@nameContext.fillStyle = @nameLabColor[i];

			@nameContext.font = @nameLabSize[i] + "px tahoma";
			// @nameContext.font = '14px tahoma';
			
			@nameContext.fillText(@nameLabTxt[i], @nameLabX[i], @nameLabY[i]);
			// console.log(@nameLabTxt[i] + ' x:' + @nameLabX[i] + ' y:' + @nameLabY[i]);
		}

		for(var i=0; i < @nameClickX.length; i++) {		
			@nameContext.beginPath();

			if(@nameClickSize[i] == "small"){
				radius = 2;
			}else if(@nameClickSize[i] == "normal"){
				radius = 5;
			}else if(@nameClickSize[i] == "large"){
				radius = 10;
			}else if(@nameClickSize[i] == "huge"){
				radius = 20;
			}else{
				alert("Error: Radius is zero for click " + i);
				radius = 0;	
			}

			if(@nameClickDrag[i] && i){
				@nameContext.moveTo(@nameClickX[i-1], @nameClickY[i-1]);
			}else{
				@nameContext.moveTo(@nameClickX[i]-1, @nameClickY[i]);
			}

			@nameContext.lineTo(@nameClickX[i], @nameClickY[i]);
			@nameContext.closePath();
			@nameContext.strokeStyle = @nameClickColor[i];
			@nameContext.lineWidth = radius;
			@nameContext.stroke();

		}

		@nameDrawFit();
	}
</script>
</body>
</html>