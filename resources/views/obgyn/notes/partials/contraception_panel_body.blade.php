<div class="panel-body row">
	<div class="form-horizontal">
		<div class="col-md-12"><!-- field contraception type tinyInteger -->
			<div class="form-group">
				<label class="col-md-2 control-label" for="contraception">Contraception <a role="button" title="Click to reset." class="radio-reset" target="contraception"><span class="fa fa-remove"></span></a> :</label>
				<div class="col-md-1">
					<label class="radio-inline"><input type="radio" name="contraception" {{ $note->contraception === '0' ? 'checked' : '' }} value="0">No</label>
				</div>
				<div class="col-md-1">
					<label class="radio-inline"><input type="radio" name="contraception" {{ $note->contraception == 1 ? 'checked' : '' }} value="1">TS</label>
				</div>
				<div class="col-md-1">
					<label class="radio-inline"><input type="radio" name="contraception" {{ $note->contraception == 2 ? 'checked' : '' }} value="2">DMPA</label>
				</div>
				<div class="col-md-1">
					<label class="radio-inline"><input type="radio" name="contraception" {{ $note->contraception == 3 ? 'checked' : '' }} value="3">IUD</label>
				</div>
				<div class="col-md-3">
					<label class="radio-inline"><input type="radio" name="contraception" {{ $note->contraception == 4 ? 'checked' : '' }} value="4">Oral contraceptive pill</label>
				</div>
				<div class="col-md-1">
					<label class="radio-inline"><input type="radio" name="contraception" {{ $note->contraception == 99 ? 'checked' : '' }} value="99" other="true">Other</label>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-12 collapse" id="other_contraception_collapse"><!-- field other_contraception type string -->
		<div class="form-group">
			<textarea name="other_contraception" id="other_contraception" class="form-control text_area_feedback" rows="1"  maxlength="255" placeholder="Specify other contraception. 255 characters max.">{{ $note->other_contraception }}</textarea>
				<div id="other_contraception_feedback" style="color:#b3b3b3"></div>
		</div>
	</div>
</div>
<script type="text/javascript">
$('input[name=contraception]').click(function () {
	if ($(this).attr('other')) {
		$('#other_contraception_collapse').collapse('show');
		$('#other_contraception').focus();
	} else {
		$('#other_contraception').val('');
		$('#other_contraception_collapse').collapse('hide');
	}
}); // Show/hide other_contraception

$('a[target=contraception]').click(function() {
	$('#other_contraception').val('');
	$('#other_contraception_collapse').collapse('hide');
});
</script>