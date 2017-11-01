<?php

namespace App\Itemizes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Ward extends Model
{
	protected $fillable = [
		'id',
		'name',
		'name_short',
		'active',
		// 'outsource_id'
	];

	/**
	* Maintain title item.
	* @return Ward->id.
	*
	*/
	public static function foundOrNew($name, $nameShort) {
		$ward = Ward::where('name', $name)->first();
		if (isset($ward))
			return $ward->id;
		$id = Ward::max('id') + 1;
		Ward::create(['id' => $id, 'name' => $name, 'name_short' => $nameShort, 'active' => 1]);
		return $id;
	}
    // public static function findOrCreate($fieldName, $value) {
    //     $ward = Ward::where($fieldName, $value)->first();
    //     if (is_null($ward)) {
    //         $ward = new Ward;
    //     }
    //     return $ward;
    // }

	public static function loadcsv() {
		/*
		use Illuminate\Support\Facades\DB;
		Change csv file here
		*/
		$filename = storage_path().'/csv/wards.csv';
		if(!file_exists($filename) || !is_readable($filename))
			return FALSE;
		else {
			$header = NULL;
			$data = array();
			if (($handle = fopen($filename, 'r')) !== FALSE){
				/*
				change table here
				*/
				DB::table('wards')->delete();
				while (($row = fgetcsv($handle, 300, ',')) !== FALSE){ //300 = max lenght of longest line
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
			// if($item['id'] != 'id'){
			Ward::create($item);
			// }
		}
		return true;
	}
}
