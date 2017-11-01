@extends('form')

@section('doc_title' , $note->note->type->name . ' - Form')

@section('description', 'siriraj faculty general note form')

@section('author', 'koramit Pichana')

@section('background_image',"url('/assets/images/blu_stripes.png');")

@section('nav_menu')
<li><a href="#admission_data">Admission data</a></li>
<li><a href="#pregnancy_panel">Pregnancy</a></li>
<li><a href="#complication_panel">Complication</a></li>
<li><a href="#abortion_panel">Abortion</a></li>
<li><a href="#treatment_panel">Treatments</a></li>
<li><a href="#contraception_panel">Contraception</a></li>
@endsection

@section('content')
@include('partials.flash')
@include('errors.invalid')

<div class="col-md-offset-1 col-md-10"><!-- main_frame -->
@include('obgyn.notes.partials.admission')
<div class="panel panel-primary" id="pregnancy_panel"><!-- Pregnancy panel. -->
	<div class="panel-heading">Pregnancy</div>
	<div class="panel-body">
		@include('obgyn.notes.partials.pregnancy_common')
	</div>
</div>

<div class='panel panel-primary' id="complication_panel"><!-- Complication panel -->
	<div class="panel-heading">Complication during pregnancy and associated diseases and conditions</div>
	<div class="panel-body">
		@include('obgyn.notes.partials.pregnancy_complication_panel_body')
	</div>
</div>

<div class="panel panel-primary" id="abortion_panel"><!-- Abortion panel. -->
	<div class="panel-heading">Abortion and abnormal products of conception</div>
	<div class="panel-body">
		<div class="form-horizontal row">
			<div class="col-md-6"><!-- field date_abortion type date -->
				<div class='form-group'>
					<label class="control-label col-md-6" for="date_abortion">Date of Abortion :</label>
					<div class="col-md-6">
						<div class="input-group date" id='datetimepicker_date_abortion'>
							<input type='text' class="form-control handle-datetime" name="date_abortion" id="date_abortion" value="{{ $note->date_abortion ? $note->date_abortion->format('d-m-Y') : '' }}" />
							<span class="input-group-addon"><span class="fa fa-calendar"></span></span>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="panel panel-default"><!-- Diagnosis panel -->
			<div class="panel-heading">Diagnosis</div>
			<div class="panel-body row">
				<div class="col-md-3"><!-- field abortion_diagnosis_hydatidiform_mole type checkbox -->
					<div class="checkbox"><label><input type="checkbox" {{ $note->abortion_diagnosis_hydatidiform_mole ? 'checked' : '' }} name="abortion_diagnosis_hydatidiform_mole">Hydatidiform mole</label></div>
				</div>
				<div class="col-md-3"><!-- field abortion_diagnosis_blighted_ovum type checkbox -->
					<div class="checkbox"><label><input type="checkbox" {{ $note->abortion_diagnosis_blighted_ovum ? 'checked' : '' }} name="abortion_diagnosis_blighted_ovum">Blighted ovum</label></div>
				</div>
				<div class="col-md-3"><!-- field abortion_diagnosis_missed_abortion type checkbox -->
					<div class="checkbox"><label><input type="checkbox" {{ $note->abortion_diagnosis_missed_abortion ? 'checked' : '' }} name="abortion_diagnosis_missed_abortion">Missed abortion</label></div>
				</div>
				<div class="col-md-3"><!-- field abortion_diagnosis_dead_fetus_in_utero type checkbox -->
					<div class="checkbox"><label><input type="checkbox" {{ $note->abortion_diagnosis_dead_fetus_in_utero ? 'checked' : '' }} name="abortion_diagnosis_dead_fetus_in_utero">Dead fetus in utero</label></div>
				</div>
				<div class="col-md-12"><!-- field other_abortion_diagnosis type string -->
					<textarea name="other_abortion_diagnosis" id="other_abortion_diagnosis" class="form-control text_area_feedback" rows="1" maxlength="255" placeholder="Specify other diagnosis. 255 characters max.">{{ $note->other_abortion_diagnosis }}</textarea>
					<div id="other_abortion_diagnosis_feedback" style="color:#b3b3b3"></div>
				</div>
			</div>
		</div><!-- end Diagnosis panel -->

		<div class="panel panel-default"><!-- Abortion panel -->
			<div class="panel-heading">Abortion</div>	
			<div class="panel-body form-horizontal row">
				<div class="col-md-12"><!-- field abortion type tinyInteger -->
					<div class="form-group">
						<label class="col-md-2 control-label" for="abortion">Abortion <a role="button" title="Click to reset." class="radio-reset" target="abortion"><span class="fa fa-remove"></span></a> :</label>
						<label class="col-md-2 radio-inline"><input type="radio" name="abortion" {{ $note->abortion === '0' ? 'checked' : '' }} value="0">No</label>
						<label class="col-md-2 radio-inline"><input type="radio" name="abortion" {{ $note->abortion == 1 ? 'checked' : '' }} value="1">Spontanous</label>
						<label class="col-md-2 radio-inline"><input type="radio" name="abortion" {{ $note->abortion == 2 ? 'checked' : '' }} value="2">Induced medical</label>
						<label class="col-md-2 radio-inline"><input type="radio" name="abortion" {{ $note->abortion == 3 ? 'checked' : '' }} value="3">Induced illegal</label>
					</div>
				</div>
				<div class="col-md-12"><!-- field abortion_stage type tinyInteger -->
					<div class="form-group">
						<label class="col-md-2 control-label" for="abortion_stage">Stage <a role="button" title="Click to reset." class="radio-reset" target="abortion_stage"><span class="fa fa-remove"></span></a> :</label>
						<label class="col-md-2 radio-inline"><input type="radio" name="abortion_stage" {{ $note->abortion_stage == 1 ? 'checked' : '' }} value="1">Treatened</label>
						<label class="col-md-2 radio-inline"><input type="radio" name="abortion_stage" {{ $note->abortion_stage == 2 ? 'checked' : '' }} value="2">Inevitable</label>
						<label class="col-md-2 radio-inline"><input type="radio" name="abortion_stage" {{ $note->abortion_stage == 3 ? 'checked' : '' }} value="3">Incomplete</label>
						<label class="col-md-2 radio-inline"><input type="radio" name="abortion_stage" {{ $note->abortion_stage == 4 ? 'checked' : '' }} value="4">Complete</label>
						<label class="col-md-1 radio-inline"><input type="radio" name="abortion_stage" {{ $note->abortion_stage == 99 ? 'checked' : '' }} value="99" other="true">Other</label>
					</div>
				</div>
				<script type="text/javascript">
					//@func
					$('input[name=abortion_stage]').click(function() {
						if ($(this).attr('other')) {
							$('#other_abortion_stage_collapse').collapse('show');
							$('input[name=other_abortion_stage]').focus();
						} else {
							$('#other_abortion_stage_collapse').collapse('hide');
							$('input[name=other_abortion_stage]').val('');
						}
					});
				</script>
				<div class="col-md-12 collapse" id="other_abortion_stage_collapse"><!-- field other_abortion_stage type string -->
					<div class="form-group">
						<label class="col-md-2 control-label" for="other_abortion_stage">Other stage :</label>
						<div class="col-md-10">
							<input type="text" name="other_abortion_stage" value="{{ $note->other_abortion_stage }}" class="form-control" placeholder="Specify other stage."/>
						</div>
					</div>
				</div>
			</div>
		</div><!-- end Abortion panel -->

		<div class="panel panel-default"><!-- Outcome panel -->
			<div class="panel-heading">Outcomes of abortion</div>
			<div class="panel-body">
				<div class="form-horizontal row">
					<div class="col-md-12"><!-- field abortion_outcome type tinyInteger -->
						<div class="form-group">
							<label class="col-md-2 control-label" for="abortion_outcome">Outcome <a role="button" title="Click to reset." class="radio-reset" target="abortion_outcome"><span class="fa fa-remove"></span></a> :</label>
							<label class="col-md-2 radio-inline"><input type="radio" name="abortion_outcome" {{ $note->abortion_outcome == 1 ? 'checked' : '' }} value="1">fetus and placenta</label>
							<label class="col-md-3 radio-inline"><input type="radio" name="abortion_outcome" {{ $note->abortion_outcome == 2 ? 'checked' : '' }} value="2">products of conception</label>
						</div>
					</div>
				</div>
				<script type="text/javascript">
					$('input[name=abortion_outcome]').click(function() {
						if ($(this).val() == 1) {
							$('#product').collapse('hide');
							$('.product-data').val('');// clear product data.
							$('#fetus').collapse('show');
						} else {
							$('#fetus').collapse('hide');
							$('.fetus-data').val('');// clear fetus data.
							$('input[name=gender]').prop('checked', false);// clear fetus data.
							$('#product').collapse('show');
						}
					});

					$('a[target=abortion_outcome]').click(function() {
						$('#fetus').collapse('hide');
						$('.fetus-data').val('');// clear fetus data.
						$('input[name=gender]').prop('checked', false);// clear fetus data.

						$('#product').collapse('hide');
						$('.product-data').val('');// clear product data.
					});
				</script>
				<div class="panel panel-info collapse" id="fetus">
					<div class="panel-heading">Fetus and placenta</div>
					<div class="panel-body form-horizontal row">
						<div class="col-md-6"><!-- field gender type tinyInteger -->
							<div class="form-group">
								<label for="gender" class="col-md-4 control-label">Gender :</label>
								<div class="col-md-8">
									<label class="radio-inline"><input type="radio" name="gender" {{ $note->gender === '0' ? 'checked' : '' }} value="0">Female</label>
									<label class="radio-inline"><input type="radio" name="gender" {{ $note->gender == 1 ? 'checked' : '' }} value="1">Male</label>
									<label class="radio-inline"><input type="radio" name="gender" {{ $note->gender == 2 ? 'checked' : '' }} value="2">Undifferentialted</label>
								</div>
							</div>
						</div>
						<div class="col-md-6"><!-- field fetus_weight_grams type smallInteger -->
							<div class="form-group">
								<label for="fetus_weight_grams" class="col-md-4 control-label">Fetus weight :</label>
								<div class="col-md-8">
									<div class="input-group">
										<input class="form-control fetus-data" type="text" name="fetus_weight_grams" value="{{ $note->fetus_weight_grams }}" />
										<span class="input-group-addon">grams</span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6"><!-- field fetus_EBL_ml tpye smallInteger -->
							<div class="form-group">
								<label for="fetus_EBL_ml" class="control-label col-md-4">EBL :</label>
								<div class="col-md-8">
									<div class="input-group">
										<input class="form-control fetus-data" type="text" name="fetus_EBL_ml" value="{{ $note->fetus_EBL_ml }}" />
										<span class="input-group-addon">ml</span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6"><!-- field placenta_weight_grams type smallInteger -->
							<div class="form-group">
								<label for="placenta_weight_grams" class="col-md-4 control-label">Placenta weight :</label>
								<div class="col-md-8">
									<div class="input-group">
										<input class="form-control fetus-data" type="text" name="placenta_weight_grams" value="{{ $note->placenta_weight_grams }}" />
										<span class="input-group-addon">grams</span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-12"><!-- field placenta_abnormality type string -->
							<textarea name="placenta_abnormality" id="placenta_abnormality" class="form-control text_area_feedback fetus-data" rows="1" maxlength="255" placeholder="Specify placenta abnormality. 255 character max.">{{ $note->placenta_abnormality }}</textarea>
							<div id="placenta_abnormality_feedback" style="color:#b3b3b3"></div>
						</div>
					</div>
				</div>
				<div class="panel panel-info collapse" id="product">
					<div class="panel-heading">Products of conception</div>
					<div class="panel-body form-horizontal row">
						<div class="col-md-6"><!-- field quantity_tea_spoon type tinyInteger -->
							<div class="form-group">
								<label for="quantity_tea_spoon" class="col-md-4 control-label">Quantity :</label>
								<div class="col-md-4">
									<div class="input-group">
										<input class="form-control product-data" type="text" name="quantity_tea_spoon" value="{{ $note->quantity_tea_spoon }}" />
										<span class="input-group-addon">tea <span class="fa fa-spoon"></span></span>
									</div>
								</div>
								<div class="col-md-4"><!-- field quantity_table_spoon type tinyInteger -->
									<div class="input-group">
										<input class="form-control product-data" type="text" name="quantity_table_spoon" value="{{ $note->quantity_table_spoon }}" />
										<span class="input-group-addon">table <span class="fa fa-spoon"></span></span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6"><!-- field product_weight_grams type smallInteger -->
							<div class="form-group">
								<label for="product_weight_grams" class="col-md-4 control-label">Weight :</label>
								<div class="col-md-8">
									<div class="input-group">
										<input class="form-control product-data" type="text" name="product_weight_grams" value="{{ $note->product_weight_grams }}" />
										<span class="input-group-addon">grams</span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6"><!-- field conception_EBL_ml type smallInteger -->
							<div class="form-group">
								<label for="conception_EBL_ml" class="control-label col-md-4">EBL :</label>
								<div class="col-md-8">
									<div class="input-group">
										<input class="form-control product-data" type="text" name="conception_EBL_ml" value="{{ $note->conception_EBL_ml }}" />
										<span class="input-group-addon">ml</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div><!-- end Outcome panel -->
	</div>
</div><!-- end Abortion panel. -->

<div class="panel panel-primary" id="treatment_panel"><!-- Treatments panel. -->
	<div class="panel-heading">Treatments</div>
	<div class="panel-body row">
		<div class="col-md-3"><!-- field rx_genitourinary_instillation type checkbox -->
			<div class="checkbox"><label><input type="checkbox" {{ $note->rx_genitourinary_instillation ? 'checked' : '' }} name="rx_genitourinary_instillation">Genitourinary instillation <a title="insertion of prostaglandin suppository"><span class="fa fa-info-circle"></span></a></label></div>
		</div>
		<div class="col-md-3"><!-- field rx_oxcytocin_infusion type checkbox -->
			<div class="checkbox"><label><input type="checkbox" {{ $note->rx_oxcytocin_infusion ? 'checked' : '' }} name="rx_oxcytocin_infusion">Infusion of oxcytocin</label></div>
		</div>
		<div class="col-md-3"><!-- field rx_dilatation_curettage type checkbox -->
			<div class="checkbox"><label><input type="checkbox" {{ $note->rx_dilatation_curettage ? 'checked' : '' }} name="rx_dilatation_curettage">Dilatation and curettage</label></div>
		</div>
		<div class="col-md-3"><!-- field rx_evaculation_curettage type checkbox -->
			<div class="checkbox"><label><input type="checkbox" {{ $note->rx_evaculation_curettage ? 'checked' : '' }} name="rx_evaculation_curettage">Evaculation and curettage</label></div>
		</div>
		<div class="col-md-3"><!-- field rx_aspiration_suction_curettage type checkbox -->
			<div class="checkbox"><label><input type="checkbox" {{ $note->rx_aspiration_suction_curettage ? 'checked' : '' }} name="rx_aspiration_suction_curettage">Aspiration / Suction curettage</label></div>
		</div>
		<div class="col-md-3"><!-- field rx_hysterotomy type checkbox -->
			<div class="checkbox"><label><input type="checkbox" {{ $note->rx_hysterotomy ? 'checked' : '' }} name="rx_hysterotomy">Hysterotomy</label></div>
		</div>
		<div class="col-md-12"><!-- field other_treatment type string -->
			<textarea name="other_treatment" id="other_treatment" class="form-control text_area_feedback" rows="1" maxlength="255" placeholder="Specify other treatment. 255 character max.">{{ $note->other_treatment }}</textarea>
			<div id="other_treatment_feedback" style="color:#b3b3b3"></div>
		</div>
	</div>
</div><!-- end Treatments panel. -->

<div class="panel panel-primary" id="contraception_panel"><!-- contraception panel -->
	<div class="panel-heading">Contraception</div>
	@include('obgyn.notes.partials.contraception_panel_body')
</div>

<div class="panel panel-primary" id="note_panel"><!-- Note panel-->
	<div class="panel-heading">Note</div>
	<div class="panel-body"><!-- md_note -->
		<textarea class="form-control text_area_feedback" name="md_note" id="md_note" rows="1" maxlength="1000" placeholder="1000 characters max.">{{ $note->note->md_note }}</textarea>
		<div id="md_note_feedback" style="color:#b3b3b3"></div>
	</div>
</div>
<h4 class="alert alert-info text-center">End of {{ $note->note->type->name }} form.</h4>
</div><!-- end of main_frame -->
@endsection

@section('form_script')
<script type="text/javascript">
$('#datetimepicker_date_abortion').datetimepicker({
	locale: 'th',
	format: 'DD-MM-YYYY',
	showTodayButton: true,
	showClear: true
}); // date_abortion.

$(document).ready(function(){
	@if ($note->pregnancy_complication_DM)
		$('#DM_collapse').collapse('show');
	@endif
	@if($note->contraception == 99)
		$('#other_contraception_collapse').collapse('show');
	@endif
	@if($note->abortion_stage == 99)
		$('#other_abortion_stage_collapse').collapse('show');
	@endif
	@if ($note->abortion_outcome)
		$('input[name=abortion_outcome][value=' + {{ $note->abortion_outcome }} + ']').click();
	@endif
});
</script>
@endsection