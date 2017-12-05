@extends('draft.layout.edit-master')

@section('content')

<panel heading="Ophthalmology - Discharge Summary">
	<div class="row">
		<div class="col-xs-12">
			<input-textarea
				field="diagnosis"
				label="Diagnosis :"
				placeholder="specify other diagnosis"
				max-chars="255">
			</input-textarea>
		</div>

		<div class="col-xs-12"><hr class="line" /></div>

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

		<div class="col-xs-12"><hr class="line" /></div>

		<div class="col-xs-12 col-md-6">
			<input-check-group
				label="Right retinal detachment :"
				checks='[
					{"label": "RRD", "field": "right_retinal_detachment_RRD", "labelDescription": "Rhegmatogenous Retinal Detachment"},
					{"label": "TRD", "field": "right_retinal_detachment_TRD", "labelDescription": "Traction Retinal Detachment"},
					{"label": "ERD", "field": "right_retinal_detachment_ERD", "labelDescription": "Exudative Retinal Detachment"}
				]'>
			</input-check-group>
		</div>

		<div class="col-xs-12 col-md-6">
			<input-check-group
				label="Left retinal detachment :"
				checks='[
					{"label": "RRD", "field": "left_retinal_detachment_RRD", "labelDescription": "Rhegmatogenous Retinal Detachment"},
					{"label": "TRD", "field": "left_retinal_detachment_TRD", "labelDescription": "Traction Retinal Detachment"},
					{"label": "ERD", "field": "left_retinal_detachment_ERD", "labelDescription": "Exudative Retinal Detachment"}
				]'>
			</input-check-group>
		</div>

		<div class="col-xs-12"><hr class="line" /></div>

		<div class="col-xs-12 col-md-6">
			<input-radio
				label="DR :"
				options='[
					{"label": "No", "value": "1"},
					{"label": "PDR", "value": "2"},
					{"label": "TDR", "value": "3"}
				]'>
			</input-radio>
		</div>

		<div class="col-xs-12 col-md-6">
			<input-radio
				label="CMV retinitis :"
				options='[
					{"label": "No", "value": "1"},
					{"label": "Yes", "value": "2"}
				]'>
			</input-radio>
		</div>

		<div class="col-xs-12"><hr class="line" /></div>

		<div class="col-xs-12">
			<input-textarea
				field="complications"
				label="Complications :"
				placeholder="description"
				max-chars="1000">
			</input-textarea>
		</div>

		<div class="col-xs-12">
			<input-textarea
				field="operation"
				label="Operation (Operation/Date/Surgeon) :"
				placeholder="description"
				max-chars="1000">
			</input-textarea>
		</div>
{{-- add drawing --}}
		<div class="col-xs-12">
			<input-textarea
				field="result_of_treatment"
				label="Result of Treatment :"
				placeholder="description"
				max-chars="1000">
			</input-textarea>
		</div>

		<div class="col-xs-12">
			<input-textarea
				field="history"
				label="History :"
				placeholder="description"
				max-chars="1000">
			</input-textarea>

			<input-textarea
				field="examination"
				label="Examination :"
				placeholder="description"
				max-chars="1000">
{{-- add drawing --}}
			</input-textarea>

		<div class="col-xs-12 col-md-6">
			<input-select
				field="DC_status"
				label="D/C Status :"
				not-allow-other>
			</input-select>
		</div>

		<div class="col-xs-12 col-md-6">
			<input-select
				field="DC_type"
				label="D/C Type :"
				not-allow-other>
			</input-select>
		</div>

		<div class="col-xs-12 col-md-4">
			<input-select
				field="conjunctival_injection"
				label="Conjunctival injection :"
				not-allow-other>
			</input-select>

			<input-select
				field="cornea_cell"
				label="Cornea cell :"
				not-allow-other>
			</input-select>

			<input-select
				field="cornea_edema"
				label="Cornea edema :"
				not-allow-other>
			</input-select>

			<input-select
				field="AC"
				label="AC "
				label-description="anterior chamber"
				not-allow-other>
			</input-select>
		</div>

		<div class="col-xs-12 col-md-4">
			<input-select
				field="AC_cell"
				label="AC cell "
				label-description="anterior chamber cell"
				not-allow-other>
			</input-select>

			<input-text-addon
				field="pupil_size"
				label="Pupil size :"
				rear-addon="mm">
			</input-text-addon>

			<input-select
				field="pupil_shape"
				label="Pupil shape :"
				placeholder="หากไม่มีในตัวเลือกพิมพ์ตรงนี้">
			</input-select>

			<input-select
				field="pupil_react"
				label="Pupil react :"
				placeholder="หากไม่มีในตัวเลือกพิมพ์ตรงนี้">
			</input-select>
		</div>

		<div class="col-xs-12 col-md-4">
			<input-select
				field="lens"
				label="Lens :"
				placeholder="หากไม่มีในตัวเลือกพิมพ์ตรงนี้">
			</input-select>

			<input-textarea
				field="disc_CD"
				label="Disc C/D "
				label-description="Cup to disc ratio">
			</input-textarea>

			<input-select
				field="disc_notching"
				label="Disc Notching :">
			</input-select>

			<input-select
				field="disc_polar"
				label="Disc Polar :"
				placeholder="หากไม่มีในตัวเลือกพิมพ์ตรงนี้">
			</input-select>
		</div>

		<div class="col-xs-12">
			<input-textarea
				field="investigation"
				label="Investigation :"
				placeholder="description"
				max-chars="1000">
			</input-textarea>
		</div>

		<div class="col-xs-12">
			<input-textarea
				field="prognosis"
				label="Prognosis :"
				placeholder="description"
				max-chars="1000">
			</input-textarea>
		</div>

		<div class="col-xs-12 col-md-6">
			<input-text-addon
				field="date"
				label="Date :"
				rear-addon="calendar">
			</input-text-addon>
		</div>

		<div class="col-xs-12 col-md-6">
			<input-text-addon
				field="clinic"
				label="Clinic "
				label-description=""
				front-addon="light">
			</input-text-addon>
		</div>

		<div class="col-xs-12">
			<input-textarea
				field="note"
				label="Note :">
			</input-textarea>
		</div>

	</div>
</panel>

@endsection