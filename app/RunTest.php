<?php

namespace App;

use App\Models\Lists\Admission;
use App\Models\Lists\Patient;
use App\Models\Notes\Note;
use App\Services\NoteCreator;

class RunTest
{
    public static function creatept()
    {
        Patient::insert([
            'hn' => '123555',
            'dob' => '1990-01-01',
            'tel_no' => '123',
            'gender' => 1,
            'spouse' => 'aa',
            'address' => '123 / abc',
            'last_name' => 'def',
            'first_name' => 'abc',
            'middle_name' => '',
            // 'postcode_id' => '',
            'document_id' => '12345678',
            'alternative_contact' => '',
        ]);
    }

    public static function createNote($an)
    {
        $api = resolve('App\Contracts\PatientDataAPI');
        $admission = $api->getadmission($an);
        $patient = $api->getPatient($admission['hn']);

        $result = NoteCreator::tryCreate($admission, $patient, 8, 1,'');

        return $result;
    }
}
