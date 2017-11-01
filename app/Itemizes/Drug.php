<?php

namespace App\Itemizes;

use Illuminate\Database\Eloquent\Model;
use DB;
class Drug extends Model
{
	protected $table = 'drugs';
	protected $fillable = [
		'id',
		'name',
		'generic_name',
		'trade_name',
		'synonym',
		'key',
	];

	public static function genSearchKey() {
		$drugs = Drug::all();
		foreach ($drugs as $drug) {
			$drug->key = $drug->name . " | " . $drug->generic_name . " | " . $drug->trade_name . " | " . $drug->synonym;
			$drug->save();
		}
		return true;
	}


	public static function loadcsv() {
		/*
		use Illuminate\Support\Facades\DB;
		Change csv file here
		*/
		$filename = storage_path().'/csv/drugs.csv';
		if(!file_exists($filename) || !is_readable($filename))
			return FALSE;
		else {
			$header = NULL;
			$data = array();
			if (($handle = fopen($filename, 'r')) !== FALSE){
				/*
				change table here
				*/
				DB::table('drugs')->delete();
				while (($row = fgetcsv($handle, 2500, ",")) !== FALSE){ //1000 = max lenght of longest line
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
			$drug = Drug::create($item);
			// $drug->key = $drug->name . " | " . $drug->generic_name . " | " . $drug->trade_name . " | " . $drug->synonym;
			// $drug->save();
		}
		return true;
	}
}
