<?php

namespace App\Tests;

use App\Providers\MedicalRecordServices;
use App\IPDNote\Note;
use App\Itemizes\Patient;
use App\CheckUser;
use Carbon\Carbon;
// use App\Itemizes\Ward;
// use App\Itemizes\AttendingStaff;
class TestWS {
	
	public static function testAN($anStart, $offSet) {
		// $anStart = 52000000;// 57124818; 57124819
		// $ans =[];
		// $patients = [];
		$start = Carbon::now();
		for($i = 0 ; $i <= $offSet ; $i ++) {
			$tmp = [];
			$an = MedicalRecordServices::getAdmission($anStart + $i);
			if ($an['return_code'] == '0') {
				MedicalRecordServices::fillRequest($tmp, $an, 1);
				echo ($anStart + $i) . " Found : " . $tmp['date_admit'] . ' => ' . $tmp['date_dc'];
			} else {
				echo ($anStart + $i) . " Not Found.";
			}
		}
		echo "Time to complete(min) => " . $start->diffInMinutes(Carbon::now());
		return true;
	}

	public static function testHN($hnStart, $offSet) {
		// $hnStart = 41123327;// 53056198;
		$start = Carbon::now();
		for($i = 0 ; $i <= $offSet ; $i ++) {
			// $hn = MedicalRecordServices::getPatient($hnStart + $i,($i % 2 == 0) ? 1 : 2 );
			// MedicalRecordServices::updatePatient($hn['hn']);
			if (MedicalRecordServices::updatePatient($hnStart + $i))
				echo ($hnStart + $i) . " OK";
			else
				echo ($hnStart + $i) . " Not Found";
		}
		echo "Time to complete(min) => " . $start->diffInMinutes(Carbon::now());
		return true;
	}

	public static function testTryNote($anStart, $offSet) {
		$start = Carbon::now();
		for($i = 0 ; $i <= $offSet; $i++) {
			$request['AN'] = $anStart + $i;
			$request['note_type_id'] = 1; // faculty discharge summary.
			$request['action'] = '';
			echo ($anStart + $i) . ' => ' . Note::tryCreate($request);
		}
		echo "Time to complete(min) => " . $start->diffInMinutes(Carbon::now());
		return true;
	}

	public static function showPt() {
		$start = Carbon::now();
		$notes = Note::all();
		foreach($notes as $note){
			$patient = Patient::find($note->patient_id);
			echo  $note->id . ' : ' . $note->HN . ' => ' . $patient->getName() . ' @ ' . $patient->created_at;
		}
		echo "Time to complete(min) => " . $start->diffInMinutes(Carbon::now());
		return TRUE;
	}

	public static function testCheckUser($idStart, $offSet) {
		$start = Carbon::now();
		for($i = 0; $i < $offSet; $i++) {
			$ws = MedicalRecordServices::checkUser($idStart + $i, 'siriraj');
			$user = new CheckUser;
			$user->return_code = (empty($ws["return_code"]) || is_array($ws["return_code"])) ? null : $ws["return_code"];
			$user->pid = (empty($ws["pid"]) || is_array($ws["pid"])) ? null : $ws["pid"];
			$user->userid = (empty($ws["userid"]) || is_array($ws["userid"])) ? null : $ws["userid"];
			$user->username = (empty($ws["username"]) || is_array($ws["username"])) ? null : $ws["username"];
			$user->remark = (empty($ws["remark"]) || is_array($ws["remark"])) ? null : $ws["remark"];
			$user->job_key = (empty($ws["job_key"]) || is_array($ws["job_key"])) ? null : $ws["job_key"];
			$user->job_key_desc = (empty($ws["job_key_desc"]) || is_array($ws["job_key_desc"])) ? null : $ws["job_key_desc"];
			$user->org_unit_m = (empty($ws["org_unit_m"]) || is_array($ws["org_unit_m"])) ? null : $ws["org_unit_m"];
			$user->org_unit_m_desc = (empty($ws["org_unit_m_desc"]) || is_array($ws["org_unit_m_desc"])) ? null : $ws["org_unit_m_desc"];
			$user->connect_email = (empty($ws["connect_email"]) || is_array($ws["connect_email"])) ? null : $ws["connect_email"];
			$user->Name_EN = (empty($ws["Name_EN"]) || is_array($ws["Name_EN"])) ? null : $ws["Name_EN"];
			$user->tel_no = (empty($ws["tel_no"]) || is_array($ws["tel_no"])) ? null : $ws["tel_no"];
			$user->useable_status = (empty($ws["useable_status"]) || is_array($ws["useable_status"])) ? null : $ws["useable_status"];
			$sync = $user->save();
			if ($sync)
				echo "SAPID " . ($idStart + $i) . " saved.";
			else
				echo "SAPID " . ($idStart + $i) . " note save.";
		}
		echo "Time to complete(min) => " . $start->diffInMinutes(Carbon::now());
		return 0;
	}

	public static function logNote($no) {
		$start = 1;
		$addBy = 999;
		$multiply = 1000;
		for($i = 0; $i <= $no; $i++) {
			$id = ($start + $i * $multiply);
			$note = Note::find($id);
			$noteNext = Note::find($id + $addBy);
			$diff = $note->created_at->diffInSeconds($noteNext->created_at);
			$sync = \App\LogNote::create(['seconds' => $diff]);
			echo $id . " - " . ($id + $addBy) . ' => ' . $diff ;
		}
	}

	public static function testCat() {
		$ans = [
			// 57000001 => 57040775, //57000010, //
			// // 57040775 => 57225300, //57000010, //
			57000001 => 57225300, //57225300, //57000010, //
			56000001 => 56083790, //56000010, //
			55000001 => 55084500, //55000010, //
			54000001 => 54075000, //54000010, //
			53000001 => 53080000, //53000010, //
			52000001 => 52080000, //52000010, //
			51000001 => 51080000, //51000010, //
			50000001 => 50075000, //50000010, //
			49000001 => 49070000, //49000010, //
			48000001 => 48080000, //48000010, //
			47000001 => 47080000, //47000010, //
		];

		$allTimeStart = Carbon::now();
		foreach ($ans as $start => $stop) {
			$timeStart = Carbon::now();
			$count = 0;
			for($i = $start; $i <= $stop ; $i++) {
				$request['AN'] = $i;
				$request['note_type_id'] = 1; // faculty discharge summary.
				$request['action'] = '';
				// echo $i . " => " . Note::tryCreate($request);
				// echo "AN $i processing";
				// $sync = Note::tryCreate($request);
				$return_code = Note::tryCreate($request);
				$count++;
				if ($return_code === '0') {
					if (($count % 10000 == 0))
						echo ($count / 10000) . '. 10K AN Passed.';
				} else {
					echo $i . " => " . $return_code;
				}
			}
			echo "@$start to @$stop by @$i Time to complete(min) => " . $timeStart->diffInMinutes(Carbon::now());
		}
		echo "Time to complete(min) => " . $allTimeStart->diffInMinutes(Carbon::now()) . ' Note count = ' . $count;
		return TRUE;
	}

	public static function mockUpNotePatient($no) {
		$idStart = 40000000;
		for($i = 1; $i <= $no; $i++) {
			$p = Patient::create(['HN' => ($idStart + $i)]);
			$n = Note::create(['AN' => ($idStart + $i), 'note_type_id' => 1, 'patient_id' => $p->id]);
		}
		return TRUE;
	}
}