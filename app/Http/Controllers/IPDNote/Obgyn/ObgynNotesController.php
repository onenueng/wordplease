<?php

namespace App\Http\Controllers\IPDNote\Obgyn;

use Auth;
use Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\IPDNote\CreateNoteRequest;
use App\Http\Requests\RequestHelper;

// model.
use App\IPDNote\Note;
use App\IPDNote\Obgyn\ObgynLabourNote;
use App\IPDNote\Obgyn\ObgynDeliveryNote;
use App\IPDNote\Obgyn\ObgynNewbornNote;
use App\IPDNote\Obgyn\ObgynUndeliveryNote;
use App\IPDNote\Obgyn\ObgynAbortionNote;

// Request.
use App\Http\Requests\IPDNote\Obgyn\EditObgynNoteRequest;

class ObgynNotesController extends Controller
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
				case '3':
					$note = new ObgynNewbornNote;
					$note->id = $request['note_id'];
					$sync = $note->save();
					$note = ObgynNewbornNote::find($request['note_id']);
					break;
				case '2':
					$note = new ObgynDeliveryNote;
					$note->id = $request['note_id'];
					$sync = $note->save();
					$note = ObgynDeliveryNote::find($request['note_id']);
					break;
				case '4':
					$note = new ObgynUndeliveryNote;
					$note->id = $request['note_id'];
					$sync = $note->save();
					$note = ObgynUndeliveryNote::find($request['note_id']);
					break;
				case '5':
					$note = new ObgynAbortionNote;
					$note->id = $request['note_id'];
					$sync = $note->save();
					$note = ObgynAbortionNote::find($request['note_id']);
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
			case '3':
				$note = ObgynNewbornNote::find($id);
				break;
			case '2':
				$note = ObgynDeliveryNote::find($id);
				break;
			case '4':
				$note = ObgynUndeliveryNote::find($id);
				break;
			case '5':
				$note = ObgynAbortionNote::find($id);
				break;
		}
		return view($note->note->type->view_path, compact('note'));
	}

	public function update($id, EditObgynNoteRequest $request) {
		$parentNote = Note::tryEdit($id); // Perform route protection.
		if (!isset($parentNote->note_type_id))
			return $parentNote;
		switch ($parentNote->note_type_id) {
			case '3':
				$note = ObgynNewbornNote::find($id);
				break;
			case '2':
				$note = ObgynDeliveryNote::find($id);
				break;
			case '4':
				$note = ObgynUndeliveryNote::find($id);
				break;
			case '5':
				$note = ObgynAbortionNote::find($id);
				break;
		}
		// $request = Request::all();
		// RequestHelper::radioCheckInputComplement($request, $note);
		// RequestHelper::setNullToEmptyTextInput($request, $note);
		// RequestHelper::setNullToEmptyNumericInput($request, $note);
		$data = $request->all();
		RequestHelper::checkAllInputs($data, $note);

		$note->update($data);
		$note->note->update($data);
		$note->note->updater_id = Auth::user()->id;
		$note->note->save();
		$note->note->updateOutListData();
		// return $request;
		return  redirect()->back()->with('status','Data saved!');
	}

	public function index() { return redirect(url('/notes')); }
}
