<?php

namespace App\IPDNote\Faculty;

use Illuminate\Database\Eloquent\Model;
use App\ModelHelper;

class FacultyDischargeNote extends Model
{
	
	public $timestamps = false;

	protected $fillable = [
		'encounter_type',
		'principle_diagnosis',
		'complications',
		'operations_procedures',
		'discharge_status',
		'discharge_type',
		'autopsy',
		'treatment_result_detail',
		'history',
		'history_examination',
		'history_investigation',
		'prognosis',
		'date_appointment',
		'appointment_clinic_id',
		'appointment_clinic_name',
		'appointment_note',
		'home_medications',
	];

	protected $dates = ['date_appointment'];

	public function getRadioInputs() {
		return [
			'encounter_type',
			'discharge_status',
			'discharge_type',
			'autopsy',
		];
	}

	public function getCheckInputs() {
		return [];
	}

	public function getTextInputs() {
		return [
			'principle_diagnosis',
			'appointment_clinic_name',
			'appointment_note',
			'complications',
			'operations_procedures',
			'treatment_result_detail',
			'history',
			'history_examination',
			'history_investigation',
			'prognosis',
			'home_medications',
		];
	}

	public function getNumericInputs() {
		return [];
	}

	public function note() {
		return $this->hasOne('App\IPDNote\Note', 'id', 'id');
	}

	// public function setEncounterTypeAttribute($value) {
	// 	$this->attributes['encounter_type'] = ModelHelper::setNumericData($value);
	// }
	// public function setDischargeTypeAttribute($value) {
	// 	$this->attributes['discharge_type'] = ModelHelper::setNumericData($value);
	// }
	// public function setDischargeStatusAttribute($value) {
	// 	$this->attributes['discharge_status'] = ModelHelper::setNumericData($value);
	// }
	// public function setautopsyAttribute($value) {
	// 	$this->attributes['autopsy'] = ModelHelper::setNumericData($value);
	// }

	public function setDateAppointmentAttribute($value) {
		$this->attributes['date_appointment'] = ModelHelper::parseDateData($value);
	}
}
