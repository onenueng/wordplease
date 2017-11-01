<?php

namespace App\APIs;

use App\Interfaces\PatientAPIInterface;
use App\APIs\Siriraj\PatientAPI as SirirajPatientAPI;
use App\APIs\MockPatientAPI;

class PatientAPI implements PatientAPIInterface {
    
    protected $api;

    public function __construct() {
        switch (env('PATIENT_API')) {
            case 'SIRIRAJ':
                $this->api = new SirirajPatientAPI;
                break;
            default:
                $this->api = new MockPatientAPI;
                break;
        }
    }

    public function getPatient($hn, $mode = 2) {
        return $this->api->getPatient($hn, $mode);
    }

    public function getAdmission($an) {
        return $this->api->getAdmission($an);
    }
}
// use App\Itemizes\Postcode;