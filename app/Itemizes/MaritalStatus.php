<?php

namespace App\Itemizes;

use Illuminate\Database\Eloquent\Model;
// use DB;

class MaritalStatus extends Model
{
  protected $table = 'marital_status';
  protected $fillable = [
		'id',
		'name',
		// 'outsource_id' removed no need to maintain outsource id.
  ];

  // public static function getMaxID() {
  //     return DB::table('marital_status')->max('id');
  // }

  /**
  * Maintain title item.
  * @return MaritalStatus->id.
  *
  */
  public static function foundOrNew($name) {
    $maritalStatus = MaritalStatus::where('name', $name)->first();
    if (isset($maritalStatus))
      return $maritalStatus->id;
    $id = MaritalStatus::max('id') + 1;
    $obj =  MaritalStatus::create(['id' => $id, 'name' => $name]);
    return $id;
  }
}
