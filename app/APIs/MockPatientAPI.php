<?php

namespace App\APIs;

use App\Interfaces\PatientAPIInterface;

class MockPatientAPI implements PatientAPIInterface {

    public function getPatient($hn, $mode = 2) {

        return $mode == 2 ? [
            "resultCode" => "0",
            "resultText" => "success.",
            "hn" => $hn,
            "name" => "คุณ " . (("a" . $hn)[strlen($hn)] % 2 == 0 ? "สมชาย" : "สมหญิง") . substr($hn, 0, 4) . " คนดี" . substr($hn, 4),
            "title" => "คุณ",
            "first_name" => (("a" . $hn)[strlen($hn)] % 2 == 0 ? "สมชาย" : "สมหญิง") . substr($hn, 0, 4),
            "middle_name" => "",
            "last_name" => "คนดี" . substr($hn, 4),
            'document_id' => '*999' . $hn,
            'dob' => '1970-01-01',
            'gender' => ("a" . $hn)[strlen($hn)] % 2 == 0 ? 0 : 1,
            "race" => "ไทย",
            "nation" => "ไทย",
            'marrital_status' => ("a" . $hn)[strlen($hn) - 1] % 2 == 0 ? "สมรส" : "โสด",
            "spouse" => "",
            "address" => "111/234",
            "postcode" => "85",
            "location" => "10700 ศิริราช บางกอกน้อย",
            "province" => "กรุงเทพมหานคร",
            'tel_no' => '081' . $hn,
            "alternative_contact" => "บิดา ประยุทธ์ 0924799881",
            "insurance_id" => "200",
            "insurance_name" => "บัตรทองปลอม",
        ] : [
            "resultCode" => "0",
            "resultText" => "success.",
            "hn" => $hn,
            "marital_status_id" => ("a" . $hn)[strlen($hn) - 1] % 2 == 0 ? 2 : 1,
            "person_to_notify_relative_type_id" => "200",
        ];
    }

    public function getAdmission($an) {
        $patient = $this->getPatient('123' . substr($an, 3));
        return [
                "resultCode" => "0",
                "resultText" => "success.",
                "hn" => '123' . substr($an, 3),
                "an" => $an,
                "name" => $patient['name'],
                "datetime_admit" => \Carbon\Carbon::now()->toDateString() . " 08:00",
                "ward_id" => "119",
                "ward_name" => "โรคไตสง่านิลวรางกูร(ไตเทียม)",
                "ward_brief_name" => "ไตเทียม",
                "attending_id" => "12345",
                "attending_name" => "Dr. Steven Strange",
                "patient_dept" => "01",
                "patient_dept_name" => "อายุรศาสตร์",
                "patient_sub_dept" => "",
                "patient_sub_dept_name" => "",
                "datetime_dc" => \Carbon\Carbon::now()->toDateString() . " 20:00",
                "discharge_type" => "1",
                "discharge_type_name" => "WITH APPROVAL",
                "discharge_status" => "1",
                "discharge_status_name" => "COMPLETE RECOVERY",
            ];
    }
}