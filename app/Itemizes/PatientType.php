<?php

namespace App\Itemizes;

use Illuminate\Database\Eloquent\Model;
// use DB;

class PatientType extends Model
{
    protected $table = 'patient_types';
    protected $fillable = [
    		'id',
    		'name',
    		// 'outsource_id' // removed no need to maintain outsource id.
    ];

  /**
	* Maintain patient_types item.
	* @return PatientType->id.
	*
	*/
  public static function foundOrNew($name) {
  	$patientType = PatientType::where('name', $name)->first();
  	if (isset($patientType))
  		return $patientType->id;
  	$id = PatientType::max('id') + 1;
  	$obj =  PatientType::create(['id' => $id, 'name' => $name]);
  	return $id;
  }
}
