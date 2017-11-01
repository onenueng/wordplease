<!-- neck generator -->
<div class="well">
	
	<!-- neck1 -->
	<div class="btn-group gen" role="group" aria-label="...">
		<button type="button" class="btn btn-default neck1" onclick="selectChoice('.neck1','#neck11')" id="neck11">no thyroid gland enlargement </button>
		<button type="button" class="btn btn-default neck1" onclick="selectChoice('.neck1','#neck12')" id="neck12">thyroid gland enlargement </button>
	</div><!-- neck1 -->

	<!-- neck2 -->
	<div class="btn-group gen" role="group" aria-label="...">
		<button type="button" class="btn btn-default neck2" onclick="selectChoice('.neck2','#neck21')" id="neck21">no carotid bruit </button>
		<button type="button" class="btn btn-default neck2" onclick="selectChoice('.neck2','#neck22')" id="neck22">carotid bruit on left side</button>
		<button type="button" class="btn btn-default neck2" onclick="selectChoice('.neck2','#neck23')" id="neck23">carotid bruit on right side</button>
		<button type="button" class="btn btn-default neck2" onclick="selectChoice('.neck2','#neck24')" id="neck24">carotid bruit on both sides</button>
	</div><!-- neck2 -->

	<!-- change number of choices -->
	<button onclick="genTemplate('.neck', 2,'#taneckExamDetail', '#neckExamGenCollapse')" type="button" class="btn btn-success">Generate</button>
</div><!-- end neck -->