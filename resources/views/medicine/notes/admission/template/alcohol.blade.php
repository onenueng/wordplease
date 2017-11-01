<div class="well clearfix">
	<div class="col-md-12 btn-group-in-well">
			<span class="fa fa-ellipsis-v"></span>
			<div class="btn-group" role="group">
				<button type="button" class="btn btn-default btn-sm btn-template" group="alcohol_amount_type" caption="เบียร์">เบียร์</button>
				<button type="button" class="btn btn-default btn-sm btn-template" group="alcohol_amount_type" caption="ไวน์">ไวน์</button>
				<button type="button" class="btn btn-default btn-sm btn-template" group="alcohol_amount_type" caption="เหล้าขาว">เหล้าขาว</button>
				<button type="button" class="btn btn-default btn-sm btn-template" group="alcohol_amount_type" caption="เหล้าสี">เหล้าสี</button>
			</div>
	</div>
	
	<div class="col-md-12 btn-group-in-well">
			<span class="fa fa-ellipsis-v"></span>
			<div class="btn-group" role="group">
				<button type="button" class="btn btn-default btn-sm btn-template" group="alcohol_amount_unit">_xx_ แก้ว</button>
				<button type="button" class="btn btn-default btn-sm btn-template" group="alcohol_amount_unit">_xx_ ขวดกลม</button>
				<button type="button" class="btn btn-default btn-sm btn-template" group="alcohol_amount_unit">_xx_ ขวดแบน</button>
				<button type="button" class="btn btn-default btn-sm btn-template" group="alcohol_amount_unit">_xx_ เป็ก</button>
				<button type="button" class="btn btn-default btn-sm btn-template" group="alcohol_amount_unit">_xx_ กั๊ก</button>
			</div>
	</div>

	<div class="col-md-12 btn-group-in-well">
			<span class="fa fa-ellipsis-v"></span>
			<div class="btn-group" role="group">
				<button type="button" class="btn btn-default btn-sm btn-template" group="alcohol_amount_frequency">ต่อวัน</button>
				<button type="button" class="btn btn-default btn-sm btn-template" group="alcohol_amount_frequency">ต่อสัปดาห์</button>
				<button type="button" class="btn btn-default btn-sm btn-template" group="alcohol_amount_frequency">ต่อเดือน</button>
				<button type="button" class="btn btn-default btn-sm btn-template" group="alcohol_amount_frequency">ต่อปี</button>
			</div>
	</div>

	<div class="col-md-12 btn-group-in-well">
		<span class="fa fa-ellipsis-v"></span>
		<button type="button" class="btn btn-primary btn-xs btn-template-add" role="append" target="alcohol_amount">Append</button>
		<button type="button" class="btn btn-primary btn-xs btn-template-add" role="put" target="alcohol_amount">Put</button>
		<button type="button" class="btn btn-warning btn-xs" target="alcohol_amount" id="btn_exdrinker_period">Append Ex-drinker period</button>
		<button type="button" class="btn btn-danger btn-xs btn-template-close" target="alcohol_amount"><span class="fa fa-times-circle"></span></button>
	</div>
</div>

<script type="text/javascript">
	

	$('#btn_exdrinker_period').click(function() {
		if ($('textarea[name=' + $(this).attr('target') + ']').val() == '')
			$('textarea[name=' + $(this).attr('target') + ']').val('เริ่มดื่มเมื่อ ปี xx / อายุ xx ปี\nหยุดดื่มเมื่อ ปี xx / อายุ xx ปี');
		else
			$('textarea[name=' + $(this).attr('target') + ']').val($('textarea[name=' + $(this).attr('target') + ']').val() + '\n' + '\nเริ่มดื่มเมื่อ ปี xx / อายุ xx ปี\nหยุดดื่มเมื่อ ปี xx / อายุ xx ปี');
			
		autosize.update($('textarea[name=' + $(this).attr('target') + ']'));
		$('textarea[name=' + $(this).attr('target') + ']').focus();
	});

</script>