<?php

namespace App\Itemizes;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Support\Facades\DB;

class Title extends Model
{
  protected $table = 'title';
  protected $fillable = [
  	'id',
  	'name'
  ];

  /**
  * Maintain title item.
  * @return Title->id.
  *
  */
  public static function foundOrNew($name) {
    $title = Title::where('name', $name)->first();
    if (isset($title))
        return $title->id;
    $id = Title::max('id') + 1;
    $obj =  Title::create(['id' => $id, 'name' => $name]);
    return $id;
  }

  // public static function loadcsv() {
  //     /*
  //     use Illuminate\Support\Facades\DB;
  //     Change csv file here
  //     */
  //     $filename = public_path().'/assets/csv/title.csv';
  //     if(!file_exists($filename) || !is_readable($filename))
  //         return FALSE;
  //     else {
  //         $header = NULL;
  //         $data = array();
  //         if (($handle = fopen($filename, 'r')) !== FALSE){
  //             /*
  //             change table here
  //             */
  //             DB::table('title')->delete();
  //             while (($row = fgetcsv($handle, 300, ',')) !== FALSE){ //300 = max lenght of longest line
  //                 if(!$header)
  //                     $header = $row;
  //                 else
  //                     $data[] = array_combine($header, $row);
  //             }
  //         }
  //         fclose($handle);
  //     }
  //     /*
  //     Change table model here
  //     */
  //     foreach ($data as $item) {
  //          // if($item['id'] != 'id'){
  //             Title::create($item);
  //          // }
  //     }
  //     return true;
  // }
}
