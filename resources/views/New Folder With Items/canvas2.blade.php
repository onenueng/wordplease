@extends('form')

@section('script')
	<!-- 
	<style type="text/css">
		canvas {
		    //background-color: blue;
		    width: 100%;
		    height: auto;
		}
	</style>
	 -->
<!-- 
	 <style type="text/css">
	 	canvas {
    padding: 0;
    margin: auto;
    display: block;
    width: 800px;
    height: 600px;
    position: relative;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
}
	 </style>
 -->

 	<style type="text/css">
 		.vertical-center {
  min-height: 100%;  /* Fallback for browsers do NOT support vh unit */
  min-height: 100vh; /* These two lines are counted as one :-)       */

  display: flex;
  align-items: center;
}
 	</style>
@endsection

@section('content')
<!-- 
<div class="container">
    <div class="well">
        <div class="btn-group">
            <button type="button" class="btn btn-default tools" id="regi1">Marker</button>
            <button type="button" class="btn btn-default tools" id="regi2">Eraser</button>
            <button type="button" class="btn btn-default" id="regi3">Right</button>
        </div>
    </div>
</div>
 -->
<div class="well">
	<!-- tools button -->
	<div class="btn-group" role="group" aria-label="...">
		<button type="button" class="active btn btn-default tools" id="marker">Marker</button>
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
		<button type="button" class="btn btn-default colors" id="#00FFFF">Aqua</button>
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
<!-- 
	<ul class="demoToolList">
    	<li>Clear the canvas: 
    		<button onclick="resetCanvas()" type="button">Clear</button>
    		<a id="dl" download="Canvas.png" href="#">
    		<button onclick="dlCanvas()" type="button">Download</button></a>
    		<button onclick="alert(clickDrag)" type="button">clickX</button>
    		<button onclick="loadArray()" type="button">Load array</button>
    	</li>
    	<li>Choose a color: 
    		<button onclick="curColor = colorPurple" type="button">ม่วง</button>
    		<button onclick="curColor = colorGreen" type="button">เขียว</button>
    		<button onclick="curColor = colorYellow" type="button">เหลือง</button>
    		<button onclick="curColor = colorBrown" type="button">น้ำตาล</button>
    		<button onclick="curColor = colorRed" type="button">แดง</button>
    	</li>
        <li>Choose a size: 
        	<button onclick="curSize = 'small'" type="button">Small</button>
        	<button onclick="curSize = 'normal'" type="button">Normal</button>
        	<button onclick="curSize = 'large'" type="button">Large</button>
        	<button onclick="curSize = 'huge'" type="button">Huge</button>
        </li>
        <li>Choose a tool: 
        	<button id="chooseCrayonSimpleOutline" type="button">Crayon</button>
        	<button onclick="curTool = 'marker'" id="chooseMarkerSimpleOutline" type="button">Marker</button>
        	<button onclick="curTool = 'eraser'" id="chooseEraserSimpleOutline" type="button">Eraser</button>
        </li>
    </ul>
     -->
    <div id="canvasDiv"></div>
    <script type="text/javascript"> 
    	$(document).ready(function() {
    		createCanvas();
    	});
    </script>
    <script type="text/javascript">
    	// variables
    	var canvasWidth =  540;
	    var canvasHeight = 720;
	    var colorPurple = "#00FFFF";
		var colorGreen = "#006600";
		var colorYellow = "#000000";
		var colorBrown = "#00FFFF";
		var colorRed = "#FF0000";
		var colorWhite = "white";
		var radius = 5;
		var curColor = colorRed;
		var clickColor = new Array();
		var clickX = new Array();
		var clickY = new Array();
		var clickDrag = new Array();
		var paint = false;
		var clickSize = new Array();
		var curSize = "normal";
		var canvas;
		var context;
		var clickTool = new Array();
		var curTool = "marker";
		var outlineImage = new Image();

		function createCanvas(){
		    var canvasDiv = document.getElementById('canvasDiv');

		    // create canvas
			canvas = document.createElement('canvas');
			canvas.setAttribute('width', canvasWidth);
			canvas.setAttribute('height', canvasHeight);
			canvas.setAttribute('id', 'canvas');
			canvas.style.border = "solid";
			canvasDiv.appendChild(canvas);
			if(typeof G_vmlCanvasManager != 'undefined') {
				canvas = G_vmlCanvasManager.initElement(canvas);
			}
			context = canvas.getContext("2d");

			// load outline image
			outlineImage.src = window.location.origin + "/assets/images/frontdermatome.png";
			if (outlineImage.complete) {
				drawFit();
			} else {
			    outlineImage.onload = function () {
			        drawFit();
			    };
			}

			// add mousedown event
			$('#canvas').mousedown(function(e){
				var mouseX = e.pageX - this.offsetLeft;
				var mouseY = e.pageY - this.offsetTop;
					
				paint = true;
				addClick(e.pageX - this.offsetLeft, e.pageY - this.offsetTop);
				redraw();
			});

			// add mousemove event
			$('#canvas').mousemove(function(e){
				if(paint){
					addClick(e.pageX - this.offsetLeft, e.pageY - this.offsetTop, true);
					redraw();
				}
			});

			// add mouseup event
			$('#canvas').mouseup(function(e){
			 	paint = false;
			});

			// add mouseleave event
			$('#canvas').mouseleave(function(e){
	  			paint = false;
			});
		}

		// draw outline image fit to canvas
		function drawFit(){
			context.drawImage(outlineImage, 0, 0, outlineImage.width, outlineImage.height, 0, 0, canvas.width, canvas.height);	
		}

		// reset canvas
		function resetCanvas(){
			// clear canvas
    		context.clearRect(0,0,canvas.width,canvas.height);
    		canvas.width = canvas.width;
    
		    // clear data arrays
		    clickX = new Array();
		    clickY = new Array();
		    clickDrag = new Array();
		    clickColor = new Array();
		    clickSize = new Array();

		    drawFit();
		}

		function dlCanvas() {
			var dt = canvas.toDataURL('image/png');
			/* Change MIME type to trick the browser to downlaod the file instead of displaying it */
			dt = dt.replace(/^data:image\/[^;]*/, 'data:application/octet-stream');

			/* In addition to <a>'s "download" attribute, you can define HTTP-style headers */
			dt = dt.replace(/^data:application\/octet-stream/, 'data:application/octet-stream;headers=Content-Disposition%3A%20attachment%3B%20filename=Canvas.png');

			this.href = dt;
		};
		document.getElementById("dl").addEventListener('click', dlCanvas, false);

		function addClick(x, y, dragging){
			clickX.push(x);
			clickY.push(y);
			clickDrag.push(dragging);

			if(curTool == "eraser"){
				clickColor.push("white");
			}else{
				clickColor.push(curColor);
			}
			clickSize.push(curSize);
		}
		
		// Clears the canvas
		function clearCanvas(){
			context.clearRect(0, 0, canvasWidth, canvasHeight);
		}	
		
		function redraw(){
  			
  			clearCanvas();
			context.lineJoin = "round";
					
			for(var i=0; i < clickX.length; i++) {		
				context.beginPath();

				if(clickSize[i] == "small"){
					radius = 2;
				}else if(clickSize[i] == "normal"){
					radius = 5;
				}else if(clickSize[i] == "large"){
					radius = 10;
				}else if(clickSize[i] == "huge"){
					radius = 20;
				}else{
					alert("Error: Radius is zero for click " + i);
					radius = 0;	
				}

				if(clickDrag[i] && i){
					context.moveTo(clickX[i-1], clickY[i-1]);
				}else{
					context.moveTo(clickX[i]-1, clickY[i]);
				}

				context.lineTo(clickX[i], clickY[i]);
				context.closePath();
				context.strokeStyle = clickColor[i];
				context.lineWidth = radius;
				context.stroke();

			}
			drawFit();
		}

		function loadArray(){

			//$('#arrX').val(clickX);
			trans_dat = new Array();
			var tmp = "";
			jQuery.each( clickX, function( i, val ) {
				tmp += String.fromCharCode(val); //use String.fromCharCode(x) to decode  another way is Base64.fromNumber(val);
			});
			$('#arrX').val(tmp); //$('#arrY').val(trans_dat);
			//$('#arrY').val(clickY);

			//compact Y array
			trans_dat = new Array();
			var tmp = "";
			jQuery.each( clickY, function( i, val ) {
				tmp += String.fromCharCode(val); //Base64.fromNumber(val);
			});
			$('#arrY').val(tmp); //$('#arrY').val(trans_dat);

			//compact drag array
			trans_dat = new Array();
			jQuery.each( clickDrag, function( i, val ) {
				//$( "#" + val ).text( "Mine is " + val + "." );
					if (val) {
						trans_dat[i] = 1;
					} else {
						trans_dat[i] = 0;
					}
			});
			$('#arrD').val(trans_dat);

			//compact color array
			trans_dat = new Array();
			jQuery.each( clickColor, function( i, val ) {
				switch (val) {
					case colorPurple:
						trans_dat[i] = 1;
						break;
					case colorBrown:
						trans_dat[i] = 4;
						break;
					case colorYellow:
						trans_dat[i] = 3;
						break;
					case colorGreen:
						trans_dat[i] = 2;
						break;
					case colorRed:
						trans_dat[i] = 5;
						break;
					case colorWhite:
						trans_dat[i] = 0;
						break;
				}
			});
			$('#arrC').val(trans_dat);

			//compact size array
			trans_dat = new Array();
			jQuery.each( clickSize, function( i, val ) {
				switch (val) {
					case 'small':
						trans_dat[i] = 1;
						break;
					case 'huge':
						trans_dat[i] = 4;
						break;
					case 'large':
						trans_dat[i] = 3;
						break;
					case 'normal':
						trans_dat[i] = 2;
						break;
				}
			});
			$('#arrS').val(trans_dat);
		}

		Base64 = {

		    _Rixits :
		//   0       8       16      24      32      40      48      56     63
		//   v       v       v       v       v       v       v       v      v
		    "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz+/",
		    // You have the freedom, here, to choose the glyphs you want for 
		    // representing your base-64 numbers. The ASCII encoding guys usually
		    // choose a set of glyphs beginning with ABCD..., but, looking at
		    // your update #2, I deduce that you want glyphs beginning with 
		    // 0123..., which is a fine choice and aligns the first ten numbers
		    // in base 64 with the first ten numbers in decimal.

		    // This cannot handle negative numbers and only works on the 
		    //     integer part, discarding the fractional part.
		    // Doing better means deciding on whether you're just representing
		    // the subset of javascript numbers of twos-complement 32-bit integers 
		    // or going with base-64 representations for the bit pattern of the
		    // underlying IEEE floating-point number, or representing the mantissae
		    // and exponents separately, or some other possibility. For now, bail
		    fromNumber : function(number) {
		        if (isNaN(Number(number)) || number === null ||
		            number === Number.POSITIVE_INFINITY)
		            throw "The input is not valid";
		        if (number < 0)
		            throw "Can't represent negative numbers now";

		        var rixit; // like 'digit', only in some non-decimal radix 
		        var residual = Math.floor(number);
		        var result = '';
		        while (true) {
		            rixit = residual % 64
		            // console.log("rixit : " + rixit);
		            // console.log("result before : " + result);
		            result = this._Rixits.charAt(rixit) + result;
		            // console.log("result after : " + result);
		            // console.log("residual before : " + residual);
		            residual = Math.floor(residual / 64);
		            // console.log("residual after : " + residual);

		            if (residual == 0)
		                break;
		            }
		        return result;
		    },

		    toNumber : function(rixits) {
		        var result = 0;
		        // console.log("rixits : " + rixits);
		        // console.log("rixits.split('') : " + rixits.split(''));
		        rixits = rixits.split('');
		        for (e in rixits) {
		            // console.log("_Rixits.indexOf(" + rixits[e] + ") : " + 
		                // this._Rixits.indexOf(rixits[e]));
		            // console.log("result before : " + result);
		            result = (result * 64) + this._Rixits.indexOf(rixits[e]);
		            // console.log("result after : " + result);
		        }
		        return result;
		    }
		}
    </script>
    {!! Form::open(['url' => '/']) !!}
    {!! Form::hidden('x',null,['id' => 'arrX']) !!}
    {!! Form::hidden('y',null,['id' => 'arrY']) !!}
    {!! Form::hidden('d',null,['id' => 'arrD']) !!}
    {!! Form::hidden('c',null,['id' => 'arrC']) !!}
    {!! Form::hidden('s',null,['id' => 'arrS']) !!}
    {!! Form::submit('Add Patient',['class' => 'btn btn-primary form-control']) !!}
@endsection