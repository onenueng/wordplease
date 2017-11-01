<?php

namespace App\Http\Requests\IPDNote\Medicine;

use App\Http\Requests\Request;

// use Illuminate\Http\Request;

class CreateMedicineNoteRequest extends Request
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
        // if ($this->note_type_id == '1')
        //     return [
        //         'AN' => 'unique:medicine_admission_note',
        //     ];
        // elseif ($this->note_type_id == '2')
        //     return [
        //         'AN' => 'unique:medicine_discharge_note',
        //     ];
        // else
        //     return [
                
        //     ];

        // return [
        //     'AN' => 'unique:notes,AN,NULL,id,note_type_id,1',
        //     'AN' => 'unique:notes,AN,NULL,id,note_type_id,2',
        // ];

        $rules = [];
        if ($this->note_type_id == '1') // Admission note.
            $rules['AN'] = 'required|min:8|max:8|unique:notes,AN,NULL,id,note_type_id,1';
        elseif ($this->note_type_id == '2') // Discharge summary.
            $rules['AN'] = 'required|min:8|max:8|unique:notes,AN,NULL,id,note_type_id,2';

        return $rules;
    }
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        
        // if ($this->note_type_id == '1')
        //     return [
        //         'AN.unique' => 'มี Admission note สำหรับ AN นี้อยู่แล้ว ไม่สามารถสร้างได้อีก',
        //     ];
        // elseif ($this->note_type_id == '2')
        //     return [
        //         'AN.unique' => 'มี Discharge summary สำหรับ AN นี้อยู่แล้ว ไม่สามารถสร้างได้อีก',
        //     ];
        // else
        //     return [
                
        //     ];

        $messages = [
            'AN.required' => 'จำเป็นต้องใส่ AN',
            'AN.min' => 'AN ต้องเป็นเลข 8 หลัก',
            'AN.max' => 'AN ต้องเป็นเลข 8 หลัก',
        ];
        if ($this->note_type_id == '1') // Admission note.
            $messages['AN.unique'] = 'มี Admission note สำหรับ AN นี้อยู่แล้ว ไม่สามารถสร้างได้อีก';
        elseif ($this->note_type_id == '2') // Discharge summary.
            $messages['AN.unique'] = 'มี Discharge summary สำหรับ AN นี้อยู่แล้ว ไม่สามารถสร้างได้อีก';

        return $messages;
    }
}
