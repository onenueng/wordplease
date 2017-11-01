<?php

namespace App\Itemizes;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Itemizes\Province;

class Postcode extends Model
{
  protected $fillable = [
  	'id',
  	'postcode',
  	'province_id',
  	'location'
  ];

  /**
  * Maintain title item.
  * @return Postcode->id.
  *
  */
  public static function foundOrNew($zipcode, $location, $fullLocation) {
    $postcode = Postcode::where('postcode', $zipcode)->where('location', 'like', '%' . $location . '%')->first();
    if (isset($postcode))
      return $postcode->id;
    $id = Postcode::max('id') + 1;
    $tmp = explode(' ',$fullLocation);
    
    if (count($tmp) == 3){
    	// $province_id = Province::foundOrNew($tmp[2]);
    	Postcode::create(['id' => $id, 'postcode' => $zipcode, 'location' => $fullLocation, 'province_id' => Province::foundOrNew($tmp[2])]);
    } else {
    	Postcode::create(['id' => $id, 'postcode' => $zipcode, 'location' => $fullLocation]);
    }

    return $id;
  }

  public static function loadcsv() {
		/*
		use Illuminate\Support\Facades\DB;
		Change csv file here
		*/
		$filename = storage_path().'/csv/postcodes.csv';
    if(!file_exists($filename) || !is_readable($filename))
    	return FALSE;
 		else {
	    $header = NULL;
	    $data = array();
	    if (($handle = fopen($filename, 'r')) !== FALSE){
				/*
				change table here
				*/
        DB::table('postcodes')->delete();
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
				Postcode::create($item);
			}
    }
    return true;
	}
}
