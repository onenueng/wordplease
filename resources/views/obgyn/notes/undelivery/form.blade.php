@extends('form')

@section('doc_title' , $note->note->type->name . ' - Form')

@section('description', 'siriraj faculty general note form')

@section('author', 'koramit Pichana')

@section('background_image',"url('/assets/images/blu_stripes.png');")

@section('nav_menu')
<li><a href="#admission_data">Admission data</a></li>
<li><a href="#pregnancy_panel">Pregnancy</a></li>
<li><a href="#complication_panel">Complications</a></li>
<li><a href="#treatment_panel">Treatments</a></li>
@endsection

@section('content')
@include('partials.flash')
@include('errors.invalid')

<div class="col-md-offset-1 col-md-10"><!-- main_frame -->
@include('obgyn.notes.partials.admission')
<div class="panel panel-primary" id="pregnancy_panel">
	<div class="panel-heading">Pregnancy</div>
	<div class="panel-body">
		@include('obgyn.notes.partials.pregnancy_common')
	</div>
</div>

<div class="panel panel-primary" id="complication_panel">
	<div class="panel-heading">Complications</div>
	<div class="panel-body">
		<div class="panel panel-default">
			<div class="panel-heading">Obstetrics</div>
			<div class="panel-body row">
				<div class="col-md-4"><!-- field obstetrics_complication_hyperemesis_gravidarum type checkbox -->
					<div class="checkbox"><label><input type="checkbox" {{ $note->obstetrics_complication_hyperemesis_gravidarum ? 'checked' : '' }} name="obstetrics_complication_hyperemesis_gravidarum">Hyperemesis gravidarum</label></div>
				</div>
				<div class="col-md-4"><!-- field obstetrics_complication_false_labour_before_37_wks type checkbox -->
					<div class="checkbox"><label><input type="checkbox" {{ $note->obstetrics_complication_false_labour_before_37_wks ? 'checked' : '' }} name="obstetrics_complication_false_labour_before_37_wks">False labour Before 37 complete weeks</label></div>
				</div>
				<div class="col-md-4"><!-- field obstetrics_complication_false_labour_after_37_wks type checkbox -->
					<div class="checkbox"><label><input type="checkbox" {{ $note->obstetrics_complication_false_labour_after_37_wks ? 'checked' : '' }} name="obstetrics_complication_false_labour_after_37_wks">False labour after 37 complete weeks</label></div>
				</div>
				<div class="col-md-4"><!-- field obstetrics_complication_treatened_preterm_labour type checkbox -->
					<div class="checkbox"><label><input type="checkbox" {{ $note->obstetrics_complication_treatened_preterm_labour ? 'checked' : '' }} name="obstetrics_complication_treatened_preterm_labour">Treatened preterm labour</label></div>
				</div>				
				<div class="col-md-4"><!-- field obstetrics_complication_preterm_labour_without_delivery type checkbox -->
					<div class="checkbox"><label><input type="checkbox" {{ $note->obstetrics_complication_preterm_labour_without_delivery ? 'checked' : '' }} name="obstetrics_complication_preterm_labour_without_delivery">Preterm labour without delivery</label></div>
				</div>
				<div class="col-md-12"><!-- field other_obstetrics_complication type string -->
					<div class="form-group">
						<textarea name="other_obstetrics_complication" id="other_obstetrics_complication" class="form-control text_area_feedback" rows="1" maxlength="255" placeholder="Specify other obstetrics complication. 255 characters max.">{{ $note->other_obstetrics_complication }}</textarea>
						<div id="other_obstetrics_complication_feedback" style="color:#b3b3b3"></div>
					</div>
				</div>
			</div>
		</div>

		<div class="panel panel-default">
			<div class="panel-heading">Medical</div>
			<div class="panel-body row">
				<div class="form-horizontal">
					<div class="col-md-12"><!-- field medical_complication_thalassemia type tinyInteger -->
						<div class="form-group">
							<label class="col-md-2 control-label" for="medical_complication_thalassemia">Thalassemia <a role="button" title="Click to reset." class="radio-reset" target="medical_complication_thalassemia"><span class="fa fa-remove"></span></a> :</label>
							<label class="radio-inline"><input type="radio" name="medical_complication_thalassemia" {{ $note->medical_complication_thalassemia == 1 ? 'checked' : '' }} value="1">Hb H disease</label>
							<label class="radio-inline"><input type="radio" name="medical_complication_thalassemia" {{ $note->medical_complication_thalassemia == 2 ? 'checked' : '' }} value="2">&beta; Thal/Hb E disease</label>
							<label class="radio-inline"><input type="radio" name="medical_complication_thalassemia" {{ $note->medical_complication_thalassemia == 3 ? 'checked' : '' }} value="3">Homoglobin E trait</label>
							<label class="radio-inline"><input type="radio" name="medical_complication_thalassemia" {{ $note->medical_complication_thalassemia == 4 ? 'checked' : '' }} value="4">&beta; Thalassemia trait</label>
						</div>
					</div>
				</div>
				<div class="col-md-12"></div>
				<div class="col-md-12"><!-- field medical_complication_DM type checkbox -->
					<div class="checkbox"><label><input class="complication" type="checkbox" {{ $note->medical_complication_DM ? 'checked' : '' }} name="medical_complication_DM">Diabetes Mellilus</label></div>
				</div>
				<script type="text/javascript">
					//@func
					function clearDM() {
						$('.dm-check').prop('checked', false);
						$('#specificed_medical_complication_DM').val('');
						$('input[name=medical_complication_DM_type]').prop('checked', false);
						$('#DM_collapse').collapse('hide');
					} // clear complication DM associate data.
					$('input[name=medical_complication_DM]').click(function() {
						if ($(this).prop('checked')) {
							$('#DM_collapse').collapse('show');
						} else {
							// $('#DM_collapse').collapse('hide');
							clearDM();
						}
					});
				</script>
				<div class="col-md-12 collapse" id="DM_collapse">
					<div class="panel panel-default">
						<div class="panel-heading">Specify Diabetes Mellilus</div>
						<div class="panel-body">
							<div class="form-horizontal">
								<div class="form-group">
									<label class="control-label col-md-2" for="medical_complication_DM_type">DM Type <a role="button" title="Click to reset." class="radio-reset" target="medical_complication_DM_type"><span class="fa fa-remove"></span></a> :</label>
									<div class='col-md-2'><!-- field medical_complication_DM_type type tinyInteger -->
										<label class="radio-inline"><input type="radio" name="medical_complication_DM_type" {{ $note->medical_complication_DM_type == 1 ? 'checked' : '' }} value="1">Type I</label>
									</div>
									<div class='col-md-2'>
										<label class="radio-inline"><input type="radio" name="medical_complication_DM_type" {{ $note->medical_complication_DM_type == 2 ? 'checked' : '' }} value="2">Type II</label>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-2" for="medical_complication_DM_DR">DM Complication :</label>
									<div class="col-md-1"><!-- field medical_complication_DM_DR type checkbox -->
										<div class="checkbox"><label><input class="dm-check" type="checkbox" {{ $note->medical_complication_DM_DR ? 'checked' : '' }} name="medical_complication_DM_DR">DR</label></div>
									</div>
									<div class="col-md-2"><!-- field medical_complication_DM_nephropathy type checkbox -->
										<div class="checkbox"><label><input class="dm-check" type="checkbox" {{ $note->medical_complication_DM_nephropathy ? 'checked' : '' }} name="medical_complication_DM_nephropathy">Nephropathy</label></div>
									</div>
									<div class="col-md-2"><!-- field medical_complication_DM_neuropathy type checkbox -->
										<div class="checkbox"><label><input class="dm-check" type="checkbox" {{ $note->medical_complication_DM_neuropathy ? 'checked' : '' }} name="medical_complication_DM_neuropathy">Neuropathy</label></div>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-2" for="">DM On :</label>
									<div class="col-md-2"><!-- field medical_complication_DM_on_diet type checkbox -->
										<div class="checkbox"><label><input class="dm-check" type="checkbox" {{ $note->medical_complication_DM_on_diet ? 'checked' : '' }} name="medical_complication_DM_on_diet">Diet control</label></div>
									</div>
									<div class="col-md-3"><!-- field medical_complication_DM_on_oral_meds type checkbox -->
										<div class="checkbox"><label><input class="dm-check" type="checkbox" {{ $note->medical_complication_DM_on_oral_meds ? 'checked' : '' }} name="medical_complication_DM_on_oral_meds">Oral medications</label></div>
									</div>
									<div class="col-md-2"><!-- field medical_complication_DM_on_insulin type checkbox -->
										<div class="checkbox"><label><input class="dm-check" type="checkbox" {{ $note->medical_complication_DM_on_insulin ? 'checked' : '' }} name="medical_complication_DM_on_insulin">Insulin</label></div>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-12"><!-- field specificed_medical_complication_DM type string -->
										<input class="form-control" type="text" name="specificed_medical_complication_DM" value="{{ $note->specificed_medical_complication_DM }}" id="specificed_medical_complication_DM" placeholder="Specify DM.">
									</div>
								</div>			
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12"></div>
				<div class="col-md-3"><!-- field medical_complication_HT type checkbox -->
					<div class="checkbox"><label><input type="checkbox" {{ $note->medical_complication_HT ? 'checked' : '' }} name="medical_complication_HT">Hypertension</label></div>
				</div>
				<div class="col-md-9"><!-- field specificed_medical_complication_HT type string -->
					<input class="form-control" type="text" name="specificed_medical_complication_HT" placeholder="Specify HT." value="{{ $note->specificed_medical_complication_HT }}" />
				</div>
				<div class="col-md-12"><!-- field other_medical_complication type string -->
					<div class="form-group">
					<textarea name="other_medical_complication" id="other_medical_complication" class="form-control text_area_feedback" rows="1" maxlength="255" placeholder="Specify other medical complication. 255 characters max.">{{ $note->other_medical_complication }}</textarea>
					<div id="other_medical_complication_feedback" style="color:#b3b3b3"></div>
					</div>
				</div>
			</div>
		</div>

		<div class="panel panel-default">
			<div class="panel-heading">Other complications</div>
			<div class="panel-body row">
				<div class="col-md-12"><!-- field other_complication type string -->
					<div class="form-group">
						<textarea name="other_complication" id="other_complication" class="form-control text_area_feedback" rows="1" maxlength="255" placeholder="Specify other complication. 255 characters max.">{{ $note->other_complication }}</textarea>
						<div id="other_complication_feedback" style="color:#b3b3b3"></div>
					</div>
				</div>
			</div>
		</div>
			
	</div>
</div>

<div class="panel panel-primary" id="treatment_panel"><!-- Treatments panel -->
	<div class="panel-heading">Treatments</div>
	<div class="panel-body form-horizontal row">
		<div class="col-md-5"><!-- field RX_medication_inhibit_labour type tinyInteger -->
			<div class="form-group">
				<label class="col-md-8 control-label" for="RX_medication_inhibit_labour">Inhibit labour by medication <a role="button" title="Click to reset." class="radio-reset" target="RX_medication_inhibit_labour"><span class="fa fa-remove"></span></a> :</label>
				<label class="radio-inline col-md-1"><input type="radio" name="RX_medication_inhibit_labour" {{ $note->RX_medication_inhibit_labour === '0' ? 'checked' : '' }} value="0">No</label>
				<label class="radio-inline col-md-1"><input type="radio" name="RX_medication_inhibit_labour" {{ $note->RX_medication_inhibit_labour == 1 ? 'checked' : '' }} value="1">Yes</label>
			</div>
		</div>
		<div class="col-md-7">
			<div class="form-group">
				<div class="col-md-4"><!-- field RX_medication_inhibit_labour_bricanyl type checkbox -->
					<div class="checkbox"><label><input type="checkbox" {{ $note->RX_medication_inhibit_labour_bricanyl ? 'checked' : '' }} class="inhibit-labour-checkbox" name="RX_medication_inhibit_labour_bricanyl">Bricanyl</label></div>
				</div>
				<div class="col-md-2"><!-- field RX_medication_inhibit_labour_MgSO4 type checkbox -->
					<div class="checkbox"><label><input type="checkbox" {{ $note->RX_medication_inhibit_labour_MgSO4 ? 'checked' : '' }} class="inhibit-labour-checkbox" name="RX_medication_inhibit_labour_MgSO4">MgSO<sub>4</sub></label></div>
				</div>
				<div class="col-md-6"><!-- field RX_medication_inhibit_labour_other type string -->
					<input class="form-control" type="text" name="RX_medication_inhibit_labour_other" placeholder="Other medications." maxlength="255" value="{{ $note->RX_medication_inhibit_labour_other }}" />
				</div>
			</div>
		</div>
		<script type="text/javascript">
			//@func
			$('input[name=RX_medication_inhibit_labour]').click(function() { if ($(this).val() == 0) clearInhibitLabour(); });
			$('a[target=RX_medication_inhibit_labour]').click(function() { clearInhibitLabour(); });
			$('.inhibit-labour-checkbox').click(function() {
				$('input[name=RX_medication_inhibit_labour][value=1]').prop('checked', true);
			});
			$('input[name=RX_medication_inhibit_labour_other]').on('input change', function() {
				if (!$('input[name=RX_medication_inhibit_labour][value=1]').prop('checked'))
					$('input[name=RX_medication_inhibit_labour][value=1]').prop('checked',true);
			});
			function clearInhibitLabour() {
				$('input[name=RX_medication_inhibit_labour_other]').val('');
				$('.inhibit-labour-checkbox').prop('checked', false);
			}
		</script>
		<div class="col-md-5"><!-- field RX_blood_transfusions type tinyInteger -->
			<div class="form-group">
				<label class="col-md-8 control-label" for="RX_blood_transfusions">Blood transfusions <a role="button" title="Click to reset." class="radio-reset" target="RX_blood_transfusions"><span class="fa fa-remove"></span></a> :</label>
				<label class="radio-inline col-md-1"><input type="radio" name="RX_blood_transfusions" {{ $note->RX_blood_transfusions === '0' ? 'checked' : '' }} value="0">No</label>
				<label class="radio-inline col-md-1"><input type="radio" name="RX_blood_transfusions" {{ $note->RX_blood_transfusions == 1 ? 'checked' : '' }} value="1">Yes</label>
			</div>
		</div>
		<div class="col-md-7">
			<div class="form-group">
				<div class="col-md-6"><!-- field PCR type tinyInteger -->
					<div class="input-group">
						<span class="input-group-addon">PCR</span>
						<input class="form-control blood-transfusions-text" type="text" name="PCR" value="{{ $note->PCR }}" />
						<span class="input-group-addon">units</span>
					</div>
				</div>
				<div class="col-md-6"><!-- field RX_other_blood_transfusions type string -->
					<input class="form-control blood-transfusions-text" type="text" name="RX_other_blood_transfusions" placeholder="Other transfusion." maxlength="255" value="{{ $note->RX_other_blood_transfusions }}" />
				</div>
			</div>
		</div>
		<script type="text/javascript">
			//@func
			$('input[name=RX_blood_transfusions]').click(function() {
				if ($(this).val() == 0) $('.blood-transfusions-text').val('');
			});
			$('a[target=RX_blood_transfusions]').click(function() { $('.blood-transfusions-text').val(''); });
			$('.blood-transfusions-text').on('input change',function() {
				$('input[name=RX_blood_transfusions][value=1]').prop('checked', true);
			});
			$('.blood-transfusions-text').on('input change', function() {
				if (!$('input[name=RX_blood_transfusions][value=1]').prop('checked'))
					$('input[name=RX_blood_transfusions][value=1]').prop('checked',true);
			});
		</script>
		<div class="col-md-5"><!-- field RX_control_BP type tinyInteger -->
			<div class="form-group">
				<label class="col-md-8 control-label" for="RX_control_BP">Controlling of blood pressure <a role="button" title="Click to reset." class="radio-reset" target="RX_control_BP"><span class="fa fa-remove"></span></a> :</label>
				<label class="radio-inline col-md-1"><input type="radio" name="RX_control_BP" {{ $note->RX_control_BP === '0' ? 'checked' : '' }} value="0">No</label>
				<label class="radio-inline col-md-1"><input type="radio" name="RX_control_BP" {{ $note->RX_control_BP == 1 ? 'checked' : '' }} value="1">Yes</label>
			</div>
		</div>
		<div class="col-md-7"><!-- field RX_specificed_control_BP type string -->
			<input class="form-control" type="text" name="RX_specificed_control_BP" placeholder="Specify BP control." maxlength="255" value="{{ $note->RX_specificed_control_BP }}" />
		</div>
		<div class="col-md-12"></div>

		<div class="col-md-5"><!-- field RX_control_blood_sugar type tinyInteger -->
			<div class="form-group">
				<label class="col-md-8 control-label" for="RX_control_blood_sugar">Controlling of blood sugar <a role="button" title="Click to reset." class="radio-reset" target="RX_control_blood_sugar"><span class="fa fa-remove"></span></a> :</label>
				<label class="radio-inline col-md-1"><input type="radio" name="RX_control_blood_sugar" {{ $note->RX_control_blood_sugar === '0' ? 'checked' : ''}} value="0">No</label>
				<label class="radio-inline col-md-1"><input type="radio" name="RX_control_blood_sugar" {{ $note->RX_control_blood_sugar == 1 ? 'checked' : ''}} value="1">Yes</label>
			</div>
		</div>
		<div class="col-md-7">
			<div class="form-group">
				<div class="col-md-4"><!-- field RX_control_blood_sugar_diet type checkbox -->
					<div class="checkbox"><label><input type="checkbox" {{ $note->RX_control_blood_sugar_diet ? 'checked' : '' }} name="RX_control_blood_sugar_diet">Duet control</label></div>
				</div>
				<div class="col-md-2"><!-- field RX_control_blood_sugar_insulin type checkbox -->
					<div class="checkbox"><label><input type="checkbox" {{ $note->RX_control_blood_sugar_insulin ? 'checked' : '' }} name="RX_control_blood_sugar_insulin">Insulin</label></div>
				</div>
				<div class="col-md-6"><!-- field RX_other_control_blood_sugar type string -->
					<input class="form-control" type="text" name="RX_other_control_blood_sugar" placeholder="Other blood sugar control." maxlength="255" value="{{ $note->RX_other_control_blood_sugar }}" />
				</div>
			</div>
		</div>

		<div class="col-md-5"><!-- field RX_antibiotics type tinyInteger -->
			<div class="form-group">
				<label class="col-md-8 control-label" for="RX_antibiotics">Injection of antibiotics <a role="button" title="Click to reset." class="radio-reset" target="RX_antibiotics"><span class="fa fa-remove"></span></a> :</label>
				<label class="radio-inline col-md-1"><input type="radio" name="RX_antibiotics" {{ $note->RX_antibiotics === '0' ? 'checked' : '' }} value="0">No</label>
				<label class="radio-inline col-md-1"><input type="radio" name="RX_antibiotics" {{ $note->RX_antibiotics == 1 ? 'checked' : '' }} value="1">Yes</label>
			</div>
		</div>
		<div class="col-md-7"><!-- field RX_specificed_antibiotics type string -->
			<input class="form-control" type="text" name="RX_specificed_antibiotics" placeholder="Specify antibiotics." maxlength="255" value="{{ $note->RX_specificed_antibiotics }}" />
		</div>
		<div class="col-md-12"></div>

		<div class="col-md-5"><!-- field RX_electolytes type tinyInteger -->
			<div class="form-group">
				<label class="col-md-8 control-label" for="RX_electolytes">Injection/Infusion of electolytes <a role="button" title="Click to reset." class="radio-reset" target="RX_electolytes"><span class="fa fa-remove"></span></a> :</label>
				<label class="radio-inline col-md-1"><input type="radio" name="RX_electolytes" {{ $note->RX_electolytes === '0' ? 'checked' : '' }} value="0">No</label>
				<label class="radio-inline col-md-1"><input type="radio" name="RX_electolytes" {{ $note->RX_electolytes == 1 ? 'checked' : '' }} value="1">Yes</label>
			</div>
		</div>
		<div class="col-md-7"><!-- field RX_specificed_electolytes type string -->
			<input class="form-control" type="text" name="RX_specificed_electolytes" placeholder="Specify electolytes." maxlength="255" value="{{ $note->RX_specificed_electolytes }}" />
		</div>
		<div class="col-md-12"></div>

		<div class="col-md-5"><!-- field RX_steriod type tinyInteger -->
			<div class="form-group">
				<label class="col-md-8 control-label" for="RX_steriod">Injection of steriod <a role="button" title="Click to reset." class="radio-reset" target="RX_steriod"><span class="fa fa-remove"></span></a> :</label>
				<label class="radio-inline col-md-1"><input type="radio" name="RX_steriod" {{ $note->RX_steriod === '0' ? 'checked' : '' }} value="0">No</label>
				<label class="radio-inline col-md-1"><input type="radio" name="RX_steriod" {{ $note->RX_steriod == 1 ? 'checked' : '' }} value="1">Yes</label>
			</div>
		</div>
		<div class="col-md-7"><!-- field RX_specificed_steriod type string -->
			<input class="form-control" type="text" name="RX_specificed_steriod" placeholder="Specify steriod." maxlength="255" value="{{ $note->RX_specificed_steriod }}" />
		</div>
		<div class="col-md-12"><hr/></div>
		<div class="col-md-12"><!-- field other_treatments type string -->
			<textarea name="other_treatments" id="other_treatments" class="form-control text_area_feedback" rows="1" maxlength="255" placeholder="Specify other treatments. 255 characters max.">{{ $note->other_treatments }}</textarea>
			<div id="other_complication_feedback" style="color:#b3b3b3"></div>
		</div>

	</div>
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
$(document).ready(function(){
	@if ($note->medical_complication_DM)
		$('#DM_collapse').collapse('show');
	@endif
});
</script>
@endsection