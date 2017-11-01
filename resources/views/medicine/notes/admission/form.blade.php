@extends('form')

@section('doc_title' , $note->note->type->name . ' - Form')

@section('description', 'siriraj medicine admission note form')

@section('author', 'koramit Pichana')

@section('background_image',"url('/assets/images/footer_lodyas.png');")

@section('style')
<style type="text/css">
	/*label template for template*/
	.label.label-template-level-4 {
		color: rgb(255, 255, 255);
		background-color: rgb(242, 224, 90);
	}

	.label.label-template-level-5 {
		color: rgb(255, 255, 255);
		background-color: rgb(255, 216, 255);
	}
	/* CSS for drawing. */
	.canvas-container {
		margin:0 auto ;
	} /*set center fabric canvas */

	canvas {
		border: 2px solid;
		border-radius: 5px;
		padding-bottom: 5px;
	}

	canvas.active {
		border-color: #8795BF;
		box-shadow: 0px 0px 25px 0px #8795BF;
	}

	.select-canvas {
		margin-bottom: 5px;
	}

	.active.select-canvas.fa-unlock-alt {
		border: 2px solid;
		/*border-radius: 50%;*/
		border-color: #8795BF;
		box-shadow: 0px 0px 10px 5px #8795BF;
	}

	.canvas-div {
		margin: 10px 10px 10px 10px;
	}

	.color-plalet {
		color: transparent;
		font-size: 13px;
		margin: 2px 2px 2px 2px;
	}

	.color-plalet.selector.active {
		border: 2px solid;
		border-radius: 50%;
		border-color: #000;
		box-shadow: 0px 0px 10px 5px #8795BF;	
	}

	.extra-tools-div {
		padding: 2px 1px 2px 1px;
	}

	.carousel-inner {
		background-color: rgb(251, 253, 227);
	}

	.carousel-indicators li {
		border-color: #585858;
	}

	.carousel-indicators .active {
		border-color: #585858;
		background-color: #585858;
	}

	img:hover {
		cursor: pointer;
	}
</style>
@endsection

@section('script')<!-- drawing script. -->
@include('drawing_script')
@endsection

@section('top-tool-bar')
@include('drawings.tools.std_tools')
@endsection

@section('nav_menu')
<li><a href="#admission_data">Admission data</a></li>
<li><a href="#chief_complaint_panel">Chief complaint</a></li>
<li><a href="#comorbid_div">Comorbid</a></li>
<li><a href="#personal_social_history_panel">Personal and Social history</a></li>
<li><a href="#special_requirement_panel">Special requirement</a></li>
<li><a href="#family_history_panel">Family history</a></li>
<li><a href="#current_medications_panel">Current medications</a></li>
<li><a href="#allergy_panel">Allergy</a></li>
<li><a href="#review_systems_panel">Review of Systems</a></li>
<li><a href="#vital_signs_panel">Vital signs</a></li>
<li><a href="#physical_exams_panel">Physical Examinations</a></li>
<li><a href="#problem_list">Problem List</a></li>
<li><a href="#discussion_panel">Discussion</a></li>
<li><a href="#provisional_diag_panel">Provision Diagnosis</a></li>
<li><a href="#plan_investigation_panel">Plan of Investigation</a></li>
<li><a href="#plan_management_panel">plan of Management</a></li>
<li><a href="#special_group_CPG_panel">Special Group</a></li>
<li><a href="#plan_consult_panel">Plan of Consultation</a></li>
<li><a href="#estimated_los_panel">Estimated lenght of stay</a></li>
@endsection

@section('content')
@include('partials.flash')
@include('errors.invalid')

@include('medicine.notes.admission.modal.skin_carousel')
@include('medicine.notes.admission.modal.nervous_system_carousel')
@include('medicine.notes.admission.modal.extremities_carousel')

{{-- <div style="background: #bada55; width:100%; box-sizing:border-box;" id="sticker">Hello Sricker</div> --}}
<div class="col-md-offset-1 col-md-10"><!-- main_frame -->
<div class="panel panel-primary" id="admission_data"><!-- preliminary data -->
	<div class="panel-heading">Preliminary data</div> 
	<div class="panel-body form-horizontal row">
		<div class='col-md-6'><!-- HN -->
			<div class="form-group">
				<label class="col-md-4 control-label" for="HN">HN :</label>
				<div class='col-md-4'><input type='text' class='form-control text-center' value="{{ $note->note->patient->HN }}" name='HN' readonly /></div>
			</div>
		</div>
		<div class='col-md-6'><!-- Patient Name -->
			<div class="form-group">
				<label for="patient_name" class="control-label col-md-4">Patient Name <a data-toggle="tooltip" data-placement="bottom" title="ยังไม่ได้ทำ"><span class="fa fa-info-circle"></span></a> :</label>
				<div class='col-md-8'> 
				<input type='text' class='form-control' value="{{ $note->note->patient->getName() }}" name='patient_name' readonly title='แสดงชื่อเดิม (ถ้ามี)'/>
			</div>
			</div>
		</div>
		<div class='col-md-6'><!-- Gender text -->
			<div class="form-group">
				<label for="gender" class="control-label col-md-4">Gender <span class="fa {{ $note->note->patient->gender ? 'fa-mars' : 'fa-venus' }}"></span> :</label>
				<div class='col-md-4'>
					<input type='text' class='form-control text-center' value="{{ $note->note->patient->getGendertext() }}" name='patient_gender' readonly />
				</div>
			</div>
		</div>
		<div class='col-md-6'><!-- Age at Note -->
			<div class="form-group">
				<label class="col-md-4 control-label" for="age">Age@Note :</label>
				<div class='col-md-4'> 
					<input type='text' class='form-control text-center' value="{{ $note->note->patient->ageAtDate($note->note->created_at) }}" name='patient_age' readonly />
				</div>
			</div>
		</div>
		<div class='col-md-6'><!-- AN -->
			<div class="form-group">
				<label class="col-md-4 control-label" for="AN">AN :</label>
				<div class='col-md-4'><input type='text' class='form-control text-center' value="{{ $note->note->AN }}" name='AN' readonly /></div>
			</div>
		</div>
		<div class='col-md-6'><!-- Datetime Admit-->
			<div class="form-group">
				<label for="datetime_admit" class="control-label col-md-4">Date admit <a data-toggle="tooltip" data-placement="bottom" title="{{ $note->note->getLOS() }}"><span class="fa fa-info-circle"></span></a> :</label>
				<div class='col-md-8'><input type="text" name="datetime_admit" class="form-control" readonly value="{{ $note->note->getDate('admit', 'full') }}" /></div>
			</div>
		</div>
		<input type="hidden" name="ward_id" value="{{ $note->note->ward_id }}">
		<div class='col-md-6'><!-- ward_id + ward_name -->
			<div class="form-group">
				<label for="ward_name" class="control-label col-md-4">Ward <a data-toggle="tooltip" data-placement="bottom" for="ward_name"><span class="fa fa-info-circle"></span></a> :</label>
				<div class='col-md-8'>
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-lightbulb-o"></i></span>
						<input type='text' class='form-control autocomplete-to-hidden' value="{{ $note->note->getWardName() }}" name='ward_name' target="ward_id" endpoint="/itemize/ward/med|"/>
						<span class="input-group-btn">
							<button class="btn btn-default" type="button"><span class="fa fa-undo"></span></button>
						</span>
					</div>
				</div>
			</div>
		</div>
		<div class='col-md-6'><!-- Datetime Discharge -->
			<div class="form-group">
				<label for="datetime_dc" class="control-label col-md-4">Date D/C <a data-toggle="tooltip" data-placement="bottom" title="{{ $note->note->getLOS() }}"><span class="fa fa-info-circle"></span></a> :</label>
				<div class='col-md-8'><input type="text" name="datetime_dc" class="form-control" readonly value="{{ $note->note->getDate('dc', 'full') }}" /></div>
			</div>
		</div>
		<input type="hidden" name="attending_id" value="{{ $note->note->attending_id }}">
		<div class='col-md-6'><!-- attending_id + attending_name -->
			<div class="form-group">
				<label for="attending_name" class="control-label col-md-4">Attending <a data-toggle="tooltip" data-placement="bottom" title="{{ $note->note->getAttendingData('detail') }}" for="attending_name"><span class="fa fa-info-circle"></span></a> :</label>
				<div class='col-md-8'>
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-lightbulb-o"></i></span>
						<input type="text" name="attending_name" value="{{ $note->note->getAttendingData() }}" class="form-control autocomplete-to-hidden" target="attending_id" endpoint="/itemize/attending/med|"/>
						<span class="input-group-btn">
							<button class="btn btn-default" type="button"><span class="fa fa-undo"></span></button>
						</span>
					</div>
				</div>
			</div>
		</div>
		<input type="hidden" name="division_id" value="{{ $note->note->division_id }}">
		<div class='col-md-6'><!-- division_id + division_name -->
			<div class="form-group">
				<label for="division_name" class="control-label col-md-4">Specialty <a data-toggle="tooltip" data-placement="bottom" title="" for="division_name"><span class="fa fa-info-circle"></span></a> :</label>
				<div class='col-md-8'>
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-lightbulb-o"></i></span>
						<input class="form-control autocomplete-to-hidden" type="text" name="division_name" value="{{ $note->note->getDivisionName() }}" target="division_id" endpoint="/itemize/ward/med|"/>
						<span class="input-group-btn">
							<button class="btn btn-default" type="button"><span class="fa fa-undo"></span></button>
						</span>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-12"><!-- field reason_admit type tinyInteger -->
			<div class="form-group">
				<label class="control-label col-md-2" for="reason_admit">Other reason <a role="button" data-toggle="tooltip" data-placement="bottom" title="Click to reset." class="radio-reset reset-has-other-textarea" target="reason_admit" style="display: none;"><span class="fa fa-remove"></span></a> :</label>
				<div class="col-md-10">
					<label class="radio-inline"><input class="has-other-textarea" type="radio" name="reason_admit" {{ $note->reason_admit == 1 ? 'checked' : '' }} value="1">Curative</label>
					<label class="radio-inline"><input class="has-other-textarea" type="radio" name="reason_admit" {{ $note->reason_admit == 2 ? 'checked' : '' }} value="2">Curative+Palliative</label>
					<label class="radio-inline"><input class="has-other-textarea" type="radio" name="reason_admit" {{ $note->reason_admit == 3 ? 'checked' : '' }} value="3">Palliative only</label>
					<label class="radio-inline"><input class="has-other-textarea" type="radio" name="reason_admit" {{ $note->reason_admit == 4 ? 'checked' : '' }} value="4">Investigation</label>
					<label class="radio-inline"><input class="has-other-textarea" type="radio" name="reason_admit" {{ $note->reason_admit == 5 ? 'checked' : '' }} value="5">Rehabilitation</label>
					<label class="radio-inline"><input class="has-other-textarea" type="radio" name="reason_admit" {{ $note->reason_admit == 99 ? 'checked' : '' }} value="99">Other</label>
				</div>
			</div>	
		</div>
		<div class="col-md-12 collapse" id="reason_admit_other_collapse"><!-- field reason_admit_other type string -->
			<div class="form-group">
				<label class="control-label col-md-2" for="reason_admit_other">Other reason :</label>
				<div class='col-md-10'>
					<textarea name="reason_admit_other" id="reason_admit_other" class="form-control text_area_feedback" rows="1" maxlength="255" placeholder="Specify other reason. 255 characters max.">{{ $note->reason_admit_other }}</textarea>
					<div id="reason_admit_other_feedback" style="color:#b3b3b3"></div>
				</div>
			</div>
		</div>
	</div><!-- end of preliminary data body -->
</div><!-- end of preliminary data -->
<div class="panel panel-primary"><!-- History panel -->
	<div class="panel-heading" id="history">History</div> 
	<div class="panel-body">
		<div class="panel panel-info" id="chief_complaint_panel"><!-- panel Chief complaint -->
			<div class="panel-heading">Chief complaint</div>
			<div class="panel-body"><!-- field chief_complaint type text -->
				<textarea name="chief_complaint" id="chief_complaint" class="form-control text_area_feedback" rows="1" maxlength="1000" placeholder="1000 characters max.">{{ $note->chief_complaint }}</textarea>
				<div id="chief_complaint_feedback" style="color:#b3b3b3"></div>
			</div>
		</div>

		<div class="panel panel-info" id="comorbid_div"><!-- panel co-morbid -->
			<div class="panel-heading">Co-morbid and illness history</div>
			<div class="panel-body">
				<div class="btn-group">
					<button role="button" type="button" onclick="$('#comorbid_list_collapse').collapse('show')" data-toggle="tooltip" data-placement="bottom" title="แสดง รายการโรคร่วม" class="btn btn-default btn-sm btn-comorbid-list active">Show List</button>
					<button role="button" type="button" onclick="$('#comorbid_list_collapse').collapse('hide')" data-toggle="tooltip" data-placement="bottom" title="ซ่อน รายการโรคร่วม" class="btn btn-default btn-sm btn-comorbid-list">Hide List</button>
				</div>
				<span class="fa fa-ellipsis-h"></span>
				<button type="button" data-toggle="tooltip" data-placement="bottom" title="Click เพื่อลงข้อมูล Co-morbid เป็น No data ทั้งหมด" class="btn btn-warning btn-sm btn-set-all">No data all</button>
				<span class="fa fa-ellipsis-v"></span>
				<button type="button" data-toggle="tooltip" data-placement="bottom" title="Click เพื่อลงข้อมูล Co-morbid เป็น No ทั้งหมด" class="btn btn-warning btn-sm btn-set-all">No co-morbid</button>
				<div class="form-horizontal row collapse in" id="comorbid_list_collapse"><!-- collapse Comorbid list -->
					<div class="col-md-12"><hr></div>
					<div class="col-md-12 alert alert-info"><!-- field comorbid_DM type tinyInteger -->
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label col-md-4" for="comorbid_DM">DM <a role="button" data-toggle="tooltip" data-placement="bottom" title="Click to reset." class="radio-reset reset-comorbid-has-extra-detail" target="comorbid_DM" style="display: none;"><span class="fa fa-remove"></span></a> :</label>
								<div class="col-md-8">
									<label class="radio-inline"><input class="comorbid-has-extra-detail" type="radio" name="comorbid_DM" {{ $note->comorbid_DM == 99 ? 'checked' : '' }} value="99">No data</label>
									<label class="radio-inline"><input class="comorbid-has-extra-detail" type="radio" name="comorbid_DM" {{ $note->comorbid_DM === '0' ? 'checked' : '' }} value="0">No</label>
									<label class="radio-inline"><input class="comorbid-has-extra-detail" type="radio" name="comorbid_DM" {{ $note->comorbid_DM == 1 ? 'checked' : '' }} value="1">Yes</label>
								</div>
							</div>
						</div>
						<div class="well collapse col-md-12" id="comorbid_DM_collapse">
							<div class="col-md-12"><!-- field DM_type type tinyInteger -->
								<div class="form-group">
									<label class="control-label col-md-4" for="DM_type">DM Type <a role="button" data-toggle="tooltip" data-placement="bottom" title="Click to reset." class="radio-reset" target="DM_type" style="display: none;"><span class="fa fa-remove"></span></a> :</label>
									<div class="col-md-8">
										<label class="radio-inline"><input type="radio" name="DM_type" {{ $note->DM_type == 1 ? 'checked' : '' }} value="1">Type I</label>
										<label class="radio-inline"><input type="radio" name="DM_type" {{ $note->DM_type == 2 ? 'checked' : '' }} value="2">Type II</label>
									</div>
								</div>
							</div>
							<div class="col-md-12"><!-- DM Complication -->
								<div class="form-group">
									<label class="control-label col-md-4">DM Complication :</label>
									<!-- field DM_DR type checkbox -->
									<div class="col-md-2 checkbox"><label><input type="checkbox" {{ $note->DM_DR ? 'checked' : '' }} name="DM_DR">DR</label></div>
									<!-- field DM_nephropathy type checkbox -->
									<div class="col-md-2 checkbox"><label><input type="checkbox" {{ $note->DM_nephropathy ? 'checked' : '' }} name="DM_nephropathy">Nephropathy</label></div>
									<!-- field DM_neuropathy type checkbox -->
									<div class="col-md-2 checkbox"><label><input type="checkbox" {{ $note->DM_neuropathy ? 'checked' : '' }} name="DM_neuropathy">Neuropathy</label></div>
								</div>
							</div>
							<div class="col-md-12"><!-- DM Treatment -->
								<div class="form-group">
									<label class="control-label col-md-4">On :</label>
									<!-- field DM_on_diet type checkbox -->
									<div class="col-md-2 checkbox"><label><input type="checkbox" {{ $note->DM_on_diet ? 'checked' : '' }} name="DM_on_diet">Diet control</label></div>
									<!-- field DM_on_oral_med type checkbox -->
									<div class="col-md-2 checkbox"><label><input type="checkbox" {{ $note->DM_on_oral_med ? 'checked' : '' }} name="DM_on_oral_med">Oral medication</label></div>
									<!-- field DM_on_insulin type checkbox -->
									<div class="col-md-2 checkbox"><label><input type="checkbox" {{ $note->DM_on_insulin ? 'checked' : '' }} name="DM_on_insulin">Insulin</label></div>
								</div>
							</div>
						</div><!-- end of DM collapse -->
					</div>
					
					<div class="col-md-12"><!-- field comorbid_HT type tinyInteger -->
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label col-md-4" for="comorbid_HT">HT <a role="button" data-toggle="tooltip" data-placement="bottom" title="Click to reset." class="radio-reset" target="comorbid_HT" style="display: none;"><span class="fa fa-remove"></span></a> :</label>
								<div class="col-md-8">
									<label class="radio-inline"><input type="radio" name="comorbid_HT" {{ $note->comorbid_HT == 99 ? 'checked' : '' }} value="99">No data</label>
									<label class="radio-inline"><input type="radio" name="comorbid_HT" {{ $note->comorbid_HT === '0' ? 'checked' : '' }} value="0">No</label>
									<label class="radio-inline"><input type="radio" name="comorbid_HT" {{ $note->comorbid_HT == 1 ? 'checked' : '' }} value="1">Yes</label>
								</div>
							</div>
						</div>
					</div>
					
					<div class="col-md-12 alert alert-info"><!-- field comorbid_CAD type tinyInteger -->
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label col-md-4" for="comorbid_CAD">CAD <a role="button" data-toggle="tooltip" data-placement="bottom" title="Coronary artery disease"><span class="fa fa-info-circle"></span></a> <a role="button" data-toggle="tooltip" data-placement="bottom" title="Click to reset." class="radio-reset reset-comorbid-has-extra-detail" target="comorbid_CAD" style="display: none;"><span class="fa fa-remove"></span></a> :</label>
								<div class="col-md-8">
									<label class="radio-inline"><input class="comorbid-has-extra-detail" type="radio" name="comorbid_CAD" {{ $note->comorbid_CAD == 99 ? 'checked' : '' }} value="99">No data</label>
									<label class="radio-inline"><input class="comorbid-has-extra-detail" type="radio" name="comorbid_CAD" {{ $note->comorbid_CAD === '0' ? 'checked' : '' }} value="0">No</label>
									<label class="radio-inline"><input class="comorbid-has-extra-detail" type="radio" name="comorbid_CAD" {{ $note->comorbid_CAD == 1 ? 'checked' : '' }} value="1">Yes</label>
								</div>
							</div>
						</div>
						<div class="well collapse col-md-12" id="comorbid_CAD_collapse" >
							<div class="col-md-12"><!-- field CAD_diag type tinyInteger -->
								<div class="form-group">
									<label class="control-label col-md-4" for="CAD_diag">Diagnosis <a role="button" data-toggle="tooltip" data-placement="bottom" title="Click to reset." class="radio-reset reset-has-other-textarea" target="CAD_diag" style="display: none;"><span class="fa fa-remove"></span></a> :</label>
									<div class="col-md-8">
										<label class="radio-inline"><input class="has-other-textarea" type="radio" name="CAD_diag" {{ $note->CAD_diag == 1 ? 'checked' : '' }} value="1">Old MI</label>
										<label class="radio-inline"><input class="has-other-textarea" type="radio" name="CAD_diag" {{ $note->CAD_diag == 2 ? 'checked' : '' }} value="2">Unstable angina</label>
										<label class="radio-inline"><input class="has-other-textarea" type="radio" name="CAD_diag" {{ $note->CAD_diag == 3 ? 'checked' : '' }} value="3">Stable angina</label>
										<label class="radio-inline"><input class="has-other-textarea" type="radio" name="CAD_diag" {{ $note->CAD_diag == 99 ? 'checked' : '' }} value="99">Others</label>
									</div>
								</div>
							</div>
							<div class="col-md-12 collapse" id="CAD_diag_other_collapse"><!-- field CAD_diag_other type string -->
								<div class="form-group">
									<label class="control-label col-md-4" for="CAD_diag_other">Other diagnosis :</label>
									<div class="col-md-8">
										<textarea name="CAD_diag_other" id="CAD_diag_other" class="form-control text_area_feedback" rows="1" maxlength="255" placeholder="Specify other CAD diagnosis. 255 characters max.">{{ $note->CAD_diag_other }}</textarea>
										<div id="CAD_diag_other_feedback" style="color:#b3b3b3"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
					{{-- <div class="col-md-12"><hr></div> --}}
					
					<div class="col-md-12"><!-- field comorbid_VHD type tinyInteger -->
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label col-md-4" for="comorbid_VHD">Valvular heart disease <a role="button" data-toggle="tooltip" data-placement="bottom" title="Click to reset." class="radio-reset reset-comorbid-has-extra-detail" target="comorbid_VHD" style="display: none;"><span class="fa fa-remove"></span></a> :</label>
								<div class="col-md-8">
									<label class="radio-inline"><input class="comorbid-has-extra-detail" type="radio" name="comorbid_VHD" {{ $note->comorbid_VHD == 99 ? 'checked' : '' }} value="99">No data</label>
									<label class="radio-inline"><input class="comorbid-has-extra-detail" type="radio" name="comorbid_VHD" {{ $note->comorbid_VHD === '0' ? 'checked' : '' }} value="0">No</label>
									<label class="radio-inline"><input class="comorbid-has-extra-detail" type="radio" name="comorbid_VHD" {{ $note->comorbid_VHD == 1 ? 'checked' : '' }} value="1">Yes</label>
								</div>
							</div>
						</div>
						<div class="well col-md-12 collapse" id="comorbid_VHD_collapse">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-4">Diagnosis :</label>
									<div class="col-md-8">
										<!-- field VHD_diag_AS type checkbox -->
										<div class="col-md-2 checkbox"><label><input type="checkbox" {{ $note->VHD_diag_AS ? 'checked' : '' }} name="VHD_diag_AS">AS</label></div>
										<!-- field VHD_diag_AR type checkbox -->
										<div class="col-md-2 checkbox"><label><input type="checkbox" {{ $note->VHD_diag_AR ? 'checked' : '' }} name="VHD_diag_AR">AR</label></div>
										<!-- field VHD_diag_MS type checkbox -->
										<div class="col-md-2 checkbox"><label><input type="checkbox" {{ $note->VHD_diag_MS ? 'checked' : '' }} name="VHD_diag_MS">MS</label></div>
										<!-- field VHD_diag_MR type checkbox -->
										<div class="col-md-2 checkbox"><label><input type="checkbox" {{ $note->VHD_diag_MR ? 'checked' : '' }} name="VHD_diag_MR">MR</label></div>
										<!-- field VHD_diag_TR type checkbox -->
										<div class="col-md-2 checkbox"><label><input type="checkbox" {{ $note->VHD_diag_TR ? 'checked' : '' }} name="VHD_diag_TR">TR</label></div>
									</div>
								</div>
							</div>
							<div class="col-md-12"><!-- field VHD_diag_other type string -->
								<div class="form-group">
									<label class="control-label col-md-4" for="VHD_diag_other">Other diagnosis :</label>
									<div class="col-md-8">
										<textarea name="VHD_diag_other" id="VHD_diag_other" class="form-control text_area_feedback" rows="1" maxlength="255" placeholder="Specify other valvular heart disease diagnosis. 255 characters max.">{{ $note->VHD_diag_other }}</textarea>
										<div id="VHD_diag_other_feedback" style="color:#b3b3b3"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
					{{-- <div class="col-md-12"><hr></div> --}}

					<div class="col-md-12 alert alert-info"><!-- field comorbid_stroke type tinyInteger -->
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label col-md-4" for="comorbid_stroke">Stroke <a role="button" data-toggle="tooltip" data-placement="bottom" title="Click to reset." class="radio-reset reset-comorbid-has-extra-detail" target="comorbid_stroke" style="display: none;"><span class="fa fa-remove"></span></a> :</label>
								<div class="col-md-8">
									<label class="radio-inline"><input class="comorbid-has-extra-detail" type="radio" name="comorbid_stroke" {{ $note->comorbid_stroke == 99 ? 'checked' : '' }} value="99">No data</label>
									<label class="radio-inline"><input class="comorbid-has-extra-detail" type="radio" name="comorbid_stroke" {{ $note->comorbid_stroke === '0' ? 'checked' : '' }} value="0">No</label>
									<label class="radio-inline"><input class="comorbid-has-extra-detail" type="radio" name="comorbid_stroke" {{ $note->comorbid_stroke == 1 ? 'checked' : '' }} value="1">Yes</label>
								</div>
							</div>
						</div>
						<div class="well collapse col-md-12" id="comorbid_stroke_collapse">
							<div class="col-md-12"><!-- field stroke_ischemic type tinyInteger -->
								<div class="form-group">
									<label class="control-label col-md-2">Ischemic <a role="button" data-toggle="tooltip" data-placement="bottom" title="Click to reset." class="radio-reset" target="stroke_ischemic" style="display: none;"><span class="fa fa-remove"></span></a> :</label>
									<div class="col-md-10">
										<label class="radio-inline"><input type="radio" name="stroke_ischemic" {{ $note->stroke_ischemic === '0' ? 'checked' : '' }} value="0">No</label>
										<label class="radio-inline"><input type="radio" name="stroke_ischemic" {{ $note->stroke_ischemic == 1 ? 'checked' : '' }} value="1">left hemiparesis</label>
										<label class="radio-inline"><input type="radio" name="stroke_ischemic" {{ $note->stroke_ischemic == 2 ? 'checked' : '' }} value="2">right hemiparesis</label>
										<label class="radio-inline"><input type="radio" name="stroke_ischemic" {{ $note->stroke_ischemic == 3 ? 'checked' : '' }} value="3">left hemiplegia</label>
										<label class="radio-inline"><input type="radio" name="stroke_ischemic" {{ $note->stroke_ischemic == 4 ? 'checked' : '' }} value="4">right hemiplegia</label>
									</div>
								</div>
							</div>
							<div class="col-md-12"><!-- field stroke_hemorrhagic type tinyInteger -->
								<div class="form-group">
									<label class="control-label col-md-2">Hemorrhagic <a role="button" data-toggle="tooltip" data-placement="bottom" title="Click to reset." class="radio-reset" target="stroke_hemorrhagic" style="display: none;"><span class="fa fa-remove"></span></a> :</label>
									<div class="col-md-10">
										<label class="radio-inline"><input type="radio" name="stroke_hemorrhagic" {{ $note->stroke_hemorrhagic === '0' ? 'checked' : '' }} value="0">No</label>
										<label class="radio-inline"><input type="radio" name="stroke_hemorrhagic" {{ $note->stroke_hemorrhagic == 1 ? 'checked' : '' }} value="1">left hemiparesis</label>
										<label class="radio-inline"><input type="radio" name="stroke_hemorrhagic" {{ $note->stroke_hemorrhagic == 2 ? 'checked' : '' }} value="2">right hemiparesis</label>
										<label class="radio-inline"><input type="radio" name="stroke_hemorrhagic" {{ $note->stroke_hemorrhagic == 3 ? 'checked' : '' }} value="3">left hemiplegia</label>
										<label class="radio-inline"><input type="radio" name="stroke_hemorrhagic" {{ $note->stroke_hemorrhagic == 4 ? 'checked' : '' }} value="4">right hemiplegia</label>
									</div>
								</div>
							</div>
							<div class="col-md-12"><!-- field stroke_iembolic type tinyInteger -->
								<div class="form-group">
									<label class="control-label col-md-2">Iembolic <a role="button" data-toggle="tooltip" data-placement="bottom" title="Click to reset." class="radio-reset" target="stroke_iembolic" style="display: none;"><span class="fa fa-remove"></span></a> :</label>
									<div class="col-md-10">
										<label class="radio-inline"><input type="radio" name="stroke_iembolic" {{ $note->stroke_iembolic === '0' ? 'checked' : '' }} value="0">No</label>
										<label class="radio-inline"><input type="radio" name="stroke_iembolic" {{ $note->stroke_iembolic == 1 ? 'checked' : '' }} value="1">left hemiparesis</label>
										<label class="radio-inline"><input type="radio" name="stroke_iembolic" {{ $note->stroke_iembolic == 2 ? 'checked' : '' }} value="2">right hemiparesis</label>
										<label class="radio-inline"><input type="radio" name="stroke_iembolic" {{ $note->stroke_iembolic == 3 ? 'checked' : '' }} value="3">left hemiplegia</label>
										<label class="radio-inline"><input type="radio" name="stroke_iembolic" {{ $note->stroke_iembolic == 4 ? 'checked' : '' }} value="4">right hemiplegia</label>
									</div>
								</div>
							</div>
						</div>
					</div>
					{{-- <div class="col-md-12"><hr></div> --}}

					<div class="col-md-12"><!-- field comorbid_COPD type tinyInteger -->
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label col-md-4" for="comorbid_COPD">COPD <a role="button" data-toggle="tooltip" data-placement="bottom" title="Click to reset." class="radio-reset" target="comorbid_COPD" style="display: none;"><span class="fa fa-remove"></span></a> :</label>
								<div class="col-md-8">
									<label class="radio-inline"><input class="comorbid-has-extra-detail" type="radio" name="comorbid_COPD" {{ $note->comorbid_COPD == 99 ? 'checked' : '' }} value="99">No data</label>
									<label class="radio-inline"><input class="comorbid-has-extra-detail" type="radio" name="comorbid_COPD" {{ $note->comorbid_COPD === '0' ? 'checked' : '' }} value="0">No</label>
									<label class="radio-inline"><input class="comorbid-has-extra-detail" type="radio" name="comorbid_COPD" {{ $note->comorbid_COPD == 1 ? 'checked' : '' }} value="1">Yes</label>
								</div>
							</div>
						</div>
					</div>
					{{-- <div class="col-md-12"><hr></div> --}}

					<div class="col-md-12 alert alert-info"><!-- field comorbid_asthma type tinyInteger -->
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label col-md-4" for="comorbid_asthma">Asthma <a role="button" data-toggle="tooltip" data-placement="bottom" title="Click to reset." class="radio-reset" target="comorbid_asthma" style="display: none;"><span class="fa fa-remove"></span></a> :</label>
								<div class="col-md-8">
									<label class="radio-inline"><input class="comorbid-has-extra-detail" type="radio" name="comorbid_asthma" {{ $note->comorbid_asthma == 99 ? 'checked' : '' }} value="99">No data</label>
									<label class="radio-inline"><input class="comorbid-has-extra-detail" type="radio" name="comorbid_asthma" {{ $note->comorbid_asthma === '0' ? 'checked' : '' }} value="0">No</label>
									<label class="radio-inline"><input class="comorbid-has-extra-detail" type="radio" name="comorbid_asthma" {{ $note->comorbid_asthma == 1 ? 'checked' : '' }} value="1">Yes</label>
								</div>
							</div>
						</div>
					</div>
					{{-- <div class="col-md-12"><hr></div> --}}

					<div class="col-md-12"><!-- field comorbid_CKD type tinyInteger -->
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label col-md-4" for="comorbid_CKD">CKD <a role="button" data-toggle="tooltip" data-placement="bottom" title="Chronic kidney disease"><span class="fa fa-info-circle"></span></a> <a role="button" data-toggle="tooltip" data-placement="bottom" title="Click to reset." class="radio-reset reset-comorbid-has-extra-detail" target="comorbid_CKD" style="display: none;"><span class="fa fa-remove"></span></a> :</label>
								<div class="col-md-8">
									<label class="radio-inline"><input class="comorbid-has-extra-detail" type="radio" name="comorbid_CKD" {{ $note->comorbid_CKD == 99 ? 'checked' : '' }} value="99">No data</label>
									<label class="radio-inline"><input class="comorbid-has-extra-detail" type="radio" name="comorbid_CKD" {{ $note->comorbid_CKD === '0' ? 'checked' : '' }} value="0">No</label>
									<label class="radio-inline"><input class="comorbid-has-extra-detail" type="radio" name="comorbid_CKD" {{ $note->comorbid_CKD == 1 ? 'checked' : '' }} value="1">Yes</label>
								</div>
							</div>
						</div>
						<div class="well collapse col-md-12" id="comorbid_CKD_collapse">
							<div class="col-md-12"><!-- field CKD_stage type tinyInteger -->
								<div class="form-group">
									<label class="control-label col-md-2">Stage <a role="button" data-toggle="tooltip" data-placement="bottom" title="Click to reset." class="radio-reset" target="CKD_stage" style="display: none;"><span class="fa fa-remove"></span></a> :</label>
									<div class="col-md-10">
										<label class="radio-inline col-md-1"><input type="radio" name="CKD_stage" {{ $note->CKD_stage == 1 ? 'checked' : '' }} value="1">I</label>
										<label class="radio-inline col-md-1"><input type="radio" name="CKD_stage" {{ $note->CKD_stage == 2 ? 'checked' : '' }} value="2">II</label>
										<label class="radio-inline col-md-1"><input type="radio" name="CKD_stage" {{ $note->CKD_stage == 3 ? 'checked' : '' }} value="3">III</label>
										<label class="radio-inline col-md-1"><input type="radio" name="CKD_stage" {{ $note->CKD_stage == 4 ? 'checked' : '' }} value="4">IV</label>
										<label class="radio-inline col-md-2"><input type="radio" name="CKD_stage" {{ $note->CKD_stage == 50 ? 'checked' : '' }} value="50">V, no dialysis</label>
										<label class="radio-inline col-md-2"><input type="radio" name="CKD_stage" {{ $note->CKD_stage == 51 ? 'checked' : '' }} value="51">V, on HD</label>
										<label class="radio-inline col-md-2"><input type="radio" name="CKD_stage" {{ $note->CKD_stage == 52 ? 'checked' : '' }} value="52">V, on PD</label>
									</div>
								</div>
							</div>
						</div>
					</div>
					{{-- <div class="col-md-12"><hr></div> --}}

					<div class="col-md-12 alert alert-info"><!-- field comorbid_hyperlipidemia type tinyInteger -->
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label col-md-4" for="comorbid_hyperlipidemia">Hyperlipidemia <a role="button" data-toggle="tooltip" data-placement="bottom" title="Click to reset." class="radio-reset reset-comorbid-has-extra-detail" target="comorbid_hyperlipidemia" style="display: none;"><span class="fa fa-remove"></span></a> :</label>
								<div class="col-md-8">
									<label class="radio-inline"><input class="comorbid-has-extra-detail" type="radio" name="comorbid_hyperlipidemia" {{ $note->comorbid_hyperlipidemia == 99 ? 'checked' : '' }} value="99">No data</label>
									<label class="radio-inline"><input class="comorbid-has-extra-detail" type="radio" name="comorbid_hyperlipidemia" {{ $note->comorbid_hyperlipidemia === '0' ? 'checked' : '' }} value="0">No</label>
									<label class="radio-inline"><input class="comorbid-has-extra-detail" type="radio" name="comorbid_hyperlipidemia" {{ $note->comorbid_hyperlipidemia == 1 ? 'checked' : '' }} value="1">Yes</label>
								</div>
							</div>
						</div>
						<div class="well collapse col-md-12" id="comorbid_hyperlipidemia_collapse">
							<div class="col-md-12"><!-- field hyperlipidemia_diag type tinyInteger -->
								<div class="form-group">
									<label class="control-label col-md-4" for="hyperlipidemia_diag">Diagnosis <a role="button" data-toggle="tooltip" data-placement="bottom" title="Chronic kidney disease"><span class="fa fa-info-circle"></span></a> <a role="button" data-toggle="tooltip" data-placement="bottom" title="Click to reset." class="radio-reset" target="hyperlipidemia_diag" style="display: none;"><span class="fa fa-remove"></span></a> :</label>
								<div class="col-md-8">
									<label class="radio-inline"><input type="radio" name="hyperlipidemia_diag" {{ $note->hyperlipidemia_diag == 1 ? 'checked' : '' }} value="1">Hypercholesterolemia</label>
									<label class="radio-inline"><input type="radio" name="hyperlipidemia_diag" {{ $note->hyperlipidemia_diag == 2 ? 'checked' : '' }} value="2">Hypertriglyceridemia</label>
									<label class="radio-inline"><input type="radio" name="hyperlipidemia_diag" {{ $note->hyperlipidemia_diag == 3 ? 'checked' : '' }} value="3">Mixed-hyperlipidemia</label>
								</div>
								</div>
							</div>
						</div>
					</div>
					{{-- <div class="col-md-12"><hr></div> --}}

					<div class="col-md-12"><!-- field comorbid_cirrhosis type tinyInteger -->
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label col-md-4" for="comorbid_cirrhosis">Cirrhosis <a role="button" data-toggle="tooltip" data-placement="bottom" title="Click to reset." class="radio-reset reset-comorbid-has-extra-detail" target="comorbid_cirrhosis" style="display: none;"><span class="fa fa-remove"></span></a> :</label>
								<div class="col-md-8">
									<label class="radio-inline"><input class="comorbid-has-extra-detail" type="radio" name="comorbid_cirrhosis" {{ $note->comorbid_cirrhosis == 99 ? 'checked' : '' }} value="99">No data</label>
									<label class="radio-inline"><input class="comorbid-has-extra-detail" type="radio" name="comorbid_cirrhosis" {{ $note->comorbid_cirrhosis === '0' ? 'checked' : '' }} value="0">No</label>
									<label class="radio-inline"><input class="comorbid-has-extra-detail" type="radio" name="comorbid_cirrhosis" {{ $note->comorbid_cirrhosis == 1 ? 'checked' : '' }} value="1">Yes</label>
								</div>
							</div>
						</div>
						<div class="well collapse col-md-12" id="comorbid_cirrhosis_collapse">
							<div class="col-md-12"><!-- field cirrhosis_child_pugh_score type tinyInteger -->
								<div class="form-group">
									<label class="control-label col-md-4" for="cirrhosis_child_pugh_score">Child-Pugh score <a role="button" onclick="$('#child_pugh_score_reference_collapse').collapse('toggle');"><span class="fa fa-link fa-flip-vertical"></span></a> <a role="button" data-toggle="tooltip" data-placement="bottom" title="Click to reset." class="radio-reset" target="cirrhosis_child_pugh_score" style="display: none;"><span class="fa fa-remove"></span></a> :</label>
									<div class="col-md-8">
										<label class="radio-inline"><input type="radio" name="cirrhosis_child_pugh_score" {{ $note->cirrhosis_child_pugh_score == 1 ? 'checked' : '' }} value="1">A</label>
										<label class="radio-inline"><input type="radio" name="cirrhosis_child_pugh_score" {{ $note->cirrhosis_child_pugh_score == 2 ? 'checked' : '' }} value="2">B</label>
										<label class="radio-inline"><input type="radio" name="cirrhosis_child_pugh_score" {{ $note->cirrhosis_child_pugh_score == 3 ? 'checked' : '' }} value="3">C</label>
									</div>
								</div>
							</div>
							<div class="alert alert-warning collapse col-md-12" id="child_pugh_score_reference_collapse">
								@include('medicine.notes.admission.child_pugh_score')
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-4">Etiology :</label>
									<div class="col-md-8">
										<!-- field cirrhosis_etiology_HBV type checkbox -->
										<div class="checkbox col-md-2"><label><input type="checkbox" {{ $note->cirrhosis_etiology_HBV ? 'checked' : '' }} name="cirrhosis_etiology_HBV">HBV</label></div>
										<!-- field cirrhosis_etiology_HCV type checkbox -->
										<div class="checkbox col-md-2"><label><input type="checkbox" {{ $note->cirrhosis_etiology_HCV ? 'checked' : '' }} name="cirrhosis_etiology_HCV">HCV</label></div>
										<!-- field cirrhosis_etiology_NASH type checkbox -->
										<div class="checkbox col-md-2"><label><input type="checkbox" {{ $note->cirrhosis_etiology_NASH ? 'checked' : '' }} name="cirrhosis_etiology_NASH">NASH</label></div>
										<!-- field cirrhosis_etiology_cryptogenic type checkbox -->
										<div class="checkbox col-md-4"><label><input type="checkbox" {{ $note->cirrhosis_etiology_cryptogenic ? 'checked' : '' }} name="cirrhosis_etiology_cryptogenic">Cryptogenic</label></div>
									</div>
								</div>
							</div>
							<div class="col-md-12"><!-- field cirrhosis_etiology_other type string -->
								<div class="form-group">
									<label class="control-label col-md-4" for="cirrhosis_etiology_other">Other etiology :</label>
									<div class="col-md-8">
										<textarea name="cirrhosis_etiology_other" id="cirrhosis_etiology_other" class="form-control text_area_feedback" rows="1" maxlength="255" placeholder="Specify other ethiology. 255 characters max.">{{ $note->cirrhosis_etiology_other }}</textarea>
										<div id="cirrhosis_etiology_other_feedback" style="color:#b3b3b3"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
					{{-- <div class="col-md-12"><hr></div> --}}

					<div class="col-md-12 alert alert-info"><!-- field comorbid_coagulopathy type tinyInteger -->
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label col-md-4" for="comorbid_coagulopathy">Coagulopathy <a role="button" data-toggle="tooltip" data-placement="bottom" title="Click to reset." class="radio-reset" target="comorbid_coagulopathy" style="display: none;"><span class="fa fa-remove"></span></a> :</label>
								<div class="col-md-8">
									<label class="radio-inline"><input class="comorbid-has-extra-detail" type="radio" name="comorbid_coagulopathy" {{ $note->comorbid_coagulopathy == 99 ? 'checked' : '' }} value="99">No data</label>
									<label class="radio-inline"><input class="comorbid-has-extra-detail" type="radio" name="comorbid_coagulopathy" {{ $note->comorbid_coagulopathy === '0' ? 'checked' : '' }} value="0">No</label>
									<label class="radio-inline"><input class="comorbid-has-extra-detail" type="radio" name="comorbid_coagulopathy" {{ $note->comorbid_coagulopathy == 1 ? 'checked' : '' }} value="1">Yes</label>
								</div>
							</div>
						</div>
					</div>
					{{-- <div class="col-md-12"><hr></div> --}}

					<div class="col-md-12"><!-- field comorbid_HBV type tinyInteger -->
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label col-md-4" for="comorbid_HBV">HBV infection <a role="button" data-toggle="tooltip" data-placement="bottom" title="Click to reset." class="radio-reset" target="comorbid_HBV" style="display: none;"><span class="fa fa-remove"></span></a> :</label>
								<div class="col-md-8">
									<label class="radio-inline"><input class="comorbid-has-extra-detail" type="radio" name="comorbid_HBV" {{ $note->comorbid_HBV == 99 ? 'checked' : '' }} value="99">No data</label>
									<label class="radio-inline"><input class="comorbid-has-extra-detail" type="radio" name="comorbid_HBV" {{ $note->comorbid_HBV === '0' ? 'checked' : '' }} value="0">No</label>
									<label class="radio-inline"><input class="comorbid-has-extra-detail" type="radio" name="comorbid_HBV" {{ $note->comorbid_HBV == 1 ? 'checked' : '' }} value="1">Yes</label>
								</div>
							</div>
						</div>
					</div>
					{{-- <div class="col-md-12"><hr></div> --}}

					<div class="col-md-12 alert alert-info"><!-- field comorbid_HCV type tinyInteger -->
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label col-md-4" for="comorbid_HCV">HCV infection <a role="button" data-toggle="tooltip" data-placement="bottom" title="Click to reset." class="radio-reset" target="comorbid_HCV" style="display: none;"><span class="fa fa-remove"></span></a> :</label>
								<div class="col-md-8">
									<label class="radio-inline"><input class="comorbid-has-extra-detail" type="radio" name="comorbid_HCV" {{ $note->comorbid_HCV == 99 ? 'checked' : '' }} value="99">No data</label>
									<label class="radio-inline"><input class="comorbid-has-extra-detail" type="radio" name="comorbid_HCV" {{ $note->comorbid_HCV === '0' ? 'checked' : '' }} value="0">No</label>
									<label class="radio-inline"><input class="comorbid-has-extra-detail" type="radio" name="comorbid_HCV" {{ $note->comorbid_HCV == 1 ? 'checked' : '' }} value="1">Yes</label>
								</div>
							</div>
						</div>
					</div>
					{{-- <div class="col-md-12"><hr></div> --}}

					<div class="col-md-12"><!-- field comorbid_HIV type tinyInteger -->
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label col-md-4" for="comorbid_HIV">HIV <a role="button" data-toggle="tooltip" data-placement="bottom" title="Click to reset." class="radio-reset reset-comorbid-has-extra-detail" target="comorbid_HIV" style="display: none;"><span class="fa fa-remove"></span></a> :</label>
								<div class="col-md-8">
									<label class="radio-inline"><input class="comorbid-has-extra-detail" type="radio" name="comorbid_HIV" {{ $note->comorbid_HIV == 99 ? 'checked' : '' }} value="99">No data</label>
									<label class="radio-inline"><input class="comorbid-has-extra-detail" type="radio" name="comorbid_HIV" {{ $note->comorbid_HIV === '0' ? 'checked' : '' }} value="0">No</label>
									<label class="radio-inline"><input class="comorbid-has-extra-detail" type="radio" name="comorbid_HIV" {{ $note->comorbid_HIV == 1 ? 'checked' : '' }} value="1">Yes</label>
								</div>
							</div>
						</div>
						<div class="well collapse col-md-12" id="comorbid_HIV_collapse">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-4">Previous opportunistic infection</label>
									<!-- field HIV_pre_infect_TB type checkbox -->
									<div class="checkbox col-md-2"><label><input type="checkbox" {{ $note->HIV_pre_infect_TB ? 'checked' : '' }} name="HIV_pre_infect_TB">TB</label></div>
									<!-- field HIV_pre_infect_PCP type checkbox -->
									<div class="checkbox col-md-2"><label><input type="checkbox" {{ $note->HIV_pre_infect_PCP ? 'checked' : '' }} name="HIV_pre_infect_PCP">PCP</label></div>
									<!-- field HIV_pre_infect_candidiasis type checkbox -->
									<div class="checkbox col-md-2"><label><input type="checkbox" {{ $note->HIV_pre_infect_candidiasis ? 'checked' : '' }} name="HIV_pre_infect_candidiasis">Candidiasis</label></div>
									<!-- field HIV_pre_infect_CMV type checkbox -->
									<div class="checkbox col-md-2"><label><input type="checkbox" {{ $note->HIV_pre_infect_CMV ? 'checked' : '' }} name="HIV_pre_infect_CMV">CMV</label></div>
								</div>
							</div>
							<div class="col-md-12"><!-- field HIV_pre_infect_other type string -->
								<div class="form-group">
									<label class="control-label col-md-4" for="HIV_pre_infect_other">Other opportunistic infection :</label>
									<div class="col-md-8">
										<textarea name="HIV_pre_infect_other" id="HIV_pre_infect_other" class="form-control text_area_feedback" rows="1" maxlength="255" placeholder="Specify other ethiology. 255 characters max.">{{ $note->HIV_pre_infect_other }}</textarea>
										<div id="HIV_pre_infect_other_feedback" style="color:#b3b3b3"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
					{{-- <div class="col-md-12"><hr></div> --}}

					<div class="col-md-12 alert alert-info"><!-- field comorbid_epilepsy type tinyInteger -->
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label col-md-4" for="comorbid_epilepsy">Epilepsy <a role="button" data-toggle="tooltip" data-placement="bottom" title="Click to reset." class="radio-reset reset-comorbid-has-extra-detail" target="comorbid_epilepsy" style="display: none;"><span class="fa fa-remove"></span></a> :</label>
								<div class="col-md-8">
									<label class="radio-inline"><input class="comorbid-has-extra-detail" type="radio" name="comorbid_epilepsy" {{ $note->comorbid_epilepsy == 99 ? 'checked' : '' }} value="99">No data</label>
									<label class="radio-inline"><input class="comorbid-has-extra-detail" type="radio" name="comorbid_epilepsy" {{ $note->comorbid_epilepsy === '0' ? 'checked' : '' }} value="0">No</label>
									<label class="radio-inline"><input class="comorbid-has-extra-detail" type="radio" name="comorbid_epilepsy" {{ $note->comorbid_epilepsy == 1 ? 'checked' : '' }} value="1">Yes</label>
								</div>
							</div>
						</div>
						<div class="well collapse col-md-12" id="comorbid_epilepsy_collapse">
							<div class="col-md-12"><!-- field epilepsy_diag type tinyInteger -->
								<div class="form-group">
									<label class="control-label col-md-4" for="epilepsy_diag">Diagnosis <a role="button" data-toggle="tooltip" data-placement="bottom" title="Click to reset." class="radio-reset reset-has-other-textarea" target="epilepsy_diag" style="display: none;"><span class="fa fa-remove"></span></a> :</label>
									<div class="col-md-8">
										<label class="radio-inline"><input class="has-other-textarea" type="radio" name="epilepsy_diag" {{ $note->epilepsy_diag == 1 ? 'checked' : '' }} value="1">GTC</label>
										<label class="radio-inline"><input class="has-other-textarea" type="radio" name="epilepsy_diag" {{ $note->epilepsy_diag == 2 ? 'checked' : '' }} value="2">Focal</label>
										<label class="radio-inline"><input class="has-other-textarea" type="radio" name="epilepsy_diag" {{ $note->epilepsy_diag == 3 ? 'checked' : '' }} value="3">Complex partial seizure</label>
										<label class="radio-inline"><input class="has-other-textarea" type="radio" name="epilepsy_diag" {{ $note->epilepsy_diag == 4 ? 'checked' : '' }} value="4">Unknown</label>
										<label class="radio-inline"><input class="has-other-textarea" type="radio" name="epilepsy_diag" {{ $note->epilepsy_diag == 99 ? 'checked' : '' }} value="99">Others</label>
									</div>
								</div>
							</div>
							<div class="col-md-12 collapse" id="epilepsy_diag_other_collapse"><!-- field epilepsy_diag_other type string -->
								<div class="form-group">
									<label class="control-label col-md-4" for="epilepsy_diag_other">Other diagnosis :</label>
									<div class="col-md-8">
										<textarea name="epilepsy_diag_other" id="epilepsy_diag_other" class="form-control text_area_feedback" rows="1" maxlength="255" placeholder="Specify other epilepsy diagnosis. 255 characters max.">{{ $note->epilepsy_diag_other }}</textarea>
										<div id="epilepsy_diag_other_feedback" style="color:#b3b3b3"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
					{{-- <div class="col-md-12"><hr></div> --}}

					<div class="col-md-12"><!-- field comorbid_leukemia type tinyInteger -->
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label col-md-4" for="comorbid_leukemia">Leukemia <a role="button" data-toggle="tooltip" data-placement="bottom" title="Click to reset." class="radio-reset reset-comorbid-has-extra-detail" target="comorbid_leukemia" style="display: none;"><span class="fa fa-remove"></span></a> :</label>
								<div class="col-md-8">
									<label class="radio-inline"><input class="comorbid-has-extra-detail" type="radio" name="comorbid_leukemia" {{ $note->comorbid_leukemia == 99 ? 'checked' : '' }} value="99">No data</label>
									<label class="radio-inline"><input class="comorbid-has-extra-detail" type="radio" name="comorbid_leukemia" {{ $note->comorbid_leukemia === '0' ? 'checked' : '' }} value="0">No</label>
									<label class="radio-inline"><input class="comorbid-has-extra-detail" type="radio" name="comorbid_leukemia" {{ $note->comorbid_leukemia == 1 ? 'checked' : '' }} value="1">Yes</label>
								</div>
							</div>
						</div>
						<div class="well collapse col-md-12" id="comorbid_leukemia_collapse">
							<div class="col-md-12"><!-- field leukemia_diag type tinyInteger -->
								<div class="form-group">
									<label class="control-label col-md-4">Disgnosis <a role="button" data-toggle="tooltip" data-placement="bottom" title="Click to reset." class="radio-reset" target="leukemia_diag" style="display: none;"><span class="fa fa-remove"></span></a> :</label>
									<div class="col-md-8">
										<label class="radio-inline"><input type="radio" name="leukemia_diag" {{ $note->leukemia_diag == 1 ? 'checked' : '' }} value="1">ALL</label>
										<label class="radio-inline"><input type="radio" name="leukemia_diag" {{ $note->leukemia_diag == 2 ? 'checked' : '' }} value="2">AML</label>
										<label class="radio-inline"><input type="radio" name="leukemia_diag" {{ $note->leukemia_diag == 3 ? 'checked' : '' }} value="3">CLL</label>
										<label class="radio-inline"><input type="radio" name="leukemia_diag" {{ $note->leukemia_diag == 4 ? 'checked' : '' }} value="4">CML</label>
									</div>
								</div>
							</div>
						</div>
					</div>
					{{-- <div class="col-md-12"><hr></div> --}}

					<div class="col-md-12 alert alert-info"><!-- field comorbid_lymphoma type tinyInteger -->
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label col-md-4" for="comorbid_lymphoma">Lymphoma <a role="button" data-toggle="tooltip" data-placement="bottom" title="Click to reset." class="radio-reset reset-comorbid-has-extra-detail" target="comorbid_lymphoma" style="display: none;"><span class="fa fa-remove"></span></a> :</label>
								<div class="col-md-8">
									<label class="radio-inline"><input class="comorbid-has-extra-detail" type="radio" name="comorbid_lymphoma" {{ $note->comorbid_lymphoma == 99 ? 'checked' : '' }} value="99">No data</label>
									<label class="radio-inline"><input class="comorbid-has-extra-detail" type="radio" name="comorbid_lymphoma" {{ $note->comorbid_lymphoma === '0' ? 'checked' : '' }} value="0">No</label>
									<label class="radio-inline"><input class="comorbid-has-extra-detail" type="radio" name="comorbid_lymphoma" {{ $note->comorbid_lymphoma == 1 ? 'checked' : '' }} value="1">Yes</label>
								</div>
							</div>
						</div>
						<div class="well collapse col-md-12" id="comorbid_lymphoma_collapse">
							<div class="col-md-12"><!-- field lymphoma_diag type tinyInteger -->
								<div class="form-group">
									<label class="control-label col-md-4" for="lymphoma_diag">Diagnosis <a role="button" data-toggle="tooltip" data-placement="bottom" title="Click to reset." class="select-reset reset-has-other-textarea" target="lymphoma_diag" style="display: none;"><span class="fa fa-remove"></span></a> :</label>
									<div class="col-md-8" id="lymphoma_diag_select">
										<select class="form-control has-other-textarea" name="lymphoma_diag">
											<option selected disabled hidden value=""></option>
											<option value="1">Hodgkin</option>
											<option value="2">Non-Hodgkin - Diffuse large B cell</option>
											<option value="3">Non-Hodgkin - Diffuse large T cell</option>
											<option value="4">Non-Hodgkin - Follicular B cell</option>
											<option value="5">Non-Hodgkin - Follicular T cell</option>
											<option value="6">Non-Hodgkin - Burkitt High grade</option>
											<option value="7">Non-Hodgkin - Burkitt Low grade</option>
											<option value="8">Non-Hodgkin - Other High grade</option>
											<option value="9">Non-Hodgkin - Other Low grade</option>
											<option value="10">Intravascular</option>
											<option value="99">Other</option>
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-12 collapse" id="lymphoma_diag_other_collapse"><!-- field lymphoma_diag_other type string -->
								<div class="form-group">
									<label class="control-label col-md-4" for="lymphoma_diag_other">Other diagnosis :</label>
									<div class="col-md-8">
										<textarea name="lymphoma_diag_other" id="lymphoma_diag_other" class="form-control text_area_feedback" rows="1" maxlength="255" placeholder="Specify other CAD diagnosis. 255 characters max.">{{ $note->lymphoma_diag_other }}</textarea>
										<div id="lymphoma_diag_other_feedback" style="color:#b3b3b3"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
					{{-- <div class="col-md-12"><hr></div> --}}

					<div class="col-md-12"><!-- field comorbid_pacemaker_implant type tinyInteger -->
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label col-md-4" for="comorbid_pacemaker_implant">Pacemaker implant <a role="button" data-toggle="tooltip" data-placement="bottom" title="Click to reset." class="radio-reset reset-comorbid-has-extra-detail" target="comorbid_pacemaker_implant" style="display: none;"><span class="fa fa-remove"></span></a> :</label>
								<div class="col-md-8">
									<label class="radio-inline"><input class="comorbid-has-extra-detail" type="radio" name="comorbid_pacemaker_implant" {{ $note->comorbid_pacemaker_implant == 99 ? 'checked' : '' }} value="99">No data</label>
									<label class="radio-inline"><input class="comorbid-has-extra-detail" type="radio" name="comorbid_pacemaker_implant" {{ $note->comorbid_pacemaker_implant === '0' ? 'checked' : '' }} value="0">No</label>
									<label class="radio-inline"><input class="comorbid-has-extra-detail" type="radio" name="comorbid_pacemaker_implant" {{ $note->comorbid_pacemaker_implant == 1 ? 'checked' : '' }} value="1">Yes</label>
								</div>
							</div>
						</div>
						<div class="well collapse col-md-12" id="comorbid_pacemaker_implant_collapse">
							<div class="col-md-12"><!-- field pacemaker_implant_type type tinyInteger -->
								<div class="form-group">
									<label class="control-label col-md-4" for="pacemaker_implant_type">Type <a role="button" data-toggle="tooltip" data-placement="bottom" title="Click to reset." class="radio-reset reset-has-other-textarea" target="pacemaker_implant_type" style="display: none;"><span class="fa fa-remove"></span></a> :</label>
									<div class="col-md-8">
										<label class="radio-inline"><input class="has-other-textarea" type="radio" name="pacemaker_implant_type" {{ $note->pacemaker_implant_type == 1 ? 'checked' : '' }} value="1">DDDR <a role="button" data-toggle="tooltip" data-placement="bottom" title="dual-chamber, rate-modulated"><span class="fa fa-info-circle"></span></a></label>
										<label class="radio-inline"><input class="has-other-textarea" type="radio" name="pacemaker_implant_type" {{ $note->pacemaker_implant_type == 2 ? 'checked' : '' }} value="2">VVI</label>
										<label class="radio-inline"><input class="has-other-textarea" type="radio" name="pacemaker_implant_type" {{ $note->pacemaker_implant_type == 99 ? 'checked' : '' }} value="99">Others</label>
									</div>
								</div>
							</div>
							<div class="col-md-12 collapse" id="pacemaker_implant_type_other_collapse"><!-- field pacemaker_implant_type_other type string -->
								<div class="form-group">
									<label class="control-label col-md-4" for="pacemaker_implant_type_other">Other diagnosis :</label>
									<div class="col-md-8">
										<textarea name="pacemaker_implant_type_other" id="pacemaker_implant_type_other" class="form-control text_area_feedback" rows="1" maxlength="255" placeholder="Specify other CAD diagnosis. 255 characters max.">{{ $note->pacemaker_implant_type_other }}</textarea>
										<div id="pacemaker_implant_type_other_feedback" style="color:#b3b3b3"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
					{{-- <div class="col-md-12"><hr></div> --}}

					<div class="col-md-12 alert alert-info"><!-- field comorbid_ICD type tinyInteger -->
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label col-md-4" for="comorbid_ICD">ICD <a role="button" data-toggle="tooltip" data-placement="bottom" title="Implantable Cardioverter Defibrillator"><span class="fa fa-info-circle"></span></a> <a role="button" data-toggle="tooltip" data-placement="bottom" title="Click to reset." class="radio-reset reset-comorbid-has-extra-detail" target="comorbid_ICD" style="display: none;"><span class="fa fa-remove"></span></a> :</label>
								<div class="col-md-8">
									<label class="radio-inline"><input class="comorbid-has-extra-detail" type="radio" name="comorbid_ICD" {{ $note->comorbid_ICD == 99 ? 'checked' : '' }} value="99">No data</label>
									<label class="radio-inline"><input class="comorbid-has-extra-detail" type="radio" name="comorbid_ICD" {{ $note->comorbid_ICD === '0' ? 'checked' : '' }} value="0">No</label>
									<label class="radio-inline"><input class="comorbid-has-extra-detail" type="radio" name="comorbid_ICD" {{ $note->comorbid_ICD == 1 ? 'checked' : '' }} value="1">Yes</label>
								</div>
							</div>
						</div>
						<div class="well collapse col-md-12" id="comorbid_ICD_collapse">
							<div class="col-md-12"><!-- field ICD_type type string -->
								<div class="form-group">
									<label class="control-label col-md-4" for="ICD_type">TCD type :</label>
									<div class="col-md-8">
										<textarea name="ICD_type" id="ICD_type" class="form-control text_area_feedback" rows="1" maxlength="255" placeholder="Specify ICD type. 255 characters max.">{{ $note->ICD_type }}</textarea>
										<div id="ICD_type_feedback" style="color:#b3b3b3"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
					{{-- <div class="col-md-12"><hr></div> --}}

					<div class="col-md-12"><!-- field comorbid_cancer type tinyInteger -->
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label col-md-4" for="comorbid_cancer">Cancer <a role="button" data-toggle="tooltip" data-placement="bottom" title="Click to reset." class="radio-reset reset-comorbid-has-extra-detail" target="comorbid_cancer" style="display: none;"><span class="fa fa-remove"></span></a> :</label>
								<div class="col-md-8">
									<label class="radio-inline"><input class="comorbid-has-extra-detail" type="radio" name="comorbid_cancer" {{ $note->comorbid_cancer == 99 ? 'checked' : '' }} value="99">No data</label>
									<label class="radio-inline"><input class="comorbid-has-extra-detail" type="radio" name="comorbid_cancer" {{ $note->comorbid_cancer === '0' ? 'checked' : '' }} value="0">No</label>
									<label class="radio-inline"><input class="comorbid-has-extra-detail" type="radio" name="comorbid_cancer" {{ $note->comorbid_cancer == 1 ? 'checked' : '' }} value="1">Yes</label>
								</div>
							</div>
						</div>
						<div class="well collapse col-md-12" id="comorbid_cancer_collapse">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-4">Select organs :</label>
									<div class="col-md-8">
										<!-- field cancer_at_lung type checkbox -->
										<div class="col-md-3 checkbox"><label><input type="checkbox" {{ $note->cancer_at_lung ? 'checked' : '' }} name="cancer_at_lung">Lung</label></div>
										<!-- field cancer_at_liver type checkbox -->
										<div class="col-md-3 checkbox"><label><input type="checkbox" {{ $note->cancer_at_liver ? 'checked' : '' }} name="cancer_at_liver">Liver</label></div>
										<!-- field cancer_at_colon type checkbox -->
										<div class="col-md-3 checkbox"><label><input type="checkbox" {{ $note->cancer_at_colon ? 'checked' : '' }} name="cancer_at_colon">Colon</label></div>
										<!-- field cancer_at_breast type checkbox -->
										<div class="col-md-3 checkbox"><label><input type="checkbox" {{ $note->cancer_at_breast ? 'checked' : '' }} name="cancer_at_breast">Breast</label></div>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<div class="col-md-8 col-md-offset-4">
										<!-- field cancer_at_prostate type checkbox -->
										<div class="col-md-3 checkbox"><label><input type="checkbox" {{ $note->cancer_at_prostate ? 'checked' : '' }} name="cancer_at_prostate">Prostate</label></div>
										<!-- field cancer_at_cervix type checkbox -->
										<div class="col-md-3 checkbox"><label><input type="checkbox" {{ $note->cancer_at_cervix ? 'checked' : '' }} name="cancer_at_cervix">Cervix</label></div>
										<!-- field cancer_at_pancreas type checkbox -->
										<div class="col-md-3 checkbox"><label><input type="checkbox" {{ $note->cancer_at_pancreas ? 'checked' : '' }} name="cancer_at_pancreas">Pancreas</label></div>
										<!-- field cancer_at_brain type checkbox -->
										<div class="col-md-3 checkbox"><label><input type="checkbox" {{ $note->cancer_at_brain ? 'checked' : '' }} name="cancer_at_brain">Brain</label></div>
									</div>
								</div>
							</div>
							<div class="col-md-12"><!-- field cancer_at_other type string -->
								<div class="form-group">
									<label class="control-label col-md-4" for="cancer_at_other">Other organs :</label>
									<div class="col-md-8">
										<textarea name="cancer_at_other" id="cancer_at_other" class="form-control text_area_feedback" rows="1" maxlength="255" placeholder="Specify other organ. 255 characters max.">{{ $note->cancer_at_other }}</textarea>
										<div id="cancer_at_other_feedback" style="color:#b3b3b3"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
					{{-- <div class="col-md-12"><hr></div> --}}

					<div class="col-md-12 alert alert-info"><!-- field comorbid_chronic_arthritis type tinyInteger -->
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label col-md-4" for="comorbid_chronic_arthritis">Chronic arthritis <a role="button" data-toggle="tooltip" data-placement="bottom" title="Click to reset." class="radio-reset reset-comorbid-has-extra-detail" target="comorbid_chronic_arthritis" style="display: none;"><span class="fa fa-remove"></span></a> :</label>
								<div class="col-md-8">
									<label class="radio-inline"><input class="comorbid-has-extra-detail" type="radio" name="comorbid_chronic_arthritis" {{ $note->comorbid_chronic_arthritis == 99 ? 'checked' : '' }} value="99">No data</label>
									<label class="radio-inline"><input class="comorbid-has-extra-detail" type="radio" name="comorbid_chronic_arthritis" {{ $note->comorbid_chronic_arthritis === '0' ? 'checked' : '' }} value="0">No</label>
									<label class="radio-inline"><input class="comorbid-has-extra-detail" type="radio" name="comorbid_chronic_arthritis" {{ $note->comorbid_chronic_arthritis == 1 ? 'checked' : '' }} value="1">Yes</label>
								</div>
							</div>
						</div>
						<div class="well collapse col-md-12" id="comorbid_chronic_arthritis_collapse">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-4">Diagnosis :</label>
									<div class="col-md-8">
										<!-- field chronic_arthritis_CPPD type checkbox -->
										<div class="col-md-3 checkbox"><label><input type="checkbox" {{ $note->chronic_arthritis_CPPD ? 'checked' : '' }} name="chronic_arthritis_CPPD">CPPD <a role="button" data-toggle="tooltip" data-placement="bottom" title="Calcium pyrophosphate dihydrate"><span class="fa fa-info-circle"></span></a></label></div>
										<!-- field chronic_arthritis_rheumatoid type checkbox -->
										<div class="col-md-3 checkbox"><label><input type="checkbox" {{ $note->chronic_arthritis_rheumatoid ? 'checked' : '' }} name="chronic_arthritis_rheumatoid">Rheumatoid</label></div>
										<!-- field chronic_arthritis_OA type checkbox -->
										<div class="col-md-3 checkbox"><label><input type="checkbox" {{ $note->chronic_arthritis_OA ? 'checked' : '' }} name="chronic_arthritis_OA">OA <a role="button" data-toggle="tooltip" data-placement="bottom" title="Osteoarthritis"><span class="fa fa-info-circle"></span></a></label></div>
										<!-- field chronic_arthritis_spondyloarthropathy type checkbox -->
										<div class="col-md-3 checkbox"><label><input type="checkbox" {{ $note->chronic_arthritis_spondyloarthropathy ? 'checked' : '' }} name="chronic_arthritis_spondyloarthropathy">Spondyloarthropathy</label></div>
									</div>
								</div>
							</div>
							<div class="col-md-12"><!-- field chronic_arthritis_other type string -->
								<div class="form-group">
									<label class="control-label col-md-4" for="chronic_arthritis_other">Other :</label>
									<div class="col-md-8">
										<textarea name="chronic_arthritis_other" id="chronic_arthritis_other" class="form-control text_area_feedback" rows="1" maxlength="255" placeholder="Specify other chronic arthritis. 255 characters max.">{{ $note->chronic_arthritis_other }}</textarea>
										<div id="chronic_arthritis_other_feedback" style="color:#b3b3b3"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
					{{-- <div class="col-md-12"><hr></div> --}}

					<div class="col-md-12"><!-- field comorbid_SLE type tinyInteger -->
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label col-md-4" for="comorbid_SLE">SLE <a role="button" data-toggle="tooltip" data-placement="bottom" title="Click to reset." class="radio-reset" target="comorbid_SLE" style="display: none;"><span class="fa fa-remove"></span></a> :</label>
								<div class="col-md-8">
									<label class="radio-inline"><input type="radio" name="comorbid_SLE" {{ $note->comorbid_SLE == 99 ? 'checked' : '' }} value="99">No data</label>
									<label class="radio-inline"><input type="radio" name="comorbid_SLE" {{ $note->comorbid_SLE === '0' ? 'checked' : '' }} value="0">No</label>
									<label class="radio-inline"><input type="radio" name="comorbid_SLE" {{ $note->comorbid_SLE == 1 ? 'checked' : '' }} value="1">Yes</label>
								</div>
							</div>
						</div>
					</div>
					{{-- <div class="col-md-12"><hr></div> --}}
					
					<div class="col-md-12 alert alert-info"><!-- field comorbid_other_autoimmune_disease type tinyinteger -->
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label col-md-4" for="comorbid_other_autoimmune_disease">Other autoimmune disease <a role="button" data-toggle="tooltip" data-placement="bottom" title="Click to reset." class="radio-reset reset-comorbid-has-extra-detail" target="comorbid_other_autoimmune_disease" style="display: none;"><span class="fa fa-remove"></span></a> :</label>
								<div class="col-md-8">
									<label class="radio-inline"><input class="comorbid-has-extra-detail" type="radio" name="comorbid_other_autoimmune_disease" {{ $note->comorbid_other_autoimmune_disease == 99 ? 'checked' : '' }} value="99">No data</label>
									<label class="radio-inline"><input class="comorbid-has-extra-detail" type="radio" name="comorbid_other_autoimmune_disease" {{ $note->comorbid_other_autoimmune_disease === '0' ? 'checked' : '' }} value="0">No</label>
									<label class="radio-inline"><input class="comorbid-has-extra-detail" type="radio" name="comorbid_other_autoimmune_disease" {{ $note->comorbid_other_autoimmune_disease == 1 ? 'checked' : '' }} value="1">Yes</label>
								</div>
							</div>
						</div>
						<div class="well collapse col-md-12" id="comorbid_other_autoimmune_disease_collapse">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-4">Diagnosis :</label>
									<div class="col-md-8">
										<!-- field other_autoimmune_disease_diag_sjrogren_syndrome type checkbox -->
										<div class="col-md-4 checkbox"><label><input type="checkbox" {{ $note->other_autoimmune_disease_diag_sjrogren_syndrome ? 'checked' : '' }} name="other_autoimmune_disease_diag_sjrogren_syndrome">Sjrögren syndrome</label></div>
										<!-- field other_autoimmune_disease_diag_UCTD type checkbox -->
										<div class="col-md-4 checkbox"><label><input type="checkbox" {{ $note->other_autoimmune_disease_diag_UCTD ? 'checked' : '' }} name="other_autoimmune_disease_diag_UCTD">UCTD <a role="button" data-toggle="tooltip" data-placement="bottom" title="Undifferentiated Connective Tissue Disease"><span class="fa fa-info-circle"></span></a></label></div>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<div class="col-md-8 col-md-offset-4">
										<!-- field other_autoimmune_disease_diag_MCTD type checkbox -->
										<div class="col-md-4 checkbox"><label><input type="checkbox" {{ $note->other_autoimmune_disease_diag_MCTD ? 'checked' : '' }} name="other_autoimmune_disease_diag_MCTD">MCTD <a role="button" data-toggle="tooltip" data-placement="bottom" title="Mixed Connective Tissue Disease"><span class="fa fa-info-circle"></span></a></label></div>
										<!-- field other_autoimmune_disease_diag_DMPM type checkbox -->
										<div class="col-md-4 checkbox"><label><input type="checkbox" {{ $note->other_autoimmune_disease_diag_DMPM ? 'checked' : '' }} name="other_autoimmune_disease_diag_DMPM">DMPM <a role="button" data-toggle="tooltip" data-placement="bottom" title="Dermato Myositis Poly Myositis"><span class="fa fa-info-circle"></span></a></label></div>
									</div>
								</div>
							</div>
							<div class="col-md-12"><!-- field other_autoimmune_disease_diag_other type string -->
								<div class="form-group">
									<label class="control-label col-md-4" for="other_autoimmune_disease_diag_other">Other :</label>
									<div class="col-md-8">
										<textarea name="other_autoimmune_disease_diag_other" id="other_autoimmune_disease_diag_other" class="form-control text_area_feedback" rows="1" maxlength="255" placeholder="Specify other chronic arthritis. 255 characters max.">{{ $note->other_autoimmune_disease_diag_other }}</textarea>
										<div id="other_autoimmune_disease_diag_other_feedback" style="color:#b3b3b3"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
					{{-- <div class="col-md-12"><hr></div> --}}

					<div class="col-md-12"><!-- field comorbid_TB type tinyInteger -->
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label col-md-4" for="comorbid_TB">TB <a role="button" data-toggle="tooltip" data-placement="bottom" title="Click to reset." class="radio-reset reset-comorbid-has-extra-detail" target="comorbid_TB" style="display: none;"><span class="fa fa-remove"></span></a> :</label>
								<div class="col-md-8">
									<label class="radio-inline"><input class="comorbid-has-extra-detail" type="radio" name="comorbid_TB" {{ $note->comorbid_TB == 99 ? 'checked' : '' }} value="99">No data</label>
									<label class="radio-inline"><input class="comorbid-has-extra-detail" type="radio" name="comorbid_TB" {{ $note->comorbid_TB === '0' ? 'checked' : '' }} value="0">No</label>
									<label class="radio-inline"><input class="comorbid-has-extra-detail" type="radio" name="comorbid_TB" {{ $note->comorbid_TB == 1 ? 'checked' : '' }} value="1">Yes</label>
								</div>
							</div>
						</div>
						<div class="well collapse col-md-12" id="comorbid_TB_collapse">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-4">Specify :</label>
									<div class="col-md-8">
										<!-- field TB_at_pulmonary type checkbox -->
										<div class="col-md-4 checkbox"><label><input type="checkbox" {{ $note->TB_at_pulmonary ? 'ckecked' : '' }} name="TB_at_pulmonary">Pulmonary</label></div>
										<!-- field TB_at_other type string -->
										<div class="col-md-8"><input class="form-control" type="text" name="TB_at_other" value="{{ $note->TB_at_other }}" placeholder="specify other TB."></div>
									</div>
								</div>
							</div>
						</div>
					</div>
					{{-- <div class="col-md-12"><hr></div> --}}

					<div class="col-md-12 alert alert-info"><!-- field comorbid_dementia type tinyInteger -->
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label col-md-4" for="comorbid_dementia">Dementia <a role="button" data-toggle="tooltip" data-placement="bottom" title="Click to reset." class="radio-reset reset-comorbid-has-extra-detail" target="comorbid_dementia" style="display: none;"><span class="fa fa-remove"></span></a> :</label>
								<div class="col-md-8">
									<label class="radio-inline"><input class="comorbid-has-extra-detail" type="radio" name="comorbid_dementia" {{ $note->comorbid_dementia == 99 ? 'checked' : '' }} value="99">No data</label>
									<label class="radio-inline"><input class="comorbid-has-extra-detail" type="radio" name="comorbid_dementia" {{ $note->comorbid_dementia === '0' ? 'checked' : '' }} value="0">No</label>
									<label class="radio-inline"><input class="comorbid-has-extra-detail" type="radio" name="comorbid_dementia" {{ $note->comorbid_dementia == 1 ? 'checked' : '' }} value="1">Yes</label>
								</div>
							</div>
						</div>
						<div class="well collapse col-md-12" id="comorbid_dementia_collapse">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-4">Specify :</label>
									<div class="col-md-8">
										<!-- field dementia_vascular type checkbox -->
										<div class="col-md-3 checkbox"><label><input type="checkbox" {{ $note->dementia_vascular ? 'ckecked' : '' }} name="dementia_vascular">Vascular</label></div>
										<!-- field dementia_alzheimer type checkbox -->
										<div class="col-md-3 checkbox"><label><input type="checkbox" {{ $note->dementia_alzheimer ? 'ckecked' : '' }} name="dementia_alzheimer">Alzheimer</label></div>
										<!-- field dementia_other type string -->
										<div class="col-md-6"><input class="form-control" type="text" name="dementia_other" value="{{ $note->dementia_other }}" placeholder="specify other dementia."></div>
									</div>
								</div>
							</div>
						</div>
					</div>
					{{-- <div class="col-md-12"><hr></div> --}}

					<div class="col-md-12"><!-- field comorbid_psychiatric_illness type tinyInteger -->
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label col-md-4" for="comorbid_psychiatric_illness">Psychiatric illness <a role="button" data-toggle="tooltip" data-placement="bottom" title="Click to reset." class="radio-reset reset-comorbid-has-extra-detail" target="comorbid_psychiatric_illness" style="display: none;"><span class="fa fa-remove"></span></a> :</label>
								<div class="col-md-8">
									<label class="radio-inline"><input class="comorbid-has-extra-detail" type="radio" name="comorbid_psychiatric_illness" {{ $note->comorbid_psychiatric_illness == 99 ? 'checked' : '' }} value="99">No data</label>
									<label class="radio-inline"><input class="comorbid-has-extra-detail" type="radio" name="comorbid_psychiatric_illness" {{ $note->comorbid_psychiatric_illness === '0' ? 'checked' : '' }} value="0">No</label>
									<label class="radio-inline"><input class="comorbid-has-extra-detail" type="radio" name="comorbid_psychiatric_illness" {{ $note->comorbid_psychiatric_illness == 1 ? 'checked' : '' }} value="1">Yes</label>
								</div>
							</div>
						</div>
						<div class="well collapse col-md-12" id="comorbid_psychiatric_illness_collapse">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-4">Select :</label>
									<div class="col-md-8">
										<!-- field psychiatric_illness_diag_schizophrenia type checkbox -->
										<div class="col-md-4 checkbox"><label><input type="checkbox" {{ $note->psychiatric_illness_diag_schizophrenia ? 'checked' : '' }} name="psychiatric_illness_diag_schizophrenia">Schizophrenia</label></div>
										<!-- field psychiatric_illness_diag_major_depression type checkbox -->
										<div class="col-md-4 checkbox"><label><input type="checkbox" {{ $note->psychiatric_illness_diag_major_depression ? 'checked' : '' }} name="psychiatric_illness_diag_major_depression">Major depression</label></div>
										<!-- field psychiatric_illness_diag_bipolar_disorder type checkbox -->
										<div class="col-md-4 checkbox"><label><input type="checkbox" {{ $note->psychiatric_illness_diag_bipolar_disorder ? 'checked' : '' }} name="psychiatric_illness_diag_bipolar_disorder">Bipolar disorder</label></div>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<div class="col-md-8 col-md-offset-4">
										<!-- field psychiatric_illness_diag_adjustment_disorder type checkbox -->
										<div class="col-md-6 checkbox"><label><input type="checkbox" {{ $note->psychiatric_illness_diag_adjustment_disorder ? 'checked' : '' }} name="psychiatric_illness_diag_adjustment_disorder">Adjustment disorder</label></div>
										<!-- field psychiatric_illness_diag_Obcessive_compulsive_disorder type checkbox -->
										<div class="col-md-6 checkbox"><label><input type="checkbox" {{ $note->psychiatric_illness_diag_Obcessive_compulsive_disorder ? 'checked' : '' }} name="psychiatric_illness_diag_Obcessive_compulsive_disorder">Obcessive compulsive disorder</label></div>
									</div>
								</div>
							</div>
							<div class="col-md-12"><!-- field psychiatric_illness_other type string -->
								<div class="form-group">
									<label class="control-label col-md-4" for="psychiatric_illness_other">Other :</label>
									<div class="col-md-8">
										<textarea name="psychiatric_illness_other" id="psychiatric_illness_other" class="form-control text_area_feedback" rows="1" maxlength="255" placeholder="Specify other physical illness. 255 characters max.">{{ $note->psychiatric_illness_other }}</textarea>
										<div id="psychiatric_illness_other_feedback" style="color:#b3b3b3"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
					{{-- <div class="col-md-12"><hr></div> --}}

					<div class="col-md-12 alert alert-info"><!-- field comorbid_other type string -->
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label col-md-4" for="comorbid_other">Other co-morbid :</label>
								<div class="col-md-8">
									<textarea name="comorbid_other" id="comorbid_other" class="form-control text_area_feedback" rows="1" maxlength="255" placeholder="Specify other comorbid. 255 characters max.">{{ $note->comorbid_other }}</textarea>
									<div id="comorbid_other_feedback" style="color:#b3b3b3"></div>
								</div>
							</div>
						</div>
					</div>
        </div><!-- end collapse Comorbid list -->
        <div class="col-md-12"><hr></div>
				
				<div class="col-md-12"><!-- field history_present_illness type text -->
					<div class="form-group">
						<label class="control-label" for="history_present_illness">History of present illness :</label>
						<textarea name="history_present_illness" id="history_present_illness" class="form-control text_area_feedback" rows="1" maxlength="65535">{{ $note->history_present_illness }}</textarea>
						<div id="history_present_illness_feedback" style="color:#b3b3b3"></div>
					</div>
				</div>
				<div class="col-md-12"><!-- field history_past_illness type text -->
					<div class="form-group">
						<label class="control-label" for="history_past_illness">History of past illness :</label>
						<textarea name="history_past_illness" id="history_past_illness" class="form-control text_area_feedback" rows="1" maxlength="65535">{{ $note->history_past_illness }}</textarea>
						<div id="history_past_illness_feedback" style="color:#b3b3b3"></div>
					</div>
				</div>
			</div><!-- end panel-body co-morbid -->
		</div><!-- end panel co-morbid -->
		
		<div class="panel panel-info" id="personal_social_history_panel"><!-- panel Personal and Social history -->
			<div class="panel-heading">Personal and Social history</div>
			<div class="panel-body">
				<div class="form-horizontal row">
					@if (!$note->note->patient->gender)<!-- women_only collapse -->
						<div class="col-md-6"><!-- field pregnant type tinyInteger -->
							<div class="form-group">
								<label class="control-label col-md-4" for="pregnant">Pregnant :</label>
								<div class="col-md-8">
									<label class="radio-inline"><input class="yes-then-extra-input" type="radio" name="pregnant" {{ $note->pregnant === '0' ? 'checked' : '' }} value="0">No</label>
									<label class="radio-inline"><input class="yes-then-extra-input" type="radio" name="pregnant" {{ $note->pregnant == 1 ? 'checked' : '' }} value="1">Yes</label>
									<label class="radio-inline"><input class="yes-then-extra-input" type="radio" name="pregnant" {{ $note->pregnant == 2 ? 'checked' : '' }} value="2">Uncertain</label>
								</div>
							</div>
						</div>

						<div class="col-md-6"><!-- field pregnant_weeks type tinyInteger -->
							<div class="form-group">
								<label class="control-label col-md-4" for="pregnant_weeks">Gastation :</label>
								<div class="col-md-6">
									<div class="input-group">
										<input class="form-control" disabled type="text" name="pregnant_weeks">
										<span class="input-group-addon">weeks</span>
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-md-6"><!-- field LMP type string -->
							<div class="form-group">
								<label class="control-label col-md-4">LMP <a role="button" data-toggle="tooltip" data-placement="bottom" data-toggle="tooltip" data-placement="bottom" title="ลงข้อมูล LMP เป็นวันที่ในรูปแบบ dd/mm/yyyy หรือหากไม่ทราบให้บรรยายเช่น 10 ปีที่ผ่านมา เป็นต้น"><span class="fa fa-question-circle"></span></a> :</label>
								<div class="col-md-8">
									<input class="form-control"  type="text" name="LMP">
								</div>
							</div>
						</div>
						<div class="col-md-12"><hr></div>
					@endif<!-- end of women_only collapse -->
							
					<div class="col-md-12"><!-- field alcohol type tinyInteger -->
						<div class="form-group">
							<label class="control-label col-md-2">Alcohol :</label>
							<div class="col-md-4">
								<label class="radio-inline"><input class="has-template-helper" type="radio" name="alcohol" {{ $note->alcohol === '0' ? 'checked' : '' }} value="0">No</label>
								<label class="radio-inline"><input class="has-template-helper" type="radio" name="alcohol" {{ $note->alcohol == 1 ? 'checked' : '' }} value="1">Yes</label>
								<label class="radio-inline"><input class="has-template-helper" type="radio" name="alcohol" {{ $note->alcohol == 2 ? 'checked' : '' }} value="2">Ex-drinker</label>
							</div>
						</div>
					</div>
					
					<div class="collapse col-md-12" id="alcohol_amount_template_collapse">
						@include('medicine.notes.admission.template.alcohol')
					</div>

					<div class="col-md-12"><!-- field alcohol_amount type string -->
						<div class="form-group">
							<label class="control-label col-md-2">Drink amount :</label>
							<div class="col-md-10">
									<textarea name="alcohol_amount" id="alcohol_amount" class="form-control text_area_feedback" rows="1" maxlength="255">{{ $note->alcohol_amount }}</textarea>
									<div id="alcohol_amount_feedback" style="color:#b3b3b3"></div>
								</div>
						</div>
					</div>
					<div class="col-md-12"><hr></div>
					
					<div class="col-md-12"><!-- field smoking type tinyInteger -->
						<div class="form-group">
							<label class="control-label col-md-2">Cigarette smoking :</label>
							<div class="col-md-10">
								<label class="radio-inline"><input class="has-template-helper" type="radio" {{ $note->smoking === '0' ? 'checked' : '' }} name="smoking" value="0">No</label>
								<label class="radio-inline"><input class="has-template-helper" type="radio" {{ $note->smoking == 1 ? 'checked' : '' }} name="smoking" value="1">Yes</label>
								<label class="radio-inline"><input class="has-template-helper" type="radio" {{ $note->smoking == 2 ? 'checked' : '' }} name="smoking" value="2">Ex-smoker</label>
							</div>
						</div>
					</div>			
					<div class="collapse col-md-12" id="smoking_template_collapse">
						@include('medicine.notes.admission.template.smoking')
					</div>
					<div class="col-md-12"><!-- field smoking_amount type string -->
						<div class="form-group">
							<label class="control-label col-md-2">Drink amount :</label>
							<div class="col-md-10">
									<textarea name="smoking_amount" id="smoking_amount" class="form-control text_area_feedback" rows="1" maxlength="255">{{ $note->smoking_amount }}</textarea>
									<div id="smoking_amount_feedback" style="color:#b3b3b3"></div>
								</div>
						</div>
					</div>
				</div><!-- end Personal and Social history row part-->
				<div><hr></div>

				<div class="col-md-12"><!-- field personal_social_history type text -->
					<div class="form-group">
						<label class="control-label" for="personal_social_history">History of present illness :</label>
						<textarea name="personal_social_history" id="personal_social_history" class="form-control text_area_feedback" rows="1" maxlength="65535">{{ $note->personal_social_history }}</textarea>
						<div id="personal_social_history_feedback" style="color:#b3b3b3"></div>
					</div>
				</div>
			</div><!-- panel body -->
		</div><!-- end panel Personal and Social history -->
		
		<div class="panel panel-info" id="special_requirement_panel">
			<div class="panel-heading">Special requirement</div>
			<div class="panel-body">
				<div class="form-horizontal row">
					<!-- field special_requirement_ng_tube type checkbox -->
					<div class="checkbox col-md-3"><label><input type="checkbox" {{ $note->special_requirement_ng_tube ? 'ckecked' : '' }} name="special_requirement_ng_tube">NG tube</label></div>
					<!-- field special_requirement_ng_suction type checkbox -->
					<div class="checkbox col-md-3"><label><input type="checkbox" {{ $note->special_requirement_ng_suction ? 'ckecked' : '' }} name="special_requirement_ng_suction">NG suction</label></div>
					<!-- field special_requirement_gastrostomy type checkbox -->
					<div class="checkbox col-md-3"><label><input type="checkbox" {{ $note->special_requirement_gastrostomy ? 'ckecked' : '' }} name="special_requirement_gastrostomy">Gastrostomy feeding</label></div>
					<!-- field special_requirement_urinary_cath type checkbox -->
					<div class="checkbox col-md-3"><label><input type="checkbox" {{ $note->special_requirement_urinary_cath ? 'ckecked' : '' }} name="special_requirement_urinary_cath">Urinary cath. care</label></div>
					<!-- field special_requirement_tracheostomy type checkbox -->
					<div class="checkbox col-md-3"><label><input type="checkbox" {{ $note->special_requirement_tracheostomy ? 'ckecked' : '' }} name="special_requirement_tracheostomy">Tracheostomy care</label></div>
					<!-- field special_requirement_hearing_impairment type checkbox -->
					<div class="checkbox col-md-3"><label><input type="checkbox" {{ $note->special_requirement_hearing_impairment ? 'ckecked' : '' }} name="special_requirement_hearing_impairment">Hearing impaiment</label></div>
					<!-- field special_requirement_isolate_room type checkbox -->
					<div class="checkbox col-md-3"><label><input type="checkbox" {{ $note->special_requirement_isolate_room ? 'ckecked' : '' }} name="special_requirement_isolate_room">Isolation room</label></div>
				</div>
				<div class="col-md-12"><br/></div>
				<div class="form-group"><!-- field special_requirement_other type string -->
					<label class="control-label" for="special_requirement_other">Other special requirement :</label>
					<textarea name="special_requirement_other" id="special_requirement_other" class="form-control text_area_feedback" rows="1" maxlength="255" placeholder="Specify other special requirement. 255 characters max.">{{ $note->special_requirement_other }}</textarea>
					<div id="special_requirement_other_feedback" style="color:#b3b3b3"></div>
				</div>
			</div><!-- panel body -->
		</div><!-- end panel special_requirement -->

		<div class="panel panel-info" id="family_history_panel"><!-- field personal_family_history type text -->
			<div class="panel-heading">Family history</div>
			<div class="panel-body">
				<textarea name="personal_family_history" id="personal_family_history" class="form-control text_area_feedback" rows="1" maxlength="65535">{{ $note->personal_family_history }}</textarea>
				<div id="personal_family_history_feedback" style="color:#b3b3b3"></div>
			</div>
		</div><!-- end panel family history -->

		<div class="panel panel-info" id="current_medications_panel"><!-- field current_medications type text -->
			<div class="panel-heading">Current medications</div>
			<div class="panel-body">
				<div class='well'>
					<div class='form-group'>
						<div class="input-group">
		  				<span class="input-group-addon"><i class="fa fa-lightbulb-o"></i></span>
							<input class="form-control ui-widget autocomplete-to-textarea" type="text" target="current_medications" endpoint="/itemize/drug/">
							<span class="input-group-btn">
	        			<button class="btn btn-default btn-autocomplete-to-textarea" type="button" target="current_medications"><span class="fa fa-medkit"></span></button>
	      			</span>
						</div>
					</div>
				</div>
				<textarea class="form-control text_area_feedback" name="current_medications" id="current_medications" rows="1" maxlength="1000">{{ $note->current_medications }}</textarea>
				<div id="current_medications_feedback" style="color:#b3b3b3"></div>
			</div>
		</div><!-- end panel Current medications  -->

		<div class="panel panel-info" id="allergy_panel"><!-- field allergy type string -->
			<div class="panel-heading">Allergy/Adverse event (Drug, Food, Chemical)</div>
			<div class="panel-body">
				<textarea class="form-control text_area_feedback" name="allergy" id="allergy" rows="1" maxlength="255" placeholder="Specify allergy. 255 characters max.">{{ $note->allergy }}</textarea>
				<div id="allergy_feedback" style="color:#b3b3b3"></div>
			</div>
		</div><!-- end panel allergy  -->

		<div class="panel panel-info" id="review_systems_panel">
			<div class="panel-heading">Review of systems</div>
			<div class="panel-body">
				<label class="control-label text-left" for="specified_review_general_symptoms">General symptoms <a class="fa fa-toggle-on icon-toggle-collapse-textarea" target="specified_review_general_symptoms_collapse" role="button" data-toggle="tooltip" data-placement="bottom" title="Show/Hide detail."></a> : <span class="fa fa-ellipsis-h"></span> <a class="fa fa-list-ul" onclick="$('#specified_review_general_symptoms_template_collapse').collapse('toggle');" role="button" data-toggle="tooltip" data-placement="bottom" title="Show/Hide template."></a></label>
				<div class="collapse" id="specified_review_general_symptoms_template_collapse">
					@include('medicine.notes.admission.template.review.general_symptoms')
				</div>
				<!-- field specified_review_general_symptoms type text -->
				<div class="collapse in" id="specified_review_general_symptoms_collapse">
					<textarea class="form-control text_area_feedback" name="specified_review_general_symptoms" id="specified_review_general_symptoms" rows="1" maxlength="1000" placeholder="Specify important findings.">{{ $note->specified_review_general_symptoms }}</textarea>
					<div id="general_symptoms_feedback" style="color:#b3b3b3"></div>
				</div>
				<div><hr></div>
				
				<div class="form-horizontal row"><!-- form-horizontal row review system -->
					<div class="col-md-12"><!-- field review_hair_skin type tinyInteger -->
						<div class="form-group">
							<label class="control-label col-md-4">Hair and Skin <a class="fa fa-toggle-on icon-toggle-collapse-textarea" target="specified_review_hair_skin_collapse" role="button" data-toggle="tooltip" data-placement="bottom" title="Show/Hide detail."></a> <a role="button" data-toggle="tooltip" data-placement="bottom" title="Click to reset." class="radio-reset" target="review_hair_skin" style="display: none;"><span class="fa fa-remove"></span></a> :</label>
							<div class="col-md-8">
								<label class="radio-inline"><input type="radio" {{ $note->review_hair_skin == 1 ? 'checked' : '' }} name="review_hair_skin" value="1">Normal</label>
								<label class="radio-inline"><input type="radio" {{ $note->review_hair_skin == 2 ? 'checked' : '' }} name="review_hair_skin" value="2">Abnormal</label>
								<label class="radio-inline"><a class="fa fa-list-ul" onclick="$('#specified_review_hair_skin_template_collapse').collapse('toggle');" role="button" data-toggle="tooltip" data-placement="bottom" title="Show/Hide template."></a></label>
							</div>
						</div>
					</div>
					<div class="col-md-12 collapse" id="specified_review_hair_skin_template_collapse">
						@include('medicine.notes.admission.template.review.hair_skin')
					</div>
					<div class="col-md-12 collapse in" id="specified_review_hair_skin_collapse">
						<!-- field specified_review_hair_skin type text -->
						<textarea class="form-control text_area_feedback" name="specified_review_hair_skin" id="specified_review_hair_skin" rows="1" maxlength="1000">{{ $note->specified_review_hair_skin }}</textarea>
						<div id="specified_review_hair_skin_feedback" style="color:#b3b3b3"></div>
					</div>
					<div class="col-md-12"><hr></div>

					<div class="col-md-12"><!-- field review_head type tinyInteger -->
						<div class="form-group">
							<label class="control-label col-md-4">Head <a class="fa fa-toggle-on icon-toggle-collapse-textarea" target="specified_review_head_collapse" role="button" data-toggle="tooltip" data-placement="bottom" title="Show/Hide detail."></a> <a role="button" data-toggle="tooltip" data-placement="bottom" title="Click to reset." class="radio-reset" target="review_head" style="display: none;"><span class="fa fa-remove"></span></a> :</label>
							<div class="col-md-8">
								<label class="radio-inline"><input type="radio" {{ $note->review_head == 1 ? 'checked' : '' }} name="review_head" value="1">Normal</label>
								<label class="radio-inline"><input type="radio" {{ $note->review_head == 2 ? 'checked' : '' }} name="review_head" value="2">Abnormal</label>
								<label class="radio-inline"><a class="fa fa-list-ul" onclick="$('#specified_review_head_template_collapse').collapse('toggle');" role="button" data-toggle="tooltip" data-placement="bottom" title="Show/Hide template."></a></label>
							</div>
						</div>
					</div>
					<div class="col-md-12 collapse" id="specified_review_head_template_collapse">
						@include('medicine.notes.admission.template.review.head')
					</div>
					<div class="col-md-12 collapse in" id="specified_review_head_collapse">
						<!-- field specified_review_head type text -->
						<textarea class="form-control text_area_feedback" name="specified_review_head" id="specified_review_head" rows="1" maxlength="1000">{{ $note->specified_review_head }}</textarea>
						<div id="specified_review_head_feedback" style="color:#b3b3b3"></div>
					</div>
					<div class="col-md-12"><hr></div>

					<div class="col-md-12"><!-- field review_eye_ent type tinyInteger -->
						<div class="form-group">
							<label class="control-label col-md-4">Eye/ENT <a class="fa fa-toggle-on icon-toggle-collapse-textarea" target="specified_review_eye_ent_collapse" role="button" data-toggle="tooltip" data-placement="bottom" title="Show/Hide detail."></a> <a role="button" data-toggle="tooltip" data-placement="bottom" title="Click to reset." class="radio-reset" target="review_eye_ent" style="display: none;"><span class="fa fa-remove"></span></a> :</label>
							<div class="col-md-8">
								<label class="radio-inline"><input type="radio" {{ $note->review_eye_ent == 1 ? 'checked' : '' }} name="review_eye_ent" value="1">Normal</label>
								<label class="radio-inline"><input type="radio" {{ $note->review_eye_ent == 2 ? 'checked' : '' }} name="review_eye_ent" value="2">Abnormal</label>
								<label class="radio-inline"><a class="fa fa-list-ul" onclick="$('#specified_review_eye_ent_template_collapse').collapse('toggle');" role="button" data-toggle="tooltip" data-placement="bottom" title="Show/Hide template."></a></label>
							</div>
						</div>
					</div>
					<div class="col-md-12 collapse" id="specified_review_eye_ent_template_collapse">
						@include('medicine.notes.admission.template.review.eye_ent')
					</div>
					<div class="col-md-12 collapse in" id="specified_review_eye_ent_collapse">
						<!-- field specified_review_eye_ent type text -->
						<textarea class="form-control text_area_feedback" name="specified_review_eye_ent" id="specified_review_eye_ent" rows="1" maxlength="1000">{{ $note->specified_review_eye_ent }}</textarea>
						<div id="specified_review_eye_ent_feedback" style="color:#b3b3b3"></div>
					</div>
					<div class="col-md-12"><hr></div>

					@if (!$note->note->patient->gender)
					<div class="col-md-12"><!-- field review_breast type tinyInteger -->
						<div class="form-group">
							<label class="control-label col-md-4">Breast <a class="fa fa-toggle-on icon-toggle-collapse-textarea" target="specified_review_breast_collapse" role="button" data-toggle="tooltip" data-placement="bottom" title="Show/Hide detail."></a> <a role="button" data-toggle="tooltip" data-placement="bottom" title="Click to reset." class="radio-reset" target="review_breast" style="display: none;"><span class="fa fa-remove"></span></a> :</label>
							<div class="col-md-8">
								<label class="radio-inline"><input type="radio" {{ $note->review_breast == 1 ? 'checked' : '' }} name="review_breast" value="1">Normal</label>
								<label class="radio-inline"><input type="radio" {{ $note->review_breast == 2 ? 'checked' : '' }} name="review_breast" value="2">Abnormal</label>
								<label class="radio-inline"><a class="fa fa-list-ul" onclick="$('#specified_review_breast_template_collapse').collapse('toggle');" role="button" data-toggle="tooltip" data-placement="bottom" title="Show/Hide template."></a></label>
							</div>
						</div>
					</div>
					<div class="col-md-12 collapse" id="specified_review_breast_template_collapse">
						@include('medicine.notes.admission.template.review.breast')
					</div>
					<div class="col-md-12 collapse in" id="specified_review_breast_collapse">
						<!-- field specified_review_breast type text -->
						<textarea class="form-control text_area_feedback" name="specified_review_breast" id="specified_review_breast" rows="1" maxlength="1000">{{ $note->specified_review_breast }}</textarea>
						<div id="specified_review_breast_feedback" style="color:#b3b3b3"></div>
					</div>
					<div class="col-md-12"><hr></div>
					@endif

					<div class="col-md-12"><!-- field review_CVS type tinyInteger -->
						<div class="form-group">
							<label class="control-label col-md-4">CVS <a class="fa fa-toggle-on icon-toggle-collapse-textarea" target="specified_review_CVS_collapse" role="button" data-toggle="tooltip" data-placement="bottom" title="Show/Hide detail."></a> <a role="button" data-toggle="tooltip" data-placement="bottom" title="Click to reset." class="radio-reset" target="review_CVS" style="display: none;"><span class="fa fa-remove"></span></a> :</label>
							<div class="col-md-8">
								<label class="radio-inline"><input type="radio" {{ $note->review_CVS == 1 ? 'checked' : '' }} name="review_CVS" value="1">Normal</label>
								<label class="radio-inline"><input type="radio" {{ $note->review_CVS == 2 ? 'checked' : '' }} name="review_CVS" value="2">Abnormal</label>
								<label class="radio-inline"><a class="fa fa-list-ul" onclick="$('#specified_review_CVS_template_collapse').collapse('toggle');" role="button" data-toggle="tooltip" data-placement="bottom" title="Show/Hide template."></a></label>
							</div>
						</div>
					</div>
					<div class="col-md-12 collapse" id="specified_review_CVS_template_collapse">
						@include('medicine.notes.admission.template.review.cvs')
					</div>
					<div class="col-md-12 collapse in" id="specified_review_CVS_collapse">
						<!-- field specified_review_CVS type text -->
						<textarea class="form-control text_area_feedback" name="specified_review_CVS" id="specified_review_CVS" rows="1" maxlength="1000">{{ $note->specified_review_CVS }}</textarea>
						<div id="specified_review_CVS_feedback" style="color:#b3b3b3"></div>
					</div>
					<div class="col-md-12"><hr></div>

					<div class="col-md-12"><!-- field review_RS type tinyInteger -->
						<div class="form-group">
							<label class="control-label col-md-4">RS <a class="fa fa-toggle-on icon-toggle-collapse-textarea" target="specified_review_RS_collapse" role="button" data-toggle="tooltip" data-placement="bottom" title="Show/Hide detail."></a> <a role="button" data-toggle="tooltip" data-placement="bottom" title="Click to reset." class="radio-reset" target="review_RS" style="display: none;"><span class="fa fa-remove"></span></a> :</label>
							<div class="col-md-8">
								<label class="radio-inline"><input type="radio" {{ $note->review_RS == 1 ? 'checked' : '' }} name="review_RS" value="1">Normal</label>
								<label class="radio-inline"><input type="radio" {{ $note->review_RS == 2 ? 'checked' : '' }} name="review_RS" value="2">Abnormal</label>
								<label class="radio-inline"><a class="fa fa-list-ul" onclick="$('#specified_review_RS_template_collapse').collapse('toggle');" role="button" data-toggle="tooltip" data-placement="bottom" title="Show/Hide template."></a></label>
							</div>
						</div>
					</div>
					<div class="col-md-12 collapse" id="specified_review_RS_template_collapse">
						@include('medicine.notes.admission.template.review.rs')
					</div>
					<div class="col-md-12 collapse in" id="specified_review_RS_collapse">
						<!-- field specified_review_RS type text -->
						<textarea class="form-control text_area_feedback" name="specified_review_RS" id="specified_review_RS" rows="1" maxlength="1000">{{ $note->specified_review_RS }}</textarea>
						<div id="specified_review_RS_feedback" style="color:#b3b3b3"></div>
					</div>
					<div class="col-md-12"><hr></div>

					<div class="col-md-12"><!-- field review_GI type tinyInteger -->
						<div class="form-group">
							<label class="control-label col-md-4">GI <a class="fa fa-toggle-on icon-toggle-collapse-textarea" target="specified_review_GI_collapse" role="button" data-toggle="tooltip" data-placement="bottom" title="Show/Hide detail."></a> <a role="button" data-toggle="tooltip" data-placement="bottom" title="Click to reset." class="radio-reset" target="review_GI" style="display: none;"><span class="fa fa-remove"></span></a> :</label>
							<div class="col-md-8">
								<label class="radio-inline"><input type="radio" {{ $note->review_GI == 1 ? 'checked' : '' }} name="review_GI" value="1">Normal</label>
								<label class="radio-inline"><input type="radio" {{ $note->review_GI == 2 ? 'checked' : '' }} name="review_GI" value="2">Abnormal</label>
								<label class="radio-inline"><a class="fa fa-list-ul" onclick="$('#specified_review_GI_template_collapse').collapse('toggle');" role="button" data-toggle="tooltip" data-placement="bottom" title="Show/Hide template."></a></label>
							</div>
						</div>
					</div>
					<div class="col-md-12 collapse" id="specified_review_GI_template_collapse">
						@include('medicine.notes.admission.template.review.gi')
					</div>
					<div class="col-md-12 collapse in" id="specified_review_GI_collapse">
						<!-- field specified_review_GI type text -->
						<textarea class="form-control text_area_feedback" name="specified_review_GI" id="specified_review_GI" rows="1" maxlength="1000">{{ $note->specified_review_GI }}</textarea>
						<div id="specified_review_GI_feedback" style="color:#b3b3b3"></div>
					</div>
					<div class="col-md-12"><hr></div>

					<div class="col-md-12"><!-- field review_GU type tinyInteger -->
						<div class="form-group">
							<label class="control-label col-md-4">GU <a class="fa fa-toggle-on icon-toggle-collapse-textarea" target="specified_review_GU_collapse" role="button" data-toggle="tooltip" data-placement="bottom" title="Show/Hide detail."></a> <a role="button" data-toggle="tooltip" data-placement="bottom" title="Click to reset." class="radio-reset" target="review_GU" style="display: none;"><span class="fa fa-remove"></span></a> :</label>
							<div class="col-md-8">
								<label class="radio-inline"><input type="radio" {{ $note->review_GU == 1 ? 'checked' : '' }} name="review_GU" value="1">Normal</label>
								<label class="radio-inline"><input type="radio" {{ $note->review_GU == 2 ? 'checked' : '' }} name="review_GU" value="2">Abnormal</label>
								<label class="radio-inline"><a class="fa fa-list-ul" onclick="$('#specified_review_GU_template_collapse').collapse('toggle');" role="button" data-toggle="tooltip" data-placement="bottom" title="Show/Hide template."></a></label>
							</div>
						</div>
					</div>
					<div class="col-md-12 collapse" id="specified_review_GU_template_collapse">
						@include('medicine.notes.admission.template.review.gu')
					</div>
					<div class="col-md-12 collapse in" id="specified_review_GU_collapse">
						<!-- field specified_review_GU type text -->
						<textarea class="form-control text_area_feedback" name="specified_review_GU" id="specified_review_GU" rows="1" maxlength="1000">{{ $note->specified_review_GU }}</textarea>
						<div id="specified_review_GU_feedback" style="color:#b3b3b3"></div>
					</div>
					<div class="col-md-12"><hr></div>

					<div class="col-md-12"><!-- field review_musculoskeletal type tinyInteger -->
						<div class="form-group">
							<label class="control-label col-md-4">Musculoskeletal <a class="fa fa-toggle-on icon-toggle-collapse-textarea" target="specified_review_musculoskeletal_collapse" role="button" data-toggle="tooltip" data-placement="bottom" title="Show/Hide detail."></a> <a role="button" data-toggle="tooltip" data-placement="bottom" title="Click to reset." class="radio-reset" target="review_musculoskeletal" style="display: none;"><span class="fa fa-remove"></span></a> :</label>
							<div class="col-md-8">
								<label class="radio-inline"><input type="radio" {{ $note->review_musculoskeletal == 1 ? 'checked' : '' }} name="review_musculoskeletal" value="1">Normal</label>
								<label class="radio-inline"><input type="radio" {{ $note->review_musculoskeletal == 2 ? 'checked' : '' }} name="review_musculoskeletal" value="2">Abnormal</label>
								<label class="radio-inline"><a class="fa fa-list-ul" onclick="$('#specified_review_musculoskeletal_template_collapse').collapse('toggle');" role="button" data-toggle="tooltip" data-placement="bottom" title="Show/Hide template."></a></label>
							</div>
						</div>
					</div>
					<div class="col-md-12 collapse" id="specified_review_musculoskeletal_template_collapse">
						@include('medicine.notes.admission.template.review.musculoskeletal_system')
					</div>
					<div class="col-md-12 collapse in" id="specified_review_musculoskeletal_collapse">
						<!-- field specified_review_musculoskeletal type text -->
						<textarea class="form-control text_area_feedback" name="specified_review_musculoskeletal" id="specified_review_musculoskeletal" rows="1" maxlength="1000">{{ $note->specified_review_musculoskeletal }}</textarea>
						<div id="specified_review_musculoskeletal_feedback" style="color:#b3b3b3"></div>
					</div>
					<div class="col-md-12"><hr></div>

					<div class="col-md-12"><!-- field review_nervous_system type tinyInteger -->
						<div class="form-group">
							<label class="control-label col-md-4">Nervous system <a class="fa fa-toggle-on icon-toggle-collapse-textarea" target="specified_review_nervous_system_collapse" role="button" data-toggle="tooltip" data-placement="bottom" title="Show/Hide detail."></a> <a role="button" data-toggle="tooltip" data-placement="bottom" title="Click to reset." class="radio-reset" target="review_nervous_system" style="display: none;"><span class="fa fa-remove"></span></a> :</label>
							<div class="col-md-8">
								<label class="radio-inline"><input type="radio" {{ $note->review_nervous_system == 1 ? 'checked' : '' }} name="review_nervous_system" value="1">Normal</label>
								<label class="radio-inline"><input type="radio" {{ $note->review_nervous_system == 2 ? 'checked' : '' }} name="review_nervous_system" value="2">Abnormal</label>
								<label class="radio-inline"><a class="fa fa-list-ul" onclick="$('#specified_review_nervous_system_template_collapse').collapse('toggle');" role="button" data-toggle="tooltip" data-placement="bottom" title="Show/Hide template."></a></label>
							</div>
						</div>
					</div>
					<div class="col-md-12 collapse" id="specified_review_nervous_system_template_collapse">
						@include('medicine.notes.admission.template.review.nervous_system')
					</div>
					<div class="col-md-12 collapse in" id="specified_review_nervous_system_collapse">
						<!-- field specified_review_nervous_system type text -->
						<textarea class="form-control text_area_feedback" name="specified_review_nervous_system" id="specified_review_nervous_system" rows="1" maxlength="1000">{{ $note->specified_review_nervous_system }}</textarea>
						<div id="specified_review_nervous_system_feedback" style="color:#b3b3b3"></div>
					</div>
					<div class="col-md-12"><hr></div>

					<div class="col-md-12"><!-- field review_psychological_symptoms type tinyInteger -->
						<div class="form-group">
							<label class="control-label col-md-4">Psychological symptoms <a class="fa fa-toggle-on icon-toggle-collapse-textarea" target="specified_review_psychological_symptoms_collapse" role="button" data-toggle="tooltip" data-placement="bottom" title="Show/Hide detail."></a> <a role="button" data-toggle="tooltip" data-placement="bottom" title="Click to reset." class="radio-reset" target="review_psychological_symptoms" style="display: none;"><span class="fa fa-remove"></span></a> :</label>
							<div class="col-md-8">
								<label class="radio-inline"><input type="radio" {{ $note->review_psychological_symptoms == 1 ? 'checked' : '' }} name="review_psychological_symptoms" value="1">Normal</label>
								<label class="radio-inline"><input type="radio" {{ $note->review_psychological_symptoms == 2 ? 'checked' : '' }} name="review_psychological_symptoms" value="2">Abnormal</label>
								<label class="radio-inline"><a class="fa fa-list-ul" onclick="$('#specified_review_psychological_symptoms_template_collapse').collapse('toggle');" role="button" data-toggle="tooltip" data-placement="bottom" title="Show/Hide template."></a></label>
							</div>
						</div>
					</div>
					<div class="col-md-12 collapse" id="specified_review_psychological_symptoms_template_collapse">
						@include('medicine.notes.admission.template.review.psychological_symptoms')
					</div>
					<div class="col-md-12 collapse in" id="specified_review_psychological_symptoms_collapse">
						<!-- field specified_review_psychological_symptoms type text -->
						<textarea class="form-control text_area_feedback" name="specified_review_psychological_symptoms" id="specified_review_psychological_symptoms" rows="1" maxlength="1000">{{ $note->specified_review_psychological_symptoms }}</textarea>
						<div id="specified_review_psychological_symptoms_feedback" style="color:#b3b3b3"></div>
					</div>
					<div class="col-md-12"><hr></div>
				</div><!-- end form-horizontal row review system -->
				
				<div class="form-group"><!-- field system_review_other type text -->
					<label class="control-label" for="system_review_other">Other system review :</label>
					<textarea name="system_review_other" id="system_review_other" class="form-control text_area_feedback" rows="1" maxlength="65535">{{ $note->system_review_other }}</textarea>
					<div id="system_review_other_feedback" style="color:#b3b3b3"></div>
				</div>
			</div>
		</div><!-- end of Review of systems -->
	</div>
</div><!-- end of History -->
<div class="panel panel-primary"><!-- Physical examination and investigation panel -->
	<div class="panel-heading">Physical examination and investigation</div> 
	<div class="panel-body">
		<div class="panel panel-info" id="vital_signs_panel">
			<div class="panel-heading">Vital signs</div>
			<div class="panel-body">
				<div class="form-horizontal row">
					<div class="col-md-6"><!-- field temperature_celsius type decimal -->
						<div class="form-group">
							<label class="control-label col-md-6" for="temperature">Temperature :</label>
							<div class="col-md-6">
								<div class="input-group">
									<input class="form-control" type="text" name="temperature_celsius" value="{{ $note->temperature_celsius }}" />
									<span class="input-group-addon">&deg;C</span>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-6"><!-- field pulse type tinyInteger -->
						<div class="form-group">
							<label class="control-label col-md-6" for="pulse">Pulse :</label>
							<div class="col-md-6">
								<div class="input-group">
									<input class="form-control" type="text" name="pulse" value="{{ $note->pulse }}"/>
									<span class="input-group-addon">/min</span>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-12"><!-- field respiratory_rate type tinyInteger -->
						<div class="form-group">
							<label class="control-label col-md-3" for="respiratory_rate">Respiratory rate :</label>
							<div class="col-md-3">
								<div class="input-group">
									<input class="form-control" type="text" name="respiratory_rate" value="{{ $note->respiratory_rate }}"/>
									<span class="input-group-addon">/min</span>
								</div>
							</div>
						</div>
					</div>
					
					{{-- <div class="col-md-12"></div> --}}

					<div class="col-md-6"><!-- field SBP type tinyInteger -->
						<div class="form-group">
							<label class="control-label col-md-6" for="SBP">SBP :</label>
							<div class="col-md-6">
								<div class="input-group">
									<input class="form-control" type="text" name="SBP" value="{{ $note->SBP }}"/>
									<span class="input-group-addon">mmHg</span>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-6"><!-- field DBP type tinyInteger -->
						<div class="form-group">
							<label class="control-label col-md-6" for="DBP">DBP :</label>
							<div class="col-md-6">
								<div class="input-group">
									<input class="form-control" type="text" name="DBP" value="{{ $note->DBP }}"/>
									<span class="input-group-addon">mmHg</span>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-6"><!-- field height_cm type decimal -->
						<div class="form-group">
							<label class="control-label col-md-6" for="height_cm">Height :</label>
							<div class="col-md-6">
								<div class="input-group">
									<input class="form-control bmi-params" type="text" name="height_cm" value="{{ $note->height_cm }}"/>
									<span class="input-group-addon">cm.</span>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-6"><!-- field is_estimated_height type checkbox -->
						<div class="checkbox"><label><input type="checkbox" {{ $note->is_estimated_height ? 'checked' : '' }} name="is_estimated_height">Estimated Height</label></div>
					</div>

					<div class="col-md-12"></div>

					<div class="col-md-6"><!-- field weight_kg type decimal -->
						<div class="form-group">
							<label class="control-label col-md-6" for="weight_kg">Weight :</label>
							<div class="col-md-6">
								<div class="input-group">
									<input class="form-control bmi-params" type="text" name="weight_kg" value="{{ $note->weight_kg }}"/>
									<span class="input-group-addon">kg.</span>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-6"><!-- field is_estimated_weight type checkbox -->
						<div class="checkbox"><label><input type="checkbox" {{ $note->is_estimated_weight ? 'checked' : '' }} name="is_estimated_weight">Estimated Weight</label></div>
					</div>

					<div class="col-md-12"></div>

					<div class="col-md-12"><!-- field BMI type decimal -->
						<div class="form-group">
							<label class="control-label col-md-3" for="BMI">BMI :</label>
							<div class="col-md-3">
								<div class="input-group">
									<span class="input-group-addon" data-toggle="tooltip" data-placement="bottom" title="Auto calculate."><span class="fa fa-calculator"></span></span>
									<input class="form-control" type="text" name="BMI" value="{{ $note->BMI }}" readonly/>
									<span class="input-group-addon">kg/m<sup>2</sup></span>
								</div>
							</div>
						</div>
					</div>

					{{-- <div class="col-md-12"></div> --}}

					<div class="col-md-12"><!-- field SpO2 type decimal -->
						<div class="form-group">
							<label class="control-label col-md-3" for="SpO2">SpO2 :</label>
							<div class="col-md-3">
								<div class="input-group">
									<input class="form-control" type="text" name="SpO2" value="{{ $note->SpO2 }}"/>
									<span class="input-group-addon" data-toggle="tooltip" data-placement="bottom" title="as indicated">%</span>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-12"><!-- field breathing type tinyInteger -->
						<div class="form-group">
							<label class="control-label col-md-3" for="breathing">Breathing <a role="button" data-toggle="tooltip" data-placement="bottom" title="Click to reset." class="radio-reset" target="breathing" style="display: none;"><span class="fa fa-remove"></span></a> :</label>
							<label class="radio-inline"><input type="radio" name="breathing" {{ $note->breathing == '1' ? 'checked' : '' }} value="1">Room air</label>
							<label class="radio-inline"><input type="radio" name="breathing" {{ $note->breathing == '2' ? 'checked' : '' }} value="2">O<sub>2</sub> - Canula</label>
							<label class="radio-inline"><input type="radio" name="breathing" {{ $note->breathing == '3' ? 'checked' : '' }} value="3">O<sub>2</sub> - Mask with bag</label>
							<label class="radio-inline"><input type="radio" name="breathing" {{ $note->breathing == '4' ? 'checked' : '' }} value="4">O<sub>2</sub> - On ventilator</label>
						</div>
					</div>

					<div class="col-md-12 collapse" id="o2_rate_collapse"><!-- field o2_rate type decimal -->
						<div class="form-group">
							<label class="control-label col-md-3" for="o2_rate">O<sub>2</sub> rate :</label>
							<div class="col-md-3">
								<div class="input-group">
									<input class="form-control" type="text" name="o2_rate"/>
									<span class="input-group-addon" id="o2_rate_unit"></span>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-12"><!-- field consciousness_level type tinyInteger -->
						<div class="form-group">
							<label class="control-label col-md-3" for="consciousness_level">Level of consciousness <a role="button" data-toggle="tooltip" data-placement="bottom" title="Click to reset." class="radio-reset" target="consciousness_level" style="display: none;"><span class="fa fa-remove"></span></a> :</label>
							<label class="radio-inline"><input type="radio" name="consciousness_level" {{ $note->consciousness_level == 1 ? 'checked' : '' }}  value="1">Appropriate</label>
							<label class="radio-inline"><input type="radio" name="consciousness_level" {{ $note->consciousness_level == 2 ? 'checked' : '' }}  value="2">Retardation</label>
							<label class="radio-inline"><input type="radio" name="consciousness_level" {{ $note->consciousness_level == 3 ? 'checked' : '' }}  value="3">Depressed</label>
							<label class="radio-inline"><input type="radio" name="consciousness_level" {{ $note->consciousness_level == 4 ? 'checked' : '' }}  value="4">Psychotic</label>
						</div>
					</div>

					<div class="col-md-12"><!-- field GCS type tinyInteger -->
						<input type="hidden" name="GCS">
						<div class="form-group">
							<label class="control-label col-md-3">GCS <a role="button" data-toggle="tooltip" data-placement="bottom" title="Glassglow coma score"><span class="fa fa-info-circle"></span></a> :</label>
							<div class="col-md-5">
								<div class="input-group">
									<span class="input-group-addon" data-toggle="tooltip" data-placement="bottom" title="Auto calculate."><i class="fa fa-calculator"></i></span>
									<input class="form-control" type="text" name="GCS_label" readonly/>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-12"><!-- field GCS_E type tinyInteger -->
						<div class="form-group">
							<label class="control-label col-md-3">GCS - E <a role="button" data-toggle="tooltip" data-placement="bottom" title="Click to reset." class="select-reset" target="GCS_E" style="display: none;"><span class="fa fa-remove"></span></a> :</label>
							<div class="col-md-5" id="GCS_E_select">
								<select class="form-control" name='GCS_E'>
									<option selected disabled hidden value=''></option>
									<option {{ $note->GCS_E == 1 ? 'checked' : '' }} value="1">[1] No eye opening , ไม่ลืมตา </option>
									<option {{ $note->GCS_E == 2 ? 'checked' : '' }} value="2">[2] Eye open to pressure/pain </option>
									<option {{ $note->GCS_E == 3 ? 'checked' : '' }} value="3">[3] Eye open to sound </option>
									<option {{ $note->GCS_E == 4 ? 'checked' : '' }} value="4">[4] Spontaneous eye opening </option>
								</select>
							</div>
						</div>
					</div>

					<div class="col-md-12"><!-- field GCS_V type tinyInteger -->
						<div class="form-group">
							<label class="control-label col-md-3">GCS - V <a role="button" data-toggle="tooltip" data-placement="bottom" title="Click to reset." class="select-reset" target="GCS_V" style="display: none;"><span class="fa fa-remove"></span></a> :</label>
							<div class="col-md-5" id="GCS_V_select">
								<select class="form-control" name='GCS_V'>
									<option selected disabled hidden value=''></option>
									<option {{ $note->GCS_V == 1 ? 'checked' : '' }} value="1">[1] Not response to pain, ไม่ส่งเสียง </option>
									<option {{ $note->GCS_V == 2 ? 'checked' : '' }} value="2">[2] Incomprehensible sounds ส่งเสียงไม่เป็นคำ </option>
									<option {{ $note->GCS_V == 3 ? 'checked' : '' }} value="3">[3] Inappropriate words พูดคำไม่มีความหมาย </option>
									<option {{ $note->GCS_V == 4 ? 'checked' : '' }} value="4">[4] Disoriented / confused สับสน </option>
									<option {{ $note->GCS_V == 5 ? 'checked' : '' }} value="5">[5] Oriented พูดรู้เรื่อง </option>
								</select>
							</div>
						</div>
					</div>

					<div class="col-md-12"><!-- field GCS_M type tinyInteger -->
						<div class="form-group">
							<label class="control-label col-md-3">GCS - M <a role="button" data-toggle="tooltip" data-placement="bottom" title="Click to reset." class="select-reset" target="GCS_M" style="display: none;"><span class="fa fa-remove"></span></a> :</label>
							<div class="col-md-5" id="GCS_M_select">
								<select class="form-control" name='GCS_M'>
									<option selected disabled hidden value=''></option>
									<option {{ $note->GCS_M == 1 ? 'checked' : '' }} value="1">[1] Not response to pain, ไม่เคลื่อนไหว </option>
									<option {{ $note->GCS_M == 2 ? 'checked' : '' }} value="2">[2] Decerebrates</option>
									<option {{ $note->GCS_M == 3 ? 'checked' : '' }} value="3">[3] Decorticates</option>
									<option {{ $note->GCS_M == 4 ? 'checked' : '' }} value="4">[4] Semi-purposeful ตอบสนองต่อ pain ระบุตำแหน่งไม่ได้</option>
									<option {{ $note->GCS_M == 5 ? 'checked' : '' }} value="5">[5] Localizes pain ตอบสนองต่อ pain ระบุตำแหน่งได้</option>
									<option {{ $note->GCS_M == 6 ? 'checked' : '' }} value="6">[6] Obey ทำตามสั่งได้</option>
								</select>
							</div>
						</div>
					</div>
					
					<div class="col-md-12"><!-- field mental_evaluate type tinyInteger -->
						<div class="form-group">
							<label class="control-label col-md-3" for="mental_evaluate">Mental evaluation <a role="button" data-toggle="tooltip" data-placement="bottom" title="Click to reset." class="radio-reset" target="mental_evaluate" style="display: none;"><span class="fa fa-remove"></span></a> :</label>
							<label class="radio-inline"><input type="radio" name="mental_evaluate" {{ $note->mental_evaluate == '1' ? 'checked' : '' }} value="1">Awake</label>
							<label class="radio-inline"><input type="radio" name="mental_evaluate" {{ $note->mental_evaluate == '2' ? 'checked' : '' }} value="2">Drowsy</label>
							<label class="radio-inline"><input type="radio" name="mental_evaluate" {{ $note->mental_evaluate == '3' ? 'checked' : '' }} value="3">Stuporous</label>
							<label class="radio-inline"><input type="radio" name="mental_evaluate" {{ $note->mental_evaluate == '4' ? 'checked' : '' }} value="4">Unconscious</label>
						</div>
					</div>

					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label col-md-3">Mental orientation :</label>
							<div class="col-md-9">
								<!-- field mental_orientation_time type checkbox -->
								<div class="checkbox col-md-2"><label><input type="checkbox" {{ $note->mental_orientation_time ? 'checked' : '' }} name="mental_orientation_time">to Time</label></div>
								<!-- field mental_orientation_place type checkbox -->
								<div class="checkbox col-md-2"><label><input type="checkbox" {{ $note->mental_orientation_place ? 'checked' : '' }} name="mental_orientation_place">to Place</label></div>
								<!-- field mental_orientation_person type checkbox -->
								<div class="checkbox col-md-2"><label><input type="checkbox" {{ $note->mental_orientation_person ? 'checked' : '' }} name="mental_orientation_person">to Person</label></div>
							</div>
						</div>
					</div>

				</div><!-- end of vital sign form -->
			</div><!-- end of vital signs panel body -->
		</div><!-- end of Vital signs panel -->
	
		<div class="panel panel-info" id="physical_exams_panel">
			<div class="panel-heading">Physical examinations</div> 
			<div class="panel-body">
				<label class="control-label text-left" for="general_appearance">General appearance <a class="fa fa-toggle-on icon-toggle-collapse-textarea" target="general_appearance_collapse" role="button" data-toggle="tooltip" data-placement="bottom" title="Show/Hide detail."></a> : <span class="fa fa-ellipsis-h"></span> <a class="fa fa-list-ul" onclick="$('#general_appearance_template_collapse').collapse('toggle');" role="button" data-toggle="tooltip" data-placement="bottom" title="Show/Hide template."></a></label>
				<div class="collapse" id="general_appearance_template_collapse">
					@include('medicine.notes.admission.template.exam.general_appearance')
				</div>
				<!-- field general_appearance type text -->
				<div class="collapse in" id="general_appearance_collapse">
					<textarea class="form-control text_area_feedback" name="general_appearance" id="general_appearance" rows="1" maxlength="1000" placeholder="Specify important findings.">{{ $note->general_appearance }}</textarea>
					<div id="general_appearance_feedback" style="color:#b3b3b3"></div>
				</div>
				<div><hr></div>
				
				<div class="form-horizontal row"><!-- form-horizontal physical-exam -->
					<div class="col-md-12"><!-- field physical_exam_skin type tinyInteger -->
						<div class="form-group">
							<label class="control-label col-md-4">Skin <a class="fa fa-toggle-on icon-toggle-collapse-textarea" target="specified_physical_exam_skin_collapse" role="button" data-toggle="tooltip" data-placement="bottom" title="Show/Hide detail."></a> <a role="button" data-toggle="tooltip" data-placement="bottom" title="Click to reset." class="radio-reset" target="physical_exam_skin" style="display: none;"><span class="fa fa-remove"></span></a> :</label>
							<div class="col-md-8">
								<label class="radio-inline"><input type="radio" {{ $note->physical_exam_skin == 1 ? 'checked' : '' }} name="physical_exam_skin" value="1">Normal</label>
								<label class="radio-inline"><input type="radio" {{ $note->physical_exam_skin == 2 ? 'checked' : '' }} name="physical_exam_skin" value="2">Abnormal</label>
								<label class="radio-inline"><a class="fa fa-list-ul" onclick="$('#specified_physical_exam_skin_template_collapse').collapse('toggle');" role="button" data-toggle="tooltip" data-placement="bottom" title="Show/Hide template."></a></label>
								<label class="radio-inline"><a class="fa fa-paint-brush" onclick="$('#specified_physical_exam_skin_drawing_modal').modal('show');" role="button" data-toggle="tooltip" data-placement="bottom" title="Add drawing."></a></label>
							</div>
						</div>
					</div>
					<div class="col-md-12 collapse" id="specified_physical_exam_skin_template_collapse">
						@include('medicine.notes.admission.template.exam.skin')
					</div>
					<div class="col-md-12 collapse" id="specified_physical_exam_skin_drawing_collapse">
					</div>
					<div class="col-md-12 collapse in" id="specified_physical_exam_skin_collapse">
						<!-- field specified_physical_exam_skin type text -->
						<textarea class="form-control text_area_feedback" name="specified_physical_exam_skin" id="specified_physical_exam_skin" rows="1" maxlength="1000">{{ $note->specified_physical_exam_skin }}</textarea>
						<div id="specified_physical_exam_skin_feedback" style="color:#b3b3b3"></div>
					</div>
					<div class="col-md-12"><hr></div>

					<div class="col-md-12"><!-- field physical_exam_head type tinyInteger -->
						<div class="form-group">
							<label class="control-label col-md-4">Head <a class="fa fa-toggle-on icon-toggle-collapse-textarea" target="specified_physical_exam_head_collapse" role="button" data-toggle="tooltip" data-placement="bottom" title="Show/Hide detail."></a> <a role="button" data-toggle="tooltip" data-placement="bottom" title="Click to reset." class="radio-reset" target="physical_exam_head" style="display: none;"><span class="fa fa-remove"></span></a> :</label>
							<div class="col-md-8">
								<label class="radio-inline"><input type="radio" {{ $note->physical_exam_head == 1 ? 'checked' : '' }} name="physical_exam_head" value="1">Normal</label>
								<label class="radio-inline"><input type="radio" {{ $note->physical_exam_head == 2 ? 'checked' : '' }} name="physical_exam_head" value="2">Abnormal</label>
								<label class="radio-inline"><a class="fa fa-list-ul" onclick="$('#specified_physical_exam_head_template_collapse').collapse('toggle');" role="button" data-toggle="tooltip" data-placement="bottom" title="Show/Hide template."></a></label>
								<label class="radio-inline"><a class="fa fa-paint-brush" onclick="$('#specified_physical_exam_head_drawing_collapse').collapse('toggle');" role="button" data-toggle="tooltip" data-placement="bottom" title="Add drawing."></a></label>
							</div>
						</div>
					</div>
					<div class="col-md-12 collapse" id="specified_physical_exam_head_template_collapse">
						@include('medicine.notes.admission.template.exam.head')
					</div>
					<div class="col-md-12 collapse" id="specified_physical_exam_head_drawing_collapse">
						<div class="col-md-4"><a href="/drawing/med-head_left/edit"><img class="img-responsive img-thumbnail" src="/assets/images/drawings/medicine/head_left.png" alt="wordplease" width="250" height="250"></a></div>
						<div class="col-md-4"><a href="/drawing/med-head_right/edit"><img class="img-responsive img-thumbnail" src="/assets/images/drawings/medicine/head_right.png" alt="wordplease" width="250" height="250"></a></div>
					</div>
					<div class="col-md-12 collapse in" id="specified_physical_exam_head_collapse">
						<!-- field specified_physical_exam_head type text -->
						<textarea class="form-control text_area_feedback" name="specified_physical_exam_head" id="specified_physical_exam_head" rows="1" maxlength="1000">{{ $note->specified_physical_exam_head }}</textarea>
						<div id="specified_physical_exam_head_feedback" style="color:#b3b3b3"></div>
					</div>
					<div class="col-md-12"><hr></div>

					<div class="col-md-12"><!-- field physical_exam_eye_ent type tinyInteger -->
						<div class="form-group">
							<label class="control-label col-md-4">Eye/ENT <a class="fa fa-toggle-on icon-toggle-collapse-textarea" target="specified_physical_exam_eye_ent_collapse" role="button" data-toggle="tooltip" data-placement="bottom" title="Show/Hide detail."></a> <a role="button" data-toggle="tooltip" data-placement="bottom" title="Click to reset." class="radio-reset" target="physical_exam_eye_ent" style="display: none;"><span class="fa fa-remove"></span></a> :</label>
							<div class="col-md-8">
								<label class="radio-inline"><input type="radio" {{ $note->physical_exam_eye_ent == 1 ? 'checked' : '' }} name="physical_exam_eye_ent" value="1">Normal</label>
								<label class="radio-inline"><input type="radio" {{ $note->physical_exam_eye_ent == 2 ? 'checked' : '' }} name="physical_exam_eye_ent" value="2">Abnormal</label>
								<label class="radio-inline"><a class="fa fa-list-ul" onclick="$('#specified_physical_exam_eye_ent_template_collapse').collapse('toggle');" role="button" data-toggle="tooltip" data-placement="bottom" title="Show/Hide template."></a></label>
								<label class="radio-inline"><a class="fa fa-paint-brush" onclick="$('#specified_physical_exam_eye_ent_drawing_collapse').collapse('toggle');" role="button" data-toggle="tooltip" data-placement="bottom" title="Add drawing."></a></label>
							</div>
						</div>
					</div>
					<div class="col-md-12 collapse" id="specified_physical_exam_eye_ent_template_collapse">
						@include('medicine.notes.admission.template.exam.eye_ent')
					</div>
					<div class="col-md-12 collapse" id="specified_physical_exam_eye_ent_drawing_collapse">
						<div class="col-md-4"><a href="/drawing/med-ears/edit"><img class="img-responsive img-thumbnail" src="/assets/images/drawings/medicine/ears.png" alt="wordplease" width="250" height="250"></a></div>
						<div class="col-md-4"><a href="/drawing/med-ear_left/edit"><img class="img-responsive img-thumbnail" src="/assets/images/drawings/medicine/ear_left.png" alt="wordplease" width="250" height="250"></a></div>
						<div class="col-md-4"><a href="/drawing/med-ear_right/edit"><img class="img-responsive img-thumbnail" src="/assets/images/drawings/medicine/ear_right.png" alt="wordplease" width="250" height="250"></a></div>
						<div class="col-md-4"><a href="/drawing/med-fundi/edit"><img class="img-responsive img-thumbnail" src="/assets/images/drawings/medicine/fundi.png" alt="wordplease" width="250" height="250"></a></div>
						<div class="col-md-4"><a href="/drawing/med-eyes/edit"><img class="img-responsive img-thumbnail" src="/assets/images/drawings/medicine/eyes.png" alt="wordplease" width="250" height="250"></a></div>
						<div class="col-md-4"><a href="/drawing/med-nose/edit"><img class="img-responsive img-thumbnail" src="/assets/images/drawings/medicine/nose.png" alt="wordplease" width="250" height="250"></a></div>
					</div>
					<div class="col-md-12 collapse in" id="specified_physical_exam_eye_ent_collapse">
						<!-- field specified_physical_exam_eye_ent type text -->
						<textarea class="form-control text_area_feedback" name="specified_physical_exam_eye_ent" id="specified_physical_exam_eye_ent" rows="1" maxlength="1000">{{ $note->specified_physical_exam_eye_ent }}</textarea>
						<div id="specified_physical_exam_eye_ent_feedback" style="color:#b3b3b3"></div>
					</div>
					<div class="col-md-12"><hr></div>

					<div class="col-md-12"><!-- field physical_exam_neck type tinyInteger -->
						<div class="form-group">
							<label class="control-label col-md-4">Neck <a class="fa fa-toggle-on icon-toggle-collapse-textarea" target="specified_physical_exam_neck_collapse" role="button" data-toggle="tooltip" data-placement="bottom" title="Show/Hide detail."></a> <a role="button" data-toggle="tooltip" data-placement="bottom" title="Click to reset." class="radio-reset" target="physical_exam_neck" style="display: none;"><span class="fa fa-remove"></span></a> :</label>
							<div class="col-md-8">
								<label class="radio-inline"><input type="radio" {{ $note->physical_exam_neck == 1 ? 'checked' : '' }} name="physical_exam_neck" value="1">Normal</label>
								<label class="radio-inline"><input type="radio" {{ $note->physical_exam_neck == 2 ? 'checked' : '' }} name="physical_exam_neck" value="2">Abnormal</label>
								<label class="radio-inline"><a class="fa fa-list-ul" onclick="$('#specified_physical_exam_neck_template_collapse').collapse('toggle');" role="button" data-toggle="tooltip" data-placement="bottom" title="Show/Hide template."></a></label>
							</div>
						</div>
					</div>
					<div class="col-md-12 collapse" id="specified_physical_exam_neck_template_collapse">
						@include('medicine.notes.admission.template.exam.neck')
					</div>
					<div class="col-md-12 collapse in" id="specified_physical_exam_neck_collapse">
						<!-- field specified_physical_exam_neck type text -->
						<textarea class="form-control text_area_feedback" name="specified_physical_exam_neck" id="specified_physical_exam_neck" rows="1" maxlength="1000">{{ $note->specified_physical_exam_neck }}</textarea>
						<div id="specified_physical_exam_neck_feedback" style="color:#b3b3b3"></div>
					</div>
					<div class="col-md-12"><hr></div>

					<div class="col-md-12"><!-- field physical_exam_heart type tinyInteger -->
						<div class="form-group">
							<label class="control-label col-md-4">Heart <a class="fa fa-toggle-on icon-toggle-collapse-textarea" target="specified_physical_exam_heart_collapse" role="button" data-toggle="tooltip" data-placement="bottom" title="Show/Hide detail."></a> <a role="button" data-toggle="tooltip" data-placement="bottom" title="Click to reset." class="radio-reset" target="physical_exam_heart" style="display: none;"><span class="fa fa-remove"></span></a> :</label>
							<div class="col-md-8">
								<label class="radio-inline"><input type="radio" {{ $note->physical_exam_heart == 1 ? 'checked' : '' }} name="physical_exam_heart" value="1">Normal</label>
								<label class="radio-inline"><input type="radio" {{ $note->physical_exam_heart == 2 ? 'checked' : '' }} name="physical_exam_heart" value="2">Abnormal</label>
								<label class="radio-inline"><a class="fa fa-list-ul" onclick="$('#specified_physical_exam_heart_template_collapse').collapse('toggle');" role="button" data-toggle="tooltip" data-placement="bottom" title="Show/Hide template."></a></label>
							</div>
						</div>
					</div>
					<div class="col-md-12 collapse" id="specified_physical_exam_heart_template_collapse">
						@include('medicine.notes.admission.template.exam.heart')
					</div>
					<div class="col-md-12 collapse in" id="specified_physical_exam_heart_collapse">
						<!-- field specified_physical_exam_heart type text -->
						<textarea class="form-control text_area_feedback" name="specified_physical_exam_heart" id="specified_physical_exam_heart" rows="1" maxlength="1000">{{ $note->specified_physical_exam_heart }}</textarea>
						<div id="specified_physical_exam_heart_feedback" style="color:#b3b3b3"></div>
					</div>
					<div class="col-md-12"><hr></div>

					<div class="col-md-12"><!-- field physical_exam_lung type tinyInteger -->
						<div class="form-group">
							<label class="control-label col-md-4">Lung <a class="fa fa-toggle-on icon-toggle-collapse-textarea" target="specified_physical_exam_lung_collapse" role="button" data-toggle="tooltip" data-placement="bottom" title="Show/Hide detail."></a> <a role="button" data-toggle="tooltip" data-placement="bottom" title="Click to reset." class="radio-reset" target="physical_exam_lung" style="display: none;"><span class="fa fa-remove"></span></a> :</label>
							<div class="col-md-8">
								<label class="radio-inline"><input type="radio" {{ $note->physical_exam_lung == 1 ? 'checked' : '' }} name="physical_exam_lung" value="1">Normal</label>
								<label class="radio-inline"><input type="radio" {{ $note->physical_exam_lung == 2 ? 'checked' : '' }} name="physical_exam_lung" value="2">Abnormal</label>
								<label class="radio-inline"><a class="fa fa-list-ul" onclick="$('#specified_physical_exam_lung_template_collapse').collapse('toggle');" role="button" data-toggle="tooltip" data-placement="bottom" title="Show/Hide template."></a></label>
							</div>
						</div>
					</div>
					<div class="col-md-12 collapse" id="specified_physical_exam_lung_template_collapse">
						@include('medicine.notes.admission.template.exam.lung')
					</div>
					<div class="col-md-12 collapse in" id="specified_physical_exam_lung_collapse">
						<!-- field specified_physical_exam_lung type text -->
						<textarea class="form-control text_area_feedback" name="specified_physical_exam_lung" id="specified_physical_exam_lung" rows="1" maxlength="1000">{{ $note->specified_physical_exam_lung }}</textarea>
						<div id="specified_physical_exam_lung_feedback" style="color:#b3b3b3"></div>
					</div>
					<div class="col-md-12"><hr></div>

					<div class="col-md-12"><!-- field physical_exam_abdomen type tinyInteger -->
						<div class="form-group">
							<label class="control-label col-md-4">Abdomen <a class="fa fa-toggle-on icon-toggle-collapse-textarea" target="specified_physical_exam_abdomen_collapse" role="button" data-toggle="tooltip" data-placement="bottom" title="Show/Hide detail."></a> <a role="button" data-toggle="tooltip" data-placement="bottom" title="Click to reset." class="radio-reset" target="physical_exam_abdomen" style="display: none;"><span class="fa fa-remove"></span></a> :</label>
							<div class="col-md-8">
								<label class="radio-inline"><input type="radio" {{ $note->physical_exam_abdomen == 1 ? 'checked' : '' }} name="physical_exam_abdomen" value="1">Normal</label>
								<label class="radio-inline"><input type="radio" {{ $note->physical_exam_abdomen == 2 ? 'checked' : '' }} name="physical_exam_abdomen" value="2">Abnormal</label>
								<label class="radio-inline"><a class="fa fa-list-ul" onclick="$('#specified_physical_exam_abdomen_template_collapse').collapse('toggle');" role="button" data-toggle="tooltip" data-placement="bottom" title="Show/Hide template."></a></label>
								<label class="radio-inline"><a class="fa fa-paint-brush create-canvas" target="specified_physical_exam_abdomen_drawing_collapse" drawingsNo="1" drawing="abdomen" role="button" data-toggle="tooltip" data-placement="bottom" title="Add drawing."></a></label>
							</div>
						</div>
					</div>
					<div class="col-md-12 collapse" id="specified_physical_exam_abdomen_template_collapse">
						@include('medicine.notes.admission.template.exam.abdomen')
					</div>
					<div class="col-md-12 collapse" id="specified_physical_exam_abdomen_drawing_collapse">
					</div>
					<div class="col-md-12 collapse in" id="specified_physical_exam_abdomen_collapse">
						<!-- field specified_physical_exam_abdomen type text -->
						<textarea class="form-control text_area_feedback" name="specified_physical_exam_abdomen" id="specified_physical_exam_abdomen" rows="1" maxlength="1000">{{ $note->specified_physical_exam_abdomen }}</textarea>
						<div id="specified_physical_exam_abdomen_feedback" style="color:#b3b3b3"></div>
					</div>
					<div class="col-md-12"><hr></div>

					<div class="col-md-12"><!-- field physical_exam_nervous_system type tinyInteger -->
						<div class="form-group">
							<label class="control-label col-md-4">Nervous system <a class="fa fa-toggle-on icon-toggle-collapse-textarea" target="specified_physical_exam_nervous_system_collapse" role="button" data-toggle="tooltip" data-placement="bottom" title="Show/Hide detail."></a> <a role="button" data-toggle="tooltip" data-placement="bottom" title="Click to reset." class="radio-reset" target="physical_exam_nervous_system" style="display: none;"><span class="fa fa-remove"></span></a> :</label>
							<div class="col-md-8">
								<label class="radio-inline"><input type="radio" {{ $note->physical_exam_nervous_system == 1 ? 'checked' : '' }} name="physical_exam_nervous_system" value="1">Normal</label>
								<label class="radio-inline"><input type="radio" {{ $note->physical_exam_nervous_system == 2 ? 'checked' : '' }} name="physical_exam_nervous_system" value="2">Abnormal</label>
								<label class="radio-inline"><a class="fa fa-list-ul" onclick="$('#specified_physical_exam_nervous_system_template_collapse').collapse('toggle');" role="button" data-toggle="tooltip" data-placement="bottom" title="Show/Hide template."></a></label>
								<label class="radio-inline"><a class="fa fa-paint-brush" onclick="$('#specified_physical_exam_nervous_system_drawing_modal').modal('show');" role="button" data-toggle="tooltip" data-placement="bottom" title="Add drawing."></a></label>
							</div>
						</div>
					</div>
					<div class="col-md-12 collapse" id="specified_physical_exam_nervous_system_template_collapse">
						@include('medicine.notes.admission.template.exam.nervous_system')
					</div>
					<div class="col-md-12 collapse" id="specified_physical_exam_nervous_system_drawing_collapse">
					{{-- <input type="text" value="50" id="btn1" style="position:absolute; width: 20px; z-index: 1; display: none;"> --}}
					</div>
					<div class="col-md-12 collapse in" id="specified_physical_exam_nervous_system_collapse">
						<!-- field specified_physical_exam_nervous_system type text -->
						<textarea class="form-control text_area_feedback" name="specified_physical_exam_nervous_system" id="specified_physical_exam_nervous_system" rows="1" maxlength="1000">{{ $note->specified_physical_exam_nervous_system }}</textarea>
						<div id="specified_physical_exam_nervous_system_feedback" style="color:#b3b3b3"></div>
					</div>
					<div class="col-md-12"><hr></div>

					<div class="col-md-12"><!-- field physical_exam_extremities type tinyInteger -->
						<div class="form-group">
							<label class="control-label col-md-4">Extremities <a class="fa fa-toggle-on icon-toggle-collapse-textarea" target="specified_physical_exam_extremities_collapse" role="button" data-toggle="tooltip" data-placement="bottom" title="Show/Hide detail."></a> <a role="button" data-toggle="tooltip" data-placement="bottom" title="Click to reset." class="radio-reset" target="physical_exam_extremities" style="display: none;"><span class="fa fa-remove"></span></a> :</label>
							<div class="col-md-8">
								<label class="radio-inline"><input type="radio" {{ $note->physical_exam_extremities == 1 ? 'checked' : '' }} name="physical_exam_extremities" value="1">Normal</label>
								<label class="radio-inline"><input type="radio" {{ $note->physical_exam_extremities == 2 ? 'checked' : '' }} name="physical_exam_extremities" value="2">Abnormal</label>
								<label class="radio-inline"><a class="fa fa-list-ul" onclick="$('#specified_physical_exam_extremities_template_collapse').collapse('toggle');" role="button" data-toggle="tooltip" data-placement="bottom" title="Show/Hide template."></a></label>
								<label class="radio-inline"><a class="fa fa-paint-brush" onclick="$('#specified_physical_exam_extremities_drawing_modal').modal('show');" role="button" data-toggle="tooltip" data-placement="bottom" title="Add drawing."></a></label>
							</div>
						</div>
					</div>
					<div class="col-md-12 collapse" id="specified_physical_exam_extremities_template_collapse">
						<h1>hello</h1>
					</div>
					<div class="col-md-12 collapse" id="specified_physical_exam_extremities_drawing_collapse">
					</div>
					<div class="col-md-12 collapse in" id="specified_physical_exam_extremities_collapse">
						<!-- field specified_physical_exam_extremities type text -->
						<textarea class="form-control text_area_feedback" name="specified_physical_exam_extremities" id="specified_physical_exam_extremities" rows="1" maxlength="1000">{{ $note->specified_physical_exam_extremities }}</textarea>
						<div id="specified_physical_exam_extremities_feedback" style="color:#b3b3b3"></div>
					</div>
					<div class="col-md-12"><hr></div>

					<div class="col-md-12"><!-- field physical_exam_lymph_nodes type tinyInteger -->
						<div class="form-group">
							<label class="control-label col-md-4">Lymph nodes <a class="fa fa-toggle-on icon-toggle-collapse-textarea" target="specified_physical_exam_lymph_nodes_collapse" role="button" data-toggle="tooltip" data-placement="bottom" title="Show/Hide detail."></a> <a role="button" data-toggle="tooltip" data-placement="bottom" title="Click to reset." class="radio-reset" target="physical_exam_lymph_nodes" style="display: none;"><span class="fa fa-remove"></span></a> :</label>
							<div class="col-md-8">
								<label class="radio-inline"><input type="radio" {{ $note->physical_exam_lymph_nodes == 1 ? 'checked' : '' }} name="physical_exam_lymph_nodes" value="1">Normal</label>
								<label class="radio-inline"><input type="radio" {{ $note->physical_exam_lymph_nodes == 2 ? 'checked' : '' }} name="physical_exam_lymph_nodes" value="2">Abnormal</label>
								<label class="radio-inline"><a class="fa fa-list-ul" onclick="$('#specified_physical_exam_lymph_nodes_template_collapse').collapse('toggle');" role="button" data-toggle="tooltip" data-placement="bottom" title="Show/Hide template."></a></label>
								<label class="radio-inline"><a class="fa fa-paint-brush" onclick="$('#specified_physical_exam_lymph_nodes_drawing_collapse').collapse('toggle');" role="button" data-toggle="tooltip" data-placement="bottom" title="Add drawing."></a></label>
							</div>
						</div>
					</div>
					<div class="col-md-12 collapse" id="specified_physical_exam_lymph_nodes_template_collapse">
						@include('medicine.notes.admission.template.exam.lymh_nodes')
					</div>
					<div class="col-md-12 collapse" id="specified_physical_exam_lymph_nodes_drawing_collapse">
						<div class="col-md-4"><a href="/drawing/med-cervical_left/edit"><img class="img-responsive img-thumbnail" src="/assets/images/drawings/medicine/cervical_left.png" alt="wordplease" width="250" height="250"></a></div>
						<div class="col-md-4"><a href="/drawing/med-cervical_right/edit"><img class="img-responsive img-thumbnail" src="/assets/images/drawings/medicine/cervical_right.png" alt="wordplease" width="250" height="250"></a></div>
						<div class="col-md-4"><a href="/drawing/med-cervical_left_label/edit"><img class="img-responsive img-thumbnail" src="/assets/images/drawings/medicine/cervical_left_label.png" alt="wordplease" width="250" height="250"></a></div>
						<div class="col-md-4"><a href="/drawing/med-cervical_right_label/edit"><img class="img-responsive img-thumbnail" src="/assets/images/drawings/medicine/cervical_right_label.png" alt="wordplease" width="250" height="250"></a></div>
					</div>
					<div class="col-md-12 collapse in" id="specified_physical_exam_lymph_nodes_collapse">
						<!-- field specified_physical_exam_lymph_nodes type text -->
						<textarea class="form-control text_area_feedback" name="specified_physical_exam_lymph_nodes" id="specified_physical_exam_lymph_nodes" rows="1" maxlength="1000">{{ $note->specified_physical_exam_lymph_nodes }}</textarea>
						<div id="specified_physical_exam_lymph_nodes_feedback" style="color:#b3b3b3"></div>
					</div>
					<div class="col-md-12"><hr></div>
					
					@if (!$note->note->patient->gender)
					<div class="col-md-12"><!-- field physical_exam_breasts type tinyInteger -->
						<div class="form-group">
							<label class="control-label col-md-4">Breasts <a class="fa fa-toggle-on icon-toggle-collapse-textarea" target="specified_physical_exam_breasts_collapse" role="button" data-toggle="tooltip" data-placement="bottom" title="Show/Hide detail."></a> <a role="button" data-toggle="tooltip" data-placement="bottom" title="Click to reset." class="radio-reset" target="physical_exam_breasts" style="display: none;"><span class="fa fa-remove"></span></a> :</label>
							<div class="col-md-8">
								<label class="radio-inline"><input type="radio" {{ $note->physical_exam_breasts == 1 ? 'checked' : '' }} name="physical_exam_breasts" value="1">Normal</label>
								<label class="radio-inline"><input type="radio" {{ $note->physical_exam_breasts == 2 ? 'checked' : '' }} name="physical_exam_breasts" value="2">Abnormal</label>
								<label class="radio-inline"><a class="fa fa-list-ul" onclick="$('#specified_physical_exam_breasts_template_collapse').collapse('toggle');" role="button" data-toggle="tooltip" data-placement="bottom" title="Show/Hide template."></a></label>
								<label class="radio-inline"><a class="fa fa-paint-brush create-canvas" drawingsNo="1" drawing="breasts" target="specified_physical_exam_breasts_drawing_collapse" role="button" data-toggle="tooltip" data-placement="bottom" title="Add drawing."></a></label>
							</div>
						</div>
					</div>
					<div class="col-md-12 collapse" id="specified_physical_exam_breasts_template_collapse">
						@include('medicine.notes.admission.template.exam.breast')
					</div>
					<div class="col-md-12 collapse" id="specified_physical_exam_breasts_drawing_collapse">
					</div>
					<div class="col-md-12 collapse in" id="specified_physical_exam_breasts_collapse">
						<!-- field specified_physical_exam_breasts type text -->
						<textarea class="form-control text_area_feedback" name="specified_physical_exam_breasts" id="specified_physical_exam_breasts" rows="1" maxlength="1000">{{ $note->specified_physical_exam_breasts }}</textarea>
						<div id="specified_physical_exam_breasts_feedback" style="color:#b3b3b3"></div>
					</div>
					<div class="col-md-12"><hr></div>
					@endif

					<div class="col-md-12"><!-- field physical_exam_genitalia type tinyInteger -->
						<div class="form-group">
							<label class="control-label col-md-4">Genitalia <a class="fa fa-toggle-on icon-toggle-collapse-textarea" target="specified_physical_exam_genitalia_collapse" role="button" data-toggle="tooltip" data-placement="bottom" title="Show/Hide detail."></a> <a role="button" data-toggle="tooltip" data-placement="bottom" title="Click to reset." class="radio-reset" target="physical_exam_genitalia" style="display: none;"><span class="fa fa-remove"></span></a> :</label>
							<div class="col-md-8">
								<label class="radio-inline"><input type="radio" {{ $note->physical_exam_genitalia == 1 ? 'checked' : '' }} name="physical_exam_genitalia" value="1">Normal</label>
								<label class="radio-inline"><input type="radio" {{ $note->physical_exam_genitalia == 2 ? 'checked' : '' }} name="physical_exam_genitalia" value="2">Abnormal</label>
								<label class="radio-inline"><a class="fa fa-list-ul" onclick="$('#specified_physical_exam_genitalia_template_collapse').collapse('toggle');" role="button" data-toggle="tooltip" data-placement="bottom" title="Show/Hide template."></a></label>
							</div>
						</div>
					</div>
					<div class="col-md-12 collapse" id="specified_physical_exam_genitalia_template_collapse">
						<h1>hello</h1>
					</div>
					<div class="col-md-12 collapse in" id="specified_physical_exam_genitalia_collapse">
						<!-- field specified_physical_exam_genitalia type text -->
						<textarea class="form-control text_area_feedback" name="specified_physical_exam_genitalia" id="specified_physical_exam_genitalia" rows="1" maxlength="1000">{{ $note->specified_physical_exam_genitalia }}</textarea>
						<div id="specified_physical_exam_genitalia_feedback" style="color:#b3b3b3"></div>
					</div>
					<div class="col-md-12"><hr></div>

					<div class="col-md-12"><!-- field physical_exam_rectal type tinyInteger -->
						<div class="form-group">
							<label class="control-label col-md-4">Rectal examination <a class="fa fa-toggle-on icon-toggle-collapse-textarea" target="specified_physical_exam_rectal_collapse" role="button" data-toggle="tooltip" data-placement="bottom" title="Show/Hide detail."></a> <a role="button" data-toggle="tooltip" data-placement="bottom" title="Click to reset." class="radio-reset" target="physical_exam_rectal" style="display: none;"><span class="fa fa-remove"></span></a> :</label>
							<div class="col-md-8">
								<label class="radio-inline"><input type="radio" {{ $note->physical_exam_rectal == 1 ? 'checked' : '' }} name="physical_exam_rectal" value="1">Normal</label>
								<label class="radio-inline"><input type="radio" {{ $note->physical_exam_rectal == 2 ? 'checked' : '' }} name="physical_exam_rectal" value="2">Abnormal</label>
								<label class="radio-inline"><a class="fa fa-list-ul" onclick="$('#specified_physical_exam_rectal_template_collapse').collapse('toggle');" role="button" data-toggle="tooltip" data-placement="bottom" title="Show/Hide template."></a></label>
							</div>
						</div>
					</div>
					<div class="col-md-12 collapse" id="specified_physical_exam_rectal_template_collapse">
						@include('medicine.notes.admission.template.exam.rectal')
					</div>
					<div class="col-md-12 collapse in" id="specified_physical_exam_rectal_collapse">
						<!-- field specified_physical_exam_rectal type text -->
						<textarea class="form-control text_area_feedback" name="specified_physical_exam_rectal" id="specified_physical_exam_rectal" rows="1" maxlength="1000">{{ $note->specified_physical_exam_rectal }}</textarea>
						<div id="specified_physical_exam_rectal_feedback" style="color:#b3b3b3"></div>
					</div>
					<div class="col-md-12"><hr></div>
					
				</div><!-- form-horizontal physical-exam -->
				
				<label class="control-label text-left" for="pertinent_investigation">Pertinent investigation <a class="fa fa-toggle-on icon-toggle-collapse-textarea" target="pertinent_investigation_collapse" role="button" data-toggle="tooltip" data-placement="bottom" title="Show/Hide detail."></a> : (Please see more detail in laboratory sheet, X-ray report, etc.)</label>
				<!-- field pertinent_investigation type text -->
				<div class="collapse in" id="pertinent_investigation_collapse">
					<textarea class="form-control text_area_feedback" name="pertinent_investigation" id="pertinent_investigation" rows="1" maxlength="1000" placeholder="Specify important findings.">{{ $note->pertinent_investigation }}</textarea>
					<div id="pertinent_investigation_feedback" style="color:#b3b3b3"></div>
				</div>
				<div><hr></div>
			</div>
		</div>
	</div>
</div><!-- end of Physical examination and investigation -->
<div class="panel panel-primary"><!-- Problem list, Discussion and plan panel -->
	<div class="panel-heading">Problem list, Discussion and Plan</div> 
	<div class="panel-body">
		<div class="panel panel-info" id="problem_list_panel"><!-- field problem_list type text -->
			<div class="panel-heading">Problem list</div>
			<div class="panel-body">
				<textarea class="form-control text_area_feedback" name="problem_list" id="problem_list" rows="1" maxlength="1000">{{ $note->problem_list }}</textarea>
				<div id="problem_list_feedback" style="color:#b3b3b3"></div>
			</div>
		</div><!-- end of problem list -->
		
		<div class="panel panel-info" id="discussion_panel"><!-- field discussion type text -->
			<div class="panel-heading">Discussion</div>
			<div class="panel-body">
				<textarea class="form-control text_area_feedback" name="discussion" id="discussion" rows="1" maxlength="1000">{{ $note->discussion }}</textarea>
				<div id="discussion_feedback" style="color:#b3b3b3"></div>
			</div>
		</div><!-- end of Discussion -->

		<div class="panel panel-info" id="provisional_diag_panel"><!-- field provisional_diag type text -->
			<div class="panel-heading">Provisional diagnosis</div>
			<div class="panel-body">
				<textarea class="form-control text_area_feedback" name="provisional_diag" id="provisional_diag" rows="1" maxlength="1000">{{ $note->provisional_diag }}</textarea>
				<div id="provisional_diag_feedback" style="color:#b3b3b3"></div>
			</div>
		</div><!-- end of Provisional diagnosis -->

		<div class="panel panel-info" id="plan_investigation_panel"><!-- field plan_investigation type text -->
			<div class="panel-heading">Plan of investigation</div>
			<div class="panel-body">
				<textarea class="form-control text_area_feedback" name="plan_investigation" id="plan_investigation" rows="1" maxlength="1000">{{ $note->plan_investigation }}</textarea>
				<div id="plan_investigation_feedback" style="color:#b3b3b3"></div>
			</div>
		</div><!-- end of Provisional diagnosis -->

		<div class="panel panel-info" id="plan_management_panel"><!-- field plan_management type text -->
			<div class="panel-heading">Plan of management</div>
			<div class="panel-body">
				<textarea class="form-control text_area_feedback" name="plan_management" id="plan_management" rows="1" maxlength="1000">{{ $note->plan_management }}</textarea>
				<div id="plan_management_feedback" style="color:#b3b3b3"></div>
			</div>
		</div><!-- end of Plan of management -->

		<div class="panel panel-info" id="special_group_CPG_panel"><!-- field special_group_CPG type tinyInteger -->
			<div class="panel-heading">Special group (accoring to CPG)</div>
			<div class="panel-body">
				<div class='form-horizontal row col-md-8'>
					<label class="control-label col-md-4">Please Select <a role="button" data-toggle="tooltip" data-placement="bottom" title="Click to reset." class="select-reset" target="special_group_CPG" style="display: none;"><span class="fa fa-remove"></span></a> :</label>
					<div class='col-md-8' id="special_group_CPG_select">
						<select class="form-control" name='special_group_CPG' id='special_group_CPG_select'>
							<option selected disabled hidden value=''></option>
							<option {{ $note->special_group_CPG == 1 ? 'checked' : '' }} value="1">None</option>
							<option {{ $note->special_group_CPG == 1 ? 'checked' : '' }} value="1">Sepsis</option>
							<option {{ $note->special_group_CPG == 2 ? 'checked' : '' }} value="2">Acute GI hemorrhage</option>
							<option {{ $note->special_group_CPG == 3 ? 'checked' : '' }} value="3">Actue MI</option>
							<option {{ $note->special_group_CPG == 4 ? 'checked' : '' }} value="4">AKI</option>
							<option {{ $note->special_group_CPG == 5 ? 'checked' : '' }} value="5">Stroke</option>
						</select>
					</div>
				</div>
			</div>
		</div><!-- end of Special group (accoring to CPG) -->
		
		<div class="panel panel-info" id="plan_consult_panel"><!-- field plan_consult type text -->
			<div class="panel-heading">Plan of consultation</div>
			<div class="panel-body">
				<textarea class="form-control text_area_feedback" name="plan_consult" id="plan_consult" rows="1" maxlength="1000">{{ $note->plan_consult }}</textarea>
				<div id="plan_consult_feedback" style="color:#b3b3b3"></div>
			</div>
		</div><!-- end of Plan of consultation -->
		
		<div class="panel panel-info" id="estimated_los_panel"><!-- field estimated_los type string -->
			<div class="panel-heading">Estimated dulation of hospitalization</div>
			<div class="panel-body">
				<input class="form-control" type="text" name="estimated_los" placeholder="Enter approximate length of stay(days) or leave blank if cannot be presently determined."/>
			</div>
		</div><!-- end of Estimated dulation of hospitalization -->
	</div>
</div><!-- end of problem list, Discussion and plan -->
<div class="panel panel-primary" id="note_panel"><!-- Note panel-->
	<div class="panel-heading">Note</div>
	<div class="panel-body"><!-- md_note -->
		<textarea class="form-control text_area_feedback" name="md_note" id="md_note" rows="1" maxlength="1000" placeholder="1000 characters max.">{{ $note->note->md_note }}</textarea>
		<div id="md_note_feedback" style="color:#b3b3b3"></div>
	</div>
</div><!-- end Note panel-->
<h4 class="alert alert-info text-center">End of {{ $note->note->type->name }} form.</h4>
</div><!-- end of main_frame -->
@endsection

@section('form_script')
@include('medicine.notes.admission.script')
@endsection