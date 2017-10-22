<?php

namespace App\Contracts;

interface PatientDataAPI
{
    /**
     * Query patient data form api by $hn.
     *
     * @param string
     * @return array
     */
    public function getPatient($hn);

    /**
     * Query admission data form api by $an.
     *
     * @param string
     * @return array
     */
    public function getAdmission($an);
}
