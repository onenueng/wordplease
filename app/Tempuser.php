<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tempuser extends Model
{
	/**
	* The database table used by the model.
	*
	* @var string
	*/
	protected $table = 'tempusers';

	/**
	* The attributes that are mass assignable.
	*
	* @var array
	*/
	protected $fillable = [
		'dob',
		'email', 
		'licence_no',
		'division_id',
		'role_id'
	];

	public static function loadcsv() {
		/*
		use Illuminate\Support\Facades\DB;
		Change csv file here
		*/
		$filename = storage_path().'/csv/tempusers.csv';
		if(!file_exists($filename) || !is_readable($filename))
			return FALSE;
		else {
			$header = NULL;
			$data = array();
			if (($handle = fopen($filename, 'r')) !== FALSE){
				/*
				change table here
				*/
				DB::table('tempusers')->delete();
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
			Tempuser::create($item);
		// }
		}
		return true;
	}
}
