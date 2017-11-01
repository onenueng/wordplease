@extends('form')

@section('doc_title' , $note->note->type->name . ' - Form')

@section('description', 'siriraj faculty general note form')

@section('author', 'koramit Pichana')

@section('background_image',"url('/assets/images/blu_stripes.png');")

@section('nav_menu')
<li><a href="#admission_data_panel">Admission data</a></li>
<li><a href="#infant_data_panel">Infant data</a></li>
<li><a href="#maternity_data_panel">Maternity data</a></li>
<li><a href="#home_nursing_panel">Home nursing</a></li>
<li><a href="#appointment_panel">Appointment</a></li>
@endsection

@section('content')
@include('partials.flash')
@include('errors.invalid')

<div class="col-md-offset-1 col-md-10"><!-- main_frame -->
@include('obgyn.notes.partials.admission')
<div class="panel panel-primary" id="infant_data_panel">
	<div class="panel-heading">Infant Data</div> 
	<div class="panel-body">
		<div class="panel panel-info">
			<div class="panel-heading">Preliminary Data</div> 
			<div class="panel-body">
				<div class="form-horizontal row">
					<div class="col-md-6"><!-- field gender type tynyInteger -->
						<div class="form-group">
							<label for="gender" class="col-md-4 control-label">Gender <a role="button" title="Click to reset." class="radio-reset" target="gender"><span class="fa fa-remove"></span></a> :</label>
							<div class="col-md-8">
								<label class="radio-inline"><input type="radio" no="1" name="gender" {{ $note->gender === '0' ? 'checked' : '' }} value="0">Female</label>
								<label class="radio-inline"><input type="radio" no="1" name="gender" {{ $note->gender == 1 ? 'checked' : '' }} value="1">Male</label>
								<label class="radio-inline"><input type="radio" no="1" name="gender" {{ $note->gender == 2 ? 'checked' : '' }} value="2">Undifferentiated</label>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-4" for="born_single_or_multiple">Delivery <a role="button" title="Click to reset." class="radio-reset" target="born_single_or_multiple"><span class="fa fa-remove"></span></a> :</label>
							<div class="col-md-2"><!-- field born_single_or_multiple type tinyInteger -->
								<label class="radio-inline"><input type="radio" name="born_single_or_multiple" {{ $note->born_single_or_multiple == 1 ? 'checked' : '' }} value="1">Single</label>
							</div>
							<div class="col-md-2">
								<label class="radio-inline"><input type="radio" name="born_single_or_multiple" {{ $note->born_single_or_multiple == 2 ? 'checked' : '' }} value="2">Multiple</label>
							</div>
							<div class="col-md-4"><!-- field born_oder type tinyInteger -->
								<input class="form-control" type="text" name="born_oder" value="{{ $note->born_oder }}" placeholder="Born order#">
							</div>
						</div>
					</div>
					<script type="text/javascript">
						//@func
						$('input[name=born_single_or_multiple]').click(function() {
							if ($(this).val() == 2)
								$('input[name=born_oder]').focus();
							else
								$('input[name=born_oder]').val('');
						});
						$('input[name=born_oder]').focus(function() {
							$('input[name=born_single_or_multiple][value=2]').prop('checked', true);
						});
					</script>
					<div class="col-md-6"><!-- field weight_grams type smallInteger -->
						<div class="form-group">
							<label for="weight_grams" class="col-md-4 control-label">Birth Weight :</label>
							<div class="col-md-8">
								<div class="input-group">
									<input class="form-control" type="text" name="weight_grams" value="{{ $note->weight_grams }}" >
									<span class="input-group-addon">grams</span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6"><!-- apgar -->
						<div class="form-group">
							<label for="apgar_1min" class="col-md-4 control-label">APGAR Score :</label>
							<div class="col-md-4"><!-- field apgar_1min type tinyInteger -->
								<div class="input-group">
									<input class="form-control" type="text" name="apgar_1min" value="{{ $note->apgar_1min }}" >
									<span class="input-group-addon">1 min</span>
								</div>
							</div>
							<div class="col-md-4"><!-- field apgar_5min type tinyInteger -->
								<div class="input-group">
									<input class="form-control" type="text" name="apgar_5min" value="{{ $note->apgar_1min }}">
									<span class="input-group-addon">5 min</span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12"><!-- field born_status type tinyInteger	-->
						<div class="form-group">
							<label for="born_status" class="col-md-2 control-label">Born status <a role="button" title="Click to reset." class="radio-reset" target="born_status"><span class="fa fa-remove"></span></a> :</label>
							<div class="col-md-10">
								<label class="radio-inline"><input type="radio" name="born_status" {{ $note->born_status == 1 ? 'checked' : '' }} value="1">Alive</label>
								<label class="radio-inline"><input type="radio" name="born_status" {{ $note->born_status == 2 ? 'checked' : '' }} value="2">Dead</label>
							</div>
						</div>
					</div>
					<div class="col-md-12"><!-- field skin_color type tinyInteger	-->
						<div class="form-group">
							<label for="skin_color" class="col-md-2 control-label">Skin color <a title="Skin color/Complexion"><span class="fa fa-info-circle"></span></a> <a role="button" title="Click to reset." class="radio-reset" target="skin_color"><span class="fa fa-remove"></span></a> :</label>
							<div class="col-md-10">
								<label class="radio-inline"><input type="radio" name="skin_color" {{ $note->skin_color == 1 ? 'checked' : '' }} value="1">blue or pale all over</label>
								<label class="radio-inline"><input type="radio" name="skin_color" {{ $note->skin_color == 2 ? 'checked' : '' }} value="2">blue at extremities</label>
								<label class="radio-inline"><input type="radio" name="skin_color" {{ $note->skin_color == 3 ? 'checked' : '' }} value="3">no cyanosis</label>
								<label class="radio-inline"><input type="radio" name="skin_color" {{ $note->skin_color == 4 ? 'checked' : '' }} value="4">body pink</label>
								<label class="radio-inline"><input type="radio" name="skin_color" {{ $note->skin_color == 5 ? 'checked' : '' }} value="5">body and extremities pink</label>
							</div>
						</div>
					</div>
					<div class="col-md-12"><!-- field pulse type tinyInteger	-->
						<div class="form-group">
							<label for="pulse" class="col-md-2 control-label">Pulse rate <a role="button" title="Click to reset." class="radio-reset" target="pulse"><span class="fa fa-remove"></span></a> :</label>
							<div class="col-md-10">
								<label class="radio-inline"><input type="radio" name="pulse" {{ $note->pulse == 1 ? 'checked' : '' }} value="1">Absent</label>
								<label class="radio-inline"><input type="radio" name="pulse" {{ $note->pulse == 2 ? 'checked' : '' }} value="2">&lt 100</label>
								<label class="radio-inline"><input type="radio" name="pulse" {{ $note->pulse == 3 ? 'checked' : '' }} value="3">&ge; 100</label>
							</div>
						</div>
					</div>
					<div class="col-md-12"><!-- field reflex type tinyInteger	-->
						<div class="form-group">
							<label for="reflex" class="col-md-2 control-label">Reflex <a title="Reflex irritability"><span class="fa fa-info-circle"></span></a> <a role="button" title="Click to reset." class="radio-reset" target="reflex"><span class="fa fa-remove"></span></a> :</label>
							<div class="col-md-10">
								<label class="radio-inline"><input type="radio" name="reflex" {{ $note->reflex == 1 ? 'checked' : '' }} value="1">no response to stimulation</label>
								<label class="radio-inline"><input type="radio" name="reflex" {{ $note->reflex == 2 ? 'checked' : '' }} value="2">grimace/feeble cry when stimulated</label>
								<label class="radio-inline"><input type="radio" name="reflex" {{ $note->reflex == 3 ? 'checked' : '' }} value="3">cry or pull away when stimulated</label>
							</div>
						</div>
					</div>
					<div class="col-md-12"><!-- field muscle_tone type tinyInteger	-->
						<div class="form-group">
							<label for="muscle_tone" class="col-md-2 control-label">Muscle tone <a role="button" title="Click to reset." class="radio-reset" target="muscle_tone"><span class="fa fa-remove"></span></a> :</label>
							<div class="col-md-10">
								<label class="radio-inline"><input type="radio" name="muscle_tone" {{ $note->muscle_tone == 1 ? 'checked' : '' }} value="1">none</label>
								<label class="radio-inline"><input type="radio" name="muscle_tone" {{ $note->muscle_tone == 2 ? 'checked' : '' }} value="2">some flexion</label>
								<label class="radio-inline"><input type="radio" name="muscle_tone" {{ $note->muscle_tone == 3 ? 'checked' : '' }} value="3">flexed arms and legs that resist extension</label>
							</div>
						</div>
					</div>
					<div class="col-md-12"><!-- field breathing type tinyInteger	-->
						<div class="form-group">
							<label for="breathing" class="col-md-2 control-label">Breathing <a role="button" title="Click to reset." class="radio-reset" target="breathing"><span class="fa fa-remove"></span></a> :</label>
							<div class="col-md-10">
								<label class="radio-inline"><input type="radio" name="breathing" {{ $note->breathing == 1 ? 'checked' : ''}} value="1">absent</label>
								<label class="radio-inline"><input type="radio" name="breathing" {{ $note->breathing == 2 ? 'checked' : ''}} value="2">weak, irregular, gasping</label>
								<label class="radio-inline"><input type="radio" name="breathing" {{ $note->breathing == 3 ? 'checked' : ''}} value="3">strong, lusty cry</label>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="panel panel-info">
			<div class="panel-heading">Disease or Abnormality</div>
			<div class="panel-body">
				<div class="panel panel-default">
					<div class="panel-heading">Jaundice</div>
					<div class="panel-body form-horizotal row">
						<div class="col-md-4"><!-- field jaundice_physiological type checkbox -->
							<div class="checkbox"><label class="control-label"><input type="checkbox" {{ $note->jaundice_physiological ? 'checked' : '' }} name="jaundice_physiological">
							Physiological jaundice
							</label></div>
						</div>
						<div class="col-md-8"><!-- field jaundice_neonatal_preterm_delivery type checkbox -->
							<div class="checkbox"><label class="control-label"><input type="checkbox" {{ $note->jaundice_neonatal_preterm_delivery ? 'checked' : '' }} name="jaundice_neonatal_preterm_delivery">
							Neonatal jaundice associated with preterm delivery
							</label></div>
						</div>
						<div class="col-md-4"><!-- field jaundice_neonatal_breast_milk type checkbox -->
							<div class="checkbox"><label class="control-label"><input type="checkbox" {{ $note->jaundice_neonatal_breast_milk ? 'checked' : '' }} name="jaundice_neonatal_breast_milk">
							Neonatal jaundice from breast milk
							</label></div>
						</div>
						<div class="col-md-4"><!-- field jaundice_ABO_incompatible type checkbox -->
							<div class="checkbox"><label class="control-label"><input type="checkbox" {{ $note->jaundice_ABO_incompatible ? 'checked' : '' }} name="jaundice_ABO_incompatible">
							ABO incompatible
							</label></div>
						</div>
						<div class="col-md-4"><!-- field jaundice_G_6_PD_deficiency type checkbox -->
							<div class="checkbox"><label class="control-label"><input type="checkbox" {{ $note->jaundice_G_6_PD_deficiency ? 'checked' : '' }} name="jaundice_G_6_PD_deficiency">
							G-6-PD deficiency
							</label></div>
						</div>
						<div class="col-md-4"><!-- field jaundice_unspecified type checkbox -->
							<div class="checkbox"><label class="control-label"><input type="checkbox" {{ $note->jaundice_unspecified ? 'checked' : '' }} name="jaundice_unspecified">
							Unspecified jaundice
							</label></div>
						</div>
						<div class="col-md-12"><!-- field other_jaundice type string -->
							<textarea name="other_jaundice" id="other_jaundice" class="form-control text_area_feedback" rows="1" maxlength="255" placeholder="Specified other jaundice. 255 character max.">{{ $note->other_jaundice }}</textarea>
							<div id="other_jaundice_feedback" style="color:#b3b3b3"></div>
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">Birth asphyxia</div>
					<div class="panel-body form-horizontal row">
						<div class="col-md-12"><!-- field birth_asphyxia type tinyInteger	-->
							<div class="form-group">
								<label for="birth_asphyxia" class="col-md-2 control-label">Lavel <a role="button" title="Click to reset." class="radio-reset" target="birth_asphyxia"><span class="fa fa-remove"></span></a> :</label>
								<div class="col-md-10">
									<label class="radio-inline"><input type="radio" name="birth_asphyxia" {{ $note->birth_asphyxia == 1 ? 'checked' : '' }} value="1">mild</label>
									<label class="radio-inline"><input type="radio" name="birth_asphyxia" {{ $note->birth_asphyxia == 2 ? 'checked' : '' }} value="2">moderate</label>
									<label class="radio-inline"><input type="radio" name="birth_asphyxia" {{ $note->birth_asphyxia == 3 ? 'checked' : '' }} value="3">severe</label>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">Summary of care</div>
					<div class="panel-body form-horizontal row">					
						<div class="col-md-4"><!-- field care_supervision_healthy type checkbox -->
							<div class="checkbox"><label class="control-label"><input type="checkbox" {{ $note->care_supervision_healthy ? 'checked' : '' }} name="care_supervision_healthy">Supervision and care of healthy newborn</label></div>
						</div>
						<div class="col-md-2"><!-- field care_phototherapy type checkbox -->
							<div class="checkbox"><label class="control-label"><input type="checkbox" {{ $note->care_phototherapy ? 'checked' : '' }} name="care_phototherapy">Phototherapy</label></div>
						</div>
						<div class="col-md-2"><!-- field care_frenulotomy type checkbox -->
							<div class="checkbox"><label class="control-label"><input type="checkbox" {{ $note->care_frenulotomy ? 'checked' : '' }} name="care_frenulotomy">Frenulotomy</label></div>
						</div>
						<div class="col-md-2"><!-- field care_UVA type checkbox -->
							<div class="checkbox"><label class="control-label"><input type="checkbox" {{ $note->care_UVA ? 'checked' : '' }} name="care_UVA">UVA</label></div>
						</div>
						<div class="col-md-2"><!-- field care_UVC type checkbox -->
							<div class="checkbox"><label class="control-label"><input type="checkbox" {{ $note->care_UVC ? 'checked' : '' }} name="care_UVC">UVC</label></div>
						</div>
						<div class="col-md-4"><!-- field care_ET_tube_intubation type checkbox -->
							<div class="checkbox"><label class="control-label"><input type="checkbox" {{ $note->care_ET_tube_intubation ? 'checked' : '' }} name="care_ET_tube_intubation">E-T tube Intubation</label></div>
						</div>
						<div class="col-md-12"><!-- field other_care type string -->
							<textarea name="other_care" id="other_care" class="form-control text_area_feedback" rows="1" maxlength="255" placeholder="Specified other care. 255 characters max.">{{ $note->other_care }}</textarea>
							<div id="other_care_feedback" style="color:#b3b3b3"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="panel panel-primary" id="maternity_data_panel">
	<div class="panel-heading">Maternity Data</div> 
	<div class="panel-body">
		<div class="form-horizontal row">
			<div class="col-md-6">
				<div class="col-md-6"><!-- field G type tinyInteger -->
					<div class="form-group">
						<label class="control-label col-md-4" for="">G :</label>
						<div class="col-md-8">
							<div class="input-group">
								<span class="input-group-addon"><span class="fa fa-times-circle-o"></span></span>
								<input class="form-control" type="text" name="G">
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6"><!-- field P type tinyInteger -->
					<div class="form-group">
						<label class="control-label col-md-4" for="">P :</label>
						<div class="col-md-8">
							<div class="input-group">
								<span class="input-group-addon"><span class="fa fa-times-circle-o"></span></span>
								<input class="form-control" type="text" name="P">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label col-md-4" for="">GA :</label>
					<div class="col-md-4"><!-- field GA_weeks type tinyInteger -->
						<div class="input-group">
							<input class="form-control" type="text" name="GA_weeks">
							<span class="input-group-addon">weeks</span>
						</div>
					</div>
					<div class="col-md-4"><!-- field GA_days type tinyInteger -->
						<div class="input-group">
							<input class="form-control" type="text" name="GA_days">
							<span class="input-group-addon">days</span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">Pregnancy Complication</div>
			<div class="panel-body form-horizontal row">
				<div class="col-md-3"><!-- field no_pregnancy_complication type checkbox -->
					<div class="checkbox"><label class="control-label"><input class="pregnancy-complication" type="checkbox" {{ $note->no_pregnancy_complication ? 'checked' : '' }} name="no_pregnancy_complication">None</label></div>
				</div>
				<div class="col-md-3"><!-- field pregnancy_complication_PROM type checkbox -->
					<div class="checkbox"><label class="control-label"><input class="pregnancy-complication" type="checkbox" {{ $note->pregnancy_complication_PROM ? 'checked' : '' }} name="pregnancy_complication_PROM">PROM <a title="Premature Rupture Of Membrane"><span class="fa fa-info-circle"></span></a></label></div>
				</div>
				<div class="col-md-3"><!-- field pregnancy_complication_fail_labour_meds_induce type checkbox -->
					<div class="checkbox"><label class="control-label"><input class="pregnancy-complication" type="checkbox" {{ $note->pregnancy_complication_fail_labour_meds_induce ? 'checked' : '' }} name="pregnancy_complication_fail_labour_meds_induce">Fail medical induction of labor</label></div>
				</div>
				<div class="col-md-3"><!-- field pregnancy_complication_subserous_myoma type checkbox -->
					<div class="checkbox"><label class="control-label"><input class="pregnancy-complication" type="checkbox" {{ $note->pregnancy_complication_subserous_myoma ? 'checked' : '' }} name="pregnancy_complication_subserous_myoma">Subserous myoma</label></div>
				</div>
				<div class="col-md-3"><!-- field pregnancy_complication_gestational_HT type checkbox -->
					<div class="checkbox"><label class="control-label"><input class="pregnancy-complication" type="checkbox" {{ $note->pregnancy_complication_gestational_HT ? 'checked' : '' }} name="pregnancy_complication_gestational_HT">Gestational HT</label></div>
				</div>
				<div class="col-md-3"><!-- field pregnancy_complication_adenomyosis type checkbox -->
					<div class="checkbox"><label class="control-label"><input class="pregnancy-complication" type="checkbox" {{ $note->pregnancy_complication_adenomyosis ? 'checked' : '' }} name="pregnancy_complication_adenomyosis">Adenomyosis</label></div>
				</div>
				<div class="col-md-3"><!-- field pregnancy_complication_advanced_maternal_age type checkbox -->
					<div class="checkbox"><label class="control-label"><input class="pregnancy-complication" type="checkbox" {{ $note->pregnancy_complication_advanced_maternal_age ? 'checked' : '' }} name="pregnancy_complication_advanced_maternal_age">Advanced maternal age</label></div>
				</div>
				<div class="col-md-3"><!-- field pregnancy_complication_alpha_thal_trait type checkbox -->
					<div class="checkbox"><label class="control-label"><input class="pregnancy-complication" type="checkbox" {{ $note->pregnancy_complication_alpha_thal_trait ? 'checked' : '' }} name="pregnancy_complication_alpha_thal_trait">&alpha; Thal trait</label></div>
				</div>
				<div class="col-md-3"><!-- field pregnancy_complication_Hb_E_trait type checkbox -->
					<div class="checkbox"><label class="control-label"><input class="pregnancy-complication" type="checkbox" {{ $note->pregnancy_complication_Hb_E_trait ? 'checked' : '' }} name="pregnancy_complication_Hb_E_trait">Hb E trait</label></div>
				</div>
				<div class="col-md-3"><!-- field pregnancy_complication_pre_C_S_labour_pain type checkbox -->
					<div class="checkbox"><label class="control-label"><input class="pregnancy-complication" type="checkbox" {{ $note->pregnancy_complication_pre_C_S_labour_pain ? 'checked' : '' }} name="pregnancy_complication_pre_C_S_labour_pain">Previouse C/S with labour pain</label></div>
				</div>
				<div class="col-md-4"><!-- field pregnancy_complication_pre_C_S_labour_no_pain type checkbox -->
					<div class="checkbox"><label class="control-label"><input class="pregnancy-complication" type="checkbox" {{ $note->pregnancy_complication_pre_C_S_labour_no_pain ? 'checked' : '' }} name="pregnancy_complication_pre_C_S_labour_no_pain">Previouse C/S without labour pain</label></div>
				</div>
				<div class="col-md-4"><!-- field pregnancy_complication_Hx_clear_cell_adeno_CA_ovary type checkbox -->
					<div class="checkbox"><label class="control-label"><input class="pregnancy-complication" type="checkbox" {{ $note->pregnancy_complication_Hx_clear_cell_adeno_CA_ovary ? 'checked' : '' }} name="pregnancy_complication_Hx_clear_cell_adeno_CA_ovary">Hx of clear cell adeno CA of ovary</label></div>
				</div>
				<div class="col-md-12"><!-- field other_pregnancy_complication type string -->
					<textarea name="other_pregnancy_complication" id="other_pregnancy_complication" class="form-control text_area_feedback" rows="1" maxlength="255" placeholder="Specified other pregnancy complication. 255 characters max.">{{ $note->other_pregnancy_complication }}</textarea>
					<div id="other_pregnancy_complication_feedback" style="color:#b3b3b3"></div>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			//@func
			$('.pregnancy-complication').click(function() {
				if ($(this).prop('name') == 'no_pregnancy_complication') {
					$('textarea[name=other_pregnancy_complication]').val('');
					$('.pregnancy-complication').prop('checked', false);
					$(this).prop('checked', true);
				} else {
					$('input[name=no_pregnancy_complication]').prop('checked', false);
					if ($(this).prop('name') == 'pregnancy_complication_pre_C_S_labour_pain') {
						$('input[name=pregnancy_complication_pre_C_S_labour_no_pain]').prop('checked', false);
					} else {
						if ($(this).prop('name') == 'pregnancy_complication_pre_C_S_labour_no_pain')
						$('input[name=pregnancy_complication_pre_C_S_labour_pain]').prop('checked', false);
					}

				}
			});
			$('textarea[name=other_pregnancy_complication]').focusout(function() {
				if ($(this).val() != '')
					$('input[name=no_pregnancy_complication]').prop('checked', false);
			});
		</script>
		@include('obgyn.notes.partials.first_2nd_stage_labour_complication')
		@include('obgyn.notes.partials.delivery_mode')
		<div class="panel panel-default">
			<div class="panel-heading">Labour Complication Stage III</div>
			<div class="panel-body form-horizontal row">
				<div class="col-md-12 collapse in"><!-- field other_3rd_stage_labour_complication type string -->
					<textarea name="other_3rd_stage_labour_complication" id="other_3rd_stage_labour_complication" class="form-control text_area_feedback" rows="1" maxlength="255" placeholder="Specified labour complication stage III. 255 characters max.">{{ $note->other_3rd_stage_labour_complication }}</textarea>
					<div id="other_labour_complication_3_feedback" style="color:#b3b3b3"></div>
				</div>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">Postpartum Complication</div>
			<div class="panel-body form-horizontal row">
				<div class="col-md-2"><!-- field no_postpartum_complication type checkbox -->
					<div class="checkbox"><label class="control-label"><input type="checkbox" {{ $note->no_postpartum_complication ? 'checked' : '' }} name="no_postpartum_complication">None</label></div>
				</div>
				<div class="col-md-2"><!-- field postpartum_complication_endometritis type checkbox -->
					<div class="checkbox"><label class="control-label"><input type="checkbox" {{ $note->postpartum_complication_endometritis ? 'checked' : '' }} name="postpartum_complication_endometritis">Endometritis</label></div>
				</div>
				<div class="col-md-3"><!-- field postpartum_complication_PPH type checkbox -->
					<div class="checkbox"><label class="control-label"><input type="checkbox" {{ $note->postpartum_complication_PPH ? 'checked' : '' }} name="postpartum_complication_PPH">PostPartum Hemorrhage</label></div>
				</div>
				<div class="col-md-12"><!-- field other_postpartum_complication type string -->
					<textarea name="other_postpartum_complication" id="other_postpartum_complication" class="form-control text_area_feedback" rows="1" maxlength="255" placeholder="Specified other labour complication. 255 characters max.">{{ $note->other_postpartum_complication }}</textarea>
					<div id="other_labour_complication_1_2_feedback" style="color:#b3b3b3"></div>
				</div>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">Placenta</div>
			<div class="panel-body form-horizontal row">
				<div class="col-md-6"><!-- field placenta_weight_grams type smallInteger -->
					<div class="form-group">
						<label class="control-label col-md-4" for="">Placenta weight :</label>
						<div class="col-md-8">
							<div class="input-group">
								<input class="form-control" type="text" name="placenta_weight_grams" value="{{ $note->placenta_weight_grams }}">
								<span class="input-group-addon">grams</span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6"><!-- field specificed_placenta_abnomality type string -->
					<div class="form-group">
						<label class="control-label col-md-4" for="">Abnomality :</label>
						<div class="col-md-8">
							<input class="form-control" type="text" name="specificed_placenta_abnomality" value="{{ $note->specificed_placenta_abnomality }}">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="panel panel-primary" id="home_nursing_panel"><!-- field home_nursing type string -->
	<div class="panel-heading">Home Nursing</div> 
	<div class="panel-body">
		<textarea name="home_nursing" id="home_nursing" class="form-control text_area_feedback" rows="1" maxlength="255" placeholder="255 characters max.">{{ $note->home_nursing }}</textarea>
		<div id="home_nursing_feedback" style="color:#b3b3b3"></div>
	</div>
</div>

<div class="panel panel-primary" id="appointment_panel">
	<div class="panel-heading">
		<div class="row">
			<div class="col-md-6 text-left">Appointment</div>
			<div class="col-md-6 text-right"><a role="button"><span class="label label-danger" id="appointment-minus" style="display: none;"><span class="fa fa-minus-circle" ></span></span></a> <a role="button"><span class="label label-success" id="appointment-plus" no="1"><span class="fa fa-plus-circle" ></span></span></a></div>
		</div>
	</div>
	<script type="text/javascript">
		$('#appointment-plus').click(function() {
			var no = parseInt($(this).attr('no'));
			if (no >= 4) {
				$(this).css('display', 'none');
				$('#appointment_collapse_5').collapse('show');
				$(this).attr('no', 5);
			} else {
				no += 1;
				$(this).attr('no', no);
				$('#appointment_collapse_' + no).collapse('show');
				$('#appointment-minus').removeAttr('style');
			}
		}); // Add appointment.
		$('#appointment-minus').click(function() {
			var no = parseInt($('#appointment-plus').attr('no'));
			if (no <= 5) $('#appointment-plus').removeAttr('style');
			
			$('input[name=date_appointment_' + no + ']').val('');
			$('input[name=detail_appointment_' + no + ']').val('');
			$('#appointment_collapse_' + no).collapse('hide');

			no -= 1;
			$('#appointment-plus').attr('no', no);
			if (no == 1) $(this).css('display', 'none');
		}); // Remove last appointment.
	</script>
	<div class="panel-body form-horizontal row">
		<div class="collapse in" id="appointment_collapse_1">
			<div class='col-md-4'><!-- field date_appointment_1 type date -->
				<div class="form-group">
					<label class="control-label col-md-4" for="date_appointment_1"># 1 :</label>
					<div class="col-md-8">
						<div class="input-group date" id='datetimepicker_date_appointment_1'>
							<input type='text' class="form-control handle-datetime" name="date_appointment_1" id="date_appointment_1" value="{{ $note->date_appointment_1 ? $note->date_appointment_1->format('d-m-Y') : '' }}" />
							<span class="input-group-addon"><span class="fa fa-calendar-plus-o"></span></span>
						</div>
					</div>
				</div>
			</div>
			<div class='col-md-8'><!-- field detail_appointment_1 type string -->
				<div class="form-group">
					<label class="control-label col-md-4" for="detail_appointment_1">Detail :</label>
					<div class='col-md-8'>
						<input class="form-control" type="text" name="detail_appointment_1" value="{{ $note->detail_appointment_1 }}">
					</div>
				</div>
			</div>
		</div>

		<div class="collapse" id="appointment_collapse_2">
			<div class='col-md-4'><!-- field date_appointment_2 type date -->
				<div class="form-group">
					<label class="control-label col-md-4" for="date_appointment_2"># 2 :</label>
					<div class="col-md-8">
						<div class="input-group date" id='datetimepicker_date_appointment_2'>
							<input type='text' class="form-control handle-datetime" name="date_appointment_2" id="date_appointment_2" value="{{ $note->date_appointment_2 ? $note->date_appointment_2->format('d-m-Y') : '' }}" />
							<span class="input-group-addon"><span class="fa fa-calendar-plus-o"></span></span>
						</div>
					</div>
				</div>
			</div>
			<div class='col-md-8'><!-- field detail_appointment_2 type string -->
				<div class="form-group">
					<label class="control-label col-md-4" for="detail_appointment_2">Detail :</label>
					<div class='col-md-8'>
						<input class="form-control" type="text" name="detail_appointment_2" value="{{ $note->detail_appointment_2 }}">
					</div>
				</div>
			</div>
		</div>

		<div class="collapse" id="appointment_collapse_3">
			<div class='col-md-4'><!-- field date_appointment_3 type date -->
				<div class="form-group">
					<label class="control-label col-md-4" for="date_appointment_3"># 3 :</label>
					<div class="col-md-8">
						<div class="input-group date" id='datetimepicker_date_appointment_3'>
							<input type='text' class="form-control handle-datetime" name="date_appointment_3" id="date_appointment_3" value="{{ $note->date_appointment_3 ? $note->date_appointment_3->format('d-m-Y') : '' }}" />
							<span class="input-group-addon"><span class="fa fa-calendar-plus-o"></span></span>
						</div>
					</div>
				</div>
			</div>
			<div class='col-md-8'><!-- field detail_appointment_3 type string -->
				<div class="form-group">
					<label class="control-label col-md-4" for="detail_appointment_3">Detail :</label>
					<div class='col-md-8'>
						<input class="form-control" type="text" name="detail_appointment_3" value="{{ $note->detail_appointment_3 }}">
					</div>
				</div>
			</div>
		</div>

		<div class="collapse" id="appointment_collapse_4">
			<div class='col-md-4'><!-- field date_appointment_4 type date -->
				<div class="form-group">
					<label class="control-label col-md-4" for="date_appointment_4"># 4 :</label>
					<div class="col-md-8">
						<div class="input-group date" id='datetimepicker_date_appointment_4'>
							<input type='text' class="form-control handle-datetime" name="date_appointment_4" id="date_appointment_4" value="{{ $note->date_appointment_4 ? $note->date_appointment_4->format('d-m-Y') : '' }}" />
							<span class="input-group-addon"><span class="fa fa-calendar-plus-o"></span></span>
						</div>
					</div>
				</div>
			</div>
			<div class='col-md-8'><!-- field detail_appointment_4 type string -->
				<div class="form-group">
					<label class="control-label col-md-4" for="detail_appointment_4">Detail :</label>
					<div class='col-md-8'>
						<input class="form-control" type="text" name="detail_appointment_4" value="{{ $note->detail_appointment_4 }}">
					</div>
				</div>
			</div>
		</div>

		<div class="collapse" id="appointment_collapse_5">
			<div class='col-md-4'><!-- field date_appointment_5 type date -->
				<div class="form-group">
					<label class="control-label col-md-4" for="date_appointment_5"># 5 :</label>
					<div class="col-md-8">
						<div class="input-group date" id='datetimepicker_date_appointment_5'>
							<input type='text' class="form-control handle-datetime" name="date_appointment_5" id="date_appointment_5" value="{{ $note->date_appointment_5 ? $note->date_appointment_5->format('d-m-Y') : '' }}" />
							<span class="input-group-addon"><span class="fa fa-calendar-plus-o"></span></span>
						</div>
					</div>
				</div>
			</div>
			<div class='col-md-8'><!-- field detail_appointment_5 type string -->
				<div class="form-group">
					<label class="control-label col-md-4" for="detail_appointment_5">Detail :</label>
					<div class='col-md-8'>
						<input class="form-control" type="text" name="detail_appointment_5" value="{{ $note->detail_appointment_5 }}">
					</div>
				</div>
			</div>
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
$('.date').datetimepicker({
	locale: 'th',
	format: 'DD-MM-YYYY',
	showTodayButton: true,
	showClear: true
});

$(document).ready(function(){
	@if ($note->delivery_mode == 99)
		$('#other_delivery_mode_collapse').collapse('show');
	@endif
	@for ($i = 2; $i <= $note->lastSeenAppointmentData(); $i++)
		$('#appointment-plus').click();
	@endfor
});
</script>
@endsection