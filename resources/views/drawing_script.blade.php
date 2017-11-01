<!-- Fabric -->
<script src="{{ url('/assets/script/fabric.js') }}"></script>
<script type="text/javascript">
	/**
	*	Initial global variables and common functions for this drawing.
	*
	**/
	var canvasWidth = 700;
	var canvasHeight = 600;
	var backgroundColor = 'rgba(251,253,227, 1)';
	var pickedColor = 'black';
	var textSize = 1;
	var textStyle = 'normal';
	var textWeight = 'normal';
	var textDecoration = 'normal';
	var lastDeleted;
	var lastDeletedLeftOffset;
	var lastDeletedTopOffset;
	var initObjsNo = 0;
	var canvas;
	var currentDrawing;
	var drawings = [];

	function getCanvasByName(name) {
		for (i = 0; i < drawings.length; i++)
			if (drawings[i].name == name)
				return drawings[i];
		return false;
	} // find fabric canvas by name. if not found return false.

	function getCanvasObjByName(name) {
		for (i = 0; i < canvas.size(); i++)
			if (canvas.item(i).name == name)
				return canvas.item(i);
		return false;
	} // find fabric object by name. if not found return false.

	function animateAddingObject(obj) {
		canvas.add(obj).setActiveObject(obj);
		obj.animate('left', canvasWidth/2, { // half width.
			onChange: canvas.renderAll.bind(canvas),
			duration: 1000
			// easing: fabric.util.ease.easeOutBounce
		});
	} // animate adding object to canvas.

	function updateDrawingsSizeColor() {
		if (drawings) {
			$.each(drawings, function(index, value) {
				value.freeDrawingBrush.color = pickedColor;
				value.freeDrawingBrush.width = textSize;
			});
		}
	}

	function updateSizeColor(obj) {
		if (canvas.size() > initObjsNo) { // check objects in canvas.
			if (canvas.getActiveGroup()) {
				// console.log('group selected');
				canvas.getActiveGroup().forEachObject(function(obj) {
					updateSizeColorByType(obj);
				});
			} else {
				if (canvas.getActiveObject()) {
					updateSizeColorByType(canvas.getActiveObject());
				}
			}
		}
	}

	function updateSizeColorByType(obj) {
		var objType = obj.get('type');
		if (objType == 'text' || objType == 'textbox') {
			obj.setFill(pickedColor);
			obj.setFontSize(textSize);
		} else if (objType == 'path') {
			obj.setStroke(pickedColor);
		}
		canvas.renderAll();
	}

	function deselectFabric() {
		if (canvas.getActiveObject()){
			canvas.discardActiveObject().renderAll();
		} else if (canvas.getActiveGroup()) {
			canvas.discardActiveGroup().renderAll();
		}
	}

	function setCanvasOverlayImage(filePath, scale) {
		canvas.setOverlayImage(filePath, canvas.renderAll.bind(canvas), {
			scaleX: scale,
			scaleY: scale,
			top: canvas.getCenter().top,
			left: canvas.getCenter().left,
			originX: 'center',
			originY: 'center',
			visible: true
		});
	}

	function setCanvasBackgroundImage(filePath, scale) {
		canvas.setBackgroundImage(filePath, canvas.renderAll.bind(canvas), {
			scaleX: scale,
			scaleY: scale,
			top: canvas.getCenter().top,
			left: canvas.getCenter().left,
			originX: 'center',
			originY: 'center',
			visible: true
		});
	}

	/*** Initial Deep Tendon Reflex. ***/
	function initDeepTendonReflex() {
		var controlsLeft = [273, 420];
		var controlsTop = [166, 261, 327, 460]; 
		var tag;
		var controlsName = [
			'deep_tendon_reflex_wrist_right',
			'deep_tendon_reflex_wrist_left',
			'deep_tendon_reflex_elbow_right',
			'deep_tendon_reflex_elbow_left',
			'deep_tendon_reflex_knee_right',
			'deep_tendon_reflex_knee_left',
			'deep_tendon_reflex_ankle_right',
			'deep_tendon_reflex_ankle_left'
		];

		for(var i = 0; i < controlsName.length; i++) {
			$('body').append(
				'<select group="deep_tendon_reflex" name="' + controlsName[i] + '" style="position:absolute; width: auto; z-index: 1;" onchange="selectGroupHandleChangeOnTheFly($(this));">' + 
				'<option selected disabled hidden value=""></option>' +
				'<option value="0">0</option>' +
				'<option value="1">0-1&#x207a;</option>' +
				'<option value="2">1&#x207a;</option>' +
				'<option value="3">1&#x207a;-2&#x207a;</option>' +
				'<option value="4">2&#x207a;</option>' +
				'<option value="5">2&#x207a;-3&#x207a;</option>' +
				'<option value="6">3&#x207a;</option>' +
				'<option value="7">3&#x207a;-4&#x207a;</option>' +
				'<option value="8">4&#x207a;</option>' +
				'</select>'
			);
			tag = new fabric.Text('tag', {
				fontSize: 20,
				left: i % 2 == 0 ? controlsLeft[0] : controlsLeft[1],
				top: controlsTop[Math.floor(i / 2)],
				fill: 'blue',
				name: controlsName[i]
			});
			canvas.add(tag);
			$('select[name=' + controlsName[i] + ']').css('left', tag.left + canvas._offset.left);
			$('select[name=' + controlsName[i] + ']').css('top', tag.top + canvas._offset.top);
		}

		appendSelectGroupHelper('deep_tendon_reflex');
		// $('.select-canvas[target=deep_tendon_reflex]').after(
		// 	'<span class="fa fa-ellipsis-h"></span>' +
		// 	'<div class="btn-group" role="group">' +
		// 	'<button onclick="btnGroupHandleClickOnTheFly($(this));" type="button" class="btn btn-default btn-xs active" group="deep_tendon_reflex">Individual</button>' +
		// 	'<button onclick="btnGroupHandleClickOnTheFly($(this));" type="button" class="btn btn-default btn-xs" group="deep_tendon_reflex">All Right</button>' +
		// 	'<button onclick="btnGroupHandleClickOnTheFly($(this));" type="button" class="btn btn-default btn-xs" group="deep_tendon_reflex">All Left</button>' +
		// 	'<button onclick="btnGroupHandleClickOnTheFly($(this));" type="button" class="btn btn-default btn-xs" group="deep_tendon_reflex">All Both</button>' +
		// 	'</div>'
		// );
	}
	/*** Initial Deep Tendon Reflex. ***/

	/*** Initial Motor Power. ***/
	function initMotorPower() {
		var controlsLeft = [230, 350];
		var controlsTop = [75, 200, 341, 440]; 
		var tag;
		var controlsName = [
			'motor_power_upper_arm_right',
			'motor_power_upper_arm_left',
			'motor_power_lower_arm_right',
			'motor_power_lower_arm_left',
			'motor_power_upper_leg_right',
			'motor_power_upper_leg_left',
			'motor_power_lower_leg_right',
			'motor_power_lower_leg_left'
		];
		
		for(var i = 0; i < controlsName.length; i++) {
			$('body').append(
				'<select group="motor_power" name="' + controlsName[i] + '" style="position:absolute; width: auto; z-index: 1;" onchange="selectGroupHandleChangeOnTheFly($(this));">' + 
				'<option selected disabled hidden value=""></option>' +
				'<option value="0">0</option>' +
				'<option value="1">0-I</option>' +
				'<option value="2">I</option>' +
				'<option value="3">I-II</option>' +
				'<option value="4">II</option>' +
				'<option value="5">II-III</option>' +
				'<option value="6">III</option>' +
				'<option value="7">III-IV</option>' +
				'<option value="8">IV</option>' +
				'<option value="9">IV-V</option>' +
				'<option value="10">V</option>' +
				'</select>'
			);
			tag = new fabric.Text('tag', {
				fontSize: 20,
				left: i % 2 == 0 ? controlsLeft[0] : controlsLeft[1],
				top: controlsTop[Math.floor(i / 2)],
				fill: 'blue',
				name: controlsName[i]
			});
			canvas.add(tag);
			$('select[name=' + controlsName[i] + ']').css('left', tag.left + canvas._offset.left);
			$('select[name=' + controlsName[i] + ']').css('top', tag.top + canvas._offset.top);
		}

		appendSelectGroupHelper('motor_power');
	}
	/*** Initial Motor Power. ***/

	function appendSelectGroupHelper(groupName) {
		$('.select-canvas[target=' + groupName +']').after(
			'<span class="fa fa-ellipsis-h"></span>' +
			'<div class="btn-group" role="group">' +
			'<button onclick="btnGroupHandleClickOnTheFly($(this));" type="button" class="btn btn-default btn-xs active" group="' + groupName +'">Individual</button>' +
			'<button onclick="btnGroupHandleClickOnTheFly($(this));" type="button" class="btn btn-default btn-xs" group="' + groupName +'">All Right</button>' +
			'<button onclick="btnGroupHandleClickOnTheFly($(this));" type="button" class="btn btn-default btn-xs" group="' + groupName +'">All Left</button>' +
			'<button onclick="btnGroupHandleClickOnTheFly($(this));" type="button" class="btn btn-default btn-xs" group="' + groupName +'">All Both</button>' +
			'</div>'
		);
	}

	/*** Initial Joints and its events. ***/
	function initJoints() {
		var joints = [];
		joints.push({ name: "head1", rx: 10.731707317073171, ry: 9.523809523809524, left: 331.015625, top: 59 });
		joints.push({ name: "head2", rx: 10.24390243902439, ry: 8.095238095238097, left: 383.015625, top: 62 });
		joints.push({ name: "shoulder1", rx: 11.21951219512195, ry: 8.545866935483872, left: 306.015625, top: 97.05367943548387 });
		joints.push({ name: "shoulder2", rx: 11.211890243902438, ry: 10, left: 341.015625, top: 101 });
		joints.push({ name: "shoulder3", rx: 10.731707317073171, ry: 9.047619047619047, left: 375.015625, top: 103 });
		joints.push({ name: "shoulder4", rx: 10.774113082039914, ry: 7.142857142857142, left: 407.015625, top: 100 });
		joints.push({ name: "lfArm1", rx: 21.951219512195124, ry: 18.095238095238095, left: 418.015625, top: 108 });
		joints.push({ name: "lfArm2", rx: 22.43140243902439, ry: 15.238095238095239, left: 432.015625, top: 178 });
		joints.push({ name: "lfArm3", rx: 24.390243902439025, ry: 19.523809523809522, left: 462.015625, top: 230 });
		joints.push({ name: "lfArm4", rx: 12.909711996292506, ry: 8.826233527428746, left: 445.015625, top: 257.46490959239964 });
		joints.push({ name: "rtArm1", rx: 22.926829268292686, ry: 18.095238095238095, left: 274.015625, top: 105 });
		joints.push({ name: "rtArm2", rx: 24.390243902439025, ry: 18.095238095238095, left: 264.015625, top: 181 });
		joints.push({ name: "rtArm3", rx: 24.382621951219512, ry: 19.047619047619047, left: 243.015625, top: 253 });
		joints.push({ name: "rtArm4", rx: 10.319811951435163, ry: 8.095238095238095, left: 260.8600104995579, top: 289 });
		joints.push({ name: "spine1", rx: 10.731707317073171, ry: 6.190476190476191, left: 358.015625, top: 94 });
		joints.push({ name: "spine2", rx: 6.764227642276422, ry: 5.777777777777779, left: 363.1489583333333, top: 122.86666666666667 });
		joints.push({ name: "spine3", rx: 8.780487804878048, ry: 13.80952380952381, left: 360.015625, top: 145 });
		joints.push({ name: "spine4", rx: 9.75609756097561, ry: 8.095238095238095, left: 354.015625, top: 246 });
		joints.push({ name: "leftLeg1", rx: 25.853658536585368, ry: 19.523809523809526, left: 380.015625, top: 260 });
		joints.push({ name: "leftLeg2", rx: 24.878048780487806, ry: 19.523809523809522, left: 376.015625, top: 378 });
		joints.push({ name: "leftLeg3", rx: 24.491736092448253, ry: 19.047619047619047, left: 382.50736109244826, top: 496 });
		joints.push({ name: "rightLeg1", rx: 27.978580990629183, ry: 21.4755959137344, left: 294.015625, top: 259 });
		joints.push({ name: "rightLeg2", rx: 25.365853658536587, ry: 19.475655430711612, left: 308.015625, top: 376 });
		joints.push({ name: "rightLeg3", rx: 24.384568994685434, ry: 19.523809523809522, left: 306.015625, top: 484 });
		joints.push({ name: "leftHand1", rx: 10.479910714285714, ry: 10.479910714285714, left: 521, top: 270.9921875 });
		joints.push({ name: "leftHand2", rx: 11.436011904761905, ry: 10, left: 496, top: 278 });
		joints.push({ name: "leftHand3", rx: 11.436011904761905, ry: 10, left: 475, top: 285 });
		joints.push({ name: "leftHand4", rx: 12.864583333333332, ry: 10, left: 449, top: 287 });
		joints.push({ name: "leftHand5", rx: 10.959821428571427, ry: 10, left: 431, top: 296 });
		joints.push({ name: "leftHand6", rx: 11.897321428571427, ry: 10, left: 531.015625, top: 295 });
		joints.push({ name: "leftHand7", rx: 11.42485119047619, ry: 10.479910714285714, left: 514.015625, top: 312.9921875 });
		joints.push({ name: "leftHand8", rx: 12.644454123112665, ry: 10.688879210220673, left: 489.015625, top: 322.5533536585366 });
		joints.push({ name: "leftHand9", rx: 11.436011904761905, ry: 10.718005952380953, left: 453, top: 323.4921875 });
		joints.push({ name: "leftHand10", rx: 10.48363095238095, ry: 10.241815476190476, left: 433, top: 324.4921875 });
		joints.push({ name: "leftHand11", rx: 9.53125, ry: 6.666666666666668, left: 537, top: 317 });
		joints.push({ name: "leftHand12", rx: 9.747596153846153, ry: 8.355082417582416, left: 525, top: 339.4543269230769 });
		joints.push({ name: "leftHand13", rx: 10.718005952380953, ry: 9.289434523809526, left: 503, top: 348.4921875 });
		joints.push({ name: "leftHand14", rx: 10, ry: 8.571428571428571, left: 466, top: 356 });
		joints.push({ name: "rightHand1", rx: 11.912202380952381, ry: 8.571428571428571, left: 182, top: 279 });
		joints.push({ name: "rightHand2", rx: 12.388392857142858, ry: 8.098958333333334, left: 197, top: 293.9921875 });
		joints.push({ name: "rightHand3", rx: 10.48363095238095, ry: 8.571428571428571, left: 216, top: 306 });
		joints.push({ name: "rightHand4", rx: 10, ry: 10, left: 238, top: 315 });
		joints.push({ name: "rightHand5", rx: 10, ry: 8.571428571428571, left: 251, top: 330 });
		joints.push({ name: "rightHand6", rx: 10, ry: 7.619047619047619, left: 234, top: 355 });
		joints.push({ name: "rightHand7", rx: 10.95238095238095, ry: 10, left: 214.015625, top: 347 });
		joints.push({ name: "rightHand8", rx: 12.380952380952381, ry: 10, left: 182.015625, top: 336 });
		joints.push({ name: "rightHand9", rx: 10.48363095238095, ry: 9.047619047619047, left: 167, top: 321 });
		joints.push({ name: "rightHand10", rx: 10.95982142857143, ry: 8.571428571428573, left: 157, top: 297 });
		joints.push({ name: "rightHand11", rx: 10, ry: 9.04761904761905, left: 146, top: 315 });
		joints.push({ name: "rightHand12", rx: 10, ry: 7.6190476190476195, left: 146, top: 342 });
		joints.push({ name: "rightHand13", rx: 10, ry: 8.095238095238095, left: 160, top: 359 });
		joints.push({ name: "rightHand14", rx: 10, ry: 8.571428571428571, left: 189, top: 372 });
		joints.push({ name: "leftFoot1", rx: 10.959821428571427, ry: 9.047619047619047, left: 460, top: 515 });
		joints.push({ name: "leftFoot2", rx: 11.436011904761905, ry: 7.6190476190476195, left: 438, top: 527 });
		joints.push({ name: "leftFoot3", rx: 11.432291666666668, ry: 8.571428571428571, left: 420, top: 536 });
		joints.push({ name: "leftFoot4", rx: 11.436011904761905, ry: 7.6190476190476195, left: 396, top: 540 });
		joints.push({ name: "leftFoot5", rx: 11.432291666666668, ry: 9.047619047619047, left: 371, top: 537 });
		joints.push({ name: "leftFoot6", rx: 10.95610119047619, ry: 9.051339285714285, left: 473, top: 529.9921875 });
		joints.push({ name: "leftFoot7", rx: 11.436011904761905, ry: 8.571428571428571, left: 449, top: 543 });
		joints.push({ name: "leftFoot8", rx: 12.864583333333332, ry: 7.619047619047619, left: 425, top: 554 });
		joints.push({ name: "leftFoot9", rx: 11.91220238095238, ry: 8.571428571428571, left: 399, top: 557 });
		joints.push({ name: "leftFoot10", rx: 11.912202380952381, ry: 8.571428571428571, left: 374, top: 556 });
		joints.push({ name: "RightFoot1", rx: 11.436011904761905, ry: 9.047619047619047, left: 336, top: 534 });
		joints.push({ name: "RightFoot2", rx: 11.912202380952381, ry: 7.142857142857143, left: 310, top: 540 });
		joints.push({ name: "RightFoot3", rx: 10.959821428571427, ry: 7.619047619047619, left: 286, top: 534 });
		joints.push({ name: "RightFoot4", rx: 11.436011904761905, ry: 7.619047619047619, left: 265, top: 529 });
		joints.push({ name: "RightFoot5", rx: 10, ry: 8.095238095238097, left: 246, top: 521 });
		joints.push({ name: "RightFoot6", rx: 11.436011904761905, ry: 7.619047619047619, left: 334, top: 557 });
		joints.push({ name: "RightFoot7", rx: 12.388392857142858, ry: 8.095238095238095, left: 305, top: 556 });
		joints.push({ name: "RightFoot8", rx: 11.436011904761905, ry: 8.571428571428571, left: 277, top: 553 });
		joints.push({ name: "RightFoot9", rx: 10.95982142857143, ry: 8.571428571428571, left: 251, top: 547 });
		joints.push({ name: "RightFoot10", rx: 11.912202380952381, ry: 9.047619047619047, left: 233, top: 533 });

		$('#select_mode').click();

		joints.forEach(function(value, key) {
			var ellipse = new fabric.Ellipse(value);
			ellipse.set({
				fill: backgroundColor,
				hasControls: false,
				hasBorders: false,
				hoverCursor: 'pointer',
				selectable: false,
				cat: 'joint',
				clickCount: 0
			});
			canvas.add(ellipse);
		});

		canvas.on('mouse:down', function(e){
			if (e.target && (e.target.cat == 'joint' || e.target.cat == 'diameter')) {
				switch (e.target.clickCount) {
					case 0: // swollen + red, background yellow + red cross.
						drawJointSwollenRed(e.target);
						break;
					case 1: //swollen + red + tender, backgound yellow + purpil cross.
						drawJointSwollenRedTender(e.target);
						break;
					case 2: // red + tender, background purpil.
						drawJointRedTender(e.target);
						break;
					case 3:
						e.target.clickCount = 0;
						e.target.fill = backgroundColor;
				}
				canvas.renderAll();
			}
		});
	}

	function drawJointSwollenRed(joint) {
		// always get joint.
		joint.fill = 'rgb(255,222,23)';
		drawJointDiameter(joint);

		// update joint and diameter clickCount.
		joint.clickCount++;
		getCanvasObjByName(joint.name + '_diameter').clickCount++;
	}

	function drawJointSwollenRedTender(joint) {
		// expect daimeter.
		joint = (joint.cat == 'joint') ? getCanvasObjByName(joint.name + '_diameter') : joint;

		// change diameter stroke color.
		getCanvasObjByName(joint.name).forEachObject(function(obj) { obj.set({ stroke: 'rgb(92,46,145)' }) });

		// update joint and diameter clickCount.
		joint.clickCount++;
		getCanvasObjByName(joint.name.replace('_diameter', '')).clickCount++;
	}

	function drawJointRedTender(joint) {
		// expect joint.
		joint = (joint.cat == 'joint') ? joint : getCanvasObjByName(joint.name.replace('_diameter', ''));

		joint.fill = 'rgb(92,46,145)'; // change joint fill color.

		canvas.remove(getCanvasObjByName(joint.name + '_diameter')); // remove dimeter.

		joint.clickCount++;
	}

	function drawJointDiameter(joint, stroke = 'red') {
		var x1 = joint.getCenterPoint().x;
		var y1 = joint.getCenterPoint().y;
		var x2, y2;
		var angles = [30, 150, -30, -150];
		var radius = [];

		for(var i = 0; i < angles.length; i++ ) {
			if (getCanvasObjByName(joint.name + angles[i])) canvas.remove(getCanvasObjByName(joint.name + angles[i]));
			x2 = x1 + joint.getRx() * Math.cos(angles[i] * Math.PI / 180.0);
			y2 = y1 + joint.getRy() * Math.sin(angles[i] * Math.PI / 180.0);
			
			radius.push(new fabric.Line([x1, y1, x2, y2], { stroke: stroke, strokeWidth: 2, }));
		}
		canvas.add(new fabric.Group([radius[0], radius[1], radius[2], radius[3]], {
			name: joint.name + '_diameter', 
			hasControls: false,
			hasBorders: false,
			hoverCursor: 'pointer',
			selectable: false,
			cat: 'diameter',
			clickCount: joint.clickCount
		}));
	}
	/*** Initial Joints and its events. ***/

	function initCanvas(divID, name) {
		/*** Clear style of last active object. ***/
		$('.active.select-canvas.fa-unlock-alt').addClass('fa-lock');
		$('.active.select-canvas.fa-unlock-alt').removeClass('fa-unlock-alt');
		$('.active.select-canvas').removeClass('active');
		$('canvas.active').removeClass('active');

		/*** Create canvas element and its div container and select button. ***/
		$('#' + divID).append('<div class="text-center canvas-div" drawing="' + name + '" id="' + name + '_canvas_div"><span class="btn btn-default btn-xs active select-canvas fa fa-unlock-alt" target="' + name + '" role="button"></span><canvas id="' + name + '_canvas" class="active"></canvas></div>');

		/*** Define click event for new canvas select button on the fly. ***/
		$('.active.select-canvas').click(function() {
			// $('#top-tool-bar').collapse('show');
			$('#top-tool-bar').css('display', '');
			if (!$(this).hasClass('active')) { // Check if click on inactive button.
				/*** Clear style of last active object. ***/
				$('.active.select-canvas.fa-unlock-alt').addClass('fa-lock');
				$('.active.select-canvas.fa-unlock-alt').removeClass('fa-unlock-alt');
				$('.active.select-canvas').removeClass('active');
				$('canvas.active').removeClass('active');

				/*** Style this active object. ***/
				$(this).removeClass('fa-lock');
				$(this).addClass('fa-unlock-alt');
				$(this).addClass('active');
				$('#' + $(this).attr('target') + '_canvas').addClass('active');

				/*** Set active canvas point to selected canvas. Also set size and color too. ***/
				canvas = getCanvasByName($(this).attr('target'));
				canvas.freeDrawingBrush.color = pickedColor;
				canvas.freeDrawingBrush.width = textSize;

				/*** Set current canvas label. ***/
				currentDrawing = name;
				$('#drawing_label').text(name);
			} // case active, do nothing.
		});

		/*** Set current canvas label. ***/
		currentDrawing = name;
		$('#drawing_label').text(name);

		/*** Create new canvas then push in drawings. ***/
		drawings[drawings.length] = new fabric.Canvas(name + '_canvas', {width: canvasWidth, height: canvasHeight, name: name });
		canvas = drawings[drawings.length - 1]; // Set global canvas point to this canvas.
		canvas.backgroundColor = backgroundColor;
		
		// canvas.on('mouse:over', function(e) {
		// 	if (e.target) 
		// 		console.log(e.target.name);
		// 	else
		// 		console.log('canvas');
			
		// });

		/*** these methods should be review. ***/
		canvas.isDrawingMode = true;
		canvas.freeDrawingBrush.color = 'black';
		canvas.freeDrawingBrush.width = 1;
		setCanvasOverlayImage('/assets/images/drawings/medicine/' + name + '.svg', 0.8);
		
		canvas.renderAll();

		/*** Additional process. ***/
		switch(name) {
			case "joints" :
				initJoints();
				break;
			case "deep_tendon_reflex" :
				initDeepTendonReflex();
				break;
			case "motor_power" :
				initMotorPower();
				break;
		}

		/*** Show canvas div collapse and drawing tools. ***/
		$('#' + $(this).attr('target')).collapse('show');
		// $('#top-tool-bar').collapse('show');
		$('#top-tool-bar').css('display', '');
	}

	function btnGroupHandleClickOnTheFly(btn) {
		$('.btn.active[group=' + btn.attr('group') + ']').removeClass('active');
		btn.addClass('active');
	}

	function selectGroupHandleChangeOnTheFly(select) {
		switch($('.btn.active[group=' + select.attr('group') + ']').text()) {
			// case 'Individual' :

			// 	break;
			case 'All Right' :
				$('select[group=' + select.attr('group') + '][name$=right]').val(select.val());
				break;
			case 'All Left' :
				$('select[group=' + select.attr('group') + '][name$=_left]').val(select.val());
				break;
			case 'All Both' :
				$('select[group=' + select.attr('group') + ']').val(select.val());
				break;
		}
		// console.log($('.btn.active[group=' + select.attr('group') + ']').text());
	}

	// function initCanvas() {
	// 	canvas.isDrawingMode = true;
	// 	canvas.freeDrawingBrush.color = 'black';
	// 	canvas.freeDrawingBrush.width = 1;

	// 	canvas.renderAll();
	// 	$('#extra_tools').css('display', 'none');
	// 	$('#canvas_div').removeClass('col-md-10');
	// 	$('#canvas_div').addClass('col-md-12');
	// }  // fall back initiate canvas.

	function clearCanvas() { canvas.clear(); } // fall back clear canvas.

	function drawEllipse(name, rx = 20, ry = 10, top = 200, left = 200) {
		canvas.add(new fabric.Ellipse({
			name: name,
			fill: '#000',
			rx: rx,
			ry: ry,
			top: top,
			left: left
			// hasControls: false,
			// hasBorders: false,
		}));
	}

	function printEllipses() {
		if (canvas) {
			canvas.forEachObject(function(obj) {
				var json = '';
				if (obj.type == 'ellipse') {
					json = 'joints.push({ name: "' + obj.name + '", ';
					json += 'rx: ' + obj.getRx() + ', ';
					json += 'ry: ' + obj.getRy() + ', ';
					json += 'left: ' + obj.getLeft() + ', ';
					json += 'top: ' + obj.getTop() + ' });';
					console.log(json);
					// console.log('name: "' + obj.name + '",');
					// console.log('name: "' + obj.name + '",');
				}
			});
		}
	}
</script>