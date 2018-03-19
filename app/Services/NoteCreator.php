<?php

namespace App\Services;

use App\Models\Notes\Note;
use App\Models\Lists\Ward;
use App\Models\Lists\Patient;
use App\Models\Lists\NoteType;
use App\Models\Lists\Admission;
use App\Models\Lists\Insurance;
use App\Models\Lists\AttendingStaff;

class NoteCreator
{
    /**
     * Try create note from request.
     *
     * @var $an, $noteTypeId, $noteContentId
     * @return stirng
     */
    public static function tryCreate(Array $admission, Array $patient, $noteTypeId, $class, $retitle, $userId)
    {
        // Check note will violate creation rules or not
        $result = NoteType::find($noteTypeId)->creatable($admission['an'], $patient['gender'], $class);
        if ( $result != '' ) {
            return $result;
        }

        // maintain patients table
        $patientOnDB = Patient::findbyHn($patient['hn']);
        if ( $patientOnDB == null ) {
            $patientOnDB = Patient::insert($patient);
        } else {
            $patientOnDB->update($patient);
        }

        // prepare admission data
        $admission['patient_id'] = $patientOnDB->id;
        $admission['datetime_admit'] = ($admission['datetime_admit'])
                                        ? $admission['datetime_admit'] . '.000'
                                        : $admission['datetime_admit'];
        $admission['datetime_discharge'] = ($admission['datetime_discharge'])
                                            ? $admission['datetime_discharge'] . '.000'
                                            : $admission['datetime_discharge'];

        // maintain admissions table
        $admission['insurance_id'] = !($patient['insurance_name'])
            ? 0
            : Insurance::foundOrNew(['name' => $patient['insurance_name']], 'name');
        $admissionOnDB = Admission::findbyAn($admission['an']);
        if ($admissionOnDB == null) {
            $admissionOnDB = Admission::insert($admission);
        } else {
            $admissionOnDB->update($admission);
        }

        // note maintain list => ward, attending
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
