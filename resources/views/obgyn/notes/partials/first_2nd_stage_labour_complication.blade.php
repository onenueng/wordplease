<div class="panel panel-default"><!-- Labour Complication -->
	<div class="panel-heading">Complication during first &amp; second stage of labour</div>
	<div class="panel-body row">
		<div class="col-md-3"><!-- field no_first_2nd_stage_labour_complication type checkbox -->
			<div class="checkbox"><label class="control-label"><input id="no_first_2nd_stage_labour_complication" type="checkbox"  {{ $note->no_first_2nd_stage_labour_complication ? 'checked' : ''}} name="no_first_2nd_stage_labour_complication">None</label></div>
		</div>
		<div class="col-md-3"><!-- field first_2nd_stage_labour_complication_placenta_previa_hemorrha type checkbox -->
			<div class="checkbox"><label class="control-label"><input class="complication-labour-1-2" type="checkbox"  {{ $note->first_2nd_stage_labour_complication_placenta_previa_hemorrha ? 'checked' : ''}} name="first_2nd_stage_labour_complication_placenta_previa_hemorrha" group="placenta-previa">Placenta previa with hemorrha</label></div>
		</div>
		<div class="col-md-4"><!-- field first_2nd_stage_labour_complication_placenta_previa_no_hemorrha type checkbox -->
			<div class="checkbox"><label class="control-label"><input class="complication-labour-1-2" type="checkbox"  {{ $note->first_2nd_stage_labour_complication_placenta_previa_no_hemorrha ? 'checked' : ''}} name="first_2nd_stage_labour_complication_placenta_previa_no_hemorrha" group="placenta-previa">Placenta previa without hemorrha</label></div>
		</div>
		<div class="col-md-3"><!-- field first_2nd_stage_labour_complication_CPD type checkbox -->
			<div class="checkbox"><label class="control-label"><input class="complication-labour-1-2" type="checkbox"  {{ $note->first_2nd_stage_labour_complication_CPD ? 'checked' : ''}} name="first_2nd_stage_labour_complication_CPD">CPD <a title="Cephalopelvic Disproportion"><span class="fa fa-info-circle"></span></a></label></div>
		</div>
		<div class="col-md-3"><!-- field first_2nd_stage_labour_complication_mild_pelvic_adhesion type checkbox -->
			<div class="checkbox"><label class="control-label"><input class="complication-labour-1-2" group="pelvic-adhesion" type="checkbox"  {{ $note->first_2nd_stage_labour_complication_mild_pelvic_adhesion ? 'checked' : ''}} name="first_2nd_stage_labour_complication_mild_pelvic_adhesion">mild Pelvic adhesion</label></div>
		</div>
		<div class="col-md-3"><!-- field first_2nd_stage_labour_complication_moderate_pelvic_adhesion type checkbox -->
			<div class="checkbox"><label class="control-label"><input class="complication-labour-1-2" group="pelvic-adhesion" type="checkbox"  {{ $note->first_2nd_stage_labour_complication_moderate_pelvic_adhesion ? 'checked' : ''}} name="first_2nd_stage_labour_complication_moderate_pelvic_adhesion">moderate Pelvic adhesion</label></div>
		</div>
		<div class="col-md-3"><!-- field first_2nd_stage_labour_complication_severe_pelvic_adhesion type checkbox -->
			<div class="checkbox"><label class="control-label"><input class="complication-labour-1-2" group="pelvic-adhesion" type="checkbox"  {{ $note->first_2nd_stage_labour_complication_severe_pelvic_adhesion ? 'checked' : ''}} name="first_2nd_stage_labour_complication_severe_pelvic_adhesion">severe Pelvic adhesion</label></div>
		</div>
		<div class="col-md-3"><!-- field first_2nd_stage_labour_complication_fetal_tachycardia type checkbox -->
			<div class="checkbox"><label class="control-label"><input class="complication-labour-1-2" type="checkbox"  {{ $note->first_2nd_stage_labour_complication_fetal_tachycardia ? 'checked' : ''}} name="first_2nd_stage_labour_complication_fetal_tachycardia">Fetal tachycardia</label></div>
		</div>
		<div class="col-md-3"><!-- field first_2nd_stage_labour_complication_fetal_distress type checkbox -->
			<div class="checkbox"><label class="control-label"><input class="complication-labour-1-2" type="checkbox"  {{ $note->first_2nd_stage_labour_complication_fetal_distress ? 'checked' : ''}} name="first_2nd_stage_labour_complication_fetal_distress">Fetal distress</label></div>
		</div>
		<div class="col-md-3"><!-- field first_2nd_stage_labour_complication_maternal_acute_febrile type checkbox -->
			<div class="checkbox"><label class="control-label"><input class="complication-labour-1-2" type="checkbox"  {{ $note->first_2nd_stage_labour_complication_maternal_acute_febrile ? 'checked' : ''}} name="first_2nd_stage_labour_complication_maternal_acute_febrile">Maternal acute febrile illness</label></div>
		</div>
		<div class="col-md-12"><!-- field other_first_2nd_stage_labour_complication type string -->
			<div class="form-group">
				<textarea name="other_first_2nd_stage_labour_complication" id="other_first_2nd_stage_labour_complication" class="form-control text_area_feedback" rows="1" maxlength="255" placeholder="Specify other labour complication. 255 characters max.">{{ $note->other_first_2nd_stage_labour_complication }}</textarea>
				<div id="other_first_2nd_stage_labour_complication_feedback" style="color:#b3b3b3"></div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
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
</script>