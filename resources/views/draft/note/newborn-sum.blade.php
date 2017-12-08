@extends('draft.layout.edit-master')

@section('content')

<panel heading="Infant Data">
	<div class="row">
		<div class="col-xs-12 col-md-6">
			<input-check-group
				label="Gender :"
				checks='[{"label": "Female", field="gender_female"},
				{"label": "Male", field="gender_male"},
				{"label": "Undifferentiated", field="gender_undifferentiated"},
				]'>
			</input-check-group>
		</div>


	</div>
</panel>

			

@endsection