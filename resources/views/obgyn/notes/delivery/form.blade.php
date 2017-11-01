@extends('form')

@section('doc_title' , $note->note->type->name . ' - Form')

@section('description', 'siriraj faculty general note form')

@section('author', 'koramit Pichana')

@section('background_image',"url('/assets/images/blu_stripes.png');")

@section('nav_menu')
<li><a href="#admission_data">Admission data</a></li>
<li><a href="#pregnancy_panel">Pregnancy</a></li>
<li><a href="#labour_and_delivery_panel">Labour and Delivery</a></li>
<li><a href="#result_of_delivery">Result of Delivery</a></li>
<li><a href="#puerperium_panel">Puerperium</a></li>
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
		<div class='panel panel-default'>
			<div class="panel-heading">Complication during pregnancy and associated diseases and conditions</div>
			@include('obgyn.notes.partials.pregnancy_complication_panel_body')
		</div>
	</div>
</div>
<div class="panel panel-primary" id="labour_and_delivery_panel"><!-- Labour and Delivery panel. -->
	<div class="panel-heading">Labour and Delivery</div>
	<div class="panel-body ">
		<div class="form-horizontal row">
			<div class="col-md-6"><!-- field datetime_delivery type date -->
				<div class='form-group'>
					<label class="control-label col-md-6" for="datetime_delivery">Date-time of Delivery :</label>
					<div class="col-md-6">
						<div class="input-group date" id='datetimepicker_datetime_delivery'>
							<input type='text' class="form-control handle-datetime" name="datetime_delivery" value="{{ is_null($note->datetime_delivery) ? '' : $note->datetime_delivery->format('d-m-Y H:i') }}" id="datetime_delivery" />
							<span class="input-group-addon"><span class="fa fa-calendar"></span></span>
						</div>
					</div>
				</div>
			</div>
		</div>
		@include('obgyn.notes.partials.first_2nd_stage_labour_complication')
		@include('obgyn.notes.partials.delivery_mode')
		<div class="form-horizontal row"><!-- Meconium, episiotomy, perinealtear -->
			<div class="col-md-12"><!-- field meconium_stain_in_amniotic_fluid type tinyIntegereger -->
				<div class="form-group">
					<label class="col-md-4 control-label" for="meconium_stain_in_amniotic_fluid">Meconium stain in amniotic fluid <a role="button" title="Click to reset." class="radio-reset" target="meconium_stain_in_amniotic_fluid"><span class="fa fa-remove"></span></a> :</label>
					<div class="col-md-8">
						<label class="radio-inline"><input type="radio" value="0" name="meconium_stain_in_amniotic_fluid" {{ $note->meconium_stain_in_amniotic_fluid === '0' ? 'checked' : '' }}>No</label>
						<label class="radio-inline"><input type="radio" value="1" name="meconium_stain_in_amniotic_fluid" {{ $note->meconium_stain_in_amniotic_fluid == 1 ? 'checked' : '' }}>Yes</label>
					</div>	
				</div>
			</div>
			<div class="col-md-12"><!-- field episiotomy type tinyIntegereger -->
				<div class="form-group">
					<label class="col-md-4 control-label" for="episiotomy">Episiotomy <a role="button" title="Click to reset." class="radio-reset" target="episiotomy"><span class="fa fa-remove"></span></a> :</label>
					<div class="col-md-8">
						<label class="radio-inline"><input type="radio" value="0" name="episiotomy" {{ $note->episiotomy === '0' ? 'checked' : '' }} >No</label>
						<label class="radio-inline"><input type="radio" value="1" name="episiotomy" {{ $note->episiotomy == 1 ? 'checked' : '' }} >Yes</label>
					</div>	
				</div>
			</div>
			<div class="col-md-12"><!-- field perineal_tear type tinyIntegereger -->
				<div class="form-group">
					<label class="col-md-4 control-label" for="episiotomy">Perineal tear <a role="button" title="Click to reset." class="radio-reset" target="perineal_tear"><span class="fa fa-remove"></span></a> :</label>
					<div class="col-md-8">
						<label class="radio-inline"><input type="radio" value="0"  {{ $note->perineal_tear === '0' ? 'checked' : '' }} name="perineal_tear">No</label>
						<label class="radio-inline"><input type="radio" value="1"  {{ $note->perineal_tear == 1 ? 'checked' : '' }} name="perineal_tear">1st degree</label>
						<label class="radio-inline"><input type="radio" value="2"  {{ $note->perineal_tear == 2 ? 'checked' : '' }} name="perineal_tear">2nd degree</label>
						<label class="radio-inline"><input type="radio" value="3"  {{ $note->perineal_tear == 3 ? 'checked' : '' }} name="perineal_tear">3rd degree</label>
						<label class="radio-inline"><input type="radio" value="4"  {{ $note->perineal_tear == 4 ? 'checked' : '' }} name="perineal_tear">4th degree</label>
						<label class="radio-inline"><input type="radio" value="99" {{ $note->perineal_tear == 99 ? 'checked' : '' }}  name="perineal_tear" other="true">other</label>
					</div>	
				</div>
			</div>
			<div class="col-md-12 collapse" id="other_tear_collapse"><!-- field other_perineal_tear type string -->
				<div class="form-group">
					<label class="col-md-4 control-label" for="other_perineal_tear">Other tear :</label>
					<div class="col-md-8">
						<input type="text" name="other_perineal_tear" value="{{ $note->other_perineal_tear }}" class="form-control" placeholder="Specify other perineal tear.">
					</div>
				</div>
			</div>
		</div>
		<div class="panel panel-default"><!-- Complication during third stage of labour -->
			<div class="panel-heading">Complication during third stage of labour</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-2"><!-- field no_third_stage_labour_complication type checkbox -->
						<div class="checkbox"><label><input class="3rd-stage-labour-checkbox-complication" type="checkbox" {{ $note->no_third_stage_labour_complication ? 'checked' : '' }} name="no_third_stage_labour_complication" none="true">None</label></div>
					</div>
					<div class="col-md-2"><!-- field third_stage_labour_complication_PPH type checkbox -->
						<div class="checkbox"><label><input class="3rd-stage-labour-checkbox-complication" type="checkbox" {{ $note->third_stage_labour_complication_PPH ? 'checked' : '' }} name="third_stage_labour_complication_PPH">PPH <a title="Post Partum Hemorrhage"><span class="fa fa-info-circle"></span></a></label></div>
					</div>
					<div class="col-md-3"><!-- field third_stage_labour_complication_retained_placenta type checkbox -->
						<div class="checkbox"><label><input class="3rd-stage-labour-checkbox-complication" type="checkbox" {{ $note->third_stage_labour_complication_retained_placenta ? 'checked' : '' }} name="third_stage_labour_complication_retained_placenta">Retained placenta</label></div>
					</div>
					<div class="col-md-12"><!-- field other_third_stage_labour_complication type string -->
						<div class="form-group">
								<input class="form-control 3rd-stage-labour-text-complication" type="text" name="other_third_stage_labour_complication" value="{{ $note->other_third_stage_labour_complication }}" placeholder="Specify other complication.">
						</div>
					</div>
				</div>
				<div class="form-horizontal row">
					<div class="col-md-12"><!-- field third_stage_labour_complication_EBL_ml type smallInteger -->
						<div class="form-group">
							<label for="ebl" class="control-label col-md-2">EBL :</label>
							<div class="col-md-2">
								<div class="input-group">
									<input class="form-control 3rd-stage-labour-text-complication" type="text" name="third_stage_labour_complication_EBL_ml" value="{{ old('third_stage_labour_complication_EBL_ml') ? old('third_stage_labour_complication_EBL_ml') : $note->third_stage_labour_complication_EBL_ml }}">
									<span class="input-group-addon">ml</span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12"><!-- field third_stage_labour_complication_procedure type string -->
						<div class="form-group">
							<label for="ebl" class="control-label col-md-2">Procedure :</label>
							<div class="col-md-10">
								<textarea name="third_stage_labour_complication_procedure" id="third_stage_labour_complication_procedure" class="form-control text_area_feedback 3rd-stage-labour-text-complication" rows="1" maxlength="255" placeholder="Specify Procedure. 255 characters max.">{{ $note->third_stage_labour_complication_procedure }}</textarea>
								<div id="third_stage_labour_complication_procedure_feedback" style="color:#b3b3b3"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="panel panel-primary" id="result_of_delivery"><!-- Result of Delivery panel. -->
	<div class="panel-heading">Result of Delivery</div>
	<div class="panel-body">
		<div class="form-horizontal">
			<div class="form-group">
				<label class="control-label col-md-2" for="born_single_or_multiple">Delivery <a role="button" title="Click to reset." class="radio-reset" target="born_single_or_multiple"><span class="fa fa-remove"></span></a> :</label>
				<div class="col-md-1"><!-- field born_single_or_multiple type tinyInteger -->
					<label class="radio-inline"><input type="radio" name="born_single_or_multiple" {{ $note->born_single_or_multiple == 1 ? 'checked' : '' }} value="1">Single</label>
				</div>
				<div class="col-md-1">
					<label class="radio-inline"><input type="radio" name="born_single_or_multiple" {{ $note->born_single_or_multiple == 2 ? 'checked' : '' }} value="2">Multiple</label>
				</div>
				<div class="col-md-2"><!-- field multiple_born_number type tinyInteger -->
					<input class="form-control" type="text" name="multiple_born_number" value="{{ old('multiple_born_number') ? old('multiple_born_number') : $note->multiple_born_number }}" placeholder="Delivery No.">
				</div>
			</div>
		</div>
		<div class="panel panel-default collapse in" id="born_no_1"><!-- Born no 1 panel -->
			<div class="panel-heading">
				<div class="row">
					<div class="col-md-6 text-left">Born No.1</div>
					<div class="col-md-6 text-right">
						<a role="button" class="add_infant" no="1" id="click_born_no_1" style="display: none;"><span class="fa fa-plus-circle" id="icon_born_no_1"></span><span class="fa fa-child"></span></a>
					</div>
				</div>
			</div>
			<div class="panel-body form-horizontal row">
				<div class="col-md-6"><!-- field gender_born_no_1 type tynyInteger -->
					<div class="form-group">
						<label for="gender_born_no_1" class="col-md-4 control-label">Gender <a role="button" title="Click to reset." class="radio-reset" target="gender_born_no_1"><span class="fa fa-remove"></span></a> :</label>
						<div class="col-md-8">
							<label class="radio-inline"><input type="radio" no="1" name="gender_born_no_1" {{ $note->gender_born_no_1 === '0' ? 'checked' : '' }} value="0">Female</label>
							<label class="radio-inline"><input type="radio" no="1" name="gender_born_no_1" {{ $note->gender_born_no_1 == 1 ? 'checked' : '' }} value="1">Male</label>
							<label class="radio-inline"><input type="radio" no="1" name="gender_born_no_1" {{ $note->gender_born_no_1 == 2 ? 'checked' : '' }} value="2">Undifferentiated</label>
						</div>
					</div>
				</div>
				<div class="col-md-6"><!-- field weight_grams_born_no_1 type smallInteger -->
					<div class="form-group">
						<label for="weight_grams_born_no_1" class="col-md-4 control-label">Birth Weight :</label>
						<div class="col-md-8">
							<div class="input-group">
								<input class="form-control" type="text" name="weight_grams_born_no_1" value="{{ old('weight_grams_born_no_1') ? old('weight_grams_born_no_1') : $note->weight_grams_born_no_1 }}" >
								<span class="input-group-addon">grams</span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6"><!-- apgar -->
					<div class="form-group">
						<label for="apgar_1min_born_no_1" class="col-md-4 control-label">APGAR Score :</label>
						<div class="col-md-4"><!-- field apgar_1min_born_no_1 type tinyInteger -->
							<div class="input-group">
								<input class="form-control" type="text" name="apgar_1min_born_no_1" id="apgar_1min_born_no_1" value="{{ old('apgar_1min_born_no_1') ? old('apgar_1min_born_no_1') : $note->apgar_1min_born_no_1 }}" >
								<span class="input-group-addon">1 min</span>
							</div>
						</div>
						<div class="col-md-4"><!-- field apgar_5min_born_no_1 type tinyInteger -->
							<div class="input-group">
								<input class="form-control" type="text" name="apgar_5min_born_no_1" id="apgar_5min_born_no_1" value="{{ old('apgar_5min_born_no_1') ? old('apgar_5min_born_no_1') : $note->apgar_5min_born_no_1 }}">
								<span class="input-group-addon">5 min</span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12"><!-- field birth_status_born_no_1 type tinyInteger -->
					<div class="form-group">
						<label for="birth_status_born_no_1" class="col-md-2 control-label">Birth status <a role="button" title="Click to reset." class="radio-reset" target="birth_status_born_no_1"><span class="fa fa-remove"></span></a> :</label>
						<div class="col-md-10">
							<label class="radio-inline"><input type="radio" name="birth_status_born_no_1" {{ $note->birth_status_born_no_1 == 1 ? 'checked' : '' }} value="1">Livebirth normal</label>
							<label class="radio-inline"><input type="radio" name="birth_status_born_no_1" {{ $note->birth_status_born_no_1 == 2 ? 'checked' : '' }} value="2">Livebirth abnormal</label>
							<label class="radio-inline"><input type="radio" name="birth_status_born_no_1" {{ $note->birth_status_born_no_1 == 3 ? 'checked' : '' }} value="3">Stillbirth</label>
						</div>
					</div>
				</div>
				<div class="col-md-12"><!-- field note_born_no_1 type string -->
					<div class="form-group">
						<label for="note_born_no_1" class="col-md-2 control-label">Note :</label>
						<div class="col-md-10">
							<textarea name="note_born_no_1" id="note_born_no_1" class="form-control text_area_feedback" rows="1"  maxlength="255" placeholder="255 characters max.">{{ $note->note_born_no_1 }}</textarea>
							<div id="note_born_no_1_feedback" style="color:#b3b3b3"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="panel panel-default collapse" id="born_no_2"><!-- Born no 2 panel -->
			<div class="panel-heading">
				<div class="row">
					<div class="col-md-6 text-left">Born No.2</div>
					<div class="col-md-6 text-right">
						<a role="button" class="add_infant" no="2" id="click_born_no_2"><span class="fa fa-plus-circle" id="icon_born_no_2"></span><span class="fa fa-child"></span></a>
					</div>
				</div>
			</div>
			<div class="panel-body form-horizontal row">
				<div class="col-md-6"><!-- field gender_born_no_2 type tynyInteger -->
					<div class="form-group">
						<label for="gender_born_no_2" class="col-md-4 control-label">Gender <a role="button" title="Click to reset." class="radio-reset" target="gender_born_no_2"><span class="fa fa-remove"></span></a> :</label>
						<div class="col-md-8">
							<label class="radio-inline"><input type="radio" no="2" name="gender_born_no_2" {{ $note->gender_born_no_2 === '0' ? 'checked' : '' }} value="0">Female</label>
							<label class="radio-inline"><input type="radio" no="2" name="gender_born_no_2" {{ $note->gender_born_no_2 == 1 ? 'checked' : '' }} value="1">Male</label>
							<label class="radio-inline"><input type="radio" no="2" name="gender_born_no_2" {{ $note->gender_born_no_2 == 2 ? 'checked' : '' }} value="2">Undifferentiated</label>
						</div>
					</div>
				</div>
				<div class="col-md-6"><!-- field weight_grams_born_no_2 type smallInteger -->
					<div class="form-group">
						<label for="weight_grams_born_no_2" class="col-md-4 control-label">Birth Weight :</label>
						<div class="col-md-8">
							<div class="input-group">
								<input class="form-control" type="text" name="weight_grams_born_no_2" value="{{ old('weight_grams_born_no_2') ? old('weight_grams_born_no_2') : $note->weight_grams_born_no_2 }}" >
								<span class="input-group-addon">grams</span>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-6"><!-- apgar -->
					<div class="form-group">
						<label for="apgar_1min_born_no_2" class="col-md-4 control-label">APGAR Score :</label>
						<div class="col-md-4"><!-- field apgar_1min_born_no_2 type tinyInteger -->
							<div class="input-group">
								<input class="form-control" type="text" name="apgar_1min_born_no_2" value="{{ old('apgar_1min_born_no_2') ? old('apgar_1min_born_no_2') : $note->apgar_1min_born_no_2 }}" >
								<span class="input-group-addon">1 min</span>
							</div>
						</div>
						<div class="col-md-4"><!-- field apgar_5min_born_no_2 type tinyInteger -->
							<div class="input-group">
								<input class="form-control" type="text" name="apgar_5min_born_no_2" value="{{ old('apgar_5min_born_no_2') ? old('apgar_5min_born_no_2') : $note->apgar_5min_born_no_2 }}">
								<span class="input-group-addon">5 min</span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12"><!-- field birth_status_born_no_2 type tinyInteger -->
					<div class="form-group">
						<label for="birth_status_born_no_2" class="col-md-2 control-label">Birth status <a role="button" title="Click to reset." class="radio-reset" target="birth_status_born_no_2"><span class="fa fa-remove"></span></a> :</label>
						<div class="col-md-10">
							<label class="radio-inline"><input type="radio" name="birth_status_born_no_2" {{ $note->birth_status_born_no_2 == 1 ? 'checked' : '' }} value="1">Livebirth normal</label>
							<label class="radio-inline"><input type="radio" name="birth_status_born_no_2" {{ $note->birth_status_born_no_2 == 2 ? 'checked' : '' }} value="2">Livebirth abnormal</label>
							<label class="radio-inline"><input type="radio" name="birth_status_born_no_2" {{ $note->birth_status_born_no_2 == 3 ? 'checked' : '' }} value="3">Stillbirth</label>
						</div>
					</div>
				</div>

				<div class="col-md-12"><!-- field note_born_no_2 type string -->
					<div class="form-group">
						<label for="note_born_no_2" class="col-md-2 control-label">Note :</label>
						<div class="col-md-10">
							<textarea name="note_born_no_2" id="note_born_no_2" class="form-control text_area_feedback" rows="1"  maxlength="255" placeholder="255 characters max.">{{ $note->note_born_no_2 }}</textarea>
							<div id="note_born_no_2_feedback" style="color:#b3b3b3"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="panel panel-default collapse" id="born_no_3"><!-- Born no 3 panel -->
			<div class="panel-heading">
				<div class="row">
					<div class="col-md-6 text-left">Born No.3</div>
					<div class="col-md-6 text-right">
						<a role="button" class="add_infant" no="3" id="click_born_no_3"><span class="fa fa-plus-circle" id="icon_born_no_3"></span><span class="fa fa-child"></span></a>
					</div>
				</div>
			</div>
			<div class="panel-body form-horizontal row">
				<div class="col-md-6"><!-- field gender_born_no_3 type tynyInteger -->
					<div class="form-group">
						<label for="gender_born_no_3" class="col-md-4 control-label">Gender <a role="button" title="Click to reset." class="radio-reset" target="gender_born_no_3"><span class="fa fa-remove"></span></a> :</label>
						<div class="col-md-8">
							<label class="radio-inline"><input type="radio" no="3" name="gender_born_no_3" {{ $note->gender_born_no_3 === '0' ? 'checked' : '' }} value="0">Female</label>
							<label class="radio-inline"><input type="radio" no="3" name="gender_born_no_3" {{ $note->gender_born_no_3 == 1 ? 'checked' : '' }} value="1">Male</label>
							<label class="radio-inline"><input type="radio" no="3" name="gender_born_no_3" {{ $note->gender_born_no_3 == 2 ? 'checked' : '' }} value="2">Undifferentiated</label>
						</div>
					</div>
				</div>
				<div class="col-md-6"><!-- field weight_grams_born_no_3 type smallInteger -->
					<div class="form-group">
						<label for="weight_grams_born_no_3" class="col-md-4 control-label">Birth Weight :</label>
						<div class="col-md-8">
							<div class="input-group">
								<input class="form-control" type="text" name="weight_grams_born_no_3" value="{{ old('weight_grams_born_no_3') ? old('weight_grams_born_no_3') : $note->weight_grams_born_no_3 }}" >
								<span class="input-group-addon">grams</span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6"><!-- apgar -->
					<div class="form-group">
						<label for="apgar_1min_born_no_3" class="col-md-4 control-label">APGAR Score :</label>
						<div class="col-md-4"><!-- field apgar_1min_born_no_3 type tinyInteger -->
							<div class="input-group">
								<input class="form-control" type="text" name="apgar_1min_born_no_3" value="{{ old('apgar_1min_born_no_3') ? old('apgar_1min_born_no_3') : $note->apgar_1min_born_no_3 }}" >
								<span class="input-group-addon">1 min</span>
							</div>
						</div>
						<div class="col-md-4"><!-- field apgar_5min_born_no_3 type tinyInteger -->
							<div class="input-group">
								<input class="form-control" type="text" name="apgar_5min_born_no_3" value="{{ old('apgar_5min_born_no_3') ? old('apgar_5min_born_no_3') : $note->apgar_5min_born_no_3 }}">
								<span class="input-group-addon">5 min</span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12"><!-- field birth_status_born_no_3 type tinyInteger -->
					<div class="form-group">
						<label for="birth_status_born_no_3" class="col-md-2 control-label">Birth status <a role="button" title="Click to reset." class="radio-reset" target="birth_status_born_no_3"><span class="fa fa-remove"></span></a> :</label>
						<div class="col-md-10">
							<label class="radio-inline"><input type="radio" name="birth_status_born_no_3" {{ $note->birth_status_born_no_3 == 1 ? 'checked' : '' }} value="1">Livebirth normal</label>
							<label class="radio-inline"><input type="radio" name="birth_status_born_no_3" {{ $note->birth_status_born_no_3 == 2 ? 'checked' : '' }} value="2">Livebirth abnormal</label>
							<label class="radio-inline"><input type="radio" name="birth_status_born_no_3" {{ $note->birth_status_born_no_3 == 3 ? 'checked' : '' }} value="3">Stillbirth</label>
						</div>
					</div>
				</div>
				<div class="col-md-12"><!-- field note_born_no_3 type string -->
					<div class="form-group">
						<label for="note_born_no_3" class="col-md-2 control-label">Note :</label>
						<div class="col-md-10">
							<textarea name="note_born_no_3" id="note_born_no_3" class="form-control text_area_feedback" rows="1"  maxlength="255" placeholder="255 characters max.">{{ $note->note_born_no_3 }}</textarea>
							<div id="note_born_no_3_feedback" style="color:#b3b3b3"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="panel panel-default collapse" id="born_no_4"><!-- Born no 4 panel -->
			<div class="panel-heading">
				<div class="row">
					<div class="col-md-6 text-left">Born No.4</div>
					<div class="col-md-6 text-right">
						<a role="button" class="add_infant" no="4" id="click_born_no_4"><span class="fa fa-plus-circle" id="icon_born_no_4"></span><span class="fa fa-child"></span></a>
					</div>
				</div>
			</div>
			<div class="panel-body form-horizontal row">
				<div class="col-md-6"><!-- field gender_born_no_4 type tynyInteger -->
					<div class="form-group">
						<label for="gender_born_no_4" class="col-md-4 control-label">Gender <a role="button" title="Click to reset." class="radio-reset" target="gender_born_no_4"><span class="fa fa-remove"></span></a> :</label>
						<div class="col-md-8">
							<label class="radio-inline"><input type="radio" no="4" name="gender_born_no_4" {{ $note->gender_born_no_4 === '0' ? 'checked' : '' }} value="0">Female</label>
							<label class="radio-inline"><input type="radio" no="4" name="gender_born_no_4" {{ $note->gender_born_no_4 == 1 ? 'checked' : '' }} value="1">Male</label>
							<label class="radio-inline"><input type="radio" no="4" name="gender_born_no_4" {{ $note->gender_born_no_4 == 2 ? 'checked' : '' }} value="2">Undifferentiated</label>
						</div>
					</div>
				</div>
				<div class="col-md-6"><!-- field weight_grams_born_no_4 type smallInteger -->
					<div class="form-group">
						<label for="weight_grams_born_no_4" class="col-md-4 control-label">Birth Weight :</label>
						<div class="col-md-8">
							<div class="input-group">
								<input class="form-control" type="text" name="weight_grams_born_no_4" value="{{ old('weight_grams_born_no_4') ? old('weight_grams_born_no_4') : $note->weight_grams_born_no_4 }}" >
								<span class="input-group-addon">grams</span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6"><!-- apgar -->
					<div class="form-group">
						<label for="apgar_1min_born_no_4" class="col-md-4 control-label">APGAR Score :</label>
						<div class="col-md-4"><!-- field apgar_1min_born_no_4 type tinyInteger -->
							<div class="input-group">
								<input class="form-control" type="text" name="apgar_1min_born_no_4" value="{{ old('apgar_1min_born_no_4') ? old('apgar_1min_born_no_4') : $note->apgar_1min_born_no_4 }}" >
								<span class="input-group-addon">1 min</span>
							</div>
						</div>
						<div class="col-md-4"><!-- field apgar_5min_born_no_4 type tinyInteger -->
							<div class="input-group">
								<input class="form-control" type="text" name="apgar_5min_born_no_4" value="{{ old('apgar_5min_born_no_4') ? old('apgar_5min_born_no_4') : $note->apgar_5min_born_no_4 }}">
								<span class="input-group-addon">5 min</span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12"><!-- field birth_status_born_no_4 type tinyInteger -->
					<div class="form-group">
						<label for="birth_status_born_no_4" class="col-md-2 control-label">Birth status <a role="button" title="Click to reset." class="radio-reset" target="birth_status_born_no_4"><span class="fa fa-remove"></span></a> :</label>
						<div class="col-md-10">
							<label class="radio-inline"><input type="radio" name="birth_status_born_no_4" {{ $note->birth_status_born_no_4 == 1 ? 'checked' : '' }} value="1">Livebirth normal</label>
							<label class="radio-inline"><input type="radio" name="birth_status_born_no_4" {{ $note->birth_status_born_no_4 == 2 ? 'checked' : '' }} value="2">Livebirth abnormal</label>
							<label class="radio-inline"><input type="radio" name="birth_status_born_no_4" {{ $note->birth_status_born_no_4 == 3 ? 'checked' : '' }} value="3">Stillbirth</label>
						</div>
					</div>
				</div>
				<div class="col-md-12"><!-- field note_born_no_4 type string -->
					<div class="form-group">
						<label for="note_born_no_4" class="col-md-2 control-label">Note :</label>
						<div class="col-md-10">
							<textarea name="note_born_no_4" id="note_born_no_4" class="form-control text_area_feedback" rows="1"  maxlength="255" placeholder="255 characters max.">{{ $note->note_born_no_4 }}</textarea>
							<div id="note_born_no_4_feedback" style="color:#b3b3b3"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="panel panel-default collapse" id="born_no_5"><!-- Born no 5 panel -->
			<div class="panel-heading">Born No.5</div>
			<div class="panel-body form-horizontal row">
				<div class="col-md-6"><!-- field gender_born_no_5 type tynyInteger -->
					<div class="form-group">
						<label for="gender_born_no_5" class="col-md-4 control-label">Gender <a role="button" title="Click to reset." class="radio-reset" target="gender_born_no_5"><span class="fa fa-remove"></span></a> :</label>
						<div class="col-md-8">
							<label class="radio-inline"><input type="radio" no="5" name="gender_born_no_5" {{ $note->gender_born_no_5 === '0' ? 'checked' : '' }} value="0">Female</label>
							<label class="radio-inline"><input type="radio" no="5" name="gender_born_no_5" {{ $note->gender_born_no_5 == 1 ? 'checked' : '' }} value="1">Male</label>
							<label class="radio-inline"><input type="radio" no="5" name="gender_born_no_5" {{ $note->gender_born_no_5 == 2 ? 'checked' : '' }} value="2">Undifferentiated</label>
						</div>
					</div>
				</div>
				
				<div class="col-md-6"><!-- field weight_grams_born_no_5 type smallInteger -->
					<div class="form-group">
						<label for="weight_grams_born_no_5" class="col-md-4 control-label">Birth Weight :</label>
						<div class="col-md-8">
							<div class="input-group">
								<input class="form-control" type="text" name="weight_grams_born_no_5" value="{{ old('weight_grams_born_no_5') ? old('weight_grams_born_no_5') : $note->weight_grams_born_no_5 }}" >
								<span class="input-group-addon">grams</span>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-6"><!-- apgar -->
					<div class="form-group">
						<label for="apgar_1min_born_no_5" class="col-md-4 control-label">APGAR Score :</label>
						<div class="col-md-4"><!-- field apgar_1min_born_no_5 type tinyInteger -->
							<div class="input-group">
								<input class="form-control" type="text" name="apgar_1min_born_no_5" value="{{ old('apgar_1min_born_no_5') ? old('apgar_1min_born_no_5') : $note->apgar_1min_born_no_5 }}" >
								<span class="input-group-addon">1 min</span>
							</div>
						</div>
						<div class="col-md-4"><!-- field apgar_5min_born_no_5 type tinyInteger -->
							<div class="input-group">
								<input class="form-control" type="text" name="apgar_5min_born_no_5" value="{{ old('apgar_5min_born_no_5') ? old('apgar_5min_born_no_5') : $note->apgar_5min_born_no_5 }}">
								<span class="input-group-addon">5 min</span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12"><!-- field birth_status_born_no_5 type tinyInteger -->
					<div class="form-group">
						<label for="birth_status_born_no_5" class="col-md-2 control-label">Birth status <a role="button" title="Click to reset." class="radio-reset" target="birth_status_born_no_5"><span class="fa fa-remove"></span></a> :</label>
						<div class="col-md-10">
							<label class="radio-inline"><input type="radio" name="birth_status_born_no_5" {{ $note->birth_status_born_no_5 == 1 ? 'checked' : '' }} value="1">Livebirth normal</label>
							<label class="radio-inline"><input type="radio" name="birth_status_born_no_5" {{ $note->birth_status_born_no_5 == 2 ? 'checked' : '' }} value="2">Livebirth abnormal</label>
							<label class="radio-inline"><input type="radio" name="birth_status_born_no_5" {{ $note->birth_status_born_no_5 == 3 ? 'checked' : '' }} value="3">Stillbirth</label>
						</div>
					</div>
				</div>
				<div class="col-md-12"><!-- field note_born_no_5 type string -->
					<div class="form-group">
						<label for="note_born_no_5" class="col-md-2 control-label">Note :</label>
						<div class="col-md-10">
							<textarea name="note_born_no_5" id="note_born_no_5" class="form-control text_area_feedback" rows="1"  maxlength="255" placeholder="255 characters max.">{{ $note->note_born_no_5 }}</textarea>
							<div id="note_born_no_5_feedback" style="color:#b3b3b3"></div>
						</div>
					</div>
				</div>
			</div>
		</div>	
		<div class="panel panel-default"><!-- Placenta panel -->
			<div class="panel-heading">
				<div class="row">
					<div class="col-md-6 text-left">Placenta</div>
					<div class="col-md-6 text-right"><a role="button"><span class="label label-danger" id="placenta-minus" style="display: none;"><span class="fa fa-minus-circle" ></span></span></a> <a role="button"><span class="label label-success" id="placenta-plus" no="1"><span class="fa fa-plus-circle" ></span></span></a></div>
				</div>
			</div>
			<div class="panel-body form-horizontal row">
				<div class="collapse in" id="placenta_collapse_1"><!-- placenta_1 -->
					<div class="col-md-4">
						<div class="form-group">
							<label class="col-md-4 control-label" for="placenta_weight_grams_1">Weight#1 :</label>
							<div class="col-md-8"><!-- field placenta_weight_grams_1 type smallInteger -->
								<div class="input-group">
									<input class="form-control" type="text" name="placenta_weight_grams_1" value="{{ old('placenta_weight_grams_1') ? old('placenta_weight_grams_1') : $note->placenta_weight_grams_1 }}" >
									<span class="input-group-addon">grams</span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-8">
						<div class="form-group">
							<label class="col-md-4 control-label" for="placenta_weight_2">Abnormality :</label>
							<div class="col-md-8"><!-- field abnormal_placenta_1 type string -->
									<textarea class="form-control" rows="1" name="abnormal_placenta_1" placeholder="Specify abnormality. 255 characters max.">{{ $note->abnormal_placenta_1 }}</textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="collapse" id="placenta_collapse_2"><!-- placenta_2 -->
					<div class="col-md-4">
						<div class="form-group">
							<label class="col-md-4 control-label" for="placenta_weight_grams_2">Weight#2 :</label>
							<div class="col-md-8"><!-- field placenta_weight_grams_2 type smallInteger -->
								<div class="input-group">
									<input class="form-control" type="text" name="placenta_weight_grams_2" value="{{ old('placenta_weight_grams_2') ? old('placenta_weight_grams_2') : $note->placenta_weight_grams_2 }}" >
									<span class="input-group-addon">grams</span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-8">
						<div class="form-group">
							<label class="col-md-4 control-label" for="placenta_weight_2">Abnormality :</label>
							<div class="col-md-8"><!-- field abnormal_placenta_2 type string -->
									<textarea class="form-control" rows="1" name="abnormal_placenta_2" placeholder="Specify abnormality. 255 characters max.">{{ $note->abnormal_placenta_2 }}</textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="collapse" id="placenta_collapse_3"><!-- placenta_3 -->
					<div class="col-md-4">
						<div class="form-group">
							<label class="col-md-4 control-label" for="placenta_weight_grams_3">Weight#3 :</label>
							<div class="col-md-8"><!-- field placenta_weight_grams_3 type smallInteger -->
								<div class="input-group">
									<input class="form-control" type="text" name="placenta_weight_grams_3" value="{{ old('placenta_weight_grams_3') ? old('placenta_weight_grams_3') : $note->placenta_weight_grams_3 }}" >
									<span class="input-group-addon">grams</span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-8">
						<div class="form-group">
							<label class="col-md-4 control-label" for="placenta_weight_2">Abnormality :</label>
							<div class="col-md-8"><!-- field abnormal_placenta_3 type string -->
									<textarea class="form-control" rows="1" name="abnormal_placenta_3" placeholder="Specify abnormality. 255 characters max.">{{ $note->abnormal_placenta_3 }}</textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="collapse" id="placenta_collapse_4"><!-- placenta_4 -->
					<div class="col-md-4">
						<div class="form-group">
							<label class="col-md-4 control-label" for="placenta_weight_grams_4">Weight#4 :</label>
							<div class="col-md-8"><!-- field placenta_weight_grams_4 type smallInteger -->
								<div class="input-group">
									<input class="form-control" type="text" name="placenta_weight_grams_4" value="{{ old('placenta_weight_grams_4') ? old('placenta_weight_grams_4') : $note->placenta_weight_grams_4 }}" >
									<span class="input-group-addon">grams</span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-8">
						<div class="form-group">
							<label class="col-md-4 control-label" for="placenta_weight_2">Abnormality :</label>
							<div class="col-md-8"><!-- field abnormal_placenta_4 type string -->
									<textarea class="form-control" rows="1" name="abnormal_placenta_4" placeholder="Specify abnormality. 255 characters max.">{{ $note->abnormal_placenta_4 }}</textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="collapse" id="placenta_collapse_5"><!-- placenta_5 -->
					<div class="col-md-4">
						<div class="form-group">
							<label class="col-md-4 control-label" for="placenta_weight_grams_5">Weight#5 :</label>
							<div class="col-md-8"><!-- field placenta_weight_grams_5 type smallInteger -->
								<div class="input-group">
									<input class="form-control" type="text" name="placenta_weight_grams_5" value="{{ old('placenta_weight_grams_5') ? old('placenta_weight_grams_5') : $note->placenta_weight_grams_5 }}" >
									<span class="input-group-addon">grams</span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-8">
						<div class="form-group">
							<label class="col-md-4 control-label" for="placenta_weight_2">Abnormality :</label>
							<div class="col-md-8"><!-- field abnormal_placenta_5 type string -->
									<textarea class="form-control" rows="1" name="abnormal_placenta_5" placeholder="Specify abnormality. 255 characters max.">{{ $note->abnormal_placenta_5 }}</textarea>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="panel panel-primary" id="puerperium_panel"><!-- puerperium_panel -->
	<div class="panel-heading">Puerperium</div>
	<div class="panel-body">
		<div class="panel panel-default"><!-- Complication -->
			<div class="panel-heading">Postpartum complication</div>
			<div class="panel-body row">
				<div class="col-md-12"><!-- field specificed_postpartum_complications type string -->
					<div class="form-group">
						<textarea name="specificed_postpartum_complications" id="specificed_postpartum_complications" class="form-control text_area_feedback" rows="1"  maxlength="255" placeholder="Specify postpartum complication. 255 characters max.">{{ $note->specificed_postpartum_complications }}</textarea>
							<div id="specificed_postpartum_complications_feedback" style="color:#b3b3b3"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="panel panel-default"><!-- contraception panel -->
		<div class="panel-heading">Contraception</div>
		@include('obgyn.notes.partials.contraception_panel_body')
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
/*
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
*/

$('#datetimepicker_datetime_delivery').datetimepicker({
	locale: 'th',
	format: 'DD-MM-YYYY H:m',
	showTodayButton: true,
	showClear: true
}); // datetime_delivery.
{{--
$('#no_first_2nd_stage_labour_complication').click(function () {
	if ($(this).prop('checked')){
		$('.complication-labour-1-2').prop('checked', false);
		$('#other_labour_complication_1_2').val('');
	}
}); // Clear all complication labour stage 1_2.
$('.complication-labour-1-2').click(function () {
	if ($(this).prop('checked')){
		$('#no_first_2nd_stage_labour_complication').prop('checked', false);
		if ($(this).attr('group') == 'pelvic-adhesion') { 
			// if complication = pelvic-adhesion, then allow select just one type.
			$('input[group=pelvic-adhesion]').prop('checked', false); // Deselect all pelvic-adhesion.
			$(this).prop('checked', true); // Select this pelvic-adhesion input.
		}
		if ($(this).attr('group') == 'placenta-previa') { 
			// if complication = placenta-previa, then allow select just one type.
			$('input[group=placenta-previa]').prop('checked', false); // Deselect all placenta-previa.
			$(this).prop('checked', true); // Select this placenta-previa input.
		}
	}
}); // Add deselect None complication to all checkbox complication.
$('#other_labour_complication_1_2').change(function () {
	if ($(this).val() != '')
		$('#no_first_2nd_stage_labour_complication').prop('checked', false);
}); // Add deselect None complication to all text complication.
$('input[name=delivery_mode]').click(function() {
	if ($(this).attr('other')) {
		$('#other_delivery_mode_collapse').collapse('show');
		$('#other_delivery_mode').focus();
	} else {
		$('#other_delivery_mode').val('');
		$('#other_delivery_mode_collapse').collapse('hide');
	}
});// Show/hide other delivery mode.
--}}
$('input[name=perineal_tear]').click(function () {
	if ($(this).attr('other')){
		$('#other_tear_collapse').collapse('show');
		$('input[name=other_perineal_tear]').focus();
	} else {
		$('#other_tear_collapse').collapse('hide');
		$('input[name=other_perineal_tear]').val('');
	}
}); // Show/hide other_perineal_tear.
$(".radio-reset").click(function (){
	$("input[name=" + $(this).prop('target') + "]").prop('checked', false);
	if ($(this).prop('target') == 'perineal_tear') { // case reset perineal_tear.
		$('#other_tear_collapse').collapse('hide');
		$('input[name=other_perineal_tear]').val('');
	}
}); // reset radio input.
$('.3rd-stage-labour-checkbox-complication').click(function () {
	if ($(this).prop('checked')){
		if ($(this).attr('none')) {
			$('.3rd-stage-labour-checkbox-complication').prop('checked', false);
			$('.3rd-stage-labour-text-complication').val('');
			$(this).prop('checked', true);
		} else {
			$('input[name=no_third_stage_labour_complication]').prop('checked', false);
		}
	}
}); // Add clear None/Data to all 3rd stage labour checkbox complication. 
$('.3rd-stage-labour-text-complication').change(function () {
	if ($(this).val() != '')
		$('input[name=no_third_stage_labour_complication]').prop('checked', false);
}); // Add clear None to 3rd stage labour text complication.
$('input[name^=gender_born_no_]').click(function() {
	$('input[name=weight_grams_born_no_' + $(this).attr('no') + ']').focus();
});
$('input[name=born_single_or_multiple]').click(function () {
	if ($(this).val() == 1) { // single.
		$('input[name=multiple_born_number]').val('');
		$('#click_born_no_1').css('display', 'none');
		if ($('#click_born_no_1').attr('no') < 0) // Check if next infant is opened.
			$('#click_born_no_1').click(); // then click to hide and clear data of other infants.
	} else { // multiple.
		$('#click_born_no_1').removeAttr('style');
		$('input[name=multiple_born_number]').focus();
	}
}); // Add/Remove add infant function.
$(".add_infant").click(function() {
	var value = parseInt($(this).attr('no'));
	if (value > 0) { // attribute no is positive then open next infant form.
		$('#born_no_' + (value + 1)).collapse('show');
		$('#icon_born_no_' + value).removeClass('fa-plus-circle');
		$('#icon_born_no_' + value).addClass('fa-minus-circle');
		$('html, body').animate({
        scrollTop: $("#born_no_" + (value + 1)).offset().top - 150
    }, 600);
		value = value * - 1;
		$(this).attr('no', value);
	} else { // attribute no is negative then close next infant form.
		value = value * - 1;
		for(i = 5; i > value; i--) {
			// clear data.
			$('input[name=gender_born_no_' + i + ']').prop('checked', false);
			$('input[name=weight_grams_born_no_' + i + ']').val('');
			$('input[name=apgar_1min_born_no_' + i + ']').val('');
			$('input[name=apgar_5min_born_no_' + i + ']').val('');
			$('input[name=birth_status_born_no_' + i + ']').prop('checked', false);
			$('textarea[name=note_born_no_' + i + ']').val('');
			// change interface.
			$('#icon_born_no_' + i).removeClass('fa-minus-circle');
			$('#icon_born_no_' + i).addClass('fa-plus-circle');
			$('#click_born_no_' + i).attr('no', i);
			$('#born_no_' + i).collapse('hide');
		}
		$(this).attr('no', value);
		$('#icon_born_no_' + value).removeClass('fa-minus-circle');
		$('#icon_born_no_' + value).addClass('fa-plus-circle');		
	}
}); // add infant.
$('#placenta-plus').click(function() {
	var no = parseInt($(this).attr('no'));
	if (no >= 4) {
		$(this).css('display', 'none');
		$('#placenta_collapse_5').collapse('show');
		$(this).attr('no', 5);
	} else {
		no += 1;
		$(this).attr('no', no);
		$('#placenta_collapse_' + no).collapse('show');
		$('#placenta-minus').removeAttr('style');
	}
}); // Add placenta.
$('#placenta-minus').click(function() {
	var no = parseInt($('#placenta-plus').attr('no'));
	if (no <= 5) $('#placenta-plus').removeAttr('style');
	
	$('input[name=placenta_weight_grams_' + no + ']').val('');
	$('textarea[name=abnormal_placenta_' + no + ']').val('');
	$('#placenta_collapse_' + no).collapse('hide');

	no -= 1;
	$('#placenta-plus').attr('no', no);
	if (no == 1) $(this).css('display', 'none');
}); // Remove last placenta.
/*
$('input[name=contraception]').click(function () {
	if ($(this).attr('other')) {
		$('#other_contraception_collapse').collapse('show');
	} else {
		$('#other_contraception').val('');
		$('#other_contraception_collapse').collapse('hide');
	}
}); // Show/hide other_contraception
*/
$(document).ready(function(){
	@if ($note->pregnancy_complication_DM)
	$('#DM_collapse').collapse('show');
	@endif
	@if ($note->delivery_mode == 99)
	$('#other_delivery_mode_collapse').collapse('show');
	@endif
	@if ($note->perineal_tear == 99)
	$('#other_tear_collapse').collapse('show');
	@endif
	@if ($note->born_single_or_multiple == 2)
		$('#click_born_no_1').removeAttr('style');
		@for ($i = 2 ; $i <= $note->lastSeenBornData(); $i++)
			$('#born_no_' + {{ $i }}).collapse('show');
			var no = parseInt($('#click_born_no_' + {{ ($i - 1) }}).attr('no'));
			$('#icon_born_no_' + {{ ($i - 1) }}).removeClass('fa-plus-circle');
			$('#icon_born_no_' + {{ ($i - 1) }}).addClass('fa-minus-circle');
			$('#click_born_no_' + {{ ($i - 1) }}).attr('no', (no * - 1));
		@endfor
	@endif
	@for ($i = 2; $i <= $note->lastSeenPlacentaData(); $i++)
		$('#placenta-plus').click();
	@endfor
	@if($note->contraception == 99)
		$('#other_contraception_collapse').collapse('show');
	@endif
});
</script>
@endsection