<script type="text/javascript">
// //////////////////////////////////////////////////
// //												//
// //     WordPaint start here						//
// //												//
// //												//
// //////////////////////////////////////////////////
// /*
// * shared variables for drawing
// *
// *
// *
// */
// var colorPurple = "#00FFFF"; //common
// var colorGreen = "#006600"; //common
// var colorYellow = "#000000"; //common
// var colorBrown = "#00FFFF"; //common
// var colorRed = "#FF0000"; //common
// var colorWhite = "white"; //common
// var radius = 5; //common
// var curColor = colorRed; //common
// var curSize = "normal"; //common
// var curTool = "marker"; //common
// var Paint = false;

// /*
// * AddClick for drawing
// * @paras
// * x,y coordinators.
// * curCanvas WordPaint object.
// * dragging Does pointer drag or not.
// */
// function AddClick(x, y, curCanvas, dragging) {
// 	curCanvas.ClickX.push(x);
// 	curCanvas.ClickY.push(y);
// 	curCanvas.ClickDrag.push(dragging);

// 	if (curTool == "label")
// 		Addlabel(curCanvas);
// 	else 
// 		if(curTool == "eraser")
// 			curCanvas.ClickColor.push("white");
// 		else
// 			curCanvas.ClickColor.push(curColor);
	
// 	curCanvas.ClickSize.push(curSize);
// }

// /*
// * AddLabel for drawing
// * @paras
// * dragging Does pointer drag or not.
// * 
// */
// function Addlabel(curCanvas) {
// 	var str = prompt('Enter text :');
// 	if (str != '' && str != null) {
// 		curCanvas.ClickColor.push(curColor + '@' + str);
// 	} else
// 		curCanvas.ClickColor.push(curColor + '@ ');
// }

// /**
// * Redraw for drawing
// * @para
// * curCanvas WordPaint object.
// *
// */
// function Redraw(curCanvas) {
// 	//clear@nameCanvas();
// 	curCanvas.Context.clearRect(0, 0, curCanvas.CanvasWidth, curCanvas.CanvasHeight);

// 	curCanvas.Context.lineJoin = "round";
// 	var font_txt;
// 	var tmpClr;
// 	var lab_tmp;

// 	for(var i=0; i < curCanvas.ClickX.length; i++) {		
// 		curCanvas.Context.beginPath();
// 		// assign size
// 		if(curCanvas.ClickSize[i] == "small"){
// 			radius = 2;
// 			font_txt = 8 + "px tahoma";
// 		}else if(curCanvas.ClickSize[i] == "normal"){
// 			radius = 5;
// 			font_txt = 14 + "px tahoma";
// 		}else if(curCanvas.ClickSize[i] == "large"){
// 			radius = 10;
// 			font_txt = 25 + "px tahoma";
// 		}else if(curCanvas.ClickSize[i] == "huge"){
// 			radius = 20;
// 			font_txt = 40 + "px tahoma";
// 		}else{
// 			alert("Error: Radius is zero for click " + i);
// 			radius = 0;
// 			font_txt = 14 + "px tahoma";
// 		}

// 		tmpClr = curCanvas.ClickColor[i];
// 		if (tmpClr.search('@') > 0) { //label process
// 			lab_tmp = tmpClr.split('@');
// 			curCanvas.Context.fillStyle = lab_tmp[0];
// 			curCanvas.Context.font = font_txt;
// 			curCanvas.Context.fillText(lab_tmp[1], curCanvas.ClickX[i], curCanvas.ClickY[i]);
// 		}
// 		else { //drawing process
// 			if(curCanvas.ClickDrag[i] && i)
// 				curCanvas.Context.moveTo(curCanvas.ClickX[i-1], curCanvas.ClickY[i-1]);
// 			else 
// 				curCanvas.Context.moveTo(curCanvas.ClickX[i]-1, curCanvas.ClickY[i]);

// 			curCanvas.Context.lineTo(curCanvas.ClickX[i], curCanvas.ClickY[i]);
// 			curCanvas.Context.closePath();
// 			curCanvas.Context.strokeStyle = curCanvas.ClickColor[i];
// 			curCanvas.Context.lineWidth = radius;
// 			curCanvas.Context.stroke();
// 		}
// 	}
// 	curCanvas.DrawFit();
// }

// function WordPaint (canvasDivID,width,height,canvasID) {
// 	// class attributes
// 	this.CanvasWidth =  width; //individual
//     this.CanvasHeight = height; //individual
// 	this.ClickColor = new Array(); //individual
// 	this.ClickX = new Array(); //individual
// 	this.ClickY = new Array(); //individual
// 	this.ClickDrag = new Array(); //individual
// 	this.Paint = false; //individual
// 	this.ClickSize = new Array(); //individual
	
// 	this.canvasDivID = canvasDivID;
// 	this.canvasID = canvasID;
// 	this.Canvas; //individual
// 	this.Context; //individual
// 	this.OutlineImage = new Image(); //individual
// }

// WordPaint.prototype.createCanvas = function() {
//     var canvasDiv = document.getElementById(this.canvasDivID);

//     // create this.Canvas
// 	this.Canvas = document.createElement('canvas');
// 	this.Canvas.setAttribute('width', this.CanvasWidth);
// 	this.Canvas.setAttribute('height', this.CanvasHeight);
// 	this.Canvas.setAttribute('id', this.canvasID);
// 	this.Canvas.style.border = "solid";
// 	canvasDiv.appendChild(this.Canvas);
// 	if(typeof G_vmlCanvasManager != 'undefined') {
// 		this.Canvas = G_vmlCanvasManager.initElement(this.Canvas);
// 	}
// 	this.Context = this.Canvas.getContext("2d");

// 	// load outline image
// 	//console.log(window.location.origin + imgPath);
// 	//this.OutlineImage.src = window.location.origin + imgPath;
// 	this.OutlineImage.src = "{{ url('/assets/images/frontdermatome.png') }}";
// 	if (this.OutlineImage.complete) {
// 		//alert('complete');
// 		this.DrawFit();
// 	} else {
// 			console.log('incomplete');
// 	    	this.OutlineImage.onload = function() {
// 	        newPaint.DrawFit();
// 	    };
// 	}

// 	// add mouseup event
// 	$('#' + this.canvasID).mouseup(function(e){
// 	 	Paint = false;
// 	});

// 	// add mouseleave event
// 	$('#' + this.canvasID).mouseleave(function(e){
// 		Paint = false;
// 	});
// }

// WordPaint.prototype.DrawFit = function() {
// 	this.Context.drawImage(this.OutlineImage, 0, 0, this.OutlineImage.width, this.OutlineImage.height, 0, 0, this.Canvas.width, this.Canvas.height);
// }

// WordPaint.prototype.resetCanvas = function() {
// 	// clear canvas
// 	this.Context.clearRect(0,0,this.Canvas.width,this.Canvas.height);
// 	this.Canvas.width = this.Canvas.width;

//     // clear data arrays
//     this.ClickX = new Array();
//     this.ClickY = new Array();
//     this.ClickDrag = new Array();
//     this.ClickColor = new Array();
//     this.ClickSize = new Array();

//     // draw outline picture
//     this.DrawFit();
// }
// //////////////////////////////////////////////////
// //												//
// //     WordPaint end here						//
// //												//
// //												//
// //////////////////////////////////////////////////

//////////////////////////////////////////////////
//												//
//     Template generator start here			//
//												//
//												//
//////////////////////////////////////////////////
var choices = [];
function selectChoice(classChoice, idChoice){
 	$(classChoice).removeClass("active");
 	$(idChoice).addClass("active");
 	choices[classChoice] = $(idChoice).prop("textContent");
}

function genTemplate(className, maxChoice, inputID, genID){
	var genStr;
	var i;
	genStr = "";
	for (i = 1 ; i <= maxChoice ; i++) {
		//console.log(className + i);
		var tmp = choices[className + i];
		if (typeof tmp != 'undefined') {
			genStr += tmp + ', '; 
		}
	}
	if (genStr != "") {
		genStr = genStr.substr(0, genStr.length-2);
		//var tmp = "abc"
		console.log(genStr);
		genStr = genStr.replace(/, , /g,', ');
		//tmp.replace(/b/g,'2');
		//console.log(genStr);
		toggleTemplate(genID);
		$(inputID).val(genStr);
		autosize.update($(inputID));
		$(inputID).focus();
	}
}

function toggleTemplate(genID) {
	$(genID).collapse('toggle');
}
//////////////////////////////////////////////////
//												//
//     Template generator end here			    //
//												//
//												//
//////////////////////////////////////////////////
</script>