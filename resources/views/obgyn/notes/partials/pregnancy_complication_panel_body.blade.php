<div class="panel-body">
	<div class="row">
		<div class="col-md-12"><!-- field no_pregnancy_complication type checkbox -->
			<div class="checkbox"><label><input type="checkbox" {{ $note->no_pregnancy_complication ? 'checked' : '' }} name="no_pregnancy_complication" id="no_pregnancy_complication">None</label></div>
		</div>
		<div class="col-md-3"><!-- field pregnancy_complication_Hb_E_trait type checkbox -->
			<div class="checkbox"><label><input class="complication" type="checkbox" {{ $note->pregnancy_complication_Hb_E_trait ? 'checked' : '' }} name="pregnancy_complication_Hb_E_trait">Hemoglobin E trait</label></div>
		</div>
		<div class="col-md-3"><!-- field pregnancy_complication_no_ANC type checkbox -->
			<div class="checkbox"><label><input class="complication" type="checkbox" {{ $note->pregnancy_complication_no_ANC ? 'checked' : '' }} name="pregnancy_complication_no_ANC">No ANC</label></div>
		</div>
		<div class="col-md-6"><!-- field pregnancy_complication_cesarean_labour_pain type checkbox -->
			<div class="checkbox"><label><input class="complication" type="checkbox" {{ $note->pregnancy_complication_cesarean_labour_pain ? 'checked' : '' }} name="pregnancy_complication_cesarean_labour_pain">Previouse cesarean section without labour plain</label></div>
		</div>
		<div class="col-md-3"><!-- field pregnancy_complication_HIV type checkbox -->
			<div class="checkbox"><label><input class="complication" type="checkbox" {{ $note->pregnancy_complication_HIV ? 'checked' : '' }} name="pregnancy_complication_HIV">HIV infection</label></div>
		</div>
		<div class="col-md-3"><!-- field pregnancy_complication_HBV type checkbox -->
			<div class="checkbox"><label><input class="complication" type="checkbox" {{ $note->pregnancy_complication_HBV ? 'checked' : '' }} name="pregnancy_complication_HBV">HBV infection</label></div>
		</div>
		<div class="col-md-3"><!-- field pregnancy_complication_HCV type checkbox -->
			<div class="checkbox"><label><input class="complication" type="checkbox" {{ $note->pregnancy_complication_HCV ? 'checked' : '' }} name="pregnancy_complication_HCV">HCV infection</label></div>
		</div>
		<div class="col-md-12"></div>
		<div class="col-md-12"><!-- field pregnancy_complication_DM type checkbox -->
			<div class="checkbox"><label><input class="complication" type="checkbox" {{ $note->pregnancy_complication_DM ? 'checked' : '' }} name="pregnancy_complication_DM">Diabetes Mellilus</label></div>
		</div>
		<div class="col-md-12 collapse" id="DM_collapse">
			<div class="panel panel-default">
				<div class="panel-heading">Specify Diabetes Mellilus</div>
				<div class="panel-body">
					<div class="form-horizontal">
						<div class="form-group">
							<label class="control-label col-md-2" for="pregnancy_complication_DM_type">DM Type <a role="button" title="Click to reset." class="radio-reset" target="pregnancy_complication_DM_type"><span class="fa fa-remove"></span></a> :</label>
							<div class='col-md-2'><!-- field pregnancy_complication_DM_type type tinyInteger -->
								<label class="radio-inline"><input type="radio" name="pregnancy_complication_DM_type" {{ $note->pregnancy_complication_DM_type == 1 ? 'checked' : '' }} value="1">Type I</label>
							</div>
							<div class='col-md-2'>
								<label class="radio-inline"><input type="radio" name="pregnancy_complication_DM_type" {{ $note->pregnancy_complication_DM_type == 2 ? 'checked' : '' }} value="2">Type II</label>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2" for="pregnancy_complication_DM_DR">DM Complication :</label>
							<div class="col-md-1"><!-- field pregnancy_complication_DM_DR type checkbox -->
								<div class="checkbox"><label><input class="dm-check" type="checkbox" {{ $note->pregnancy_complication_DM_DR ? 'checked' : '' }} name="pregnancy_complication_DM_DR">DR</label></div>
							</div>
							<div class="col-md-2"><!-- field pregnancy_complication_DM_nephropathy type checkbox -->
								<div class="checkbox"><label><input class="dm-check" type="checkbox" {{ $note->pregnancy_complication_DM_nephropathy ? 'checked' : '' }} name="pregnancy_complication_DM_nephropathy">Nephropathy</label></div>
							</div>
							<div class="col-md-2"><!-- field pregnancy_complication_DM_neuropathy type checkbox -->
								<div class="checkbox"><label><input class="dm-check" type="checkbox" {{ $note->pregnancy_complication_DM_neuropathy ? 'checked' : '' }} name="pregnancy_complication_DM_neuropathy">Neuropathy</label></div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2" for="">DM On :</label>
							<div class="col-md-2"><!-- field pregnancy_complication_DM_on_diet type checkbox -->
								<div class="checkbox"><label><input class="dm-check" type="checkbox" {{ $note->pregnancy_complication_DM_on_diet ? 'checked' : '' }} name="pregnancy_complication_DM_on_diet">Diet control</label></div>
							</div>
							<div class="col-md-3"><!-- field pregnancy_complication_DM_on_oral_meds type checkbox -->
								<div class="checkbox"><label><input class="dm-check" type="checkbox" {{ $note->pregnancy_complication_DM_on_oral_meds ? 'checked' : '' }} name="pregnancy_complication_DM_on_oral_meds">Oral medications</label></div>
							</div>
							<div class="col-md-2"><!-- field pregnancy_complication_DM_on_insulin type checkbox -->
								<div class="checkbox"><label><input class="dm-check" type="checkbox" {{ $note->pregnancy_complication_DM_on_insulin ? 'checked' : '' }} name="pregnancy_complication_DM_on_insulin">Insulin</label></div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-12"><!-- field specificed_pregnancy_complication_DM type string -->
								<input class="form-control" type="text" name="specificed_pregnancy_complication_DM" value="{{ $note->specificed_pregnancy_complication_DM }}" id="specificed_pregnancy_complication_DM" placeholder="Specify DM.">
							</div>
						</div>			
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-3"><!-- field pregnancy_complication_HT type checkbox -->
			<div class="checkbox"><label><input class="complication" type="checkbox" {{ $note->pregnancy_complication_HT ? 'checked' : '' }} name="pregnancy_complication_HT">Hypertension</label></div>
		</div>
		<div class="col-md-9"><!-- field specificed_pregnancy_complication_HT type string -->
			<input class="form-control complication-text" type="text" value="{{ $note->specificed_pregnancy_complication_HT }}" name="specificed_pregnancy_complication_HT" placeholder="Specify HT.">
		</div>
		<div class="col-md-12">
			<div class="form-group"><!-- field other_pregnancy_complication type string -->
			<textarea name="other_pregnancy_complication" id="other_pregnancy_complication" class="form-control text_area_feedback complication-text" rows="1" maxlength="255" placeholder="Specify other complication. 255 characters max.">{{ $note->other_pregnancy_complication }}</textarea>
			<div id="other_pregnancy_complication_feedback" style="color:#b3b3b3"></div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
function clearDM() {
	$('.dm-check').prop('checked', false);
	$('#specificed_DM').val('');
	$('input[name=pregnancy_complication_DM_type]').prop('checked', false);
	$('#DM_collapse').collapse('hide');
} // clear complication DM associate data.
$('#no_pregnancy_complication').click(function () {
	if ($(this).prop('checked')) {
		$('.complication').prop('checked', false);
		clearDM();
		$('.complication-text').val('');
	}
}); // Clear all complication data if select None.
$('.complication').click(function () {
	if ($(this).prop('checked')) {
		$('#no_pregnancy_complication').prop('checked', false);
		if ($(this).prop('name') == 'pregnancy_complication_DM') {
			$('#DM_collapse').collapse('show');
		}
	} else {
		if ($(this).prop('name') == 'pregnancy_complication_DM') {
			clearDM();
		}
	}
}); // Add deselection on None to all checkbox complications.
$('.complication-text').change(function () {
	if ($(this).val() != '') {
		$('#no_pregnancy_complication').prop('checked', false);
	}
}); // Add deselection on None to all text complications.
$('input[name=pregnancy_complication_HT]').click(function() {
	if ($(this).prop('checked'))
		$('input[name=specificed_pregnancy_complication_HT]').focus();
	else
		$('input[name=specificed_pregnancy_complication_HT]').val('');
}); // pregnancy_complication_HT if check move cursor to its text. If not clear its text.
</script>