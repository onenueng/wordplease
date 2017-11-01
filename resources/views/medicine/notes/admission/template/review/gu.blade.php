<div class="well clearfix">
	<div class="col-md-12 btn-group-in-well">
		<span class="fa fa-ellipsis-v"></span>
		<div class="btn-group" role="group">
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_review_GU_urine" extra-template-action="off">ปัสสาวะปกติ</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_review_GU_urine" extra-template-action="on">ปัสสาวะไม่ปกติ</button>
		</div>
	</div>
	<div class="col-md-12 collapse" id="specified_review_GU_urine">
		<div class="col-md-12 btn-group-in-well">
			<span class="fa fa-ellipsis-h"></span>
			<div class="btn-group" role="group">
				<button type="button" class="btn btn-default btn-sm btn-template" group="specified_review_GU_urine_dysuria">ไม่ปัสสาวะแสบขัด</button>
				<button type="button" class="btn btn-default btn-sm btn-template" group="specified_review_GU_urine_dysuria">ปัสสาวะแสบขัด</button>
			</div>
		</div>
		<div class="col-md-12 btn-group-in-well">
			<span class="fa fa-ellipsis-h"></span>
			<div class="btn-group" role="group">
				<button type="button" class="btn btn-default btn-sm btn-template" group="specified_review_GU_urine_turbid">ไม่ปัสสาวะขุ่น</button>
				<button type="button" class="btn btn-default btn-sm btn-template" group="specified_review_GU_urine_turbid">ปัสสาวะขุ่น</button>
			</div>
		</div>
		<div class="col-md-12 btn-group-in-well">
			<span class="fa fa-ellipsis-h"></span>
			<div class="btn-group" role="group">
				<button type="button" class="btn btn-default btn-sm btn-template" group="specified_review_GU_urine_flow">ปัสสาวะกระปริบกระปรอย</button>
				<button type="button" class="btn btn-default btn-sm btn-template" group="specified_review_GU_urine_flow">ปัสสาวะออกน้อย</button>
				<button type="button" class="btn btn-default btn-sm btn-template" group="specified_review_GU_urine_flow">ปัสสาวะออกมาก</button>
			</div>
		</div>
		<div class="col-md-12 btn-group-in-well">
			<span class="fa fa-ellipsis-h"></span>
			<div class="btn-group" role="group">
				<button type="button" class="btn btn-default btn-sm btn-template" group="specified_review_GU_urine_valve">ไม่มีอาการกลั้นปัสสาวะไม่อยู่</button>
				<button type="button" class="btn btn-default btn-sm btn-template" group="specified_review_GU_urine_valve">ปัสสาวะเล็ดกลั้นไม่อยู่</button>
			</div>
		</div>
	</div>
	@if(!$note->note->patient->gender)
	<div class="col-md-12 btn-group-in-well">
		<span class="fa fa-ellipsis-v"></span>
		<div class="btn-group" role="group">
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_review_GU_menstruation">ประจำเดือนมาปกติ</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_review_GU_menstruation">ประจำเดือนหมดแล้ว</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_review_GU_menstruation">ประจำเดือนขาดมา _XX_ เดือน</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_review_GU_menstruation">ประจำเดือนออกมาก</button>
		</div>
	</div>
	<div class="col-md-12 btn-group-in-well">
		<span class="fa fa-ellipsis-v"></span>
		<div class="btn-group" role="group">
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_review_GU_vagina">ไม่คันช่องคลอด</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_review_GU_vagina">คันช่องคลอด</button>
		</div>
	</div>
	<div class="col-md-12 btn-group-in-well">
		<span class="fa fa-ellipsis-v"></span>
		<div class="btn-group" role="group">
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_review_GU_infection">ไม่มีตกขาว</button>
			<button type="button" class="btn btn-default btn-sm btn-template" group="specified_review_GU_infection">มีตกขาว</button>
		</div>
	</div>
	@endif
	<div class="col-md-12 btn-group-in-well">
		<span class="fa fa-ellipsis-v"></span>
		<button type="button" class="btn btn-primary btn-xs btn-template-add" role="put" target="specified_review_GU">Put</button>
		<button type="button" class="btn btn-danger btn-xs btn-template-close" target="specified_review_GU"><span class="fa fa-times-circle"></span></button>
	</div>
</div>