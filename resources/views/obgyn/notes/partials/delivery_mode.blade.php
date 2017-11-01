<div class="panel panel-default"><!-- Delivery mode -->
	<div class="panel-heading">Mode of Delivery <a role="button" title="Click to reset." class="radio-reset" target="delivery_mode"><span class="fa fa-remove"></span></a></div>
	<div class="panel-body row">
		<div class="col-md-12"><!-- field delivery_mode type tinyIntegereger -->
			<div class="form-group">
				<label class="radio-inline"><input type="radio" name="delivery_mode" {{ $note->delivery_mode == 1 ? 'checked' : '' }} value="1">Spont Vertex Delivery</label>
				<label class="radio-inline"><input type="radio" name="delivery_mode" {{ $note->delivery_mode == 2 ? 'checked' : '' }} value="2">F/E</label>
				<label class="radio-inline"><input type="radio" name="delivery_mode" {{ $note->delivery_mode == 3 ? 'checked' : '' }} value="3">VIE</label>
				<label class="radio-inline"><input type="radio" name="delivery_mode" {{ $note->delivery_mode == 4 ? 'checked' : '' }} value="4">Breech Assigting</label>
				<label class="radio-inline"><input type="radio" name="delivery_mode" {{ $note->delivery_mode == 5 ? 'checked' : '' }} value="5">C/S with medical reason</label>
				<label class="radio-inline"><input type="radio" name="delivery_mode" {{ $note->delivery_mode == 6 ? 'checked' : '' }} value="6">C/S without medical reason</label>
				<label class="radio-inline"><input type="radio" name="delivery_mode" {{ $note->delivery_mode == 99 ? 'checked' : '' }} value="99" other="true">Other</label>
			</div>
		</div>
		<div class="col-md-12 collapse" id="other_delivery_mode_collapse"><!-- field other_delivery_mode type string -->
			<div class="form-group">
				<textarea name="other_delivery_mode" id="other_delivery_mode" class="form-control text_area_feedback" rows="1" maxlength="255" placeholder="Specify other delivery mode. 255 characters max."></textarea>
				<div id="other_delivery_mode_feedback" style="color:#b3b3b3"></div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$('input[name=delivery_mode]').click(function() {
	if ($(this).attr('other')) {
		$('#other_delivery_mode_collapse').collapse('show');
		$('#other_delivery_mode').focus();
	} else {
		$('#other_delivery_mode').val('');
		$('#other_delivery_mode_collapse').collapse('hide');
	}
});// Show/hide other delivery mode.
$('a[target=delivery_mode]').click(function() {
	$('#other_delivery_mode').val('');
	$('#other_delivery_mode_collapse').collapse('hide');
});
</script>