<div class="well">
	<!-- tools button -->
	<button onclick="resetCanvas()" type="button" class="btn btn-danger">Reset</button>
	<div class="btn-group" role="group" aria-label="...">
		<button type="button" class="active btn btn-default tools" name="marker">Marker</button>
		<button type="button" class="btn btn-default tools" name="label">Label</button>
		<button type="button" class="btn btn-default tools" name="eraser">Eraser</button>
	</div>

	<!-- tool script -->
	<script type="text/javascript">
		 $(".tools").click(function(){
		 	$(".tools").removeClass("active");
		 	$(this).addClass("active");
		 	curTool = $(this).attr('name');
		});
	</script>

	<!-- color button -->
	<div class="btn-group" role="group" aria-label="...">
		<button type="button" class="active btn btn-default colors" name ="#FF0000">Red</button>
		<button type="button" class="btn btn-default colors" name ="#00FFFF">Blue</button>
		<button type="button" class="btn btn-default colors" name ="#006600">Green</button>
		<button type="button" class="btn btn-default colors" name ="#000000">Black</button>
	</div>

	<!-- color script -->
	<script type="text/javascript">
	 	$(".colors").click(function(){
		 	$(".colors").removeClass("active");
		 	$(this).addClass("active");
		 	//alert($(this).attr('name'));
		 	curColor = $(this).prop('name');

		});
	</script>

	<!-- brush size -->
	<div class="btn-group" role="group" aria-label="...">
		<button type="button" class="btn btn-default brushSize" name="small">Small</button>
		<button type="button" class="active btn btn-default brushSize" name="normal">Normal</button>
		<button type="button" class="btn btn-default brushSize" name="large">Large</button>
		<button type="button" class="btn btn-default brushSize" name="huge">Huge</button>
	</div>
	
	<!-- brush size script -->
	<script type="text/javascript">
	 	$(".brushSize").click(function(){
		 	$(".brushSize").removeClass("active");
		 	$(this).addClass("active");
		 	curSize = $(this).attr('name');
		});
	</script>

</div>

<div id="canvasDiv"></div>