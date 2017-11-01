<!-- skin generator -->
<div class="well">
	
	<!-- skin1 -->
	<div class="btn-group gen" role="group" aria-label="...">
		<button type="button" class="btn btn-default skin1" onclick="selectChoice('.skin1','#skin11')" id="skin11">no petechiae</button>
		<button type="button" class="btn btn-default skin1" onclick="selectChoice('.skin1','#skin12')" id="skin12">petechiae</button>
	</div><!-- skin1 -->

	<!-- skin2 -->
	<div class="btn-group gen" role="group" aria-label="...">
		<button type="button" class="btn btn-default skin2" onclick="selectChoice('.skin2','#skin21')" id="skin21">no ecchymoses</button>
		<button type="button" class="btn btn-default skin2" onclick="selectChoice('.skin2','#skin22')" id="skin22">ecchymoses</button>
	</div><!-- skin2 -->

	<!-- skin3 -->
	<div class="btn-group gen" role="group" aria-label="...">
		<button type="button" class="btn btn-default skin3" onclick="selectChoice('.skin3','#skin31')" id="skin31">no rash</button>
		<button type="button" class="btn btn-default skin3" onclick="selectChoice('.skin3','#skin32')" id="skin32">rash</button>
	</div><!-- skin3 -->

	<!-- skin4 -->
	<div class="btn-group gen" role="group" aria-label="...">
		<button type="button" class="btn btn-default skin4" onclick="selectChoice('.skin4','#skin41')" id="skin41">no pigmentation</button>
		<button type="button" class="btn btn-default skin4" onclick="selectChoice('.skin4','#skin42')" id="skin42">pigmentation</button>
	</div><!-- skin4 -->

	<!-- change number of choices -->
	<button onclick="genTemplate('.skin', 4,'#taskinExamDetail', '#skinExamGenCollapse')" type="button" class="btn btn-success">Generate</button>
</div><!-- end skin -->