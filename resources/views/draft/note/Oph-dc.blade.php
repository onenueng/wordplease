@extends('draft.layout.edit-master')

@section('content')

<panel heading="Ophthalmology - Discharge Summary">
	<div class="row">
		<div class="col-xs-12">
			<input-textarea
				field="diagnosis"
				label="Diagnosis"
				placeholder="specify other diagnosis"
				max-chars="255">
			</input-textarea>
		</div>
			
		<div class="col-xs-12 col-md-6">
			<input-select
				field="right_side_cataract"
				service-url="select/cataract"
				label="Right side cataract :"
				not-allow-other>
			</input-select>
		</div>

		<div class="col-xs-12 col-md-6">
			<input-select
				field="left_side_cataract"
				service-url="select/cataract"
				label="Left side cataract :"
				not-allow-other>
			</input-select>
		</div>

		{{-- <div class="col-xs-12 col-md-6">
			<input-check-group
				field="right_retinal_detachment"
				label="Right retinal detachment :"
				check>
			</input-check-group>
		</div> --}}


		</div>
	</div>
</panel>

@endsection