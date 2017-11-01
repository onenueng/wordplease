<div class="well clearfix">
	<div class="col-md-12 btn-group-in-well">
		<span class="fa fa-ellipsis-v"></span>
		<div class="btn-group" role="group">
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_review_CVS_chest_pain" extra-template-action="off">ไม่เจ็บหน้าอก</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_review_CVS_chest_pain" extra-template-action="on">เจ็บหน้าอกตรงกลาง</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_review_CVS_chest_pain" extra-template-action="on">เจ็บหน้าอกซ้าย</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_review_CVS_chest_pain" extra-template-action="on">เจ็บหน้าอกขวา</button>
		</div>
	</div>
	<div class="col-md-12 collapse" id="specified_review_CVS_chest_pain">
		<div class="col-md-12 btn-group-in-well">
			<span class="fa fa-ellipsis-h"></span>
			<div class="btn-group" role="group">
				<button type="button" class="btn btn-default btn-sm btn-template" group="specified_review_CVS_chest_pain_symptom">เจ็บแน่นๆ</button>
				<button type="button" class="btn btn-default btn-sm btn-template" group="specified_review_CVS_chest_pain_symptom">เจ็บจี๊ดๆ</button>
				<button type="button" class="btn btn-default btn-sm btn-template" group="specified_review_CVS_chest_pain_symptom">เจ็บแปลบๆ</button>
			</div>
		</div>
		<div class="col-md-12 btn-group-in-well">
			<span class="fa fa-ellipsis-h"></span>
			<div class="btn-group" role="group">
				<button type="button" class="btn btn-default btn-sm btn-template" child-template-action="off" group="specified_review_CVS_chest_pain_sore">ไม่ร้าวไปที่ใด</button>
				<button type="button" class="btn btn-default btn-sm btn-template" child-template-action="on" group="specified_review_CVS_chest_pain_sore" caption="ร้าว" fallback-caption="ร้าว">ร้าว</button>
			</div>
		</div>	
	</div>
	<div class="col-md-12 collapse" id="specified_review_CVS_chest_pain_sore">
		<div class="col-md-12 btn-group-in-well">
			<span class="fa fa-ellipsis-h"></span>
			<span class="fa fa-ellipsis-h"></span>
			<div class="btn-group" role="group">
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" parent="ร้าว" group="child_specified_review_CVS_chest_pain_sore_back">ร้าวไปที่หลัง</button>
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" parent="ร้าว" group="child_specified_review_CVS_chest_pain_sore_back"><span class="fa fa-remove"></span></button>
			</div>
		</div>
		<div class="col-md-12 btn-group-in-well">
			<span class="fa fa-ellipsis-h"></span>
			<span class="fa fa-ellipsis-h"></span>
			<div class="btn-group" role="group">
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" parent="ร้าว" group="child_specified_review_CVS_chest_pain_sore_neck">ร้าวไปที่คอ</button>
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" parent="ร้าว" group="child_specified_review_CVS_chest_pain_sore_neck"><span class="fa fa-remove"></span></button>
			</div>
		</div>
		<div class="col-md-12 btn-group-in-well">
			<span class="fa fa-ellipsis-h"></span>
			<span class="fa fa-ellipsis-h"></span>
			<div class="btn-group" role="group">
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" parent="ร้าว" group="child_specified_review_CVS_chest_pain_sore_chin">ร้าวไปที่คาง</button>
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" parent="ร้าว" group="child_specified_review_CVS_chest_pain_sore_chin"><span class="fa fa-remove"></span></button>
			</div>
		</div>
		<div class="col-md-12 btn-group-in-well">
			<span class="fa fa-ellipsis-h"></span>
			<span class="fa fa-ellipsis-h"></span>
			<div class="btn-group" role="group">
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" parent="ร้าว" group="child_specified_review_CVS_chest_pain_sore_arm">ร้าวไปที่แขนขวา</button>
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" parent="ร้าว" group="child_specified_review_CVS_chest_pain_sore_arm">ร้าวไปที่แขนซ้าย</button>
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" parent="ร้าว" group="child_specified_review_CVS_chest_pain_sore_arm">ร้าวไปที่แขน 2 ข้าง</button>
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" parent="ร้าว" group="child_specified_review_CVS_chest_pain_sore_arm"><span class="fa fa-remove"></span></button>
			</div>
		</div>
	</div>
	<div class="col-md-12 btn-group-in-well">
		<span class="fa fa-ellipsis-v"></span>
		<div class="btn-group" role="group">
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_review_CVS_palpitation">ไม่มีใจสั่น</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_review_CVS_palpitation">ใจสั่น</button>
		</div>
	</div>
	<div class="col-md-12 btn-group-in-well">
		<span class="fa fa-ellipsis-v"></span>
		<div class="btn-group" role="group">
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_review_CVS_fatigue">ไม่เหนื่อยง่าย</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_review_CVS_fatigue">เหนื่อยง่าย</button>
		</div>
	</div>
	<div class="col-md-12 btn-group-in-well">
		<span class="fa fa-ellipsis-v"></span>
		<div class="btn-group" role="group">
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_review_CVS_laid">นอนราบได้</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_review_CVS_laid">นอนราบแล้วเหนื่อย</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_review_CVS_laid">นอนราบแล้วเจ็บหน้าอก</button>
		</div>
	</div>
	<div class="col-md-12 btn-group-in-well">
		<span class="fa fa-ellipsis-v"></span>
		<div class="btn-group" role="group">
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_review_CVS_swelling" child-template-action="off">ไม่บวม</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_review_CVS_swelling" child-template-action="on" caption="บวม" fallback-caption="บวม">บวม</button>
		</div>
	</div>
	<div class="col-md-12 collapse" id="specified_review_CVS_swelling">
		<div class="col-md-12 btn-group-in-well">
			<span class="fa fa-ellipsis-h"></span>
			<div class="btn-group" role="group">
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" parent="บวม" group="child_specified_review_CVS_swelling_face">บวมหน้า</button>
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" parent="บวม" group="child_specified_review_CVS_swelling_face"><span class="fa fa-remove"></span></button>
			</div>
		</div>
		<div class="col-md-12 btn-group-in-well">
			<span class="fa fa-ellipsis-h"></span>
			<div class="btn-group" role="group">
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" parent="บวม" group="child_specified_review_CVS_swelling_leg">บวมขาขวา</button>
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" parent="บวม" group="child_specified_review_CVS_swelling_leg">บวมขาซ้าย</button>
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" parent="บวม" group="child_specified_review_CVS_swelling_leg">บวมขา 2 ข้าง</button>
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" parent="บวม" group="child_specified_review_CVS_swelling_leg"><span class="fa fa-remove"></span></button>
			</div>
		</div>
		<div class="col-md-12 btn-group-in-well">
			<span class="fa fa-ellipsis-h"></span>
			<div class="btn-group" role="group">
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" parent="บวม" group="child_specified_review_CVS_swelling_arm">บวมแขนขวา</button>
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" parent="บวม" group="child_specified_review_CVS_swelling_arm">บวมแขนซ้าย</button>
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" parent="บวม" group="child_specified_review_CVS_swelling_arm">บวมแขน 2 ข้าง</button>
				<button type="button" class="btn btn-default btn-sm btn-template has-parent-template" parent="บวม" group="child_specified_review_CVS_swelling_arm"><span class="fa fa-remove"></span></button>
			</div>
		</div>
	</div>
	<div class="col-md-12 btn-group-in-well">
		<span class="fa fa-ellipsis-v"></span>
		<button type="button" class="btn btn-primary btn-xs btn-template-add" role="put" target="specified_review_CVS">Put</button>
		<button type="button" class="btn btn-danger btn-xs btn-template-close" target="specified_review_CVS"><span class="fa fa-times-circle"></span></button>
	</div>
</div>