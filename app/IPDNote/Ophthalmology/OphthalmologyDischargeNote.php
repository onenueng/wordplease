<?php

namespace App\IPDNote\Ophthalmology;

use Illuminate\Database\Eloquent\Model;

class OphthalmologyDischargeNote extends Model
{
	public $timestamps = false;

	public function note() {
		return $this->hasOne('App\IPDNote\Note', 'id', 'id');
	}
}
