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

class NoteManager
{
    public static function getCreatableNotes($an, $userId)
    {
        $admission = static::getPatientData($an, 'an');
        $creatableNotes = [];
        foreach (\App\User::find($userId)->canCreateNotes as $note) {
            $creatableNotes[] = $note->getCreateDescription($an, $admission['gender'], $userId);
            foreach ($note->canRetitledTo() as $retitle) {
                $creatableNotes[] = $note->getCreateDescription($an, $admission['gender'], $userId, $retitle);
            }
        }
        return $creatableNotes;
    }

    public static function getPatientData($key, $mode)
    {
        $cacheLifeTime = 100; // minutes
        $cacheKey = ( $mode == 'an' ? 'an@' : 'hn@' ) . $key;

        if ( !Cache::has($cacheKey) ) {
            if ( $mode == 'an' ) {
                $response = resolve('App\Contracts\PatientDataAPI')->getAdmission($key);
            } else {
                $response = resolve('App\Contracts\PatientDataAPI')->getPatient($key);
            }

            if ( !$response['reply_code'] ) { // cache only data available
                Cache::put($cacheKey, $response, $cacheLifeTime);
            }

            return $response;
        }

        return Cache::get($cacheKey);
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
        $patientOnDB = Patient::findByCryptedKey($patient['hn'], 'hn');
        if ( $patientOnDB ) {
            $patientOnDB->tryUpdate($patient);
        } else {
            $patientOnDB = Patient::insert($patient);
        }

        // prepare admission data
        $admission['patient_id'] = $patientOnDB->id;
        $admission['insurance_id'] = !($patient['insurance_name'])
                                       ? 0
                                       : Insurance::foundOrNew(['name' => $patient['insurance_name']], 'name');
        $admissionOnDB = Admission::findByCryptedKey($admission['an'], 'an');
        if ( $admissionOnDB ) {
            $admissionOnDB->tryUpdate($admission);
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

        $note->division_id = $note->noteType->division->id; // init division
        $note->save();

        $noteDetail = new $note->noteType->class_path;
        $noteDetail->id = $note->id;
        $noteDetail->save();

        return $note;
    }

    // public static function getCachedNote(&$id, $mode = 'cache')
    // {
    //     $cacheLifeTime = 100; // minutes

    //     $key = 'note@' . $id;

    //     if ( ($mode == 'cache') && Cache::has($key) ) {
    //         return Cache::get($key);
    //     }

    //     $note = Note::find($id);
    //     $note->load(['ward', 'attending', 'noteType', 'division','admission.patient', 'detail']);
    //     Cache::put($key, $note, $cacheLifeTime);
    //     return $note;
    // }

    public static function autosave(Note &$note, $field, $value)
    {
        switch ($field) {
            case 'ward':
            case 'division':
            case 'attending':
                return ['saved' => $note->autosave($field, $value)];
            default:
                return ['saved' => $note->detail->autosave($field, $value)];
        }
    }
}
