<?php

class Response {
	
	public function jsonResponse($array){

		@header('Content-Type: application/json');
		$response = array ( 'results' => $array );
		return json_encode($response);

	}

}