<div class="panel panel-primary" id="admission_data"><!-- admission_data -->
	<div class="panel-heading">Admission data</div> 
	<div class="panel-body">
		<div class="form-horizontal row"><!-- Preliminary form -->
			<div class='col-md-6'><!-- Note HN -->
				<div class="form-group">
					<label class="control-label col-md-4" for="HN">HN :</label>
					<div class='col-md-4'>
						<input type='text' class='form-control text-center' value="{{ $note->note->patient->HN }}" name='HN' readonly />
					</div>
				</div>
			</div>
			<div class='col-md-6'><!-- Note Patient Name -->
				<div class="form-group">
					<label for="patient_name" class="control-label col-md-4">Patient Name <a title="ยังไม่ได้ทำ"><span class="fa fa-info-circle"></span></a> :</label>
					<div class='col-md-8'> 
						<input type='text' class='form-control' value="{{ $note->note->patient->getName() }}" name='patient_name' readonly title='แสดงชื่อเดิม (ถ้ามี)'/>
					</div>
				</div>
			</div>
			<div class='col-md-6'><!-- Note AN -->
				<div class="form-group">
					<label class="control-label col-md-4" for="AN">AN :</label>
					<div class='col-md-4'>
						<input type='text' class='form-control text-center' value="{{ $note->note->AN }}" name='AN' readonly />
					</div>
				</div>
			</div>
			<div class='col-md-6'><!-- Note Age -->
				<div class="form-group">
					<label class="control-label col-md-4" for="age">Age@Note :</label>
					<div class='col-md-4'> 
						<input type='text' class='form-control text-center' value="{{ $note->note->patient->ageAtDate($note->note->created_at) }}" name='patient_age' readonly />
					</div>
				</div>
			</div>
			<div class='col-md-6'><!-- Note datetime_admit -->
				<div class="form-group">
					<label for="datetime_admit" class="control-label col-md-4">Date admit <a title="{{ $note->note->getLOS() }}"><span class="fa fa-info-circle"></span></a> :</label>
					<div class='col-md-8'>
						<input type="text" name="datetime_admit" class="form-control" readonly value="{{ $note->note->getDate('admit', 'full') }}" />
					</div>
				</div>
			</div>
			<div class='col-md-6'><!-- Note datetime_dc -->
				<div class="form-group">
					<label for="datetime_dc" class="control-label col-md-4">Date D/C <a title="{{ $note->note->getLOS() }}"><span class="fa fa-info-circle"></span></a> :</label>
					<div class='col-md-8'>
						<input type="text" name="datetime_dc" class="form-control" readonly value="{{ $note->note->getDate('dc', 'full') }}" />
					</div>
				</div>
			</div>
			<!-- Note ward_id -->
			<input type="hidden" name="ward_id" id="ward_id" value="{{ $note->note->ward_id }}">
			<div class='col-md-6'><!-- Note ward_name -->
				<div class="form-group">
					<label for="ward_name" class="control-label col-md-4">Location <a title="" id="ward_name_info"><span class="fa fa-info-circle"></span></a> :</label>
					<div class='col-md-8'>
						<div class="input-group">
							<span class="input-group-addon" id="basic-addon1"><i class="fa fa-lightbulb-o"></i></span>
							<input type='text' class='form-control ui-widget' value="{{ $note->note->ward->name }}" name='ward_name' id='ward_name' placeholder='type for suggestion'/>
							<span class="input-group-btn">
								<button class="btn btn-default" type="button"><span class="fa fa-undo"></span></button>
							</span>
						</div>
					</div>
				</div>
			</div>
			<!-- Note attending_id -->
			<input type="hidden" name="attending_id" id="attending_id" value="{{ $note->note->attending_id }}">
			<div class='col-md-6'><!-- Note attending_name -->
				<div class="form-group">
					<label for="attending_name" class="control-label col-md-4">Attending <a title="{{ $note->note->attending->getDetail()  }}" id="attending_name_info"><span class="fa fa-info-circle"></span></a> :</label>
					<div class='col-md-8'>
						<div class="input-group">
							<span class="input-group-addon" id="basic-addon1"><i class="fa fa-lightbulb-o"></i></span>
							<input type="text" name="attending_name" value="{{ $note->note->attending->name }}" class="form-control ui-widget" id="attending_name" placeholder="type for suggestion" />
							<span class="input-group-btn">
								<button class="btn btn-default" type="button"><span class="fa fa-undo"></span></button>
							</span>
						</div>
					</div>
				</div>
			</div>
		</div><!-- end of horizon form -->
	</div><!-- end of preliminary data body -->
</div>