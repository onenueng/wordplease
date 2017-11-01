<div class="form-inline"><!-- size and text tools -->
	<span class="fa fa-ellipsis-v"></span>
	<div class="form-group"><input type="range" name="line_width" value="1" min="1" max="50"></div>
	<span class="label label-info" id="line_width_label">size: 1</span>
	<script type="text/javascript">
		$('input[name=line_width]').on('input change',function () {
			$('#line_width_label').text('size: ' + $(this).val()); // update label.
			canvas.freeDrawingBrush.width = parseInt($(this).val()); // set brush width.
			textSize = canvas.freeDrawingBrush.width; // also set text font size.
			updateSizeColor();
		}); // line width slider.
	</script>

	<span class="fa fa-ellipsis-v"></span>
	<div class="btn btn-default btn-xs text-mode" on="0" id="text_bold"><span class="fa fa-bold"></span></div>
	<div class="btn btn-default btn-xs text-mode" on="0" id="text_italic"><span class="fa fa-italic"></span></div>
	<div class="btn btn-default btn-xs text-mode" on="0" id="text_underline"><span class="fa fa-underline"></span></div>
	<div class="btn btn-primary btn-xs" id="add_textbox"><span class="fa fa-commenting-o"></span></div>
	<span class="fa fa-ellipsis-v"></span>
	<div class="input-group input-group-sm">
		<input class="form-control" type="text" name="label_text" placeholder="label here...">
		<span class="input-group-btn"><button class="btn btn-primary" id="add_tag"><span class="fa fa-tag"></span></button></span>
	</div>
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
				fontSize: textSize,
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
					fontSize: textSize,
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