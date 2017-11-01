<!DOCTYPE html>
<html>
<head>
	<title></title>
	<!-- Fabric -->
	<script src="{{ url('/assets/script/fabric.js') }}"></script>
</head>
<body>
	{{-- <div>
		<canvas id="c" width="600" height="1200" style="border: 2px solid; border-radius: 5px;"></canvas>
		<input type="button" value="Some button" id="inline-btn" style="position:absolute; left: 200 px; top: 200 px;">
	</div> --}}
	{{-- <div>
		<canvas id="box" width="200" height="300" 
		style="position: absolute; top:0; left:0; border:3px solid black;"></canvas>
		<input type="text" style="position: absolute; top:200px; left:20px; width: 10px" onclick="myFunction()" value="Click">
	</div> --}}

	<div id="bd-wrapper" ng-controller="CanvasControls">
		<canvas id="c" width="500" height="500"></canvas>

		<input type="text" value="50" id="inline-btn" style="position:absolute; width: 20px">

		<script>
			var canvas = this.__canvas = new fabric.Canvas('c');
			canvas.backgroundColor = 'rgb(251,253,227)';
			fabric.Object.prototype.transparentCorners = false;
			fabric.Object.prototype.originX = fabric.Object.prototype.originY = 'center';

			fabric.Canvas.prototype.getAbsoluteCoords = function(object) {
				return {
					left: object.left + this._offset.left,
					top: object.top + this._offset.top
				};
			}

			var btn = document.getElementById('inline-btn'),
			btnWidth = 20,
			btnHeight = 18;

			function positionBtn(obj) {
				var absCoords = canvas.getAbsoluteCoords(obj);

				btn.style.left = (absCoords.left - btnWidth / 2) + 'px';
				btn.style.top = (absCoords.top - btnHeight / 2) + 'px';
			}

			
			var rect = new fabric.Rect({
				left: 100,
				top: 100,
				fill: 'red',
				width: 150,
				height: 150
			});

			canvas.add(rect);

			positionBtn(rect);


			// fabric.Image.fromURL('http://i380.photobucket.com/albums/oo250/Marlissa_Cakes/pug.jpg', function(img) {

			// canvas.add(img.set({ left: 250, top: 250, angle: 30 }).scale(0.25));

			// 	img.on('moving', function() { positionBtn(img) });
				
			// 	positionBtn(img);
			// });
		
		</script>

	</div>
</body>
{{-- 
<script type="text/javascript">
	var canvas = new fabric.Canvas('c');
	// canvas.backgroundColor = 'rgba(251,253,227, 1)';
	canvas.renderAll();

	var btn = document.getElementById('inline-btn');
  var btnWidth = 85;
  var btnHeight = 18;

  // btn.style.left = '200 px';
  // btn.style.top = '200 px';
</script>
 --}}
</html>