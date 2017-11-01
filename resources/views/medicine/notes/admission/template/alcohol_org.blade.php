<!-- alcoholAmount generator -->
<div class="well">
	
	<!-- alcoholAmount1 -->
	<div class="btn-group gen" role="group" aria-label="...">
		<button type="button" class="btn btn-default alcoholAmount1" onclick="selectChoice('.alcoholAmount1','#alcoholAmount11')" id="alcoholAmount11">เบียร์</button>
		<button type="button" class="btn btn-default alcoholAmount1" onclick="selectChoice('.alcoholAmount1','#alcoholAmount12')" id="alcoholAmount12">ไวน์</button>
		<button type="button" class="btn btn-default alcoholAmount1" onclick="selectChoice('.alcoholAmount1','#alcoholAmount13')" id="alcoholAmount13">เหล้าขาว</button>
		<button type="button" class="btn btn-default alcoholAmount1" onclick="selectChoice('.alcoholAmount1','#alcoholAmount14')" id="alcoholAmount14">เหล้าสี</button>
	</div><!-- alcoholAmount1 -->

	<!-- alcoholAmount2 -->
	<div class="btn-group gen" role="group" aria-label="...">
		<button type="button" class="btn btn-default alcoholAmount2" onclick="selectChoice('.alcoholAmount2','#alcoholAmount21')" id="alcoholAmount21">xx แก้ว</button>
		<button type="button" class="btn btn-default alcoholAmount2" onclick="selectChoice('.alcoholAmount2','#alcoholAmount22')" id="alcoholAmount22">xx ขวดกลม</button>
		<button type="button" class="btn btn-default alcoholAmount2" onclick="selectChoice('.alcoholAmount2','#alcoholAmount23')" id="alcoholAmount23">xx ขวดแบน</button>
		<button type="button" class="btn btn-default alcoholAmount2" onclick="selectChoice('.alcoholAmount2','#alcoholAmount24')" id="alcoholAmount24">xx เป็ก</button>
		<button type="button" class="btn btn-default alcoholAmount2" onclick="selectChoice('.alcoholAmount2','#alcoholAmount25')" id="alcoholAmount25">xx กั๊ก</button>
	</div><!-- alcoholAmount2 -->

	<!-- alcoholAmount3 -->
	<div class="btn-group gen" role="group" aria-label="...">
		<button type="button" class="btn btn-default alcoholAmount3" onclick="selectChoice('.alcoholAmount3','#alcoholAmount31')" id="alcoholAmount31">ต่อวัน</button>
		<button type="button" class="btn btn-default alcoholAmount3" onclick="selectChoice('.alcoholAmount3','#alcoholAmount32')" id="alcoholAmount32">ต่อสัปดาห์</button>
		<button type="button" class="btn btn-default alcoholAmount3" onclick="selectChoice('.alcoholAmount3','#alcoholAmount33')" id="alcoholAmount33">ต่อเดือน</button>
		<button type="button" class="btn btn-default alcoholAmount3" onclick="selectChoice('.alcoholAmount3','#alcoholAmount34')" id="alcoholAmount34">ต่อปี</button>
	</div><!-- alcoholAmount3 -->
	
	<!-- override genTemplate -->
	<script type="text/javascript">
		function appendTemplate(a, b, c, d) {
			var tmp1 = $(c).val();
			genTemplate(a,b,c,d);
			var tmp2 = $(c).val();
			if (tmp1 == '')
				$(c).val(tmp2);
			else
				$(c).val(tmp1 + '\n' + tmp2);
			autosize.update($(c));
			$(c).focus();
		}

		function drinkPeriodTemplate(c) {
			var tmp1 = $(c).val()
			if (tmp1 == '')
				tmp1 = tmp1 + 'เริ่มดื่มเมื่อ ปี xx / อายุ xx ปี\nหยุดดื่มเมื่อ ปี xx / อายุ xx ปี';
			else
				tmp1 = tmp1 + '\nเริ่มดื่มเมื่อ ปี xx / อายุ xx ปี\nหยุดดื่มเมื่อ ปี xx / อายุ xx ปี';
			$(c).val(tmp1);
			autosize.update($(c));
			$(c).focus();
			$('#alcoholHelperTemplate').collapse('hide');
		}
	</script>

	<!-- change number of choices -->
	<button onclick="appendTemplate('.alcoholAmount', 3,'#taalcoholAmountReviewDetail', '#alcoholAmountReviewGenCollapse')" type="button" class="btn btn-success">Add</button>
	<button onclick="drinkPeriodTemplate('#taalcoholAmountReviewDetail')" type="button" class="btn btn-warning">Ex-drinker period</button>
	<button onclick="$('#alcoholHelperTemplate').collapse('hide')" type="button" class="btn btn-info">Close</button>
</div><!-- end alcoholAmount -->