<?php

namespace App\Http\Controllers\IPDNote;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use App\Itemizes\Division;
use App\IPDNote\Note;
class NotesController extends Controller
{
	// Required authenticated user.
	public function __construct() { $this->middleware('auth'); }

	public function index() {
		// use Auth::user() as this user.
		switch (Auth::user()->role_id) {
			case 1 : // Staff.
			case 2 : // Fellow.
			case 3 : // Resident.
				// Get notes created by this user.
				$notes = Auth::user()->notes;
				break;
		}
	return view(Auth::user()->getNavView(), compact('notes'));
	}
}
