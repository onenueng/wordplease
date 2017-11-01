<!-- breast generator -->
<div class="well">
	
	<!-- breast1 -->
	<div class="btn-group gen" role="group" aria-label="...">
		<button type="button" class="btn btn-default breast1" onclick="selectChoice('.breast1','#breast11')" id="breast11">ไม่มีก้อนที่เต้านม</button>
		<button type="button" class="btn btn-default breast1" onclick="selectChoice('.breast1','#breast12')" id="breast12">มีก้อนที่เต้านม</button>
	</div><!-- breast1 -->

	<!-- breast2 -->
	<div class="btn-group gen" role="group" aria-label="...">
		<button type="button" class="btn btn-default breast2" onclick="selectChoice('.breast2','#breast21')" id="breast21">ไม่มีน้ำไหลจากหัวนม</button>
		<button type="button" class="btn btn-default breast2" onclick="selectChoice('.breast2','#breast22')" id="breast22">มีน้ำไหลจากหัวนม</button>
	</div><!-- breast2 -->

	<!-- breast3 -->
	<div class="btn-group gen" role="group" aria-label="...">
		<button type="button" class="btn btn-default breast3" onclick="selectChoice('.breast3','#breast33')" id="breast33">ไม่มีนมไหลจากหัวนม</button>
		<button type="button" class="btn btn-default breast3" onclick="selectChoice('.breast3','#breast32')" id="breast32">มีนมไหลจากหัวนม</button>
	</div><!-- breast3 -->

	<!-- change number of choices -->
	<button onclick="genTemplate('.breast', 3,'#tabreastReviewDetail', '#breastReviewGenCollapse')" type="button" class="btn btn-success">Generate</button>
</div><!-- end breast -->