<!-- gs generator -->
<div class="well">
	
	<!-- gs1 -->
	<div class="btn-group gen" role="group" aria-label="...">
		<button type="button" class="btn btn-default gs1" onclick="selectChoice('.gs1','#gs11')" id="gs11">ไม่มีไข้</button>
		<button type="button" class="btn btn-default gs1" onclick="selectChoice('.gs1','#gs12')" id="gs12">มีไข้</button>
	</div><!-- gs1 -->

	<!-- gs2 -->
	<div class="btn-group gen" role="group" aria-label="...">
		<button type="button" class="btn btn-default gs2" onclick="selectChoice('.gs2','#gs21')" id="gs21">กินอาหารได้ตามปกติ</button>
		<button type="button" class="btn btn-default gs2" onclick="selectChoice('.gs2','#gs22')" id="gs22">กินจุ</button>
		<button type="button" class="btn btn-default gs2" onclick="selectChoice('.gs2','#gs23')" id="gs23">กินได้น้อย</button>
	</div><!-- gs2 -->

	<!-- gs3 -->
	<div class="btn-group gen" role="group" aria-label="...">
		<button type="button" class="btn btn-default gs3" onclick="selectChoice('.gs3','#gs31')" id="gs31">ไม่เบื่ออาหาร</button>
		<button type="button" class="btn btn-default gs3" onclick="selectChoice('.gs3','#gs32')" id="gs32">เบื่ออาหาร</button>
	</div><!-- gs3 -->

	<!-- gs4 -->
	<div class="btn-group gen" role="group" aria-label="...">
		<button type="button" class="btn btn-default gs4" onclick="selectChoice('.gs4','#gs41')" id="gs41">ไม่มีน้าหนักลด</button>
		<button type="button" class="btn btn-default gs4" onclick="selectChoice('.gs4','#gs42')" id="gs42">น้าหนักลด</button>
		<button type="button" class="btn btn-default gs4" onclick="selectChoice('.gs4','#gs43')" id="gs43">น้าหนักเพิ่ม</button>
	</div><!-- gs4 -->

	<!-- gs5 -->
	<div class="btn-group gen" role="group" aria-label="...">
		<button type="button" class="btn btn-default gs5" onclick="selectChoice('.gs5','#gs51')" id="gs51">ไม่ผอมลง</button>
		<button type="button" class="btn btn-default gs5" onclick="selectChoice('.gs5','#gs52')" id="gs52">ผอมลง</button>
		<button type="button" class="btn btn-default gs5" onclick="selectChoice('.gs5','#gs53')" id="gs53">อ้วนข้ึน</button>
	</div><!-- gs5 -->

	<!-- gs6 -->
	<div class="btn-group gen" role="group" aria-label="...">
		<button type="button" class="btn btn-default gs6" onclick="selectChoice('.gs6','#gs61')" id="gs61">นอนหลับดี</button>
		<button type="button" class="btn btn-default gs6" onclick="selectChoice('.gs6','#gs62')" id="gs62">นอนไม่หลับ</button>
	</div><!-- gs6 -->

	<button onclick="genTemplate('.gs', 6,'#tagsg', '#gsgCollapse')" type="button" class="btn btn-success">Generate</button>
</div>