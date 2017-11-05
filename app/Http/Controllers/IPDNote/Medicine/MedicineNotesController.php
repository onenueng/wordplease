<?php

namespace App\Http\Controllers\IPDNote\Medicine;

use Auth;
use Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\IPDNote\CreateNoteRequest;
use App\Http\Requests\RequestHelper;

// Request.


// Models.
use App\IPDNote\Note;
use App\IPDNote\Medicine\MedicineAdmissionNote;
use App\IPDNote\Medicine\MedicineDischargeNote;
use App\IPDNote\Medicine\MedicineServiceNote;
// use App\Itemizes\AttendingStaff;
// use App\Itemizes\Ward;
// use App\Itemizes\Patient;
// use App\Providers\SiITWS;

class MedicineNotesController extends Controller
{
	// Route Protection. Required authenticated user.
	public function __construct() {
		$this->middleware('auth');
	}

	/**
	* Create Note by selected type.
	* @param Request $request.
	* @return View.
	**/
	public function store(CreateNoteRequest $request) {
		/**
		* Try create note by AN+note_type_id.
		* In case unsuccess, reply user a message.
		* Also check duplicate admission and discharge note and check gender matching.
		**/
		$returnCode = Note::tryCreate($request);
		if ($returnCode === '0') { // Successfully create parent note.
			// *************************************** //
			// ****** NOW not use transfer note ****** //
			// *************************************** //
			switch ($request['note_type_id']) {
				case '7':
					$note = new MedicineAdmissionNote;
					$note->id = $request['note_id'];
					$sync = $note->save();
					$note = MedicineAdmissionNote::find($request['note_id']);
					break;
				case '8':
					$note = new MedicineAdmissionNote;
					$note->id = $request['note_id'];
					$sync = $note->save();
					$note = MedicineAdmissionNote::find($request['note_id']);
					break;
				case '9':
					$note = new MedicineAdmissionNote;
					$note->id = $request['note_id'];
					$sync = $note->save();
					$note = MedicineAdmissionNote::find($request['note_id']);
					break;
				case '10':
					$note = new MedicineAdmissionNote;
					$note->id = $request['note_id'];
					$sync = $note->save();
					$note = MedicineAdmissionNote::find($request['note_id']);
					break;
			}
			return redirect($note->note->getEditUrl());
		}
		if (strlen($returnCode) > 2) // In case of reply data for confirmation.
			return back()->with('confirm', $returnCode);
		// Cannot create note.
		return back()->with('alert', str_replace('@AN', $request['AN'], Note::getErrorMessage($returnCode)));
	}

	/**
	* Display form to edit Note.
	* @param $id.
	* @return View.
	**/
	public function edit($id) {
		$parentNote = Note::tryEdit($id); // Perform route protection.
		if (!isset($parentNote->note_type_id))
			return $parentNote;
		switch ($parentNote->note_type_id) {
            case '1':
                $note = MedicineAdmissionNote::find($id);
                break;
            case '2':
                $note = MedicineAdmissionNote::find($id);
                break;
            case '3':
                $note = MedicineAdmissionNote::find($id);
                break;
            case '4':
                $note = MedicineAdmissionNote::find($id);
                break;
            case '5':
                $note = MedicineAdmissionNote::find($id);
                break;
            case '6':
                $note = MedicineAdmissionNote::find($id);
                break;
            case '7':
				$note = MedicineAdmissionNote::find($id);
				break;
			case '8':
				$note = MedicineAdmissionNote::find($id);
				break;
			case '9':
				$note = MedicineAdmissionNote::find($id);
				break;
			case '10':
				$note = MedicineAdmissionNote::find($id);
				break;
            case '11':
                $note = MedicineAdmissionNote::find($id);
                break;
		}

        // end test gen template
        return view($note->note->type->view_path, compact('note'));
	}
    
    /*
    public function store(CreateNoteRequest $request)
    {
        // Check unique AN+note_type_id;
        switch ($request['note_type_id']) {
            case '1':
                if (Note::isNoteExists($request['AN'], $request['note_type_id']))
                    return back()->with('alert', 'มี Admission note สำหรับ AN นี้อยู่แล้ว ไม่สามารถสร้างได้อีก');
            case '2':
                if (Note::isNoteExists($request['AN'], $request['note_type_id']))
                    return back()->with('alert', 'มี Discharge summary สำหรับ AN นี้อยู่แล้ว ไม่สามารถสร้างได้อีก');
        }
        
        // If success then got $request['note_id'].
        $returnCode = Note::tryCreate($request);   
        switch ($returnCode) {
            case 'x':
                return back()->with('alert', 'ไม่สามารถเชื่อมต่อข้อมูล Admission ได้ โปรดติดต่อ IT Helpdesk (error code : 101)');
            case 'm':
                return 'not implement yet.';
            case '1':
                return back()->with('alert', 'ไม่พบข้อมูล AN ' . $request['AN'] . ' โปรดตรวจสอบว่าพิมพ์ถูกต้อง');
            case '2':
                return back()->with('alert', 'AN ' . $request['AN'] . ' ยกเลิกแล้ว โปรดตรวจสอบว่าพิมพ์ถูกต้อง');
            case '4':
                return back()->with('alert', 'เกิดข้อผิดผลาดในระบบข้อมูล Admission โปรดติดต่อ IT Helpdesk (error code : 103)');
            case '9':
                return back()->with('alert', 'ไมมีสิทธิ์ดึงข้อมูล AN ' . $request['AN'] . ' โปรดติดต่อ IT Helpdesk (error code : 102)');
            case '0':
                // *************************************** //
                // ****** NOW not use transfer note ****** //
                // *************************************** //
                if ($request['note_type_id'] == '1') { // Admission note.
                    $admitNote = MedicineAdmissionNote::create($request->all());
                    $admitNote->note_id = $request['note_id']; // note_id exclude form massive assignment.
                    // $admitNote->age = Note::ageAtNote($admitNote->note_id);
                    $admitNote->creator = session('user_id');
                    $admitNote->updater = session('user_id');
                    $admitNote->save();
                    return redirect('medicinenotes/' . $admitNote->note_id . '/edit');
                //return $admitNote;
                }
            default:
                return back()->with('alert', 'xxไม่สามารถเชื่อมต่อข้อมูล Admission ได้ โปรดติดต่อ IT Helpdesk (error code : 100)');
        }

        /*
        // ***** FOR TESTING TRANSFER NOTE ***** get lastest note before create new one.
        $lnote = Note::where('AN',$request->AN)->orderBY('id','desc')->first();

        $user = Auth::user();
        // create note and insert to table notes.
        $note = Note::create(['AN' => $request->AN, 'division_id' => $user->division_id, 'note_type_id' => $request->note_type_id, 'creator' => $user->id]);
        // $note = Note::create(['AN' => $request->AN, 'division_id' => session('division_id'), 'note_type_id' => $request->note_type_id, 'creator' => session('user_id')]);

        // proceed by note_type.
        if ($request->note_type_id == '1'){ // admission note.
    		$anote = MedicineAdmissionNote::create($note->toArray());
            $anote->note_id = $note->id;
            $anote->mockUp(); // just for testing.
            $anote->creator = $note->creator;
            $anote->updater = $note->creator;
            $anote->save();

            // ***** FOR TESTING *****
            $note->HN = $anote->HN;
            $note->save();
            
            return redirect('medicinenotes/' . $anote->note_id . '/edit');
    	} elseif ($request->note_type_id == '2'){ // discharge summary
            $dnote = MedicineDischargeNote::create($note->toArray());
            $dnote->note_id = $note->id;
            $dnote->mockUp(); // just for testing.
            $dnote->creator = $note->creator;
            $dnote->updater = $note->creator;

            // ***** FOR TESTING *****
            if (!is_null($lnote)) $dnote->transferNote($lnote->note_type_id, $lnote->id);
            
            $dnote->save();

            // ***** FOR TESTING *****
            $note->HN = $dnote->HN;
            $note->save();
            
            return redirect('medicinenotes/' . $dnote->note_id . '/edit');
        } elseif ($request->note_type_id >= '3') {
            $snote = MedicineServiceNote::create($note->toArray());
            $snote->note_id = $note->id;
            $snote->mockUp(); // just for testing.
            $snote->creator = $note->creator;
            $snote->updater = $note->creator;
            
            // ***** FOR TESTING *****
            if (!is_null($lnote)) $snote->transferNote($lnote->note_type_id, $lnote->id);
            
            $snote->save();
            
            // ***** FOR TESTING *****
            $note->HN = $snote->HN;
            $note->save();

            return redirect('medicinenotes/' . $snote->note_id . '/edit');
        }
        else
    		return 'another note';
    	
    }

    public function edit($id)
    {
        $note = Note::find($id);
        $data = []; 
        if ($note->note_type_id == 1) { // admission note
            $anote = MedicineAdmissionNote::where('note_id', $id)->first();
            $HN = $anote->HN;
            $viewName = 'medicine.notes.admission.form';
            $ward = Ward::find($anote->ward_id);
            if ($ward) $data['ward_name'] = $ward->name;
            // Attending_name.
            if (isset($anote->attending_id)) {
                $astaff = AttendingStaff::find($anote->attending_id);
                $data['attending_name'] = $astaff->name;
                $data['attending_detail'] = $astaff->getAttendingDetail();
            }

            // return view('medicine.notes.admission.form',compact('anote'));
        } elseif ($note->note_type_id == 2) { // discharge note
            $anote = MedicineDischargeNote::where('note_id', $id)->first();
            $HN = $anote->HN;
            $viewName = 'medicine.notes.discharge.form';
            $ward = \App\MockupWard::where('id',$anote->ward_id)->first();
            $data['ward_name'] = $ward->name;
            // return $anote; // for view post variables.
            //return 'edit discharge.';
        } elseif ($note->note_type_id >= 3) {
            $anote = MedicineServiceNote::where('note_id', $id)->first();
            $HN = $anote->HN;
            $viewName = 'medicine.notes.services.form';
            $ward = \App\MockupWard::where('id',$anote->ward_id)->first();
            session(['ward_name' => $ward->name]);
            $anote->note_type_name = $anote->getNoteTypeName($note->note_type_id);


            // if ($note->note_type_id == '3')
            //     $anote->note_type = 'On service';
            // elseif ($note->note_type_id == '4')
            //     $anote->note_type = 'Off service';
            // elseif ($note->note_type_id == '5')
            //     $anote->note_type = 'Transfer';
            // else
            //     return 'exception on MedicineNotesController@store ServiceNote';
        }
        else return 'this note type not implement yet.';


        

        // $this->attributes['patient_name'] = $patient->name;
        // session(['patient_name' => $anote->patient_name]);
        // $this->attributes['gender'] = $patient->gender;
        // if ($anote->gender)
        //     session(['patient_gender' => 'ชาย']);
        // else
        //     session(['patient_gender' => 'หญิง']);

        $patient = Patient::foundOrNew($HN);
        $data['patient_gender'] = $patient->getGenderText();
        $data['age'] = $patient->ageAtDate($note->created_at);
        $los_days = ' (' . \Carbon\Carbon::createFromFormat('d-m-Y H:i:s',$anote->date_admit)->diffInDays(\Carbon\Carbon::now()) . ' days)';
        // session(['patient_age' => \Carbon\Carbon::createFromFormat('d-m-Y',$patient->dob)->diffInYears(\Carbon\Carbon::now())]);
        $data['LOS'] = \Carbon\Carbon::createFromFormat('d-m-Y H:i:s',$anote->date_admit)->diffForHumans(\Carbon\Carbon::now()) . $los_days;
        // return $data;
        return view($viewName,compact('anote', 'data'));
    }*/

    /**
    * actual medthod
    *
    */
    
    public function update($id, Request $request)
    //public function update($id)
    {
        return Request::all(); // for view post variables.
        


        $note = Note::find($id);
        if ($note->note_type_id == 1) { // admission note.
            $this_note = MedicineAdmissionNote::where('note_id', $id)->first();
        } elseif ($note->note_type_id == 2) { // discharge note.
            $this_note = MedicineDischargeNote::where('note_id', $id)->first();
        } elseif ($note->note_type_id >= 3) { // off service note.
            $this_note = MedicineServiceNote::where('note_id', $id)->first();
        } elseif ($note->note_type_id == 4) { // on service note.
            return Request::all(); // for view post variables.
        }


        $request = Request::all();
        RequestHelper::checkboxComplement($request,$this_note);
        $this_note->updater =  session('user_id');
        $this_note->update($request);
        // $this_note->update(Request::all());
        
        
        // return  redirect('medicinenotes/' . $id . '/edit')->with('status','Data saved!');
        return  redirect()->back()->with('status','Data saved!');
    }
    
}
