<div class="modal fade" tabindex="-1" role="dialog" id="specified_physical_exam_nervous_system_drawing_modal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div id="specified_physical_exam_nervous_system_drawing_carousel" class="carousel slide" data-ride="carousel" data-interval="false">
				<ol class="carousel-indicators"><!-- Indicators -->
					<li data-target="#specified_physical_exam_nervous_system_drawing_carousel" data-slide-to="0" class="active"></li>
					<li data-target="#specified_physical_exam_nervous_system_drawing_carousel" data-slide-to="1"></li>
					<li data-target="#specified_physical_exam_nervous_system_drawing_carousel" data-slide-to="2"></li>
					{{-- retina
					head-neuro
					leg --}}
					<li data-target="#specified_physical_exam_nervous_system_drawing_carousel" data-slide-to="3"></li>
					<li data-target="#specified_physical_exam_nervous_system_drawing_carousel" data-slide-to="4"></li>
				</ol>

				<div class="carousel-inner text-center" role="listbox"><!-- Wrapper for slides -->
					<div class="text-center item active">
						<img class="create-canvas" target="specified_physical_exam_nervous_system_drawing_collapse" drawing="{{ $note->note->patient->gender ? 'male' : 'female' }}_dermatome_both" src="/assets/images/drawings/medicine/{{ $note->note->patient->gender ? 'male' : 'female' }}_dermatome_both.svg" data-dismiss="modal">
						<div class="carousel-caption">
						Feet perspective.
						</div>
					</div>

					<div class="text-center item">
						<img class="create-canvas" target="specified_physical_exam_nervous_system_drawing_collapse" drawing="{{ $note->note->patient->gender ? 'male' : 'female' }}_dermatome_front" src="/assets/images/drawings/medicine/{{ $note->note->patient->gender ? 'male' : 'female' }}_dermatome_front.svg" data-dismiss="modal">
						<div class="carousel-caption">
						Feet.
						</div>
					</div>

					<div class="text-center item">
						<img class="create-canvas" target="specified_physical_exam_nervous_system_drawing_collapse" drawing="{{ $note->note->patient->gender ? 'male' : 'female' }}_dermatome_back" src="/assets/images/drawings/medicine/{{ $note->note->patient->gender ? 'male' : 'female' }}_dermatome_back.svg" data-dismiss="modal">
						<div class="carousel-caption">
						Both hands side.
						</div>
					</div>

					<div class="text-center item">
						<img class="create-canvas" target="specified_physical_exam_nervous_system_drawing_collapse" drawing="deep_tendon_reflex" src="/assets/images/drawings/medicine/deep_tendon_reflex.svg" data-dismiss="modal">
						<div class="carousel-caption">
						Left hand.
						</div>
					</div>

					<div class="text-center item">
						<img class="create-canvas" target="specified_physical_exam_nervous_system_drawing_collapse" drawing="motor_power" src="/assets/images/drawings/medicine/motor_power.svg" data-dismiss="modal">
						<div class="carousel-caption">
						Left hand.
						</div>
					</div>

				</div>

				<!-- Controls -->
				<span class="left carousel-control" data-target="#specified_physical_exam_nervous_system_drawing_carousel" role="button" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</span>
				<span class="right carousel-control" data-target="#specified_physical_exam_nervous_system_drawing_carousel" role="button" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</span>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->