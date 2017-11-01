<div class="col-md-12 col-sm-12"> <!-- Select OD/OS + VA mode -->
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
<div class="col-md-12 col-sm-3 collapse va_input"><!-- Select VA value -->
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
<div class="col-md-12 col-sm-3 collapse va_input"><!-- Select VA_P value -->
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
<div class="col-md-12 col-sm-3 collapse va_input">
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
<div class="col-md-12 col-sm-3 collapse va_input">
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
<script type="text/javascript">
	var eyeSide = 'od'; // Global.
	var lastODMode;
	var lastOSMode;

	$('.eye-side').click(function() {
		$('.eye-side').removeClass('active');
		$(this).addClass('active');
		var lastMode = (eyeSide == 'od') ? lastODMode : lastOSMode;
		$('select[name=va_mode]').val(lastMode);
		if (lastMode == 'ETDRS' || lastMode == 'Snellen') {
			$('.va_input').collapse('show');
		} else {
			$('.va_input').collapse('hide');
		}
		$('.va_select_input').val('');
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

	function clearCanvas() {
		canvas.clear();
		initVA();
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

	function initCanvas() {
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
				// else if (options.target.type == 'textbox') {
				// 	options.target.enterEditing();
				// 	options.target.selectAll();
				// }
			} 
		});

		// canvas.on('text:editing:entered', function(options) {
		// 	if (options.target)
		// 		if (options.target.type == 'textbox') {
		// 			options.target.selectAll();
		// 			// console.log('cleared editing');
		// 		}
		// }); // prevent tablet bring up Keyboard due to .enterEditing().

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
	}

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
	}

</script>