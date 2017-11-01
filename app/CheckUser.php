<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CheckUser extends Model
{
	protected $fillable =[
		"return_code",
		"pid",
		"userid",
		"username",
		"remark",
		"job_key",
		"job_key_desc",
		"org_unit_m",
		"org_unit_m_desc",
		"connect_email",
		"Name_EN",
		"tel_no",
		"useable_status",
	];
}
