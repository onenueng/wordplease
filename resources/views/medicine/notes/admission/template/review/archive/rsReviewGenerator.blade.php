<!-- rs generator -->
<div class="well">
	
	<!-- rs1 -->
	<div class="btn-group gen" role="group" aria-label="...">
		<button type="button" class="btn btn-default rs1" onclick="selectChoice('.rs1','#rs11')" id="rs11">ไม่หอบ</button>
		<button type="button" class="btn btn-default rs1" onclick="selectChoice('.rs1','#rs12')" id="rs12">หอบ</button>
	</div><!-- rs1 -->

	<!-- rs2 -->
	<div class="btn-group gen" role="group" aria-label="...">
		<button type="button" class="btn btn-default rs2" onclick="selectChoice('.rs2','#rs21')" id="rs21">ไม่ไอ</button>
		<button type="button" class="btn btn-default rs2" onclick="selectChoice('.rs2','#rs22')" id="rs22">ไอ แห้งๆ</button>
		<button type="button" class="btn btn-default rs2" onclick="selectChoice('.rs2','#rs23')" id="rs23">ไอ เสมหะขาว</button>
		<button type="button" class="btn btn-default rs2" onclick="selectChoice('.rs2','#rs24')" id="rs24">ไอ เสมหะเหลือง-เขียว</button>
	</div><!-- rs2 -->

	<!-- change number of choices -->
	<button onclick="genTemplate('.rs', 2,'#tarsReviewDetail', '#rsReviewGenCollapse')" type="button" class="btn btn-success">Generate</button>
</div><!-- end rs -->