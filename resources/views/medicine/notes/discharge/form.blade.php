@extends('form')

@section('doc_title' , $note->note->type->name . ' - Form')

@section('description', 'siriraj medicine admission note form')

@section('author', 'koramit Pichana')

@section('background_image',"url('/assets/images/footer_lodyas.png');")

@section('nav_menu')
<li><a href="#admission_data">Admission data</a></li>
<li><a href="#chief_complaint_panel">Chief complaint</a></li>
<li><a href="#comorbid_div">Comorbid</a></li>
<li><a href="#personal_social_history_panel">Personal and Social history</a></li>
@endsection

@section('content')
@include('partials.flash')
@include('errors.invalid')

<div class="col-md-offset-1 col-md-10 col-sm-12"><!-- main_frame -->
	@include('medicine.partials.primary-data')

	<div class="panel panel-primary">
	    <div class="panel-heading" id="history">Treatments Description</div> 
	    <div class="panel-body">

	        <!-- panel Principle diagnosis. -->
	        <div class="panel panel-info">
	            <div class="panel-heading">Principle diagnosis</div>
	            <!-- field principle_diagnosis type mediumText -->
	            <div class="panel-body">
	                <textarea name="principle_diagnosis" id="principle_diagnosis" class="form-control text_area_feedback" rows="1" maxlength="200" placeholder="200 characters max.">{{ $note->principle_diagnosis }}</textarea>
					<div id="principle_diagnosis_feedback" style="color:#b3b3b3"></div>
	            </div>
	        </div>

	        <!-- panel Reason for admission. -->
	        <div class="panel panel-info">
	            <div class="panel-heading">Reason for admission</div>
	            <!-- field reason_admit type mediumText -->
	            <div class="panel-body">
	            	<textarea name="reason_admit" id="reason_admit" class="form-control text_area_feedback" rows="1" maxlength="100" placeholder="100 characters max.">{{ $note->reason_admit }}</textarea>
					<div id="reason_admit_feedback" style="color:#b3b3b3"></div>
	            </div>
	        </div>

	        <!-- panel Comorbids. -->
	        <div class="panel panel-info">
	            <div class="panel-heading">Comorbids</div>
	            <!-- field comorbids type mediumText -->
	            <div class="panel-body">
	            	<textarea name="comorbids" id="comorbids" class="form-control text_area_feedback" rows="1" maxlength="1000" placeholder="1000 characters max.">{{ $note->comorbids }}</textarea>
					<div id="comorbids_feedback" style="color:#b3b3b3"></div>
	            </div>
	        </div>

	        <!-- panel Complications. -->
	        <div class="panel panel-info">
	            <div class="panel-heading">Complications</div>
	            <!-- field complications type mediumText -->
	            <div class="panel-body">
	            	<textarea name="complications" id="complications" class="form-control text_area_feedback" rows="1" maxlength="1000" placeholder="1000 characters max.">{{ $note->complications }}</textarea>
					<div id="complications_feedback" style="color:#b3b3b3"></div>
	            </div>
	        </div>

	        <!-- panel External Causes. -->
	        <div class="panel panel-info">
	            <div class="panel-heading">External Causes</div>
	            <!-- field external_causes type mediumText -->
	            <div class="panel-body">
	            	<textarea name="external_causes" id="external_causes" class="form-control text_area_feedback" rows="1" maxlength="1000" placeholder="1000 characters max.">{{ $note->external_causes }}</textarea>
					<div id="external_causes_feedback" style="color:#b3b3b3"></div>
	            </div>
	        </div>

	        <!-- panel Other Diagnosis. -->
	        <div class="panel panel-info">
	            <div class="panel-heading">Other Diagnosis</div>
	            <!-- field other_diagnosis type mediumText -->
	            <div class="panel-body">
	            	<textarea name="other_diagnosis" id="other_diagnosis" class="form-control text_area_feedback" rows="1" maxlength="200" placeholder="200 characters max.">{{ $note->other_diagnosis }}</textarea>
					<div id="other_diagnosis_feedback" style="color:#b3b3b3"></div>
	            </div>
	        </div>

	        <!-- panel OR procedures. -->
	        <div class="panel panel-info">
	            <div class="panel-heading">OR procedures</div>
	            <!-- field OR_procedure type mediumText -->
	            <div class="panel-body">
	            	<textarea name="OR_procedure" id="OR_procedure" class="form-control text_area_feedback" rows="1" maxlength="1000" placeholder="1000 characters max.">{{ $note->OR_procedure }}</textarea>
					<div id="OR_procedure_feedback" style="color:#b3b3b3"></div>
	            </div>
	        </div>

	        <!-- panel Non OR procedures. -->
	        <div class="panel panel-info">
	            <div class="panel-heading">Non OR procedures</div>
	            <!-- field non_OR_procedure type mediumText -->
	            <div class="panel-body">
	            	<textarea name="non_OR_procedure" id="non_OR_procedure" class="form-control text_area_feedback" rows="1" maxlength="1000" placeholder="1000 characters max.">{{ $note->non_OR_procedure }}</textarea>
					<div id="non_OR_procedure_feedback" style="color:#b3b3b3"></div>
	            </div>
	        </div>

	        <!-- panel Chief complaint -->
	        <div class="panel panel-info">
	            <div class="panel-heading">Chief complaint</div>
	            <!-- field chief_complaint type mediumText -->
	            <div class="panel-body">
	            	<textarea name="chief_complaint" id="chief_complaint" class="form-control text_area_feedback" rows="1" maxlength="1000" placeholder="1000 characters max.">{{ $note->chief_complaint }}</textarea>
					<div id="chief_complaint_feedback" style="color:#b3b3b3"></div>
	            </div>
	        </div>

	        <!-- panel Significant Findings. -->
	        <div class="panel panel-info">
	            <div class="panel-heading">Significant Findings</div>
	            <!-- field significant_findings type mediumText -->
	            <div class="panel-body">
	                <textarea name="significant_findings" id="significant_findings" class="form-control text_area_feedback" rows="1" maxlength="1000" placeholder="1000 characters max.">{{ $note->significant_findings }}</textarea>
					<div id="significant_findings_feedback" style="color:#b3b3b3"></div>
	            </div>
	        </div>

	        <!-- panel Significant Procedured. -->
	        <div class="panel panel-info">
	            <div class="panel-heading">Significant Procedured</div>
	            <!-- field significant_procedured type mediumText -->
	            <div class="panel-body">
	                <textarea name="significant_procedured" id="significant_procedured" class="form-control text_area_feedback" rows="1" maxlength="1000" placeholder="1000 characters max.">{{ $note->significant_procedured }}</textarea>
					<div id="significant_procedured_feedback" style="color:#b3b3b3"></div>
	            </div>
	        </div>

	        <!-- panel Hospital Course. -->
	        <div class="panel panel-info">
	            <div class="panel-heading">Hospital Course</div>
	            <!-- field hospital_course type mediumText -->
	            <div class="panel-body">
	                <textarea name="hospital_course" id="hospital_course" class="form-control text_area_feedback" rows="1" maxlength="1000" placeholder="1000 characters max.">{{ $note->hospital_course }}</textarea>
					<div id="hospital_course_feedback" style="color:#b3b3b3"></div>
	            </div>
	        </div>      

	        <!-- panel Condition upon Discharge. -->
	        <div class="panel panel-info">
	            <div class="panel-heading">Condition upon Discharge</div>
	            <!-- field condition_upon_DC type mediumText -->
	            <div class="panel-body">
	            	<label><input type="checkbox" name=""> ยังนอนต่อเนื่องที่ รพ. ทำ admit และ discharge ต่อเนื่อง </label>
	            	<label class="radio-inline"><input type="radio" name="continuous_admit_patient_status">สบายดี</label>
	            	<label class="radio-inline"><input type="radio" name="continuous_admit_patient_status">stable</label>
	            	<label class="radio-inline"><input type="radio" name="continuous_admit_patient_status">เสียชีวิต</label>
	                @include('medicine.notes.discharge.template.condition-upon-dc')
	                <textarea name="condition_upon_DC" id="condition_upon_DC" class="form-control text_area_feedback" rows="1" maxlength="1000" placeholder="1000 characters max.">{{ $note->condition_upon_DC }}</textarea>
					<div id="condition_upon_DC_feedback" style="color:#b3b3b3"></div>
	            </div>
	        </div>

	        <!-- panel Discharge Status. -->
	        <div class="panel panel-info">
	            <div class="panel-heading">Discharge Status</div>
	            <!-- field condition_upon_DC type mediumText -->
	            <div class="panel-body">
	                <div class='form-group col-md-12'>
	                    <!-- field discharge_status type tinyInteger -->
	                    <label class="col-md-2" for="discharge_status">Discharge Status :</label>
	                    <div class="col-md-10">
	                        <label class="radio-inline"><input type="radio" name='discharge_status' value="1">COMPLETE RECOVERY</label>
	                        <label class="radio-inline"><input type="radio" name='discharge_status' value="2">IMPROVED</label>
	                        <label class="radio-inline"><input type="radio" name='discharge_status' value="3">NOT IMPROVED</label>
	                        <label class="radio-inline"><input type="radio" name='discharge_status' value="4">DEAD</label>
	                    </div>
	                    <script type="text/javascript">
	                        $('input[name=discharge_status]').click(function() { // *** NEED TO CLEAR CONTENT FOR HIDE.
	                            $('input[name=discharge_type]').prop('checked',false);
	                            if ($(this).val() == 4) {
	                                $('#discharge_type_alive_collapse').collapse('hide');
	                                $('#home_medications_collapse').collapse('hide');
	                                $('#follow_up_instruction_collapse').collapse('hide');
	                                $('#follow_up_schedule_collapse').collapse('hide');
	                                $('#discharge_type_dead_collapse').collapse('show');

	                            } else {
	                                $('#discharge_type_dead_collapse').collapse('hide');
	                                $('#discharge_type_alive_collapse').collapse('show');
	                                $('#home_medications_collapse').collapse('show');
	                                $('#follow_up_instruction_collapse').collapse('show');
	                                $('#follow_up_schedule_collapse').collapse('show'); 
	                            }
	                        });
	                    </script>
	                </div>
	                
	                <div class="form-group col-md-12 collapse" id="discharge_type_alive_collapse">
	                    <!-- field discharge_type type tinyInteger -->
	                    <label class="col-md-2" for="discharge_type">Discharge Type :</label>
	                    <div class="col-md-10">
	                        <label class="radio-inline"><input type="radio" name="discharge_type" value="1">WITH APPROVAL</label>
	                        <label class="radio-inline"><input type="radio" name="discharge_type" value="2">AGAINST ADVICE</label>
	                        <label class="radio-inline"><input type="radio" name="discharge_type" value="3">BY ESCAPE</label>
	                        <label class="radio-inline"><input type="radio" name="discharge_type" value="4">BY TRANSFER</label>
	                        <label class="radio-inline"><input type="radio" name="discharge_type" value="5">OTHER SPECIFY</label>
	                    </div>
	                </div>
	                <div class="form-group col-md-12 collapse" id="discharge_type_dead_collapse">
	                    <!-- field discharge_type type tinyInteger -->
	                    <label class="col-md-2" for="discharge_type">Discharge Type :</label>
	                    <div class="col-md-10">
	                        <label class="radio-inline"><input type="radio" name="discharge_type" value="1">DEAD AUTOPSY</label>
	                        <label class="radio-inline"><input type="radio" name="discharge_type" value="2">DEAD NO AUTOPSY</label>
	                    </div>
	                </div>
	            </div>
	        </div>

	        <div class="panel panel-info">
	            <div class="panel-heading">Significant medications and treatments during admission </div>
	            <div class="panel-body">
	                <div class='well'>
	                    {{-- 
	                    <div class='form-group col-md-6'>{!! Form::text('admit_rx_medications_suggest',null,['class' => 'form-control ui-widget', 'placeholder' => 'type to auto-complete', 'id' => 'admit_rx_medications_suggest']) !!}</div>
 --}}
 						<div class="input-group">
 							<input class="form-control ui-widget autocomplete-to-textarea" type="text" target="admit_rx_medications" endpoint="/itemize/drug/">
 							<span class="input-group-btn">
 								<button class="btn btn-default btn-autocomplete-to-textarea" type="button" target="admit_rx_medications"><span class="fa fa-medkit"></span></button>
 							</span>
 						</div>
	                    {{-- <button type="button" class="btn btn-primary tools" id="addmedadmit_rx">Add</button> --}}
	                </div>
	                <!-- field admit_rx_medications type text -->
	                <textarea name="admit_rx_medications" id="admit_rx_medications" class="form-control text_area_feedback" rows="1" maxlength="1000" placeholder="1000 characters max.">{{ $note->admit_rx_medications }}</textarea>
					<div id="admit_rx_medications_feedback" style="color:#b3b3b3"></div>
	            </div>
	        </div><!-- end panel admit_rx medications  -->

	        <div class="panel panel-info collapse" id='home_medications_collapse'>
	            <div class="panel-heading">Home medications </div>
	            <div class="panel-body">
	                <div class='well'>
	                	<div class="input-group">
 							<input class="form-control ui-widget autocomplete-to-textarea" type="text" target="home_medications" endpoint="/itemize/drug/">
 							<span class="input-group-btn">
 								<button class="btn btn-default btn-autocomplete-to-textarea" type="button" target="home_medications"><span class="fa fa-medkit"></span></button>
 							</span>
 						</div>
	                </div>
	                <!-- field home_medications type text -->
	                <textarea name="home_medications" id="home_medications" class="form-control text_area_feedback" rows="1" maxlength="1000" placeholder="1000 characters max.">{{ $note->home_medications }}</textarea>
					<div id="home_medications_feedback" style="color:#b3b3b3"></div>
	            </div>
	        </div><!-- end panel home medications  -->


	        <!-- panel Follow up schedule. -->
	        <div class="panel panel-info collapse" id='follow_up_schedule_collapse'>
	            <div class="panel-heading">Follow up schedule and instruction</div>

	            <!-- field follow_up type mediumText -->
	            <div class="panel-body">
	            	@include('medicine.notes.discharge.template.followup')
	                <textarea name="follow_up" id="follow_up" class="form-control text_area_feedback" rows="1" maxlength="1000" placeholder="1000 characters max.">{{ $note->follow_up }}</textarea>
					<div id="follow_up_feedback" style="color:#b3b3b3"></div>
	            </div>
	        </div>
	    </div>
	</div><!-- end of History -->
	<div class='well'>
	    <center>End of Medicine discharge summary form.</center>
	</div>
</div><!-- end of main_frame -->

@endsection

@section('form_script')
@include('medicine.notes.admission.script')
@endsection