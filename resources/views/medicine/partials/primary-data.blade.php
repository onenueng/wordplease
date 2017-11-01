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