<?php

namespace App\IPDNote\Medicine;

use Illuminate\Database\Eloquent\Model;
use App\MockupWard;
use App\MockupPatient;
use App\IPDNote\Note;
use App\IPDNote\Medicine\MedicineAdmissionNote;
use App\IPDNote\Medicine\MedicineServiceNote;

class MedicineDischargeNote extends Model
{
    //
    // protected $table = 'medicine_discharge_note';
    protected $fillable =[
    	'HN',
		'patient_name',
		'gender',
		'age',
		'AN',
		'date_admit',
        'ward_id',

        
        'attending_id',
        'resident_id',
        'date_dc',
        'main_division_id',
        'co_division_id',
        'principle_diagnosis',
        'reason_admit',
        'comorbids',
        'complications',
        'external_causes',
        'other_diagnosis',
        'OR_procedure',
        'non_OR_procedure',
        'chief_complaint',
        'significant_findings',
        'significant_procedured',
        'hospital_course',
        'condition_upon_DC',
        'discharge_status',
        'discharge_type',
        'admit_rx_medications',
        'home_medications',
        'follow_up_instruction',
        'follow_up_schedule',
        
        // 'general_appearance',
        // 'skin_exam_detail',
        // 'head_exam_detail',
        // 'eyeENT_exam_detail',
        // 'neck_exam_detail',
        // 'heart_exam_detail',
        // 'lung_exam_detail',
        // 'abdomen_exam_detail',

        // 'creator',
        // 'updater',
    ];

    public function mockUp()
    {
        $note = Note::where('AN',$this->attributes['AN'])->where('note_type_id','1')->first();
        if (is_null($note)) {
	        // patient
	        $patient = MockupPatient::find(rand(1,22698));
	        $this->attributes['HN'] = $patient->HN;

	        $this->attributes['patient_name'] = $patient->name;
	        $this->attributes['gender'] = $patient->gender;
	        
	        if ($patient->gender)
	            session(['patient_gender' => 'ชาย']);
	        else
	            session(['patient_gender' => 'หญิง']);
	        
	        $this->attributes['age'] = \Carbon\Carbon::createFromFormat('Y-m-d',$patient->dob)->diffInYears(\Carbon\Carbon::now());
	        
	        // ward
	        $ward = MockupWard::find(rand(1,141));
	        session(['ward_name' => $ward->name]);
	        $ward = MockupWard::where('name',session('ward_name'))->first();
	        $this->attributes['date_admit'] = \Carbon\Carbon::now()->format('Y-m-d');
	        $this->attributes['ward_id'] = $ward->id;
	    } else {
	    	$anote = MedicineAdmissionNote::where('note_id',$note->id)->first();
	    	$this->attributes['HN'] = $anote->HN;
	    	$this->attributes['patient_name'] = $anote->patient_name;

	    	$patient = MockupPatient::where('HN', $anote->HN)->first();
	    	$this->attributes['age'] = \Carbon\Carbon::createFromFormat('Y-m-d',$patient->dob)->diffInYears(\Carbon\Carbon::now());
	        
	        $this->attributes['gender'] = $anote->gender;
	        if ($anote->gender)
	            session(['patient_gender' => 'ชาย']);
	        else
	            session(['patient_gender' => 'หญิง']);

	        $this->attributes['date_admit'] = \Carbon\Carbon::createFromFormat('d-m-Y',$anote->date_admit);
	        $this->attributes['ward_id'] = $anote->ward_id;
	        $ward = MockupWard::find($anote->ward_id);
	        session(['ward_name' => $ward->name]);
	    }
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

    //date_admit
    public function setDateAdmitAttribute($value)
    {
        if ($value == '')
            $this->attributes['date_admit'] = null;
        else
            $this->attributes['date_admit'] = \Carbon\Carbon::createFromFormat('d-m-Y', $value)->toDateString();
    }
    public function getDateAdmitAttribute()
    {
        if (is_null($this->attributes['date_admit']))
            return null;
        else
            return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes['date_admit'])->format('d-m-Y H:i:s');
    }

    //age
    public function setAgeAttribute($value)
    {
        if (!is_numeric($value))
        	$this->attributes['age'] = null;
        else
        	$this->attributes['age'] = $value;
    }

    //date_dc
    public function setDateDcAttribute($value)
    {
        if ($value == '')
            $this->attributes['date_dc'] = null;
        else
            $this->attributes['date_dc'] = \Carbon\Carbon::createFromFormat('d-m-Y', $value)->toDateString();
    }
    public function getDateDcAttribute()
    {
        if (is_null($this->attributes['date_dc']))
            return null;
        else
            return \Carbon\Carbon::createFromFormat('Y-m-d', $this->attributes['date_dc'])->format('d-m-Y');
    }


    // getter setter ward_id.
    public function setWardIdAttribute($value)
    {
        if (!is_numeric($value))
            $this->attributes['ward_id'] = null;
        else
            $this->attributes['ward_id'] = $value;
    }

    // getter setter attending_id.
    public function setAttendingIdAttribute($value)
    {
        if (!is_numeric($value))
            $this->attributes['attending_id'] = null;
        else
            $this->attributes['attending_id'] = $value;
    }

    // getter setter resident_id.
    public function setResidentIdAttribute($value)
    {
        if (!is_numeric($value))
            $this->attributes['resident_id'] = null;
        else
            $this->attributes['resident_id'] = $value;
    }

    // getter setter main_division_id.
    public function setMainDivisionIdAttribute($value)
    {
        if (!is_numeric($value))
            $this->attributes['main_division_id'] = null;
        else
            $this->attributes['main_division_id'] = $value;
    }

    // getter setter co_division_id.
    public function setCoDivisionIdAttribute($value)
    {
        if (!is_numeric($value))
            $this->attributes['co_division_id'] = null;
        else
            $this->attributes['co_division_id'] = $value;
    }

    // // getter setter age.
    // public function setAgeAttribute($value)
    // {
    //     if (!is_numeric($value))
    //         $this->attributes['age'] = null;
    //     else
    //         $this->attributes['age'] = $value;
    // }
}
