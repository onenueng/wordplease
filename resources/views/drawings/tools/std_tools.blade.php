<!-- Interact Mode -->
<span class="fa fa-ellipsis-v fa-inverse"></span>
<div class="btn-group" role="group">
	<button type="button" class="btn btn-success btn-xs active mode-btn" id="paint_mode"><span class="fa fa-paint-brush"></span></button>	
	<button type="button" class="btn btn-default btn-xs mode-btn" id="select_mode"><span class="fa fa-hand-grab-o"></span></button>
</div>
<span class="fa fa-ellipsis-v fa-inverse"></span>
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

<span class="fa fa-ellipsis-v fa-inverse"></span><!-- Basic tools -->
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
<!-- Color selector -->
<span class="fa fa-ellipsis-v fa-inverse"></span>
<span class="label color-plalet selector" role="button" style="background-color: rgb(1,170,173);">c</span>
<span class="label color-plalet selector" role="button" style="background-color: rgb(0,165,96);">c</span>
<span class="label color-plalet selector" role="button" style="background-color: rgb(112,190,68);">c</span>
<span class="label color-plalet selector" role="button" style="background-color: rgb(255,222,23);">c</span>
<span class="label color-plalet selector" role="button" style="background-color: rgb(249,166,28);">c</span>
<span class="label color-plalet selector" role="button" style="background-color: rgb(246,129,33);">c</span>
<span class="label color-plalet selector" role="button" style="background-color: rgb(238,62,62);">c</span>
<span class="label color-plalet selector" role="button" style="background-color: rgb(237,28,36);">c</span>
<span class="label color-plalet selector" role="button" style="background-color: rgb(163,36,143);">c</span>
<span class="label color-plalet selector" role="button" style="background-color: rgb(92,46,145);">c</span>
<span class="label color-plalet selector" role="button" style="background-color: rgb(33,64,155);">c</span>
<span class="label color-plalet selector" role="button" style="background-color: rgb(1,102,180);">c</span>
<script type="text/javascript">
	$('.color-plalet.selector').click(function() {
		$('.color-plalet.selector.active').removeClass('active');
		$(this).addClass('active');
		canvas.freeDrawingBrush.color = $(this).css('background-color');
		pickedColor = $(this).css('background-color');
		updateSizeColor(); // function on drawing.blade.php.
		updateDrawingsSizeColor();
	});
</script><!-- Color selector -->
<!-- Delete tools -->
<span class="fa fa-ellipsis-h fa-inverse"></span>
<div class="btn btn-warning btn-xs" id="delete_selected"><span class="fa fa-trash"></span></div>
<div class="btn btn-default btn-xs" id="undelete"><span class="fa fa-recycle"></span></div>
<div class="btn btn-danger btn-xs" onclick="clearCanvas();"><span class="fa fa-file-o"></span></div>
<script type="text/javascript">
	$('#delete_selected').click(function() {
		if (canvas.size() > initObjsNo) {
			if(canvas.getActiveGroup()) { // Case Group selected.
				var count = 0;
				lastDeleted = [];
				lastDeletedTopOffset = canvas.getActiveGroup().top + canvas.getActiveGroup().height/2;
				lastDeletedLeftOffset = canvas.getActiveGroup().left + canvas.getActiveGroup().width/2;
				canvas.getActiveGroup().forEachObject(function(obj) {
					lastDeleted[count] = obj;
					canvas.remove(obj);
					count++;
				});
  			canvas.discardActiveGroup().renderAll(); // remove select control.
			}	 else { // Case Object selected.
				lastDeleted = canvas.getActiveObject(); 
				canvas.remove(canvas.getActiveObject());
			}				
		}
	});

	$('#undelete').click(function() {
		if (lastDeleted) {
			if (!Array.isArray(lastDeleted)) { // Check Object or Group.
				canvas.add(lastDeleted);
			} else { // case group.
				for (i = 0; i < lastDeleted.length; i++) {
					/**
					* If just add objects to canvas then no controls visible, not sure why.
					* So, Clone object before add to canvas.
					*/
					if (fabric.util.getKlass(lastDeleted[i].type).async) {
						lastDeleted[i].clone(function(clone) {
							canvas.add(clone.set({left: lastDeleted[i].left + lastDeletedLeftOffset, top: lastDeleted[i].top + lastDeletedTopOffset}));
						});	
					} else {
						canvas.add(lastDeleted[i].clone().set({left: lastDeleted[i].left + lastDeletedLeftOffset, top: lastDeleted[i].top + lastDeletedTopOffset}));
					}
				}
			}
			lastDeleted = false;
		}
	});	
</script><!-- Delete tools -->
<div class="collapse" style="margin-top: 5px; padding-bottom: 5px;" id="arrow-btns">
	<div class="form-group" style="margin-bottom: 0px;"><!-- Arrow buttons -->
		<span class="fa fa-ellipsis-v"></span>
		<div class="btn-group" role="group">
			<button type="button" class="btn btn-default btn-xs move-btn" id=""><span class="fa fa-lg fa-location-arrow fa-flip-horizontal"></span></button>
			<button type="button" class="btn btn-success btn-xs move-btn" id="move_up"><span class="fa fa-lg fa-arrow-up"></span></button>
			<button type="button" class="btn btn-default btn-xs move-btn" id=""><span class="fa fa-lg fa-location-arrow"></span></button>
		</div>
		<br/>
		<span class="fa fa-ellipsis-v"></span>
		<div class="btn-group" role="group">
			<button type="button" class="btn btn-success btn-xs move-btn" id="move_left"><span class="fa fa-lg fa-arrow-left"></span></button>
			<button type="button" class="btn btn-default btn-xs move-btn" id=""><span class="fa fa-lg fa-circle-o"></span></button>
			<button type="button" class="btn btn-success btn-xs move-btn" id="move_right"><span class="fa fa-lg fa-arrow-right"></span></button>
		</div>
		<br/>
		<span class="fa fa-ellipsis-v"></span>
		<div class="btn-group" role="group">
			<button type="button" class="btn btn-default btn-xs move-btn" id=""><span class="fa fa-lg fa-location-arrow fa-rotate-180"></span></button>
			<button type="button" class="btn btn-success btn-xs move-btn" id="move_down"><span class="fa fa-lg fa-arrow-down"></span></button>
			<button type="button" class="btn btn-default btn-xs move-btn" id=""><span class="fa fa-lg fa-location-arrow fa-flip-vertical"></span></button>
		</div>
	</div>
	<script type="text/javascript">
		$('.move-btn').click(function() {
			if (canvas.getActiveGroup() || canvas.getActiveObject()) {
				var options;
				if (canvas.getActiveGroup()) {
					options = canvas.getActiveGroup();
				} else {
					options = canvas.getActiveObject();
				}
				switch ($(this).prop('id')) {
					case 'move_up' :
						options.top = options.top - 1;
						break;
					case 'move_down' :
						options.top = options.top + 1;
						break;
					case 'move_left' :
						options.left = options.left - 1;
						break;
					case 'move_right' :
						options.left = options.left + 1;
						break;
				}
				canvas.renderAll();
			}
		});
	</script><!-- Arrow buttons -->

</div>
<div class="form-inline" style="margin-top: 5px;"><!-- size and text tools -->
	<span class="fa fa-ellipsis-v fa-inverse"></span>
	<div class="form-group"><input type="range" name="line_width" value="1" min="1" max="50"></div>
	<span class="label label-info" id="line_width_label">size: 1</span>
	<script type="text/javascript">
		$('input[name=line_width]').on('input change',function () {
			$('#line_width_label').text('size: ' + $(this).val()); // update label.
			canvas.freeDrawingBrush.width = parseInt($(this).val()); // set brush width.
			textSize = canvas.freeDrawingBrush.width; // also set text font size.
			updateSizeColor();
			updateDrawingsSizeColor();
		}); // line width slider.
	</script>

	<span class="fa fa-ellipsis-v fa-inverse"></span>
	<div class="btn btn-default btn-xs text-mode" on="0" id="text_bold"><span class="fa fa-bold"></span></div>
	<div class="btn btn-default btn-xs text-mode" on="0" id="text_italic"><span class="fa fa-italic"></span></div>
	<div class="btn btn-default btn-xs text-mode" on="0" id="text_underline"><span class="fa fa-underline"></span></div>
	<div class="btn btn-primary btn-xs" id="add_textbox"><span class="fa fa-commenting-o"></span></div>
	<span class="fa fa-ellipsis-v fa-inverse"></span>
	<div class="input-group input-group-sm">
		<input class="form-control" type="text" name="label_text" placeholder="label here...">
		<span class="input-group-btn"><button class="btn btn-primary" id="add_tag"><span class="fa fa-tag"></span></button></span>
	</div>
	<span class="fa fa-ellipsis-h fa-inverse"></span>
	<label class="label label-success" id="drawing_label"></label>
	<span class="btn btn-danger btn-xs"><span class="fa fa-remove"></span></span>
	<span class="fa fa-ellipsis-v fa-inverse"></span>
	<span class="btn btn-primary btn-xs" onclick="$('#top-tool-bar').css('display', 'none');">Hide tools</span>
	<script type="text/javascript">
		$('.text-mode').click(function() {
			var property;
			var propertyValue;
			if ($(this).attr('on') == 1) { // off.
				$(this).removeClass('active');
				$(this).attr('on', 0);
				switch ($(this).prop('id')) {
					case 'text_bold':
						property = 'fontWeight';
						textWeight = 'normal';
						propertyValue = textWeight;
						break;
					case 'text_italic':
						property = 'fontStyle';
						textStyle = 'normal';
						propertyValue = textStyle;
						break;
					case 'text_underline':
						property = 'textDecoration';
						textDecoration = 'normal';
						propertyValue = textDecoration;
						break;
				}
				textWeight = 'normal';
				if (canvas.getActiveObject() && (canvas.getActiveObject().type == 'text' || canvas.getActiveObject().type == 'textbox')) {
					canvas.getActiveObject().set(property, propertyValue);
					canvas.renderAll();
				} else if (canvas.getActiveGroup()) {
					canvas.getActiveGroup().forEachObject(function(obj) {
						if (obj.type == 'text' || obj == 'textbox') {
							obj.set(property, propertyValue);
							canvas.renderAll();
						}
					});
				}
			} else { // on.
				$(this).addClass('active');
				$(this).attr('on', 1);
				switch ($(this).prop('id')) {
					case 'text_bold':
						property = 'fontWeight';
						textWeight = 'bold';
						propertyValue = textWeight;
						break;
					case 'text_italic':
						property = 'fontStyle';
						textStyle = 'italic';
						propertyValue = textStyle;
						break;
					case 'text_underline':
						property = 'textDecoration';
						textDecoration = 'underline';
						propertyValue = textDecoration;
						break;
				}
				if (canvas.getActiveObject() && (canvas.getActiveObject().type == 'text' || canvas.getActiveObject().type == 'textbox')) {
					canvas.getActiveObject().set(property, propertyValue);
					canvas.renderAll();
				} else if (canvas.getActiveGroup()) {
					canvas.getActiveGroup().forEachObject(function(obj) {
						if (obj.type == 'text' || obj == 'textbox') {
							obj.set(property, propertyValue);
							canvas.renderAll();
						}
					});
				}
			}
		});
		$('#add_textbox').click(function() {
			var textbox = new fabric.Textbox('specify', {
				fontSize: (textSize > 10) ? textSize : 10,
				left: canvasWidth, // full width. 
				top: canvasHeight/2, // half height.
				fill: pickedColor,
				fontWeight: textWeight,
				fontStyle: textStyle,
				textDecoration: textDecoration
			});
			animateAddingObject(textbox); // function on drawing.blade.php.
			$('#select_mode').click();
		});

		$('#add_tag').click(function() {
			if ($('input[name=label_text]').val() != '') {
				var tag = new fabric.Text($('input[name=label_text]').val(), {
					fontSize: (textSize > 10) ? textSize : 10,
					left: canvasWidth, // full width. 
					top: canvasHeight/2, // half height.
					fill: pickedColor,
					fontWeight: textWeight,
					fontStyle: textStyle,
					textDecoration: textDecoration
				});
				animateAddingObject(tag); // function on drawing.blade.php.
				$('#select_mode').click();
				$('input[name=label_text]').val('');
			}
		});
	</script>
</div><!-- size and text tools -->