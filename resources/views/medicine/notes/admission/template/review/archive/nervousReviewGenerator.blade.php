<!-- nervous generator -->
<div class="well">
	
	<!-- nervous1 -->
	<div class="btn-group gen" role="group" aria-label="...">
		<button type="button" class="btn btn-default nervous1" onclick="selectChoice('.nervous1','#nervous11')" id="nervous11">ไม่เคยชัก</button>
		<button type="button" class="btn btn-default nervous1" onclick="selectChoice('.nervous1','#nervous12')" id="nervous12">เคยชัก</button>
	</div><!-- nervous1 -->

	<!-- nervous2 -->
	<div class="btn-group gen" role="group" aria-label="...">
		<button type="button" class="btn btn-default nervous2" onclick="selectChoice('.nervous2','#nervous21')" id="nervous21">ไม่เวียนศรีษะ</button>
		<button type="button" class="btn btn-default nervous2" onclick="selectChoice('.nervous2','#nervous22')" id="nervous22">เวียนศรีษะ</button>
	</div><!-- nervous2 -->

	<!-- nervous3 -->
	<div class="btn-group gen" role="group" aria-label="...">
		<button type="button" class="btn btn-default nervous3" onclick="selectChoice('.nervous3','#nervous31')" id="nervous31">แขนมีแรงดี</button>
		<button type="button" class="btn btn-default nervous3" onclick="selectChoice('.nervous3','#nervous32')" id="nervous32">แขนซ้ายอ่อนแรง</button>
		<button type="button" class="btn btn-default nervous3" onclick="selectChoice('.nervous3','#nervous33')" id="nervous33">แขนขวาอ่อนแรง</button>
		<button type="button" class="btn btn-default nervous3" onclick="selectChoice('.nervous3','#nervous34')" id="nervous34">แขนอ่อนแรงทั้ง 2 ข้าง</button>
	</div><!-- nervous3 -->

	<!-- nervous4 -->
	<div class="btn-group gen" role="group" aria-label="...">
		<button type="button" class="btn btn-default nervous4" onclick="selectChoice('.nervous4','#nervous41')" id="nervous41">ขามีแรงดี</button>
		<button type="button" class="btn btn-default nervous4" onclick="selectChoice('.nervous4','#nervous42')" id="nervous42">ขาซ้ายอ่อนแรง</button>
		<button type="button" class="btn btn-default nervous4" onclick="selectChoice('.nervous4','#nervous43')" id="nervous43">ขาขวาอ่อนแรง</button>
		<button type="button" class="btn btn-default nervous4" onclick="selectChoice('.nervous4','#nervous44')" id="nervous44">ขาอ่อนแรงทั้ง 2 ข้าง</button>
	</div><!-- nervous4 -->

	<!-- nervous5 -->
	<div class="btn-group gen" role="group" aria-label="...">
		<button type="button" class="btn btn-default nervous5" onclick="selectChoice('.nervous5','#nervous51')" id="nervous51">ไม่มี่อาการชาท่ีใด</button>
		<button type="button" class="btn btn-default nervous5" onclick="selectChoice('.nervous5','#nervous52')" id="nervous52">มีอาการชาท่ี___</button>
	</div><!-- nervous5 -->

	<!-- nervous6 -->
	<div class="btn-group gen" role="group" aria-label="...">
		<button type="button" class="btn btn-default nervous6" onclick="selectChoice('.nervous6','#nervous61')" id="nervous61">ไม่มีอาการมือเท้าสั่น</button>
		<button type="button" class="btn btn-default nervous6" onclick="selectChoice('.nervous6','#nervous62')" id="nervous62">มีอาการมือสั่น</button>
	</div><!-- nervous6 -->

	<!-- change number of choices -->
	<button onclick="genTemplate('.nervous', 6,'#tanervousReviewDetail', '#nervousReviewGenCollapse')" type="button" class="btn btn-success">Generate</button>
</div><!-- end nervous -->