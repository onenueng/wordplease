<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class An extends Model
{
    protected $fillable = [
    	'return_code',
     'request_computer_name',
     'hn',
     'an',
     'patient_name',
     'admission_date',
     'admission_time',
     'ward_number',
     'ward_name',
     'ward_brief_name',
     'refer_doctor_code',
     'doctor_name',
     'patient_dept',
     'patient_dept_name',
     'patient_sub_dept',
     'patient_sub_dept_name',
     'discharge_date',
     'discharge_time',
     'discharge_type',
     'discharge_type_name',
     'discharge_status',
     'discharge_status_name',

    ];
}
