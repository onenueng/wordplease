<?php

namespace App\Interfaces;

interface PatientAPIInterface {
    public function getPatient($hn, $mode);

    public function getAdmission($an);
}

