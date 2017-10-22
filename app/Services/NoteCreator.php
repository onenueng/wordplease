<?php

namespace App\Services;

class NoteCreator
{
    private $api;
    
    public function __construct()
    {
        $this->api = resolve('App\Contracts\PatientDataAPI');
    }

    private function isAdmitAlreadyRecorded()
    {
        
    }

    public function tryCreateNote($an, $noteTypeId)
    {
        $admission = $this->api->getAdmission($an);
        $patient =  $this->api->getPatient($admission['hn']);
    }


}
