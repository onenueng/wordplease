<!-- @name drawing-image -->
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
	var @nameOutlineImage = new Image(); //individual

	function create@nameCanvas() {
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
	function @nameDrawFit() {
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

	    // draw outline picture
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

	function @nameAddClick(x, y, dragging) {
		@nameClickX.push(x);
		@nameClickY.push(y);
		@nameClickDrag.push(dragging);

		if (curTool == "label")
			@nameAddlabel();
		else 
			if(curTool == "eraser")
				@nameClickColor.push("white");
			else
				@nameClickColor.push(curColor);
		
		@nameClickSize.push(curSize);
	}
	
	// Clears the @nameCanvas
	function clear@nameCanvas() {
		@nameContext.clearRect(0, 0, @nameCanvasWidth, @nameCanvasHeight);
	}	

	function @nameAddlabel() {
		var str = prompt('Enter text :');
		if (str != '' && str != null) {
			@nameClickColor.push(curColor + '@' + str);
		} else
			@nameClickColor.push(curColor + '@ ');
	}

	function @nameRedraw() {
			
		clear@nameCanvas();

		@nameContext.lineJoin = "round";
		
		var font_txt;
		var tmpClr;
		var lab_tmp;

		for(var i=0; i < @nameClickX.length; i++) {		
			@nameContext.beginPath();

			// assign size
			if(@nameClickSize[i] == "small"){
				radius = 2;
				font_txt = 8 + "px tahoma";
			}else if(@nameClickSize[i] == "normal"){
				radius = 5;
				font_txt = 14 + "px tahoma";
			}else if(@nameClickSize[i] == "large"){
				radius = 10;
				font_txt = 25 + "px tahoma";
			}else if(@nameClickSize[i] == "huge"){
				radius = 20;
				font_txt = 40 + "px tahoma";
			}else{
				alert("Error: Radius is zero for click " + i);
				radius = 0;
				font_txt = 14 + "px tahoma";
			}

			tmpClr = @nameClickColor[i];
			if (tmpClr.search('@') > 0) { //label process
				lab_tmp = tmpClr.split('@');
				@nameContext.fillStyle = lab_tmp[0];
				@nameContext.font = font_txt;
				@nameContext.fillText(lab_tmp[1], @nameClickX[i], @nameClickY[i]);
			}
			else { //drawing process
				if(@nameClickDrag[i] && i)
					@nameContext.moveTo(@nameClickX[i-1], @nameClickY[i-1]);
				else 
					@nameContext.moveTo(@nameClickX[i]-1, @nameClickY[i]);

				@nameContext.lineTo(@nameClickX[i], @nameClickY[i]);
				@nameContext.closePath();
				@nameContext.strokeStyle = @nameClickColor[i];
				@nameContext.lineWidth = radius;
				@nameContext.stroke();
			}
		}
		@nameDrawFit();
	}
</script><!-- end @name drawing-image -->