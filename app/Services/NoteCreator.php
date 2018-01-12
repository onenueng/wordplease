<?php

namespace App\Services;

use App\Models\Notes\Note;

class NoteCreator
{
    /**
     * Patient data api instance.
     *
     * @var array
     */
    private $api;
    
    /**
     * Resolve Patient data api app bootstrap
     * then assign to $api
     */
    public function __construct()
    {
        $this->api = resolve('App\Contracts\PatientDataAPI');
    }

    /**
     * Get Id type of the model.
     *
     * @return stirng
     */
    private function isAdmitAlreadyRecorded()
    {
        
    }

    /**
     * Try create note from request.
     *
     * @var $an, $noteTypeId, $noteContentId
     * @return stirng
     */
    public function tryCreate($an, $noteTypeId, $noteContentId)
    {
        // check if we can continue with given $an
        $admission = $this->api->getAdmission($an);
        if ( $admission['reply_text'] != 'OK' ) {
            return $admission;
        }

        // check if we can continue with given note type
        if ( $this->willComplyUniqueRule() )

        if ( $this->willComplyGenderRule() )

        // check if this an data exist
        

        $admission = $this->api->getAdmission($an);
        $patient =  $this->api->getPatient($admission['hn']);

        
        return $patient;

        $admission['note_type_id'] = $noteTypeId;
        $admission['note_content_id'] = $noteContentId;

        $note = Note::insert($admission);

        return $note;
    }

    protected function willComplyUniqueRule($an, $noteTypeId)
    {
        if ( $noteTypeId > 2 ) {
            return true;
        }

        
    }
}
