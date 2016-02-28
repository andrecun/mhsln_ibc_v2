<?php
require_once('nusoap.php');
require_once('class.wsdlcache.php');

class ResultObject
{
	var $fault;
	var $error;
	var $result;
	
	public function setFault($fault)
	{
		$this->fault = $fault;
	}

	public function getFault()
	{
		return $this->fault;
	}

	public function setError($error)
	{
		$this->error = $error;
	}

	public function getError()
	{
		return $this->error;
	}

	public function setResult($result)
	{
		$this->result = $result;
	}

	public function getResult()
	{
		return $this->result;
	}
}

class PDDIKTIClient
{
	// variabel yang dibutuhkan untuk membuat objek web service request
	var $client;
	var $url;
	var $service_type = 'wsdl';
	var $result_object;

	// varibel untuk membuat timestamp
	var $skewing = '-5 minute'; // untuk mengantisipasi perbedaan waktu dengan server
	var $duration = '+1 hour';
	var $created;
	var $expires;

	// username dan password yang diperlukan saat mengakses web service
	var $username;
	var $password;

	var $headers;

	public function __construct($url, $username, $password, $timeout = 3600, $response_timeout = 3600)
	{
		$this->username = $username;
		$this->password = $password;
		$this->url = $url;
		$this->result_object = new ResultObject();

		// Caching the WSDL
		$cache = new nusoap_wsdlcache('.', 300);
		$wsdl = $cache->get($url);

		if(is_null($wsdl)) {
			$wsdl = new wsdl($url, '', '', '', '', 5);
			$cache->put($wsdl);
		}

		$this->client = new nusoap_client($wsdl, $this->service_type, false, false, false, false, $timeout, $response_timeout, '');

		if(!is_null($username) && !is_null($password))
		{
			$this->client->setHeaders($this->getRequestHeader($this->username, $this->password));			
		}

		
		$err = $this->client->getError();
		
		if($err)
		{
			echo '<h2>Constructor error</h2> <pre>' . $err . '</pre>';
		}
		
	}

	public function getRequestHeader($username, $password)
	{
		date_default_timezone_set('Asia/Jakarta');
		$date = date('c', time());

		$this->created = date('c', strtotime($this->skewing, strtotime($date)));
		$this->expires = date('c', strtotime($this->duration, strtotime($date)));

		return $this->header = '<wsse:Security xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd" xmlns:wsu="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd">
							    <wsu:Timestamp wsu:Id="TS-25E232A967584A367B1417769121926133">
						            <wsu:Created>' . $this->created . '</wsu:Created>
						            <wsu:Expires>' . $this->expires . '</wsu:Expires>
						        </wsu:Timestamp>
						        <wsse:UsernameToken wsu:Id="UsernameToken-BEC569E3C42C14C8CE1417701166047188">
						            <wsse:Username>' . $this->username . '</wsse:Username>
						            <wsse:Password Type="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0#PasswordText">' . $this->password . '</wsse:Password>
						        	<wsu:Created>' . $this->created . '</wsu:Created>
						    	</wsse:UsernameToken>
						</wsse:Security>
						<wsa:Action xmlns:wsa="http://www.w3.org/2005/08/addressing">http://schemas.xmlsoap.org/ws/2005/02/trust/RST/SCT</wsa:Action>
						<wsa:MessageID xmlns:wsa="http://www.w3.org/2005/08/addressing">uuid:1884762a-b9a2-4d64-91e7-b282787f4daf</wsa:MessageID>';
	}

	
	public function call_operation($operation_name, $param)
	{
		$result = $this->client->call($operation_name, $param);

		$this->result_object->setFault($this->client->fault);
		$this->result_object->setError($this->client->getError());
		$this->result_object->setResult($result);

		return $this->result_object;
	}
	
}
?>