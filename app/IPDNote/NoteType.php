<?php

namespace App\IPDNote;

use Illuminate\Database\Eloquent\Model;
use DB;

class NoteType extends Model
{
	protected $fillable = [
		'id',
		'owner_id',
		'name',
		'class_id', // admission/discharge/service.
		'resource_name',
		'view_path',
		'gender', // 0 => female only/ 1 => male only/ 2 => all gender.
	];

	// public function getViewPath() {
	// 	return '';
	// }

	// public function getPostPath() {
	// 	return '';
	// }

	public static function getClassData($id, $mode = 'id') {
		$noteType = NoteType::find($id);
		if ($mode == 'id')
			return $noteType->class_id;
		switch ($id) {
			case 1:
				return 'admission';
			case 2:
				return 'discharge';
			default:
				return 'service';
		}
	}

	public static function isGenderMatch($gender, $id) {
		if (NoteType::find($id)->gender == '2')
			return TRUE;
		if (NoteType::find($id)->gender == $gender)
			return TRUE;
		return FALSE;
	}

	public static function loadcsv() {
		/*
		use Illuminate\Support\Facades\DB;
		Change csv file here
		*/
		$filename = storage_path().'/csv/note_types.csv';
		if(!file_exists($filename) || !is_readable($filename))
			return FALSE;
		else {
			$header = NULL;
			$data = array();
			if (($handle = fopen($filename, 'r')) !== FALSE){
			/*
			change table here
			*/
				DB::table('note_types')->delete();
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
			NoteType::create($item);
			// }
		}
		return true;
	}
}
