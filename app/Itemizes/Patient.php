<?php

namespace App\Itemizes;

use Illuminate\Database\Eloquent\Model;
use App\Providers\MedicalRecordServices;
use Carbon\Carbon;
use App\Itemizes\Title;
use App\ModelHelper;

class Patient extends Model {
  protected $fillable = [
		'patient_type_id',
		'national_id',
		'HN',
		'title_id',
		'first_name',
		'middle_name',
		'last_name',
    	'dob',
		'gender',
		'race_id',
		'nation_id',
		'marital_status_id',
		'spouse',
		'address',
		'postcode_id',
		'tel_no',
		'mobile_no',
		'person_to_notify',
		'person_to_notify_address',
		'person_to_notify_tel_no',
		'person_to_notify_relative_type_id',
  ];

  /**
	* Date mutator.
	* Assign fields for parse to Carbon date object.
	* @return Carbon\Carbon obj.
	**/
  protected $dates = ['dob'];

	/**
	* Find patient by HN if not found return new Patient with HN.
	* @param string $HN.
	* @return App\Itemizes\Patient obj.
	**/
  public static function foundOrNew($HN) {
		// $patients = Patient::all();
		// $patients = Patient::where('cat_code', 'like', substr(ModelHelper::getCat($HN, 'HN'), 0, 4) . '%')->get();
		$patients = Patient::where('cat_code', ModelHelper::getCat($HN, 'HN'))->get();
		// echo "Patient count = " . count($patients);
		foreach ($patients as $patient)
			if ($patient->HN == $HN) return $patient;
		return Patient::create(['HN' => $HN]);
  }

  /**
	* Get Patient age by the parameter.
	* @param Date $date.
	* @return integer or NULL.
	**/
	public function ageAtDate($date) {
	if (isset($this->dob))
		return $this->dob->diffInYears($date);
	return NULL;
	}

	/**
	* Get Patient gender in text. Also provide mode th for Thai, otherwise english.
	* @param String mode.
	* @return String.
	**/
	public function getGenderText($mode = 'th') {
	if (!$this->gender)
		return $mode == 'th' ? 'หญิง' : 'female';
	return  $mode == 'th' ? 'ชาย' : 'male';
	}

	/**
	* Get Patient full name with title.
	* @param none.
	* @return integer or NULL.
	**/
	public function getName() {
		$title = Title::find($this->title_id);
		if (isset($title))
			return str_replace('  ', ' ', $title->name . ' ' . $this->first_name . ' ' . $this->middle_name . ' ' . $this->last_name);
		return str_replace('  ', ' ', $this->first_name . ' ' . $this->middle_name . ' ' . $this->last_name);
	}

	public function getData($data = 'name') {
		$patient = Patient::find($this->patient_id);
		// if ($data == 'name') return $patient->getName();
		// if ($data == 'HN') return $patient->HN;
		// if ($data == 'gender') return $patient->getGenderText();
		// if ($data == 'age note') return $patient->ageAtDate($this->created_at);
		// if ($data == 'age') return $patient->ageAtDate(Carbon::now()->copy());
		// if ($data == 'gender_code') return $patient->gender;
	}

	// /**
	// * Encypt data before save to database.
	// * @param string $field, strin $value.
	// * @return void
	// **/
	// protected function setEncryptData($field, $value) {
	// 	$this->attributes[$field] = ($value == '') ? NUll : \Crypt::encrypt($value);
	// }

	// /**
	// * Decypt data before output by model.
	// * @param string $field.
	// * @return void
	// **/
	// protected function getEncryptData($field) {
	// 	return is_null($this->attributes[$field]) ? NULL : \Crypt::decrypt($this->attributes[$field]);
	// }

	// *
	// * check and format date data before save to model.
	// * @param string $field, field name. string $value.
	// * @return void.
	
	// private function setDateValue($field, $value) {
	// 	$this->attributes[$field] = $value == '' ? null : \Carbon\Carbon::createFromFormat('d-m-Y', $value)->toDateString();
	// }

	// /**
	// * Format date data meet application needs.
	// * @param string $field, field name.
	// * @return void.
	// */
	// private function getDateValue($field) {
	// 	return is_null($this->attributes[$field]) ? null : \Carbon\Carbon::createFromFormat('Y-m-d', $this->attributes[$field])->format('d-m-Y');
	// }

	public function setANAttribute($value) {
		$this->attributes['AN'] = ModelHelper::encryptData($value);
		$this->attributes['cat_code'] = ModelHelper::getCat($value, 'HN');
	}
	public function getANAttribute() { return ModelHelper::decryptData($this->attributes['AN']); }
	public function setDatetimeAdmitAttribute($value) {
		$this->attributes['datetime_admit'] = ModelHelper::parseDateTimeData($value);
	}
	public function setDatetimeDcAttribute($value) {
		$this->attributes['datetime_dc'] = ModelHelper::parseDateTimeData($value);
	}

	public function setNationalIdAttribute($value) {
		$this->attributes['national_id'] = ModelHelper::encryptData($value);
	}
	public function getNationalIdAttribute() {
		return ModelHelper::decryptData($this->attributes['national_id']);
	}
	public function setHNAttribute($value) {
		$this->attributes['HN'] = ModelHelper::encryptData($value);
		$this->attributes['cat_code'] = ModelHelper::getCat($value, 'HN');
	}
	public function getHNAttribute() { 
		return ModelHelper::decryptData($this->attributes['HN']);
	}
	public function setFirstNameAttribute($value) {
		$this->attributes['first_name'] = ModelHelper::encryptData($value);
	}
	public function getFirstNameAttribute() {
		return ModelHelper::decryptData($this->attributes['first_name']);
	}
	public function setMiddleNameAttribute($value) {
		$this->attributes['middle_name'] = ModelHelper::encryptData($value);
	}
	public function getMiddleNameAttribute() {
		return ModelHelper::decryptData($this->attributes['middle_name']);
	}
	public function setLastNameAttribute($value) {
		$this->attributes['last_name'] = ModelHelper::encryptData($value);
	}
	public function getLastNameAttribute() {
		return ModelHelper::decryptData($this->attributes['last_name']);
	}
	public function setSpouseAttribute($value) {
		$this->attributes['spouse'] = ModelHelper::encryptData($value);
	}
	public function getSpouseAttribute() {
		return ModelHelper::decryptData($this->attributes['spouse']);
	}
	public function setTelNoAttribute($value) {
		$this->attributes['tel_no'] = ModelHelper::encryptData($value);
	}
	public function getTelNoAttribute() {
		return ModelHelper::decryptData($this->attributes['tel_no']);
	}
	public function setMobileNoAttribute($value) {
		$this->attributes['mobile_no'] = ModelHelper::encryptData($value);
	}
	public function getMobileNoAttribute() {
		return ModelHelper::decryptData($this->attributes['mobile_no']);
	}
	public function setPersonToNotifyAttribute($value) {
		$this->attributes['person_to_notify'] = ModelHelper::encryptData($value);
	}
	public function getPersonToNotifyAttribute() {
		return ModelHelper::decryptData($this->attributes['person_to_notify']);
	}
	public function setDobAttribute($value) {
		$this->attributes['dob'] = ModelHelper::parseDateData($value);
	}
	
}
