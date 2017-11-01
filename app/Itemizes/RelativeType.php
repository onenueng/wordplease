<?php

namespace App\Itemizes;

use Illuminate\Database\Eloquent\Model;
// use DB;

class RelativeType extends Model
{
  // protected $table = 'relative_types';
  protected $fillable = [
		'id',
		'name',
		'outsource_id',
  ];

  // public static function getMaxID() {
  //     return DB::table('relative_types')->max('id');
  // }

  /**
  * Maintain title item.
  * @return RelativeType->id.
  *
  */
  public static function foundOrNew($name) {
    $relativeType = RelativeType::where('name', $name)->first();
    if (isset($relativeType))
      return $relativeType->id;
    $id = RelativeType::max('id') + 1;
    RelativeType::create(['id' => $id, 'name' => $name]);
    return $id;
  }
}
