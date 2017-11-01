<!-- psychological generator -->
<div class="well">
	
	<!-- psychological1 -->
	<div class="btn-group gen" role="group" aria-label="...">
		<button type="button" class="btn btn-default psychological1" onclick="selectChoice('.psychological1','#psychological11')" id="psychological11">อารมณ์ปกติ</button>
		<button type="button" class="btn btn-default psychological1" onclick="selectChoice('.psychological1','#psychological12')" id="psychological12">ซึมเศร้า</button>
		<button type="button" class="btn btn-default psychological1" onclick="selectChoice('.psychological1','#psychological13')" id="psychological13">ร่าเริงผิดปกติ</button>
	</div><!-- psychological1 -->

	<!-- psychological2 -->
	<div class="btn-group gen" role="group" aria-label="...">
		<button type="button" class="btn btn-default psychological2" onclick="selectChoice('.psychological2','#psychological21')" id="psychological21">ไม่มีประสาทหลอน</button>
		<button type="button" class="btn btn-default psychological2" onclick="selectChoice('.psychological2','#psychological22')" id="psychological22">มีอาการประสาทหลอน</button>
	</div><!-- psychological2 -->

	<!-- psychological3 -->
	<div class="btn-group gen" role="group" aria-label="...">
		<button type="button" class="btn btn-default psychological3" onclick="selectChoice('.psychological3','#psychological31')" id="psychological31">ไม่หลงลืมง่าย</button>
		<button type="button" class="btn btn-default psychological3" onclick="selectChoice('.psychological3','#psychological32')" id="psychological32">หลงลืมง่าย</button>
	</div><!-- psychological3 -->

	<!-- psychological4 -->
	<div class="btn-group gen" role="group" aria-label="...">
		<button type="button" class="btn btn-default psychological4" onclick="selectChoice('.psychological4','#psychological41')" id="psychological41">ไม่กระหายน้าบ่อย</button>
		<button type="button" class="btn btn-default psychological4" onclick="selectChoice('.psychological4','#psychological42')" id="psychological42">กระหายน้าบ่อย</button>
	</div><!-- psychological4 -->

	<!-- change number of choices -->
	<button onclick="genTemplate('.psychological', 4,'#tapsychologicalReviewDetail', '#psychologicalReviewGenCollapse')" type="button" class="btn btn-success">Generate</button>
</div><!-- end psychological -->