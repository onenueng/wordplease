<?php
/**
* ERROR CODE
* 101 => ws connection fail.
* 102 => ws function return code 9 not sufficient privileges.
* 103 => ws function return code 4 error.
*/
namespace App\IPDNote;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

use App\Providers\MedicalRecordServices;
use App\Itemizes\Patient;
use App\Itemizes\Ward;
use App\Itemizes\AttendingStaff;
use App\Itemizes\Division;
use App\IPDNote\NoteType;
use App\ModelHelper;

use App\APIs\PatientAPI;

class Note extends Model
{
	use SoftDeletes;

	protected $fillable =[
		'AN',
		'patient_id',
		'division_id',
		'division_name',
		'ward_id',
		'ward_name',
		'attending_id',
		'attending_name',
		'datetime_admit',
		'datetime_dc',
		'note_type_id',
		'creator_id',
		'md_note',
	];

	protected $dates = ['datetime_admit', 'datetime_dc', 'deleted_at'];

	protected $noteName = [
		'0' => 'Another',
		'1' => 'Admission',
		'2' => 'Discharge Summary',
		'3' => 'On service',
		'4' => 'Off service',
		'5' => 'Transfer',
		'8' => 'Labour and Delivery Summary',
		'7' => 'Newborn Summary',
		'9' => 'Undelivery Summary',
		'10' => 'Pregnancy with abortive Outcome Summary',
	];

	protected $PatientAPI;

	// Contructor on sub class need to perform parent constructor.
	public function __construct(array $attributes = array()) {
        parent::__construct($attributes);
        $this->PatientAPI = new PatientAPI;
    }

    public function getAdmission($an) {
    	$this->PatientAPi;
    }

	public function patient() {
		return $this->hasOne('App\Itemizes\Patient', 'id', 'patient_id');
	}

	public function type() {
		return $this->hasOne('App\IPDNote\NoteType', 'id', 'note_type_id');
	}

	public function division() {
		return $this->hasOne('App\Itemizes\Division', 'id', 'division_id');
	}

	public function attending() {
		return $this->hasOne('App\Itemizes\AttendingStaff', 'id', 'attending_id');
	}

	public function ward() {
		return $this->hasOne('App\Itemizes\Ward', 'id', 'ward_id');
	}

	public function getPostUrl() {
		return url('/' . $this->type->resource_name . '/' . $this->id);
	}

	public function getEditUrl() {
		return $this->getPostUrl() . '/edit';
	}

	/**
	* Note Interfaces.
	* 
	**/

	public function getWardName() {
		if (is_null($this->ward))
			return $this->ward_name;
		return $this->ward->name;
	}

	public function getAttendingData($data = 'name') {
		if (is_null($this->attending))
			return $this->attending_name;
		if ($data == 'name')
			return $this->attending->name;
		return $this->attending->getDetail();
	}

	public function getDivisionName() {
		if (is_null($this->division))
			return $this->division_name;
		return $this->division->name_eng_short;
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

	/**
	* Fill attributes those exclude $request becasue of uncheck-checkbox.
	*
	* @return string.
	*/
	public static function tryCreate(&$request) {
		// Check uniqueness for discharge summary and admission kind of note.
		$classID = NoteType::getClassData($request['note_type_id']);
		if ($classID == '2' || $classID == '1') {
			// $notes = Note::where('note_type_id', $request['note_type_id'])->where('cat_code', 'like', '%' . substr(ModelHelper::getCat($request['AN']), -4))->get();
			$notes = Note::where('cat_code', ModelHelper::getCat($request['AN']))->where('note_type_id', $request['note_type_id'])->get();
			foreach ($notes as $note)
				if ($note->AN == $request['AN'])
					return ($classID == '1') ? 'a' : 'd'; //  admit or discharge.
		}

		if (env('DATA_PROVIDER') == 0) {  // case manual input data.
			$return_code =  'm'; // m = manual.
			// Create Note.
			$note = Note::create([
				'AN' => $request['AN'],
				'note_type_id' => $request['note_type_id'],
				'creator_id' => Auth::user()->id
			]);
			$request['note_id'] = $note->id;

		} else {  // case MedicalRecordServices.
			$result = MedicalRecordServices::getAdmission($request['AN']); // call webservice.
			if ($result === FALSE) { // connection fail.
				$return_code = 'x';
			} elseif ($result['return_code'] == 0) { // consume data from MedicalRecordServices.
				if ($request['action'] == 'check') {
					// Update Patient data and save Patient ID for next call.
					$patient = MedicalRecordServices::updatePatient($result['hn']);
					if (!$patient) return 'x'; // Cannot connect WS Patient data.
					session(['patient_id' => $patient->id]);
					
					// Check if gender match note or not.
					if (!NoteType::isGenderMatch($patient->gender, $request['note_type_id'])) return 'g';

					// return AN Patient basic infomation for confirmation.
					return $result['hn'] . '|' . $result['patient_name'] . '|' . $result['an'] . '|' . MedicalRecordServices::parseDateTime($result['admission_date'],$result['admission_time']) . '|' . MedicalRecordServices::parseDateTime($result['discharge_date'],$result['discharge_time']) . '|' . $request['note_type_id'];
				}
				$return_code = '0';
				$patient = Patient::find(session('patient_id')); // id from action = 'check'.
				session()->forget('patient_id');
				// $patient = MedicalRecordServices::updatePatient($result['hn']); // for testing.
				// if (!$patient) return 'x'; // for testing.
				
				
				$note = Note::create([ // Create Note.
					'AN' => $request['AN'],
					'patient_id' => $patient->id,
					'ward_id' => (empty($result['ward_name']) || is_array($result['ward_name'])) ? null : Ward::foundOrNew(trim($result['ward_name']), trim($result['ward_brief_name'])), // also maintain ward list.
					'datetime_admit' => MedicalRecordServices::parseDateTime($result['admission_date'],$result['admission_time']),
					'datetime_dc' => MedicalRecordServices::parseDateTime($result['discharge_date'],$result['discharge_time']),
					'note_type_id' => $request['note_type_id'],
					'division_id' => Auth::user()->division_id,
					'creator_id' => Auth::user()->id
				]);

				// Maintain Attending staff list.
				if (!empty($result['refer_doctor_code']) && !is_array($result['refer_doctor_code']) && $result['refer_doctor_code'] != '0') {
					$note->attending_id = AttendingStaff::foundOrNew(trim($result['refer_doctor_code']), trim($result['doctor_name']));
					$sync = $note->save();
				}

				$request['note_id'] = $note->id; // add note_id into $request.
			} else {
				$return_code = $result['return_code'];
			}
		}
		return $return_code;
	}

	public static function tryEdit($id) {
		// need implement protect route and log breach.
		return ($id == 0) ? redirect(url('/notes')) : Note::find($id);
	}

	public static function getErrorMessage($code) {
		switch ($code) {
			case 'x': 
				return 'ไม่สามารถเชื่อมต่อข้อมูลเวชระเบียนได้ โปรดติดต่อ IT Helpdesk (error code : 101)';
			case 'm': 
				return  'not implement yet.'; // mannual data input;
			case '1': 
				return  'ไม่พบข้อมูล AN @AN โปรดตรวจสอบว่าพิมพ์ถูกต้อง';
			case '2': 
				return  'AN @AN ยกเลิกแล้ว โปรดตรวจสอบว่าพิมพ์ถูกต้อง';
			case '4': 
				return  'เกิดข้อผิดผลาดในระบบข้อมูลเวชระเบียนโปรดติดต่อ IT Helpdesk (error code : 103)';
			case '9': 
				return  'ไมมีสิทธิ์ดึงข้อมูล AN @AN โปรดติดต่อ IT Helpdesk (error code : 102)';
			case 'a': 
				return 'มี Admission note สำหรับ AN @AN นี้อยู่แล้ว ไม่สามารถสร้างได้อีก';
			case 'd': 
				return 'มี Discharge summary สำหรับ AN @AN นี้อยู่แล้ว ไม่สามารถสร้างได้อีก';
			case 'g':
				return 'AN @AN เป็นผู้ป่วยเพศชาย';
			case 'c': // trigger confirmation.
				return 'confirmation';
			default :
				return 'ไม่สามารถเชื่อมต่อข้อมูลเวชระเบียนได้ โปรดติดต่อ IT Helpdesk (error code : 100)';
		}
	}
	
	public function setANAttribute($value) {
		$this->attributes['AN'] = ModelHelper::encryptData($value);
		$this->attributes['cat_code'] = ModelHelper::getCat($value);
	}
	public function getANAttribute() { return ModelHelper::decryptData($this->attributes['AN']); }
	public function setDatetimeAdmitAttribute($value) {
		$this->attributes['datetime_admit'] = ModelHelper::parseDateTimeData($value);
	}
	public function setDatetimeDcAttribute($value) {
		$this->attributes['datetime_dc'] = ModelHelper::parseDateTimeData($value);
	}
	public function updateOutListData() {
		$item = Ward::where('name', $this->ward_name)->first();
		if (is_null($item)) $this->attributes['ward_id'] = 0;
		$item = AttendingStaff::where('name', $this->attributes['attending_name'])->first();
		if (is_null($item)) $this->attributes['attending_id'] = 0;
		$item = Division::where('name_eng_short', $this->attributes['division_name'])->first();
		if (is_null($item)) $this->attributes['division_id'] = 0;
		$this->save();
	}
}
