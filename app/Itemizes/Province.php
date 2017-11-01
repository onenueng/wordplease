<?php

namespace App\Itemizes;

use Illuminate\Database\Eloquent\Model;
use DB;

class Province extends Model
{
  protected $fillable = [
  	'id',
  	'region',
  	'province'
  ];

  /**
  * Maintain title item.
  * @return Province->id.
  *
  */
  public static function foundOrNew($name) {
    $province = Province::where('province', $name)->first();
    if (isset($province))
        return $province->id;
    $id = Province::max('id') + 1;
    Province::create(['id' => $id, 'province' => $name]);
    return $id;
  }

	public static function loadcsv() {
		/*
		use Illuminate\Support\Facades\DB;
		Change csv file here
		*/
		$filename = storage_path().'/csv/provinces.csv';
    if(!file_exists($filename) || !is_readable($filename))
    	return FALSE;
 		else {
	    $header = NULL;
	    $data = array();
	    if (($handle = fopen($filename, 'r')) !== FALSE){
				/*
				change table here
				*/
        DB::table('provinces')->delete();
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
			if($item['id'] != 'id'){
				Province::create($item);
			}
    }
    return true;
	}
}
