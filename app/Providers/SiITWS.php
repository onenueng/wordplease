<?php
namespace App\Providers;
use SoapBox\Formatter\Formatter;
class SiITWS {

	/** 
	*	webservice url and credential define in .env file.
	*	@var env('SIIT_SERVER_USER')
	*	@var env('SIIT_SERVER_PASSWORD')
	*	@var env('SIIT_SERVICE_USER')
	*	@var env('SIIT_SERVICE_PASSWORD')
	*	@var env('SIIT_MRS_URL')
	*	@var env('SIIT_URL')
	*/
	
	/**
     * Handle SiIT webservice response.
     * Sub string the result just the XML part then use formatter parsing to array.
     *
     * @return (array) of webservice responce.
     */
    protected static function handleSiITWS(&$result, $mode) {
    	if (strpos($result, '<div id="header"><h1>Server Error</h1></div>') !== FALSE) {
    		return FALSE;
    	} else {
	    	// Remove unknow namspace.
	    	$result = str_replace('diffgr:', '', $result);
	    	$result = str_replace('msdata:', '', $result);

		    // Cut SOAP elements From XML response.
		    $begin = strpos($result, '<Result xmlns="">');
		    $end  = strpos($result, '</diffgram>');
		    $subResult = substr($result, $begin, $end - $begin);

		    $formatter = Formatter::make($subResult, Formatter::XML);
			return ($mode == 1) ? $formatter->toArray()['PatResult'] : $formatter->toArray()['InpatientResult'];
		}
    }

    /**
     * Use cURL to get patient data from SiIT webservice.
     *
     * @return (array) Result of SiIT SearchPatientData(hn, Username, Password, RequestComputerName),
     *								  SearchPatientDataDescriptionType(hn, Username, Password, RequestComputerName)
     */
	public static function getPatient($hn, $mode) {
		// Assign function name.
		$functionname = ($mode == 1) ? 'SearchPatientData' : 'SearchPatientDataDescriptionType';

		// The value for the SOAPAction: header
		$action = "http://tempuri.org/" . $functionname;

		// Compose SOAP string.
	    $strSOAP = "<?xml version=\"1.0\" encoding=\"utf-8\"?>";
	    $strSOAP .= "<soap:Envelope xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xmlns:xsd=\"http://www.w3.org/2001/XMLSchema\" xmlns:soap=\"http://schemas.xmlsoap.org/soap/envelope/\">";
	    $strSOAP .= "<soap:Body>";
	    $strSOAP .= "<" . $functionname . " xmlns=\"http://tempuri.org/\">";
	    $strSOAP .= "<hn>" . $hn . "</hn>";
	    $strSOAP .= "<Username>" . env('SIIT_SERVICE_USER') . "</Username>";
	    $strSOAP .= "<Password>" . env('SIIT_SERVICE_PASSWORD') . "</Password>";
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
	    curl_setopt($ch, CURLOPT_URL, env('SIIT_MRS_URL'));
	    curl_setopt($ch, CURLOPT_TIMEOUT, env('SIIT_CONN_TIMEOUT')); // set connection timeout.
	    curl_setopt($ch, CURLOPT_POST, TRUE);
	    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $strSOAP);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_NTLM);
		curl_setopt($ch, CURLOPT_USERPWD, env('SIIT_SERVER_USER') . ":" . env('SIIT_SERVER_PASSWORD'));
	    
	    // Send the request and check the response.
	    if (($result = curl_exec($ch)) === FALSE) {
	    	// In case of connection fail, return return_code = x.
	    	$parsed = FALSE;
	    } else {
	    	$parsed = SiITWS::handleSiITWS($result, 1);
		}

	    curl_close($ch); // Close cURL connection.

	    return $parsed;
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
	    $strSOAP .= "<UserName>" . env('SIIT_SERVICE_USER') . "</UserName>";
	    $strSOAP .= "<Password>" . env('SIIT_SERVICE_PASSWORD') . "</Password>";
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
	    curl_setopt($ch, CURLOPT_URL, env('SIIT_MRS_URL'));
	    curl_setopt($ch, CURLOPT_TIMEOUT, env('SIIT_CONN_TIMEOUT')); // set connection timeout.
	    curl_setopt($ch, CURLOPT_POST, TRUE);
	    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $strSOAP);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_NTLM);
		curl_setopt($ch, CURLOPT_USERPWD, env('SIIT_SERVER_USER') . ":" . env('SIIT_SERVER_PASSWORD'));
	    
	    // Send the request and check the response.
	    if (($result = curl_exec($ch)) === FALSE) {
	    	// In case of connection fail, return return_code = x.
	    	$parsed = FALSE;
	    } else {
	    	$parsed = SiITWS::handleSiITWS($result, 2);
		}

		curl_close($ch); // Close cURL connection.

	    return $parsed;
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
	    $strSOAP .= "<UserName>" . env('SIIT_SERVICE_USER') . "</UserName>";
	    $strSOAP .= "<Password>" . env('SIIT_SERVICE_PASSWORD') . "</Password>";
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
	    curl_setopt($ch, CURLOPT_URL, env('SIIT_MRS_URL'));
	    curl_setopt($ch, CURLOPT_TIMEOUT, env('SIIT_CONN_TIMEOUT')); // set connection timeout.
	    curl_setopt($ch, CURLOPT_POST, TRUE);
	    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $strSOAP);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_NTLM);
	    curl_setopt($ch, CURLOPT_USERPWD, env('SIIT_SERVER_USER') . ":" . env('SIIT_SERVER_PASSWORD'));

	    // Send the request and check the response.
	    if (($result = curl_exec($ch)) === FALSE) {
	    	// In case of connection fail, return return_code = x.
	    	$parsed = FALSE;
	    } else {
	    	$parsed = SiITWS::handleSiITWS($result, 2);
		}
		
		curl_close($ch); // Close cURL connection.

	    return $parsed;
	}

	/**
     * Use cURL to get admission data from SiIT webservice.
     *
     * @return (array) Result of SiIT SearchInpatientAllByAN(hn, Username, Password, RequestComputerName).
     */
	public static function checkSiITUser($Userid, $Password) {
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
	    curl_setopt($ch, CURLOPT_URL, env('SIIT_URL'));
	    curl_setopt($ch, CURLOPT_TIMEOUT, env('SIIT_CONN_TIMEOUT')); // set connection timeout.
	    curl_setopt($ch, CURLOPT_POST, TRUE);
	    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $strSOAP);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_NTLM);
	    curl_setopt($ch, CURLOPT_USERPWD, env('SIIT_SERVER_USER') . ":" . env('SIIT_SERVER_PASSWORD'));

	    // Send the request and check the response.
	    if (($result = curl_exec($ch)) === FALSE) {
	    	// In case of connection fail, return return_code = x.
	    	$parsed = FALSE;
	    } else {
	    	if (strpos($result, '<div id="header"><h1>Server Error</h1></div>') !== FALSE) {
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
	* Parse date and time data return by webservice to database datetime format.
	* @return string.
	*
	*/
	public static function parseDateTime($date, $time) {
		if ($date == 0) {
			return '';
		} else {
			$datetime = (substr($date, 0, 4) - 543) . "-" . substr($date, 4, 2) . "-" . substr($date, 6, 2);
			$datetime .= " " . substr($time, 0, 2) . ":" . substr($time, 2, 2);
			return $datetime;
		}
	}

	/**
    * 
    *
    *
    */
    public static function handleReturnCode($returnCode){
    	switch ($returnCode) {
    		case 'x':
    			return redirect('dashboard')->with('alert','connection fail.');
    		default:
    			return redirect('dashboard')->with('alert','connection fail.');
    	}
    }
}