@extends('drawings.drawing')
@section('canvas')
<div class="col-md-12 col-sm-4 extra-tools-div"><!-- OR type selection -->
	<div class="form-inline">
		<span class="fa fa-ellipsis-v"></span>
		<label class="label label-info">OR</label>
		<select name="operation_type">
			<option selected disabled hidden value=""></option>
			<option value="1" title="Intracapsular cataract extraction">ICCE</option>
			<option value="2" title="Extracapsular cataract extraction">ECCE</option>
			<option value="3" title="Phacoemulsification">Phacoemulsification</option>
			<option value="4">Other</option>
		</select>
		<script type="text/javascript">
			/**
			* Handle Operation Selection.
			* Add Label by opration type.
			**/
			$('select[name=operation_type]').change(function() {
				if ($(this).val() < 4) { // Case known operation name.
					$('#side_select_collapse').collapse('show'); // Show operation common tools.
					$('#implant_collapse').collapse('show');
					
					clearCanvas(); // Local clearCnavas().

					var operationLabelText = $('select[name=operation_type] option[value=' + $(this).val() + ']').attr('title');
					if (getCanvasObjByName('operationLabel')) {
						var tag = getCanvasObjByName('operationLabel');
						tag.text = operationLabelText;
						canvas.renderAll();
						tag.animate('left', (canvas.width/2) - (tag.width/2), {
							onChange: canvas.renderAll.bind(canvas),
							duration: 380,
							easing: fabric.util.ease.easeOutExpo
						})
					} else {
						var tag = new fabric.Text(operationLabelText, {
							name: 'operationLabel',
							fontSize: 20,
							textDecoration: 'underline',
							top: 45,
							left: canvas.width
						});
						canvas.add(tag)
						tag.animate('left', (canvas.width/2) - (tag.width/2), {
							onChange: canvas.renderAll.bind(canvas),
							duration: 380,
							easing: fabric.util.ease.easeOutExpo
						})
					}

					if ($(this).val() == 1 || $(this).val() == 2) { // Case ICCE/ECCE add stitchCountLabel and hide other tools.
						canvas.add(new fabric.Text('', {
							name: 'stitchCountLabel',
							top: 0,
							left: 0,
							fontSize: 40
						}));
						$('#template_tool_right').collapse('hide'); // Hide phaco operation tools.
						$('#template_tool_left').collapse('hide');
					} else { // Case phaco. Hide ICCE/ECCE tools.
						$('#right_stitch_collapse').collapse('hide');
						$('#left_stitch_collapse').collapse('hide');
					}
				} else { // case other operation.
					if (canvas.overlayImage) canvas.overlayImage.visible = false;
					canvas.clear();

					$('#side_select_collapse').collapse('show');
					
					$('#template_tool_right').collapse('hide'); // Hide phaco operation tools.
					$('#template_tool_left').collapse('hide');

					$('#right_stitch_collapse').collapse('hide'); // Hide ICCE/ECCE tools.
					$('#left_stitch_collapse').collapse('hide');

					$('#implant_collapse').collapse('hide');
					$('select[name=implant]').val('');
				}

				// Reset eye-side selection.
				$('.side-select').removeClass('active');
				$('.side-select').removeClass('btn-success');
				$('.side-select').addClass('btn-default');
			});
		</script>
	</div>
</div>
<div class="col-md-12 col-sm-4 collapse extra-tools-div" id="side_select_collapse"><!-- Eye-side selection -->
	<span class="fa fa-ellipsis-v"></span>
	<div class="btn-group" role="group">
		<button class="btn btn-default btn-xs side-select" role="button">Right</button>
		<button class="btn btn-default btn-xs side-select" role="button">Left</button>
		<button class="btn btn-default btn-xs side-select" role="button">Both</button>
	</div>
	<script type="text/javascript">// icce/ecce script. 
		$('.side-select').click(function() {
			$('.side-select').removeClass('active');
			$('.side-select').removeClass('btn-success');
			$('.side-select').addClass('btn-default');

			$(this).addClass('active');
			$(this).removeClass('btn-default');
			$(this).addClass('btn-success');

			var filePath;
			clearCanvas();
			if ($('select[name=operation_type]').val() < 3) { // icce/ecce script.
				switch($(this).text()) {
					case 'Right':
						filePath = '/assets/images/drawings/ophthalmology/operation_ECCE_ICCE_Right_C1.svg';
						break;
					case 'Left':
						filePath = '/assets/images/drawings/ophthalmology/operation_ECCE_ICCE_Left_C2.svg';
						break;
					case 'Both':
						filePath = '/assets/images/drawings/ophthalmology/operation_ECCE_ICCE_Both_C3.svg';
						break;
				}
				if ($(this).text() != 'Both') {
					var tag = new fabric.Text($(this).text(), {
						fontSize: 30,
						textDecoration: 'underline',
						top: canvas.height * 0.25,
						left: canvas.width * 0.25
					})
					canvas.add(tag);
					if ($(this).text() == 'Right') {
						$('#right_stitch_collapse').collapse('show');
						$('#left_stitch_collapse').collapse('hide');
					} else {
						$('#right_stitch_collapse').collapse('hide');
						$('#left_stitch_collapse').collapse('show');
					}
				} else {
					var tag = new fabric.Text('Right', {
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
					$('#right_stitch_collapse').collapse('show');
					$('#left_stitch_collapse').collapse('show');
				}
			} else { // phacoemulsification and other.
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
				if ($(this).text() != 'Both') { // Case single eye-side selected.
					var tag = new fabric.Text($(this).text(), {
							fontSize: 30,
							textDecoration: 'underline',
							top: canvas.height * 0.25,
							left: canvas.width * 0.25
						});
					canvas.add(tag); // Add eye-side label.
					if($('select[name=operation_type]').val() == 3) { // Just phacoemulsification.
						if ($(this).text() == 'Right') { // Handle appropriate tool.
							$('#template_tool_right').collapse('show');
							$('#template_tool_left').collapse('hide');
						} else {
							$('#template_tool_right').collapse('hide');
							$('#template_tool_left').collapse('show');
						}
					}
				} else { // Case both eye-side
					var tagRgiht = new fabric.Text('Right', { // Add both eye-side label.
						fontSize: 30,
						textDecoration: 'underline',
						top: canvas.height * 0.25
					})
					tagRgiht.left = canvas.width * 0.25 - tagRgiht.width;
					canvas.add(tagRgiht);
					
					var tagLeft = new fabric.Text('Left', {
						fontSize: 30,
						textDecoration: 'underline',
						top: canvas.height * 0.25,
						left: canvas.width * 0.75
					})
					canvas.add(tagLeft);

					if($('select[name=operation_type]').val() == 3) { // Just phacoemulsification.
						$('#template_tool_right').collapse('show'); // Show both-side template.
						$('#template_tool_left').collapse('show');
					}
				}
				if($('select[name=operation_type]').val() == 3) { // Just phacoemulsification.
					rightClickCount = 1; // Reset counter due to clear canvas.
					leftClickCount = 1;
				}
			} 
			setCanvasOverlayImage(filePath, 0.6); // Apply overlay.
		});
	</script>
</div>
<div class="col-md-12 col-sm-4 collapse extra-tools-div" id="implant_collapse">
	<div class="form-inline">
		<span class="fa fa-ellipsis-v"></span>
		<label class="label label-info">Implant</label>
		<select name="implant">
			<option selected disabled hidden value=""></option>
			<option value="0">None</option>
			<option value="1">&#265 P/C IOL </option>
			<option value="2">IOL in sulcus</option>
			<option value="3">&#349 IOL</option>
			<option value="4">scleral fixed IOL</option>
		</select>
	</div>
	<script type="text/javascript">
		$('select[name=implant]').change(function() {
			if ($(this).val() == 0) { // Remove label on case none implant.
				if (getCanvasObjByName('implantLabel'))
					canvas.remove(getCanvasObjByName('implantLabel'))	;
			} else { // Show or update impant label.
				var implantLabelText = $('select[name=implant] option[value=' + $(this).val() + ']').text();
				if (getCanvasObjByName('implantLabel')) {
					var tag = getCanvasObjByName('implantLabel');
					tag.text = implantLabelText;
					canvas.renderAll();
					tag.animate('left', (canvas.width/2) - (tag.width/2), {
						onChange: canvas.renderAll.bind(canvas),
						duration: 380,
						easing: fabric.util.ease.easeOutExpo
					})
				} else {
					var tag = new fabric.Text(implantLabelText, {
						name: 'implantLabel',
						fontSize: 15,
						// textDecoration: 'underline',
						fontStyle: 'italic',
						top: 80,
						left: canvas.width
					});
					canvas.add(tag)
					tag.animate('left', (canvas.width/2) - (tag.width/2), {
						onChange: canvas.renderAll.bind(canvas),
						duration: 380,
						easing: fabric.util.ease.easeOutExpo
					})
				}
			}
		});
	</script>
</div>

<div class="col-md-12 col-sm-4 collapse extra-tools-div" id="right_stitch_collapse">
	<div class="form-inline">
		<span class="fa fa-ellipsis-v"></span>
		<label class="label label-info">Rt.Stitch</label>
		<div class="form-group"><input type="range" class="stitch-slider" name="right_stitch" min="1" max="20" value="0"></div>
	</div>
</div>
<div class="col-md-12 col-sm-4 collapse extra-tools-div" id="left_stitch_collapse">
	<div class="form-inline">
		<span class="fa fa-ellipsis-v"></span>
		<label class="label label-info">Lt.Stitch</label>
		<div class="form-group"><input type="range" class="stitch-slider" name="left_stitch" min="1" max="20" value="0"></div>
	</div>
</div>
<script type="text/javascript">
	$('.stitch-slider').change(function() {
		drawStitch(parseInt($(this).val()), ($(this).prop('name') == 'right_stitch') ? 'right' : 'left');
	});
	$('.stitch-slider').on('input change',function () {
		getCanvasObjByName('stitchCountLabel').text = $(this).val();
		canvas.renderAll();
	});
</script>

<div class="col-sm-2 collapse extra-tools-div" id="template_tool_right">
	<span class="fa fa-ellipsis-v"></span>
	<div class="btn btn-default add_template btn-xs" side="right" role="button" id="add_template_right"><span class="fa fa-star-half-o"></span></div>
</div>
<div class="col-sm-2 collapse extra-tools-div" id="template_tool_left">
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
	var maintainObjects = [];
	var maintainList = ['operationLabel', 'implantLabel', 'stitchCountLabel'];

	//*****  ICCE/ECCE variables *****//
	var stitchCountLabel;
	var rightX1 = 277;
	var rightX2 = 431;
	var leftX1 = 285;
	var leftX2 = 442;
	var bothRightX1 = 166;
	var bothRightX2 = 299;
	var bothLeftX1 = 395;
	var bothLeftX2 = 529;
	var addStitchFlag = false;
	var stitches;
	var stitchCount = 0;

	var stitchesRight;
	var stitchRightCount = 0;
	var stitchRightFlag = false;

	var stitchesLeft;
	var stitchLeftCount = 0;
	var stitchLeftFlag = false;
	//*****  ICCE/ECCE variables *****//

	//*****  Phacoemulsification variables *****//
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
	//*****  Phacoemulsification variables *****//

	function initCanvas() {
		canvas.renderAll();
		canvas.isDrawingMode = true;
		canvas.freeDrawingBrush.color = 'black';
		canvas.freeDrawingBrush.width = 1;
	}

	function clearCanvas() {
		maintainObjects = [];
		if (canvas.size() > 0)
			for (var i = 0; i < maintainList.length; i++)
				if (getCanvasObjByName(maintainList[i])) maintainObjects.push(getCanvasObjByName(maintainList[i]));

		canvas.clear();
		if (canvas.overlayImage) canvas.overlayImage.visible = false;
		if (maintainObjects.length > 0) for (i = 0; i < maintainObjects.length; i++) canvas.add(maintainObjects[i]);
		canvas.renderAll();
	}

	//***** ICCE/ECCE Script *****//
	function drawStitch(no, side) {
		if (no == 0) return;
		var originX; // x origin of this layout.
		var offSet; // next stitch offset.
		var offSetTop = 2; // use in a draft positioning.
		var left;
		var top;
		var topFixed = []; // appropiate top of each stitch.
		
		if ($('.side-select.active').text() != 'Both') {
			if (side == 'right') {
				originX = rightX1 + ((rightX2 - rightX1) / 2);
				offSet = (rightX2 - rightX1) / 20;
				// topFixed for right-eye side.
				topFixed = [0, 249, 245, 241, 239, 236, 233, 230, 228, 227, 227, 227, 229, 231, 233, 235, 237, 242, 245, 250, 257];
			} else {
				originX = leftX1 + ((leftX2 - leftX1) / 2);
				offSet = (leftX2 - leftX1) / 20;
				// topFixed for left-eye side.
				topFixed = [0, 241, 237, 233, 231, 228, 227, 227, 226, 225, 225, 225, 226, 228, 230, 235, 237, 242, 245, 253, 261];
			}
		} else {
			if (side == 'right') {
				originX = bothRightX1 + ((bothRightX2 - bothRightX1) / 2);
				offSet = (bothRightX2 - bothRightX1) / 20;
				// topFixed for right-eye side.
				topFixed = [0, 244, 239, 236, 234, 229, 228, 225, 223, 222, 222, 222, 224, 226, 228, 230, 232, 237, 240, 245, 250];
			} else {
				originX = bothLeftX1 + ((bothLeftX2 - bothLeftX1) / 2);
				offSet = (bothLeftX2 - bothLeftX1) / 20;
				// topFixed for left-eye side.
				topFixed = [0, 237, 233, 231, 229, 226, 225, 224, 223, 222, 222, 222, 223, 225, 225, 228, 231, 236, 239, 245, 252];
			}
		}
		if (side == 'right') {
			if (stitchesRight)
				for (i = 0; i < stitchesRight.length; i++) {canvas.remove(getCanvasObjByName('stitchright' + (i + 1)));}
		
		} else {
			if (stitchesLeft)
				for (i = 0; i < stitchesLeft.length; i++) {canvas.remove(getCanvasObjByName('stitchleft' + (i + 1)));}
		}

		stitches = [];
		stitchCount = 1;

		if (side == 'right')
			stitchesRight = [];
		else
			stitchesLeft = [];
		if ((no % 2) == 0) {
			left = originX - (no / 2 * offSet);
			topIndex = 10 - (no / 2 - 1);
			for (var i = 1; i <= no; i++) {
				addStitch(topFixed[topIndex], left, side);
				left += offSet;
				topIndex++;
			}
		} else {
			left = originX - ((no - 1) / 2 * offSet);
			topIndex = 10 - ((no + 1) / 2 - 1) + 1;
			for (i = 1; i <= no; i++) {
				addStitch(topFixed[topIndex], left, side);
				left += offSet;
				topIndex++;
			}
		}
		if (side == 'right') {
			stitchRightCount = 0;
			animateStitchingRight();
		} else {
			stitchLeftCount = 0;
			animateStitchingLeft();
		}
	}

	function addStitch(top, left, side) {
		var line = new fabric.Line([0,0,0,25 + fabric.util.getRandomInt(-3, 3)], {
			strokeWidth: 1,
			stroke: 'black',
			top: top,
			left: left,
			angle: fabric.util.getRandomInt(-3, 3),
			name: 'stitch' + side + stitchCount
		})		
		stitchCount++;
		if (side == 'right') {
			stitchesRight.push(line);
		} else {
			stitchesLeft.push(line);
		}
	}

	function animateStitching() {
		var top = stitches[stitchCount].top;
		stitches[stitchCount].top = (addStitchFlag) ? 0 : canvas.height;
		canvas.add(stitches[stitchCount]);
		stitches[stitchCount].animate('top', top, {
			onChange: canvas.renderAll.bind(canvas),
			duration: 380,
			easing: fabric.util.ease.easeOutBack,
			onComplete: function() { 
				if (stitchCount < stitches.length) {
					animateStitching();
				} else {
					getCanvasObjByName('stitchCountLabel').text = '';
					canvas.renderAll();
				}
			}
		});
		addStitchFlag = !addStitchFlag;
		stitchCount++;
	}

	function animateStitchingRight() {
		var top = stitchesRight[stitchRightCount].top;
		stitchesRight[stitchRightCount].top = (stitchRightFlag) ? 0 : canvas.height;
		canvas.add(stitchesRight[stitchRightCount]);
		stitchesRight[stitchRightCount].animate('top', top, {
			onChange: canvas.renderAll.bind(canvas),
			duration: 250,
			easing: fabric.util.ease.easeOutBack,
			onComplete: function() { 
				if (stitchRightCount < stitchesRight.length) {
					animateStitchingRight();
				} else {
					getCanvasObjByName('stitchCountLabel').text = '';
					canvas.renderAll();
				}
			}
		});
		stitchRightFlag = !stitchRightFlag;
		stitchRightCount++;
	}

	function animateStitchingLeft() {
		var top = stitchesLeft[stitchLeftCount].top;
		stitchesLeft[stitchLeftCount].top = (stitchLeftFlag) ? 0 : canvas.height;
		canvas.add(stitchesLeft[stitchLeftCount]);
		stitchesLeft[stitchLeftCount].animate('top', top, {
			onChange: canvas.renderAll.bind(canvas),
			duration: 250,
			easing: fabric.util.ease.easeOutBack,
			onComplete: function() { 
				if (stitchLeftCount < stitchesLeft.length) {
					animateStitchingLeft();
				} else {
					getCanvasObjByName('stitchCountLabel').text = '';
					canvas.renderAll();
				}
			}
		});
		stitchLeftFlag = !stitchLeftFlag;
		stitchLeftCount++;
	}
	//***** ICCE/ECCE Script *****//
</script>
@endsection