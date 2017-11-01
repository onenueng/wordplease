<!-- Color selector -->
<span class="fa fa-ellipsis-v"></span>
<span class="label color-plalet selector" role="button" style="background-color: rgb(1,170,173);">c</span>
<span class="label color-plalet selector" role="button" style="background-color: rgb(0,165,96);">c</span>
<span class="label color-plalet selector" role="button" style="background-color: rgb(112,190,68);">c</span>
<span class="label color-plalet selector" role="button" style="background-color: rgb(255,222,23);">c</span>
<span class="label color-plalet selector" role="button" style="background-color: rgb(249,166,28);">c</span>
<span class="label color-plalet selector" role="button" style="background-color: rgb(246,129,33);">c</span>
<span class="label color-plalet selector" role="button" style="background-color: rgb(238,62,62);">c</span>
<span class="label color-plalet selector" role="button" style="background-color: rgb(237,28,36);">c</span>
<span class="label color-plalet selector" role="button" style="background-color: rgb(163,36,143);">c</span>
<span class="label color-plalet selector" role="button" style="background-color: rgb(92,46,145);">c</span>
<span class="label color-plalet selector" role="button" style="background-color: rgb(33,64,155);">c</span>
<span class="label color-plalet selector" role="button" style="background-color: rgb(1,102,180);">c</span>
<script type="text/javascript">
	$('.color-plalet.selector').click(function() {
		$('.color-plalet.selector').css('border', '');
		$('.color-plalet.selector').css('border-radius', '');
		$('.color-plalet.selector').css('box-shadow', '');
		$(this).css('border', '2px solid');
		$(this).css('border-radius', '50%');
		$(this).css('border-color', 'black');
		$(this).css('box-shadow', '5px 5px 5px grey');
		$('#color-sample').css('background-color', $(this).css('background-color'));
		canvas.freeDrawingBrush.color = $(this).css('background-color');
		pickedColor = $(this).css('background-color');
		updateSizeColor(); // function on drawing.blade.php.
	});
</script><!-- Color selector -->
