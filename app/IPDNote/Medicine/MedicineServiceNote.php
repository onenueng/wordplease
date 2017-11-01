<?php

namespace App\IPDNote\Medicine;

use Illuminate\Database\Eloquent\Model;

use App\MockupWard;
use App\MockupPatient;
use App\IPDNote\Note;
use App\IPDNote\Medicine\MedicineAdmissionNote;

class MedicineServiceNote extends Model
{
    //
    // protected $table = 'medicine_service_note';
    protected $fillable =[
    	'HN',
    	'AN',
    	'patient_name',
    	'gender',
    	'age',
    	'date_admit',
    	'ward_id',
    	'resident_id',
		'chief_complaint',
		'comorbids',
		'history_present_illness',
		'physical_exam',
		'hospital_course',
		'OR_procedure',
		'non_OR_procedure',
		'assessment_and_plan',
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
            $this->attributes['comorbids'] = $note->comorbidToString();
            $this->attributes['history_present_illness'] = $note->getSignificantFinding();
            $this->attributes['assessment_and_plan'] = $note->getHospitalCourse();
            return true;
        } elseif ($noteType == 2) { // From DC note.
            $note = MedicineDischargeNote::where('note_id',$noteID)->first();
            $this->attributes['chief_complaint'] = $note->chief_complaint;
            $this->attributes['comorbids'] = $note->comorbids;
            $this->attributes['history_present_illness'] = $note->significant_findings;
            $this->attributes['physical_exam'] = $note->significant_findings;
            $this->attributes['hospital_course'] = $note->hospital_course;
            $this->attributes['OR_procedure'] = $note->OR_procedure;
            $this->attributes['non_OR_procedure'] = $note->non_OR_procedure;
            $this->attributes['assessment_and_plan'] = $note->hospital_course;
            return true;
        } elseif ($noteType >= 3) {
            $note = MedicineServiceNote::where('note_id',$noteID)->first();
            $this->attributes['chief_complaint'] = $note->chief_complaint;
            $this->attributes['comorbids'] = $note->comorbids;
            $this->attributes['history_present_illness'] = $note->history_present_illness;
            $this->attributes['physical_exam'] = $note->physical_exam;
            $this->attributes['hospital_course'] = $note->hospital_course;
            $this->attributes['OR_procedure'] = $note->OR_procedure;
            $this->attributes['non_OR_procedure'] = $note->non_OR_procedure;
            $this->attributes['assessment_and_plan'] = $note->assessment_and_plan;
            return true;
        }
        else {
            return false;
        }
    }

    public function getNoteTypeName($noteTypeID)
    {
        if ($noteTypeID == '3')
            return 'On service';
        elseif ($noteTypeID == '4')
            return 'Off service';
        elseif ($noteTypeID == '5')
            return 'Transfer';
        else
            return 'exception on MedicineNotesController@store ServiceNote';
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
            return \Carbon\Carbon::createFromFormat('Y-m-d', $this->attributes['date_admit'])->format('d-m-Y');
    }

    // getter setter ward_id.
    public function setWardIdAttribute($value)
    {
        if (!is_numeric($value))
            $this->attributes['ward_id'] = null;
        else
            $this->attributes['ward_id'] = $value;
    }

    // getter setter resident_id.
    public function setResidentIdAttribute($value)
    {
        if (!is_numeric($value))
            $this->attributes['resident_id'] = null;
        else
            $this->attributes['resident_id'] = $value;
    }
}
