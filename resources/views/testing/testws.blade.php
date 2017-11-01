@extends('medicine.form')

@section('doc_title')
Admission note form
@endsection

@section('description')siriraj medicine admission note form @endsection

@section('author')koramit pichana @endsection

@section('script')
<!-- nav-bar and accodien together -->
<style type="text/css">
	body {
		padding-top: 100px;
		/*padding-left: 10px;
		padding-right: 10px;*/
		}
</style>

<script language="javascript" type="text/javascript">
  function resizeIframe(obj) {
    // obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
    obj.style.height = obj.contentWindow.document.body.scrollHeight * 0.75 + 'px';
    obj.style.width = obj.contentWindow.document.body.scrollWidth + 'px';
  }
</script>
@include('wordplease_js')
@endsection

@section('content')

<script type="text/javascript">
	var webServiceURL = 'http://172.20.9.212/MRSServices/MRSPatInfo.asmx?op=SearchPatientDataDescriptionType';
	var soapMessage = '<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">';
	soapMessage = soapMessage + '<soap:Body><SearchPatientDataDescriptionType xmlns="http://tempuri.org/">';
	soapMessage = soapMessage + '<hn>5313005</hn><Username>admnote</Username><Password>admnote</Password><RequestComputerName>SHODAN</RequestComputerName>';
	soapMessage = soapMessage + '</SearchPatientDataDescriptionType></soap:Body></soap:Envelope>';

	function CallService()
    {
        $.ajax({
            url: webServiceURL, 
            type: "POST",
            dataType: "xml", 
            data: soapMessage, 
            //processData: false,
            contentType: "text/xml; charset=\"utf-8\"",
            headers: {
                                         'Access-Control-Allow-Origin' : 'http://172.20.9.212:8080',

                                     },
            success: OnSuccess, 
            error: OnError
        });

        return false;
    }

    function OnSuccess(data, status)
    {
        alert(data.d);
    }

    function OnError(request, status, error)
    {
        alert('error');
    }

	$(document).ready(function(){
		alert(webServiceURL);
		alert(soapMessage);
		CallService();
	});

</script>
@endsection