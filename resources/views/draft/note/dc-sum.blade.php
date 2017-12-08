@extends('draft.layout.edit-master')

@section('content')

<panel heading="Treatments Description">
	<div class="row">
		<div class="col-xs-12">
			<input-textarea
				field="principle_diagnosis"
				label="Principle diagnosis"
				placeholder="Description"
				max-chars="200">
			</input-textarea>

			<input-textarea
				field="reason_for_admission"
				label="Reason for admission"
				placeholder="Description"
				max-chars="100">
			</input-textarea>

			<input-textarea
				field="comorbids"
				label="Comorbids"
				placeholder="Description"
				max-chars="1000">
			</input-textarea>

			<input-textarea
				field="complications"
				label="Complications"
				placeholder="Description"
				max-chars="1000">
			</input-textarea>

			<input-textarea
				field="external_causes"
				label="External Causes"
				placeholder="Description"
				max-chars="1000">
			</input-textarea>

			<input-textarea
				field="other_diagnosis"
				label="Other Diagnosis"
				placeholder="Description"
				max-chars="200">
			</input-textarea>

			<input-textarea
				field="OR_procedures"
				label="OR procedures"
				placeholder="Description"
				max-chars="1000">
			</input-textarea>

			<input-textarea
				field="non_OR_procedures"
				label="Non OR procedures"
				placeholder="Description"
				max-chars="1000">
			</input-textarea>

			<input-textarea
				field="chief_complaint"
				label="Chief complaint"
				placeholder="Description"
				max-chars="1000">
			</input-textarea>

			<input-textarea
				field="significant_findings"
				label="Significant Findings"
				placeholder="Description"
				max-chars="1000">
			</input-textarea>

			<input-textarea
				field="significant_procedured"
				label="Significant Procedured"
				placeholder="Description"
				max-chars="1000">
			</input-textarea>

			<input-textarea
				field="hospital_course"
				label="Hospital Course"
				placeholder="Description"
				max-chars="1000">
			</input-textarea>

			<input-textarea
				field="hospital_course"
				label="Hospital Course"
				placeholder="Description"
				max-chars="1000">
			</input-textarea>

			<input-textarea
				field="condition_upon_discharge"
				label="Condition upon Discharge"
				placeholder="Description"
				max-chars="1000">
			</input-textarea>
		</div>

		<div class="col-xs-12 col-md-6">
			<input-select
				field="DC_status"
				label="Discharge Status"
				not-allow-other>
			</input-select>
		</div>

		<div class="col-xs-12 col-md-6">
			<input-select
				field="DC_type"
				label="Discharge Type"
				not-allow-other>
			</input-select>
		</div>

		<div class="col-xs-12">
			<input-textarea
				field="significant_medications_and_treatments_during_admission"
				label="Significant medications and treatments during admission"
				placeholder="Description"
				max-chars="1000">
			</input-textarea>

			<input-textarea
				field="home_medications"
				label="Home medications"
				placeholder="Description"
				max-chars="1000">
			</input-textarea>

			<input-textarea
				field="follow_up_schedule_and_instruction"
				label="Follow up schedule and instruction"
				placeholder="Description"
				max-chars="1000">
			</input-textarea>
		</div>
	</div>
</panel>

@endsection