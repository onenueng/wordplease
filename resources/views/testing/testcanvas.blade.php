<html>
<head>
	<title>Test CANVAS</title>
</head>
<body>
	<div>
		<canvas id="sig-canvas" width="320" height="160"></canvas>
	</div>
	<script type="text/javascript">
		// Set up the canvas
		var canvas = document.getElementById("sig-canvas");
		var ctx = canvas.getContext("2d");
		ctx.strokeStyle = "#222222";
		ctx.lineWith = 2;

		// Set up mouse events for drawing
		var drawing = false;
		var mousePos = { x:0, y:0 };
		var lastPos = mousePos;
		canvas.addEventListener("mousedown", function (e) {
		        drawing = true;
		  lastPos = getMousePos(canvas, e);
		}, false);
		canvas.addEventListener("mouseup", function (e) {
		  drawing = false;
		}, false);
		canvas.addEventListener("mousemove", function (e) {
		  mousePos = getMousePos(canvas, e);
		}, false);

		// Get the position of the mouse relative to the canvas
		function getMousePos(canvasDom, mouseEvent) {
		  var rect = canvasDom.getBoundingClientRect();
		  return {
		    x: mouseEvent.clientX - rect.left,
		    y: mouseEvent.clientY - rect.top
		  };
		}

		// Get a regular interval for drawing to the screen
		window.requestAnimFrame = (function (callback) {
		        return window.requestAnimationFrame || 
		           window.webkitRequestAnimationFrame ||
		           window.mozRequestAnimationFrame ||
		           window.oRequestAnimationFrame ||
		           window.msRequestAnimaitonFrame ||
		           function (callback) {
		        window.setTimeout(callback, 1000/60);
		           };
		})();

		// Draw to the canvas
		function renderCanvas() {
		  if (drawing) {
		    ctx.moveTo(lastPos.x, lastPos.y);
		    ctx.lineTo(mousePos.x, mousePos.y);
		    ctx.stroke();
		    lastPos = mousePos;
		  }
		}

		// Allow for animation
		(function drawLoop () {
		  requestAnimFrame(drawLoop);
		  renderCanvas();
		})();
	</script>
</body>
</html>