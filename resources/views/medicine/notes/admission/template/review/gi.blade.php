<div class="well clearfix">
	<div class="col-md-12 btn-group-in-well">
		<span class="fa fa-ellipsis-v"></span>
		<div class="btn-group" role="group">
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_review_GI_defecate">ถ่ายอุจจาระปกติวันละ _xx_ ครั้ง</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_review_GI_defecate">ท้องผูก</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_review_GI_defecate">ท้องเสีย ถ่ายวันละ _xx_ ครั้ง</button>
		</div>
	</div>
	<div class="col-md-12 btn-group-in-well">
		<span class="fa fa-ellipsis-v"></span>
		<div class="btn-group" role="group">
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_review_GI_black_stool">ไม่ถ่ายอุจจาระดำ</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_review_GI_black_stool">ถ่ายอุจจาระดำ</button>
		</div>
	</div>
	<div class="col-md-12 btn-group-in-well">
		<span class="fa fa-ellipsis-v"></span>
		<div class="btn-group" role="group">
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_review_GI_blood_stool">ไม่ถ่ายเป็นเลือด</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_review_GI_blood_stool">ถ่ายเป็นเลือด</button>
		</div>
	</div>
	<div class="col-md-12 btn-group-in-well">
		<span class="fa fa-ellipsis-v"></span>
		<div class="btn-group" role="group">
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_review_GI_nausea">ไม่คลื่นไส้</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_review_GI_nausea">คลื่นไส้</button>
		</div>
	</div>
	<div class="col-md-12 btn-group-in-well">
		<span class="fa fa-ellipsis-v"></span>
		<div class="btn-group" role="group">
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_review_GI_vomit" child-template-action="off">ไม่อาเจียน</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_review_GI_vomit" child-template-action="on" caption="อาเจียน" fallback-caption="อาเจียน">อาเจียน</button>
		</div>
	</div>
	<div class="col-md-12 collapse" id="specified_review_GI_vomit">
		<div class="col-md-12 btn-group-in-well">
			<span class="fa fa-ellipsis-h"></span>
			<div class="btn-group" role="group">
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_review_GI_vomit_fluid" parent="อาเจียน">อาเจียนเป็นน้ำ</button>
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_review_GI_vomit_fluid" parent="อาเจียน"><span class="fa fa-remove"></span></button>
			</div>
		</div>
		<div class="col-md-12 btn-group-in-well">
			<span class="fa fa-ellipsis-h"></span>
			<div class="btn-group" role="group">
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_review_GI_vomit_blood" parent="อาเจียน">อาเจียนเป็นเลือด</button>
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_review_GI_vomit_blood" parent="อาเจียน"><span class="fa fa-remove"></span></button>
			</div>
		</div>
		<div class="col-md-12 btn-group-in-well">
			<span class="fa fa-ellipsis-h"></span>
			<div class="btn-group" role="group">
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_review_GI_vomit_meal" parent="อาเจียน">อาเจียนเป็นอาหาร</button>
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_review_GI_vomit_meal" parent="อาเจียน"><span class="fa fa-remove"></span></button>
			</div>
		</div>
	</div>
	<div class="col-md-12 btn-group-in-well">
		<span class="fa fa-ellipsis-v"></span>
		<div class="btn-group" role="group">
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_review_GI_jaundice">ไม่เคยมีอาการตัวเหลือง</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_review_GI_jaundice">ตัวเหลือง</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_review_GI_jaundice">ตาเหลือง</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_review_GI_jaundice">ตัวและตาเหลือง</button>
		</div>
	</div>
	<div class="col-md-12 btn-group-in-well">
		<span class="fa fa-ellipsis-v"></span>
		<div class="btn-group" role="group">
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_review_GI_stomach_tumor">ไม่มีก้อนในท้อง</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_review_GI_stomach_tumor">คลำได้ก้อนในท้อง บริเวณ _xx_ มา _XX_ (วัน เดือน ปี)</button>
		</div>
	</div>
	<div class="col-md-12 btn-group-in-well">
		<span class="fa fa-ellipsis-v"></span>
		<button type="button" class="btn btn-primary btn-xs btn-template-add" role="put" target="specified_review_GI">Put</button>
		<button type="button" class="btn btn-danger btn-xs btn-template-close" target="specified_review_GI"><span class="fa fa-times-circle"></span></button>
	</div>
</div>