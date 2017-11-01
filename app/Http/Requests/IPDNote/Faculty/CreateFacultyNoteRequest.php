<?php

namespace App\Http\Requests\IPDNote\Faculty;

use App\Http\Requests\Request;

class CreateFacultyNoteRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'AN' => 'unique:notes,AN,NULL,id,note_type_id,2',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'AN.unique' => 'มี Discharge summary สำหรับ AN นี้อยู่แล้ว ไม่สามารถสร้างได้อีก',
        ];
    }
}

