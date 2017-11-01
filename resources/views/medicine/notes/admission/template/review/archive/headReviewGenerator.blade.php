<!-- hr generator -->
<div class="well">
	
	<!-- hr1 -->
	<div class="btn-group gen" role="group" aria-label="...">
		<button type="button" class="btn btn-default hr1" onclick="selectChoice('.hr1','#hr11')" id="hr11">ไม่เคยได้รับอุบัติเหตุท่ีศรีษะ</button>
		<button type="button" class="btn btn-default hr1" onclick="selectChoice('.hr1','#hr12')" id="hr12">เคยได้รับอุบัติเหตุท่ีศรีษะ</button>
	</div><!-- hr1 -->

	<!-- hr2 -->
	<div class="btn-group gen" role="group" aria-label="...">
		<button type="button" class="btn btn-default hr2" onclick="selectChoice('.hr2','#hr21')" id="hr21">ไม่ปวดหัว</button>
		<button type="button" class="btn btn-default hr2" onclick="selectChoice('.hr2','#hr22')" id="hr22">ปวดหัว</button>
	</div><!-- hr2 -->

	<!-- change number of choices -->
	<button onclick="genTemplate('.hr', 2,'#tahrg', '#hrgCollapse')" type="button" class="btn btn-success">Generate</button>
</div><!-- end hr -->