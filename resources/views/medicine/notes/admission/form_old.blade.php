@extends('medicine.form')

@section('doc_title')
Admission note - Form
@endsection

@section('description')siriraj medicine admission note form @endsection

@section('author')koramit Pichana @endsection

@section('script')
@include('wordplease_js')
@endsection

@section('content')
@include('partials.flash')

{!! Form::model($anote,['method' => 'PATCH', 'action' => ['IPDNote\Medicine\MedicineNotesController@update',$anote->note_id]]) !!}

<div class="col-md-offset-1 col-md-10"><!-- main_frame -->
<!-- Test gettext function
<div class='well'>
	<h3>Test</h3>
	<h6><a href="/test/reason/{{ $anote->note_id }}">Reason for admission</a></h6>
	<h6><a href="/test/comorbid/{{ $anote->note_id }}">Comorbid</a></h6>
	<h6><a href="/test/significantFiding/{{ $anote->note_id }}">Significant Finding</a></h6>
	<h6><a href="/test/hospitalCourse/{{ $anote->note_id }}">Hospital Course</a></h6>
</div>
 -->
<div class="panel panel-primary" id="preliminary_data">
	<div class="panel-heading">Preliminary data</div> 
	<div class="panel-body">
		<div class="form-horizontal row"><!-- Preliminary form -->
			<!-- field HN type integer -->
			<div class='col-md-6 form-group'>
				{!! Form::label('HN','HN :',['class' => 'control-label col-md-4']) !!}
				<div class='col-md-4'> {!! Form::input('number','HN',null,['class' => 'form-control', 'readonly']) !!} </div>
			</div>

			<!-- field patient_name type session -->
			<div class='col-md-6 form-group'>
				{!! Form::label('patient_name','Patient :',['class' => 'control-label col-md-4']) !!}
				<div class='col-md-8'> 
				<input type='text' class='form-control' value="{{ $anote->getPatientName() or '' }}" name='patient_name' readonly title='แสดงชื่อเดิม (ถ้ามี)'/>
				</div>
			</div>

			<!-- field gender type session -->
			<div class='col-md-6 form-group'>
				{!! Form::label('gender','Gender :',['class' => 'control-label col-md-4']) !!}
				<div class='col-md-4'>
					<input type='text' class='form-control' value="{{ $data['patient_gender'] or '' }}" name='patient_gender' readonly />
				</div>
			</div>

			<!-- field age type session -->
			<div class='col-md-6 form-group'>
				{!! Form::label('age','Age@Note :',['class' => 'control-label col-md-4']) !!}
				<div class='col-md-4'> 
					<input type='text' class='form-control' value="{{ $data['age'] or '' }}" name='age' readonly />
				</div>
			</div>

			<!-- field AN type integer -->
			<div class='col-md-6 form-group'>
				{!! Form::label('AN','AN :',['class' => 'control-label col-md-4']) !!}
				<div class='col-md-4'> {!! Form::input('number','AN',null,['class' => 'form-control', 'readonly']) !!} </div>
			</div>

			<!-- field date_admit type date -->
			<div class='col-md-6 form-group'>
				{!! Form::label('date_admit','Date admit :',['class' => 'control-label col-md-4']) !!}
				<div class='col-md-8'> {!! Form::text('date_admit',null,['class' => 'form-control', 'readonly','title' => $data['LOS']]) !!} </div>
			</div>

			<!-- field ward_id type smallInteger -->
			{!! Form::input('hidden','ward_id',null,['id' => 'ward_id']) !!}
			<div class='col-md-6 form-group'>
				{!! Form::label('ward_id','Ward :',['class' => 'control-label col-md-4']) !!}
				@if (isset($anote->ward_id))
				<div class='col-md-8'><input type='text' class='form-control ui-widget' value="{{ $data['ward_name'] or '' }}" name='ward_name' id='ward_name' placeholder='type for suggestion'/></div>
				@else
				<div class='col-md-8'><input type='text' class='form-control ui-widget' name='ward_name' id='ward_name' placeholder='type for suggestion'/></div>
				@endif
			</div>

			<!-- field attending_id type smallInteger -->
			{!! Form::input('hidden','attending_id',null,['id' => 'attending_id']) !!}
			<div class='form-group col-md-6'>
				{!! Form::label('attending_name','Attending staff :',['class' => 'control-label col-md-4']) !!}
				<div class='col-md-8'><input type="text" name="attending_name" value="{{ $data['attending_name'] }}" class="form-control ui-widget" id="attending_name" placeholder="type for suggestion" title = "{{ $data['attending_detail'] or '' }}"> </div>
				
			</div>
			<!-- field reason_admit type tinyInteger -->
			<div class='form-group col-md-12' id="reason_admit_id">
				{!! Form::label('reason_admit','Reason :',['class' => 'control-label col-md-2']) !!}
				<div class='from-group col-md-10'>
					<label class="radio-inline">{!! Form::radio('reason_admit',1) !!}Curative</label>
					<label class="radio-inline">{!! Form::radio('reason_admit',2) !!}Curative+Palliative</label>
					<label class="radio-inline">{!! Form::radio('reason_admit',3) !!}Palliative only</label>
					<label class="radio-inline">{!! Form::radio('reason_admit',4) !!}Investigation</label>
					<label class="radio-inline">{!! Form::radio('reason_admit',5) !!}Rehabilitation</label>
					<label class="radio-inline">{!! Form::radio('reason_admit',0) !!}Other</label>
				</div>
			</div>
			<!-- field reason_admit_other type string -->
			<!-- <div class='collapse' id='reasonAdmitOther'> -->
				<div class='col-md-12 form-group collapse' id='reasonAdmitOther'>
					{!! Form::label('reason_admit_other','Other :',['class' => 'control-label col-md-2']) !!}
					<div class='col-md-10'> {!! Form::text('reason_admit_other',null,['class' => 'form-control text_area_feedback', 'placeholder' => 'other reason for admission type here. 255 characters max.', 'id' => 'reason_admit_other', 'maxlength' => "255"]) !!} </div>
					<div id="reason_admit_other_feedback" style="color:#b3b3b3" class='col-md-offset-2'></div>
				</div>
			<!-- </div> -->
		</div><!-- end of horizon form -->
	</div><!-- end of preliminary data body -->
</div><!-- end of preliminary data -->
<div class="panel panel-primary">
	<div class="panel-heading" id="history">History</div> 
	<div class="panel-body">

		<!-- panel Chief complaint -->
		<div class="panel panel-info">
			<div class="panel-heading">Chief complaint</div>
			<!-- field chief_complaint type string1000 -->
			<div class="panel-body">
				{!! Form::textarea('chief_complaint',null,['class' => 'form-control text_area_feedback', 'rows' => '1', 'id' => 'chief_complaint', 'maxlength' => '20','placeholder' => '1000 characters max.']) !!}
				<div id="chief_complaint_feedback" style="color:#b3b3b3"></div>
			</div>
		</div>
		<!-- panel co-morbid -->
		<div class="panel panel-info" id="comorbid_id">
			<div class="panel-heading">Co-morbid and illness history</div>
			<div class="panel-body">
				
				<button type="button" onclick="setComorbid(1)" title="Click เพื่อลงข้อมูล Co-morbid เป็น No data ทั้งหมด" class="btn btn-info">No data all</button>
				<button type="button" onclick="setComorbid(2)" title="Click เพื่อลงข้อมูล Co-morbid เป็น No ทั้งหมด" class="btn btn-info">No co-morbid</button>
				<button type="button" onclick="setComorbid(3)" title="แสดง/ซ่อน รายการโรคร่วม" class="btn btn-primary">Show/Hide Co-morbid List</button>

	            <!-- collapse Comorbid list -->
	            <div class="form-horizontal row collapse in" id="comorbidList">
	            	<div class="col-md-12"><hr></div>
					<!-- field comorbid_DM type tinyInteger -->
					<div class='form-group col-md-12'>
						{!! Form::label('DM','DM :',['class' => 'control-label col-md-4']) !!}
						<div class='col-md-8'>
							<label class="radio-inline">{!! Form::radio('comorbid_DM',99) !!}No data</label>
						    <label class="radio-inline">{!! Form::radio('comorbid_DM',0) !!}No</label>
						    <label class="radio-inline">{!! Form::radio('comorbid_DM',1) !!}Yes</label>
						</div>
					 </div>

					<div class="collapse" id="comorbid_DM_collapse">
						<div class='form-group col-md-12'>
							{!! Form::label('DM_type','DM Type :',['class' => 'control-label col-md-4']) !!}
							<!-- field DM_type tinyInteger -->
							<div class='col-md-8'>
								<label class="radio-inline">{!! Form::radio('DM_type',1) !!}Type I</label>
							    <label class="radio-inline">{!! Form::radio('DM_type',2) !!}Type II</label>
							</div>
						</div>
						<div class="col-md-12"></div>
						<div class='form-group col-md-12'>
							{!! Form::label('DM_complication','DM Complication :',['class' => 'control-label col-md-4']) !!}
							<div class='col-md-8'>
								<!-- field DM_DR type boolean -->
								<div class="checkbox col-md-3"><label>{!! Form::checkbox('DM_DR') !!}DR</label></div>
							    <!-- field DM_nephropathy type boolean -->
								<div class="checkbox col-md-3"><label>{!! Form::checkbox('DM_nephropathy') !!}Nephropathy</label></div>
							    <!-- field DM_neuropathy type boolean -->
								<div class="checkbox col-md-3"><label>{!! Form::checkbox('DM_neuropathy') !!}Neuropathy</label></div>
						    </div>
						</div>
						<div class="col-md-12"></div>

						<div class='form-group col-md-12'>
							{!! Form::label('DM_complication','On :',['class' => 'control-label col-md-4']) !!}
							<div class='col-md-8'>
								<!-- field DM_on_diet type boolean -->
								<div class="checkbox col-md-3"><label>{!! Form::checkbox('DM_on_diet') !!}Diet control</label></div>
							    <!-- field DM_on_oral_med type boolean -->
								<div class="checkbox col-md-3"><label>{!! Form::checkbox('DM_on_oral_med') !!}Oral medication</label></div>
							    <!-- field DM_on_insulin type boolean -->
								<div class="checkbox col-md-3"><label>{!! Form::checkbox('DM_on_insulin') !!}Insulin</label></div>
						    </div>
						</div>
					</div><!-- end of DM collapse -->
					<div class="col-md-12"><hr></div>

					<div class='form-group col-md-12'>
						{!! Form::label('HT','HT :',['class' => 'control-label col-md-4']) !!}
						<!-- field comorbid_HT type tinyInteger -->
						<div class='col-md-8'>
							<label class="radio-inline">{!! Form::radio('comorbid_HT',99) !!}No data</label>
						    <label class="radio-inline">{!! Form::radio('comorbid_HT',0) !!}No</label>
						    <label class="radio-inline">{!! Form::radio('comorbid_HT',1) !!}Yes</label>
						</div>
					</div>
					<div class="col-md-12"><hr></div>
					
					<div class='form-group col-md-12'>
						<label class="control-label col-md-4">CAD[<a title="Coronary artery disease">*</a>] :</label>
						<!-- field comorbid_CAD type tinyInteger -->
						<div class='col-md-8'>
							<label class="radio-inline">{!! Form::radio('comorbid_CAD',99) !!}No data</label>
							<label class="radio-inline">{!! Form::radio('comorbid_CAD',0) !!}No</label>
							<label class="radio-inline">{!! Form::radio('comorbid_CAD',1) !!}Yes</label>
						</div>
					</div>

					<div class="collapse" id="comorbid_CAD_collapse" >
						<div class='form-group col-md-12'>
							{!! Form::label('cad_dx','Diagnosis :',['class' => 'control-label col-md-4']) !!}
							<!-- field CAD_dx type tinyInteger -->
							<div class='col-md-8'>
								<label class="radio-inline">{!! Form::radio('CAD_dx',1) !!}Old MI</label>
								<label class="radio-inline">{!! Form::radio('CAD_dx',2) !!}Unstable angina</label>
								<label class="radio-inline">{!! Form::radio('CAD_dx',3) !!}Stable angina</label>
								<label class="radio-inline">{!! Form::radio('CAD_dx',0) !!}Others</label>
							</div><!-- end CAD_dx radio input -->
						</div>

						<div class='form-group col-md-12'>
							{!! Form::label('CAD_dx_other','CAD Type other:',['class' => 'control-label col-md-4']) !!}
							<!-- field CAD_dx_other type string -->
							<div class='col-md-8'> {!! Form::text('CAD_dx_other',null,['class' => 'form-control text_area_feedback', 'readonly', 'maxlength' => '20','id' => 'CAD_dx_other']) !!}</div>
							<div id="CAD_dx_other_feedback" style="color:#b3b3b3" class='col-md-offset-4'></div>
						</div>
					</div>
					<div class="col-md-12"><hr></div>

					<div class='form-group col-md-12'>
						{!! Form::label('VHD','Valvular heart disease :',['class' => 'control-label col-md-4']) !!}
						<!-- field comorbid_VHD type tinyInteger -->
						<div class='col-md-8'>
							<label class="radio-inline">{!! Form::radio('comorbid_VHD',99) !!}No data</label>
							<label class="radio-inline">{!! Form::radio('comorbid_VHD',0) !!}No</label>
							<label class="radio-inline">{!! Form::radio('comorbid_VHD',1) !!}Yes</label>
						</div>
					</div>
					
					<div class="collapse col-md-12" id="comorbid_VHD_collapse" >
						<div class='form-group col-md-12'>
							{!! Form::label('VHD_dx_AS','Diagnosis :',['class' => 'control-label col-md-4']) !!}
							<div class='row col-md-8'>
								<!-- field VHD_dx_AS type boolean -->
								<div class="checkbox col-md-2"><label>{!! Form::checkbox('VHD_dx_AS') !!}AS</label></div>
							    <!-- field VHD_dx_AR type boolean -->
								<div class="checkbox col-md-2"><label>{!! Form::checkbox('VHD_dx_AR') !!}AR</label></div>
							    <!-- field VHD_dx_MS type boolean -->
								<div class="checkbox col-md-2"><label>{!! Form::checkbox('VHD_dx_MS') !!}MS</label></div>
							    <!-- field VHD_dx_MR type boolean -->
								<div class="checkbox col-md-2"><label>{!! Form::checkbox('VHD_dx_MR') !!}MR</label></div>
							    <!-- field VHD_dx_TR type boolean -->
								<div class="checkbox col-md-2"><label>{!! Form::checkbox('VHD_dx_TR') !!}TR</label></div>
							</div>
						</div>

						<div class='col-md-12 form-group'>
							{!! Form::label('VHD_other','Other :',['class' => 'control-label col-md-4']) !!}
							<!-- field VHD_dx_other string -->
							<div class='col-md-8'> {!! Form::text('VHD_dx_other',null,['class' => 'form-control text_area_feedback', 'id' => 'VHD_dx_other','maxlength' => '20']) !!} </div>
							<div id="VHD_dx_other_feedback" style="color:#b3b3b3" class='col-md-offset-4'></div>
						</div>
					</div>
					<div class="col-md-12"><hr></div>

					<div class='form-group col-md-12'>
						{!! Form::label('stroke','Stroke :',['class' => 'control-label col-md-4']) !!}
						<!-- field comorbid_stroke type tinyInteger -->
						<div class='col-md-8'>
							<label class="radio-inline">{!! Form::radio('comorbid_stroke',99) !!}No data</label>
							<label class="radio-inline">{!! Form::radio('comorbid_stroke',0) !!}No</label>
							<label class="radio-inline">{!! Form::radio('comorbid_stroke',1) !!}Yes</label>									
						</div>
					</div>

					<div class="collapse col-md-12" id="comorbid_stroke_collapse" >
						<div class='col-md-12 col-md-offset-1'>
							<!-- field stroke_ischemic type boolean -->
							<div class="checkbox col-md-2"><label>{!! Form::checkbox('stroke_ischemic') !!}ischemic</label></div>
							
							<!-- field stroke_ischemic_result type boolean -->
							<div class='row col-md-5'>
								{!! Form::label('stroke_ischemic_result','Result :',['class' => 'control-label col-md-4']) !!}
								<div class='col-md-4'><label class="radio-inline">{!! Form::radio('stroke_ischemic_result',1) !!}hemiparesis</label></div>
								<div class='col-md-4'><label class="radio-inline">{!! Form::radio('stroke_ischemic_result',2) !!}hemiplegia</label></div>
							</div>
							
							<!-- field stroke_ischemic_result_on type boolean -->
							<div class='row col-md-5'>
								{!! Form::label('stroke_ischemic_result_on','On :',['class' => 'control-label col-md-4']) !!}
								<div class='col-md-4'><label class="radio-inline">{!! Form::radio('stroke_ischemic_result_on',1) !!}left</label></div>
								<div class='col-md-4'><label class="radio-inline">{!! Form::radio('stroke_ischemic_result_on',2) !!}right</label></div>
							</div>
						</div>

						<div class='col-md-12 col-md-offset-1'>
							<!-- field stroke_hemorrhagic type boolean -->
							<div class="checkbox col-md-2"><label>{!! Form::checkbox('stroke_hemorrhagic') !!}hemorrhagic</label></div>
							
							<!-- field stroke_hemorrhagic_result type boolean -->
							<div class='row col-md-5'>
								{!! Form::label('stroke_hemorrhagic_result','Result :',['class' => 'control-label col-md-4']) !!}
								<div class='col-md-4'><label class="radio-inline">{!! Form::radio('stroke_hemorrhagic_result',1) !!}hemiparesis</label></div>
								<div class='col-md-4'><label class="radio-inline">{!! Form::radio('stroke_hemorrhagic_result',2) !!}hemiplegia</label></div>
							</div>
							
							<!-- field stroke_hemorrhagic_result_on type boolean -->
							<div class='row col-md-5'>
								{!! Form::label('stroke_hemorrhagic_result_on','On :',['class' => 'control-label col-md-4']) !!}
								<div class='col-md-4'><label class="radio-inline">{!! Form::radio('stroke_hemorrhagic_result_on',1) !!}left</label></div>
								<div class='col-md-4'><label class="radio-inline">{!! Form::radio('stroke_hemorrhagic_result_on',2) !!}right</label></div>
							</div>
						</div>

						<div class='col-md-12 col-md-offset-1'>
							<!-- field stroke_iembolic type boolean -->
							<div class="checkbox col-md-2"><label>{!! Form::checkbox('stroke_iembolic') !!}iembolic</label></div>
							
							<!-- field stroke_iembolic_result type boolean -->
							<div class='row col-md-5'>
								{!! Form::label('stroke_iembolic_result','Result :',['class' => 'control-label col-md-4']) !!}
								<div class='col-md-4'><label class="radio-inline">{!! Form::radio('stroke_iembolic_result',1) !!}hemiparesis</label></div>
								<div class='col-md-4'><label class="radio-inline">{!! Form::radio('stroke_iembolic_result',2) !!}hemiplegia</label></div>
							</div>
							
							<!-- field stroke_iembolic_result_on type boolean -->
							<div class='row col-md-5'>
								{!! Form::label('stroke_iembolic_result_on','On :',['class' => 'control-label col-md-4']) !!}
								<div class='col-md-4'><label class="radio-inline">{!! Form::radio('stroke_iembolic_result_on',1) !!}left</label></div>
								<div class='col-md-4'><label class="radio-inline">{!! Form::radio('stroke_iembolic_result_on',2) !!}right</label></div>
							</div>
						</div>
					</div><!-- end radio stroke -->
					<div class="col-md-12"><hr></div>

					<div class='form-group col-md-12'>
						{!! Form::label('comorbid_COPD','COPD :',['class' => 'control-label col-md-4']) !!}
						<!-- field comorbid_COPD type tinyInteger -->
						<div class='col-md-8'>
							<label class="radio-inline">{!! Form::radio('comorbid_COPD',99) !!}No data</label>
							<label class="radio-inline">{!! Form::radio('comorbid_COPD',0) !!}No</label>
							<label class="radio-inline">{!! Form::radio('comorbid_COPD',1) !!}Yes</label>		
						</div>
					</div>
					<div class="col-md-12"><hr></div>

					<div class='form-group col-md-12'>
						{!! Form::label('comorbid_asthma','Asthma :',['class' => 'control-label col-md-4']) !!}
						<!-- field comorbid_asthma type tinyInteger -->
						<div class='col-md-8'>
							<label class="radio-inline">{!! Form::radio('comorbid_asthma',99) !!}No data</label>
							<label class="radio-inline">{!! Form::radio('comorbid_asthma',0) !!}No</label>
							<label class="radio-inline">{!! Form::radio('comorbid_asthma',1) !!}Yes</label>
						</div>
					</div>
					<div class="col-md-12"><hr></div>

					<div class='form-group col-md-12'>
						<label class='control-label col-md-4'>CKD[<a title='Chronic kidney disease'>*</a>] :</label>
						<!-- field comorbid_CKD type tinyInteger -->
						<div class='col-md-8'>
							<label class="radio-inline">{!! Form::radio('comorbid_CKD',99) !!}No data</label>
							<label class="radio-inline">{!! Form::radio('comorbid_CKD',0) !!}No</label>
							<label class="radio-inline">{!! Form::radio('comorbid_CKD',1) !!}Yes</label>
						</div>
					</div>
					
					<div class="col-md-12 form-group collapse" id="comorbid_CKD_collapse">
						{!! Form::label('CKD_stage','Stage :',['class' => 'col-md-2 control-label']) !!}
						<!-- field CKD_stage type tinyInteger -->
						<div class='col-md-1'><label class="radio-inline">{!! Form::radio('CKD_stage',1) !!}I</label></div>
						<div class='col-md-1'><label class="radio-inline">{!! Form::radio('CKD_stage',2) !!}II</label></div>
					    <div class='col-md-1'><label class="radio-inline">{!! Form::radio('CKD_stage',3) !!}III</label></div>
					    <div class='col-md-1'><label class="radio-inline">{!! Form::radio('CKD_stage',4) !!}IV</label></div>
					    <div class='col-md-2'><label class="radio-inline">{!! Form::radio('CKD_stage',50) !!}V, no dialysis</label></div>
					    <div class='col-md-2'><label class="radio-inline">{!! Form::radio('CKD_stage',51) !!}V, on HD</label></div>
					    <div class='col-md-2'><label class="radio-inline">{!! Form::radio('CKD_stage',52) !!}V, on PD</label></div>
					</div>
					<div class="col-md-12"><hr></div>

					<div class='form-group col-md-12'>
						{!! Form::label('comorbid_hyperlipidemia','Hyperlipidemia :',['class' => 'control-label col-md-4']) !!}
						<!-- field comorbid_hyperlipidemia tinyInteger -->
						<div class='col-md-8'>
							<label class="radio-inline">{!! Form::radio('comorbid_hyperlipidemia',99) !!}No data</label>
							<label class="radio-inline">{!! Form::radio('comorbid_hyperlipidemia',0) !!}No</label>
							<label class="radio-inline">{!! Form::radio('comorbid_hyperlipidemia',1) !!}Yes</label>
						</div>
					</div>

					<div class="col-md-12 form-group collapse" id="comorbid_hyperlipidemia_collapse">
						{!! Form::label('hyperlipidemia_type','Diagnosis :',['class' => 'col-md-4 control-label']) !!}
						<!-- field hyperlipidemia_type type tinyInteger -->
						<div class="from-group col-md-8">
							<div class='col-md-4'><label class="radio-inline">{!! Form::radio('hyperlipidemia_type',1) !!}Hypercholesterolemia</label></div>
							<div class='col-md-4'><label class="radio-inline">{!! Form::radio('hyperlipidemia_type',2) !!}Hypertriglyceridemia</label></div>
							<div class='col-md-4'><label class="radio-inline">{!! Form::radio('hyperlipidemia_type',3) !!}Mixed-hyperlipidemia</label></div>
						</div>
					</div>
					<div class="col-md-12"><hr></div>

					<!-- field comorbid_cirrhosis type tinyInteger -->
					<div class='form-group col-md-12'>
						{!! Form::label('cirrhosis','Cirrhosis :',['class' => 'control-label col-md-4']) !!}
						<div class='col-md-8'>
							<label class="radio-inline">{!! Form::radio('comorbid_cirrhosis',99) !!}No data</label>
							<label class="radio-inline">{!! Form::radio('comorbid_cirrhosis',0) !!}No</label>
							<label class="radio-inline">{!! Form::radio('comorbid_cirrhosis',1) !!}Yes</label>
						</div>
					</div>

					<div class="collapse" id="comorbid_cirrhosis_collapse">
						<div class="col-md-12 form-group">
						<label for="" class="col-md-4 control-label">Child-Pugh score[<a onclick="$('#cp_score_refferance_collapse').collapse('toggle')">*</a>] :</label>
							<div class='col-md-8'>
								<!-- field cirrhosis_cp_score type tinyInteger -->
								<label class="radio-inline col-md-1">{!! Form::radio('cirrhosis_cp_score',1) !!}A</label>
							    <label class="radio-inline col-md-1">{!! Form::radio('cirrhosis_cp_score',2) !!}B</label>
							    <label class="radio-inline col-md-1">{!! Form::radio('cirrhosis_cp_score',3) !!}C</label>
							</div>
						</div>

						<!-- Refferance -->
						<div class="collapse col-md-12 form-group" id="cp_score_refferance_collapse">@include('cpscore')</div><!-- <div class="row col-md-offset-6"></div> -->
						
						<div class='form-group col-md-12'>
							{!! Form::label('cirrhosis_cp_score','Etiology :',['class' => 'control-label col-md-4']) !!}
							<!-- field cirrhosis_etiology_HBV type boolean -->
							<div class="checkbox col-md-2"><label>{!! Form::checkbox('cirrhosis_etiology_HBV') !!}HBV</label></div>
							<!-- field cirrhosis_etiology_HCV type boolean -->
							<div class="checkbox col-md-2"><label>{!! Form::checkbox('cirrhosis_etiology_HCV') !!}HCV</label></div>
						    <!-- field cirrhosis_etiology_NASH type boolean -->
							<div class="checkbox col-md-2"><label>{!! Form::checkbox('cirrhosis_etiology_NASH') !!}NASH</label></div>
						    <!-- field cirrhosis_etiology_cryptogenic type boolean -->
							<div class="checkbox col-md-2"><label>{!! Form::checkbox('cirrhosis_etiology_cryptogenic') !!}Cryptogenic</label></div>
						</div>
					    <!-- field cirrhosis_etiology_other type string -->
					    <div class='col-md-12 form-group'>
							{!! Form::label('cirrhosis_etiology_other','Other etiology :',['class' => 'control-label col-md-4']) !!}
							<div class='col-md-8'> {!! Form::text('cirrhosis_etiology_other',null,['class' => 'form-control text_area_feedback', 'maxlength' => '20']) !!} </div>
							<div id="cirrhosis_etiology_other_feedback" style="color:#b3b3b3" class='col-md-offset-4'></div>
						</div>
					</div><!-- end of cirrhosis collapse -->
					<div class="col-md-12"><hr></div>

					<!-- field comorbid_coagulopathy type tinyInteger -->
					<div class='form-group col-md-12'>
						{!! Form::label('coagulopathy','Coagulopathy :',['class' => 'control-label col-md-4']) !!}
						<div class='col-md-8'>
							<label class="radio-inline">{!! Form::radio('comorbid_coagulopathy',99) !!}No data</label>
							<label class="radio-inline">{!! Form::radio('comorbid_coagulopathy',0) !!}No</label>
							<label class="radio-inline">{!! Form::radio('comorbid_coagulopathy',1) !!}Yes</label>
						</div>
					</div>
					<div class="col-md-12"><hr></div>

					<!-- field comorbid_HBV type tinyInteger -->
					<div class='form-group col-md-12'>
						{!! Form::label('comorbid_HBV','HBV infection :',['class' => 'control-label col-md-4']) !!}
						<div class='col-md-8'>
							<label class="radio-inline">{!! Form::radio('comorbid_HBV',99) !!}No data</label>
							<label class="radio-inline">{!! Form::radio('comorbid_HBV',0) !!}No</label>
							<label class="radio-inline">{!! Form::radio('comorbid_HBV',1) !!}Yes</label>
						</div>
					</div>
					<div class="col-md-12"><hr></div>

					<!-- field comorbid_HCV type tinyInteger -->
					<div class='form-group col-md-12'>
						{!! Form::label('comorbid_HCV','HCV infection :',['class' => 'control-label col-md-4']) !!}
						<div class='col-md-8'>
							<label class="radio-inline">{!! Form::radio('comorbid_HCV',99) !!}No data</label>
							<label class="radio-inline">{!! Form::radio('comorbid_HCV',0) !!}No</label>
							<label class="radio-inline">{!! Form::radio('comorbid_HCV',1) !!}Yes</label>
						</div>
					</div>
					<div class="col-md-12"><hr></div>

					<!-- field comorbid_HIV type tinyInteger -->
					<div class='form-group col-md-12'>
						{!! Form::label('HIV','HIV :',['class' => 'control-label col-md-4']) !!}
						<div class='col-md-8'>
							<label class="radio-inline">{!! Form::radio('comorbid_HIV',99) !!}No data</label>
							<label class="radio-inline">{!! Form::radio('comorbid_HIV',0) !!}No</label>
							<label class="radio-inline">{!! Form::radio('comorbid_HIV',2) !!}HIV infection</label>
							<label class="radio-inline">{!! Form::radio('comorbid_HIV',1) !!}AIDS</label>
						</div>
					</div>
					
					<div class="collapse" id="comorbid_HIV_collapse">
						<div class='form-group col-md-12'>
							{!! Form::label('HIV_pre_infect_TB','Previous opportunistic infection :',['class' => 'control-label col-md-4']) !!}
							<!-- field HIV_pre_infect_TB type boolean -->
							<div class="checkbox col-md-2"><label>{!! Form::checkbox('HIV_pre_infect_TB') !!}TB</label></div>
						    <!-- field HIV_pre_infect_PCP type boolean -->
							<div class="checkbox col-md-2"><label>{!! Form::checkbox('HIV_pre_infect_PCP') !!}PCP</label></div>
						    <!-- field HIV_pre_infect_candidiasis type boolean -->
							<div class="checkbox col-md-2"><label>{!! Form::checkbox('HIV_pre_infect_candidiasis') !!}Candidiasis</label></div>
						    <!-- field HIV_pre_infect_CMV type boolean -->
							<div class="checkbox col-md-2"><label>{!! Form::checkbox('HIV_pre_infect_CMV') !!}CMV</label></div>
						</div>

						<!-- field HIV_pre_infect_other type string -->
						<div class='col-md-12 form-group'>
							{!! Form::label('HIV_pre_infect_other','Other opportunistic infection :',['class' => 'control-label col-md-4']) !!}
							<div class='col-md-8'> {!! Form::text('HIV_pre_infect_other',null,['class' => 'form-control text_area_feedback', 'maxlength' => '20']) !!} </div>
							<div id="HIV_pre_infect_other_feedback" style="color:#b3b3b3" class='col-md-offset-4'></div>
						</div>
					</div>
					<div class="col-md-12"><hr></div>

					<!-- field comorbid_epilepsy type tinyInteger -->
					<div class='form-group col-md-12'>
						{!! Form::label('epilepsy','Epilepsy :',['class' => 'control-label col-md-4']) !!}
						<div class='col-md-8'>
							<label class="radio-inline">{!! Form::radio('comorbid_epilepsy',99) !!}No data</label>
							<label class="radio-inline">{!! Form::radio('comorbid_epilepsy',0) !!}No</label>
							<label class="radio-inline">{!! Form::radio('comorbid_epilepsy',1) !!}Yes</label>
						</div>
					</div>
					<div class="collapse" id="comorbid_epilepsy_collapse">
						<div class='form-group col-md-12'>
							<!-- field epilepsy_dx type tinyInteger -->
							{!! Form::label('epilepsy_dx','Diagnosis :',['class' => 'col-md-4 control-label']) !!}
							<div class="col-md-8">
								<label class="radio-inline">{!! Form::radio('epilepsy_dx',1) !!}GTC</label>
								<label class="radio-inline">{!! Form::radio('epilepsy_dx',2) !!}Focal</label>
								<label class="radio-inline">{!! Form::radio('epilepsy_dx',3) !!}Complex partial seizure</label>
								<label class="radio-inline">{!! Form::radio('epilepsy_dx',4) !!}Unknown</label>
								<label class="radio-inline">{!! Form::radio('epilepsy_dx',0) !!}Others</label>
							</div>
						</div>
						<div class='form-group col-md-12'>
							{!! Form::label('epilepsy_dx_other','Other :',['class' => 'col-md-4 control-label']) !!}
							<!-- field epilepsy_dx_other type string -->
							<div class='col-md-8'> {!! Form::text('epilepsy_dx_other',null,['class' => 'form-control text_area_feedback', 'maxlength' => '20']) !!} </div>
							<div id="epilepsy_dx_other_feedback" style="color:#b3b3b3" class='col-md-offset-4'></div>
						</div>
					</div>
					<div class="col-md-12"><hr></div>

					<!-- field comorbid_leukemia type tinyInteger -->
					<div class='form-group col-md-12'>
						{!! Form::label('leukemia','Leukemia :',['class' => 'control-label col-md-4']) !!}
						<div class='col-md-8'>
							<label class="radio-inline">{!! Form::radio('comorbid_leukemia',99) !!}No data</label>
							<label class="radio-inline">{!! Form::radio('comorbid_leukemia',0) !!}No</label>
							<label class="radio-inline">{!! Form::radio('comorbid_leukemia',1) !!}Yes</label>
						</div>
					</div>

					<div class="col-md-12 form-group collapse" id="comorbid_leukemia_collapse">
						<!-- field leukemia_dx type tinyInteger -->
						{!! Form::label('','Diagnosis :',['class' => 'col-md-4 control-label']) !!}
						<div class='col-md-8'>
							<label class="radio-inline">{!! Form::radio('leukemia_dx',1) !!}ALL</label>
							<label class="radio-inline">{!! Form::radio('leukemia_dx',2) !!}AML</label>
							<label class="radio-inline">{!! Form::radio('leukemia_dx',3) !!}CLL</label>
							<label class="radio-inline">{!! Form::radio('leukemia_dx',4) !!}CML</label>
						</div>
					</div>
					<div class="col-md-12"><hr></div>

					<!-- field comorbid_lymphoma type tinyInteger -->
					<div class='form-group col-md-12'>
						{!! Form::label('lymphoma','Lymphoma :',['class' => 'control-label col-md-4']) !!}
						<div class='col-md-8'>
							<label class="radio-inline">{!! Form::radio('comorbid_lymphoma',99) !!}No data</label>
							<label class="radio-inline">{!! Form::radio('comorbid_lymphoma',0) !!}No</label>
							<label class="radio-inline">{!! Form::radio('comorbid_lymphoma',1) !!}Yes</label>
						</div>
					</div>

					<div class="collapse" id="comorbid_lymphoma_collapse">
						<!-- field lymphoma_dx type tinyInteger -->
						<div class='form-group col-md-12'>
							{!! Form::label('lymphoma_dx','Diagnosis :',['class' => 'control-label col-md-4']) !!}
							<div class='col-md-8 lymphoma_dx_div'>
								<select class="form-control" name='lymphoma_dx' id='lymphoma_dx_select'>
									<option selected disabled hidden value=''></option>
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
									<option value="0">Other</option>
								</select>
								@if (!is_null($anote->lymphoma_dx))
								<script type="text/javascript">$('#lymphoma_dx_select').val('{{ $anote->lymphoma_dx }}');</script>
								@endif
							</div>
						</div>
						
						<div class='form-group col-md-12'>
							{!! Form::label('lymphoma_dx_other','Other :',['class' => 'control-label col-md-4']) !!}
							<!-- field lymphoma_dx_other type string -->
							<div class="col-md-8">{!! Form::text('lymphoma_dx_other',null,['class' => 'form-control text_area_feedback', 'placeholder' => 'Other type here' ,'id' => 'lymphoma_type_other', 'maxlength' => '20']) !!} </div>
							<div id="lymphoma_type_other_feedback" style="color:#b3b3b3" class='col-md-offset-4'></div>
						</div>
					</div>
					<div class="col-md-12"><hr></div>

					<div class='form-group col-md-12'>
						{!! Form::label('pacemaker_implant','Pacemaker implant :',['class' => 'control-label col-md-4']) !!}
						<!-- field comorbid_pacemaker_implant type tinyInteger -->
						<div class='col-md-8'>
							<label class="radio-inline">{!! Form::radio('comorbid_pacemaker_implant',99) !!}No data</label>
							<label class="radio-inline">{!! Form::radio('comorbid_pacemaker_implant',0) !!}No</label>
							<label class="radio-inline">{!! Form::radio('comorbid_pacemaker_implant',1) !!}Yes</label>
						</div>
					</div>

					<div class="collapse" id="comorbid_pacemaker_implant_collapse">
						<div class='form-group col-md-12'>
							<!-- field pacemaker_implant_type type tinyInteger-->
							{!! Form::label('','Pacemaker type :',['class' => 'col-md-4 control-label']) !!}
							<div class='col-md-4'><label class="radio-inline">{!! Form::radio('pacemaker_implant_type',1) !!}DDDR (dual-chamber, rate-modulated)</label></div>
							<div class='col-md-1'><label class="radio-inline">{!! Form::radio('pacemaker_implant_type',2) !!}VVI</label></div>
							<div class='col-md-1'><label class="radio-inline">{!! Form::radio('pacemaker_implant_type',0) !!}Other</label></div>
						</div>
						<div class='form-group col-md-12'>
							{!! Form::label('lymphoma_type_other','Other :',['class' => 'control-label col-md-4']) !!}
							<!-- field pacemaker_implant_type_other type string -->
							<div class="col-md-8">{!! Form::text('pacemaker_implant_type_other',null,['class' => 'form-control text_area_feedback', 'placeholder' => 'Other type here' ,'id' => 'pacemaker_implant_other','maxlength' => '20']) !!} </div>
							<div id="pacemaker_implant_other_feedback" style="color:#b3b3b3" class='col-md-offset-4'></div>
						</div>
					</div>
					<div class="col-md-12"><hr></div>

					<!-- field comorbid_ICD type tinyInteger -->
					<div class='form-group col-md-12'>
						<label class="control-label col-md-4">ICD[<a title="Implantable Cardioverter Defibrillator">*</a>] :</label>								
						<div class='col-md-8'>
							<label class="radio-inline">{!! Form::radio('comorbid_ICD',99) !!}No data</label>
							<label class="radio-inline">{!! Form::radio('comorbid_ICD',0) !!}No</label>
							<label class="radio-inline">{!! Form::radio('comorbid_ICD',1) !!}Yes</label>
						</div>
					</div>

					<div class="collapse" id="comorbid_ICD_collapse">
						<!-- field ICD_type type string -->
						<div class='form-group col-md-12'>
							{!! Form::label('ICD_type','ICD Type :',['class' => 'control-label col-md-4']) !!}
							<div class="col-md-8">{!! Form::text('ICD_type',null,['class' => 'form-control text_area_feedback', 'placeholder' => 'enter ICD type here','maxlength' => '20']) !!} </div>
							<div id="ICD_type_feedback" style="color:#b3b3b3" class='col-md-offset-4'></div>
						</div>
					</div>
					<div class="col-md-12"><hr></div>

					<div class='form-group col-md-12'>
						{!! Form::label('cancer','Cancer :',['class' => 'control-label col-md-4']) !!}
						<!-- field comorbid_cancer type tinyInteger -->
						<div class='col-md-8'>
							<label class="radio-inline">{!! Form::radio('comorbid_cancer',99) !!}No data</label>
							<label class="radio-inline">{!! Form::radio('comorbid_cancer',0) !!}No</label>
							<label class="radio-inline">{!! Form::radio('comorbid_cancer',1) !!}Yes</label>
						</div>
					</div>
					
					<div class="collapse" id="comorbid_cancer_collapse">
						<div class='form-group col-md-12'>
							{!! Form::label('cancer_organ','Please select organ :',['class' => 'control-label col-md-4']) !!}
							<!-- field cancer_at_lung type boolean-->
							<div class="checkbox col-md-2"><label>{!! Form::checkbox('cancer_at_lung') !!}Lung</label></div>
						    <!-- field cancer_at_liver type boolean-->
							<div class="checkbox col-md-2"><label>{!! Form::checkbox('cancer_at_liver') !!}Liver</label></div>
						    <!-- field cancer_at_colon type boolean-->
							<div class="checkbox col-md-2"><label>{!! Form::checkbox('cancer_at_colon') !!}Colon</label></div>
						    <!-- field cancer_at_breast type boolean-->
							<div class="checkbox col-md-2"><label>{!! Form::checkbox('cancer_at_breast') !!}Breast</label></div>
						</div>
						<div class='form-group col-md-12'>
							{!! Form::label('cancer_organ',' ',['class' => 'control-label col-md-4']) !!}
						    <!-- field cancer_at_prostate type boolean-->
							<div class="checkbox col-md-2"><label>{!! Form::checkbox('cancer_at_prostate') !!}Prostate</label></div>
						    <!-- field cancer_at_cervix type boolean-->
							<div class="checkbox col-md-2"><label>{!! Form::checkbox('cancer_at_cervix') !!}Cervix</label></div>
						    <!-- field cancer_at_pancreas type boolean-->
							<div class="checkbox col-md-2"><label>{!! Form::checkbox('cancer_at_pancreas') !!}Pancreas</label></div>
						    <!-- field cancer_at_brain type boolean-->
							<div class="checkbox col-md-2"><label>{!! Form::checkbox('cancer_at_brain') !!}Brain</label></div>
						</div>

						<div class='col-md-12 form-group'>
							{!! Form::label('cancer_at_other','Other organ :',['class' => 'control-label col-md-4']) !!}
							<!-- field cancer_at_other type string-->
							<div class='col-md-8'> {!! Form::text('cancer_at_other',null,['class' => 'form-control text_area_feedback', 'placeholder' => 'Other organ type here', 'maxlength' => '20']) !!} </div>
							<div id="cancer_at_other_feedback" style="color:#b3b3b3" class='col-md-offset-4'></div>
						</div>
					</div>
					<div class="col-md-12"><hr></div>

					<div class='form-group col-md-12'>
						{!! Form::label('comorbid_chronic_arthritis','Chronic arthritis :',['class' => 'control-label col-md-4']) !!}
						<!-- field comorbid_chronic_arthritis type tinyInteger -->
						<div class='col-md-8'>
							<label class="radio-inline">{!! Form::radio('comorbid_chronic_arthritis',99) !!}No data</label>
							<label class="radio-inline">{!! Form::radio('comorbid_chronic_arthritis',0) !!}No</label>
							<label class="radio-inline">{!! Form::radio('comorbid_chronic_arthritis',1) !!}Yes</label>
						</div>
					</div>
					
					<div class="collapse" id="comorbid_chronic_arthritis_collapse">
						<div class='form-group col-md-12'>
							{!! Form::label('chronic_arthritis_organ','Please select :',['class' => 'control-label col-md-4']) !!}
						    <!-- field chronic_arthritis_CPPD type boolean -->
							<div class="checkbox col-md-2"><label>{!! Form::checkbox('chronic_arthritis_CPPD') !!}CPPD[<a title="Calcium pyrophosphate dihydrate">*</a>]</label></div>
						    <!-- field chronic_arthritis_rheumatoid type boolean -->
							<div class="checkbox col-md-3"><label>{!! Form::checkbox('chronic_arthritis_rheumatoid') !!}Rheumatoid arthritis</label></div>
						</div>
						<div class='form-group col-md-12'>
							{!! Form::label('chronic_arthritis_organ',' ',['class' => 'control-label col-md-4']) !!}    
						    <!-- field chronic_arthritis_OA type boolean -->
							<div class="checkbox col-md-2"><label>{!! Form::checkbox('chronic_arthritis_OA') !!}OA[<a title="Osteoarthritis">*</a>]</label></div>
						    <!-- field chronic_arthritis_spondyloarthropathy type boolean -->
							<div class="checkbox col-md-3"><label>{!! Form::checkbox('chronic_arthritis_spondyloarthropathy') !!}Spondyloarthropathy</label></div>
						</div>

						<!-- field chronic_arthritis_other type string -->
						<div class='col-md-12 form-group'>
							{!! Form::label('chronic_arthritis_other','Other :',['class' => 'control-label col-md-4']) !!}
							<div class='col-md-8'> {!! Form::text('chronic_arthritis_other',null,['class' => 'form-control text_area_feedback', 'placeholder' => 'Other type here', 'maxlength' => '20']) !!} </div>
							<div id="chronic_arthritis_other_feedback" style="color:#b3b3b3" class='col-md-offset-4'></div>
						</div>
					</div>
					<div class="col-md-12"><hr></div>

					<div class='form-group col-md-12'>
						{!! Form::label('SLE','SLE :',['class' => 'control-label col-md-4']) !!}
						<!-- field comorbid_SLE type tinyInteger -->
						<div class='col-md-8'>
							<label class="radio-inline">{!! Form::radio('comorbid_SLE',99) !!}No data</label>
							<label class="radio-inline">{!! Form::radio('comorbid_SLE',0) !!}No</label>
							<label class="radio-inline">{!! Form::radio('comorbid_SLE',1) !!}Yes</label>
						</div>
					</div>
					<div class="col-md-12"><hr></div>

					<div class='form-group col-md-12'>
						{!! Form::label('comorbid_other_autoimmune_disease','Other autoimmune disease :',['class' => 'control-label col-md-4']) !!}
						<!-- field comorbid_other_autoimmune_disease type tinyinteger -->
						<div class='col-md-8'>
							<label class="radio-inline">{!! Form::radio('comorbid_other_autoimmune_disease',99) !!}No data</label>
							<label class="radio-inline">{!! Form::radio('comorbid_other_autoimmune_disease',0) !!}No</label>
							<label class="radio-inline">{!! Form::radio('comorbid_other_autoimmune_disease',1) !!}Yes</label>
						</div>
					</div>
					
					<div class="collapse" id="comorbid_other_autoimmune_disease_collapse">
						<div class='form-group col-md-12'>
							{!! Form::label('other_autoimmune_disease_dx','Diagnosis :',['class' => 'control-label col-md-4']) !!}
							<!-- field other_autoimmune_disease_dx_sjrogren_syndrome type boolean -->
							<div class="checkbox col-md-3"><label>{!! Form::checkbox('other_autoimmune_disease_dx_sjrogren_syndrome') !!}Sjrögren syndrome</label></div>
						    <!-- field other_autoimmune_disease_dx_UCTD type boolean -->
							<div class="checkbox col-md-2"><label>{!! Form::checkbox('other_autoimmune_disease_dx_UCTD') !!}UCTD[<a title="Undifferentiated Connective Tissue Disease">*</a>]</label></div>
						    <!-- field other_autoimmune_disease_dx_MCTD type boolean -->
							<div class="checkbox col-md-2"><label>{!! Form::checkbox('other_autoimmune_disease_dx_MCTD') !!}MCTD[<a title="Mixed Connective Tissue Disease">*</a>]</label></div>
						    <!-- field other_autoimmune_disease_dx_DMPM type boolean -->
							<div class="checkbox col-md-1"><label>{!! Form::checkbox('other_autoimmune_disease_dx_DMPM') !!}DMPM[<a title="Dermato Myositis Poly Myositis">*</a>]</label></div>
						</div>
						
						<div class='col-md-12 form-group'>
							{!! Form::label('other_autoimmune_disease_dx_other','Other diagnosis :',['class' => 'control-label col-md-4']) !!}
							<!-- field other_autoimmune_disease_dx_other type string -->
							<div class='col-md-8'> {!! Form::text('other_autoimmune_disease_dx_other',null,['class' => 'form-control text_area_feedback', 'placeholder' => 'Other type here', 'maxlength' => '20']) !!} </div>
							<div id="other_autoimmune_disease_dx_other_feedback" style="color:#b3b3b3" class='col-md-offset-4'></div>
						</div>
					</div>
					<div class="col-md-12"><hr></div>

					<div class='form-group col-md-12'>
						{!! Form::label('TB','TB :',['class' => 'control-label col-md-4']) !!}
						<!-- field comorbid_TB type tinyInteger -->
						<div class='col-md-8'>
							<label class="radio-inline">{!! Form::radio('comorbid_TB',99) !!}No data</label>
							<label class="radio-inline">{!! Form::radio('comorbid_TB',0) !!}No</label>
							<label class="radio-inline">{!! Form::radio('comorbid_TB',1) !!}Yes</label>
						</div>
					</div>

					<div class="collapse" id="comorbid_TB_collapse">
						<div class='form-group col-md-12'>
							{!! Form::label('TB_organ','Please select :',['class' => 'control-label col-md-4']) !!}
							<!-- field TB_at_pulmonary type boolean -->
							<div class="checkbox col-md-2"><label>{!! Form::checkbox('TB_at_pulmonary') !!}Pulmonary</label></div>
						</div>
						<div class='form-group col-md-12'>
							{!! Form::label('TB_at_other','Other :',['class' => 'control-label col-md-4']) !!}
							<!-- field TB_at_other type string -->
							<div class='col-md-8'> {!! Form::text('TB_at_other',null,['class' => 'form-control text_area_feedback', 'placeholder' => 'Other type here', 'maxlength' => '20']) !!} </div>
							<div id="TB_at_other_feedback" style="color:#b3b3b3" class='col-md-offset-4'></div>
						</div>
					</div>
					<div class="col-md-12"><hr></div>

					<div class='form-group col-md-12'>
						{!! Form::label('dementia','Dementia :',['class' => 'control-label col-md-4']) !!}
						<!-- field comorbid_dementia type tinyInteger -->
						<div class='col-md-8'>
							<label class="radio-inline">{!! Form::radio('comorbid_dementia',99) !!}No data</label>
							<label class="radio-inline">{!! Form::radio('comorbid_dementia',0) !!}No</label>
							<label class="radio-inline">{!! Form::radio('comorbid_dementia',1) !!}Yes</label>
						</div>
					</div>
					<div class="collapse" id="comorbid_dementia_collapse">
						<div class='form-group col-md-12'>
							{!! Form::label('dementia_organ','Please select :',['class' => 'control-label col-md-4']) !!}
							<!-- field dementia_vascular type boolean -->
							<div class="checkbox col-md-2"><label>{!! Form::checkbox('dementia_vascular') !!}Vascular</label></div>
						    <!-- field dementia_alzheimer type boolean -->
							<div class="checkbox col-md-2"><label>{!! Form::checkbox('dementia_alzheimer') !!}Alzheimer</label></div>
						</div>
						<div class='form-group col-md-12'>
							<!-- field dementia_other type string -->
							{!! Form::label('dementia_other','Other :',['class' => 'control-label col-md-4']) !!}
							<div class='col-md-8'> {!! Form::text('dementia_other',null,['class' => 'form-control text_area_feedback', 'placeholder' => 'Other type here', 'maxlength' => '20']) !!} </div>
							<div id="dementia_other_feedback" style="color:#b3b3b3" class='col-md-offset-4'></div>
						</div>
					</div>
					<div class="col-md-12"><hr></div>

					<div class='form-group col-md-12'>
						{!! Form::label('psychiatric_illness','Psychiatric illness :',['class' => 'control-label col-md-4']) !!}
						<!-- field comorbid_psychiatric_illness type tinyInteger -->
						<div class='col-md-8'>
							<label class="radio-inline">{!! Form::radio('comorbid_psychiatric_illness',99) !!}No data</label>
							<label class="radio-inline">{!! Form::radio('comorbid_psychiatric_illness',0) !!}No</label>
							<label class="radio-inline">{!! Form::radio('comorbid_psychiatric_illness',1) !!}Yes</label>
						</div>
					</div>
					<div class="collapse" id="comorbid_psychiatric_illness_collapse">
						<div class='form-group col-md-12'>
							{!! Form::label('psychiatric_illness_organ','Diagnosis :',['class' => 'control-label col-md-4']) !!}
							<!-- field psychiatric_illness_dx_schizophrenia type boolean -->
							<div class="checkbox col-md-2"><label>{!! Form::checkbox('psychiatric_illness_dx_schizophrenia') !!}Schizophrenia</label></div>
						    <!-- field psychiatric_illness_dx_major_depression type boolean -->
							<div class="checkbox col-md-2"><label>{!! Form::checkbox('psychiatric_illness_dx_major_depression') !!}Major depression</label></div>
						    <!-- field psychiatric_illness_dx_bipolar_disorder type boolean -->
							<div class="checkbox col-md-2"><label>{!! Form::checkbox('psychiatric_illness_dx_bipolar_disorder') !!}Bipolar disorder</label></div>
						</div>
						<div class='form-group col-md-12'>
							{!! Form::label('psychiatric_illness_organ',' ',['class' => 'control-label col-md-4']) !!}
						    <!-- field psychiatric_illness_dx_adjustment_disorder type boolean -->
							<div class="checkbox col-md-3"><label>{!! Form::checkbox('psychiatric_illness_dx_adjustment_disorder') !!}Adjustment disorder</label></div>
						    <!-- field psychiatric_illness_dx_Obcessive_compulsive_disorder type boolean -->
							<div class="checkbox col-md-4"><label>{!! Form::checkbox('psychiatric_illness_dx_Obcessive_compulsive_disorder') !!}Obcessive compulsive disorder</label></div>
						</div>
						<div class='col-md-12 form-group'>
							{!! Form::label('psychiatric_illness_dx_other','Other :',['class' => 'control-label col-md-4']) !!}
							<!-- field psychiatric_illness_dx_other type string -->
							<div class='col-md-8'> {!! Form::text('psychiatric_illness_dx_other',null,['class' => 'form-control text_area_feedback', 'placeholder' => 'Other type here', 'maxlength' => '20']) !!} </div>
							<div id="psychiatric_illness_dx_other_feedback" style="color:#b3b3b3" class='col-md-offset-4'></div>
						</div>
					</div>
					<div class="col-md-12"><hr></div>

					<!-- field comorbid_other type text -->
					<div class='col-md-12 form-group'>
						{!! Form::label('comorbid_other','Other co-morbid :',['class' => 'control-label col-md-4']) !!}
						<div class='col-md-8'> {!! Form::textarea('comorbid_other',null,['class' => 'form-control text_area_feedback', 'placeholder' => 'Other type here','rows' => '1', 'maxlength' => '20']) !!} </div>
						<div id="comorbid_other_feedback" style="color:#b3b3b3" class='col-md-offset-4'></div>
					</div>
	            </div><!-- end collapse Comorbid list -->
	            <div class="col-md-12"><hr></div>

	            <!-- field history_present_illness type text -->
				<div class='form-group col-md-12'>
					{!! Form::label('history_present_illness','History of present illness :',['class' => 'control-label']) !!}
					{!! Form::textarea('history_present_illness',null,['class' => 'form-control text_area_feedback', 'rows' => '1', 'id' => 'history_present_illness', 'maxlength' => '65535']) !!}
					<div id="history_present_illness_feedback" style="color:#b3b3b3"></div>
				</div>

				<!-- field history_past_illness type text -->
				<div class='form-group col-md-12'>
					{!! Form::label('history_past_illness','History of past illness :',['class' => 'control-label']) !!}
					{!! Form::textarea('history_past_illness',null,['class' => 'form-control text_area_feedback', 'rows' => '1', 'id' => 'history_past_illness', 'maxlength' => '65535']) !!}
					<div id="history_past_illness_feedback" style="color:#b3b3b3"></div>
				</div>
			</div>
		</div><!-- end panel co-morbid -->
		<!-- panel Personal and Social history -->
		<div class="panel panel-info">
			<div class="panel-heading">Personal and Social history</div>
			<div class="panel-body">
				<div class="form-horizontal row">
					@if (session('patient_gender') == 'หญิง')
					<!-- <div class="collapse" id="woman_only"> -->
					
					<!-- field pregnant type tinyInteger -->
					<div class="col-md-7 form-group">
						{!! Form::label('','Pregnant :',['class' => 'col-md-4 control-label']) !!}
						<div class='col-md-2'><label class="radio-inline">{!! Form::radio('pregnant',0) !!}No</label></div>
						<div class='col-md-2'><label class="radio-inline">{!! Form::radio('pregnant',1) !!}Yes</label></div>
						<div class='col-md-2'><label class="radio-inline">{!! Form::radio('pregnant',99) !!}Uncertain</label></div>
					</div>
					<!-- field pregnant_weeks type tinyInteger -->
					<div class="form-group col-md-5">
						{!! Form::label('','Gastation :',['class' => 'col-md-6 control-label']) !!}
						<div class='col-md-6'><div class='input-group'>{!! Form::input('number','pregnant_weeks',null,['class' => 'form-control', 'readonly']) !!}<span class="input-group-addon">Weeks</span></div></div>
					</div>
					<!-- field LMP type text -->
					<div class="form-group col-md-7">
						{!! Form::label('','LMP :',['class' => 'col-md-4 control-label']) !!}
						<div class='col-md-8'>{!! Form::text('LMP',null,['class' => 'form-control', 'placeholder' => 'dd/mm/yyyy or describe...', 'title' => 'ลงข้อมูล LMP เป็นวันที่ในรูปแบบ dd/mm/yyyy หรือหากไม่ทราบให้บรรยายเช่น 10 ปีที่ผ่านมา เป็นต้น']) !!}</div>
					</div>
					<div class="col-md-12"><hr></div>
					<!-- end of women_only collapse -->
					@endif
					<div class="row col-md-offset-5"></div>
					<!-- field alcohol type tinyInteger -->
					<div class="col-md-7 form-group">
						{!! Form::label('alcohol','Alcohol :',['class' => 'col-md-4 control-label']) !!}
						<div class='col-md-2'><label class="radio-inline">{!! Form::radio('alcohol',0) !!}No</label></div>
						<div class='col-md-2'><label class="radio-inline">{!! Form::radio('alcohol',1) !!}Yes</label></div>
						<div class='col-md-3'><label class="radio-inline">{!! Form::radio('alcohol',2) !!}Ex-drinker</label></div>
					</div>
					<div class="row col-md-offset-5"></div>
					<div class="collapse col-md-12" id="alcoholHelperTemplate">@include('medicine.notes.admission.template.alcohol')</div>
					<!-- field alcohol_amount type text -->
					<div class="form-group col-md-7">
						{!! Form::label('','Drink amount :',['class' => 'col-md-4 control-label']) !!}
						<div class='col-md-8'>{!! Form::textarea('alcohol_amount',null,['class' => 'form-control', 'id' => 'taalcoholAmountReviewDetail', 'rows' => '1', 'readonly']) !!}</div>
					</div>
					<div class="col-md-12"><hr></div>
					<!-- field smoking type tinyInteger -->
					<div class="col-md-7 form-group">
						{!! Form::label('smoking','Cigarette smoking :',['class' => 'col-md-4 control-label']) !!}
						<div class='col-md-2'><label class="radio-inline">{!! Form::radio('smoking',0) !!}No</label></div>
						<div class='col-md-2'><label class="radio-inline">{!! Form::radio('smoking',1) !!}Yes</label></div>
						<div class='col-md-3'><label class="radio-inline">{!! Form::radio('smoking',2) !!}Ex-smoker</label></div>
					</div>
					<div class="row col-md-offset-5"></div>
					<div class="collapse col-md-12" id="smokingHelperTemplate">@include('medicine.notes.admission.template.smoking')</div>
					<!-- field smoking_amount type text -->
					<div class="form-group col-md-7">
						{!! Form::label('','Smoke amount :',['class' => 'col-md-4 control-label']) !!}
						<div class='col-md-8'>
							{!! Form::textarea('smoking_amount',null,['class' => 'form-control', 'id' => 'tasmokingAmountReviewDetail', 'rows' => '1', 'readonly']) !!}
						</div>
					</div>
				</div><!-- end Personal and Social history row part-->
				<div><hr></div>
				<!-- field personal_social_history type text -->
				<div class='form-group'>
					{!! Form::label('personal_social_history','Personal and social history :',['class' => 'control-label']) !!}
					{!! Form::textarea('personal_social_history',null,['class' => 'form-control text_area_feedback', 'rows' => '1', 'maxlength' => '20']) !!}
					<div id="personal_social_history_feedback" style="color:#b3b3b3"></div>
				</div><!-- end textarea personal_social_history -->
			</div><!-- panel body -->
		</div><!-- panel Personal and Social history -->
		<div class="panel panel-info">
			<div class="panel-heading">Special requirement</div>
			<div class="panel-body">
				<div class="form-horizontal row col-md-12">
					<!-- field special_requirement_ng_tube type boolean -->
				    <div class="checkbox col-md-3"><label>{!! Form::checkbox('special_requirement_ng_tube') !!}NG tube</label></div>
				    <!-- field special_requirement_ng_suction type boolean -->
				    <div class="checkbox col-md-3"><label>{!! Form::checkbox('special_requirement_ng_suction') !!}NG suction</label></div>
				    <!-- field special_requirement_gastrostomy type boolean -->
				    <div class="checkbox col-md-3"><label>{!! Form::checkbox('special_requirement_gastrostomy') !!}Gastrostomy feeding</label></div>
				    <!-- field special_requirement_urinary_cath type boolean -->
				    <div class="checkbox col-md-3"><label>{!! Form::checkbox('special_requirement_urinary_cath') !!}Urinary cath. care</label></div>
				    <!-- field special_requirement_tracheostomy type boolean -->
				    <div class="checkbox col-md-3"><label>{!! Form::checkbox('special_requirement_tracheostomy') !!}Tracheostomy care</label></div>
				    <!-- field special_requirement_hearing_impairment type boolean -->
				    <div class="checkbox col-md-3"><label>{!! Form::checkbox('special_requirement_hearing_impairment') !!}Hearing impaiment</label></div>
				    <!-- field special_requirement_isolate_room type boolean -->
					<div class="checkbox col-md-3"><label>{!! Form::checkbox('special_requirement_isolate_room') !!}Isolation room</label></div>
				</div>
				<div class="col-md-12"><br/></div>
				<!-- field special_requirement_other type string -->
				<div class='form-group'>
					{!! Form::label('special_requirement_other','Other special requirement :',['class' => 'control-label']) !!}
					{!! Form::text('special_requirement_other',null,['class' => 'form-control text_area_feedback','maxlength' => '20']) !!}
					<div id="special_requirement_other_feedback" style="color:#b3b3b3"></div>
				</div>
			</div><!-- panel body -->
		</div><!-- end panel special_requirement -->
		<div class="panel panel-info">
			<div class="panel-heading">Family history</div>
			<!-- field personal_family_history type text -->
			<div class="panel-body">
				{!! Form::textarea('personal_family_history',null,['class' => 'form-control text_area_feedback','rows' => '1', 'id' => 'personal_family_history', 'maxlength' => '20']) !!}
				<div id="personal_family_history_feedback" style="color:#b3b3b3"></div>
			</div>
		</div><!-- end panel family history -->
		<div class="panel panel-info">
			<div class="panel-heading">Current medications </div>
			<div class="panel-body">
				<div class='well'>
					<div class='form-group col-md-6'>{!! Form::text('current_medications_suggest',null,['class' => 'form-control ui-widget', 'placeholder' => 'type to auto-complete', 'id' => 'current_medications_suggest']) !!}</div>
					<button type="button" class="btn btn-primary tools" id="addmed">Add</button>
				</div>
				<!-- field current_medications type text -->
				{!! Form::textarea('current_medications',null,['class' => 'form-control text_area_feedback','rows' => '1','id' => 'current_medications', 'maxlength' => '500']) !!}
				<div id="current_medications_feedback" style="color:#b3b3b3"></div>
			</div>
		</div><!-- end panel Current medications  -->
		<div class="panel panel-info">
			<div class="panel-heading">Allergy/Adverse event (Drug, Food, Chemical)</div>
			<!-- field allergy type text -->
			<div class="panel-body">
				{!! Form::textarea('allergy',null,['class' => 'form-control text_area_feedback','rows' => '1', 'id' => 'allergy', 'maxlength' => '20']) !!}
				<div id="allergy_feedback" style="color:#b3b3b3"></div>
			</div>
		</div><!-- end panel allergy  -->
		<div class="panel panel-info">
			<div class="panel-heading">Review of systems</div>
			<div class="panel-body">
				<!-- field general_symtoms type text -->
				<div class='form-group'>
					<label class="control-label" for="general_symtoms">General symtoms : Detail of important findings [<a onclick="toggleTemplate('#gsgCollapse')">Template</a>]</label>
					<div class="collapse col-md-12" id="gsgCollapse">@include('medicine.notes.admission.template.review.generalSymtomsGenerator')</div>
					{!! Form::textarea('general_symtoms',null,['class' => 'form-control', 'id' => 'tagsg','rows' => '1']) !!}
				</div>
				<div><hr></div>
				<!-- field hair_skin_review type tinyInteger -->
				<div class="form-horizontal row">
					<div class="col-md-12 form-group">
						<label class="col-md-4 control-label">Hair and Skin [<a onclick="$('#hair').collapse('toggle');" title="Click to Show/Hide detail">Detail</a>] :</label>
						<div class='col-md-1'><label class="radio-inline">{!! Form::radio('hair_skin_review',1) !!}Normal</label></div>
						<div class='col-md-2'><label class="radio-inline">{!! Form::radio('hair_skin_review',0) !!}Abnormal</label></div>
						<label class="control-label" for="hair_skin_review_detail">[<a onclick="toggleTemplate('#hairSkinReviewGenCollapse')">Template</a>]</label>
					</div>
				</div>
				<!-- field hair_skin_review_detail type text -->
				<div class='collapse in form-group' id="hair">					
					<div class="collapse col-md-12" id="hairSkinReviewGenCollapse">@include('medicine.notes.admission.template.review.hairSkinReviewGenerator')</div>
					{!! Form::textarea('hair_skin_review_detail',null,['class' => 'form-control', 'id' => 'tahairSkinReviewDetail','rows' => '1']) !!}
				</div>
				<div><hr></div>
				<!-- field head_review type tinyInteger -->
				<div class="form-horizontal row">
					<div class="col-md-12 form-group">
						<label class="col-md-4 control-label">Head [<a onclick="$('#headReview').collapse('toggle');" title="Click to Show/Hide detail">Detail</a>] :</label>
						<div class='col-md-1'><label class="radio-inline">{!! Form::radio('head_review',1) !!}Normal</label></div>
						<div class='col-md-2'><label class="radio-inline">{!! Form::radio('head_review',0) !!}Abnormal</label></div>
						<label class="control-label" for="head_review_detail">[<a onclick="toggleTemplate('#hrgCollapse')">Template</a>]</label>
					</div>
				</div>
				<!-- field head_review_detail type text -->
				<div class='collapse in form-group' id="headReview">					
					<div class="collapse col-md-12" id="hrgCollapse">@include('medicine.notes.admission.template.review.headReviewGenerator')</div>
					{!! Form::textarea('head_review_detail',null,['class' => 'form-control', 'id' => 'tahrg','rows' => '1']) !!}
				</div>
				<div><hr></div>
				<!-- field eye_ent_review type tinyInteger -->
				<div class="form-horizontal row">
					<div class="col-md-12 form-group">
						<label class="col-md-4 control-label">Eye/ENT [<a onclick="$('#eyeENT').collapse('toggle');" title="Click to Show/Hide detail">Detail</a>] :</label>
						<div class='col-md-1'><label class="radio-inline">{!! Form::radio('eye_ent_review',1) !!}Normal</label></div>
						<div class='col-md-2'><label class="radio-inline">{!! Form::radio('eye_ent_review',0) !!}Abnormal</label></div>
						<label class="control-label" for="eye_ent_review_detail">[<a onclick="toggleTemplate('#eyeENTReviewGenCollapse')">Template</a>]</label>
					</div>
				</div>
				<!-- field eye_ent_review_detail type text -->
				<div class='collapse in form-group' id="eyeENT">					
					<div class="collapse col-md-12" id="eyeENTReviewGenCollapse">@include('medicine.notes.admission.template.review.eyeENTReviewGenerator')</div>
					{!! Form::textarea('eye_ent_review_detail',null,['class' => 'form-control', 'id' => 'taeyeENTReviewDetail','rows' => '1']) !!}
				</div>
				<div><hr></div>
				<!-- field breast_review type tinyInteger -->
				@if (session('patient_gender') == 'หญิง')
				<div class="form-horizontal row">
					<div class="col-md-12 form-group">
						<label class="col-md-4 control-label">Breast [<a onclick="$('#breast').collapse('toggle');" title="Click to Show/Hide detail">Detail</a>] :</label>
						<div class='col-md-1'><label class="radio-inline">{!! Form::radio('breast_review',1) !!}Normal</label></div>
						<div class='col-md-2'><label class="radio-inline">{!! Form::radio('breast_review',0) !!}Abnormal</label></div>
						<label class="control-label" for="breast_review_detail">[<a onclick="toggleTemplate('#breastReviewGenCollapse')">Template</a>]</label>
					</div>
				</div>
				<!-- field breast_review_detail type text -->
				<div class='collapse in form-group' id="breast">					
					<div class="collapse col-md-12" id="breastReviewGenCollapse">@include('medicine.notes.admission.template.review.breastReviewGenerator')</div>
					{!! Form::textarea('breast_review_detail',null,['class' => 'form-control', 'id' => 'tabreastReviewDetail','rows' => '1']) !!}
				</div>
				<div><hr></div>
				@endif
				<!-- field cvs_review type tinyInteger -->
				<div class="form-horizontal row">
					<div class="col-md-12 form-group">
						<label class="col-md-4 control-label">CVS [<a onclick="$('#cvs').collapse('toggle');" title="Click to Show/Hide detail">Detail</a>] :</label>
						<div class='col-md-1'><label class="radio-inline">{!! Form::radio('cvs_review',1) !!}Normal</label></div>
						<div class='col-md-2'><label class="radio-inline">{!! Form::radio('cvs_review',0) !!}Abnormal</label></div>
						<label class="control-label" for="cvs_review_detail">[<a onclick="toggleTemplate('#cvsReviewGenCollapse')">Template</a>]</label>
					</div>
				</div>
				<!-- field cvs_review_detail type text -->
				<div class='collapse in form-group' id="cvs">					
					<div class="collapse col-md-12" id="cvsReviewGenCollapse">@include('medicine.notes.admission.template.review.cvsReviewGenerator')</div>
					{!! Form::textarea('cvs_review_detail',null,['class' => 'form-control', 'id' => 'tacvsReviewDetail','rows' => '1']) !!}
				</div>
				<div><hr></div>
				<!-- field rs_review type tinyInteger -->
				<div class="form-horizontal row">
					<div class="col-md-12 form-group">
						<label class="col-md-4 control-label">RS [<a onclick="$('#rs').collapse('toggle');" title="Click to Show/Hide detail">Detail</a>] :</label>
						<div class='col-md-1'><label class="radio-inline">{!! Form::radio('rs_review',1) !!}Normal</label></div>
						<div class='col-md-2'><label class="radio-inline">{!! Form::radio('rs_review',0) !!}Abnormal</label></div>
						<label class="control-label" for="rs_review_detail">[<a onclick="toggleTemplate('#rsReviewGenCollapse')">Template</a>]</label>
					</div>
				</div>
				<!-- field rs_review_detail type text -->
				<div class='collapse in form-group' id="rs">					
					<div class="collapse col-md-12" id="rsReviewGenCollapse">@include('medicine.notes.admission.template.review.rsReviewGenerator')</div>
					{!! Form::textarea('rs_review_detail',null,['class' => 'form-control', 'id' => 'tarsReviewDetail','rows' => '1']) !!}
				</div>
				<div><hr></div>
				<!-- field gi_review type tinyInteger -->
				<div class="form-horizontal row">
					<div class="col-md-12 form-group">
						<label class="col-md-4 control-label">GI [<a onclick="$('#gi').collapse('toggle');" title="Click to Show/Hide detail">Detail</a>] :</label>
						<div class='col-md-1'><label class="radio-inline">{!! Form::radio('gi_review',1) !!}Normal</label></div>
						<div class='col-md-2'><label class="radio-inline">{!! Form::radio('gi_review',0) !!}Abnormal</label></div>
						<label class="control-label" for="gi_review_detail">[<a onclick="toggleTemplate('#giReviewGenCollapse')">Template</a>]</label>
					</div>
				</div>
				<!-- field gi_review_detail type text -->
				<div class='collapse in form-group' id="gi">					
					<div class="collapse col-md-12" id="giReviewGenCollapse">@include('medicine.notes.admission.template.review.giReviewGenerator')</div>
					{!! Form::textarea('gi_review_detail',null,['class' => 'form-control', 'id' => 'tagiReviewDetail','rows' => '1']) !!}
				</div>
				<div><hr></div>
				<!-- field gu_review type tinyInteger -->
				<div class="form-horizontal row">
					<div class="col-md-12 form-group">
						<label class="col-md-4 control-label">GU [<a onclick="$('#gu').collapse('toggle');" title="Click to Show/Hide detail">Detail</a>] :</label>
						<div class='col-md-1'><label class="radio-inline">{!! Form::radio('gu_review',1) !!}Normal</label></div>
						<div class='col-md-2'><label class="radio-inline">{!! Form::radio('gu_review',0) !!}Abnormal</label></div>
						<label class="control-label" for="gu_review_detail">[<a onclick="toggleTemplate('#guReviewGenCollapse')">Template</a>]</label>
					</div>
				</div>
				<!-- field gu_review_detail type text -->
				<div class='collapse in form-group' id="gu">					
					<div class="collapse col-md-12" id="guReviewGenCollapse">@include('medicine.notes.admission.template.review.guReviewGenerator')</div>
					{!! Form::textarea('gu_review_detail',null,['class' => 'form-control', 'id' => 'taguReviewDetail','rows' => '1']) !!}
				</div>
				<div><hr></div>
				<!-- field musculoskeletal_review type tinyInteger -->
				<div class="form-horizontal row">
					<div class="col-md-12 form-group">
						<label class="col-md-4 control-label">Musculoskeletal system [<a onclick="$('#musculoskeletal').collapse('toggle');" title="Click to Show/Hide detail">Detail</a>] :</label>
						<div class='col-md-1'><label class="radio-inline">{!! Form::radio('musculoskeletal_review',1) !!}Normal</label></div>
						<div class='col-md-2'><label class="radio-inline">{!! Form::radio('musculoskeletal_review',0) !!}Abnormal</label></div>
						<label class="control-label" for="musculoskeletal_review_detail">[<a onclick="toggleTemplate('#musculoskeletalReviewGenCollapse')">Template</a>]</label>
					</div>
				</div>
				<!-- field musculoskeletal_review_detail type text -->
				<div class='collapse in form-group' id="musculoskeletal">					
					<div class="collapse col-md-12" id="musculoskeletalReviewGenCollapse">@include('medicine.notes.admission.template.review.musculoskeletalReviewGenerator')</div>
					{!! Form::textarea('musculoskeletal_review_detail',null,['class' => 'form-control', 'id' => 'tamusculoskeletalReviewDetail','rows' => '1']) !!}
				</div>
				<div><hr></div>
				<!-- field nervous_review type tinyInteger -->
				<div class="form-horizontal row">
					<div class="col-md-12 form-group">
						<label class="col-md-4 control-label">Nervous system [<a onclick="$('#nervous').collapse('toggle');" title="Click to Show/Hide detail">Detail</a>] :</label>
						<div class='col-md-1'><label class="radio-inline">{!! Form::radio('nervous_review',1) !!}Normal</label></div>
						<div class='col-md-2'><label class="radio-inline">{!! Form::radio('nervous_review',0) !!}Abnormal</label></div>
						<label class="control-label" for="nervous_review_detail">[<a onclick="toggleTemplate('#nervousReviewGenCollapse')">Template</a>]</label>
					</div>
				</div>
				<!-- field nervous_review_detail type text -->
				<div class='collapse in form-group' id="nervous">					
					<div class="collapse col-md-12" id="nervousReviewGenCollapse">@include('medicine.notes.admission.template.review.nervousReviewGenerator')</div>
					{!! Form::textarea('nervous_review_detail',null,['class' => 'form-control', 'id' => 'tanervousReviewDetail','rows' => '1']) !!}
				</div>
				<div><hr></div>
				<!-- field psychological_review type tinyInteger -->
				<div class="form-horizontal row">
					<div class="col-md-12 form-group">
						<label class="col-md-4 control-label">Psychological symptom [<a onclick="$('#psychological').collapse('toggle');" title="Click to Show/Hide detail">Detail</a>] :</label>
						<div class='col-md-1'><label class="radio-inline">{!! Form::radio('psychological_review',1) !!}Normal</label></div>
						<div class='col-md-2'><label class="radio-inline">{!! Form::radio('psychological_review',0) !!}Abnormal</label></div>
						<label class="control-label" for="psychological_review_detail">[<a onclick="toggleTemplate('#psychologicalReviewGenCollapse')">Template</a>]</label>
					</div>
				</div>
				<!-- field psychological_review_detail type text -->
				<div class='collapse in form-group' id="psychological">					
					<div class="collapse col-md-12" id="psychologicalReviewGenCollapse">@include('medicine.notes.admission.template.review.psychologicalReviewGenerator')</div>
					{!! Form::textarea('psychological_review_detail',null,['class' => 'form-control', 'id' => 'tapsychologicalReviewDetail','rows' => '1']) !!}
				</div>
				<div><hr></div>
				<!-- field system_review_other type text -->
				<div class='form-group'>
					{!! Form::label('system_review_other','Other :',['class' => 'control-label']) !!}
					{!! Form::textarea('system_review_other','',['class' => 'form-control','rows' => '1']) !!}
				</div>
			</div>
		</div><!-- end of Review of systems -->
	</div>
</div><!-- end of History -->
<div class="panel panel-primary">
	<div class="panel-heading">Physical examination and investigation</div> 
	<div class="panel-body">
		<div class="panel panel-info">
			<div class="panel-heading">Vital signs</div>
			<div class="panel-body">
				<div class="form-horizontal row">
					<!-- field temperature type decimal -->
					<div class='col-md-6 form-group'>
						{!! Form::label('temperature','Temperature :',['class' => 'control-label col-md-6']) !!}
						<div class='col-md-6'><div class='input-group'>{!! Form::input('number','temperature',null,['class' => 'form-control']) !!}<span class="input-group-addon">&deg;C</span></div></div>
					</div>
					<!-- field pulse type decimal -->
					<div class='col-md-6 form-group'>
						{!! Form::label('pulse','Pulse :',['class' => 'control-label col-md-6']) !!}
						<div class='col-md-6'><div class='input-group'>{!! Form::input('number','pulse',null,['class' => 'form-control']) !!}<span class="input-group-addon">/min</span></div></div>
					</div>
					<!-- field respiratory_rate type decimal -->
					<div class='col-md-6 form-group'>
						{!! Form::label('respiratory_rate','Respiratory rate :',['class' => 'control-label col-md-6']) !!}
						<div class='col-md-6'><div class='input-group'>{!! Form::input('number','respiratory_rate',null,['class' => 'form-control']) !!}<span class="input-group-addon">/min</span></div></div>
					</div><div class="row col-md-offset-6"></div>
					<!-- field SBP type decimal -->
					<div class='col-md-6 form-group'>
						{!! Form::label('SBP','SBP :',['class' => 'control-label col-md-6']) !!}
						<div class='col-md-6'><div class='input-group'>{!! Form::input('number','SBP',null,['class' => 'form-control']) !!}<span class="input-group-addon">mmHg</span></div></div>
					</div>
					<!-- field DBP type decimal -->
					<div class='col-md-6 form-group'>
						{!! Form::label('DBP','DBP :',['class' => 'control-label col-md-6']) !!}
						<div class='col-md-6'><div class='input-group'>{!! Form::input('number','DBP',null,['class' => 'form-control']) !!}<span class="input-group-addon">mmHg</span></div></div>
					</div>
					<!-- field height type decimal -->
					<div class='col-md-6 form-group'>
						{!! Form::label('height','Height :',['class' => 'control-label col-md-6']) !!}
						<div class='col-md-6'><div class='input-group'>{!! Form::input('number','height',null,['class' => 'form-control bmi']) !!}<span class="input-group-addon">cm.</span></div></div>
					</div>
					<div class='col-md-6 form-group'>
						{!! Form::label('orientation','Not actual measurement :',['class' => 'control-label col-md-6', 'id' => 'orientation']) !!}
						<!-- field estimated_height type boolean -->
						<div class="checkbox col-md-6"><label>{!! Form::checkbox('estimated_height') !!}Estimated Height</label></div>
					</div><div class="col-md-12"></div>
					<!-- field weight type decimal -->
					<div class='col-md-6 form-group'>
						{!! Form::label('weight','Weight :',['class' => 'control-label col-md-6']) !!}
						<div class='col-md-6'><div class='input-group'>{!! Form::input('number','weight',null,['class' => 'form-control bmi']) !!}<span class="input-group-addon">kg.</span></div></div>
					</div>
					<div class='col-md-6 form-group'>
						{!! Form::label('orientation','Not actual measurement :',['class' => 'control-label col-md-6', 'id' => 'orientation']) !!}
					    <!-- field estimated_weight type boolean -->
						<div class="checkbox col-md-6"><label>{!! Form::checkbox('estimated_weight') !!}Estimated Weight</label></div>
					</div>
					<!-- field BMI type decimal -->
					<div class='col-md-6 form-group'>
						{!! Form::label('BMI','BMI :',['class' => 'control-label col-md-6']) !!}
						<div class='col-md-6'><div class='input-group'>{!! Form::input('number','BMI',null,['class' => 'form-control', 'readonly']) !!}<span class="input-group-addon">kg/m<sup>2</sup></span></div></div>
					</div>
					<!-- field spo2 type decimal -->
					<div class='col-md-6 form-group'>
						<label class="control-label col-md-6">O<sub>2</sub> saturation :</label>
						<div class='col-md-6'><div class='input-group'>{!! Form::input('number','spo2',null,['class' => 'form-control']) !!}<span class="input-group-addon" title="as indicated">%</span></div></div>
					</div>
					<!-- field breathing type tinyInteger -->
					<div class='col-md-12 form-group'>
						{!! Form::label('breathing','Breathing :',['class' => 'control-label col-md-3']) !!}
						<div class='col-md-9'>
						    <label class="radio-inline">{!! Form::radio('breathing',1) !!}Room air</label>
						    <label class="radio-inline">{!! Form::radio('breathing',2) !!}O<sub>2</sub></label>
						</div>
					</div>
					<!-- <div class="collapse from-group" id="breathing_o2"> -->
						<!-- field breathing_on type tinyInteger -->
						<div class='col-md-12 form-group collapse breathing_o2'>
							{!! Form::label('breathing_on','Breathing on :',['class' => 'control-label col-md-3']) !!}
							<div class='col-md-9'>
								<label class="radio-inline">{!! Form::radio('breathing_on',1) !!}Canula</label>
							    <label class="radio-inline">{!! Form::radio('breathing_on',2) !!}Mask with bag</label>
							    <label class="radio-inline">{!! Form::radio('breathing_on',3) !!}On ventilator</label>
							</div>
						</div>
						<!-- field o2_rate type decimal -->
						<div class='col-md-12 form-group collapse breathing_o2'>
							<label class="control-label col-md-3">O<sub>2</sub> rate :</label>
							<div class='col-md-3'><div class='input-group'>{!! Form::input('number','o2_rate',null,['class' => 'form-control']) !!}<span class="input-group-addon" id='o2unit'></span></div></div>
						</div>
					<!-- </div> -->
					<!-- field conscious_level type tinyInteger -->
					<div class='col-md-12 form-group'>
						{!! Form::label('conscious_level','Level of consciousness :',['class' => 'control-label col-md-3']) !!}
						<div class='col-md-9'>
							<label class="radio-inline">{!! Form::radio('conscious_level',1) !!}Appropriate</label>
							<label class="radio-inline">{!! Form::radio('conscious_level',2) !!}Retardation</label>
							<label class="radio-inline">{!! Form::radio('conscious_level',3) !!}Depressed</label>
							<label class="radio-inline">{!! Form::radio('conscious_level',4) !!}Psychotic</label>
						</div>
					</div>
					<div class='col-md-12 form-group'>
						<label class='control-label col-md-3'>GCS[<a title='Glassglow coma score'>*</a>] :</label>
						<div class='col-md-4'>
							{!! Form::label('GCS_E','E:',['class' => 'control-label col-md-2']) !!}
			                <!-- field GCS_E type tinyInteger -->
			                <div class='col-md-10'>
			                    <select class="form-control" name='GCS_E' onchange='setGCS();'>
			                        <option selected disabled hidden value=''></option>
			                        <option value="1">[1] No eye opening , ไม่ลืมตา </option>
			                        <option value="2">[2] Eye open to pressure/pain </option>
			                        <option value="3">[3] Eye open to sound </option>
			                        <option value="4">[4] Spontaneous eye opening </option>
			                    </select>
			                </div>
		                </div>

		                <div class='col-md-4'>
							{!! Form::label('GCS_V','V:',['class' => 'control-label col-md-2']) !!}
			                <!-- field GCS_V type tinyInteger -->
			                <div class='col-md-10'>
			                    <select class="form-control" name='GCS_V' onchange='setGCS();'>
			                        <option selected disabled hidden value=''></option>
			                        <option value="1">[1] Not response to pain, ไม่ส่งเสียง </option>
			                        <option value="2">[2] Incomprehensible sounds ส่งเสียงไม่เป็นคำ </option>
			                        <option value="3">[3] Inappropriate words พูดคำไม่มีความหมาย </option>
			                        <option value="4">[4] Disoriented / confused สับสน </option>
			                        <option value="5">[5] Oriented พูดรู้เรื่อง </option>
			                    </select>
			                </div>
		                </div>
		            </div>
		            <div class='col-md-12 form-group'>
						<label class='control-label col-md-3'> </label>
		                <div class='col-md-4'>
							{!! Form::label('GCS_M','M:',['class' => 'control-label col-md-2']) !!}
			                <!-- field GCS_M type tinyInteger -->
			                <div class='col-md-10'>
			                    <select class="form-control" name='GCS_M' onchange='setGCS();'>
			                        <option selected disabled hidden value=''></option>
			                        <option value="1">[1] Not response to pain, ไม่เคลื่อนไหว </option>
			                        <option value="2">[2] Decerebrates</option>
			                        <option value="3">[3] Decorticates</option>
			                        <option value="4">[4] Semi-purposeful ตอบสนองต่อ pain ระบุตำแหน่งไม่ได้</option>
			                        <option value="5">[5] Localizes pain ตอบสนองต่อ pain ระบุตำแหน่งได้</option>
			                        <option value="6">[6] Obey ทำตามสั่งได้</option>
			                    </select>
			                </div>
		                </div>
		                <div class='col-md-4'>
							{!! Form::label('GCS_tot',' ',['class' => 'control-label col-md-2']) !!}
			                <!-- field GCS_tot type tinyInteger -->
			                <div class='col-md-10 GCS_tot'>
			                    <select class="form-control" name='GCS_tot' disabled>
			                        <option selected disabled hidden value='0'></option>
			                        <option value="1">Minor [13 <= GCS <= 15]</option>
			                        <option value="2">Moderate [9 <= GCS < 13]</option>
			                        <option value="3">Severe [GCS < 9]</option>
			                    </select>
			                </div>
		                </div>
					</div> <!-- end of Glassglow comma score -->
					<div class='col-md-12 form-group'>
						{!! Form::label('mental_evaluate','Mental evaluation :',['class' => 'control-label col-md-3']) !!}
						<!-- field mental_evaluate type tinyInteger -->
						<div class='col-md-9'>
							<label class="radio-inline">{!! Form::radio('mental_evaluate',1) !!}Awake</label>
							<label class="radio-inline">{!! Form::radio('mental_evaluate',2) !!}Drowsy</label>
							<label class="radio-inline">{!! Form::radio('mental_evaluate',3) !!}Stuporous</label>
							<label class="radio-inline">{!! Form::radio('mental_evaluate',4) !!}Unconscious</label>
						</div>
					</div>
					<div class='col-md-12 form-group'>
						{!! Form::label('orientation','Orientation to :',['class' => 'control-label col-md-3', 'id' => 'orientation']) !!}
						<!-- field orientation_time type boolean -->
						<div class="checkbox col-md-1"><label>{!! Form::checkbox('orientation_time') !!}Time</label></div>
					    <!-- field orientation_place type boolean -->
						<div class="checkbox col-md-1"><label>{!! Form::checkbox('orientation_place') !!}Place</label></div>
					    <!-- field orientation_person type boolean -->
						<div class="checkbox col-md-1"><label>{!! Form::checkbox('orientation_person') !!}Person</label></div>
					</div>
				</div><!-- end of vital sign form -->
			</div><!-- end of vital signs panel body -->
		</div><!-- end of Vital signs panel -->
	
		<div class="panel panel-info">
			<div class="panel-heading">Physical examination</div> 
			<div class="panel-body">
				<!-- field general_appearance type text -->
				<div class='form-group'>
					<label class="control-label" for="general_appearance">General appearance [<a onclick="toggleTemplate('#gagCollapse')">Template</a>]</label>
					<div class="collapse col-md-12" id="gagCollapse">@include('medicine.notes.admission.template.exam.generalAppearanceGenerator')</div>
					{!! Form::textarea('general_appearance',null,['class' => 'form-control', 'id' => 'tagag','rows' => '1']) !!}
				</div><div><hr></div>
				<!-- field skin_exam type tinyInteger -->
				<div class="form-horizontal row">
					<div class="col-md-12 form-group">
						<label class="col-md-3 control-label">Skin [<a onclick="$('#skin_exam').collapse('toggle');" title="Click to Show/Hide detail">Detail</a>] :</label>
						<div class='col-md-1'><label class="radio-inline">{!! Form::radio('skin_exam',1) !!}Normal</label></div>
						<div class='col-md-2'><label class="radio-inline">{!! Form::radio('skin_exam',0) !!}Abnormal</label></div>
						<label class="control-label" for="skin_exam_detail">[<a onclick="toggleTemplate('#skinExamGenCollapse')">Template</a>]</label>
						<!-- FOR TESTING -->
						<a onclick="$('#skin_drawings_collapse').collapse('toggle')">[ Insert Drawing ]</a>
						<!-- FOR TESTING -->
					</div>
				</div>
				<!-- field skin_exam_detail type text -->
				<div class='collapse in form-group' id="skin_exam">					
					<div class="collapse col-md-12" id="skinExamGenCollapse">@include('medicine.notes.admission.template.exam.skinExamGenerator')</div>
					{!! Form::textarea('skin_exam_detail',null,['class' => 'form-control', 'id' => 'taskinExamDetail','rows' => '1']) !!}
				</div>
				<div class="collapse" id="skin_drawings_collapse">
					@if (session('patient_gender') == 'หญิง')
					<div class="col-md-4"><a href="/drawing/med-body_female/edit"><img class="img-responsive img-thumbnail" src="/assets/images/drawings/medicine/body_female.png" alt="wordplease" width="250" height="250"></a></div>
					<div class="col-md-4"><a href="/drawing/med-body_front_female/edit"><img class="img-responsive img-thumbnail" src="/assets/images/drawings/medicine/body_front_female.png" alt="wordplease" width="250" height="250"></a></div>
					<div class="col-md-4"><a href="/drawing/med-body_back_female/edit"><img class="img-responsive img-thumbnail" src="/assets/images/drawings/medicine/body_back_female.png" alt="wordplease" width="250" height="250"></a></div>
					@else
					<div class="col-md-4"><a href="/drawing/med-body_male/edit"><img class="img-responsive img-thumbnail" src="/assets/images/drawings/medicine/body_male.png" alt="wordplease" width="250" height="250"></a></div>
					<div class="col-md-4"><a href="/drawing/med-body_front_male/edit"><img class="img-responsive img-thumbnail" src="/assets/images/drawings/medicine/body_front_male.png" alt="wordplease" width="250" height="250"></a></div>
					<div class="col-md-4"><a href="/drawing/med-body_back_male/edit"><img class="img-responsive img-thumbnail" src="/assets/images/drawings/medicine/body_back_male.png" alt="wordplease" width="250" height="250"></a></div>
					@endif
				</div><div><hr></div>
				<!-- field head_exam type tinyInteger -->
				<div class="form-horizontal row">
					<div class="col-md-12 form-group">
						<label class="col-md-3 control-label">Head [<a onclick="$('#head_exam').collapse('toggle');" title="Click to Show/Hide detail">Detail</a>] :</label>
						<div class='col-md-1'><label class="radio-inline">{!! Form::radio('head_exam',1) !!}Normal</label></div>
						<div class='col-md-2'><label class="radio-inline">{!! Form::radio('head_exam',0) !!}Abnormal</label></div>
						<label class="control-label" for="head_exam_detail">[<a onclick="toggleTemplate('#headExamGenCollapse')">Template</a>]</label>
						<!-- FOR TESTING -->
						<a onclick="$('#head_drawings_collapse').collapse('toggle')">[ Insert Drawing ]</a>
						<!-- FOR TESTING -->
					</div>
				</div>
				<!-- field head_exam_detail type text -->
				<div class='collapse in form-group' id="head_exam">					
					<div class="collapse col-md-12" id="headExamGenCollapse">@include('medicine.notes.admission.template.exam.headExamGenerator')</div>
					{!! Form::textarea('head_exam_detail',null,['class' => 'form-control', 'id' => 'taheadExamDetail','rows' => '1']) !!}
				</div>
				<div class="collapse" id="head_drawings_collapse">
					<div class="col-md-4"><a href="/drawing/med-head_left/edit"><img class="img-responsive img-thumbnail" src="/assets/images/drawings/medicine/head_left.png" alt="wordplease" width="250" height="250"></a></div>
					<div class="col-md-4"><a href="/drawing/med-head_right/edit"><img class="img-responsive img-thumbnail" src="/assets/images/drawings/medicine/head_right.png" alt="wordplease" width="250" height="250"></a></div>
				</div><div><hr></div>
				<!-- field eyeENT_exam type tinyInteger -->
				<div class="form-horizontal row">
					<div class="col-md-12 form-group">
						<label class="col-md-3 control-label">Eye/ENT [<a onclick="$('#eyeENT_exam').collapse('toggle');" title="Click to Show/Hide detail">Detail</a>] :</label>
						<div class='col-md-1'><label class="radio-inline">{!! Form::radio('eyeENT_exam',1) !!}Normal</label></div>
						<div class='col-md-2'><label class="radio-inline">{!! Form::radio('eyeENT_exam',0) !!}Abnormal</label></div>
						<label class="control-label" for="eyeENT_exam_detail">[<a onclick="toggleTemplate('#eyeENTExamGenCollapse')">Template</a>]</label>
						<!-- FOR TESTING -->
						<a onclick="$('#eyeENT_drawings_collapse').collapse('toggle')">[ Insert Drawing ]</a>
						<!-- FOR TESTING -->
					</div>
				</div>
				<!-- field eyeENT_exam_detail type text -->
				<div class='collapse in form-group' id="eyeENT_exam">					
					<div class="collapse col-md-12" id="eyeENTExamGenCollapse">@include('medicine.notes.admission.template.exam.eyeENTExamGenerator')</div>
					{!! Form::textarea('eyeENT_exam_detail',null,['class' => 'form-control', 'id' => 'taeyeENTExamDetail','rows' => '1']) !!}
				</div>
				<div class="collapse" id="eyeENT_drawings_collapse">
					<div class="col-md-4"><a href="/drawing/med-ears/edit"><img class="img-responsive img-thumbnail" src="/assets/images/drawings/medicine/ears.png" alt="wordplease" width="250" height="250"></a></div>
					<div class="col-md-4"><a href="/drawing/med-ear_left/edit"><img class="img-responsive img-thumbnail" src="/assets/images/drawings/medicine/ear_left.png" alt="wordplease" width="250" height="250"></a></div>
					<div class="col-md-4"><a href="/drawing/med-ear_right/edit"><img class="img-responsive img-thumbnail" src="/assets/images/drawings/medicine/ear_right.png" alt="wordplease" width="250" height="250"></a></div>
					<div class="col-md-4"><a href="/drawing/med-fundi/edit"><img class="img-responsive img-thumbnail" src="/assets/images/drawings/medicine/fundi.png" alt="wordplease" width="250" height="250"></a></div>
					<div class="col-md-4"><a href="/drawing/med-eyes/edit"><img class="img-responsive img-thumbnail" src="/assets/images/drawings/medicine/eyes.png" alt="wordplease" width="250" height="250"></a></div>
					<div class="col-md-4"><a href="/drawing/med-nose/edit"><img class="img-responsive img-thumbnail" src="/assets/images/drawings/medicine/nose.png" alt="wordplease" width="250" height="250"></a></div>
				</div><div><hr></div>
				<!-- field neck_exam type tinyInteger -->
				<div class="form-horizontal row">
					<div class="col-md-12 form-group">
						<label class="col-md-3 control-label">Neck [<a onclick="$('#neck_exam').collapse('toggle');" title="Click to Show/Hide detail">Detail</a>] :</label>
						<div class='col-md-1'><label class="radio-inline">{!! Form::radio('neck_exam',1) !!}Normal</label></div>
						<div class='col-md-2'><label class="radio-inline">{!! Form::radio('neck_exam',0) !!}Abnormal</label></div>
						<label class="control-label" for="neck_exam_detail">[<a onclick="toggleTemplate('#neckExamGenCollapse')">Template</a>]</label>
					</div>
				</div>
				<!-- field neck_exam_detail type text -->
				<div class='collapse in form-group' id="neck_exam">					
					<div class="collapse col-md-12" id="neckExamGenCollapse">@include('medicine.notes.admission.template.exam.neckExamGenerator')</div>
					{!! Form::textarea('neck_exam_detail',null,['class' => 'form-control', 'id' => 'taneckExamDetail','rows' => '1']) !!}
				</div><div><hr></div>
				<!-- field heart_exam type tinyInteger -->
				<div class="form-horizontal row">
					<div class="col-md-12 form-group">
						<label class="col-md-3 control-label">Heart [<a onclick="$('#heart_exam').collapse('toggle');" title="Click to Show/Hide detail">Detail</a>] :</label>
						<div class='col-md-1'><label class="radio-inline">{!! Form::radio('heart_exam',1) !!}Normal</label></div>
						<div class='col-md-2'><label class="radio-inline">{!! Form::radio('heart_exam',0) !!}Abnormal</label></div>
						<label class="control-label" for="heart_exam_detail">[<a onclick="toggleTemplate('#heartExamGenCollapse')">Template</a>]</label>
					</div>
				</div>
				<!-- field heart_exam_detail type text -->
				<div class='collapse in form-group' id="heart_exam">					
					<div class="collapse col-md-12" id="heartExamGenCollapse">@include('medicine.notes.admission.template.exam.heartExamGenerator')</div>
					{!! Form::textarea('heart_exam_detail',null,['class' => 'form-control', 'id' => 'taheartExamDetail','rows' => '1']) !!}
				</div><div><hr></div>
				<!-- field lung_exam type tinyInteger -->
				<div class="form-horizontal row">
					<div class="col-md-12 form-group">
						<label class="col-md-3 control-label">Lung [<a onclick="$('#lung_exam').collapse('toggle');" title="Click to Show/Hide detail">Detail</a>] :</label>
						<div class='col-md-1'><label class="radio-inline">{!! Form::radio('lung_exam',1) !!}Normal</label></div>
						<div class='col-md-2'><label class="radio-inline">{!! Form::radio('lung_exam',0) !!}Abnormal</label></div>
						<label class="control-label" for="lung_exam_detail">[<a onclick="toggleTemplate('#lungExamGenCollapse')">Template</a>]</label>
					</div>
				</div>
				<!-- field lung_exam_detail type text -->
				<div class='collapse in form-group' id="lung_exam">					
					<div class="collapse col-md-12" id="lungExamGenCollapse">@include('medicine.notes.admission.template.exam.lungExamGenerator')</div>
					{!! Form::textarea('lung_exam_detail',null,['class' => 'form-control', 'id' => 'talungExamDetail','rows' => '1']) !!}
				</div><div><hr></div>
				<!-- field abdomen_exam type tinyInteger -->
				<div class="form-horizontal row">
					<div class="col-md-12 form-group">
						<label class="col-md-3 control-label">Abdomen [<a onclick="$('#abdomen_exam').collapse('toggle');" title="Click to Show/Hide detail">Detail</a>] :</label>
						<div class='col-md-1'><label class="radio-inline">{!! Form::radio('abdomen_exam',1) !!}Normal</label></div>
						<div class='col-md-2'><label class="radio-inline">{!! Form::radio('abdomen_exam',0) !!}Abnormal</label></div>
						<label class="control-label" for="abdomen_exam_detail">[<a onclick="toggleTemplate('#abdomenExamGenCollapse')">Template</a>]</label>
						<!-- FOR TESTING -->
						<a href="/drawing/med-abdomen/edit">[ Insert Drawing ]</a>
						<!-- FOR TESTING -->
					</div>
				</div>
				<!-- field abdomen_exam_detail type text -->
				<div class='collapse in form-group' id="abdomen_exam">					
					<div class="collapse col-md-12" id="abdomenExamGenCollapse">@include('medicine.notes.admission.template.exam.abdomenExamGenerator')</div>
					{!! Form::textarea('abdomen_exam_detail',null,['class' => 'form-control', 'id' => 'taabdomenExamDetail','rows' => '1']) !!}
				</div>
				<div><hr></div>

				<!-- field nervous_exam type tinyInteger -->
				<div class="form-horizontal row">
					<div class="col-md-12 form-group">
						<label class="col-md-3 control-label">Nervous system [<a onclick="$('#nervous_exam').collapse('toggle');" title="Click to Show/Hide detail">Detail</a>] :</label>
						<div class='col-md-1'><label class="radio-inline">{!! Form::radio('nervous_exam',1) !!}Normal</label></div>
						<div class='col-md-2'><label class="radio-inline">{!! Form::radio('nervous_exam',0) !!}Abnormal</label></div>
						<label class="control-label" for="nervous_exam_detail">[<a onclick="toggleTemplate('#nervousExamGenCollapse')">Template</a>]</label>
						<!-- FOR TESTING -->
						<a onclick="$('#nervous_drawings_collapse').collapse('toggle')">[ Insert Drawing ]</a>
						<!-- FOR TESTING -->
					</div>
				</div>
				<!-- field nervous_exam_detail type text -->
				<div class='collapse in form-group' id="nervous_exam">					
					<div class="collapse col-md-12" id="nervousExamGenCollapse"><h1>ยังไม่ได้ทำจ้า</h1></div>
					{!! Form::textarea('nervous_exam_detail',null,['class' => 'form-control', 'id' => 'tanervousExamDetail','rows' => '1']) !!}
				</div>
				<div class="collapse" id="nervous_drawings_collapse">
					@if (session('patient_gender') == 'หญิง')
					<div class="col-md-4"><a href="/drawing/med-dermatome_female/edit"><img class="img-responsive img-thumbnail" src="/assets/images/drawings/medicine/dermatome_female.png" alt="wordplease" width="250" height="250"></a></div>
					<div class="col-md-4"><a href="/drawing/med-dermatome_front_female/edit"><img class="img-responsive img-thumbnail" src="/assets/images/drawings/medicine/dermatome_front_female.png" alt="wordplease" width="250" height="250"></a></div>
					<div class="col-md-4"><a href="/drawing/med-dermatome_back_female/edit"><img class="img-responsive img-thumbnail" src="/assets/images/drawings/medicine/dermatome_back_female.png" alt="wordplease" width="250" height="250"></a></div>
					@else
					<div class="col-md-4"><a href="/drawing/med-dermatome_male/edit"><img class="img-responsive img-thumbnail" src="/assets/images/drawings/medicine/dermatome_male.png" alt="wordplease" width="250" height="250"></a></div>
					<div class="col-md-4"><a href="/drawing/med-dermatome_front_male/edit"><img class="img-responsive img-thumbnail" src="/assets/images/drawings/medicine/dermatome_front_male.png" alt="wordplease" width="250" height="250"></a></div>
					<div class="col-md-4"><a href="/drawing/med-dermatome_back_male/edit"><img class="img-responsive img-thumbnail" src="/assets/images/drawings/medicine/dermatome_back_male.png" alt="wordplease" width="250" height="250"></a></div>
					@endif
					<div class="col-md-4"><a href="/drawing/med-fundi/edit"><img class="img-responsive img-thumbnail" src="/assets/images/drawings/medicine/fundi.png" alt="wordplease" width="250" height="250"></a></div>
					<div class="col-md-4"><a href="/drawing/med-head_neuro_left/edit"><img class="img-responsive img-thumbnail" src="/assets/images/drawings/medicine/head_neuro_left.png" alt="wordplease" width="250" height="250"></a></div>
					<div class="col-md-4"><a href="/drawing/med-head_neuro_right/edit"><img class="img-responsive img-thumbnail" src="/assets/images/drawings/medicine/head_neuro_right.png" alt="wordplease" width="250" height="250"></a></div>
					<div class="col-md-4"><a href="/drawing/med-leg_left/edit"><img class="img-responsive img-thumbnail" src="/assets/images/drawings/medicine/leg_left.png" alt="wordplease" width="250" height="250"></a></div>
					<div class="col-md-4"><a href="/drawing/med-leg_right/edit"><img class="img-responsive img-thumbnail" src="/assets/images/drawings/medicine/leg_right.png" alt="wordplease" width="250" height="250"></a></div>
					<div class="col-md-4"><a href="/drawing/med-deep_tendon_reflex/edit"><img class="img-responsive img-thumbnail" src="/assets/images/drawings/medicine/deep_tendon_reflex.png" alt="wordplease" width="250" height="250"></a></div>
					<div class="col-md-4"><a href="/drawing/med-neuro_body_part/edit"><img class="img-responsive img-thumbnail" src="/assets/images/drawings/medicine/neuro_body_part.png" alt="wordplease" width="250" height="250"></a></div>
				</div><div><hr></div>
				<!-- 
				field neuro_exam type tinyInteger
				<div class="form-horizontal row">
					<div class="col-md-12 form-group">
						<label class="col-md-3 control-label">Neuro [<a onclick="$('#neuro_exam').collapse('toggle');" title="Click to Show/Hide detail">Detail</a>] :</label>
						<div class='col-md-1'><label class="radio-inline">{!! Form::radio('neuro_exam',1) !!}Normal</label></div>
						<div class='col-md-2'><label class="radio-inline">{!! Form::radio('neuro_exam',0) !!}Abnormal</label></div>
						<label class="control-label" for="neuro_exam_detail">[<a onclick="toggleTemplate('#neuroExamGenCollapse')">Template</a>]</label>
					</div>
				</div>
				field neuro_exam_detail type text
				<div class='collapse in form-group' id="neuro_exam">					
					<div class="collapse col-md-12" id="neuroExamGenCollapse"><h1>ยังไม่ได้ทำจ้า</h1></div>
					{!! Form::textarea('neuro_exam_detail',null,['class' => 'form-control', 'id' => 'taneuroExamDetail','rows' => '1']) !!}
				</div><div><hr></div>
				 -->
				<!-- field extremities_exam type tinyInteger -->
				<div class="form-horizontal row">
					<div class="col-md-12 form-group">
						<label class="col-md-3 control-label">Extremities [<a onclick="$('#extremities_exam').collapse('toggle');" title="Click to Show/Hide detail">Detail</a>] :</label>
						<div class='col-md-1'><label class="radio-inline">{!! Form::radio('extremities_exam',1) !!}None</label></div>
						<div class='col-md-2'><label class="radio-inline">{!! Form::radio('extremities_exam',0) !!}Abnormal</label></div>
						<label class="control-label" for="extremities_exam_detail">[<a onclick="toggleTemplate('#extremitiesExamGenCollapse')">Template</a>]</label>
						<!-- FOR TESTING -->
						<a onclick="$('#extremities_drawings_collapse').collapse('toggle')">[ Insert Drawing ]</a>
						<!-- FOR TESTING -->
					</div>
				</div>
				<!-- field extremities_exam_detail type text -->
				<div class='collapse in form-group' id="extremities_exam">					
					<div class="collapse col-md-12" id="extremitiesExamGenCollapse"><h1>ยังไม่ได้ทำจ้า</h1></div>
					{!! Form::textarea('extremities_exam_detail',null,['class' => 'form-control', 'id' => 'taextremitiesExamDetail','rows' => '1']) !!}
				</div>
				<div class="collapse" id="extremities_drawings_collapse">
					<div class="col-md-4"><a href="/drawing/med-feet/edit"><img class="img-responsive img-thumbnail" src="/assets/images/drawings/medicine/feet.png" alt="wordplease" width="250" height="250"></a></div>
					<div class="col-md-4"><a href="/drawing/med-forefeet/edit"><img class="img-responsive img-thumbnail" src="/assets/images/drawings/medicine/forefeet.png" alt="wordplease" width="250" height="250"></a></div>
					<div class="col-md-4"><a href="/drawing/med-hands/edit"><img class="img-responsive img-thumbnail" src="/assets/images/drawings/medicine/hands.png" alt="wordplease" width="250" height="250"></a></div>
					<div class="col-md-4"><a href="/drawing/med-hand_left/edit"><img class="img-responsive img-thumbnail" src="/assets/images/drawings/medicine/hand_left.png" alt="wordplease" width="250" height="250"></a></div>
					<div class="col-md-4"><a href="/drawing/med-hand_right/edit"><img class="img-responsive img-thumbnail" src="/assets/images/drawings/medicine/hand_right.png" alt="wordplease" width="250" height="250"></a></div>
					<div class="col-md-4"><a href="/drawing/med-joint/edit"><img class="img-responsive img-thumbnail" src="/assets/images/drawings/medicine/joint.png" alt="wordplease" width="250" height="250"></a></div>
				</div><div><hr></div>
				<!-- field lymphNodes_exam type tinyInteger -->
				<div class="form-horizontal row">
					<div class="col-md-12 form-group">
						<label class="col-md-3 control-label">Lymph nodes [<a onclick="$('#lymphNodes_exam').collapse('toggle');" title="Click to Show/Hide detail">Detail</a>] :</label>
						<div class='col-md-1'><label class="radio-inline">{!! Form::radio('lymphNodes_exam',1) !!}None</label></div>
						<div class='col-md-2'><label class="radio-inline">{!! Form::radio('lymphNodes_exam',0) !!}Palpable</label></div>
						<label class="control-label" for="lymphNodes_exam_detail">[<a onclick="toggleTemplate('#lymphNodesExamGenCollapse')">Template</a>]</label>
						<!-- FOR TESTING -->
						<a onclick="$('#lymphnodes_drawings_collapse').collapse('toggle')">[ Insert Drawing ]</a>
						<!-- FOR TESTING -->
					</div>
				</div>
				<!-- field lymphNodes_exam_detail type text -->
				<div class='collapse in form-group' id="lymphNodes_exam">					
					<div class="collapse col-md-12" id="lymphNodesExamGenCollapse"><h1>ยังไม่ได้ทำจ้า</h1></div>
					{!! Form::textarea('lymphNodes_exam_detail',null,['class' => 'form-control', 'id' => 'talymphNodesExamDetail','rows' => '1']) !!}
				</div>
				<div class="collapse" id="lymphnodes_drawings_collapse">
					<div class="col-md-4"><a href="/drawing/med-cervical_left/edit"><img class="img-responsive img-thumbnail" src="/assets/images/drawings/medicine/cervical_left.png" alt="wordplease" width="250" height="250"></a></div>
					<div class="col-md-4"><a href="/drawing/med-cervical_right/edit"><img class="img-responsive img-thumbnail" src="/assets/images/drawings/medicine/cervical_right.png" alt="wordplease" width="250" height="250"></a></div>
					<div class="col-md-4"><a href="/drawing/med-cervical_left_label/edit"><img class="img-responsive img-thumbnail" src="/assets/images/drawings/medicine/cervical_left_label.png" alt="wordplease" width="250" height="250"></a></div>
					<div class="col-md-4"><a href="/drawing/med-cervical_right_label/edit"><img class="img-responsive img-thumbnail" src="/assets/images/drawings/medicine/cervical_right_label.png" alt="wordplease" width="250" height="250"></a></div>
				</div><div><hr></div>
				@if (session('patient_gender') == 'หญิง')
				<!-- field breasts_exam type tinyInteger -->
				<div class="form-horizontal row">
					<div class="col-md-12 form-group">
						<label class="col-md-3 control-label">Breasts [<a onclick="$('#breasts_exam').collapse('toggle');" title="Click to Show/Hide detail">Detail</a>] :</label>
						<div class='col-md-1'><label class="radio-inline">{!! Form::radio('breasts_exam',1) !!}Normal</label></div>
						<div class='col-md-2'><label class="radio-inline">{!! Form::radio('breasts_exam',0) !!}Abnormal</label></div>
						<label class="control-label" for="breasts_exam_detail">[<a onclick="toggleTemplate('#breastsExamGenCollapse')">Template</a>]</label>
						<!-- FOR TESTING -->
						<a href="/drawing/med-breast/edit">[ Insert Drawing ]</a>
						<!-- FOR TESTING -->
					</div>
				</div>
				<!-- field breasts_exam_detail type text -->
				<div class='collapse in form-group' id="breasts_exam">					
					<div class="collapse col-md-12" id="breastsExamGenCollapse"><h1>ยังไม่ได้ทำจ้า</h1></div>
					{!! Form::textarea('breasts_exam_detail',null,['class' => 'form-control', 'id' => 'tabreastsExamDetail','rows' => '1']) !!}
				</div><div><hr></div>
				@endif
				<!-- field genitalia_exam type tinyInteger -->
				<div class="form-horizontal row">
					<div class="col-md-12 form-group">
						<label class="col-md-3 control-label">Genitalia [<a onclick="$('#genitalia_exam').collapse('toggle');" title="Click to Show/Hide detail">Detail</a>] :</label>
						<div class='col-md-1'><label class="radio-inline">{!! Form::radio('genitalia_exam',1) !!}Normal</label></div>
						<div class='col-md-2'><label class="radio-inline">{!! Form::radio('genitalia_exam',0) !!}Abnormal</label></div>
						<label class="control-label" for="genitalia_exam_detail">[<a onclick="toggleTemplate('#genitaliaExamGenCollapse')">Template</a>]</label>
					</div>
				</div>
				<!-- field genitalia_exam_detail type text -->
				<div class='collapse in form-group' id="genitalia_exam">					
					<div class="collapse col-md-12" id="genitaliaExamGenCollapse"><h1>ยังไม่ได้ทำจ้า</h1></div>
					{!! Form::textarea('genitalia_exam_detail',null,['class' => 'form-control', 'id' => 'tagenitaliaExamDetail','rows' => '1']) !!}
				</div><div><hr></div>
				<!-- field rectal_exam type tinyInteger -->
				<div class="form-horizontal row">
					<div class="col-md-12 form-group">
						<label class="col-md-3 control-label">Rectal examination [<a onclick="$('#rectal_exam').collapse('toggle');" title="Click to Show/Hide detail">Detail</a>] :</label>
						<div class='col-md-1'><label class="radio-inline">{!! Form::radio('rectal_exam',1) !!}Normal</label></div>
						<div class='col-md-2'><label class="radio-inline">{!! Form::radio('rectal_exam',0) !!}Abnormal</label></div>
						<label class="control-label" for="rectal_exam_detail">[<a onclick="toggleTemplate('#rectalExamGenCollapse')">Template</a>]</label>
					</div>
				</div>
				<!-- field rectal_exam_detail type text -->
				<div class='collapse in form-group' id="rectal_exam">					
					<div class="collapse col-md-12" id="rectalExamGenCollapse"><h1>ยังไม่ได้ทำจ้า</h1></div>
					{!! Form::textarea('rectal_exam_detail',null,['class' => 'form-control', 'id' => 'tarectalExamDetail','rows' => '1']) !!}
				</div><div><hr></div>
				<!-- field pertinent_investigation type text -->
				<div class='form-group col-md-12'>
					{!! Form::label('pertinent_investigation','Pertinent investigation : (Please see more detail in laboratory sheet, X-ray report, etc.)',['class' => 'control-label']) !!}
					{!! Form::textarea('pertinent_investigation',null,['class' => 'form-control', 'rows' => '1', 'id' => 'pertinent_investigation']) !!}
				</div>
			</div>
		</div>
	</div>
</div><!-- end of Physical examination and investigation -->
<div class="panel panel-primary">
	<div class="panel-heading">Problem list, Discussion and Plan</div> 
	<div class="panel-body">
		<div class="panel panel-info">
			<div class="panel-heading">Problem list</div>
			<!-- field problem_list type text -->
			<div class="panel-body">
				{!! Form::textarea('problem_list',null,['class' => 'form-control', 'rows' => '1', 'id' => 'problem_list']) !!}
			</div>
		</div><!-- end of problem list -->
		<div class="panel panel-info">
			<div class="panel-heading">Discussion</div>
			<!-- field discussion type text -->
			<div class="panel-body">
				{!! Form::textarea('discussion',null,['class' => 'form-control', 'rows' => '1', 'id' => 'discussion']) !!}
			</div>
		</div><!-- end of Discussion -->
		<div class="panel panel-info">
			<div class="panel-heading">Provisional diagnosis</div>
			<!-- field provisional_dx type text -->
			<div class="panel-body">
				{!! Form::textarea('provisional_dx',null,['class' => 'form-control', 'rows' => '1', 'id' => 'provisional_dx']) !!}
			</div>
		</div><!-- end of Provisional diagnosis -->
		<div class="panel panel-info">
			<div class="panel-heading">Plan of investigation</div>
			<!-- field plan_investigation type text -->
			<div class="panel-body">
				{!! Form::textarea('plan_investigation',null,['class' => 'form-control', 'rows' => '1', 'id' => 'plan_investigation']) !!}
			</div>
		</div><!-- end of Provisional diagnosis -->
		<div class="panel panel-info">
			<div class="panel-heading">Plan of management</div>
			<!-- field plan_management type text -->
			<div class="panel-body">
				{!! Form::textarea('plan_management',null,['class' => 'form-control', 'rows' => '1', 'id' => 'plan_management']) !!}
			</div>
		</div><!-- end of Plan of management -->
		<div class="panel panel-info">
			<div class="panel-heading">Special group (accoring to CPG)</div>
			<div class="panel-body">
				<!-- field special_group_CPG type tinyInteger -->
				<div class='form-horizontal row col-md-8'>
					{!! Form::label('special_group_CPG','Please Select :',['class' => 'control-label col-md-4']) !!}
					<div class='col-md-8 special_group_CPG_div'>
						<select class="form-control" name='special_group_CPG' id='special_group_CPG_select'>
							<option selected disabled hidden value=''></option>
							<option value="1">None</option>
							<option value="1">Sepsis</option>
							<option value="2">Acute GI hemorrhage</option>
							<option value="3">Actue MI</option>
							<option value="4">AKI</option>
							<option value="5">Stroke</option>
						</select>
					</div>
				</div>
			</div>
		</div><!-- end of Special group (accoring to CPG) -->
		<div class="panel panel-info">
			<div class="panel-heading">Plan of consultation</div>
			<!-- field plan_consult type text -->
			<div class="panel-body">
				{!! Form::textarea('plan_consult',null,['class' => 'form-control', 'rows' => '1', 'id' => 'plan_consult']) !!}
			</div>
		</div><!-- end of Plan of consultation -->
		<div class="panel panel-info">
			<div class="panel-heading">Estimated dulation of hospitalization</div>
			<!-- field estimated_los type text -->
			<div class="panel-body">
				{!! Form::input('number','estimated_los',null,['class' => 'form-control', 'id' => 'estimated_los', 'placeholder' => 'Enter approximate length of stay(days) or leave blank if cannot be presently determined']) !!}
			</div>
		</div><!-- end of Estimated dulation of hospitalization -->
	</div>
</div><!-- end of problem list, Discussion and plan -->
<div class='well'>
	<center>End of Medicine admission note form.</center>
</div>
</div><!-- end of main_frame -->

<script type="text/javascript">
	$( "#ward_name" ).autocomplete({
		source: function( request, response ) {
			$.ajax({
				url: "/itemize/ward/med|" + request.term, // medicine ward URL.
				dataType: "JSON",
				success: function( data ) {
					response(data);
				}
			});
		},
		focus: function(event, ui) {
			event.preventDefault();
			$(this).val(ui.item.ward_name); // set ward_name = ward_name[field].
		},
		select: function(event, ui) {
			event.preventDefault();
			$(this).val(ui.item.ward_name);
			$("#ward_id").val(ui.item.value); // set ward_id = value.
			$("#ward_name").prop('title',ui.item.label); // set title to meta data.
		},
    	minLength: 2, // min length before query.
    }); // ward autocomplete.

	$( "#attending_name" ).autocomplete({
		source: function( request, response ) {
			$.ajax({
				url: "/itemize/attending/med|" + request.term, // medicine attending URL.
				dataType: "JSON",
				success: function( data ) {
					response(data);
				}
			});
		},
		focus: function(event, ui) {
			event.preventDefault();
			$(this).val(ui.item.doctor_name); // set attending_name = doctor_name.
		},
		select: function(event, ui) {
			event.preventDefault();
			$(this).val(ui.item.doctor_name);
			$("#attending_id").val(ui.item.value); // set attending_id = value.
			$("#attending_name").prop('title',ui.item.label); // set title to meta data.
		},
    	minLength: 2, // min length before query.
    }); // attending autocomplete.

	function toggleReasonAdmitOther(){
		var reason = $('input[name=reason_admit]:checked').val();
        if ( reason > 0 || (typeof $('input[name=reason_admit]:checked').val() === 'undefined')) {
        	$('#reasonAdmitOther').collapse('hide');
        	$('#reason_admit_other').val('');
        } else {
        	$('#reasonAdmitOther').collapse('show');
        }
	} // reason_admit.

	$(function () {
        $('#date_admit').datetimepicker({
            locale: 'th',
            format: 'DD-MM-YYYY HH:mm',
            showTodayButton: true,
            showClear: true
        });
    }); // admit_date.

	function setComorbid(mode) {
		if (mode == 1) {
			$("input[name*='comorbid'][value='99']").prop('checked', true);
			$("input[name*='comorbid'][value='99']").click();	
		} else if (mode == 2) {
			$("input[name*='comorbid'][value='0']").prop('checked', true);
			$("input[name*='comorbid'][value='0']").click();
		} else {
			$('#comorbidList').collapse('toggle');
		}
	} // co-morbid buttons event.

	function toggleComorbidDetailCollapse(ctr){
		var ctrName = ctr.attr('name'); // get element name.
		var value =  $('input[name=' + ctrName + ']:checked').val(); // get ckecked value.
		if ( value == 0 || value == 99 || value == 2 || (typeof $('input[name=' + ctrName + ']:checked').val() === 'undefined')) { // No(0), No data(99) and null for true.
        	$('#' + ctrName + '_collapse').collapse('hide'); // hide detail.
        	$('input[name*=' + ctrName.replace('comorbid_','') + '_]').prop('checked',false); // reset detail all check input.
        	$('input[name*=' + ctrName.replace('comorbid_','') + '_]:text').val(''); // reset detail text input
        	$('input[name*=' + ctrName.replace('comorbid_','') + '_]:text').prop('readonly',true);
        	// $('input[name*=' + ctrName.replace('comorbid_','') + '_]:select').val(''); // reset detail text input
        } else {
        	$('#' + ctrName + '_collapse').collapse('show'); // show detail.
        }
	} // toggle extend detail for all comorbid.

	function getOtherText(ctr,mode) {
		var ctrName = ctr.attr('name'); // get element name.
		if (mode == "radio")
			var value =  $('input[name=' + ctrName + ']:checked').val(); // get ckecked value.
		else if (mode == "select")
			var value =  $('#' + ctr.attr("id")).val(); // get ckecked value.

		if (value == 0) {
			$("input[name=" + ctrName + "_other]").prop('readonly',false);
			$("input[name=" + ctrName + "_other]").focus();
		} else {
			$("input[name=" + ctrName + "_other]").prop('readonly',true);
			$("input[name=" + ctrName + "_other]").val('');
		}
	} // select other then focus on text input.

	function toggleCAD() {
		toggleComorbidDetailCollapse($('input[name=comorbid_CAD]'));
		getOtherText($('input[name=CAD_dx]'),"radio");
	}

	function toggleVHD() {
		toggleComorbidDetailCollapse($('input[name=comorbid_VHD]'));
		$('input[name=VHD_dx_other]').prop('readonly', false); // override toggleComorbidDetailCollapse().
	}

	function toggleCirrhosis() {
		toggleComorbidDetailCollapse($('input[name=comorbid_cirrhosis]'));
		$('input[name=cirrhosis_etiology_other]').prop('readonly', false); // override toggleComorbidDetailCollapse().
	}

	$("input[name*='cirrhosis_etiology_']").each(function(i, obj) {		
		var choice = $(this).prop('name');
		switch(choice) {
			case 'cirrhosis_etiology_HBV' : // trigger check HBV.
				$(this).click(function() { 
					$("input[name='comorbid_HBV'][value='1']").prop('checked', true); 
					if ($("input[name='cirrhosis_etiology_cryptogenic']").prop('checked'))
						$("input[name='cirrhosis_etiology_cryptogenic']").click();
					
				});
				break;
			case 'cirrhosis_etiology_HCV' : // trigger check HCV.
				$(this).click(function() { 
					$("input[name='comorbid_HCV'][value='1']").prop('checked', true); 
					if ($("input[name='cirrhosis_etiology_cryptogenic']").prop('checked'))
						$("input[name='cirrhosis_etiology_cryptogenic']").click();
				});
				break;
			case 'cirrhosis_etiology_NASH' : // trigger check NASH.
				$(this).click(function() { 
					if ($("input[name='cirrhosis_etiology_cryptogenic']").prop('checked'))
						$("input[name='cirrhosis_etiology_cryptogenic']").click();
				});
				break;
			case 'cirrhosis_etiology_cryptogenic' :								    				
				$(this).click(function() {
					if ($(this).prop('checked') == true) {
						$("input[name='cirrhosis_etiology_HBV']").prop('checked', false);
						$("input[name='cirrhosis_etiology_HCV']").prop('checked', false);
						$("input[name='cirrhosis_etiology_NASH']").prop('checked', false);
						$('#cirrhosis_etiology_other').val('');
						$('#cirrhosis_etiology_other').prop('readonly', true);
					} else {
						$("input[name='cirrhosis_etiology_HBV']").prop('readonly', false);
						$("input[name='cirrhosis_etiology_HCV']").prop('readonly', false);
						$("input[name='cirrhosis_etiology_NASH']").prop('readonly', false);
						$('#cirrhosis_etiology_other').prop('readonly', false);
					}
				});
				break;
		}
	}); // add cirrhosis_etiology event

	// triger check TB by HIV previous infection.
	$("input[name='HIV_pre_infect_TB']").click(function() {$("input[name='HIV_pre_infect_TB']").prop('checked') ? $("input[name='comorbid_TB'][value='1']").prop('checked', true) : $("input[name='comorbid_TB'][value='1']").prop('checked', false); });

	function toggleHIV() {
		toggleComorbidDetailCollapse($('input[name=comorbid_HIV]'));
		$('input[name=HIV_pre_infect_other]').prop('readonly', false); // override toggleComorbidDetailCollapse().
	}

	function toggleEpilepsy() {
		toggleComorbidDetailCollapse($('input[name=comorbid_epilepsy]'));
		getOtherText($('input[name=epilepsy_dx]'),"radio");
	}

	function toggleLymphoma() {
		toggleComorbidDetailCollapse($('input[name=comorbid_lymphoma]'));
		var value =  $('input[name=comorbid_lymphoma]:checked').val(); // get ckecked value.
		if ( value == 0 || value == 99 || value == 2 || (typeof $('input[name=comorbid_lymphoma]:checked').val() === 'undefined')) { // No(0), No data(99) and null for true.
			$('#lymphoma_dx_select').val('');
		}
		getOtherText($('#lymphoma_dx_select'),"select");
	}

	function togglePaceMakerImplant() {
		toggleComorbidDetailCollapse($('input[name=comorbid_pacemaker_implant]'));
		getOtherText($('input[name=pacemaker_implant_type]'),"radio");
	}

	function toggleICD() {
		toggleComorbidDetailCollapse($('input[name=comorbid_ICD]'));
		$('input[name=ICD_type]').prop('readonly',false); // override standard toggleComorbidDetailCollapse();
	}

	function toggleCancer() {
		toggleComorbidDetailCollapse($('input[name=comorbid_cancer]'));
		$('input[name=cancer_at_other]').prop('readonly',false); // override standard toggleComorbidDetailCollapse();
	}

	function toggleChronicArthritis() {
		toggleComorbidDetailCollapse($('input[name=comorbid_chronic_arthritis]'));
		$('input[name=chronic_arthritis_other]').prop('readonly',false); // override standard toggleComorbidDetailCollapse();
	}

	function toggleOtherAutoimmuneDisease() {
		toggleComorbidDetailCollapse($('input[name=comorbid_other_autoimmune_disease]'));
		$('input[name=other_autoimmune_disease_dx_other]').prop('readonly',false); // override standard toggleComorbidDetailCollapse();
	}

	function toggleOtherAutoimmuneDisease() {
		toggleComorbidDetailCollapse($('input[name=comorbid_other_autoimmune_disease]'));
		$('input[name=other_autoimmune_disease_dx_other]').prop('readonly',false); // override standard toggleComorbidDetailCollapse();
	}
	
	function toggleTB() {
		toggleComorbidDetailCollapse($('input[name=comorbid_TB]'));
		$('input[name=TB_at_other]').prop('readonly',false); // override standard toggleComorbidDetailCollapse();
	}

	function toggleDementia() {
		toggleComorbidDetailCollapse($('input[name=comorbid_dementia]'));
		$('input[name=dementia_other]').prop('readonly',false); // override standard toggleComorbidDetailCollapse();
	}

	function togglePsychiatricIllness() {
		toggleComorbidDetailCollapse($('input[name=comorbid_psychiatric_illness]'));
		$('input[name=psychiatric_illness_dx_other]').prop('readonly',false); // override standard toggleComorbidDetailCollapse();
	}

	function togglePregnantWeeks() {
		var value = $("input[name=pregnant]:checked").val();
		if (value == 1) {
			$("input[name=pregnant_weeks]").prop("readonly",false);
			$("input[name=pregnant_weeks]").focus();
		} else if (value == 0 || value == 99) {
			$("input[name=pregnant_weeks]").prop("readonly",true);
			$("input[name=pregnant_weeks]").val('');
		} 
	}

	function toggleAlcoholTemplate() {
		var value = $("input[name=alcohol]:checked").val();
		if (value == 0) {
			$("#taalcoholAmountReviewDetail").val('');
			$("#taalcoholAmountReviewDetail").attr('rows','1');
			$("#taalcoholAmountReviewDetail").prop('readonly',true);
			$('#alcoholHelperTemplate').collapse('hide');
		} else {
			$('#alcoholHelperTemplate').collapse('show');
			$("#taalcoholAmountReviewDetail").prop('readonly',false);
		}
	}
	
	function toggleSmokingTemplate() {
		var value = $('input[name=smoking]:checked').val();
		if (value == 0) {
			$("#tasmokingAmountReviewDetail").val('');
			$("#tasmokingAmountReviewDetail").prop('readonly',true);
			$('#smokingHelperTemplate').collapse('hide');
		} else {
			$('#smokingHelperTemplate').collapse('show');
			$("#tasmokingAmountReviewDetail").prop('readonly',false);
		}
	}
	
	// add weight and height event on chnage to calulate BMI
	$(".bmi").change(function() { $("input[name=BMI]").val($("input[name=weight]").val() / $("input[name=height]").val() / $("input[name=height]").val() * 10000);});

	function toggleBreathingO2() {
		var value = $("input[name=breathing]:checked").val();
		if (value == 2) {// Oxygen.
			$(".breathing_o2").collapse('show');
		} else { // room air.
			$(".breathing_o2").collapse('hide');
			$("input[name=breathing_on]").prop("checked",false);
			oxygenUnit();
			$("input[name=o2_rate]").val('');
		}
	} // toggle oxygen breathing additional fields. 

	function oxygenUnit() {
		var value = $("input[name=breathing_on]:checked").val();
		if (value > 2) {
			$("#o2unit").text('FiO2');
		} else if (value <= 2) {
			$("#o2unit").text('L/min');
		} else {
			$("#o2unit").text('');
		}
	} // change o2 unit bybreathing on.

	function setGCS() {
		var E = ($("select[name='GCS_E']").val() != null) ? $("select[name='GCS_E']").val() : 0 ;
		var V = ($("select[name='GCS_V']").val() != null) ? $("select[name='GCS_V']").val() : 0 ;
		var M = ($("select[name='GCS_M']").val() != null) ? $("select[name='GCS_M']").val() : 0 ;
		var gcs = parseInt(E) + parseInt(V) + parseInt(M);
		if (gcs == 0) // no any input.
			$("div.GCS_tot select").val('');
		else if (gcs < 9) 
			$("div.GCS_tot select").val("3");
		else if (gcs < 13)
			$("div.GCS_tot select").val("2");
		else 
			$("div.GCS_tot select").val("1");
	} // set Glassglow Coma Score by E + V + M then fill in to grade 1 to 3.

	$(document).ready(function(){

		$('input[name=reason_admit]').click(function() {toggleReasonAdmitOther();}); // add event to reason_admit.

		$('.text_area_feedback').keyup(function(){
			var maxLength = $(this).prop('maxlength');
			var textLength = $(this).val().length;
	        var textRemaining = maxLength - textLength;
	        var set50 = false; // flag.
	        var set75 = false; // flag.
	        var setDefault = false;
			if (textLength/maxLength > 0.75) { // exceed 75%.
				if (!set75) { // check flag if process already fired.
					$(this).css('background', '#ffcccc');
					set75 = true; // change flag.
				}
				$('#' + $(this).attr('id') + '_feedback').html(textRemaining + ' characters remaining'); // update char remaining.
			}
			else if (textLength/maxLength > 0.5) {
				if (!set50) {
					$(this).css('background', '#ffff99');
					set50 = true;
				}
				$('#' + $(this).attr('id') + '_feedback').html(textRemaining + ' characters remaining');
			}
			else { // less than 50%. 
				if (!setDefault) { 
					$(this).css('background', '');
					$('#' + $(this).attr('id') + '_feedback').html('');
					setDefault = true;
				}
			}
		}); // update feedback for text and textarea.

		$('.text_area_feedback').change(function(){
			$('#' + $(this).attr('id') + '_feedback').html('');
			$(this).css('background', '');
		}); // clear css and feeback of text and textarea after change.

		$('input[name=comorbid_DM]').click(function() {toggleComorbidDetailCollapse($(this));});  // DM.

		$('input[name=comorbid_CAD]').click(function() {toggleCAD();}); // CAD.

		$('input[name=CAD_dx]').click(function() {getOtherText($(this),"radio");}); // CAD_dx choice.

		$('input[name=comorbid_VHD]').click(function() {toggleVHD();}); // VHD choice.

		$('input[name=comorbid_stroke]').click(function() {toggleComorbidDetailCollapse($(this));});  // stroke.

		$('input[name=comorbid_CKD]').click(function() {toggleComorbidDetailCollapse($(this));});  // CKD.

		$('input[name=comorbid_hyperlipidemia]').click(function() {toggleComorbidDetailCollapse($(this));});  // hyperlipidemia.

		$('input[name=comorbid_cirrhosis]').click(function() {toggleCirrhosis();});  // cirrhosis.

		$('input[name=comorbid_HIV]').click(function() {toggleHIV();});  // HIV.

		$('input[name=comorbid_epilepsy]').click(function() {toggleEpilepsy();});  // epilepsy.

		$('input[name=epilepsy_dx]').click(function() {getOtherText($(this),"radio");}); // epilepsy_dx choice.

		$('input[name=comorbid_leukemia]').click(function() {toggleComorbidDetailCollapse($(this));});  // leukemia.

		$('input[name=comorbid_lymphoma]').click(function() {toggleLymphoma();});  // lymphoma. 

		$('#lymphoma_dx_select').change(function() {getOtherText($(this),"select");});  // lymphoma_dx select.

		$('input[name=comorbid_pacemaker_implant]').click(function() {togglePaceMakerImplant();});  // pacemaker implant.

		$('input[name=pacemaker_implant_type]').click(function() {getOtherText($(this),"radio");}); // pacemaker_implant_type.

		$('input[name=comorbid_ICD]').click(function() {toggleICD();});  // ICD.

		$('input[name=comorbid_cancer]').click(function() {toggleCancer();});  // cancer.

		$('input[name=comorbid_chronic_arthritis]').click(function() {toggleChronicArthritis();});  // chronic_arthritis_other.

		$('input[name=comorbid_other_autoimmune_disease]').click(function() {toggleOtherAutoimmuneDisease();});  // other autoimmune disease.

		$('input[name=comorbid_TB]').click(function() {toggleTB();});  // TB.

		$('input[name=comorbid_dementia]').click(function() {toggleDementia();});  // comorbid_dementia.

		$('input[name=comorbid_psychiatric_illness]').click(function() {togglePsychiatricIllness();});  // comorbid_psychiatric_illness.

		$("input[name=pregnant]").click(function() {togglePregnantWeeks();});

		$("input[name='alcohol']").click(function() {toggleAlcoholTemplate();});

		$("input[name='smoking']").click(function() {toggleSmokingTemplate();});

		// $.ajax({
		// 	type: "GET",
		// 	url: "{{ url('/assets/csv/drugList.txt') }}",
		// 	dataType: "text",
		// 	success: function(data) {processData(data);}
		// }); // add URL and function for durgs source.
		
		// var durgs =[]; // global variable.
		
		// function processData(myTxt) {
		// 	var myLines = myTxt.split('\r'); // split by \r for unix like server.
		// 	for (var i=1; i<myLines.length; i++) { // push each line to drugs[].
		// 		durgs.push(myLines[i]);
		// 	}
		// } // handle data from ajax.

		// $( "#current_medications_suggest" ).autocomplete({
	 //    	source: durgs,
	 //    	minLength: 2,
	 //    	select: function(event, ui) {
		// 		event.preventDefault(); // prevent defualt select event.
		// 		$(this).val(ui.item.label); // set current_medications_suggest to label selected.
		// 		$("#current_medications").val() != '' ? $("#current_medications").val($("#current_medications").val() + '\n' + $(this).val()) : $("#current_medications").val($(this).val()); // set current_medications + selected label.
		// 		$(this).val(''); // clear current_medications_suggest input after added.
		// 		autosize.update($('#current_medications')); // update current_medications rows.
		// 	}
		// }); // handle autocomplete for current_medications_suggest input.

		$( "#current_medications_suggest" ).autocomplete({
			source: function( request, response ) {
				$.ajax({
					url: "/itemize/drug/" + request.term, // medicine attending URL.
					dataType: "JSON",
					success: function( data ) {
						response(data);
					}
				});
			},
			focus: function(event, ui) {
				event.preventDefault();
				$(this).val(ui.item.label); // set attending_name = doctor_name.
			},
			select: function(event, ui) {
				event.preventDefault();
				$(this).val(ui.item.label);
				$("#current_medications").val() != '' ? $("#current_medications").val($("#current_medications").val() + '\n' + $(this).val()) : $("#current_medications").val($(this).val()); // set current_medications + selected label.
				// $("#attending_id").val(ui.item.value); // set attending_id = value.
				$(this).val(''); // clear current_medications_suggest input after added.
				autosize.update($('#current_medications')); // update current_medications rows.
			},
    		minLength: 2, // min length before query.
    	}); // attending autocomplete.

		$('#addmed').click(function() {
			$("#current_medications").val() != '' ? $("#current_medications").val($("#current_medications").val() + '\n' + $('#current_medications_suggest').val()) : $("#current_medications").val($('#current_medications_suggest').val()); // set current_medications + current_medications_suggest.
			$('#current_medications_suggest').val(''); // clear current_medications_suggest after add click.
			autosize.update($('#current_medications')); // auto current_medications rows.
			$('#current_medications_suggest').focus(); // promt current_medications_suggest ready to continue.
		}); // click event handler for add medicine button.
	
		$("input[name=breathing]").click(function() {toggleBreathingO2();}); // toggle breathing.

		$("input[name=breathing_on]").click(function() {oxygenUnit();}); // change oygen unit by breathing on.


		// triger event on document ready.
		toggleReasonAdmitOther(); // reason_admit.
		toggleComorbidDetailCollapse($('input[name=comorbid_DM]')); // DM choice.
		toggleCAD(); // All CAD procedure.
		toggleVHD(); // All VHD procedure.
		toggleComorbidDetailCollapse($('input[name=comorbid_stroke]')); // stroke choice.
		toggleComorbidDetailCollapse($('input[name=comorbid_CKD]')); // CKD choice.
		toggleComorbidDetailCollapse($('input[name=comorbid_hyperlipidemia]')); // hyperlipidemia choice.
		toggleCirrhosis(); // cirrhosis choice.
		toggleHIV(); // HIV choice.
		toggleEpilepsy(); // epilepsy choice.
		toggleComorbidDetailCollapse($('input[name=comorbid_leukemia]')); // leukemia choice.
		toggleLymphoma(); // lymphoma.
		togglePaceMakerImplant(); // comorbid pacemaker implant.
		toggleICD(); // ICD choice.
		toggleCancer(); // cancer choice.
		toggleChronicArthritis(); // chronic_arthritis_other choice.
		toggleOtherAutoimmuneDisease(); // other autoimmune disease.
		toggleTB(); // TB
		toggleDementia(); // comorbid_dementia.
		togglePsychiatricIllness(); // comorbid_psychiatric_illness.
		// if ("{{ session('patient_gender') }}" == "หญิง") $("#woman_only").collapse('show'); // check if patient_gender = female then show female section.
		togglePregnantWeeks(); // Gastation.
		toggleBreathingO2(); // breating.
		oxygenUnit(); //change oygen unit by breathing on.
		setGCS(); // initial GCS from E+V+M data.
	});
</script>

<!-- Part Note -->
<!-- <div class="panel panel-primary">
	<div class="panel-heading"></div> 
	<div class="panel-body">
	</div>
</div> -->
<input id="save_form" style="display:none;" type="submit" value="Save">
{!! Form::close() !!}
@section('save_ops')
<!--  -->
@endsection

@endsection
