<div class="well clearfix">
	<div class="col-md-12 btn-group-in-well">
		<label class="label label-success label-btn-xs">abdomen</label>
		<span class="fa fa-ellipsis-v"></span>
		<div class="btn-group" role="group">
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_abdomen_build" caption="Normal contour,">Normal contour</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_abdomen_build" caption="Distended,">Distended</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_abdomen_build" caption="Flat,">Flat</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_abdomen_build"><span class="fa fa-remove"></span></button>
		</div>
	</div>

	<div class="col-md-12 btn-group-in-well">
		<label class="label label-success label-btn-xs">surgical</label>
		<span class="fa fa-ellipsis-v"></span>
		<div class="btn-group" role="group">
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_abdomen_surgical" child-template-action="off" caption="no surgical,">no</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_abdomen_surgical" child-template-action="on" caption="surgical scar," fallback-caption="surgical scar,">scar</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_abdomen_surgical" child-template-action="off"><span class="fa fa-remove"></span></button>
		</div>
	</div>

	<div class="col-md-12 collapse" id="specified_physical_exam_abdomen_surgical">
		<div class="col-md-12 btn-group-in-well">
			<span class="fa fa-ellipsis-h"></span>
			<label class="label label-info label-btn-xs">&#8226;</label>
			<span class="fa fa-ellipsis-v"></span>
			<div class="btn-group" role="group">
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_abdomen_surgical_midline" parent="'surgical scar,'" caption="midline surgical scar,">midline</button>
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_abdomen_surgical_midline" parent="'surgical scar,'" caption=""><span class="fa fa-remove"></span></button>
			</div>
		</div>

		<div class="col-md-12 btn-group-in-well">
			<span class="fa fa-ellipsis-h"></span>
			<label class="label label-info label-btn-xs">&#8226;</label>
			<span class="fa fa-ellipsis-v"></span>
			<div class="btn-group" role="group">
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_abdomen_surgical_lower" parent="'surgical scar,'" caption="right lower quadrant surgical scar,">right lower quadrant</button>
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_abdomen_surgical_lower" parent="'surgical scar,'" caption=""><span class="fa fa-remove"></span></button>
			</div>
		</div>

		<div class="col-md-12 btn-group-in-well">
			<span class="fa fa-ellipsis-h"></span>
			<label class="label label-info label-btn-xs">&#8226;</label>
			<span class="fa fa-ellipsis-v"></span>
			<div class="btn-group" role="group">
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_abdomen_surgical_upper" parent="'surgical scar,'" caption="right upper quadrant surgical scar,">right upper quadrant</button>
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_abdomen_surgical_upper" parent="'surgical scar,'" caption=""><span class="fa fa-remove"></span></button>
			</div>
		</div>

		<div class="col-md-12 btn-group-in-well">
			<span class="fa fa-ellipsis-h"></span>
			<label class="label label-info label-btn-xs">&#8226;</label>
			<span class="fa fa-ellipsis-v"></span>
			<div class="btn-group" role="group">
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_abdomen_surgical_suprapubic" parent="'surgical scar,'" caption="suprapubic surgical scar,">suprapubic</button>
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_abdomen_surgical_suprapubic" parent="'surgical scar,'" caption=""><span class="fa fa-remove"></span></button>
			</div>
		</div>
	</div>

	<div class="col-md-12 btn-group-in-well">
		<label class="label label-success label-btn-xs">superficial vein dilatation</label>
		<span class="fa fa-ellipsis-v"></span>
		<div class="btn-group" role="group">
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_abdomen_vein" caption="no superficial vein dilatation,">no</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_abdomen_vein" caption="superficial vein dilatation,">yes</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_abdomen_vein" caption="superficial vein dilatation,"><span class="fa fa-remove"></span></button>
		</div>
	</div>

	<div class="col-md-12 btn-group-in-well">
		<label class="label label-success label-btn-xs">visible peristalsis</label>
		<span class="fa fa-ellipsis-v"></span>
		<div class="btn-group" role="group">
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_abdomen_peristalsis" caption="no visible peristalsis,">no</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_abdomen_peristalsis" caption="visible peristalsis,">yes</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_abdomen_peristalsis" caption="visible peristalsis,"><span class="fa fa-remove"></span></button>
		</div>
	</div>

	<div class="col-md-12 btn-group-in-well">
		<label class="label label-success label-btn-xs">soft</label>
		<span class="fa fa-ellipsis-v"></span>
		<div class="btn-group" role="group">
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_abdomen_soft" caption="soft,">yes</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_abdomen_soft" caption=""><span class="fa fa-remove"></span></button>
		</div>
	</div>

	<div class="col-md-12 btn-group-in-well">
		<label class="label label-success label-btn-xs">guarding</label>
		<span class="fa fa-ellipsis-v"></span>
		<div class="btn-group" role="group">
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_abdomen_guarding" child-template-action="off" caption="no guarding,">no</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_abdomen_guarding" child-template-action="on" caption="guarding," fallback-caption="guarding,">yes</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_abdomen_guarding" child-template-action="off"><span class="fa fa-remove"></span></button>
		</div>
	</div>

	<div class="col-md-12 collapse" id="specified_physical_exam_abdomen_guarding">
		<div class="col-md-12 btn-group-in-well">
			<span class="fa fa-ellipsis-h"></span>
			<label class="label label-info label-btn-xs">&#8226;</label>
			<span class="fa fa-ellipsis-v"></span>
			<div class="btn-group" role="group">
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_abdomen_guarding_rightLowerQuadrant" parent="'guarding,'" caption="right lower quadrant guarding,">right lower quadrant</button>
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_abdomen_guarding_rightLowerQuadrant" parent="'guarding,'" caption=""><span class="fa fa-remove"></span></button>
			</div>
		</div>

		<div class="col-md-12 btn-group-in-well">
			<span class="fa fa-ellipsis-h"></span>
			<label class="label label-info label-btn-xs">&#8226;</label>
			<span class="fa fa-ellipsis-v"></span>
			<div class="btn-group" role="group">
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_abdomen_guarding_rightUpperQuadrant" parent="'guarding,'" caption="right upper quadrant guarding,">right upper quadrant</button>
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_abdomen_guarding_rightUpperQuadrant" parent="'guarding,'" caption=""><span class="fa fa-remove"></span></button>
			</div>
		</div>

		<div class="col-md-12 btn-group-in-well">
			<span class="fa fa-ellipsis-h"></span>
			<label class="label label-info label-btn-xs">&#8226;</label>
			<span class="fa fa-ellipsis-v"></span>
			<div class="btn-group" role="group">
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_abdomen_guarding_leftLowerQuadrant" parent="'guarding,'" caption="left lower quadrant guarding,">left lower quadrant</button>
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_abdomen_guarding_leftLowerQuadrant" parent="'guarding,'" caption=""><span class="fa fa-remove"></span></button>
			</div>
		</div>

		<div class="col-md-12 btn-group-in-well">
			<span class="fa fa-ellipsis-h"></span>
			<label class="label label-info label-btn-xs">&#8226;</label>
			<span class="fa fa-ellipsis-v"></span>
			<div class="btn-group" role="group">
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_abdomen_guarding_leftUpperQuadrant" parent="'guarding,'" caption="left upper quadrant guarding,">left upper quadrant</button>
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_abdomen_guarding_leftUpperQuadrant" parent="'guarding,'" caption=""><span class="fa fa-remove"></span></button>
			</div>
		</div>

		<div class="col-md-12 btn-group-in-well">
			<span class="fa fa-ellipsis-h"></span>
			<label class="label label-info label-btn-xs">&#8226;</label>
			<span class="fa fa-ellipsis-v"></span>
			<div class="btn-group" role="group">
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_abdomen_guarding_epigastrium" parent="'guarding,'" caption="epigastrium guarding,">epigastrium</button>
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_abdomen_guarding_epigastrium" parent="'guarding,'" caption=""><span class="fa fa-remove"></span></button>
			</div>
		</div>

		<div class="col-md-12 btn-group-in-well">
			<span class="fa fa-ellipsis-h"></span>
			<label class="label label-info label-btn-xs">&#8226;</label>
			<span class="fa fa-ellipsis-v"></span>
			<div class="btn-group" role="group">
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_abdomen_guarding_suprapublic" parent="'guarding,'" caption="suprapublic guarding,">suprapublic</button>
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_abdomen_guarding_suprapublic" parent="'guarding,'" caption=""><span class="fa fa-remove"></span></button>
			</div>
		</div>
	</div>

	<div class="col-md-12 btn-group-in-well">
		<label class="label label-success label-btn-xs">tender</label>
		<span class="fa fa-ellipsis-v"></span>
		<div class="btn-group" role="group">
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_abdomen_tender" child-template-action="off" caption="no tender,">no</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_abdomen_tender" child-template-action="on" caption="tender," fallback-caption="tender,">yes</button>
		</div>
	</div>

	<div class="col-md-12 collapse" id="specified_physical_exam_abdomen_tender">
		<div class="col-md-12 btn-group-in-well">
			<span class="fa fa-ellipsis-h"></span>
			<label class="label label-info label-btn-xs">&#8226;</label>
			<span class="fa fa-ellipsis-v"></span>
			<div class="btn-group" role="group">
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_abdomen_tender_rightLowerQuadrant" parent="'tender,'" caption="right lower quadrant tender,">right lower quadrant</button>
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_abdomen_tender_rightLowerQuadrant" parent="'tender,'" caption=""><span class="fa fa-remove"></span></button>
			</div>
		</div>

		<div class="col-md-12 btn-group-in-well">
			<span class="fa fa-ellipsis-h"></span>
			<label class="label label-info label-btn-xs">&#8226;</label>
			<span class="fa fa-ellipsis-v"></span>
			<div class="btn-group" role="group">
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_abdomen_tender_rightUpperQuadrant" parent="'tender,'" caption="right upper quadrant tender,">right upper quadrant</button>
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_abdomen_tender_rightUpperQuadrant" parent="'tender,'" caption=""><span class="fa fa-remove"></span></button>
			</div>
		</div>

		<div class="col-md-12 btn-group-in-well">
			<span class="fa fa-ellipsis-h"></span>
			<label class="label label-info label-btn-xs">&#8226;</label>
			<span class="fa fa-ellipsis-v"></span>
			<div class="btn-group" role="group">
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_abdomen_tender_leftLowerQuadrant" parent="'tender,'" caption="left lower quadrant tender,">left lower quadrant</button>
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_abdomen_tender_leftLowerQuadrant" parent="'tender,'" caption=""><span class="fa fa-remove"></span></button>
			</div>
		</div>

		<div class="col-md-12 btn-group-in-well">
			<span class="fa fa-ellipsis-h"></span>
			<label class="label label-info label-btn-xs">&#8226;</label>
			<span class="fa fa-ellipsis-v"></span>
			<div class="btn-group" role="group">
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_abdomen_tender_leftUpperQuadrant" parent="'tender,'" caption="left upper quadrant tender,">left upper quadrant</button>
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_abdomen_tender_leftUpperQuadrant" parent="'tender,'" caption=""><span class="fa fa-remove"></span></button>
			</div>
		</div>

		<div class="col-md-12 btn-group-in-well">
			<span class="fa fa-ellipsis-h"></span>
			<label class="label label-info label-btn-xs">&#8226;</label>
			<span class="fa fa-ellipsis-v"></span>
			<div class="btn-group" role="group">
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_abdomen_tender_epigastrium" parent="'tender,'" caption="epigastrium tender,">epigastrium</button>
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_abdomen_tender_epigastrium" parent="'tender,'" caption=""><span class="fa fa-remove"></span></button>
			</div>
		</div>

		<div class="col-md-12 btn-group-in-well">
			<span class="fa fa-ellipsis-h"></span>
			<label class="label label-info label-btn-xs">&#8226;</label>
			<span class="fa fa-ellipsis-v"></span>
			<div class="btn-group" role="group">
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_abdomen_tender_suprapublic" parent="'tender,'" caption="suprapublic tender,">suprapublic</button>
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_abdomen_tender_suprapublic" parent="'tender,'" caption=""><span class="fa fa-remove"></span></button>
			</div>
		</div>
	</div>

	<div class="col-md-12 btn-group-in-well">
		<label class="label label-success label-btn-xs">rigidity</label>
		<span class="fa fa-ellipsis-v"></span>
		<div class="btn-group" role="group">
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_abdomen_rigidity" child-template-action="off" caption="no rigidity,">no</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_abdomen_rigidity" child-template-action="on" caption="rigidity," fallback-caption="rigidity,">yes</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_abdomen_rigidity" child-template-action="off"><span class="fa fa-remove"></span></button>
		</div>
	</div>

	<div class="col-md-12 collapse" id="specified_physical_exam_abdomen_rigidity">
		<div class="col-md-12 btn-group-in-well">
			<span class="fa fa-ellipsis-h"></span>
			<label class="label label-info label-btn-xs">&#8226;</label>
			<span class="fa fa-ellipsis-v"></span>
			<div class="btn-group" role="group">
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_abdomen_rigidity_rightLowerQuadrant" parent="'rigidity,'" caption="right lower quadrant rigidity,">right lower quadrant</button>
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_abdomen_rigidity_rightLowerQuadrant" parent="'rigidity,'" caption=""><span class="fa fa-remove"></span></button>
			</div>
		</div>

		<div class="col-md-12 btn-group-in-well">
			<span class="fa fa-ellipsis-h"></span>
			<label class="label label-info label-btn-xs">&#8226;</label>
			<span class="fa fa-ellipsis-v"></span>
			<div class="btn-group" role="group">
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_abdomen_rigidity_rightUpperQuadrant" parent="'rigidity,'" caption="right upper quadrant rigidity,">right upper quadrant</button>
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_abdomen_rigidity_rightUpperQuadrant" parent="'rigidity,'" caption=""><span class="fa fa-remove"></span></button>
			</div>
		</div>

		<div class="col-md-12 btn-group-in-well">
			<span class="fa fa-ellipsis-h"></span>
			<label class="label label-info label-btn-xs">&#8226;</label>
			<span class="fa fa-ellipsis-v"></span>
			<div class="btn-group" role="group">
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_abdomen_rigidity_leftLowerQuadrant" parent="'rigidity,'" caption="left lower quadrant rigidity,">left lower quadrant</button>
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_abdomen_rigidity_leftLowerQuadrant" parent="'rigidity,'" caption=""><span class="fa fa-remove"></span></button>
			</div>
		</div>

		<div class="col-md-12 btn-group-in-well">
			<span class="fa fa-ellipsis-h"></span>
			<label class="label label-info label-btn-xs">&#8226;</label>
			<span class="fa fa-ellipsis-v"></span>
			<div class="btn-group" role="group">
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_abdomen_rigidity_leftUpperQuadrant" parent="'rigidity,'" caption="left upper quadrant rigidity,">left upper quadrant</button>
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_abdomen_rigidity_leftUpperQuadrant" parent="'rigidity,'" caption=""><span class="fa fa-remove"></span></button>
			</div>
		</div>

		<div class="col-md-12 btn-group-in-well">
			<span class="fa fa-ellipsis-h"></span>
			<label class="label label-info label-btn-xs">&#8226;</label>
			<span class="fa fa-ellipsis-v"></span>
			<div class="btn-group" role="group">
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_abdomen_rigidity_epigastrium" parent="'rigidity,'" caption="epigastrium rigidity,">epigastrium</button>
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_abdomen_rigidity_epigastrium" parent="'rigidity,'" caption=""><span class="fa fa-remove"></span></button>
			</div>
		</div>

		<div class="col-md-12 btn-group-in-well">
			<span class="fa fa-ellipsis-h"></span>
			<label class="label label-info label-btn-xs">&#8226;</label>
			<span class="fa fa-ellipsis-v"></span>
			<div class="btn-group" role="group">
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_abdomen_rigidity_suprapublic" parent="'rigidity,'" caption="suprapublic rigidity,">suprapublic</button>
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_abdomen_rigidity_suprapublic" parent="'rigidity,'" caption=""><span class="fa fa-remove"></span></button>
			</div>
		</div>
	</div>

	<div class="col-md-12 btn-group-in-well">
		<label class="label label-success label-btn-xs">percussion</label>
		<span class="fa fa-ellipsis-v"></span>
		<div class="btn-group" role="group">
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_abdomen_percussion" child-template-action="off" caption="no percussion,">normal</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_abdomen_percussion" child-template-action="on" caption="dullness on percussion," fallback-caption="dullness on percussion,">dullness</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_abdomen_percussion" child-template-action="off"><span class="fa fa-remove"></span></button>
		</div>
	</div>

	<div class="col-md-12 collapse" id="specified_physical_exam_abdomen_percussion">
		<div class="col-md-12 btn-group-in-well">
			<span class="fa fa-ellipsis-h"></span>
			<label class="label label-info label-btn-xs">&#8226;</label>
			<span class="fa fa-ellipsis-v"></span>
			<div class="btn-group" role="group">
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_abdomen_percussion_rightLowerQuadrant" parent="'dullness on percussion,'" caption="dullness on right lower quadrant percussion,">right lower quadrant</button>
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_abdomen_percussion_rightLowerQuadrant" parent="'dullness on percussion,'" caption=""><span class="fa fa-remove"></span></button>
			</div>
		</div>

		<div class="col-md-12 btn-group-in-well">
			<span class="fa fa-ellipsis-h"></span>
			<label class="label label-info label-btn-xs">&#8226;</label>
			<span class="fa fa-ellipsis-v"></span>
			<div class="btn-group" role="group">
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_abdomen_percussion_rightUpperQuadrant" parent="'dullness on percussion,'" caption="dullness on right upper quadrant percussion,">right upper quadrant</button>
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_abdomen_percussion_rightUpperQuadrant" parent="'dullness on percussion,'" caption=""><span class="fa fa-remove"></span></button>
			</div>
		</div>

		<div class="col-md-12 btn-group-in-well">
			<span class="fa fa-ellipsis-h"></span>
			<label class="label label-info label-btn-xs">&#8226;</label>
			<span class="fa fa-ellipsis-v"></span>
			<div class="btn-group" role="group">
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_abdomen_percussion_leftLowerQuadrant" parent="'dullness on percussion,'" caption="dullness on left lower quadrant percussion,">left lower quadrant</button>
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_abdomen_percussion_leftLowerQuadrant" parent="'dullness on percussion,'" caption=""><span class="fa fa-remove"></span></button>
			</div>
		</div>

		<div class="col-md-12 btn-group-in-well">
			<span class="fa fa-ellipsis-h"></span>
			<label class="label label-info label-btn-xs">&#8226;</label>
			<span class="fa fa-ellipsis-v"></span>
			<div class="btn-group" role="group">
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_abdomen_percussion_leftUpperQuadrant" parent="'dullness on percussion,'" caption="dullness on left upper quadrant percussion,">left upper quadrant</button>
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_abdomen_percussion_leftUpperQuadrant" parent="'dullness on percussion,'" caption=""><span class="fa fa-remove"></span></button>
			</div>
		</div>

		<div class="col-md-12 btn-group-in-well">
			<span class="fa fa-ellipsis-h"></span>
			<label class="label label-info label-btn-xs">&#8226;</label>
			<span class="fa fa-ellipsis-v"></span>
			<div class="btn-group" role="group">
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_abdomen_percussion_epigastrium" parent="'dullness on percussion,'" caption="dullness on epigastrium percussion,">epigastrium</button>
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_abdomen_percussion_epigastrium" parent="'dullness on percussion,'" caption=""><span class="fa fa-remove"></span></button>
			</div>
		</div>

		<div class="col-md-12 btn-group-in-well">
			<span class="fa fa-ellipsis-h"></span>
			<label class="label label-info label-btn-xs">&#8226;</label>
			<span class="fa fa-ellipsis-v"></span>
			<div class="btn-group" role="group">
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_abdomen_percussion_suprapublic" parent="'dullness on percussion,'" caption="dullness on suprapublic percussion,">suprapublic</button>
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_abdomen_percussion_suprapublic" parent="'dullness on percussion,'" caption=""><span class="fa fa-remove"></span></button>
			</div>
		</div>
	</div>

	<div class="col-md-12 btn-group-in-well">
		<label class="label label-success label-btn-xs">liver span</label>
		<span class="fa fa-ellipsis-v"></span>
		<div class="btn-group" role="group">
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_abdomen_liver" caption="liver span _xx_ CM,">yes</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_abdomen_liver" caption=""><span class="fa fa-remove"></span></button>
		</div>
	</div>

	<div class="col-md-12 btn-group-in-well">
		<label class="label label-success label-btn-xs">splenic dullness</label>
		<span class="fa fa-ellipsis-v"></span>
		<div class="btn-group" role="group">
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_abdomen_splenic" caption="no splenic dullness,">no</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_abdomen_splenic" caption="splenic dullness,">yes</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_abdomen_splenic"><span class="fa fa-remove"></span></button>
		</div>
	</div>

	<div class="col-md-12 btn-group-in-well">
		<label class="label label-success label-btn-xs">fluid thrill</label>
		<span class="fa fa-ellipsis-v"></span>
		<div class="btn-group" role="group">
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_abdomen_thrill" caption="no fluid thrill,">no</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_abdomen_thrill" caption="fluid thrill positive,">positive</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_abdomen_thrill"><span class="fa fa-remove"></span></button>
		</div>
	</div>

	<div class="col-md-12 btn-group-in-well">
		<label class="label label-success label-btn-xs">bowel sound</label>
		<span class="fa fa-ellipsis-v"></span>
		<div class="btn-group" role="group">
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_abdomen_bowel" caption="normal bowel sound,">normal</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_abdomen_bowel" caption="decrease bowel sound,">decrease</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_abdomen_bowel" caption="increase bowel sound,">increase</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_abdomen_bowel"><span class="fa fa-remove"></span></button>
		</div>
	</div>

	<div class="col-md-12 btn-group-in-well">
		<label class="label label-success label-btn-xs">bruit</label>
		<span class="fa fa-ellipsis-v"></span>
		<div class="btn-group" role="group">
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_abdomen_bruit" caption="no bruit,">no</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_abdomen_bruit" caption="bruit,">yes</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_abdomen_bruit"><span class="fa fa-remove"></span></button>
		</div>
	</div>

	<div class="col-md-12 btn-group-in-well">
		<label class="label label-success label-btn-xs">bimanual palpation</label>
		<span class="fa fa-ellipsis-v"></span>
		<div class="btn-group" role="group">
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_abdomen_palpation" caption="negative bimanual palpation,">negative</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_abdomen_palpation" caption="positive bimanual palpation right side,">positive right</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_abdomen_palpation" caption="positive bimanual palpation left side,">positive left</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_abdomen_palpation" caption="positive bimanual palpation both sides,">positive both</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_abdomen_palpation"><span class="fa fa-remove"></span></button>
		</div>
	</div>

	<div class="col-md-12 btn-group-in-well">
		<label class="label label-success label-btn-xs">CVA tenderness</label>
		<span class="fa fa-ellipsis-v"></span>
		<div class="btn-group" role="group">
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_abdomen_tenderness" caption="no CVA tenderness,">no</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_abdomen_tenderness" caption="CVA tenderness left side,">left</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_abdomen_tenderness" caption="CVA tenderness right side,">right</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_abdomen_tenderness"><span class="fa fa-remove"></span></button>
		</div>
	</div>

	<div class="col-md-12 btn-group-in-well">
		<span class="fa fa-ellipsis-v"></span>
		<button type="button" class="btn btn-primary btn-xs btn-template-add" role="put-en" target="specified_physical_exam_abdomen" data-toggle="tooltip" data-placement="bottom" title="Combine selections">Put</button>
		<button type="button" class="btn btn-warning btn-xs btn-template-close" target="specified_physical_exam_abdomen" data-toggle="tooltip" data-placement="bottom" title="Close template"><span class="fa fa-times-circle"></span></button>
		<button type="button" class="btn btn-danger btn-xs btn-template-reset" target="specified_physical_exam_abdomen" data-toggle="tooltip" data-placement="bottom" title="Deselect all"><span class="fa fa-refresh"></span></button>
	</div>
</div>		