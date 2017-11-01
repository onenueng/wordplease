<!-- smokingAmount generator -->
<div class="well">
	
	<!-- smokingAmount1 -->
	<div class="btn-group gen" role="group" aria-label="...">
		<button type="button" class="btn btn-default smokingAmount1" onclick="selectChoice('.smokingAmount1','#smokingAmount11')" id="smokingAmount11">xx มวน</button>
		<button type="button" class="btn btn-default smokingAmount1" onclick="selectChoice('.smokingAmount1','#smokingAmount12')" id="smokingAmount12">xx ซอง</button>
	</div><!-- smokingAmount1 -->

	<!-- smokingAmount2 -->
	<div class="btn-group gen" role="group" aria-label="...">
		<button type="button" class="btn btn-default smokingAmount2" onclick="selectChoice('.smokingAmount2','#smokingAmount21')" id="smokingAmount21">ต่อวัน</button>
		<button type="button" class="btn btn-default smokingAmount2" onclick="selectChoice('.smokingAmount2','#smokingAmount22')" id="smokingAmount22">ต่อสัปดาห์</button>
		<button type="button" class="btn btn-default smokingAmount2" onclick="selectChoice('.smokingAmount2','#smokingAmount23')" id="smokingAmount23">ต่อเดือน</button>
	</div><!-- smokingAmount2 -->

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

		function smokePeriodTemplate(c) {
			var tmp1 = $(c).val()
			if (tmp1 == '')
				tmp1 = tmp1 + 'เริ่มสูบเมื่อ ปี xx / อายุ xx ปี\nหยุดสูบเมื่อ ปี xx / อายุ xx ปี';
			else
				tmp1 = tmp1 + '\nเริ่มสูบเมื่อ ปี xx / อายุ xx ปี\nหยุดสูบเมื่อ ปี xx / อายุ xx ปี';
			$(c).val(tmp1);
			autosize.update($(c));
			$(c).focus();
			$('#smokingHelperTemplate').collapse('hide');
		}

		function finishSmoke(a,b,c,d) {
			genTemplate(a,b,c,d);
			if  ($("input[name='smoking']:checked").val() == 1) //case ex-smoker
				var endText = 'เริ่มสูบเมื่อ ปี xx / อายุ xx ปี\nหยุดสูบเมื่อ ปี xx / อายุ xx ปี';				
			else //case smoker
				var endText = 'เริ่มสูบเมื่อ ปี xx / อายุ xx ปี';
			
			var tmp1 = $(c).val();
			if (tmp1 == '')
				tmp1 = tmp1 + endText;
			else
				tmp1 = tmp1 + '\n' + endText;

			$(c).val(tmp1);
			autosize.update($(c));
			$(c).focus();
			$('#smokingHelperTemplate').collapse('hide');
		}
	</script>

	<!-- change number of choices -->
	<button onclick="finishSmoke('.smokingAmount', 2,'#tasmokingAmountReviewDetail', '#smokingAmountReviewGenCollapse')" type="button" class="btn btn-success">Generate</button><!-- 
	<button onclick="appendTemplate('.smokingAmount', 2,'#tasmokingAmountReviewDetail', '#smokingAmountReviewGenCollapse')" type="button" class="btn btn-success">Add</button>
	<button onclick="smokePeriodTemplate('#tasmokingAmountReviewDetail')" type="button" class="btn btn-warning">Ex-drinker period</button>
	<button onclick="$('#smokingHelperTemplate').collapse('hide')" type="button" class="btn btn-info">Close</button> -->
</div><!-- end smokingAmount -->