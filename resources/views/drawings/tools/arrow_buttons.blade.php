<div class="form-group"><!-- Arrow buttons -->
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
				