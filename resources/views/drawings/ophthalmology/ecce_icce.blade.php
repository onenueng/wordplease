<div class="col-md-12 col-sm-4" style="padding: 2px 1px 2px 1px">
	<span class="fa fa-ellipsis-v"></span>
	<div class="btn-group" role="group">
		<button class="btn btn-default btn-xs side-select" role="button">Right</button>
		<button class="btn btn-default btn-xs side-select" role="button">Left</button>
		<button class="btn btn-default btn-xs side-select" role="button">Both</button>
	</div>
	<script type="text/javascript">
		$('.side-select').click(function() {
			$('.side-select').removeClass('active');
			$('.side-select').removeClass('btn-success');
			$('.side-select').addClass('btn-default');

			$(this).addClass('active');
			$(this).removeClass('btn-default');
			$(this).addClass('btn-success');

			var filePath;
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
			// canvas.clear();
			clearCanvas();
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
			setCanvasOverlayImage(filePath, 0.6);
		});
	</script>
</div>

<div class="col-md-12 col-sm-4 collapse" id="right_stitch_collapse" style="padding: 2px 1px 2px 1px">
	<div class="form-inline">
		<span class="fa fa-ellipsis-v"></span>
		<label class="label label-info">Rt.Stitch</label>
		<div class="form-group"><input type="range" class="stitch-slider" name="right_stitch" min="1" max="20" value="0"></div>
	</div>
</div>


<div class="col-md-12 col-sm-4 collapse" id="left_stitch_collapse" style="padding: 2px 1px 2px 1px">
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
		stitchCountLabel.text = $(this).val();
		canvas.renderAll();
	});
</script>

<script type="text/javascript">
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
	// var isWait = true;
	var stitches;
	var stitchCount = 0;

	var stitchesRight;
	var stitchRightCount = 0;
	var stitchRightFlag = false;

	var stitchesLeft;
	var stitchLeftCount = 0;
	var stitchLeftFlag = false;

	function initCanvas() {
		canvas.renderAll();
		canvas.isDrawingMode = true;
		canvas.freeDrawingBrush.color = 'black';
		canvas.freeDrawingBrush.width = 1;
	}

	function clearCanvas() {
		canvas.clear();
		stitchCountLabel = new fabric.Text('', {
			top: 0,
			left: 0,
			fontSize: 40,
		});
		canvas.add(stitchCountLabel);
	}

	// function createOverlay(text){
	// 	console.log('hello overlay ' + text);
	// }

	function drawStitch(no, side) {
		if (no == 0) return;
		var originX; // x origin of this layout.
		var offSet; // next stitch offset.
		var offSetTop = 2; // use in a draft positioning.
		var left;
		var top;
		var topFixed = []; // appropiate top of each stitch.
		

		if ($('.side-select.active').text() != 'Both') {
			// if ($('.side-select.active').text() == 'Right') {
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

		// var stitches = (side == 'right') ? stitchesRight : stitchesLeft;

		// if (stitches) {
		// 	for (i = 0; i < stitches.length; i++) {canvas.remove(getCanvasObjByName('stitch' + (i + 1)));}
		// }

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
			left = originX - (no / 2 * offSet); //*
			topIndex = 10 - (no / 2 - 1);
			
			for (var i = 1; i <= no; i++) {
				// addStitch(topFixed[topIndex], left); //*
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
		// stitchCount = 0; //*
		// animateStitching(); //*
		if (side == 'right') {
			stitchRightCount = 0;
			animateStitchingRight();
		} else {
			stitchLeftCount = 0;
			animateStitchingLeft();
		}
	}

	function addStitch(top, left, side) {
		var line = new fabric.Line([0,0,0,20], {
			strokeWidth: 1,
			stroke: 'black',
			top: top,
			// angle: -5,
			left: left,
			name: 'stitch' + side + stitchCount //*
			// name: 'stitch' +  ((side == 'right') ? stitchRightCount : stitchLeftCount)
		})		
		// stitches.push(line); //*
		stitchCount++; //*

		if (side == 'right') {
			// console.log('enter right');
			stitchesRight.push(line);
			// stitchRightCount++;
		} else {
			// console.log('enter left');
			stitchesLeft.push(line);
			// stitchLeftCount++;
		}

		// var line = new fabric.Line([0,0,0,20], {
		// 	strokeWidth: 1,
		// 	stroke: 'black',
		// 	top: (addStitchFlag) ? 0 : canvas.height,
		// 	// angle: -5,
		// 	left: left
		// })
		
		// // isWait = true;
		// addStitchFlag = !addStitchFlag;
		// canvas.add(line);
		// line.animate('top', top, {
		// 	onChange: canvas.renderAll.bind(canvas),
		// 	// easing: fabric.util.ease.easeOutElastic,
		// 	onComplete: function() { 
		// 		console.log(line.top);
		// 		isWait = false; 
		// 	},
		// 	duration: 1000
		// });
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
					stitchCountLabel.text = '';
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
					stitchCountLabel.text = '';
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
					stitchCountLabel.text = '';
					canvas.renderAll();
				}
			}
		});
		stitchLeftFlag = !stitchLeftFlag;
		stitchLeftCount++;
	}
</script>