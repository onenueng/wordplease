<?php

namespace App\IPDNote\Obgyn;

use Illuminate\Database\Eloquent\Model;
use App\IPDNote\Note;
use App\Itemizes\Patient;
use App\Itemizes\Ward;
use App\Itemizes\AttendingStaff;
use Carbon\Carbon;

class ObgynLabourNote extends Model
{
	protected $fillable =[
		'patient_id',
		'AN',
		'datetime_admit',
		'ward_id',
		'attending_id',
		// 'resident_id',
		'datetime_dc',
	];

	protected $dates = ['datetime_admit', 'datetime_dc'];

	public function note() {
		return $this->hasOne('App\IPDNote\Note', 'id', 'note_id');
	}

	public function patient() {
		return $this->hasOne('App\Itemizes\Patient', 'id', 'patient_id');
	}

	public function ward() {
		return $this->hasOne('App\Itemizes\Ward', 'id', 'ward_id');
	}

	public function attending() {
		return $this->hasOne('App\Itemizes\AttendingStaff', 'id', 'attending_id');
	}

	// public function creator() {
	// 	return $this->hasOne('App\User', 'id', 'creator');
	// }

	// public function updater() {
	// 	return $this->hasOne('App\User', 'id', 'updater');
	// }

	/**
	* Note Interfaces.
	* 
	**/

	// public function getNoteTypeName() {
	// 	$note = Note::find($this->note_id);
	// 	return $note->getNoteTypeName();
	// }

	// public function getPatientData($data = 'name') {
	// 	$patient = Patient::find($this->patient_id);
	// 	if ($data == 'name') return $patient->getName();
	// 	if ($data == 'HN') return $patient->HN;
	// 	if ($data == 'gender') return $patient->getGenderText();
	// 	if ($data == 'age note') return $patient->ageAtDate($this->created_at);
	// 	if ($data == 'age now') return $patient->ageAtDate(Carbon::now()->copy());
	// 	if ($data == 'gender_code') return $patient->gender;
	// }

	// public function getWardName() {
	// 	if (is_null($this->ward_id))
	// 		return NULL;
	// 	$ward = Ward::find($this->ward_id);
	// 	return $ward->name;
	// }

	// public function getAttendingData($data = 'name') {
	// 	if (is_null($this->attending_id))
	// 		return NULL;
	// 	$staff = AttendingStaff::find($this->attending_id);
	// 	if ($data == 'name')
	// 		return $staff->name;
	// 	return $staff->getDetail();
	// }

	public function getDate($date_selected = 'admit', $mode = 'short') {
		if ($date_selected == 'admit') {
			if (is_null($this->datetime_admit))
				return NULL;
			$date = $this->datetime_admit; 
		} else {
			if (is_null($this->datetime_dc))
				return NULL;
			$date = $this->datetime_dc;
		}
		if ($mode == 'short')
			return $date->format('d-m-Y');
		return $date->format('d-m-Y H:i');
	}

	public function getLOS($interval = 'days') {
		if (is_null($this->datetime_admit))
			return NULL;
		if (is_null($this->datetime_dc))
			$reference = Carbon::now();
		else
			$reference = $this->datetime_dc;
		$message = $this->datetime_admit->diffForHumans($reference);
		if ($interval == 'days')
			return $message . ' (' . $this->datetime_admit->diffInDays($reference) . ' days)';
		return $message . ' (' . $this->datetime_admit->diffInMonths($reference) . ' months)';
	}

	/**
	* Encypt data before save to database.
	* @param string $field, strin $value.
	* @return void
	**/
	protected function setEncryptData($field, $value) {
		$this->attributes[$field] = ($value == '') ? NUll : \Crypt::encrypt($value);
	}
	/**
	* Decypt data before output by model.
	* @param string $field.
	* @return void
	**/
	protected function getEncryptData($field) {
		return is_null($this->attributes[$field]) ? NULL : \Crypt::decrypt($this->attributes[$field]);
	}
	public function setANAttribute($value) { $this->setEncryptData('AN', $value); } // AN setter.
	public function getANAttribute() { return $this->getEncryptData('AN'); } // AN getter.

	protected function setDateTimeData($field, $value) {
		$this->attributes[$field] = $value == '' ? null : Carbon::createFromFormat('d-m-Y H:i', $value);
	}
	// datetime_admit setter.
	public function setDatetimeAdmitAttribute($value) { $this->setDateTimeData('datetime_admit', $value);}
	// datetime_dc setter.
	public function setDatetimeDcAttribute($value) { $this->setDateTimeData('datetime_dc', $value);}
}
