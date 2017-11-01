<?php

namespace App\Http\Requests\IPDNote;

use App\Http\Requests\Request;

class CreateNoteRequest extends Request
{
	/**
	* Determine if the user is authorized to make this request.
	*
	* @return bool
	*/
	public function authorize() {
		return TRUE;
	}

	/**
	* Get the validation rules that apply to the request.
	* Cannot use unique in database on encrypted fields.
	* @return array
	*/
	public function rules() {
		return ['AN' => 'required|digits:8'];
	}

	/**
	* Get the error messages for the defined validation rules.
	* Cannot use unique in database on encrypted fields.
	* @return array
	*/
	public function messages() {
		return [
			'AN.required' => 'จำเป็นต้องใส่ AN',
			'AN.digits' => 'AN ต้องเป็นเลข 8 หลัก',
		];
	}
}
