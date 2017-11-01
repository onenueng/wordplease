<?php

namespace App\Itemizes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Division extends Model
{
	protected $table = 'division';
	protected $fillable = [
		'id',
		'name',
		'name_eng',
		'name_eng_short',
		'outsource_id'
	];

    /**
    *
    *   @return department name match id.
    */
    // public static function getDepartment($value){
    //     $value = $value - ($value % 100);
    //     $division = Division::find($value);
    //     return $division->name_eng_short;
    // }

	/**
	*
	*   @return division name match id and mode.
	*/
	public function getNameByID($mode = 'sn') {
		switch ($mode) {
			case 'th':
				return $this->name;
			case 'en':
				return $this->name_eng;
			case 'sn':
				return $this->name_eng_short;
		}
	}

	public static function loadcsv() {
		/*
		use Illuminate\Support\Facades\DB;
		Change csv file here
		*/
		$filename = storage_path().'/csv/division.csv';
		if(!file_exists($filename) || !is_readable($filename))
			return FALSE;
		else {
			$header = NULL;
			$data = array();
			if (($handle = fopen($filename, 'r')) !== FALSE){
			/*
			change table here
			*/
				DB::table('division')->delete();
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
			Division::create($item);
			// }
		}
		return true;
	}
}
