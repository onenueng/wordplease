<?php

namespace App\Itemizes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Department extends Model
{
    protected $table = 'departments';

    protected $fillable = ['id', 'department'];

    public static function loadcsv()
  	{
  		/*
  		use Illuminate\Support\Facades\DB;
		Change csv file here
	    */
  		$filename = public_path().'/assets/csv/departments.csv';
	    if(!file_exists($filename) || !is_readable($filename))
	    	return FALSE;
	 	else {
		    $header = NULL;
		    $data = array();
		    if (($handle = fopen($filename, 'r')) !== FALSE){
		    	/*
				change table here
		    	*/
		        DB::table('departments')->delete();
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
	    	 	Department::create($item);
	    	 }
	    }
	    return true;
  	}
}



////////////////////////////////////////////
// namespace App;
// use Illuminate\Database\Eloquent\Model;
// use Illuminate\Support\Facades\DB;

// class Province extends Model
// {
//     protected $fillable = [
//     	'id',
//     	'region',
//     	'province'
//     ];

//   	public static function loadcsv()
//   	{
//   		/*
//   		use Illuminate\Support\Facades\DB;
// 		Change csv file here
// 	    */
//   		$filename = public_path().'/assets/csv/provinces.csv';
// 	    if(!file_exists($filename) || !is_readable($filename))
// 	    	return FALSE;
// 	 	else {
// 		    $header = NULL;
// 		    $data = array();
// 		    if (($handle = fopen($filename, 'r')) !== FALSE){
// 		    	/*
// 				change table here
// 		    	*/
// 		        DB::table('provinces')->delete();
// 		        while (($row = fgetcsv($handle, 300, ',')) !== FALSE){ //300 = max lenght of longest line
// 		            if(!$header)
// 		                $header = $row;
// 		            else
// 		                $data[] = array_combine($header, $row);
// 		        }
// 	        }
// 	        fclose($handle);
// 		}
// 		/*
// 		Change table model here
// 	    */
// 	    foreach ($data as $item) {
// 	    	 if($item['id'] != 'id'){
// 	    	 	Province::create($item);
// 	    	 }
// 	    }
// 	    return true;
//   	}
// }