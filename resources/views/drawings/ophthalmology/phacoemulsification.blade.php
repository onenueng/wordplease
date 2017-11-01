<div class="col-md-12 col-sm-4" style="padding: 2px 1px 2px 1px">
	<span class="fa fa-ellipsis-v"></span>
	<div class="btn-group" role="group">
		<button class="btn btn-default btn-xs side-select" role="button">Right</button>
		<button class="btn btn-default btn-xs side-select" role="button">Left</button>
		<button class="btn btn-default btn-xs side-select" role="button">Both</button>
	</div>
	<script type="text/javascript">
		$('.side-select').click(function() {
			// Handle style.
			$('.side-select').removeClass('active');
			$('.side-select').removeClass('btn-success');
			$('.side-select').addClass('btn-default');
			$(this).addClass('active');
			$(this).removeClass('btn-default');
			$(this).addClass('btn-success');

			var filePath; // Select overlay image file path.
			switch($(this).text()) {
				case 'Right':
					filePath = '/assets/images/drawings/ophthalmology/operation_phacoemulsification_P4.svg';
					break;
				case 'Left':
					filePath = '/assets/images/drawings/ophthalmology/operation_phacoemulsification_P4.svg';
					break;
				case 'Both':
					filePath = '/assets/images/drawings/ophthalmology/operation_phacoemulsification_Both_P6.svg';
					break;
			}
			clearCanvas();
			if ($(this).text() != 'Both') { // Case single eye-side selected.
				var tag = new fabric.Text($(this).text(), {
					fontSize: 30,
					textDecoration: 'underline',
					top: canvas.height * 0.25,
					left: canvas.width * 0.25
				})
				canvas.add(tag); // Add eye-side label.

				if ($(this).text() == 'Right') { // Handle appropriate tool.
					$('#template_tool_right').collapse('show');
					$('#template_tool_left').collapse('hide');
				} else {
					$('#template_tool_right').collapse('hide');
					$('#template_tool_left').collapse('show');
				}
			} else { // Case both eye-side
				var tag = new fabric.Text('Right', { // Add both eye-side label.
					fontSize: 30,
					textDecoration: 'underline',
					top: canvas.height * 0.25
				})
				tag.left = canvas.width * 0.25 - tag.width;
				canvas.add(tag);
				tag = new fabric.Text('Left', {
					fontSize: 30,
					textDecoration: 'underline',
					top: canvas.height * 0.25,
					left: canvas.width * 0.75
				})
				canvas.add(tag);

				$('#template_tool_right').collapse('show'); // Show all tools.
				$('#template_tool_left').collapse('show');
			}
			setCanvasOverlayImage(filePath, 0.6); // Apply overlay.
			rightClickCount = 1; // Reset counter due to clear canvas.
			leftClickCount = 1;
		});
	</script>
</div>

<div class="col-sm-2 collapse" id="template_tool_right" style="padding: 2px 1px 2px 1px">
	<span class="fa fa-ellipsis-v"></span>
	<div class="btn btn-default add_template btn-xs" side="right" role="button" id="add_template_right"><span class="fa fa-star-half-o"></span></div>
</div>
<div class="col-sm-2 collapse" id="template_tool_left" style="padding: 2px 1px 2px 1px">
	<span class="fa fa-ellipsis-v"></span>
	<div class="btn btn-default add_template btn-xs" side="left" role="button" id="add_template_left"><span class="fa fa-star-half-o fa-flip-horizontal"></span></div>
</div>
<script type="text/javascript">
	$('.add_template').click(function() {
		if ($('.side-select.active').text() != '') { // Make sure that there is eye-side selected.
			var indexOffset = ($('.side-select.active').text() == 'Both') ? 4 : 0;
			var longCutTop = ($(this).attr('side') == 'right') ? longCutRightTop[rightClickCount+indexOffset] : longCutLeftTop[leftClickCount+indexOffset];
			var longCutLeft = ($(this).attr('side') == 'right') ? longCutRightLeft[rightClickCount+indexOffset] : longCutLeftLeft[leftClickCount+indexOffset];

			var shortCutTop = ($(this).attr('side') == 'right') ? shortCutRightTop[rightClickCount+indexOffset] : shortCutLeftTop[leftClickCount+indexOffset];
			var shortCutLeft = ($(this).attr('side') == 'right') ? shortCutRightLeft[rightClickCount+indexOffset] : shortCutLeftLeft[leftClickCount+indexOffset];
		
			if (!getCanvasObjByName(($(this).attr('side') == 'right') ? 'longCutRight' : 'longCutLeft')) {
				var line = new fabric.Line([0,0,0,100], {
					name: ($(this).attr('side') == 'right') ? 'longCutRight' : 'longCutLeft',
					stroke: 'black',
					strokeWidth: 1,
					top: 0,
					left: longCutLeft
				});
				canvas.add(line);
				line.animate('top', longCutTop, {
					onChange: canvas.renderAll.bind(canvas),
					duration: 380,
					easing: fabric.util.ease.easeOutExpo
				});
			} else {
				var line = getCanvasObjByName(($(this).attr('side') == 'right') ? 'longCutRight' : 'longCutLeft');
				line.animate('left', longCutLeft, {
					onChange: canvas.renderAll.bind(canvas),
					duration: 380,
					easing: fabric.util.ease.easeOutExpo
				});
			}
			if (!getCanvasObjByName(($(this).attr('side') == 'right') ? 'shortCutRight' : 'shortCutLeft')) {
				var line = new fabric.Line([0,0,50,0], {
					name: ($(this).attr('side') == 'right') ? 'shortCutRight' : 'shortCutLeft',
					stroke: 'black',
					strokeWidth: 1,
					top: shortCutTop,
					left: 0
				});
				canvas.add(line);
				line.animate('left', shortCutLeft, {
					onChange: canvas.renderAll.bind(canvas),
					duration: 380,
					easing: fabric.util.ease.easeOutExpo
				});
			} else {
				var line = getCanvasObjByName(($(this).attr('side') == 'right') ? 'shortCutRight' : 'shortCutLeft');
				line.animate('top', shortCutTop, {
					onChange: canvas.renderAll.bind(canvas),
					duration: 380,
					easing: fabric.util.ease.easeOutExpo
				});
			}
			if ($(this).attr('side') == 'right')
				rightClickCount = (++rightClickCount > 4) ? 1 : rightClickCount++;
			else
				leftClickCount = (++leftClickCount > 4) ? 1 : leftClickCount++;
		}
	});
</script>
<script type="text/javascript">
	var rightClickCount = 1;
	var longCutRightTop = [0, 274, 274, 274, 274, 262, 262, 262, 262];
	var longCutRightLeft = [0, 258, 258, 441, 441, 180, 180, 295, 295];
	var shortCutRightTop = [0, 415, 232, 232, 415, 376, 247, 247, 376];
	var shortCutRightLeft = [0, 328, 328, 328, 328, 213, 213, 213, 213];

	var leftClickCount = 1;
	var longCutLeftTop = [0, 274, 274, 274, 274, 266, 266, 266, 266];
	var longCutLeftLeft = [0, 258, 258, 441, 441, 384, 384, 501, 501];
	var shortCutLeftTop = [0, 415, 232, 232, 415, 382, 250, 250, 382];
	var shortCutLeftLeft = [0, 328, 328, 328, 328, 421, 421, 421, 421];
	
	function initCanvas() {
		canvas.renderAll();
		canvas.isDrawingMode = true;
		canvas.freeDrawingBrush.color = 'black';
		canvas.freeDrawingBrush.width = 1;
	}
</script>