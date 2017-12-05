@extends('draft.layout.edit-master')

@section('content')
<panel heading="Treatments Description">
	<div class="row">
		<div class="col-xs-12 col-md-6">
			<input-textarea
				field="principle_diagnosis"
				label="Principle diagnosis :"
				max-chars="255">
			</input-textarea>

			<input-textarea
				field="admission_reason"
				label="Reason for admission :"
				max-chars="255">
			</input-textarea>

			<input-textarea
				field="comorbids"
				label="Comorbids :"
				max-chars="1000">
			</input-textarea>

			<input-textarea
				field="complications"
				label="Complications :"
				max-chars="1000">
			</input-textarea>

			<input-textarea
				field="external_causes"
				label="External Causes :"
				max-chars="1000">
			</input-textarea>

			<input-textarea
				field="other_diagnosis"
				label="Other Diagnosis :"
				max-chars="255">
			</input-textarea>

			<input-textarea
				field="OR_procedures"
				label="OR procedures :"
				max-chars="1000">
			</input-textarea>
		</div>

		<div class="col-xs-12 col-md-6">
			<input-textarea
				field="non_or_procedures"
				label="Non OR procedures :"
				max-chars="1000">
			</input-textarea>

			<input-textarea
				field="chief_complaint"
				label="Chief complaint :"
				max-chars="1000">
			</input-textarea>

			<input-textarea
				field="significant_findings"
				label="Significant Findings :"
				max-chars="1000">
			</input-textarea>

			<input-textarea
				field="significant_procedured"
				label="Significant Procedured :"
				max-chars="1000">
			</input-textarea>

			<input-textarea
				field="hospital_course"
				label="Hospital Course :"
				max-chars="1000">
			</input-textarea>

			<input-textarea
				field="condition_upon_discharge"
				label="Condition upon Discharge :"
				max-chars="1000">
			</input-textarea>
		</div>
	</div>
</panel>

@endsection