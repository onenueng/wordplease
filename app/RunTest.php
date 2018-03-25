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
        // return $admission;
        $result = NoteCreator::tryCreate($admission, $patient, 3, 1,'', 1);

        return $result;
    }

    public static function wardList()
    {
        for ( $i = 57300588; $i <= 57301234; $i++) {
            $admission = \App\Services\NoteManager::getPatientData($i, 'an');
            if ( $admission['reply_code'] == 0 ) {
                $wardId = !($admission['ward_name'])
                            ? 0
                            : \App\Models\Lists\Ward::foundOrNew(
                                [
                                    'name' => $admission['ward_name'],
                                    'name_short' => $admission['ward_name_short']
                                ],
                                'name'
                              );
                // $attendingId = !($admission['attending_pln'])
                //                  ? 0
                //                  : \App\Models\Lists\AttendingStaff::foundOrNew(
                //                         [
                //                             'name' => $admission['attending_name'],
                //                             'licence_no' => $admission['attending_pln']
                //                         ],
                //                         'licence_no'
                //                    );
                
                echo  $i . "\n";
            } else {
                echo  $i . " no data\n";
            }
            sleep(1);
        }

        return 'done';
    }
}
