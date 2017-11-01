<div class="modal fade" tabindex="-1" role="dialog" id="specified_physical_exam_skin_drawing_modal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div id="specified_physical_exam_skin_drawing_carousel" class="carousel slide" data-ride="carousel" data-interval="false">
				<ol class="carousel-indicators"><!-- Indicators -->
					<li data-target="#specified_physical_exam_skin_drawing_carousel" data-slide-to="0" class="active"></li>
					<li data-target="#specified_physical_exam_skin_drawing_carousel" data-slide-to="1"></li>
					<li data-target="#specified_physical_exam_skin_drawing_carousel" data-slide-to="2"></li>
				</ol>

				<div class="carousel-inner text-center" role="listbox"><!-- Wrapper for slides -->
					<div class="text-center item active">

						<img class="create-canvas" target="specified_physical_exam_skin_drawing_collapse" drawing="{{ $note->note->patient->gender ? 'male' : 'female' }}_skin_both" src="/assets/images/drawings/medicine/{{ $note->note->patient->gender ? 'male' : 'female' }}_skin_both.svg" data-dismiss="modal">
						
						<div class="carousel-caption">
						Skin both side.
						</div>
					</div>

					<div class="text-center item">
						<img class="create-canvas" target="specified_physical_exam_skin_drawing_collapse" drawing="{{ $note->note->patient->gender ? 'male' : 'female' }}_skin_front" src="/assets/images/drawings/medicine/{{ $note->note->patient->gender ? 'male' : 'female' }}_skin_front.svg" data-dismiss="modal">
						<div class="carousel-caption">
						Skin front side.
						</div>
					</div>

					<div class="text-center item">
						<img class="create-canvas" target="specified_physical_exam_skin_drawing_collapse" drawing="{{ $note->note->patient->gender ? 'male' : 'female' }}_skin_back" src="/assets/images/drawings/medicine/{{ $note->note->patient->gender ? 'male' : 'female' }}_skin_back.svg" data-dismiss="modal">
						<div class="carousel-caption">
						Skin back side.
						</div>
					</div>
				</div>

				<!-- Controls -->
				<span class="left carousel-control" data-target="#specified_physical_exam_skin_drawing_carousel" role="button" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</span>
				<span class="right carousel-control" data-target="#specified_physical_exam_skin_drawing_carousel" role="button" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</span>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->