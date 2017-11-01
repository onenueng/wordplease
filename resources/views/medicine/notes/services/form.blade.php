@extends('medicine.form')

@section('doc_title')
{{ $anote->note_type_name }}
@endsection

@section('description')siriraj medicine admission note form @endsection

@section('author')koramit Pichana @endsection

@section('script')
@include('wordplease_js')
@endsection

@section('content')
@include('partials.flash')
<!-- {!! Form::open(['url' => '/', 'id' => 'admission_note']) !!} -->
{!! Form::model($anote,['method' => 'PATCH', 'action' => ['IPDNote\Medicine\MedicineNotesController@update',$anote->note_id]]) !!}

<div class="col-md-offset-1 col-md-10"><!-- main_frame -->
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
				<input type='text' class='form-control' value="{{ session('patient_name') }}" name='patient_name' readonly title='แสดงชื่อเดิม (ถ้ามี)'/>
				</div>
			</div>

			<!-- field gender type session -->
			<div class='col-md-6 form-group'>
				{!! Form::label('gender','Gender :',['class' => 'control-label col-md-4']) !!}
				<div class='col-md-4'>
					<input type='text' class='form-control' value="{{ session('patient_gender') }}" name='patient_gender' readonly />
				</div>
			</div>

			<!-- field age type session -->
			<div class='col-md-6 form-group'>
				{!! Form::label('age','Age :',['class' => 'control-label col-md-4']) !!}
				<div class='col-md-4'> 
					<input type='text' class='form-control' value="{{ session('patient_age') }}" name='patient_age' readonly />
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
				<div class='col-md-4'> {!! Form::text('date_admit',null,['class' => 'form-control', 'readonly', 'title' => session('LOS')]) !!} </div>
			</div>

			<!-- field ward_id type smallInteger -->
			{!! Form::input('hidden','ward_id',null,['id' => 'ward_id']) !!}
			<div class='col-md-6 form-group'>
				{!! Form::label('ward_id','Ward :',['class' => 'control-label col-md-4']) !!}
				@if (!is_null($anote->ward_id))
				<div class='col-md-8'><input type='text' class='form-control ui-widget' value="{{ session('ward_name') }}" name='ward_name' id='ward_name' placeholder='type for suggestion'/></div>
				@else
				<div class='col-md-8'><input type='text' class='form-control ui-widget' name='ward_name' id='ward_name' placeholder='type for suggestion'/></div>
				@endif
			</div>

			<!-- field resident_id type smallInteger -->
			{!! Form::input('hidden','resident_id',null,['id' => 'resident_id']) !!}
			<div class='form-group col-md-6'>
				{!! Form::label('resident_name','Resident :',['class' => 'control-label col-md-4']) !!}
				<div class='col-md-8'> {!! Form::text('resident_name',null,['class' => 'form-control ui-widget','id' => 'resident_name', 'placeholder' => 'type for suggestion']) !!} </div>
				<!-- 
				@if (!is_null($anote->resident_id))
				<script type="text/javascript">$('#resident_name').val('{{$data['province']}}'); </script>
				@endif
				 -->
			</div>
		</div><!-- end of horizon form -->
	</div><!-- end of preliminary data body -->
</div><!-- end of preliminary data -->
<div class="panel panel-primary">
	<div class="panel-heading" id="history">Treatments Description</div> 
	<div class="panel-body">
		<!-- panel Chief complaint -->
		<div class="panel panel-info">
			<div class="panel-heading">Chief complaint</div>
			<!-- field chief_complaint type mediumText -->
			<div class="panel-body">
				{!! Form::textarea('chief_complaint',null,['class' => 'form-control text_area_feedback', 'rows' => '1', 'id' => 'chief_complaint', 'maxlength' => '20','placeholder' => '1000 characters max.']) !!}
				<div id="chief_complaint_feedback" style="color:#b3b3b3"></div>
			</div>
		</div>

		<!-- panel Comorbids. -->
		<div class="panel panel-info">
			<div class="panel-heading">Comorbids</div>
			<!-- field comorbids type mediumText -->
			<div class="panel-body">
				{!! Form::textarea('comorbids',null,['class' => 'form-control text_area_feedback', 'rows' => '1', 'id' => 'comorbids', 'maxlength' => '20','placeholder' => '1000 characters max.']) !!}
				<div id="comorbids_feedback" style="color:#b3b3b3"></div>
			</div>
		</div>
		
		<!-- panel History of present illness. -->
		<div class="panel panel-info">
			<div class="panel-heading">History of present illness</div>
			<!-- field history_present_illness type mediumText -->
			<div class="panel-body">
				{!! Form::textarea('history_present_illness',null,['class' => 'form-control text_area_feedback', 'rows' => '1', 'id' => 'history_present_illness', 'maxlength' => '20','placeholder' => 'Just one diagnosis, 200 characters max.']) !!}
				<div id="history_present_illness_feedback" style="color:#b3b3b3"></div>
			</div>
		</div>

		<!-- panel OR procedures. -->
		<div class="panel panel-info">
			<div class="panel-heading">OR procedures</div>
			<!-- field OR_procedure type mediumText -->
			<div class="panel-body">
				{!! Form::textarea('OR_procedure',null,['class' => 'form-control text_area_feedback', 'rows' => '1', 'id' => 'OR_procedure', 'maxlength' => '20','placeholder' => '1000 characters max.']) !!}
				<div id="OR_procedure_feedback" style="color:#b3b3b3"></div>
			</div>
		</div>

		<!-- panel Non OR procedures. -->
		<div class="panel panel-info">
			<div class="panel-heading">Non OR procedures</div>
			<!-- field non_OR_procedure type mediumText -->
			<div class="panel-body">
				{!! Form::textarea('non_OR_procedure',null,['class' => 'form-control text_area_feedback', 'rows' => '1', 'id' => 'non_OR_procedure', 'maxlength' => '20','placeholder' => '1000 characters max.']) !!}
				<div id="non_OR_procedure_feedback" style="color:#b3b3b3"></div>
			</div>
		</div>

		<!-- panel Hospital Course. -->
		<div class="panel panel-info">
			<div class="panel-heading">Hospital Course</div>
			<!-- field hospital_course type mediumText -->
			<div class="panel-body">
				{!! Form::textarea('hospital_course',null,['class' => 'form-control text_area_feedback', 'rows' => '1', 'id' => 'hospital_course', 'maxlength' => '20','placeholder' => '1000 characters max.']) !!}
				<div id="hospital_course_feedback" style="color:#b3b3b3"></div>
			</div>
		</div>

		<!-- panel Physical examination. -->
		<div class="panel panel-info">
			<div class="panel-heading">Physical examination</div>
			<!-- field physical_exam type mediumText -->
			<div class="panel-body">
				{!! Form::textarea('physical_exam',null,['class' => 'form-control text_area_feedback', 'rows' => '1', 'id' => 'physical_exam', 'maxlength' => '20','placeholder' => '1000 characters max.']) !!}
				<div id="physical_exam_feedback" style="color:#b3b3b3"></div>
			</div>
		</div>

		<!-- panel Assertment and plan. -->
		<div class="panel panel-info">
			<div class="panel-heading">Assertment and plan</div>
			<!-- field assessment_and_plan type mediumText -->
			<div class="panel-body">
				{!! Form::textarea('assessment_and_plan',null,['class' => 'form-control text_area_feedback', 'rows' => '1', 'id' => 'assessment_and_plan', 'maxlength' => '20','placeholder' => '1000 characters max.']) !!}
				<div id="assessment_and_plan_feedback" style="color:#b3b3b3"></div>
			</div>
		</div>
	</div>
</div><!-- end of History -->
<div class='well'>
	<center>End of Medicine {{ session('note_type') }} form.</center>
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
        $('#datetimepicker_date_admit').datetimepicker({
            locale: 'th',
            format: 'DD-MM-YYYY',
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

		$.ajax({
			type: "GET",
			url: "{{ url('/assets/csv/drugList.txt') }}",
			dataType: "text",
			success: function(data) {processData(data);}
		}); // add URL and function for durgs source.
		
		var durgs =[]; // global variable.
		
		function processData(myTxt) {
			var myLines = myTxt.split('\r'); // split by \r for unix like server.
			for (var i=1; i<myLines.length; i++) { // push each line to drugs[].
				durgs.push(myLines[i]);
			}
		} // handle data from ajax.

		$( "#admit_rx_medications_suggest" ).autocomplete({
	    	source: durgs,
	    	minLength: 2,
	    	select: function(event, ui) {
				event.preventDefault(); // prevent defualt select event.
				$(this).val(ui.item.label); // set admit_rx_medications_suggest to label selected.
				$("#admit_rx_medications").val() != '' ? $("#admit_rx_medications").val($("#admit_rx_medications").val() + '\n' + $(this).val()) : $("#admit_rx_medications").val($(this).val()); // set admit_rx_medications + selected label.
				$(this).val(''); // clear admit_rx_medications_suggest input after added.
				autosize.update($('#admit_rx_medications')); // update admit_rx_medications rows.
			}
		}); // handle autocomplete for admit_rx_medications_suggest input.

		$('#addmedadmit_rx').click(function() {
			$("#admit_rx_medications").val() != '' ? $("#admit_rx_medications").val($("#admit_rx_medications").val() + '\n' + $('#admit_rx_medications_suggest').val()) : $("#admit_rx_medications").val($('#admit_rx_medications_suggest').val()); // set admit_rx_medications + admit_rx_medications_suggest.
			$('#admit_rx_medications_suggest').val(''); // clear admit_rx_medications_suggest after add click.
			autosize.update($('#admit_rx_medications')); // auto admit_rx_medications rows.
			$('#admit_rx_medications_suggest').focus(); // promt admit_rx_medications_suggest ready to continue.
		}); // click event handler for add medicine button.

		$( "#home_medications_suggest" ).autocomplete({
	    	source: durgs,
	    	minLength: 2,
	    	select: function(event, ui) {
				event.preventDefault(); // prevent defualt select event.
				$(this).val(ui.item.label); // set home_medications_suggest to label selected.
				$("#home_medications").val() != '' ? $("#home_medications").val($("#home_medications").val() + '\n' + $(this).val()) : $("#home_medications").val($(this).val()); // set home_medications + selected label.
				$(this).val(''); // clear home_medications_suggest input after added.
				autosize.update($('#home_medications')); // update home_medications rows.
			}
		}); // handle autocomplete for home_medications_suggest input.

		$('#addmedhome').click(function() {
			$("#home_medications").val() != '' ? $("#home_medications").val($("#home_medications").val() + '\n' + $('#home_medications_suggest').val()) : $("#home_medications").val($('#home_medications_suggest').val()); // set home_medications + home_medications_suggest.
			$('#home_medications_suggest').val(''); // clear home_medications_suggest after add click.
			autosize.update($('#home_medications')); // auto home_medications rows.
			$('#home_medications_suggest').focus(); // promt home_medications_suggest ready to continue.
		}); // click event handler for add medicine button.

		$( "#current_medications_suggest" ).autocomplete({
	    	source: durgs,
	    	minLength: 2,
	    	select: function(event, ui) {
				event.preventDefault(); // prevent defualt select event.
				$(this).val(ui.item.label); // set current_medications_suggest to label selected.
				$("#current_medications").val() != '' ? $("#current_medications").val($("#current_medications").val() + '\n' + $(this).val()) : $("#current_medications").val($(this).val()); // set current_medications + selected label.
				$(this).val(''); // clear current_medications_suggest input after added.
				autosize.update($('#current_medications')); // update current_medications rows.
			}
		}); // handle autocomplete for current_medications_suggest input.

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
		if ("{{ session('patient_gender') }}" == "หญิง") $("#woman_only").collapse('show'); // check if patient_gender = female then show female section.
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

@endsection
