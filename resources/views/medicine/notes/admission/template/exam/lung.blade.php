<div class="well clearfix">
	<div class="col-md-12 btn-group-in-well">
		<label class="label label-success label-btn-xs">Trachea</label>
		<span class="fa fa-ellipsis-v"></span>
		<div class="btn-group" role="group">
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_trachea" caption="Trachea in midline,">midline</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_trachea" caption="Trachea deviated to the left,">left</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_trachea" caption="Trachea deviated to the right,">right</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_trachea"><span class="fa fa-remove"></span></button>
		</div>
	</div>

	<div class="col-md-12 btn-group-in-well">
		<label class="label label-success label-btn-xs">chest contour</label>
		<span class="fa fa-ellipsis-v"></span>
		<div class="btn-group" role="group">
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_contour" caption="normal chest contour">normal</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_contour" caption="barrel-shaped chest contour">barrel-shaped</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_contour"><span class="fa fa-remove"></span></button>
		</div>
	</div>

	<div class="col-md-12 btn-group-in-well">
		<label class="label label-success label-btn-xs">symmetry</label>
		<span class="fa fa-ellipsis-v"></span>
		<div class="btn-group" role="group">
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_symmetry" caption="symmetry,">yes</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_symmetry" caption="asymmetry,">no</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_symmetry"><span class="fa fa-remove"></span></button>
		</div>
	</div>

	<div class="col-md-12 btn-group-in-well">
		<label class="label label-success label-btn-xs">kyphosis</label>
		<span class="fa fa-ellipsis-v"></span>
		<div class="btn-group" role="group">
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_kyphosis" caption="no kyphosis,">no</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_kyphosis" caption="kyphosis,">yes</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_kyphosis"><span class="fa fa-remove"></span></button>
		</div>
	</div>

	<div class="col-md-12 btn-group-in-well">
		<label class="label label-success label-btn-xs">chest movement</label>
		<span class="fa fa-ellipsis-v"></span>
		<div class="btn-group" role="group">
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_movement" caption="equal chest movement,">equal</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_movement" caption="asymmetrical chest movement,">asymmetrical</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_movement"><span class="fa fa-remove"></span></button>
		</div>
	</div>

	<div class="col-md-12 btn-group-in-well">
		<label class="label label-success label-btn-xs">tactile fremitus</label>
		<span class="fa fa-ellipsis-v"></span>
		<div class="btn-group" role="group">
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_tactile" caption="normal tactile fremitus ,">normal</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_tactile" caption="decrease tactile fremitus on the left,">decrease left</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_tactile" caption="decrease tactile fremitus on the right,">decrease right</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_tactile"><span class="fa fa-remove"></span></button>
		</div>
	</div>

	<div class="col-md-12 btn-group-in-well">
		<label class="label label-success label-btn-xs">vocal fremitus</label>
		<span class="fa fa-ellipsis-v"></span>
		<div class="btn-group" role="group">
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_vocal" caption="normal vocal fremitus,">normal</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_vocal" caption="decrease vocal fremitus on the right,">decrease right</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_vocal" caption="decrease vocal fremitus on the left,">decrease left</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_vocal"><span class="fa fa-remove"></span></button>
		</div>
	</div>

	<div class="col-md-12 btn-group-in-well">
		<label class="label label-success label-btn-xs">tympanic sound</label>
		<span class="fa fa-ellipsis-v"></span>
		<div class="btn-group" role="group">
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_percussion" child-template-action="off" caption="normal percussion note,">normal percussion note</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_percussion" child-template-action="on" caption="abnormal tympanic sound," fallback-caption="abnormal tympanic sound,">abnormal</button>

{{-- 			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_percussion" caption="normal percussion note,">normal percussion note</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_percussion" caption="hyperresonant left lung,">left hyperresonant</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_percussion" caption="hyperresonant right lung,">right hyperresonant</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_percussion" caption="hyperresonant both lung,">both hyperresonant</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_percussion" caption="dullness on percussion left lung,">left dullness</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_percussion" caption="dullness on percussion right lung,">right dullness</button>
 --}}			
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_percussion"><span class="fa fa-remove"></span></button>
		</div>
	</div>

	<div class="col-md-12 collapse" id="specified_physical_exam_lung_percussion">
		<div class="col-md-12 btn-group-in-well">
			<span class="fa fa-ellipsis-h"></span>
			<label class="label label-info label-btn-xs">hyperresonant</label>
			<span class="fa fa-ellipsis-v"></span>
			<div class="btn-group" role="group">
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_lung_percussion_abnormal" parent="'abnormal tympanic sound,'" caption="hyperresonant right lung,">right</button>
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_lung_percussion_abnormal" parent="'abnormal tympanic sound,'" caption="hyperresonant left lung,">left</button>
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_lung_percussion_abnormal" parent="'abnormal tympanic sound,'" caption="hyperresonant both lungs,">both</button>
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_lung_percussion_abnormal" parent="'abnormal tympanic sound,'"><span class="fa fa-remove"></span></button>
			</div>
		</div>

		<div class="col-md-12 btn-group-in-well">
			<span class="fa fa-ellipsis-h"></span>
			<label class="label label-info label-btn-xs">dullness</label>
			<span class="fa fa-ellipsis-v"></span>
			<div class="btn-group" role="group">
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_lung_percussion_abnormal" parent="'abnormal tympanic sound,'" caption="right dullness,">right</button>
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_lung_percussion_abnormal" parent="'abnormal tympanic sound,'" caption="left dullness,">left</button>
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_lung_percussion_abnormal" parent="'abnormal tympanic sound,'"><span class="fa fa-remove"></span></button>
			</div>
		</div>
	</div>

	<div class="col-md-12 btn-group-in-well">
		<label class="label label-success label-btn-xs">breath sound</label>
		<span class="fa fa-ellipsis-v"></span>
		<div class="btn-group" role="group">
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_breath" extra-template-action="off" caption="normal breath sound,">normal</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_breath" extra-template-action="on" caption="decrease breath sound,">decrease</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_breath" extra-template-action="on" caption="bronchial breath sound,">bronchial</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_breath" extra-template-action="off"><span class="fa fa-remove"></span></button>
		</div>
	</div>

	<div class="col-md-12 collapse" id="specified_physical_exam_lung_breath">
		<div class="col-md-12 btn-group-in-well">
			<span class="fa fa-ellipsis-h"></span>
			<label class="label label-info label-btn-xs">right side</label>
			<span class="fa fa-ellipsis-v"></span>
			<div class="btn-group" role="group">
				<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_breath_right" caption="at right lower lung,">lower</button>
				<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_breath_right" caption="at right upper lung,">upper</button>
				<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_breath_right" caption="at right lung,">lower and upper</button>
				<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_breath_right" caption=""><span class="fa fa-remove"></span></button>
			</div>
		</div>

		<div class="col-md-12 btn-group-in-well">
			<span class="fa fa-ellipsis-h"></span>
			<label class="label label-info label-btn-xs">left side</label>
			<span class="fa fa-ellipsis-v"></span>
			<div class="btn-group" role="group">
				<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_breath_left" caption="at left lower lung,">lower</button>
				<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_breath_left" caption="at left upper lung,">upper</button>
				<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_breath_left" caption="at left lung,">lower and upper</button>
				<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_breath_left" caption=""><span class="fa fa-remove"></span></button>
			</div>
		</div>

		<div class="col-md-12 btn-group-in-well">
			<span class="fa fa-ellipsis-h"></span>
			<label class="label label-info label-btn-xs">both sides</label>
			<span class="fa fa-ellipsis-v"></span>
			<div class="btn-group" role="group">
				<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_breath_both" caption="at both lower lungs,">lower</button>
				<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_breath_both" caption="at both upper lungs,">upper</button>
				<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_breath_both" caption="at both lungs,">lower and upper</button>
				<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_breath_both" caption=""><span class="fa fa-remove"></span></button>
			</div>
		</div>
	</div>

	<div class="col-md-12 btn-group-in-well">
		<label class="label label-success label-btn-xs">crepitation</label>
		<span class="fa fa-ellipsis-v"></span>
		<div class="btn-group" role="group">
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_crepitation" extra-template-action="off" caption="no crepitation,">no</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_crepitation" extra-template-action="on" caption="fine crepitation,">fine</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_crepitation" extra-template-action="on" caption="coarse crepitation,">coarse</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_crepitation" extra-template-action="off" caption=""><span class="fa fa-remove"></span></button>
		</div>
	</div>

	<div class="col-md-12 collapse" id="specified_physical_exam_lung_crepitation">
		<div class="col-md-12 btn-group-in-well">
			<span class="fa fa-ellipsis-h"></span>
			<label class="label label-info label-btn-xs">right side</label>
			<span class="fa fa-ellipsis-v"></span>
			<div class="btn-group" role="group">
				<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_crepitation_right" caption="at right lower lung,">lower</button>
				<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_crepitation_right" caption="at right upper lung,">upper</button>
				<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_crepitation_right" caption="at right lung,">lower and upper</button>
				<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_crepitation_right" caption=""><span class="fa fa-remove"></span></button>
			</div>
		</div>

		<div class="col-md-12 btn-group-in-well">
			<span class="fa fa-ellipsis-h"></span>
			<label class="label label-info label-btn-xs">left side</label>
			<span class="fa fa-ellipsis-v"></span>
			<div class="btn-group" role="group">
				<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_crepitation_left" caption="at left lower lung,">lower</button>
				<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_crepitation_left" caption="at left upper lung,">upper</button>
				<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_crepitation_left" caption="at left lung,">lower and upper</button>
				<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_crepitation_left" caption=""><span class="fa fa-remove"></span></button>
			</div>
		</div>

		<div class="col-md-12 btn-group-in-well">
			<span class="fa fa-ellipsis-h"></span>
			<label class="label label-info label-btn-xs">both sides</label>
			<span class="fa fa-ellipsis-v"></span>
			<div class="btn-group" role="group">
				<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_crepitation_both" caption="at both lower lungs,">lower</button>
				<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_crepitation_both" caption="at both upper lungs,">upper</button>
				<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_crepitation_both" caption="at both lungs,">lower and upper</button>
				<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_crepitation_both" caption=""><span class="fa fa-remove"></span></button>
			</div>
		</div>
	</div>

	<div class="col-md-12 btn-group-in-well">
		<label class="label label-success label-btn-xs">wheezing</label>
		<span class="fa fa-ellipsis-v"></span>
		<div class="btn-group" role="group">
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_wheezing" extra-template-action="off" caption="no wheezing,">no</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_wheezing" extra-template-action="on" caption="expiratory wheezing,">expiratory</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_wheezing" extra-template-action="on" caption="inspiratory wheezing,">inspiratory</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_wheezing" extra-template-action="off" caption=""><span class="fa fa-remove"></span></button>
		</div>
	</div>

	<div class="col-md-12 collapse" id="specified_physical_exam_lung_wheezing">
		<div class="col-md-12 btn-group-in-well">
			<span class="fa fa-ellipsis-h"></span>
			<div class="btn-group" role="group">
				<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_wheezing_side" caption="left lung,">left lung</button>
				<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_wheezing_side" caption="right lung,">right lung</button>
				<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_wheezing_side" caption="both lungs,">both lungs</button>
				<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_wheezing_side" caption=""><span class="fa fa-remove"></span></button>
			</div>
		</div>
	</div>

	<div class="col-md-12 btn-group-in-well">
		<label class="label label-success label-btn-xs">vocal resonance</label>
		<span class="fa fa-ellipsis-v"></span>
		<div class="btn-group" role="group">
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_resonance" extra-template-action="off" caption="normal vocal resonance,">normal</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_resonance" extra-template-action="on" caption="decrease vocal resonance,">decrease</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_resonance" extra-template-action="off" caption=""><span class="fa fa-remove"></span></button>
		</div>
	</div>

	<div class="col-md-12 collapse" id="specified_physical_exam_lung_resonance">
		<div class="col-md-12 btn-group-in-well">
			<span class="fa fa-ellipsis-h"></span>
			<label class="label label-info label-btn-xs">right side</label>
			<span class="fa fa-ellipsis-v"></span>
			<div class="btn-group" role="group">
				<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_resonance_right" caption="at right lower lung,">lower</button>
				<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_resonance_right" caption="at right upper lung,">upper</button>
				<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_resonance_right" caption="at right lung,">lower and upper</button>
				<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_resonance_right" caption=""><span class="fa fa-remove"></span></button>
			</div>
		</div>

		<div class="col-md-12 btn-group-in-well">
			<span class="fa fa-ellipsis-h"></span>
			<label class="label label-info label-btn-xs">left side</label>
			<span class="fa fa-ellipsis-v"></span>
			<div class="btn-group" role="group">
				<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_resonance_left" caption="at left lower lung,">lower</button>
				<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_resonance_left" caption="at left upper lung,">upper</button>
				<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_resonance_left" caption="at left lung,">lower and upper</button>
				<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_resonance_left" caption=""><span class="fa fa-remove"></span></button>
			</div>
		</div>

		<div class="col-md-12 btn-group-in-well">
			<span class="fa fa-ellipsis-h"></span>
			<label class="label label-info label-btn-xs">both sides</label>
			<span class="fa fa-ellipsis-v"></span>
			<div class="btn-group" role="group">
				<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_resonance_both" caption="at both lower lungs,">lower</button>
				<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_resonance_both" caption="at both upper lungs,">upper</button>
				<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_resonance_both" caption="at both lungs,">lower and upper</button>
				<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_resonance_both" caption=""><span class="fa fa-remove"></span></button>
			</div>
		</div>
	</div>

	<div class="col-md-12 btn-group-in-well">
		<label class="label label-success label-btn-xs">egophony positive</label>
		<span class="fa fa-ellipsis-v"></span>
		<div class="btn-group" role="group">
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_egophony" caption="no egophony,">no</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_egophony" caption="positive egophony left lung,">left</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_egophony" caption="positive egophony right lung,">right</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lung_egophony" caption="positive egophony both lungs,">both</button>
		</div>
	</div>

	<div class="col-md-12 btn-group-in-well">
		<span class="fa fa-ellipsis-v"></span>
		<button type="button" class="btn btn-primary btn-xs btn-template-add" role="put-en" target="specified_physical_exam_lung" data-toggle="tooltip" data-placement="bottom" title="Combine selections">Put</button>
		<button type="button" class="btn btn-warning btn-xs btn-template-close" target="specified_physical_exam_lung" data-toggle="tooltip" data-placement="bottom" title="Close template"><span class="fa fa-times-circle"></span></button>
		<button type="button" class="btn btn-danger btn-xs btn-template-reset" target="specified_physical_exam_lung" data-toggle="tooltip" data-placement="bottom" title="Deselect all"><span class="fa fa-refresh"></span></button>
	</div>

</div>