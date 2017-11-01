
<!-- Interact Mode -->
<span class="fa fa-ellipsis-v"></span>
<div class="btn-group" role="group">
	<button type="button" class="btn btn-success btn-xs active mode-btn" id="paint_mode"><span class="fa fa-paint-brush"></span></button>	
	<button type="button" class="btn btn-default btn-xs mode-btn" id="select_mode"><span class="fa fa-hand-grab-o"></span></button>
</div>
<span class="fa fa-ellipsis-v"></span>
<div class="btn btn-default btn-xs" id="toggle_arrows" status="off"><span class="fa fa-arrows"></span></div>
<script type="text/javascript">
	$('.mode-btn').click(function() {
		$('.mode-btn').removeClass('active');
		$('.mode-btn').removeClass('btn-success');
		$('.mode-btn').addClass('btn-default');
		$(this).addClass('active');
		$(this).removeClass('btn-default');
		$(this).addClass('btn-success');
		$(this).focusout();
	});
	$('#paint_mode').click(function() {
		canvas.isDrawingMode = true;
		$('#arrow-btns').collapse('hide');
		deselectFabric(); // function on drawing.blade.php.
	});
	$('#select_mode').click(function() {
		canvas.isDrawingMode = false;
	});
	$('#toggle_arrows').click(function() {
		if (!canvas.isDrawingMode) {
			if ($(this).attr('status') == 'off') {
				$('#arrow-btns').collapse('show');
				$(this).attr('status', 'on');
			} else {
				$('#arrow-btns').collapse('hide');
				$(this).attr('status', 'off');
			}
		}
	});
</script><!-- Interact Mode -->

<span class="fa fa-ellipsis-v"></span><!-- Basic tools -->
<div class="btn btn-default btn-xs" id="add_arrow"><span class="fa fa-long-arrow-left"></span></div>
<div class="btn btn-default btn-xs" id="add_line"><span class="fa fa-minus"></span></div>
<div class="btn btn-default btn-xs" id="add_arc"><span>&cap;</span></div>
<script type="text/javascript">
	$('#add_arrow').click(function() {
		var triangle = new fabric.Triangle({
		  left: canvasWidth,
		  top: canvasHeight/2,
		  width: 10,
		  height: 10,
		  fill: 'black',
		  angle: -90
		});
		var line = new fabric.Line([10, 10, 100, 10], {
			left: canvasWidth + triangle.width,
			top: canvasHeight/2 - triangle.width/2 - 1,
			stroke: 'black',
			strokeWidth: 1
		});
		var arrow = new fabric.Group([line, triangle]);
		animateAddingObject(arrow); // function on drawing.blade.php.
		$('#select_mode').click();
	});

	$('#add_line').click(function() {
		var line = new fabric.Line([10, 10, 100, 10], {
			left: canvasWidth,
			top: canvasHeight/2,
			stroke: 'black',
			strokeWidth: 1
		});
		animateAddingObject(line); // function on drawing.blade.php.
		$('#select_mode').click();
	});
	
	$('#add_arc').click(function() {
		var circle = new fabric.Circle({
			radius: 20,
			left: canvasWidth,
			top: canvasHeight/2,
			startAngle: 0,
			endAngle: Math.PI,
			stroke: '#000',
			strokeWidth: 1,
			fill: ''
		});
		animateAddingObject(circle); // function on drawing.blade.php.
		$('#select_mode').click();
	});
</script><!-- Basic tools -->