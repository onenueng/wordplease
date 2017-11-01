@extends('drawings.drawing')
@section('canvas')
<div class="col-md-12 col-sm-12 extra-tools-div"> <!-- Select OD/OS + VA mode -->
	<span class="fa fa-ellipsis-v"></span>
	<label class="label label-info" id="">Exam</label>
	<select name="exam">
		<option selected disabled hidden value=""></option>
		<option value="VA Admit">VA Admit</option>
		<option value="VA D/C">VA D/C</option>
		<option value="Lid">Lid</option>
		<option value="Cornea">Cornea</option>
		<option value="Disc">Disc</option>
		<option value="Retina">Retina</option>
	</select>
</div>
<script type="text/javascript">
	$('select[name=exam]').change(function() {
		switch ($(this).val()) {
			case 'VA Admit':
				initVA();
				$('.iop').collapse('hide');
				break;
			case 'VA D/C':
				initVA();
				$('.iop').collapse('show');
				break;
			case 'Lid':
				initLid();
				break;
			case 'Cornea':
				initCornea();
				break;
			case 'Disc':
				initDisc();
				break;
			case 'Retina':
				initRetina();
				break;
			default:
				console.log('hello');
		}
	});
</script>
<div class="col-md-12 col-sm-12 collapse extra-tools-div" id="odos_div"> <!-- Select OD/OS + VA mode -->
	<span class="fa fa-ellipsis-v"></span>
	<div class="btn-group" role="group">
		<button class="btn btn-default btn-xs eye-side active" id="eye-od" type="button" onclick="eyeSide = 'od';">O.D.</button>
		<button class="btn btn-default btn-xs eye-side" id="eye-os" type="button" onclick="eyeSide = 'os';">O.S.</button>
	</div>
	<select name="va_mode">
		<option selected disabled hidden value=""></option>
		<option value="NLP">NLP</option>
		<option value="LP">LP</option>
		<option value="HM">HM</option>
		<option value="CF">CF</option>
		<option value="ETDRS">ETDRS</option>
		<option value="Snellen">Snellen</option>
	</select>
</div>
<div class="col-md-12 col-sm-3 collapse va_input extra-tools-div"><!-- Select VA value -->
		<span class="fa fa-ellipsis-v"></span>
		<label class="label label-info" id="va_label">VAOD</label>
		<select name="va_value" class="va_select_input">
			<option selected disabled hidden value=""></option>
			<option value="6">6</option>
			<option value="7.5">7.5</option>
			<option value="9">9</option>
			<option value="9.5">9.5</option>
			<option value="12">12</option>
			<option value="15">15</option>
			<option value="18">18</option>
			<option value="24">24</option>
			<option value="30">30</option>
			<option value="36">36</option>
			<option value="38">38</option>
			<option value="48">48</option>
			<option value="60">60</option>
			<option value="72">72</option>
			<option value="120">120</option>
			<option value="152">152</option>
			<option value="240">240</option>
		</select>
</div>
<div class="col-md-12 col-sm-3 collapse va_input extra-tools-div"><!-- Select VA_P value -->
		<span class="fa fa-ellipsis-v"></span>
		<label class="label label-info" id="va_p_label">VAOD_P</label>
		<select name="va_p_value" class="va_select_input">
			<option selected disabled hidden value=""></option>
			<option value="^">^</option>
			<option value="-3">-3</option>
			<option value="-2">-2</option>
			<option value="-1">-1</option>
			<option value="0">0</option>
			<option value="+1">+1</option>
			<option value="+2">+2</option>
			<option value="+3">+3</option>
		</select>
		<script type="text/javascript">
			$('select[name=va_p_value]').change(function() {
				var obj =  (eyeSide == 'od') ? getCanvasObjByName('input_vaod_p') : getCanvasObjByName('input_vaos_p'); 
				obj.text = $(this).val();
				canvas.renderAll();
			});
		</script>
</div>
<div class="col-md-12 col-sm-3 collapse va_input extra-tools-div">
		<span class="fa fa-ellipsis-v"></span>
		<label class="label label-info" id="va_cph_label">VAOD_cPH</label>
		<select name="va_cph_value" class="va_select_input">
			<option selected disabled hidden value=""></option>
			<option value="6">6</option>
			<option value="7.5">7.5</option>
			<option value="9">9</option>
			<option value="9.5">9.5</option>
			<option value="12">12</option>
			<option value="15">15</option>
			<option value="18">18</option>
			<option value="24">24</option>
			<option value="30">30</option>
			<option value="36">36</option>
			<option value="38">38</option>
			<option value="48">48</option>
			<option value="60">60</option>
			<option value="72">72</option>
			<option value="120">120</option>
			<option value="152">152</option>
			<option value="240">240</option>
		</select>
		<script type="text/javascript">
			$('select[name=va_cph_value]').change(function() {
				var obj =  (eyeSide == 'od') ? getCanvasObjByName('input_vaod_cph') : getCanvasObjByName('input_vaos_cph'); 
				obj.text = $(this).val();
				canvas.renderAll();
			});
		</script>
</div>
<div class="col-md-12 col-sm-3 collapse va_input extra-tools-div">
		<span class="fa fa-ellipsis-v"></span>
		<label class="label label-info" id="va_cph_p_label">VAOD_cPH_P</label>
		<select name="va_cph_p_value" class="va_select_input">
			<option selected disabled hidden value=""></option>
			<option value="^">^</option>
			<option value="-3">-3</option>
			<option value="-2">-2</option>
			<option value="-1">-1</option>
			<option value="0">0</option>
			<option value="+1">+1</option>
			<option value="+2">+2</option>
			<option value="+3">+3</option>
		</select>
		<script type="text/javascript">
			$('select[name=va_cph_p_value]').change(function() {
				var obj =  (eyeSide == 'od') ? getCanvasObjByName('input_vaod_cph_p') : getCanvasObjByName('input_vaos_cph_p'); 
				obj.text = $(this).val();
				canvas.renderAll();
			});
		</script>
</div>
<div class="col-md-12 col-sm-3 collapse iop extra-tools-div">
	<div class="form-inline">
		<span class="fa fa-ellipsis-v"></span>
		<label class="label label-info" id="IOP_OD">IOP_OD (mmHg)</label>
		<div class="form-group"><input type="range" class="iop-slider" name="" min="0" max="50" value="0" label="IOP_OD"></div>
	</div>
</div>
<div class="col-md-12 col-sm-3 collapse iop extra-tools-div">
	<div class="form-inline">
		<span class="fa fa-ellipsis-v"></span>
		<label class="label label-info" id="IOP_OS">IOP_OS (mmHg)</label>
		<div class="form-group"><input type="range" class="iop-slider" name="" min="0" max="50" value="0" label="IOP_OS"></div>
	</div>
</div>
<script type="text/javascript">
	$('.iop-slider').on('input change', function() {
		// console.log($(this).attr('label') + ' ' + $(this).val());
		$('#' + $(this).attr('label')).text($(this).attr('label') + ' ' + $(this).val() + ' (mmHg)');
	});
	$('.iop-slider').change(function() {
		// $('#' + $(this).attr('label')).text($(this).attr('label') + ' (mmHg)');
		if (!getCanvasObjByName($(this).attr('label'))) {
			canvas.add(new fabric.Text($(this).attr('label') + ' ' + $(this).val() + ' mmHg', {
				fontSize: 10,
				top: 200,
				left: 200,
				fill: 'black',
				name: $(this).attr('label')
			}));
			// console.log($(this).attr('label') + ' ' + $(this).val() + ' mmHg -- new');
		} else {
			getCanvasObjByName($(this).attr('label')).text = $(this).attr('label') + ' ' + $(this).val() + ' mmHg';
			canvas.renderAll();
			// console.log($(this).attr('label') + ' ' + $(this).val() + ' mmHg -- old');
		}
	});
</script>
<div class="col-md-12 col-sm-3 collapse ptosis extra-tools-div">
	<div class="form-inline">
		<span class="fa fa-ellipsis-v"></span>
		<label class="label label-info" id="ptosis_label">ptosis (mm)</label>
		<div class="form-group"><input type="range" name="ptosis" min="-10" max="10" value="0"></div>
	</div>
</div>
<script type="text/javascript">
	$('input[name=ptosis]').on('input change', function() {
		// console.log($(this).attr('label') + ' ' + $(this).val());
		if ($(this).val() > 0)
			$('#ptosis_label').text('ptosis +' + $(this).val() + ' mm');
		else
			$('#ptosis_label').text('ptosis ' + $(this).val() + ' mm');
	});
	
	$('input[name=ptosis]').change(function() {
		var closeEye = 1545;
		var openEye = 1370;
		var stepLid = (closeEye - openEye) / 20;
		var top = openEye + ((closeEye - openEye) / 2) + stepLid * $(this).val();
		if (!getCanvasObjByName('lid')) {
			var circle = new fabric.Circle({
				name: 'lid',
				radius: 600,
				left: 953,
				top: 1457.5,
				startAngle: Math.PI * 0.35,
				endAngle: Math.PI * 0.65,
				angle: 180,
				stroke: '#000',
				strokeWidth: 1,
				fill: ''
			});
			canvas.add(circle);
		}
		getCanvasObjByName('lid').animate('top', top, {
			onChange: canvas.renderAll.bind(canvas),
			duration: 1000,
			easing: fabric.util.ease.easeInBounce
		});

	});
</script>
<div class="col-md-12 col-sm-12 collapse extra-tools-div" id="disc_eye_side_div"> <!-- Select Disc OD/OS + VA mode -->
	<span class="fa fa-ellipsis-v"></span>
	<div class="btn-group" role="group">
		<button class="btn btn-default btn-xs disc-eye-side" type="button">Right</button>
		<button class="btn btn-default btn-xs disc-eye-side" type="button">Left</button>
		<button class="btn btn-default btn-xs disc-eye-side" type="button">Both</button>
	</div>
</div>
<script type="text/javascript">
	$('.disc-eye-side').click(function() {
		$('.disc-eye-side').removeClass('active');
		$('.disc-eye-side').removeClass('btn-success');
		$('.disc-eye-side').addClass('btn-default');

		$(this).addClass('active');
		$(this).addClass('btn-success');

		if ($(this).text() == 'Both') {
			if ($('select[name=exam]').val() == 'Disc')
				setCanvasOverlayImage('/assets/images/drawings/ophthalmology/exam_disc_both_CD2.svg', 0.6);
			else
				setCanvasOverlayImage('/assets/images/drawings/ophthalmology/operation_phacoemulsification_Both_P6.svg', 0.6);
		} else {
			if ($('select[name=exam]').val() == 'Disc')
				setCanvasOverlayImage('/assets/images/drawings/ophthalmology/exam_disc_single_CD1.svg', 0.6);
			else
				setCanvasOverlayImage('/assets/images/drawings/ophthalmology/operation_phacoemulsification_P4.svg', 0.6);
		}
	});
</script>

<div class="col-md-12 col-sm-12 collapse extra-tools-div" id="retina_tools_div">
	<div class="col-md-12 col-sm-2 extra-tools-div">
		<span class="fa fa-ellipsis-v"></span>
		<button class="btn btn-default btn-xs retina-tools" id="btn_dot_hemorrhage" type="button">Dot Hemorrhage</button>
	</div>
	<div class="col-md-12 col-sm-2 extra-tools-div">
		<span class="fa fa-ellipsis-v"></span>
		<button class="btn btn-default btn-xs retina-tools" id="btn_boat_hemorrhage" type="button">Boat Hemorrhage</button>
	</div>
	<div class="col-md-12 col-sm-2 extra-tools-div">
		<span class="fa fa-ellipsis-v"></span>
		<button class="btn btn-default btn-xs retina-tools" id="btn_microaneurysm" type="button">Microaneurysm</button>
	</div>
	<div class="col-md-12 col-sm-2 extra-tools-div">
		<span class="fa fa-ellipsis-v"></span>
		<button class="btn btn-default btn-xs retina-tools" id="btn_cotton_wool" type="button">Cotton wool</button>
	</div>
	<div class="col-md-12 col-sm-2 extra-tools-div">
		<span class="fa fa-ellipsis-v"></span>
		<button class="btn btn-default btn-xs retina-tools" id="btn_hard_exudate" type="button">Hard exudate</button>
	</div>
	<div class="col-md-12 col-sm-2 extra-tools-div">
		<span class="fa fa-ellipsis-v"></span>
		<button class="btn btn-default btn-xs retina-tools" id="btn_irma" type="button">IRMA</button>
	</div>
</div>
<script type="text/javascript">
	$('#btn_irma').click(function() {
		$('.retina-tools').removeClass('active');
		$(this).addClass('active');
		$('#select_mode').click();
		canvas.on('mouse:up', function(options) {
			if (!options.target && $('.retina-tools.active').text() == 'IRMA') {
				var pointer = canvas.getPointer(options.e);
				addIRMA(pointer.y, pointer.x);
			} 
		});
	});

	$('#btn_hard_exudate').click(function() {
		$('.retina-tools').removeClass('active');
		$(this).addClass('active');
		$('#paint_mode').click();
		canvas.freeDrawingBrush.color = 'rgb(244, 250, 88)';
		$('input[name=line_width]').val(20);
		canvas.freeDrawingBrush.width = 20;
		textSize = canvas.freeDrawingBrush.width;
		if (canvas.__eventListeners) canvas.__eventListeners["mouse:up"] = [];
	});

	$('#btn_cotton_wool').click(function() {
		$('.retina-tools').removeClass('active');
		$(this).addClass('active');
		$('#paint_mode').click();
		canvas.freeDrawingBrush.color = 'rgb(255, 255, 255)';
		$('input[name=line_width]').val(20);
		canvas.freeDrawingBrush.width = 20;
		textSize = canvas.freeDrawingBrush.width;
		if (canvas.__eventListeners) canvas.__eventListeners["mouse:up"] = [];
	});

	$('#btn_microaneurysm').click(function() {
		$('.retina-tools').removeClass('active');
		$(this).addClass('active');
		$('#paint_mode').click();
		canvas.freeDrawingBrush.color = 'rgb(0, 255, 0)';
		$('input[name=line_width]').val(20);
		canvas.freeDrawingBrush.width = 20;
		textSize = canvas.freeDrawingBrush.width;
		if (canvas.__eventListeners) canvas.__eventListeners["mouse:up"] = [];
	});

	$('#btn_boat_hemorrhage').click(function() {
		$('.retina-tools').removeClass('active');
		$(this).addClass('active');
		$('#paint_mode').click();
		canvas.freeDrawingBrush.color = 'rgb(154, 46, 254)';
		$('input[name=line_width]').val(20);
		canvas.freeDrawingBrush.width = 20;
		textSize = canvas.freeDrawingBrush.width;
		if (canvas.__eventListeners) canvas.__eventListeners["mouse:up"] = [];
	});

	$('#btn_dot_hemorrhage').click(function() {
		$('.retina-tools').removeClass('active');
		$(this).addClass('active');
		$('#paint_mode').click();
		canvas.freeDrawingBrush.color = 'rgb(255, 0, 0)';
		$('input[name=line_width]').val(10);
		canvas.freeDrawingBrush.width = 10;
		textSize = canvas.freeDrawingBrush.width;
if (canvas.__eventListeners) canvas.__eventListeners["mouse:up"] = [];
	});
	
</script>

<script type="text/javascript">
	var eyeSide = 'od'; // Global.
	var lastODMode;
	var lastOSMode;
	var filePath;

	$('.eye-side').click(function() {
		$('.eye-side').removeClass('active');
		$(this).addClass('active');
		switch ($('select[name=exam]').val()) {
			case 'VA Admit' :
			case 'VA D/C' :
				
				var lastMode = (eyeSide == 'od') ? lastODMode : lastOSMode;
				$('select[name=va_mode]').val(lastMode);
				if (lastMode == 'ETDRS' || lastMode == 'Snellen') {
					$('.va_input').collapse('show');
				} else {
					$('.va_input').collapse('hide');
				}
				$('.va_select_input').val('');
				break;
			case 'Lid':
				if (!getCanvasObjByName('eyeSidelebel')) {

				} else {
					getCanvasObjByName('eyeSidelebel').text = (eyeSide == 'od') ? 'Right' : 'Left';
					canvas.renderAll();
				}
				break;
			default:
				console.log('default');
		}
	}); // Select OD/OS.

	$('select[name=va_mode]').change(function() {
		var previousOject = (eyeSide == 'od') ? getCanvasObjByName('vaod_mode') : getCanvasObjByName('vaos_mode');
		if (previousOject)
			canvas.remove(previousOject);
		else
			removeVAMatrix();
		switch ($(this).val()) {
			case 'ETDRS' :
			case 'Snellen' :
				$('.va_input').collapse('show');
				if (eyeSide == 'od') {
					initVAMatrix('vaod');
					$('#va_label').text('VAOD');
					$('#va_p_label').text('VAOD_P');
					$('#va_cph_label').text('VAOD_cPH');
					$('#va_cph_p_label').text('VAOD_cPH_P');
				} else {
					initVAMatrix('vaos');
					$('#va_label').text('VAOS');
					$('#va_p_label').text('VAOS_P');
					$('#va_cph_label').text('VAOS_cPH');
					$('#va_cph_p_label').text('VAOS_cPH_P');
				}
				break;
			default :
				$('.va_input').collapse('hide');
				var reference = (eyeSide == 'od') ? getCanvasObjByName('label_vaod') : getCanvasObjByName('label_vaos');
				var text = new fabric.Text($(this).val(), {
					fontSize: 20,
					name: 'va' + eyeSide + '_mode',
					selectable: false,
					top: reference.top,
					left: reference.left + reference.width * 1.2,
					textDecoration: 'underline'
				});
				canvas.add(text);		
		}
		(eyeSide == 'od') ? lastODMode = $(this).val() : lastOSMode = $(this).val();
	}); // Select VA Mode.

	$('select[name=va_value]').change(function() {
		var obj =  (eyeSide == 'od') ? getCanvasObjByName('input_vaod') : getCanvasObjByName('input_vaos'); 
		obj.text = $(this).val();
		canvas.renderAll();
	}); // Select VA value.

	function initCanvas() {
		canvas.isDrawingMode = true;
		canvas.freeDrawingBrush.color = 'black';
		canvas.freeDrawingBrush.width = 1;
		canvas.renderAll();
	}

	function clearCanvas() {
		canvas.clear();
		// initVA();
	} // Override clearCnavas();

	function removeVAMatrix() {
		var name = (eyeSide == 'od') ? 'vaod' : 'vaos';
		canvas.remove(getCanvasObjByName('label_' + name + '_6'));
		canvas.remove(getCanvasObjByName('line_divide_' + name));
		canvas.remove(getCanvasObjByName('input_' + name + ''));
		canvas.remove(getCanvasObjByName('input_' + name + '_p'));
		canvas.remove(getCanvasObjByName('label_' + name + '_6_cph'));
		canvas.remove(getCanvasObjByName('line_divide_' + name + '_cph'));
		canvas.remove(getCanvasObjByName('input_' + name + '_cph'));
		canvas.remove(getCanvasObjByName('input_' + name + '_cph_p'));
	} // Remove VA matrix objects based on eye-side selected.

	function initVA() {
		if (canvas.overlayImage) canvas.overlayImage.visible = false;
		if (canvas.backgroundImage) canvas.backgroundImage.visible = false;

		$('.ptosis').collapse('hide');
		$('#disc_eye_side_div').collapse('hide');
		$('#retina_tools_div').collapse('hide');

		$('#odos_div').collapse('show');
		$('select[name=va_mode]').removeAttr('style');
		$('select[name=va_mode]').val('');
		lastODMode = '';
		lastOSMode = '';

		clearCanvas()
		canvasHeight = 300;
		initObjsNo = 7;
		canvas.setHeight(canvasHeight);
		var label_va = new fabric.Text('VA', { // Label "VA".
			fontSize: 50,
			left: 10,
			name: 'label_va',
			fill: 'black',
			selectable: false
		});
		label_va.setTop(canvasHeight/2 - label_va.height/2);
		canvas.add(label_va);

		var line_vaod = new fabric.Line([10, 10, 150, 10], { 	// Line OD.
			left: label_va.left + label_va.width ,
			top: canvasHeight/2 ,
			name: 'line_vaod',
			stroke: 'black',
			angle: -45,
			strokeWidth: 1,
			selectable: false
		});
		canvas.add(line_vaod);

		var line_vaos = new fabric.Line([10, 10, 150, 10], { // Line OS.
			left: label_va.left + label_va.width ,
			top: canvasHeight/2 ,
			name: 'line_vaos',
			stroke: 'black',
			angle: 45,
			strokeWidth: 1,
			selectable: false
		});
		canvas.add(line_vaos);

		var label_vaod = new fabric.Text('O.D.', {  // Label "O.D.".
			fontSize: 20,
			left: line_vaod.left + line_vaod.width * Math.cos(line_vaod.angle * (Math.PI / 180)),
			fill: 'black',
			name: 'label_vaod',
			selectable: false
		});
		label_vaod.setTop(line_vaod.top + line_vaod.width * Math.sin(line_vaod.angle * (Math.PI / 180)) - label_vaod.height);
		canvas.add(label_vaod);

		var label_vaos = new fabric.Text('O.S.', { // Label "O.S."
			fontSize: 20,
			left: line_vaos.left + line_vaos.width * Math.cos(line_vaos.angle * (Math.PI / 180)),
			fill: 'black',
			name: 'label_vaos',
			selectable: false
		});
		label_vaos.setTop(line_vaos.top + line_vaos.width * Math.sin(line_vaos.angle * (Math.PI / 180))); 
		canvas.add(label_vaos);

		var input_vaod_sc = new fabric.Text('SC', { // input OD ~, SC, CC.
			fontSize: 20,
			name: 'input_vaod_sc',
			selectable: false
		});
		input_vaod_sc.setTop(line_vaod.top + line_vaod.width/2 * Math.sin(line_vaod.angle * (Math.PI / 180)) - input_vaod_sc.height);
		input_vaod_sc.setLeft(line_vaod.left + line_vaod.width/2 * Math.cos(line_vaod.angle * (Math.PI / 180)) - input_vaod_sc.width);
		input_vaod_sc.text = '~';
		canvas.add(input_vaod_sc);

		var input_vaos_sc = new fabric.Text('SC', { // input OS ~, SC, CC.
			fontSize: 20,
			name: 'input_vaos_sc',
			selectable: false
		});
		input_vaos_sc.setTop(line_vaos.top + line_vaos.width/2 * Math.sin(line_vaos.angle * (Math.PI / 180)));
		input_vaos_sc.setLeft(line_vaos.left + line_vaos.width/2 * Math.cos(line_vaos.angle * (Math.PI / 180)) - input_vaos_sc.width);
		input_vaos_sc.text = '~';
		canvas.add(input_vaos_sc);

		canvas.on('mouse:up', function(options) {
			if (options.target) {
				if (options.target.name == 'input_vaod_sc' || options.target.name == 'input_vaos_sc') {
					switch (options.target.text) {
						case '~':
							options.target.text = 'SC';
							break;
						case 'SC':
							options.target.text = 'CC';
							break;
						case 'CC':
							options.target.text = '~';
							break;
					}
				} 
			} 
		});

		canvas.on('mouse:over', function(options) {
			if (options.target)
				if (options.target.name == 'input_vaod_sc' || options.target.name == 'input_vaos_sc') {
					canvas.hoverCursor = 'pointer';
				} else if (options.target.type == 'textbox') {
					canvas.hoverCursor = 'text';
				} else if (options.target.selectable) {
					canvas.hoverCursor = 'move';
				} else {
					canvas.hoverCursor = 'default';
				}
		});

		canvas.on('mouse:out', function(options) {
			if (options.target)
				if (options.target.name == 'input_vaod_sc' || options.target.name == 'input_vaos_sc') {
					canvas.hoverCursor = 'default';
				}
		});
	} // Initiate VA template.

	function initVAMatrix(name) {
		var label_vaod_6 = new fabric.Text('6', {
			fontSize: 20,
			name: 'label_' + name + '_6',
			left: getCanvasObjByName('label_' + name).left + getCanvasObjByName('label_' + name).width * 3,
			top: getCanvasObjByName('label_' + name).top,
			selectable: false
		});
		canvas.add(label_vaod_6);
		var line_divide_vaod = new fabric.Line([10,10,60,10], {
			left: getCanvasObjByName('label_' + name).left + getCanvasObjByName('label_' + name).width * 3,
			top: getCanvasObjByName('label_' + name).top + getCanvasObjByName('label_' + name).height * 2,
			angle: -45,
			strokeWidth: 1,
			stroke: 'black',
			name: 'line_divide_' + name,
			selectable: false
		});
		canvas.add(line_divide_vaod);
		var input_vaod = new fabric.Textbox('~', {
			fontSize: 20,
			name: 'input_' + name,
			top: getCanvasObjByName('line_divide_' + name).top - getCanvasObjByName('label_' + name + '_6').height,
			left: getCanvasObjByName('line_divide_' + name).left + getCanvasObjByName('label_' + name + '_6').width * 3,
			hasBorders: true,
			hasControls: false
		});
		canvas.add(input_vaod);
		var input_vaod_p = new fabric.Textbox('^', {
			fontSize: 15,
			name: 'input_' + name + '_p',
			top: getCanvasObjByName('input_' + name).top - getCanvasObjByName('input_' + name).height / 2,
			left: getCanvasObjByName('input_' + name).left + getCanvasObjByName('input_' + name).width * 2,
			hasBorders: true,
			hasControls: false
		});
		canvas.add(input_vaod_p);

		var label_vaod_6_cph = new fabric.Text('6', {
			fontSize: 20,
			name: 'label_' + name + '_6_cph',
			left: label_vaod_6.left + 200,
			top: label_vaod_6.top,
			selectable: false
		});
		canvas.add(label_vaod_6_cph);
		var line_divide_vaod_cph = new fabric.Line([10,10,60,10], {
			left: getCanvasObjByName('line_divide_' + name).left + 200,
			top: getCanvasObjByName('line_divide_' + name).top,
			name: 'line_divide_' + name + '_cph',
			angle: -45,
			strokeWidth: 1,
			stroke: 'black',
			selectable: false
		});
		canvas.add(line_divide_vaod_cph);
		var input_vaod_cph = new fabric.Textbox('~', {
			fontSize: 20,
			name: 'input_' + name + '_cph',
			top: getCanvasObjByName('input_' + name).top,
			left: getCanvasObjByName('input_' + name).left + 200,
			hasBorders: true,
			hasControls: false
		});
		canvas.add(input_vaod_cph);
		var input_vaod_cph_p = new fabric.Textbox('^', {
			fontSize: 15,
			name: 'input_' + name + '_cph_p',
			top: getCanvasObjByName('input_' + name + '_p').top,
			left: getCanvasObjByName('input_' + name + '_p').left + 200,
			hasBorders: true,
			hasControls: false
		});
		canvas.add(input_vaod_cph_p);
	} // Create VA matrix by side name. Use var name to name object.

	function initLid() {
		if (canvas.overlayImage) canvas.overlayImage.visible = false;
		if (canvas.backgroundImage) canvas.backgroundImage.visible = false;

		canvasHeight = 600;
		initObjsNo = 0;
		canvas.setHeight(canvasHeight);
		clearCanvas();

		$('#odos_div').collapse('hide');
		$('.iop').collapse('hide');
		$('.va_input').collapse('hide');
		$('select[name=va_mode]').css('display', 'none');
		$('#disc_eye_side_div').collapse('hide');
		$('#retina_tools_div').collapse('hide');

		setCanvasOverlayImage('/assets/images/drawings/ophthalmology/operation_phacoemulsification_P4.svg', 0.6)
		
		// var eyeSidelebel = (eyeSide == 'od') ? 'Right' : 'Left';
		// canvas.add(new fabric.Text(eyeSidelebel, {
		// 	name: 'eyeSidelebel',
		// 	// fill: 'black',
		// 	top: 134,
		// 	left: 199,
		// 	fontSize: 30,
		// 	textDecoration: 'underline'
		// }));

		$('.ptosis').collapse('show');
		canvas.add(new fabric.Circle({
			name: 'lid',
			radius: 600,
			left: 953,
			top: 1457.5,
			startAngle: Math.PI * 0.35,
			endAngle: Math.PI * 0.65,
			angle: 180,
			stroke: '#000',
			strokeWidth: 1,
			fill: ''
		}));
	} // Initiate Lid.

	function initCornea() {
		if (canvas.overlayImage) canvas.overlayImage.visible = false;
		if (canvas.backgroundImage) canvas.backgroundImage.visible = false;
		canvasHeight = 600;
		initObjsNo = 0;
		canvas.setHeight(canvasHeight);
		clearCanvas();

		$('.ptosis').collapse('hide');
		$('#odos_div').collapse('hide');
		$('.iop').collapse('hide');
		$('.va_input').collapse('hide');
		$('#retina_tools_div').collapse('hide');

		$('#disc_eye_side_div').collapse('show');
		$('.disc-eye-side').removeClass('active');
		$('.disc-eye-side').removeClass('btn-success');
		$('.disc-eye-side').addClass('btn-default');
	}

	function initDisc() {
		if (canvas.overlayImage) canvas.overlayImage.visible = false;
		if (canvas.backgroundImage) canvas.backgroundImage.visible = false;
		canvasHeight = 600;
		initObjsNo = 0;
		canvas.setHeight(canvasHeight);
		clearCanvas();

		$('.ptosis').collapse('hide');
		$('#odos_div').collapse('hide');
		$('.iop').collapse('hide');
		$('.va_input').collapse('hide');
		$('#retina_tools_div').collapse('hide');

		$('#disc_eye_side_div').collapse('show');
		$('.disc-eye-side').removeClass('active');
		$('.disc-eye-side').removeClass('btn-success');
		$('.disc-eye-side').addClass('btn-default');
	} // Initiate Disc.

	function initRetina() {
		// if (canvas.overlayImage) canvas.overlayImage.visible = false;
		canvasHeight = 600;
		initObjsNo = 0;
		canvas.setHeight(canvasHeight);
		clearCanvas();

		setCanvasOverlayImage('/assets/images/drawings/ophthalmology/exam_retina_overlay.svg', 0.8);
		setCanvasBackgroundImage('/assets/images/drawings/ophthalmology/exam_retina_background.svg', 0.8);

		$('.ptosis').collapse('hide');
		$('#odos_div').collapse('hide');
		$('.iop').collapse('hide');
		$('.va_input').collapse('hide');
		$('#disc_eye_side_div').collapse('hide');

		$('#retina_tools_div').collapse('show');
		$('.retina-tools').removeClass('active');
		$('.retina-tools').removeClass('btn-success');
		$('.retina-tools').addClass('btn-default');
	} // Initiate Retina.

	function addIRMA(top, left) {
		fabric.Image.fromURL('/assets/images/drawings/ophthalmology/exam_irma4.svg', function(img) {
			img.set({
				top: top,
				left: left,
				flipY: fabric.util.getRandomInt(0, 1), // ((fabric.util.getRandomInt(0, 1) == 1) ? true : false),
				flipx: fabric.util.getRandomInt(0, 1), // ((fabric.util.getRandomInt(0, 1) == 1) ? true : false),
				angle: fabric.util.getRandomInt(0, 360)
			});
			img.scale(0.07);
			canvas.add(img);
		});
	}
</script>
@endsection