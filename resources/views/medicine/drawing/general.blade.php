@extends('medicine.form')

@section('script')
    <script type="text/javascript">
    	// variables
    	// var canvasWidth =  540; //common
	    // var canvasHeight = 720; //common
	    var canvasWidth =  600; //common
	    var canvasHeight = 600; //common
	    var colorPurple = "#00FFFF"; //common
		var colorGreen = "#006600"; //common
		var colorYellow = "#000000"; //common
		var colorBrown = "#00FFFF"; //common
		var colorRed = "#FF0000"; //common
		var colorWhite = "white"; //common
		var radius = 5; //common
		var curColor = colorRed; //common
		var clickColor = new Array(); //individual
		var clickX = new Array(); //individual
		var clickY = new Array(); //individual
		var clickDrag = new Array(); //individual
		var paint = false; //individual
		var clickSize = new Array(); //individual
		var curSize = "normal"; //individual
		var canvas; //individual
		var context; //individual
		//var clickTool = new Array(); //individual
		var curTool = "marker"; //individual
		var outlineImage = new Image(); //individual

		var labX = new Array(); //individual
		var labY = new Array(); //individual
		var labTxt = new Array(); //individual
		var labColor = new Array(); //individual
		var labSize = new Array(); //individual
		var tmpX; //common
		var tmpY; //common
		var fontSize = 14; //common

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
			//outlineImage.src = window.location.origin + "/assets/images/frontdermatome.png";
			// outlineImage.src = "{{ url('/assets/images/frontdermatome.png') }}";
			outlineImage.src = "{{ url(session('outline_img_src')) }}";
			if (outlineImage.complete) {
				//alert('complete');
				drawFit();
			} else {
				//alert('incomplete');
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

		    labX = new Array();
		    labY = new Array();
		    labTxt = new Array();
		    labColor = new Array();
		    labSize = new Array();

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
			if (curTool == "label") {
				if (!dragging) {
					tmpX = x;
					tmpY = y;
					addlabel();
				}
			} else {
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
		}
		
		// Clears the canvas
		function clearCanvas(){
			context.clearRect(0, 0, canvasWidth, canvasHeight);
		}	
		
		// function reFillLabel(){
		// 	context.fillStyle = '#fff';
		// 	context.font = '14px tahoma';
		// 	for(var i=0; i < labX.length; i++) {
		// 		context.fillText(labTxt[i], labX[i], labY[i]);
		// 		//console.log(labTxt[i]);
		// 		console.log(labTxt[i] + ' x:' + labX[i] + ' y:' + labY[i]);
		// 	}
		// }

		function addlabel() {
			var str = prompt('Enter text :');
			if (str != '' && str != null) {
				context.fillStyle = curColor;

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

				context.font = fontSize + "px tahoma";
				// context.font = '14px tahoma';
				context.fillText(str, tmpX, tmpY);
				labX.push(tmpX);
				labY.push(tmpY);
				labColor.push(curColor);
				labSize.push(fontSize);
				labTxt.push(str);
			}
		}

		function redraw(){
  			
  			clearCanvas();

			context.lineJoin = "round";
			
			for(var i=0; i < labTxt.length; i++) {
				context.fillStyle = labColor[i];

				context.font = labSize[i] + "px tahoma";
				// context.font = '14px tahoma';
				
				context.fillText(labTxt[i], labX[i], labY[i]);
				// console.log(labTxt[i] + ' x:' + labX[i] + ' y:' + labY[i]);
			}

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
    <style type="text/css">
	.btn-group{
	    margin-top:2px;
	    margin-bottom:2px;
	    margin-right: 2px;
	    margin-left: 2px;
	    border-radius:5px;
	}
</style>
@endsection
@section('content')
<div class="well">
	<!-- tools button -->
	<button onclick="resetCanvas()" type="button" class="btn btn-danger">Reset</button>
	<div class="btn-group" role="group" aria-label="...">
		<button type="button" class="active btn btn-default tools" name="marker">Marker</button>
		<button type="button" class="btn btn-default tools" name="label">Label</button>
		<button type="button" class="btn btn-default tools" name="eraser">Eraser</button>
	</div>

	<!-- tool script -->
	<script type="text/javascript">
		 $(".tools").click(function(){
		 	$(".tools").removeClass("active");
		 	$(this).addClass("active");
		 	curTool = $(this).attr('name');
		});
	</script>

	<!-- color button -->
	<div class="btn-group" role="group" aria-label="...">
		<button type="button" class="active btn btn-default colors" name ="#FF0000">Red</button>
		<button type="button" class="btn btn-default colors" name ="#00FFFF">Blue</button>
		<button type="button" class="btn btn-default colors" name ="#006600">Green</button>
		<button type="button" class="btn btn-default colors" name ="#000000">Black</button>
	</div>

	<!-- color script -->
	<script type="text/javascript">
	 	$(".colors").click(function(){
		 	$(".colors").removeClass("active");
		 	$(this).addClass("active");
		 	//alert($(this).attr('name'));
		 	curColor = $(this).prop('name');

		});
	</script>

	<!-- brush size -->
	<div class="btn-group" role="group" aria-label="...">
		<button type="button" class="btn btn-default brushSize" name="small">Small</button>
		<button type="button" class="active btn btn-default brushSize" name="normal">Normal</button>
		<button type="button" class="btn btn-default brushSize" name="large">Large</button>
		<button type="button" class="btn btn-default brushSize" name="huge">Huge</button>
	</div>
	
	<!-- brush size script -->
	<script type="text/javascript">
	 	$(".brushSize").click(function(){
		 	$(".brushSize").removeClass("active");
		 	$(this).addClass("active");
		 	curSize = $(this).attr('name');
		});
	</script>

	<!-- <button onclick="alert(canvas.toDataURL())" type="button" class="btn btn-danger">Data</button> -->
	<button onclick="window.history.back()" type="button" class="btn btn-primary">Save</button>

</div>

<div id="canvasDiv"></div>
<script type="text/javascript"> 
	$(document).ready(function() {
		createCanvas();
		$('#canvas').css('background-color','white')
	});
</script>

@endsection