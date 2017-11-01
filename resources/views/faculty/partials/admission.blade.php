<div class="panel panel-primary" id="preliminary_data"><!-- preliminary data -->
	<div class="panel-heading">Preliminary data</div> 
	<div class="panel-body form-horizontal row">
		<div class='col-sm-6'><!-- HN -->
			<div class="form-group">
				<label class="col-sm-4 control-label" for="HN">Patient ID :</label>
				<div class='col-sm-4'><input type='text' class='form-control text-center' value="{{ $note->note->patient->HN }}" name='HN' readonly /></div>
			</div>
		</div>
		<div class='col-sm-6'><!-- Patient Name -->
			<div class="form-group">
				<label for="patient_name" class="control-label col-sm-4">Patient Name <a title="ยังไม่ได้ทำ"><span class="fa fa-info-circle"></span></a> :</label>
				<div class='col-sm-8'> 
				<input type='text' class='form-control' value="{{ $note->note->patient->getName() }}" name='patient_name' readonly title='แสดงชื่อเดิม (ถ้ามี)'/>
			</div>
			</div>
		</div>
		<div class='col-sm-6'><!-- Gender text -->
			<div class="form-group">
				<label for="gender" class="control-label col-sm-4">Gender <span class="fa {{ $note->note->patient->gender ? 'fa-mars' : 'fa-venus' }}"></span> :</label>
				<div class='col-sm-4'>
					<input type='text' class='form-control text-center' value="{{ $note->note->patient->getGendertext() }}" name='patient_gender' readonly />
				</div>
			</div>
		</div>
		<div class='col-sm-6'><!-- Age at Note -->
			<div class="form-group">
				<label class="col-sm-4 control-label" for="age">Age@Note :</label>
				<div class='col-sm-4'> 
					<input type='text' class='form-control text-center' value="{{ $note->note->patient->ageAtDate($note->note->created_at) }}" name='patient_age' readonly />
				</div>
			</div>
		</div>
		<div class='col-sm-6'><!-- AN -->
			<div class="form-group">
				<label class="col-sm-4 control-label" for="AN">Encounter ID :</label>
				<div class='col-sm-4'><input type='text' class='form-control text-center' value="{{ $note->note->AN }}" name='AN' readonly /></div>
			</div>
		</div>
		<div class='col-sm-6'><!-- field encounter_type type TinyInteger -->
			<div class="form-group">
				<label class="col-sm-4 control-label" for="encounter_type">Encounter Type :</label>
				<div class="col-sm-8">
					<label class="radio-inline"><input type="radio" name="encounter_type" value="1" {{ $note->encounter_type == 1 ? 'checked' : '' }}>Inpatient</label>
					<label class="radio-inline"><input type="radio" name="encounter_type" value="2" {{ $note->encounter_type == 2 ? 'checked' : '' }}>Outpatient</label>
				</div>
			</div>
		</div><div class="col-sm-12"></div>
		<div class='col-sm-6'><!-- Datetime Admit-->
			<div class="form-group">
				<label for="datetime_admit" class="control-label col-sm-4">Date admit <a title="{{ $note->note->getLOS() }}"><span class="fa fa-info-circle"></span></a> :</label>
				<div class='col-sm-8'><input type="text" name="datetime_admit" class="form-control" readonly value="{{ $note->note->getDate('admit', 'full') }}" /></div>
			</div>
		</div>
		<div class='col-sm-6'><!-- Datetime Discharge -->
			<div class="form-group">
				<label for="datetime_dc" class="control-label col-sm-4">Date D/C <a title="{{ $note->note->getLOS() }}"><span class="fa fa-info-circle"></span></a> :</label>
				<div class='col-sm-8'><input type="text" name="datetime_dc" class="form-control" readonly value="{{ $note->note->getDate('dc', 'full') }}" /></div>
			</div>
		</div>
		<input type="hidden" name="ward_id" id="ward_id" value="{{ $note->note->ward_id }}">
		<div class='col-sm-6'><!-- ward_id + ward_name -->
			<div class="form-group">
				<label for="ward_name" class="control-label col-sm-4">Location <a title="" id="ward_name_info"><span class="fa fa-info-circle"></span></a> :</label>
				<div class='col-sm-8'>
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1"><i class="fa fa-lightbulb-o"></i></span>
						<input type='text' class='form-control ui-widget' value="{{ $note->note->getWardName() }}" name='ward_name' id='ward_name' placeholder='type for suggestion'/>
						<span class="input-group-btn">
							<button class="btn btn-default" type="button"><span class="fa fa-undo"></span></button>
						</span>
					</div>
				</div>
			</div>
		</div>
		<input type="hidden" name="attending_id" id="attending_id" value="{{ $note->note->attending_id }}">
		<div class='col-sm-6'><!-- attending_id + attending_name -->
			<div class="form-group">
				<label for="attending_name" class="control-label col-sm-4">Attending <a title="{{ $note->note->getAttendingData('detail') }}" id="attending_name_info"><span class="fa fa-info-circle"></span></a> :</label>
				<div class='col-sm-8'>
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1"><i class="fa fa-lightbulb-o"></i></span>
						<input type="text" name="attending_name" value="{{ $note->note->getAttendingData() }}" class="form-control ui-widget" id="attending_name" placeholder="type for suggestion" />
						<span class="input-group-btn">
							<button class="btn btn-default" type="button"><span class="fa fa-undo"></span></button>
						</span>
					</div>
				</div>
			</div>
		</div>
		<input type="hidden" name="division_id" id="division_id" value="{{ $note->note->division_id }}">
		<div class='col-sm-6'><!-- division_id + division_name -->
			<div class="form-group">
				<label for="division_name" class="control-label col-sm-4">Specialty <a title="" id="division_name_info"><span class="fa fa-info-circle"></span></a> :</label>
				<div class='col-sm-8'>
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1"><i class="fa fa-lightbulb-o"></i></span>
						<input class="form-control ui-widget" type="text" name="division_name" id="division_name" placeholder="type for suggestion" value="{{ $note->note->getDivisionName() }}">
						<span class="input-group-btn">
							<button class="btn btn-default" type="button"><span class="fa fa-undo"></span></button>
						</span>
					</div>
				</div>
			</div>
		</div>
	</div><!-- end of preliminary data body -->
</div><!-- end of preliminary data -->