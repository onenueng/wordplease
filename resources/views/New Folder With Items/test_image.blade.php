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
	<button onclick="resetakiraCanvas()" type="button" class="btn btn-danger">Reset</button>
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

<div id="akiraCanvasDiv"></div>
<script type="text/javascript"> 
	$(document).ready(function() {
		createakiraCanvas();
	});

	// global variables
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

	var akiraCanvasWidth =  540; //individual
    var akiraCanvasHeight = 720; //individual
	var akiraClickColor = new Array(); //individual
	var akiraClickX = new Array(); //individual
	var akiraClickY = new Array(); //individual
	var akiraClickDrag = new Array(); //individual
	var akiraPaint = false; //individual
	var akiraClickSize = new Array(); //individual
	
	var akiraCanvas; //individual
	var akiraContext; //individual
	var akiraOutlineImage = new Image(); //individual

	function createakiraCanvas() {
	    var canvasDiv = document.getElementById('akiraCanvasDiv');

	    // create akiraCanvas
		akiraCanvas = document.createElement('canvas');
		akiraCanvas.setAttribute('width', akiraCanvasWidth);
		akiraCanvas.setAttribute('height', akiraCanvasHeight);
		akiraCanvas.setAttribute('id', 'akiraCanvas');
		akiraCanvas.style.border = "solid";
		canvasDiv.appendChild(akiraCanvas);
		if(typeof G_vmlCanvasManager != 'undefined') {
			akiraCanvas = G_vmlCanvasManager.initElement(akiraCanvas);
		}
		akiraContext = akiraCanvas.getContext("2d");

		// load outline image
		//akiraOutlineImage.src = window.location.origin + "/assets/images/frontdermatome.png";
		akiraOutlineImage.src = "{{ url('/assets/images/frontdermatome.png') }}";
		if (akiraOutlineImage.complete) {
			akiraDrawFit();
		} else {
		    akiraOutlineImage.onload = function () {
		        akiraDrawFit();
		    };
		}

		// add mousedown event
		$('#akiraCanvas').mousedown(function(e){
			var mouseX = e.pageX - this.offsetLeft;
			var mouseY = e.pageY - this.offsetTop;
				
			akiraPaint = true;
			akiraAddClick(e.pageX - this.offsetLeft, e.pageY - this.offsetTop);
			akiraRedraw();
		});

		// add mousemove event
		$('#akiraCanvas').mousemove(function(e){
			if(akiraPaint){
				akiraAddClick(e.pageX - this.offsetLeft, e.pageY - this.offsetTop, true);
				akiraRedraw();
			}
		});

		// add mouseup event
		$('#akiraCanvas').mouseup(function(e){
		 	akiraPaint = false;
		});

		// add mouseleave event
		$('#akiraCanvas').mouseleave(function(e){
  			akiraPaint = false;
		});
	}

	// draw outline image fit to akiraCanvas
	function akiraDrawFit() {
		akiraContext.drawImage(akiraOutlineImage, 0, 0, akiraOutlineImage.width, akiraOutlineImage.height, 0, 0, akiraCanvas.width, akiraCanvas.height);
	}

	// reset akiraCanvas
	function resetakiraCanvas(){
		// clear akiraCanvas
		akiraContext.clearRect(0,0,akiraCanvas.width,akiraCanvas.height);
		akiraCanvas.width = akiraCanvas.width;

	    // clear data arrays
	    akiraClickX = new Array();
	    akiraClickY = new Array();
	    akiraClickDrag = new Array();
	    akiraClickColor = new Array();
	    akiraClickSize = new Array();

	    // draw outline picture
	    akiraDrawFit();
	}

	function dlakiraCanvas() {
		var dt = akiraCanvas.toDataURL('image/png');
		/* Change MIME type to trick the browser to downlaod the file instead of displaying it */
		dt = dt.replace(/^data:image\/[^;]*/, 'data:application/octet-stream');

		/* In addition to <a>'s "download" attribute, you can define HTTP-style headers */
		dt = dt.replace(/^data:application\/octet-stream/, 'data:application/octet-stream;headers=Content-Disposition%3A%20attachment%3B%20filename=akiraCanvas.png');

		this.href = dt;
	};
	document.getElementById("@name_dl_btn").addEventListener('click', dlakiraCanvas, false);

	function akiraAddClick(x, y, dragging) {
		akiraClickX.push(x);
		akiraClickY.push(y);
		akiraClickDrag.push(dragging);

		if (curTool == "label")
			akiraAddlabel();
		else 
			if(curTool == "eraser")
				akiraClickColor.push("white");
			else
				akiraClickColor.push(curColor);
		
		akiraClickSize.push(curSize);
	}
	
	// Clears the akiraCanvas
	function clearakiraCanvas() {
		akiraContext.clearRect(0, 0, akiraCanvasWidth, akiraCanvasHeight);
	}	

	function akiraAddlabel() {
		var str = prompt('Enter text :');
		if (str != '' && str != null) {
			akiraClickColor.push(curColor + '@' + str);
		} else
			akiraClickColor.push(curColor + '@ ');
	}

	function akiraRedraw() {
			
		clearakiraCanvas();

		akiraContext.lineJoin = "round";
		
		var font_txt;
		var tmpClr;
		var lab_tmp;

		for(var i=0; i < akiraClickX.length; i++) {		
			akiraContext.beginPath();

			// assign size
			if(akiraClickSize[i] == "small"){
				radius = 2;
				font_txt = 8 + "px tahoma";
			}else if(akiraClickSize[i] == "normal"){
				radius = 5;
				font_txt = 14 + "px tahoma";
			}else if(akiraClickSize[i] == "large"){
				radius = 10;
				font_txt = 25 + "px tahoma";
			}else if(akiraClickSize[i] == "huge"){
				radius = 20;
				font_txt = 40 + "px tahoma";
			}else{
				alert("Error: Radius is zero for click " + i);
				radius = 0;
				font_txt = 14 + "px tahoma";
			}

			tmpClr = akiraClickColor[i];
			if (tmpClr.search('@') > 0) { //label process
				lab_tmp = tmpClr.split('@');
				akiraContext.fillStyle = lab_tmp[0];
				akiraContext.font = font_txt;
				akiraContext.fillText(lab_tmp[1], akiraClickX[i], akiraClickY[i]);
			}
			else { //drawing process
				if(akiraClickDrag[i] && i)
					akiraContext.moveTo(akiraClickX[i-1], akiraClickY[i-1]);
				else 
					akiraContext.moveTo(akiraClickX[i]-1, akiraClickY[i]);

				akiraContext.lineTo(akiraClickX[i], akiraClickY[i]);
				akiraContext.closePath();
				akiraContext.strokeStyle = akiraClickColor[i];
				akiraContext.lineWidth = radius;
				akiraContext.stroke();
			}
		}
		akiraDrawFit();
	}
</script>
</body>
</html>