<!-- img_@name WordPaint is required -->
<div class="well">
	<!-- tools button -->
	<button onclick="@name.resetCanvas()" type="button" class="btn btn-danger">Reset</button>
	<div class="btn-group" role="group" aria-label="...">
		<button type="button" class="active btn btn-default tools" id="marker">Marker</button>
		<button type="button" class="btn btn-default tools" id="label">Label</button>
		<button type="button" class="btn btn-default tools" id="eraser">Eraser</button>
	</div>

	<!-- tool script -->
	<script type="text/javascript">
		 $(".tools").click(function(){
		 	$(".tools").removeClass("active");
		 	$(this).addClass("active");
		 	curTool = $(this).prop('id');
		});
	</script>

	<!-- color button -->
	<div class="btn-group" role="group" aria-label="...">
		<button type="button" class="active btn btn-default colors" id="#FF0000">Red</button>
		<button type="button" class="btn btn-default colors" id="#00FFFF">Blue</button>
		<button type="button" class="btn btn-default colors" id="#006600">Green</button>
		<button type="button" class="btn btn-default colors" id="#000000">Black</button>
	</div>

	<!-- color script -->
	<script type="text/javascript">
	 	$(".colors").click(function(){
		 	$(".colors").removeClass("active");
		 	$(this).addClass("active");
		 	curColor = $(this).prop('id');
		});
	</script>

	<!-- brush size -->
	<div class="btn-group" role="group" aria-label="...">
		<button type="button" class="btn btn-default brushSize" id="small">Small</button>
		<button type="button" class="active btn btn-default brushSize" id="normal">Normal</button>
		<button type="button" class="btn btn-default brushSize" id="large">Large</button>
		<button type="button" class="btn btn-default brushSize" id="huge">Huge</button>
	</div>
	
	<!-- brush size script -->
	<script type="text/javascript">
	 	$(".brushSize").click(function(){
		 	$(".brushSize").removeClass("active");
		 	$(this).addClass("active");
		 	curSize = $(this).prop('id');
		});
	</script>

</div>

<!-- @name -->
<div id="@nameDiv">
	<script type="text/javascript">
	var @name;
	$(document).ready(function() {
		@name = new WordPaint('@nameDiv',540,720,'@name'); //manually set widht and height herr
		@name.createCanvas('/assets/images/frontdermatome.png'); // mannually set image source file here

		// add mousedown event
		$('#@name').mousedown(function(e){
			var mouseX = e.pageX - this.offsetLeft;
			var mouseY = e.pageY - this.offsetTop;
				
			Paint = true;
			AddClick(e.pageX - this.offsetLeft, e.pageY - this.offsetTop, @name);
			Redraw(@name);
		});

		// add mousemove event
		$('#@name').mousemove(function(e){
			if(Paint){
				AddClick(e.pageX - this.offsetLeft, e.pageY - this.offsetTop, @name,true);
				Redraw(@name);
			}
		});
	});
	</script>
</div><!-- end @name -->