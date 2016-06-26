<?php

class Request extends Response {
	

	public function postRequest($param_name){
		return ( isset($_POST[$param_name]) ) ? $_POST[$param_name] : NULL;
	}

	public function getRequest($param_name){
		return ( isset($_GET[$param_name]) ) ? $_GET[$param_name] : NULL;
	}

	public function jsonRequest($request_json=''){

		if (isset($request_json) && $request_json!='') return json_decode($request_json);

		$jsonStr = file_get_contents("php://input");		
		return json_decode($jsonStr);
	}


}