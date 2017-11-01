<?php

namespace App\Http\Controllers\IPDNote\Faculty;

use Auth;
use Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\IPDNote\CreateNoteRequest;
use App\Http\Requests\RequestHelper;

// model
use App\IPDNote\Note;
use App\IPDNote\Faculty\FacultyAdmissionNote;
use App\IPDNote\Faculty\FacultyDischargeNote;

class FacultyNotesController extends Controller
{
	// Route Protection. Required authenticated user.
	public function __construct() {
		$this->middleware('auth');
	}

	/**
	* As of Sep 2016 Siriraj Faculty has only discharge summary so, no need to verify note type.
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
			$note = new FacultyDischargeNote;
			$note->id = $request['note_id'];
			$sync = $note->save();
			$note = FacultyDischargeNote::find($request['note_id']);
			return redirect($note->note->getEditUrl());
		}
		if (strlen($returnCode) > 2)
			return back()->with('confirm', $returnCode);
		return back()->with('alert', str_replace('@AN', $request['AN'], Note::getErrorMessage($returnCode)));
	}

	/**
	* As of Sep 2016 Siriraj Faculty has only discharge summary so, no need to verify note type.
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
				$note = FacultyDischargeNote::find($id);
				break;
			case '9':
				$note = FacultyDischargeNote::find($id);
				break;
		}

		// $note = FacultyDischargeNote::find($id);
		return view($note->note->type->view_path, compact('note'));
	}

  /**
	* As of Sep 2016 Siriraj Faculty has only discharge summary so, no need to verify note type.
	* @param $id.
	* @return notes index.
	**/
	public function update($id) {
		$note = FacultyDischargeNote::find($id);
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

}
