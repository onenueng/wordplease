@extends('form')

@section('doc_title' , $note->note->type->name . ' - Form')

@section('description', 'siriraj faculty general note form')

@section('author', 'koramit Pichana')

@section('background_image',"url('/assets/images/gplaypattern.png');")

@section('nav_menu')
<li><a href="#preliminary_data">Preliminary data</a></li>
<li><a href="#principle_diagnosis">Diagnosis</a></li>
<li><a href="#complications">Complications</a></li>
<li><a href="#operations_procedures">Operation</a></li>
<li><a href="#discharge_status">Result of Treatment</a></li>
<li><a href="#history">History</a></li>
<li><a href="#prognosis">Prognosis</a></li>
<li><a href="#date_appointment">Appointment</a></li>
<li><a href="#home_medications_suggest">Home medications</a></li>
<li><a href="#note_panel">Note</a></li>
@endsection

@section('content')
@include('partials.flash')

<div class="col-md-offset-1 col-md-10"><!-- main_frame -->
@include('faculty.partials.admission')
<div class="panel panel-primary" id="panel_discharge_summary"><!-- Discharge summary -->
	<div class="panel-heading">{{ $note->note->type->name }}</div> 
	<div class="panel-body">
		<div class="panel panel-info" id="panel_diagnosis"><!-- panel Principle diagnosis. -->
			<div class="panel-heading">1. Diagnosis</div>
			<div class="panel-body"><!-- field principle_diagnosis type string -->
				<textarea class="form-control text_area_feedback" name="principle_diagnosis" id="principle_diagnosis" rows="1" maxlength="255" placeholder="Just one diagnosis, 255 characters max.">{{ $note->principle_diagnosis or '' }}</textarea>
				<div id="principle_diagnosis_feedback" style="color:#b3b3b3"></div>
			</div>
		</div>
		<div class="panel panel-info"><!-- panel Complications. -->
			<div class="panel-heading">2. Complications</div>
			<div class="panel-body"><!-- field complications type text -->
				<textarea class="form-control text_area_feedback" name="complications" id="complications" rows="1" maxlength="1000" placeholder="1000 characters max.">{{ $note->complications or '' }}</textarea>
				<div id="complications_feedback" style="color:#b3b3b3"></div>
			</div>
		</div>
		<div class="panel panel-info"><!-- panel OR procedures. -->
			<div class="panel-heading">3. Operation (Operation/Date/Surgeon)</div>
			<div class="panel-body"><!-- field operations_procedures type text -->
				<textarea class="form-control text_area_feedback" name="operations_procedures" id="operations_procedures" rows="1" maxlength="1000" placeholder="1000 characters max.">{{ $note->operations_procedures or '' }}</textarea></textarea>
				<div id="operations_procedures_feedback" style="color:#b3b3b3"></div>
			</div>
		</div>
		<div class="panel panel-info"><!-- panel Discharge Status. -->
			<div class="panel-heading">4. Result of Treatment</div>
			<div class="panel-body">
				<div class="form-horizontal row">
					<div class='col-md-12'>
						<div class="form-group">
							<label class="col-md-2 control-label" for="discharge_status">D/C Status <a role="button" title="Click to reset." class="radio-reset" target="discharge_status"><span class="fa fa-ban"></span></a> :</label>
							<div class="col-md-10"><!-- field discharge_status type TinyInteger -->
								<label class="radio-inline"><input type="radio" name="discharge_status" value="1">COMPLETE RECOVERY</label>
								<label class="radio-inline"><input type="radio" name="discharge_status" value="2">IMPROVED</label>
								<label class="radio-inline"><input type="radio" name="discharge_status" value="3">NOT IMPROVED</label>
								<label class="radio-inline"><input type="radio" name="discharge_status" value="4">DEAD</label>
							</div>
						</div>
					</div>
					<div class='col-md-12 collapse' id="discharge_type_alive_collapse">
						<div class="form-group">
							<label class="col-md-2 control-label" for="discharge_type">D/C Type <a role="button" title="Click to reset." class="radio-reset" target="discharge_type"><span class="fa fa-ban"></span></a> :</label>
							<div class="col-md-10"><!-- field discharge_type type TinyInteger -->
								<label class="radio-inline"><input type="radio" name="discharge_type" value="1">WITH APPROVAL</label>
								<label class="radio-inline"><input type="radio" name="discharge_type" value="2">AGAINST ADVICE</label>
								<label class="radio-inline"><input type="radio" name="discharge_type" value="3">BY ESCAPE</label>
								<label class="radio-inline"><input type="radio" name="discharge_type" value="4">BY TRANSFER</label>
								<label class="radio-inline"><input type="radio" name="discharge_type" value="5">OTHER SPECIFY</label>
							</div>
						</div>
					</div>
					<div class='col-md-12 collapse' id="discharge_type_dead_collapse">
						<div class="form-group">
							<label class="col-md-2 control-label" for="autopsy">D/C Status <a role="button" title="Click to reset." class="radio-reset" target="autopsy"><span class="fa fa-ban"></span></a> :</label>
							<div class="col-md-10"><!-- field autopsy type TinyInteger -->
								<label class="radio-inline"><input type="radio" name="autopsy" value="1">DEAD AUTOPSY</label>
								<label class="radio-inline"><input type="radio" name="autopsy" value="2">DEAD NO AUTOPSY</label>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="panel panel-default col-md-offset-1"><!-- panel treatment_result_detail. -->
			<div class="panel-heading">Detail</div>
			<div class="panel-body"><!-- field treatment_result_detail type text -->
				<textarea class="form-control text_area_feedback" name="treatment_result_detail" id="treatment_result_detail" rows="1" maxlength="1000" placeholder="1000 characters max.">{{ $note->treatment_result_detail or '' }}</textarea>
				<div id="treatment_result_detail_feedback" style="color:#b3b3b3"></div>
			</div>
		</div>
		<div class="panel panel-info"><!-- panel history. -->
			<div class="panel-heading">5. History</div>
			<div class="panel-body"><!-- field history type text -->
				<textarea class="form-control text_area_feedback" name="history" id="history" rows="1" maxlength="1000" placeholder="1000 characters max.">{{ $note->history or '' }}</textarea>
				<div id="history_feedback" style="color:#b3b3b3"></div>
			</div>
		</div>
		<div class="panel panel-default col-md-offset-1"><!-- panel history_examination. -->
			<div class="panel-heading">Examination</div>
			<div class="panel-body"><!-- field history_examination type text -->
				<textarea class="form-control text_area_feedback" name="history_examination" id="history_examination" rows="1" maxlength="1000" placeholder="1000 characters max.">{{ $note->history_examination or '' }}</textarea>
				<div id="history_examination_feedback" style="color:#b3b3b3"></div>
			</div>
		</div>
		<div class="panel panel-default col-md-offset-1"><!-- panel history_investigation. -->
			<div class="panel-heading">Investigation</div>
			<div class="panel-body"><!-- field history_investigation type text -->
				<textarea class="form-control text_area_feedback" name="history_investigation" id="history_investigation" rows="1" maxlength="1000" placeholder="1000 characters max.">{{ $note->history_investigation or '' }}</textarea>
				<div id="history_investigation_feedback" style="color:#b3b3b3"></div>
			</div>
		</div>
		<div class="panel panel-info"><!-- panel prognosis. -->
			<div class="panel-heading">6. Prognosis</div>
			<div class="panel-body"><!-- field prognosis type text -->
				<textarea class="form-control text_area_feedback" name="prognosis" id="prognosis" rows="1" maxlength="1000" placeholder="1000 characters max.">{{ $note->prognosis or '' }}</textarea>
				<div id="prognosis_feedback" style="color:#b3b3b3"></div>
			</div>
		</div>
		
		<div class="panel panel-info collapse in dc_alive" id="appointment_collapse"><!-- panel Appointment. -->
			<div class="panel-heading">7. Appointment</div>
			<div class="panel-body form-horizontal row">
				<div class='col-md-6'>
					<div class="form-group">
						<label class="control-label col-md-4" for="date_appointment">Date :</label>
						<div class="col-md-8"><!-- field date_appointment type date -->
							<div class="input-group date datetimepicker-date" id='datetimepicker_date_appointment'>
								<input type='text' class="form-control dc_alive_data handle-datetime" name="date_appointment" id="date_appointment" value="{{ is_null($note->date_appointment) ? '' : $note->date_appointment->format('d-m-Y') }}" />
								<span class="input-group-addon"><span class="fa fa-calendar-plus-o"></span></span>
							</div>
						</div>
					</div>
				</div>
				
				<!-- field appointment_clinic_id type smallInt -->
				<input class="dc_alive_data" type="hidden" name="appointment_clinic_id" id="appointment_clinic_id" value="{{ $note->appointment_clinic_id }}">
				<div class='col-md-6'>
					<div class="form-group">
						<label for="appointment_clinic_name" class="control-label col-md-4">Clinic <a title="" id="appointment_clinic_name_info"><span class="fa fa-info-circle"></span></a> :</label>
						<div class='col-md-8'><!-- field appointment_clinic_name type string -->
							<div class="input-group">
								<span class="input-group-addon" id="basic-addon1"><i class="fa fa-lightbulb-o"></i></span>
								<input type='text' class='form-control ui-widget dc_alive_data' value="" name='appointment_clinic_name' id='appointment_clinic_name' placeholder='type for suggestion'/>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-12">
					<div class="form-group">
						<label class="col-md-2 control-label">Note :</label>
						<div class="col-md-10"><!-- field appointment_note type string -->
							<input class="form-control dc_alive_data" type="text" name="appointment_note" value="{{ $note->appointment_note }}">
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="panel panel-info collapse in dc_alive" id="home_medications_collapse"><!-- Home medication -->
			<div class="panel-heading">8. Home medications </div>
			<div class="panel-body"><!-- field home_medications type text -->
				<div class='well'>
					<div class='form-group'>
						<div class="input-group">
		  				<span class="input-group-addon" id="basic-addon1"><i class="fa fa-lightbulb-o"></i></span>
							<input class="form-control autocomplete-to-textarea" type="text" target="home_medications" endpoint="/itemize/drug/"/>
							<span class="input-group-btn">
	        			<button class="btn btn-default btn-autocomplete-to-textarea" type="button" title="" target="home_medications"><span class="fa fa-medkit"></span></button>
	      			</span>
						</div>
					</div>
				</div>
				<textarea class="form-control text_area_feedback dc_alive_data" name="home_medications" id="home_medications" rows="1" maxlength="1000">{{ $note->home_medications }}</textarea>
				<div id="home_medications_feedback" style="color:#b3b3b3"></div>
			</div>
		</div><!-- end panel home medications  -->
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
$('input[name=discharge_status]').click(function() { // *** NEED TO CLEAR CONTENT FOR HIDE.
	if ($(this).val() == 4) { // dead.
		$('.dc_alive').collapse('hide');
		$("#discharge_type_alive_collapse").collapse('hide');
		$('input[name=discharge_type]').prop('checked', false); // reset discharge_type.
		$('.dc_alive_data').val('') // reset dc_alive_data.
		$('#discharge_type_dead_collapse').collapse('show');
	} else { 
		$('#discharge_type_dead_collapse').collapse('hide');
		$('input[name=autopsy]').prop('checked', false); // reset autopsy.
		$('.dc_alive').collapse('show');
		$("#discharge_type_alive_collapse").collapse('show');
	}
});

// $('.datetimepicker-date').datetimepicker({
// 	locale: 'th',
// 	format: 'DD-MM-YYYY',
// 	showTodayButton: true,
// 	showClear: true
// });

// $(function () {
// 	$('#datetimepicker_date_appointment').datetimepicker({
// 		locale: 'th',
// 		format: 'DD-MM-YYYY',
// 		showTodayButton: true,
// 		showClear: true
// 	});
// }); // date appointment.
// $('#datetimepicker_date_appointment').focusout(function() {$('#date_appointment').val(handleYear($('#date_appointment').val()));}) // Handle Buddish year.

// $( "#home_medications_suggest" ).autocomplete({
// 	source: function( request, response ) {
// 		$.ajax({
// 			url: "/itemize/drug/" + request.term, // Siriraj drugs URL.
// 			dataType: "JSON",
// 			success: function( data ) {
// 				response(data);
// 			}
// 		});
// 	},
// 	focus: function(event, ui) {
// 		event.preventDefault();
// 		$(this).val(ui.item.label); // set division_name = division_name.
// 	},
// 	select: function(event, ui) {
// 		event.preventDefault(); // prevent defualt select event.
// 		$(this).val(ui.item.label); // set home_medications_suggest to label selected.
// 		$("#home_medications").val() != '' ? $("#home_medications").val($("#home_medications").val() + '\n' + $(this).val()) : $("#home_medications").val($(this).val()); // set home_medications + selected label.
// 		$(this).val(''); // clear home_medications_suggest input after added.
// 		autosize.update($('#home_medications')); // update home_medications rows.
// 	},
// 	minLength: 2,
// }); // handle autocomplete for home_medications_suggest input.

$('input[target=home_medications]').data("ui-autocomplete")._renderItem = function(ul, item) {
		return $("<li></li>")
					.data("item.autocomplete", item)
					.append("<span>" + String(item.label)
						.replace(new RegExp(this.term, "gi"),"<span class='ui-state-highlight'>$&</span>") + "</span>")
					.appendTo(ul);
};

$('#addmedhome').click(function() {
	$("#home_medications").val() != '' ? $("#home_medications").val($("#home_medications").val() + '\n' + $('#home_medications_suggest').val()) : $("#home_medications").val($('#home_medications_suggest').val()); // set home_medications + home_medications_suggest.
	$('#home_medications_suggest').val(''); // clear home_medications_suggest after add click.
	autosize.update($('#home_medications')); // auto home_medications rows.
	$('#home_medications_suggest').focus(); // promt home_medications_suggest ready to continue.
}); // click event handler for add medicine button.

$(".radio-reset").click(function (){
	$("input[name=" + $(this).prop('target') + "]").prop('checked', false);
	if ($(this).prop('target') == 'discharge_status') { // case reset discharge_status.
		// show/hide assiciate section.
		$('.dc_alive').collapse('show');
		$("#discharge_type_alive_collapse").collapse('hide');
		$("#discharge_type_dead_collapse").collapse('hide');

		// clear data.
		$('input[name=discharge_type]').prop('checked', false);
		$('input[name=autopsy]').prop('checked', false);
	}
}); // reset radio input.

$(document).ready(function(){
	@if (is_numeric($note->discharge_status))
	$('input[name=discharge_status][value={{ $note->discharge_status }}]').click();
		@if (is_numeric($note->discharge_type))
		$('input[name=discharge_type][value={{ $note->discharge_type }}]').click();
		@endif
		@if (is_numeric($note->autopsy))
		$('input[name=autopsy][value={{ $note->autopsy }}]').click();
		@endif
	@endif
});
</script>
@endsection
