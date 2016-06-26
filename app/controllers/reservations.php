<?php

require 'app/models/reservations.php';

class ReservationsController extends ApplicationController {


  /**
   * @api {post} /reservation Fetch Board Passes Details
   * @apiName BoardingDetail
   * @apiGroup Boarding Pass
   * @apiVersion 0.1.0
   * @apiDescription Get all boarding passes details
   * 
   * @apiParam {Array} boarding_passes All boarding passes ids in array
   * 
   * @apiSuccess {Object} result Response user object in json
   * 
   * @apiExample Example Request
   * http://localhost/custom/app.php/reservation
   * 
   * @apiExample Example Request JSON
   * {"boarding_passes":[112233,221144]}
   * 
   * @apiSuccessExample Example Response
   * {"results":["Your train from Madrid to Barcelona. Sit in 45B.","Take the bus from Barcelona to Gerona Airport. No seat assignment."]}
   */
  
  public function postReservation($request='') {

  	$request = $this->jsonRequest($request);

  	$reservations = new Reservations();
	$results = $reservations->getPassesDetails($request->boarding_passes);

	$response = $this->jsonResponse($results);

	return $response;
	
  } 


}
