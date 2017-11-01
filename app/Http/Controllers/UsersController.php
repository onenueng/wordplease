<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use Request;
use App\Http\Controllers\Controller;
// use App\Itemizes\Division;
// use App\IPDNote\Note;

class UsersController extends Controller
{
	// Required authenticated user.
	public function __construct()
    {
        $this->middleware('auth');
    }

	/**
    *
    *   @return init user data on session and return dashboard page match user role and division.
    */
	public function dashboard()
	{
		$user = Auth::user(); // get autenticated user data.

		// return Division::getNameByID($user->division_id,'sn');
		// Set user data session.
		session(['user_name' => $user->name]);
		session(['user_id' => $user->id]);
		session(['user_division_id' => $user->division_id]);
		session(['department_id' => $user->division_id - ($user->division_id % 100)]);
		session(['user_division_name' => Division::getNameByID($user->division_id,'sn')]); // sn => short_name.
		session(['user_role_name' => $user->getRoleName()]);

		$department = Division::find(session('department_id')); // get department of this user.
		switch ($user->role_id) {
			case 1 : // Staff.
			case 2 : // Fellow.
			case 3 : // Resident.
				$notes = Note::where('creator', $user->id)->orderBy('created_at')->get();
				// $notes = DB::table('notes')
	   //  				->join('mockup_patients', 'notes.HN', '=', 'mockup_patients.HN')
	   //  				->select('notes.id','notes.AN','notes.HN', 'notes.note_type_id','mockup_patients.name as patient_name')
	   //  				->where('notes.creator',$user->id)
	   //  				->orderBy('notes.created_at')
	   //  				->get();
	    		break;
		}
		return view(strtolower($department->name_eng_short) . '.nav.dashboard',compact('notes')); // return dashboard with notes data.
	}
}
