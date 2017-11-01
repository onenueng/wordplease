<?php

namespace App\Http\Controllers\IPDNote\Ophthalmology;

use Auth;
use Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\IPDNote\CreateNoteRequest;
use App\Http\Requests\RequestHelper;

// model
use App\IPDNote\Note;
use App\IPDNote\Ophthalmology\OphthalmologyDischargeNote;


class OphthalmologyNotesController extends Controller
{
	// Route Protection. Required authenticated user.
	public function __construct() {
		$this->middleware('auth');
	}

	/**
	* As of Sep 2016 Siriraj Ophthalmology department has only discharge summary so, no need to verify note type.
	* @param Request $request.
	* @return View.
	**/
	public function store(CreateNoteRequest $request) {
		/**
		* Try create note by AN+note_type_id.
		* In case unsuccess, reply user a message.
		* Also check duplicate admission and discharge note.
		* If success then $request is modifiled with coresponding note_id.
		**/
		$returnCode = Note::tryCreate($request);
		if ($returnCode === '0') {
			// *************************************** //
			// ****** NOW not use transfer note ****** //
			// *************************************** //
			$note = new OphthalmologyDischargeNote;
			$note->id = $request['note_id'];
			$sync = $note->save();
			$note = OphthalmologyDischargeNote::find($request['note_id']);
			return redirect($note->note->getEditUrl());
		}
		if (strlen($returnCode) > 2)
			return back()->with('confirm', $returnCode);
		return back()->with('alert', str_replace('@AN', $request['AN'], Note::getErrorMessage($returnCode)));
	}

	/**
	* As of Sep 2016 Siriraj Ophthalmology department has only discharge summary so, no need to verify note type.
	* Display form to edit Note.
	* @param $id.
	* @return View.
	**/
	public function edit($id) {
		$parentNote = Note::tryEdit($id); // Perform route protection.
		if (!isset($parentNote->note_type_id))
			return $parentNote;
		$note = OphthalmologyDischargeNote::find($id);
		return view($note->note->type->view_path, compact('note'));
	}

	/**
	* As of Sep 2016 Siriraj Ophthalmology department has only discharge summary so, no need to verify note type.
	* @param $id.
	* @return notes index.
	**/
	public function update($id) {
		$note = OphthalmologyDischargeNote::find($id);
		$request = Request::all();
		RequestHelper::radioCheckInputComplement($request, $note);
		RequestHelper::setNullToEmptyTextInput($request, $note);
		$note->update($request);
		$note->note->update($request);
		$note->note->updater_id = Auth::user()->id;
		$note->note->save();
		$note->note->updateOutListData();
		return  redirect()->back()->with('status','Data saved!');
	}

	public function index() { return redirect(url('/notes')); }

    // public function store(CreateNoteRequest $request)
    // {
    //     // return Request::all();

    //     // create note and insert to table notes.
    //     $user = Auth::user();
    //     $note = Note::create(['AN' => $request->AN, 'division_id' => $user->division_id, 'note_type_id' => $request->note_type_id, 'creator' => $user->id]);

        
    //     $this_note = FacultyGeneralNote::create($note->toArray()); // Use same table as Faculty.
    //     $this_note->note_id = $note->id;
    //     $this_note->mockUp(); // just for testing.
    //     $this_note->creator = $note->creator;
    //     $this_note->updater = $note->creator;

    //     // ***** FOR TESTING *****
    //     // if (!is_null($lnote)) $this_note->transferNote($lnote->note_type_id, $lnote->id);
        
    //     $this_note->save();

    //     // ***** FOR TESTING *****
    //     $note->HN = $this_note->HN;
    //     $note->save();
        
    //     return redirect('ophthalmologynotes/' . $this_note->note_id . '/edit');
        
    // }

    // // public function edit($id)
    // // {
    // //     $note = Note::find($id);
    // //     $data = [];



    // //     $anote = FacultyGeneralNote::where('note_id', $id)->first();
    // //     // return $anote;
    // //     $HN = $anote->HN;
    // //     // $viewName = 'medicine.notes.admission.form';
    // //     // return $anote;
    // //     $ward = Ward::find($anote->ward_id);
    // //     // return $ward;
    // //     if ($ward) $data['ward_name'] = $ward->name;
    // //     // return $data;

    // //     // Attending_name.
    // //     if (isset($anote->attending_id)) {
    // //         $astaff = AttendingStaff::find($anote->attending_id);
    // //         $data['attending_name'] = $astaff->name;
    // //         $data['attending_detail'] = $astaff->getAttendingDetail();
    // //     }
    // //     // return $data;
    // //     $patient = Patient::foundOrNew($HN);
    // //     $data['patient_gender'] = $patient->getGenderText();
    // //     $data['age'] = $patient->ageAtDate($note->created_at);
    // //     // return $data;
    // //     $los_days = ' (' . Carbon::createFromFormat('d-m-Y H:i:s',$anote->date_admit)->diffInDays(Carbon::now()) . ' days)';
    // //     // session(['patient_age' => \Carbon\Carbon::createFromFormat('d-m-Y',$patient->dob)->diffInYears(\Carbon\Carbon::now())]);
    // //     $data['LOS'] = Carbon::createFromFormat('d-m-Y H:i:s',$anote->date_admit)->diffForHumans(Carbon::now()) . $los_days;
        
    // //     return view('ophthalmology.notes.general.form',compact('anote', 'data'));

    // //     // $anote = FacultyGeneralNote::where('note_id', $id)->first();
    // //     // $ward = \App\MockupWard::where('id',$anote->ward_id)->first();
    // //     // session(['ward_name' => $ward->name]);
    // //     // if (!is_null($anote->attending_id)) {
    // //     //     $astaff = AttendingStaff::find($anote->attending_id);
    // //     //     session(['attending_name' => $astaff->getAttendingName(), 'attending_detail' => $astaff->getAttendingDetail()]);
    // //     // }
    // //     // $patient = \App\MockupPatient::where('HN',$anote->HN)->first();

    // //     // // $this->attributes['patient_name'] = $patient->name;
    // //     // session(['patient_name' => $patient->name]);
    // //     // // $this->attributes['gender'] = $patient->gender;
    // //     // if ($patient->gender)
    // //     //     session(['patient_gender' => 'ชาย']);
    // //     // else
    // //     //     session(['patient_gender' => 'หญิง']);

        
    // //     // $los_days = ' (' . \Carbon\Carbon::createFromFormat('d-m-Y',$anote->date_admit)->diffInDays(\Carbon\Carbon::now()) . ' days)';
    // //     // //return $los_days;
    // //     // session(['patient_age' => \Carbon\Carbon::createFromFormat('Y-m-d',$patient->dob)->diffInYears(\Carbon\Carbon::now())]);
    // //     // session(['LOS' => \Carbon\Carbon::createFromFormat('d-m-Y',$anote->date_admit)->diffForHumans(\Carbon\Carbon::now()) . $los_days]);
        
    // //     // //$user = Auth::user();
    // //     // $anote->note_type_name = $anote->getNoteTypeName($note->note_type_id);

    // //     // return view('ophthalmology.notes.general.form',compact('anote'));

    // // }

    // /**
    // * actual medthod
    // *
    // */
    // public function update($id, Request $request)
    // //public function update($id)
    // {
    //     // return Request::all(); // for view post variables.
        
    //     $note = Note::find($id);
    //     $this_note = FacultyGeneralNote::where('note_id', $id)->first();

    //     $this_note->updater =  session('user_id');
    //     $this_note->update(Request::all());
        
        
    //     return  redirect()->back()->with('status','Data saved!');
    // }
		public function createDrawing($noteID, $view) {
			switch ($view) {
				case 'operations':
					return view('drawings.ophthalmology.operations')->with('noteID', $noteID);
				case 'exam':
					return view('drawings.ophthalmology.exam')->with('noteID', $noteID);
				default:
					return redirect()->back();
				break;
			}
		}
}
