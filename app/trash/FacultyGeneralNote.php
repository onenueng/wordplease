<?php

namespace App\IPDNote\Faculty;

use Illuminate\Database\Eloquent\Model;
// use App\MockupWard;
// use App\MockupPatient;
use App\IPDNote\Note;
use App\Itemizes\Patient;
use App\Itemizes\Ward;
use App\Itemizes\AttendingStaff;
use Carbon\Carbon;

class FacultyGeneralNote extends Model
{
  protected $table = 'faculty_general_notes';
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

	public function getWardName() {
		if (is_null($this->ward_id))
			return NULL;
		$ward = Ward::find($this->ward_id);
		return $ward->name;
	}

	public function getAttendingData($data = 'name') {
		if (is_null($this->attending_id))
			return NULL;
		$staff = AttendingStaff::find($this->attending_id);
		if ($data == 'name')
			return $staff->name;
		return $staff->getDetail();
	}

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

    public function transferNote($noteType,$noteID)
    {
        if ($noteType == 1) { // From Admission note.
            $note = MedicineAdmissionNote::where('note_id',$noteID)->first();
            $this->attributes['chief_complaint'] = $note->chief_complaint;
            $this->attributes['reason_admit'] = $note->reasonAdmitToString();
            $this->attributes['comorbids'] = $note->comorbidToString();
            $this->attributes['significant_findings'] = $note->getSignificantFinding();
            $this->attributes['hospital_course'] = $note->getHospitalCourse();
            $this->attributes['admit_rx_medications'] = $note->current_medications;
            return true;
        } elseif ($noteType == 2) { // From DC note.
            $note = MedicineDischargeNote::where('note_id',$noteID)->first();
            $this->attributes['principle_diagnosis'] = $note->principle_diagnosis;
            $this->attributes['reason_admit'] = $note->reason_admit;
            $this->attributes['comorbids'] = $note->comorbids;
            $this->attributes['complications'] = $note->complications;
            $this->attributes['external_causes'] = $note->external_causes;
            $this->attributes['other_diagnosis'] = $note->other_diagnosis;
            $this->attributes['OR_procedure'] = $note->OR_procedure;
            $this->attributes['non_OR_procedure'] = $note->non_OR_procedure;
            $this->attributes['chief_complaint'] = $note->chief_complaint;
            $this->attributes['significant_findings'] = $note->significant_findings;
            $this->attributes['significant_procedured'] = $note->significant_procedured;
            $this->attributes['hospital_course'] = $note->hospital_course;
            $this->attributes['condition_upon_DC'] = $note->condition_upon_DC;
            $this->attributes['discharge_status'] = $note->discharge_status;
            $this->attributes['discharge_type'] = $note->discharge_type;
            $this->attributes['admit_rx_medications'] = $note->admit_rx_medications;
            $this->attributes['home_medications'] = $note->home_medications;
            $this->attributes['follow_up_instruction'] = $note->follow_up_instruction;
            $this->attributes['follow_up_schedule'] = $note->follow_up_schedule;
            return true;
        } elseif ($noteType >= 3) { // From Service note.
            $note = MedicineServiceNote::where('note_id',$noteID)->first();
            $this->attributes['chief_complaint'] = $note->chief_complaint;
            $this->attributes['comorbids'] = $note->comorbids;
            $this->attributes['significant_findings'] = $note->history_present_illness . "\r\n" . $note->physical_exam;
            $this->attributes['hospital_course'] = $note->hospital_course . "\r\n" . $note->assessment_and_plan;
            $this->attributes['OR_procedure'] = $note->OR_procedure;
            $this->attributes['non_OR_procedure'] = $note->non_OR_procedure;
            return true;
        }
        else {
            return false;
        }
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
	public function setANAttribute($value) { $this->setEncryptData('AN', $value); }
	public function getANAttribute() { return $this->getEncryptData('AN'); }

	protected function setDateTimeData($field, $value) {
		$this->attributes[$field] = $value == '' ? null : Carbon::createFromFormat('d-m-Y H:i', $value);
	}
	// datetime_admit setter.
	public function setDatetimeAdmitAttribute($value) { $this->setDateTimeData('datetime_admit', $value);}
	// datetime_dc setter.
	public function setDatetimeDcAttribute($value) { $this->setDateTimeData('datetime_dc', $value);}
    
	protected function setNumericData($field, $value) {
		$this->attributes[$field] = !is_numeric($value) ? null : $value;
	}
	// getter setter ward_id.
	public function setWardIdAttribute($value) { $this->setNumericData('ward_id', $value); }
	// getter setter attending_id.
	public function setAttendingIdAttribute($value) { $this->setNumericData('attending_id', $value); }
	// getter setter main_division_id.
	public function setMainDivisionIdAttribute($value) { $this->setNumericData('main_division_id', $value); }
    
}
