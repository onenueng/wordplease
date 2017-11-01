<!-- gi generator -->
<div class="well">
	
	<!-- gi1 -->
	<div class="btn-group gen" role="group" aria-label="...">
		<button type="button" class="btn btn-default gi1" onclick="selectChoice('.gi1','#gi11')" id="gi11">ถ่ายอุจจาระปกติวันละ 1 ครั้ง</button>
		<button type="button" class="btn btn-default gi1" onclick="selectChoice('.gi1','#gi12')" id="gi12">ท้องผูก</button>
		<button type="button" class="btn btn-default gi1" onclick="selectChoice('.gi1','#gi13')" id="gi13">ท้องเสีย ถ่ายวันละ 1 - 10</button>
		<button type="button" class="btn btn-default gi1" onclick="selectChoice('.gi1','#gi14')" id="gi14">ท้องเสีย ถ่ายวันละมากกว่า 10 ครั้ง</button>
	</div><!-- gi1 -->

	<!-- gi2 -->
	<div class="btn-group gen" role="group" aria-label="...">
		<button type="button" class="btn btn-default gi2" onclick="selectChoice('.gi2','#gi21')" id="gi21">ไม่ถ่ายอุจจาระดำ</button>
		<button type="button" class="btn btn-default gi2" onclick="selectChoice('.gi2','#gi22')" id="gi22">ถ่ายอุจจาระดำ</button>
	</div><!-- gi2 -->

	<!-- gi3 -->
	<div class="btn-group gen" role="group" aria-label="...">
		<button type="button" class="btn btn-default gi3" onclick="selectChoice('.gi3','#gi31')" id="gi31">ไม่ถ่ายเป็นเลือด</button>
		<button type="button" class="btn btn-default gi3" onclick="selectChoice('.gi3','#gi32')" id="gi32">ถ่ายเป็นเลือด</button>
	</div><!-- gi3 -->

	<!-- gi4 -->
	<div class="btn-group gen" role="group" aria-label="...">
		<button type="button" class="btn btn-default gi4" onclick="selectChoice('.gi4','#gi41')" id="gi41">ไม่คลื่นไส้</button>
		<button type="button" class="btn btn-default gi4" onclick="selectChoice('.gi4','#gi42')" id="gi42">คลื่นไส้</button>
	</div><!-- gi4 -->

	<!-- gi5 -->
	<div class="btn-group gen" role="group" aria-label="...">
		<button type="button" class="btn btn-default gi5" onclick="selectChoice('.gi5','#gi51')" id="gi51">ไม่อาเจียน</button>
		<button type="button" class="btn btn-default gi5" onclick="selectChoice('.gi5','#gi52')" id="gi52">อาเจียน</button>
	</div><!-- gi5 -->

	<!-- gi6 -->
	<div class="btn-group gen" role="group" aria-label="...">
		<button type="button" class="btn btn-default gi6" onclick="selectChoice('.gi6','#gi61')" id="gi61">เป็นน้ำ</button>
		<button type="button" class="btn btn-default gi6" onclick="selectChoice('.gi6','#gi62')" id="gi62"></button>
	</div><!-- gi6 -->

	<!-- gi7 -->
	<div class="btn-group gen" role="group" aria-label="...">
		<button type="button" class="btn btn-default gi7" onclick="selectChoice('.gi7','#gi71')" id="gi71">เป็นเลือด</button>
		<button type="button" class="btn btn-default gi7" onclick="selectChoice('.gi7','#gi72')" id="gi72"></button>
	</div><!-- gi7 -->

	<!-- gi8 -->
	<div class="btn-group gen" role="group" aria-label="...">
		<button type="button" class="btn btn-default gi8" onclick="selectChoice('.gi8','#gi81')" id="gi81">เป็นอาหาร</button>
		<button type="button" class="btn btn-default gi8" onclick="selectChoice('.gi8','#gi82')" id="gi82"></button>
	</div><!-- gi8 -->

	<!-- gi9 -->
	<div class="btn-group gen" role="group" aria-label="...">
		<button type="button" class="btn btn-default gi9" onclick="selectChoice('.gi9','#gi91')" id="gi91">ไม่เคยมีอาการตัวเหลือง</button>
		<button type="button" class="btn btn-default gi9" onclick="selectChoice('.gi9','#gi92')" id="gi92">ตัวเหลือง</button>
		<button type="button" class="btn btn-default gi9" onclick="selectChoice('.gi9','#gi93')" id="gi93">ตาเหลือง</button>
	</div><!-- gi9 -->

	<!-- gi10 -->
	<div class="btn-group gen" role="group" aria-label="...">
		<button type="button" class="btn btn-default gi10" onclick="selectChoice('.gi10','#gi101')" id="gi101">ไม่มีก้อนในท้อง</button>
		<button type="button" class="btn btn-default gi10" onclick="selectChoice('.gi10','#gi102')" id="gi102">คลำได้ก้อนในท้อง</button>
	</div><!-- gi10 -->

	<!-- change number of choices -->
	<button onclick="genTemplate('.gi', 10,'#tagiReviewDetail', '#giReviewGenCollapse')" type="button" class="btn btn-success">Generate</button>
</div><!-- end gi -->