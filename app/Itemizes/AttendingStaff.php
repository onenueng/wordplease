<?php

namespace App\Itemizes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AttendingStaff extends Model
{
	protected $table = 'attending_staffs';
	protected $fillable = [
		'id',
		'name',
		'division_id',
		'licence_no',
		'active'
	];

	/**
	* Maintain title item.
	* @return AttendingStaff->id.
	*
	*/
	public static function foundOrNew($licenceNo, $name) {
		$staff = AttendingStaff::where('licence_no', $licenceNo)->first();
		if (isset($staff))
			return $staff->id;
		$id = AttendingStaff::max('id') + 1;
		AttendingStaff::create(['id' => $id, 'licence_no' => $licenceNo, 'name' => $name, 'active' => 1]);
		return $id;
	}

	public function getDetail() {   
		$division = \App\Itemizes\Division::find($this->attributes['division_id']);
		if ($division)
			return $this->name . ' @ ' . $division->name_eng_short . ' ว.' . $this->licence_no ;
		return $this->name . ' ว.' . $this->licence_no ;
	}

	public static function getIDByLicenceNo($licenceNo) {
		if ($licenceNo == '0' || empty($licenceNo))
			return null;
		
		$staff = AttendingStaff::where('licence_no', $licenceNo)->first();
		return $staff->id;
	} 

// public static function getMaxID() {
// return DB::table('attending_staffs')->max('id');
// }

	public static function loadcsv() {
		/*
		use Illuminate\Support\Facades\DB;
		Change csv file here
		*/
		$filename = storage_path().'/csv/attending_staffs.csv';
		if(!file_exists($filename) || !is_readable($filename))
			return FALSE;
		else {
			$header = NULL;
			$data = array();
			if (($handle = fopen($filename, 'r')) !== FALSE){
				/*
				change table here
				*/
				DB::table('attending_staffs')->delete();
				while (($row = fgetcsv($handle, 500, ',')) !== FALSE){ //300 = max lenght of longest line
				if(!$header)
					$header = $row;
				else
					$data[] = array_combine($header, $row);
				}
			}
			fclose($handle);
		}
		/*
		Change table model here
		*/
		foreach ($data as $item) {
			$item['active'] = 1;
			AttendingStaff::create($item);
		}
		return true;
  }

    // public function getName() { $this->attributes['name']; }
    // {
    //     $title = \App\Itemizes\Title::find($this->attributes['title_id']);
    //     // $division = \App\Itemizes\Division::find($this->attributes['division_id']);
    //     return $title->name . ' ' . $this->attributes['name'];
    // }


}
