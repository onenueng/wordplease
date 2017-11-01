<?php

namespace App\Itemizes;

use Illuminate\Database\Eloquent\Model;
// use DB;

class RaceNation extends Model
{
  protected $table = 'race_nation';
  protected $fillable = [
		'id',
		'name',
		// 'outsource_id' removed no need to maintain outsource id.
  ];
  // public static function getMaxID(){
  // 	return DB::table('race_nation')->max('id');
  // }

  /**
  * Maintain title item.
  * @return RaceNation->id.
  *
  */
  public static function foundOrNew($name) {
    $raceNation = RaceNation::where('name', $name)->first();
    if (isset($raceNation))
       return $raceNation->id;
    $id = RaceNation::max('id') + 1;
    $obj =  RaceNation::create(['id' => $id, 'name' => $name]);
    return $id;
  }
}
