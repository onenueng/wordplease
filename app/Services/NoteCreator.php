<?php

namespace App\Services;

use App\Models\Notes\Note;
use App\Models\Lists\Ward;
use App\Models\Lists\Patient;
use App\Models\Lists\NoteType;
use App\Models\Lists\Admission;
use App\Models\Lists\Insurance;
use App\Models\Lists\AttendingStaff;
use Illuminate\Support\Facades\Cache;

class NoteCreator
{
    public static function getCreatableNotes($an, $userId)
    {
        $admission = static::getPatientData($an, 'an');
        $creatableNotes = [];
        foreach ( \App\User::find($userId)->canCreateNotes as $note ) {
            $creatableNotes[] = $note->getCreateDescription($an, $admission['gender'], $userId);
            foreach ( $note->canRetitledTo() as $retitle ) {
                $creatableNotes[] = $note->getCreateDescription($an, $admission['gender'], $userId, $retitle);
            }
        }
        return $creatableNotes;
    }

    public static function getPatientData($key, $mode)
    {
        $cacheLifeTime = 100; // minutes
        $prefix = $mode == 'an' ? 'an@' : 'hn@';

        if ( !Cache::has($prefix . $key) ) {
            if ( $mode == 'an' ) {
                $response = resolve('App\Contracts\PatientDataAPI')->getAdmission($key);
            } else {
                $response = resolve('App\Contracts\PatientDataAPI')->getPatient($key);
            }

            if ( $response['reply_code'] == 0 ) { // cache only 'an' with data available
                Cache::put($prefix . $key, $response, $cacheLifeTime);
            }

            return $response;
        }

        return Cache::get($prefix . $key);
    }
    /**
     * Try create note from request.
     *
     * @var $an, $noteTypeId, $noteContentId
     * @return stirng
     */
    public static function tryCreate($an, $noteTypeId, $class, $retitle, $userId)
    {
        $admission = static::getPatientData($an, 'an');
        $patient = static::getPatientData($admission['hn'], 'hn');

        // creatable ?
        $result = NoteType::find($noteTypeId)->creatable($admission['an'], $patient['gender'], $class, $userId);
        if ( $result ) { // unable to create selected note with the 'an'
            return $result;
        }

        // maintain patients table
        $patientOnDB = Patient::findbyHn($patient['hn']);
        if ( $patientOnDB ) {
            $patientOnDB->update($patient);
        } else {
            $patientOnDB = Patient::insert($patient);
        }

        // prepare admission data
        $admission['patient_id'] = $patientOnDB->id;
        $admission['insurance_id'] = !($patient['insurance_name'])
                                       ? 0
                                       : Insurance::foundOrNew(['name' => $patient['insurance_name']], 'name');
        $admissionOnDB = Admission::findbyAn($admission['an']);
        if ( $admissionOnDB ) {
            $admissionOnDB->update($admission);
        } else {
            $admissionOnDB = Admission::insert($admission);
        }

        // prepare note data
        $wardId = !($admission['ward_name'])
                    ? 0
                    : Ward::foundOrNew(
                        [
                            'name' => $admission['ward_name'],
                            'name_short' => $admission['ward_name_short']
                        ],
                        'name'
                      );
        $attendingId = !($admission['attending_pln'])
                         ? 0
                         : AttendingStaff::foundOrNew(
                                [
                                    'name' => $admission['attending_name'],
                                    'licence_no' => $admission['attending_pln']
                                ],
                                'licence_no'
                           );

        // create note
        $note = Note::insert([
            'class' => $class,
            'ward_id' => $wardId,
            'retitle' => $retitle,
            'created_by' => $userId,
            'note_type_id' => $noteTypeId,
            'admission_id' => $admissionOnDB->id,
            'attending_staff_id' => $attendingId,
        ]);

        return $note;
    }
}
