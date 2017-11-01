<div class="form-horizontal row"><!-- GPA GA-->
	<div class="col-md-2"><!-- field G type tinyInteger -->
		<div class="form-group">
			<label class="col-md-4 control-label" for="G">G :</label>
			<div class="col-md-8">
				<div class="input-group">
					<span class="input-group-addon"><span class="fa fa-times-circle-o"></span></span>
					<input class="form-control" type="text" name="G" id="G" value="{{ old('G') ? old('G') : $note->G }}">
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-2"><!-- field P type tinyInteger -->
		<div class="form-group">
			<label class="col-md-4 control-label" for="P">P :</label>
			<div class="col-md-8">
				<div class="input-group">
					<span class="input-group-addon"><span class="fa fa-times-circle-o"></span></span>
					<input class="form-control" type="text" name="P" id="P" value="{{ old('P') ? old('P') : $note->P }}">
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-2"><!-- field A type tinyInteger -->
		<div class="form-group">
			<label class="col-md-4 control-label" for="A">A :</label>
			<div class="col-md-8">
				<div class="input-group">
					<span class="input-group-addon"><span class="fa fa-times-circle-o"></span></span>
					<input class="form-control" type="text" name="A" id="A" value="{{ old('A') ? old('A') : $note->A }}">
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-6"><!-- field GA_weeks type tinyInteger -->
		<div class="form-group">
			<label class="control-label col-md-4" for="">GA :</label>
			<div class="col-md-4">
				<div class="input-group">
					<input class="form-control" type="text" name="GA_weeks" id="GA_weeks" value="{{ old('GA_weeks') ? old('GA_weeks') : $note->GA_weeks }}">
					<span class="input-group-addon">weeks</span>
				</div>
			</div>
			<div class="col-md-4"><!-- field GA_days type tinyInteger -->
				<div class="input-group">
					<input class="form-control" type="text" name="GA_days" id="GA_days" value="{{ old('GA_days') ? old('GA_days') : $note->GA_days }}">
					<span class="input-group-addon">days</span>
				</div>
			</div>
		</div>
	</div>
</div>
<div class='panel panel-default'><!-- Allergy -->
	<div class='panel-heading'>Allergy</div>
	<div class='panel-body'>
		<div class="row">
			<div class="col-md-2"><!-- field no_allergy type checkbox -->
				<div class="checkbox"><label><input type="checkbox" {{ $note->no_allergy ? 'checked' : '' }} name="no_allergy" id="no_allergy">None</label></div>
			</div>
			<div class="col-md-2"><!-- field allergy_penicilin type checkbox -->
				<div class="checkbox drug-allergy-check"><label><input class="allergy-check" type="checkbox" {{ $note->allergy_penicilin ? 'checked' : '' }} name="allergy_penicilin">Penicilin</label></div>
			</div>
			<div class="col-md-2"><!-- field allergy_sulfonamide type checkbox -->
				<div class="checkbox drug-allergy-check"><label><input class="allergy-check" type="checkbox" {{ $note->allergy_sulfonamide ? 'checked' : '' }} name="allergy_sulfonamide">Sulfonamide</label></div>
			</div>
			<div class="col-md-2"><!-- field allergy_NSAIDS type checkbox -->
				<div class="checkbox drug-allergy-check"><label><input class="allergy-check" type="checkbox" {{ $note->allergy_NSAIDS ? 'checked' : '' }} name="allergy_NSAIDS">NSAIDS</label></div>
			</div>
			<div class="col-md-12"><!-- field other_drug_allergy type string -->
				<div class="form-group">
				<textarea name="other_drug_allergy" id="other_drug_allergy" class="form-control text_area_feedback allergy-text" rows="1" maxlength="255" placeholder="Specify other drug allergy. 255 characters max.">{{ $note->other_drug_allergy }}</textarea>
				<div id="other_drug_allergy_feedback" style="color:#b3b3b3"></div>
				</div>
			</div>
			<div class="col-md-12"><!-- field other_allergy type string -->
				<div class="form-group">
				<textarea name="other_allergy" id="other_allergy" class="form-control text_area_feedback allergy-text" rows="1" maxlength="255" placeholder="Specify other allergy. 255 characters max.">{{ $note->other_allergy }}</textarea>
				<div id="other_allergy_feedback" style="color:#b3b3b3"></div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class='panel panel-default'><!-- Diseases -->
	<div class='panel-heading'>Diseases</div>
	<div class='panel-body'>
		<div class="row">
			<div class="col-md-2"><!-- field no_disease type checkbox -->
				<div class="checkbox"><label><input type="checkbox" {{ $note->no_disease ? 'checked' : '' }} name="no_disease" id="no_disease">None</label></div>
			</div>
			<div class="col-md-12"><!-- field spectified_diseases type string -->
				<div class="form-group">
				<textarea name="spectified_diseases" id="spectified_diseases" class="form-control text_area_feedback" rows="1" maxlength="255" placeholder="Specify other allergy. 255 characters max.">{{ $note->spectified_diseases }}</textarea>
				<div id="spectified_diseases_feedback" style="color:#b3b3b3"></div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class='panel panel-default'><!-- Rx -->
	<div class='panel-heading'>Treatments</div>
	<div class='panel-body'>
		<div class="row">
			<div class="col-md-2"><!-- field no_treatment type checkbox -->
				<div class="checkbox"><label><input type="checkbox" {{ $note->no_treatment ? 'checked' : '' }} name="no_treatment" id="no_treatment">None</label></div>
			</div>
			<div class="col-md-12"><!-- field specified_surgery type string -->
				<div class="form-group">
				<textarea name="specified_surgery" id="specified_surgery" class="form-control text_area_feedback rx-text" rows="1" maxlength="255" placeholder="Specify surgery here. 255 characters max.">{{ $note->specified_surgery }}</textarea>
				<div id="specified_surgery_feedback" style="color:#b3b3b3"></div>
				</div>
			</div>
			<div class="col-md-12"><!-- field specified_treatment type string -->
				<div class="form-group">
				<textarea name="specified_treatment" id="specified_treatment" class="form-control text_area_feedback rx-text" rows="1" maxlength="255" placeholder="Specify treatments here. 255 characters max.">{{ $note->specified_treatment }}</textarea>
				<div id="specified_treatment_feedback" style="color:#b3b3b3"></div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$('#no_allergy').click(function (){
		if ($(this).prop('checked') == true) {
			$('.allergy-check').prop('checked', false);
			$('.allergy-text').val('');
		}
	});
	$('.allergy-check').click(function() {
		if ($(this).prop('checked') == true)
			$('#no_allergy').prop('checked', false);
	});
	$('.allergy-text').change(function () {
		if ($(this).val() != '')
			$('#no_allergy').prop('checked', false);
	});
	$('#no_disease').click(function () {
		if ($(this).prop('checked') == true)
			$('#spectified_diseases').val('');
	});
	$('#spectified_diseases').change(function () {
		if ($(this).val() != '')
			$('#no_disease').prop('checked', false);
	});
	$('#no_treatment').click(function () {
		if ($(this).prop('checked') == true)
			$('.rx-text').val('');
	});
	$('.rx-text').change(function () {
		if ($(this).val() != '')
			$('#no_treatment').prop('checked', false);
	});
</script>