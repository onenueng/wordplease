<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MockupWard extends Model
{
    protected $fillable = [
    	'id',
    	'name',
    	'name_short'
    ];

    public static function loadcsv()
    {
        /*
        use Illuminate\Support\Facades\DB;
        Change csv file here
        */
        $filename = public_path().'/assets/csv/wards.csv';
        if(!file_exists($filename) || !is_readable($filename))
            return FALSE;
        else {
            $header = NULL;
            $data = array();
            if (($handle = fopen($filename, 'r')) !== FALSE){
                /*
                change table here
                */
                DB::table('mockup_wards')->delete();
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
                MockupWard::create($item);
             // }
        }
        return true;
    }
}
