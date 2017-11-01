<?php
namespace App\Providers;
use SoapBox\Formatter\Formatter;
use App\Itemizes\Ward;
use App\Itemizes\AttendingStaff;
use App\Itemizes\PatientType;
use App\Itemizes\Title;
use App\Itemizes\RaceNation;
use App\Itemizes\MaritalStatus;
use App\Itemizes\Postcode;
use App\Itemizes\RelativeType;
use App\Itemizes\Patient;

class MedicalRecordServices {

	/** 
	*	webservice url and credential define in .env file.
	*	@var env('WS_SERVER_USER')
	*	@var env('WS_SERVER_PASSWORD')
	*	@var env('WS_SERVICE_USER')
	*	@var env('WS_SERVICE_PASSWORD')
	*	@var env('WS_MRS_URL')
	*	@var env('WS_URL')
	*/
	
	/**
	* Handle SiIT webservice response.
	* Sub string the result just the XML part then use formatter parsing to array.
	*
	* @return (array) of webservice responce.
	*/
	protected static function handleWSResult(&$result, $mode) {
		if (strpos($result, '<div id="header"><h1>Server Error</h1></div>') !== FALSE) {
			return FALSE;
		} else {
			// Remove unknow namspace.
			$result = str_replace('diffgr:', '', $result);
			$result = str_replace('msdata:', '', $result);

			// Remove &# encode.
			$result = str_replace('&#', '', $result);

			// Cut SOAP elements from XML response.
			$begin = strpos($result, '<Result xmlns="">');
			$end  = strpos($result, '</diffgram>');
			$subResult = substr($result, $begin, $end - $begin);
			if ($mode == 1) { // getPatient.
				if (!strpos($subResult, 'PatResult'))
					return FALSE;
				$formatter = Formatter::make($subResult, Formatter::XML);
				return $formatter->toArray()['PatResult'];
			}
			// getAdmission
			if (!strpos($subResult, 'InpatientResult'))
				return FALSE;
			$formatter = Formatter::make($subResult, Formatter::XML);
			return $formatter->toArray()['InpatientResult'];
		}
	}

	/**
	* Use cURL to get patient data from SiIT webservice.
	*
	* @return (array) Result of SiIT SearchPatientData(hn, Username, Password, RequestComputerName),
	*								  SearchPatientDataDescriptionType(hn, Username, Password, RequestComputerName)
	*/
	public static function getPatient($hn, $mode = 2) {
		// Assign function name.
		$functionname = ($mode == 1) ? 'SearchPatientData' : 'SearchPatientDataDescriptionTypeExcludeD';

		// The value for the SOAPAction: header
		$action = "http://tempuri.org/" . $functionname;

		// Compose SOAP string.
		$strSOAP = "<?xml version=\"1.0\" encoding=\"utf-8\"?>";
		$strSOAP .= "<soap:Envelope xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xmlns:xsd=\"http://www.w3.org/2001/XMLSchema\" xmlns:soap=\"http://schemas.xmlsoap.org/soap/envelope/\">";
		$strSOAP .= "<soap:Body>";
		$strSOAP .= "<" . $functionname . " xmlns=\"http://tempuri.org/\">";
		$strSOAP .= "<hn>" . $hn . "</hn>";
		$strSOAP .= "<Username>" . env('WS_SERVICE_USER') . "</Username>";
		$strSOAP .= "<Password>" . env('WS_SERVICE_PASSWORD') . "</Password>";
		$strSOAP .= "<RequestComputerName></RequestComputerName>";
		$strSOAP .= "</" . $functionname . ">";
		$strSOAP .= "</soap:Body>";
		$strSOAP .= "</soap:Envelope>";

		// This header work with SiIT Webservices.
		$headers = array(
			"Host: 172.20.9.212",
			"Content-Type: text/xml; charset=utf-8",
			"SOAPAction: \"". $action . "\"",
			"Transfer-Encoding: chunked",
		);

		// Build the cURL session.
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, env('WS_MRS_URL'));
		curl_setopt($ch, CURLOPT_TIMEOUT, env('WS_CONN_TIMEOUT')); // set connection timeout.
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $strSOAP);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_NTLM);
		curl_setopt($ch, CURLOPT_USERPWD, env('WS_SERVER_USER') . ":" . env('WS_SERVER_PASSWORD'));

		// Send the request and check the response.
		$result = curl_exec($ch);
		curl_close($ch); // Close cURL connection.
		if ($result === FALSE)
			return FALSE; // In case of connection fail, return return_code = x.
		return MedicalRecordServices::handleWSResult($result, 1);
	}

	/**
     * Use cURL to get admission data from SiIT webservice.
     *
     * @return (array) Result of SiIT SearchInpatientAllByAN(hn, Username, Password, RequestComputerName).
     */
	public static function getAdmission($AN) {
		// Assign function name.
		$functionname = 'SearchInpatientAllByAN';

		// The value for the SOAPAction: header
		$action = "http://tempuri.org/" . $functionname;

		// Compose SOAP string.
    	$strSOAP = "<?xml version=\"1.0\" encoding=\"utf-8\"?>";
    	$strSOAP .= "<soap:Envelope xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xmlns:xsd=\"http://www.w3.org/2001/XMLSchema\" xmlns:soap=\"http://schemas.xmlsoap.org/soap/envelope/\">";
	    $strSOAP .= "<soap:Body>";
	    $strSOAP .= "<" . $functionname . " xmlns=\"http://tempuri.org/\">";
	    $strSOAP .= "<AN>" . $AN . "</AN>";
	    $strSOAP .= "<UserName>" . env('WS_SERVICE_USER') . "</UserName>";
	    $strSOAP .= "<Password>" . env('WS_SERVICE_PASSWORD') . "</Password>";
	    $strSOAP .= "<RequestComputerName></RequestComputerName>";
	    $strSOAP .= "</" . $functionname . ">";
	    $strSOAP .= "</soap:Body>";
	    $strSOAP .= "</soap:Envelope>";

	    // This header work with SiIT Webservices.
	    $headers = array(
	        "Host: 172.20.9.212",
	        "Content-Type: text/xml; charset=utf-8",
	        "SOAPAction: \"". $action . "\"",
	        "Transfer-Encoding: chunked",
	    );

	    // Build the cURL session.
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, env('WS_MRS_URL'));
	    curl_setopt($ch, CURLOPT_TIMEOUT, env('WS_CONN_TIMEOUT')); // set connection timeout.
	    curl_setopt($ch, CURLOPT_POST, TRUE);
	    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $strSOAP);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_NTLM);
		curl_setopt($ch, CURLOPT_USERPWD, env('WS_SERVER_USER') . ":" . env('WS_SERVER_PASSWORD'));

	  // Send the request and check the response.
		$result = curl_exec($ch);
		curl_close($ch); // Close cURL connection.
		if ($result === FALSE)
			return FALSE; // In case of connection fail, return return_code = x.
		return MedicalRecordServices::handleWSResult($result, 2);
	}

	/**
     * Use cURL to get admission data from SiIT webservice.
     *
     * @return (array) Result of SiIT SearchInpatientAllByAN(hn, Username, Password, RequestComputerName).
     */
	public static function getPatientAdmission($HN) {
		// Assign function name.
		$functionname = 'SearchInpatientAll';

		// The value for the SOAPAction: header
		$action = "http://tempuri.org/" . $functionname;

		// Compose SOAP string.
		$strSOAP = "<?xml version=\"1.0\" encoding=\"utf-8\"?>";
		$strSOAP .= "<soap:Envelope xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xmlns:xsd=\"http://www.w3.org/2001/XMLSchema\" xmlns:soap=\"http://schemas.xmlsoap.org/soap/envelope/\">";
		$strSOAP .= "<soap:Body>";
		$strSOAP .= "<" . $functionname . " xmlns=\"http://tempuri.org/\">";
		$strSOAP .= "<HN>" . $HN . "</HN>";
		$strSOAP .= "<UserName>" . env('WS_SERVICE_USER') . "</UserName>";
		$strSOAP .= "<Password>" . env('WS_SERVICE_PASSWORD') . "</Password>";
		$strSOAP .= "<RequestComputerName></RequestComputerName>";
		$strSOAP .= "</" . $functionname . ">";
		$strSOAP .= "</soap:Body>";
		$strSOAP .= "</soap:Envelope>";

		// This header work with SiIT Webservices.
		$headers = array(
			"Host: 172.20.9.212",
			"Content-Type: text/xml; charset=utf-8",
			"SOAPAction: \"". $action . "\"",
			"Transfer-Encoding: chunked",
		);

		// Build the cURL session.
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, env('WS_MRS_URL'));
		curl_setopt($ch, CURLOPT_TIMEOUT, env('WS_CONN_TIMEOUT')); // set connection timeout.
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $strSOAP);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_NTLM);
		curl_setopt($ch, CURLOPT_USERPWD, env('WS_SERVER_USER') . ":" . env('WS_SERVER_PASSWORD'));

		// Send the request and check the response.
		$result = curl_exec($ch);
		curl_close($ch); // Close cURL connection.
		if ($result === FALSE)
			return FALSE; // In case of connection fail, return return_code = x.
		return MedicalRecordServices::handleWSResult($result, 2);
	}

	/**
     * Use cURL to get user data from SiIT webservice.
     *
     * @return (array) Result of SiIT SiITCheckUser(Userid, Password, SystemID).
     */
	public static function checkUser($Userid, $Password) {
		// Assign function name.
		$functionname = 'SiITCheckUser';

		// The value for the SOAPAction: header
		$action = "http://tempuri.org/" . $functionname;

		// Compose SOAP string.
	    $strSOAP = "<?xml version=\"1.0\" encoding=\"utf-8\"?>";
	    $strSOAP .= "<soap:Envelope xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xmlns:xsd=\"http://www.w3.org/2001/XMLSchema\" xmlns:soap=\"http://schemas.xmlsoap.org/soap/envelope/\">";
	    $strSOAP .= "<soap:Body>";
	    $strSOAP .= "<" . $functionname . " xmlns=\"http://tempuri.org/\">";
	    $strSOAP .= "<Userid>" . $Userid . "</Userid>";
	    $strSOAP .= "<Password>" . $Password . "</Password>";
	    $strSOAP .= "<SystemID>1</SystemID>";
	    $strSOAP .= "</" . $functionname . ">";
	    $strSOAP .= "</soap:Body>";
	    $strSOAP .= "</soap:Envelope>";

	    // This header work with SiIT Webservices.
	    $headers = array(
	        "Host: 172.20.9.212",
	        "Content-Type: text/xml; charset=utf-8",
	        "SOAPAction: \"". $action . "\"",
	        "Transfer-Encoding: chunked",
	    );

	    // Build the cURL session.
	    //$url = 'http://172.20.9.212/ServiceSiITUsers.asmx';
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, env('WS_URL'));
	    curl_setopt($ch, CURLOPT_TIMEOUT, env('WS_CONN_TIMEOUT')); // set connection timeout.
	    curl_setopt($ch, CURLOPT_POST, TRUE);
	    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $strSOAP);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_NTLM);
	    curl_setopt($ch, CURLOPT_USERPWD, env('WS_SERVER_USER') . ":" . env('WS_SERVER_PASSWORD'));

	    // Send the request and check the response.
	    if (($result = curl_exec($ch)) === FALSE) {
	    	// In case of connection fail, return return_code = x.
	    	$parsed = FALSE;
	    	return FALSE;// *****
	    } else {
	    	return $result;// *****
	    	if (strpos($result, '<div id="header"><h1>Server Error</h1></div>')) {
    			return FALSE;
    		} else {
		    	// Remove unknow namspace.
		    	$result = str_replace('diffgr:', '', $result);
		    	$result = str_replace('msdata:', '', $result);
		    	
			    // Cut SOAP elements From XML response.
			    $begin = strpos($result, '<GetUsers');
			    $end  = strpos($result, '</NewDataSet>');
			    $subResult1 = substr($result, $begin, $end - $begin);

			    /* Sub data no need right now.
			    $begin = strpos($result, '<before>');
			    $end  = strpos($result, '</diffgram>');
			    $subResult2 = substr($result, $begin, $end - $begin);
			    $subResult = '<Result>' . $subResult1 . $subResult2 . '</Result>';
			    */

			    $formatter = Formatter::make($subResult1, Formatter::XML);
					$parsed = $formatter->toArray();
			}
	    	
		}

		curl_close($ch); // Close cURL connection.

	    return $parsed;
	}

	/**
	* Parse date and time data return by webservice to model datetime format.
	* @return string.
	*
	*/
	public static function parseDateTime($date, $time) {
		if ($date == 0) {
			return '';
		} else {
			$time = str_pad($time,4,'0',STR_PAD_LEFT);
			$datetime = substr($date, 6, 2) . "-" . substr($date, 4, 2) . "-" . (substr($date, 0, 4) - 543);
			$datetime .= " " . substr($time, 0, 2) . ":" . substr($time, 2, 2);
			return $datetime;
		}
	}

	/**
	* Parse date data return by webservice to model date format.
	* @return string.
	*
	*/
	public static function parseDate($date) {
		if ($date == 0) {
			return '';
		} else {
			$dateFormated = substr($date, 6, 2) . "-" . substr($date, 4, 2) . "-" . (substr($date, 0, 4) - 543);
			return $dateFormated;
		}
	}

	// /** MOVE ALL FIELDS TO PARENT NOTE. NO NEED THIS ANY MORE.
	// * Fill data from webservice to reference $request.
	// * @return void.
	// *
	// */
	// public static function fillRequest(&$request, &$result, &$note, &$patient) {
	// 	// Add webservice data to $request.
	// 	$request['note_id'] = $note->id;
		
	// 	// $patient = Patient::foundOrNew($result['hn']); // redundancy call medthod.
		
	// 	$request['patient_id'] = $patient->id;
	// 	// $request['HN'] = $result['hn'];
	// 	$request['datetime_admit'] = MedicalRecordServices::parseDateTime($result['admission_date'],$result['admission_time']);
	// 	$request['datetime_dc'] = MedicalRecordServices::parseDateTime($result['discharge_date'],$result['discharge_time']);
	// 	$request['ward_id'] = (empty($result['ward_name']) || is_array($result['ward_name'])) ? null : Ward::foundOrNew(trim($result['ward_name']), trim($result['ward_brief_name']));
	// 	if (!empty($result['refer_doctor_code']) && !is_array($result['refer_doctor_code']) && $result['refer_doctor_code'] != '0') {
	// 		$request['attending_id'] = AttendingStaff::foundOrNew(trim($result['refer_doctor_code']), trim($result['doctor_name']));
	// 	}
	// }

	/**
	* Parse date and time data return by webservice to model datetime format.
	* @return string.
	*
	*/
	public static function updatePatient($HN) {
		$wsPatient = MedicalRecordServices::getPatient($HN);
		if ($wsPatient && $wsPatient['return_code'] == '0') {
			$patient = Patient::foundOrNew($HN);
			$patient->patient_type_id = (empty($wsPatient['patient_type_name']) || is_array($wsPatient['patient_type_name'])) ? null : PatientType::foundOrNew(trim($wsPatient['patient_type_name']));
			$patient->national_id = (empty($wsPatient['identity_card_no']) || is_array($wsPatient['identity_card_no'])) ? null : trim($wsPatient['identity_card_no']);
			$patient->title_id = (empty($wsPatient['title']) || is_array($wsPatient['title'])) ? null : Title::foundOrNew(trim($wsPatient['title']));
			$patient->first_name = (empty($wsPatient['patient_firstname']) || is_array($wsPatient['patient_firstname'])) ? null : trim($wsPatient['patient_firstname']);
			$patient->middle_name = (empty($wsPatient['patient_middlename']) || is_array($wsPatient['patient_middlename'])) ? null : trim($wsPatient['patient_middlename']);
			$patient->last_name = (empty($wsPatient['patient_surname']) || is_array($wsPatient['patient_surname'])) ? null : trim($wsPatient['patient_surname']);
			
			// ****** need to test parseDate and parseDateTime ***** //
			$patient->dob = MedicalRecordServices::parseDate($wsPatient['birth_date']);
			$patient->gender = (empty($wsPatient['sex']) ? null : trim($wsPatient['sex'])) == 'ชาย' ? 1 : 0;
			$patient->race_id = (empty($wsPatient['race_name']) || is_array($wsPatient['race_name'])) ? null : RaceNation::foundOrNew(trim($wsPatient['race_name']));
			$patient->nation_id = (empty($wsPatient['nationality_name']) || is_array($wsPatient['nationality_name'])) ? null : RaceNation::foundOrNew(trim($wsPatient['nationality_name']));
			$patient->marital_status_id = (empty($wsPatient['marriage_stat_name']) || is_array($wsPatient['marriage_stat_name'])) ? null : MaritalStatus::foundOrNew(trim($wsPatient['marriage_stat_name']));
			
			$patient->spouse = (empty($wsPatient['marrier_name']) || is_array($wsPatient['marrier_name'])) ? null : trim($wsPatient['marrier_name']);
			$patient->address = (empty($wsPatient['present_address']) || is_array($wsPatient['present_address'])) ? null : trim($wsPatient['present_address']);
			if (!empty($wsPatient['tambon']) && !is_array($wsPatient['tambon']) && !empty($wsPatient['zipcode']) && !is_array($wsPatient['zipcode']) && !empty($wsPatient['amphur']) && !is_array($wsPatient['amphur']) && !empty($wsPatient['province']) && !is_array($wsPatient['province'])) {
				$patient->postcode_id	= Postcode::foundOrNew(trim($wsPatient['zipcode']), trim($wsPatient['tambon']), trim($wsPatient['tambon']) . " " . trim($wsPatient['amphur']) . " " . trim($wsPatient['province']));
			}
			$patient->tel_no = (empty($wsPatient['present_tele_no']) || is_array($wsPatient['present_tele_no'])) ? null : trim($wsPatient['present_tele_no']);
			$patient->mobile_no = (empty($wsPatient['mobile_no']) || is_array($wsPatient['mobile_no'])) ? null : trim($wsPatient['mobile_no']);
			$patient->person_to_notify = (empty($wsPatient['connected_name']) || is_array($wsPatient['connected_name'])) ? null : trim($wsPatient['connected_name']);
			$patient->person_to_notify_address = (empty($wsPatient['connected_address']) || is_array($wsPatient['connected_address'])) ? null : trim($wsPatient['connected_address']);
			$patient->person_to_notify_tel_no = (empty($wsPatient['connected_tele_no']) || is_array($wsPatient['connected_tele_no'])) ? null : trim($wsPatient['connected_tele_no']);
			$patient->person_to_notify_relative_type_id = (empty($wsPatient['connected_relation_name']) || is_array($wsPatient['connected_relation_name'])) ? null : RelativeType::foundOrNew(trim($wsPatient['connected_relation_name']));
			$patient->save();
			return $patient;
		}
		return FALSE;
	}
}