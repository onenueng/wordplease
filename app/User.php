<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use App\Itemizes\Division;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
  use Authenticatable, CanResetPassword;

	/**
	* The database table used by the model.
	*
	* @var string
	*/
	protected $table = 'users';

	/**
	* The attributes that are mass assignable.
	*
	* @var array
	*/
	protected $fillable = [
		'sap_id',
		'name',
		'name_en',
		'dob',
		'gender',
		'division_id',
		'role_id', // [0 => admin, 1 => staff, 2 => fellow, 3 => resident, 4 => nurse, 5 => officer, visitor => 6]
		'email', 
		'password',
		'licence_no',
	];

	/**
	* The attributes excluded from the model's JSON form.
	*
	* @var array
	*/
	protected $hidden = ['password', 'remember_token'];

	protected $dates = ['dob', 'last_notify'];

	public function division() {
		return $this->hasOne('App\Itemizes\Division', 'id', 'division_id');
	}

	public function notes() {
		return $this->hasMany('App\IPDNote\Note', 'creator_id', 'id');
	}

	public function getNavView() {
		// get department of this user mod division_id by 100.
		$department = Division::find(($this->division_id - ($this->division_id % 100)));
		// return matched department notes index page with notes data.
		return strtolower($department->name_eng_short) . '.nav.index';
	}

	/**
	* Get user role name.
	* @param none.
	* @return String.
	**/
	public function getRoleName() {
		if ($this->role_id == 0)
			return 'System Admin';
		elseif ($this->role_id == 1)
			return 'Attending Staff';
		elseif ($this->role_id == 2)
			return 'Fellow';
		elseif ($this->role_id == 3)
			return 'Resident';
		elseif ($this->role_id == 4)
			return 'Nurse';
		elseif ($this->role_id == 5)
			return 'Officer';
		elseif ($this->role_id == 6)
			return 'Visitor';
	}
}
