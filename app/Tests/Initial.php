<?php
namespace App\Tests;
use App\User;
use App\IPDNote\Note;
use App\Itemizes\Patient;
use App\IPDNote\Faculty\FacultyDischargeNote;
use App\IPDNote\Medicine\MedicineServiceNote;
use App\IPDNote\Medicine\MedicineAdmissionNote;
use App\IPDNote\Medicine\MedicineDischargeNote;
use App\IPDNote\Ophthalmology\OphthalmologyGeneralNote;
use Carbon\Carbon;

class Initial {
	
	public static function initData()
	{
		// create users
		$user = User::create([
				'sap_id' => 'simed',
				'password' => bcrypt('111111'),
				'name' => 'พ.ญ. ทดสอบ อายุรศาสตร์',
				'division_id' => 200,
				'role_id' => 3,
				'licence_no' => 22222,
				'email' => 'simed@siriraj.ac.th',
		]);
		$user->active = 1;
		$user->save();

		// General admission note
		Initial::createNotes(57963408, 9, new MedicineAdmissionNote);

		// General Discharge Summary note
		Initial::createNotes(54251638, 1, new MedicineAdmissionNote);

		// medicine admission note
		Initial::createNotes(56487882, 7, new MedicineAdmissionNote);

		// medicine admission note
		Initial::createNotes(56154986, 8, new MedicineAdmissionNote);

		// The Heart admission note
		Initial::createNotes(58796324, 10, new MedicineAdmissionNote);

		// The Heart In hospital adverse note
		Initial::createNotes(59745925, 11, new MedicineAdmissionNote);

		// $user = User::create([
		// 		'sap_id' => 'siobgyn',
		// 		'password' => bcrypt('111111'),
		// 		'name' => 'พ.ญ. ทดสอบ สูตินรีเวช',
		// 		'division_id' => 400,
		// 		'role_id' => 3,
		// 		'licence_no' => 44444,
		// 		'email' => 'siobgyn@siriraj.ac.th',
		// ]);
		// $user->active = 1;
		// $user->save();

		// Labour and Delivery Summary
		Initial::createNotes(52789462, 2, new MedicineAdmissionNote);

		// Newborn Summary
		Initial::createNotes(54159622, 3, new MedicineAdmissionNote);

		// Undelivery Summary
		Initial::createNotes(58900124, 4, new MedicineAdmissionNote);

		// Pregnancy with Abortive Outcome Summary
		Initial::createNotes(58102310, 5, new MedicineAdmissionNote);

		// $user = User::create([
		// 		'sap_id' => 'siophthal',
		// 		'password' => bcrypt('111111'),
		// 		'name' => 'พ.ญ. ทดสอบ จักษุวิทยา',
		// 		'division_id' => 300,
		// 		'role_id' => 3,
		// 		'licence_no' => 33333,
		// 		'email' => 'siophthal@siriraj.ac.th',
		// ]);
		// $user->active = 1;
		// $user->save();

		// ophthalmology Discharge Summary note
		Initial::createNotes(57426585, 6, new MedicineAdmissionNote);

		return true;
	}

	public static function createNotes($AN, $noteTypeId, $subNote, $userId = 1)
	{
		$api = new \App\APIs\FakePatientData();
		$admit = $api->getAdmission($AN);
		$patientData = $api->getAdmission($admit['hn']);
		
		$patient = new Patient;
		$patient->HN = $admit['hn'];
		$patient->first_name = $patientData['first_name'];
		$patient->last_name = $patientData['last_name'];
		$patient->dob = Carbon::createFromFormat('Y-m-d' ,$patientData['dob'])->format('d-m-Y');
		$patient->gender = FALSE;
		$patient->title_id = 2;

		$patient->save();

		$note = new Note;
		$note->AN = $AN;
		$note->patient_id = $patient->id;
		$note->note_type_id = $noteTypeId;
		$note->division_id = 100;
		$note->creator_id = $userId;
		$note->save();
		// $subNote = new MedicineAdmissionNote;
		$subNote->id = $note->id;
		$subNote->save();
	}

	public static function initUsers() {
		$user = User::create([
				'sap_id' => 'simed',
				'password' => bcrypt('111111'),
				'name' => 'พ.ญ. ทดสอบ อายุรศาสตร์',
				'division_id' => 200,
				'role_id' => 3,
				'licence_no' => 22222,
				'email' => 'simed@siriraj.ac.th',
		]);
		$user->active = 1;
		$user->save();
		
		$user = User::create([
				'sap_id' => 'sifaculty',
				'password' => bcrypt('111111'),
				'name' => 'พ.ญ. ทดสอบ ศิริราช',
				'division_id' => 100,
				'role_id' => 3,
				'licence_no' => 11111,
				'email' => 'sifaculty@siriraj.ac.th',
		]);
		$user->active = 1;
		$user->save();

		$user = User::create([
				'sap_id' => 'siophthal',
				'password' => bcrypt('111111'),
				'name' => 'พ.ญ. ทดสอบ จักษุวิทยา',
				'division_id' => 300,
				'role_id' => 3,
				'licence_no' => 33333,
				'email' => 'siophthal@siriraj.ac.th',
		]);
		$user->active = 1;
		$user->save();

		$user = User::create([
				'sap_id' => 'siophthal1',
				'password' => bcrypt('111111'),
				'name' => 'พ.ญ. ทดสอบ จักษุวิทยา1',
				'division_id' => 300,
				'role_id' => 3,
				'licence_no' => 333331,
				'email' => 'siophthal1@siriraj.ac.th',
		]);
		$user->active = 1;
		$user->save();

		$user = User::create([
				'sap_id' => 'siophthal2',
				'password' => bcrypt('111111'),
				'name' => 'พ.ญ. ทดสอบ จักษุวิทยา2',
				'division_id' => 300,
				'role_id' => 3,
				'licence_no' => 333332,
				'email' => 'siophthal2@siriraj.ac.th',
		]);
		$user->active = 1;
		$user->save();

		$user = User::create([
				'sap_id' => 'siophthal3',
				'password' => bcrypt('111111'),
				'name' => 'พ.ญ. ทดสอบ จักษุวิทยา3',
				'division_id' => 300,
				'role_id' => 3,
				'licence_no' => 333333,
				'email' => 'siophthal3@siriraj.ac.th',
		]);
		$user->active = 1;
		$user->save();

		$user = User::create([
				'sap_id' => 'siobgyn',
				'password' => bcrypt('111111'),
				'name' => 'พ.ญ. ทดสอบ สูตินรีเวช',
				'division_id' => 400,
				'role_id' => 3,
				'licence_no' => 44444,
				'email' => 'siobgyn@siriraj.ac.th',
		]);
		$user->active = 1;
		$user->save();

		$user = User::create([
				'sap_id' => 'siobgyn1',
				'password' => bcrypt('111111'),
				'name' => 'พ.ญ. ทดสอบ สูตินรีเวช1',
				'division_id' => 400,
				'role_id' => 3,
				'licence_no' => 444441,
				'email' => 'siobgyn1@siriraj.ac.th',
		]);
		$user->active = 1;
		$user->save();

		$user = User::create([
				'sap_id' => 'siobgyn2',
				'password' => bcrypt('111111'),
				'name' => 'พ.ญ. ทดสอบ สูตินรีเวช2',
				'division_id' => 400,
				'role_id' => 3,
				'licence_no' => 444442,
				'email' => 'siobgyn2@siriraj.ac.th',
		]);
		$user->active = 1;
		$user->save();

		$user = User::create([
				'sap_id' => 'siobgyn3',
				'password' => bcrypt('111111'),
				'name' => 'พ.ญ. ทดสอบ สูตินรีเวช3',
				'division_id' => 400,
				'role_id' => 3,
				'licence_no' => 444443,
				'email' => 'siobgyn3@siriraj.ac.th',
		]);
		$user->active = 1;
		$user->save();

		return true;
	}

	public static function createNote($request) {
		$AN = '70' .  str_pad(rand(1,999999), 6, '0', STR_PAD_LEFT);
		$patient = new Patient;
		$patient->HN = '60' .  str_pad(rand(1,999999), 6, '0', STR_PAD_LEFT);
		$patient->first_name = 'Ugene' . rand(1,999);
		$patient->last_name = 'Doe' . rand(1,999);
		$patient->dob =  '11-09-' . (1900 + rand(40, 99));
		$patient->gender = FALSE;
		$patient->title_id = 2;
		// $sync = $patient->save();
		$patient->save();
		$note = new Note;
		$note->AN = $AN;
		$note->patient_id = $patient->id;
		$note->note_type_id = $request['note_type_id'];
		$note->division_id = $request['division_id'];
		$note->creator_id = $request['creator'];
		// $sync = $note->save();
		$note->save();
		
		switch ($request['note_type_id']) {
			case 1: // faculty.
				$fnote = new FacultyDischargeNote;
				// $fnote = FacultyDischargeNote::create([
				// 		'AN' => $AN,
				// 		'patient_id' => $patient->id,
				// 		'ward_id' => 1,
				// 		'attending_id' => 1,
				// 		'datetime_admit' => Carbon::now()->format('d-m-Y H:i'),
				// ]);
				$fnote->id = $note->id;
				// $fnote->creator = $request['creator'];
				// $fnote->updater = $request['creator'];
				return $fnote->save();
			case 7: // medicine admission note
				$anote = new MedicineAdmissionNote;
				$anote->id = $note->id;
				return $anote->save();
			default: // Ophthalmology
				return false;
		}
	}

	public static function testCat($start, $offset) {
		for($i = (int)$start; $i <= ((int)$start + (int)$offset); $i++) {
			echo \App\ModelHelper::getCat((string)$i) . " - ";
		}
	}

	public static function reCat() {
		$patients = Patient::all();
		foreach($patients as $patient) {
			$HN = $patient->HN;
			$patient->HN = $HN;
			$patient->save();
		}

		$notes = Note::all();
		foreach($notes as $note) {
			$AN = $note->AN;
			$note->AN = $AN;
			$note->save();
		}

		return true;
	}

	public static function initDemo() {
		Initial::initUsers();
		Initial::createNote(['note_type_id' => 7, 'division_id' => 200, 'creator' => 1]);
		Initial::createNote(['note_type_id' => 7, 'division_id' => 200, 'creator' => 1]);

		Initial::createNote(['note_type_id' => 1, 'division_id' => 100, 'creator' => 2]);
		Initial::createNote(['note_type_id' => 1, 'division_id' => 100, 'creator' => 2]);
	}
}
