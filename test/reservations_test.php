<?php
require "config/autoload.php";

require 'app/controllers/reservations.php';
#require 'app/models/reservations.php';

class ReservationsTestController extends PHPUnit_Framework_TestCase {


  public function testPostReservation() {

  	$json_request = json_encode( array ( "boarding_passes" => array (112233, 221144, 330055, 441166) ) );

	$reservation = new ReservationsController;
	$result = $reservation->postReservation($json_request);

	$count = count(json_decode($result));

	$this->assertGreaterThan(0, $count);
  }


  public function testGetPassesDetailsWithIds() {

	$search = array(112233, 221144);

	$reservation = new Reservations;
	$reservation_data = $reservation->getPassesDetails($search);
	$count = count($reservation_data);

	$this->assertEquals(3, $count);
  }


  public function testGetPassesDetailsWithWrongIds() {

	$search = array(11223333, 3344444);

	$reservation = new Reservations;
	$reservation_data = $reservation->getPassesDetails($search);
	$count = count($reservation_data);

	$this->assertEquals(0, $count);
  }


  public function testGetFlightPatternWithTicketCounter() {

	$record = (object) array( 'seat_no' => '3A', 'gate_no' => '45B', 'bagging_ticket_counter' => '33', 'bagging_from_last' => 1, 'flight_no' => 'SK455', 'source' => 'New City', 'destination' => 'Old City', 'type' => 1 );

  	$reservation = new Reservations;
  	$reservation_data = $reservation->applyPattern($record);

	$length = strlen($reservation_data);

	$this->assertGreaterThan(2, $length);
  }


  public function testGetFlightPatternWithOutTicketCounter() {

	$record = (object) array( 'seat_no' => '3A', 'gate_no' => '45B', 'bagging_ticket_counter' => '', 'bagging_from_last' => 1, 'flight_no' => 'SK455', 'source' => 'New City', 'destination' => 'Old City', 'type' => 1 );

  	$reservation = new Reservations;
  	$reservation_data = $reservation->applyPattern($record);

	$length = strlen($reservation_data);

	$this->assertGreaterThan(2, $length);
  }


  public function testGetTrainPattern() {

	$record = (object) array( 'seat_no' => '3A', 'flight_no' => 'SK455', 'source' => 'New City', 'destination' => 'Old City', 'type' => 2 );

  	$reservation = new Reservations;
  	$reservation_data = $reservation->applyPattern($record);

	$length = strlen($reservation_data);

	$this->assertGreaterThan(2, $length);
  }


  public function testGetBusPattern() {

	$record = (object) array( 'seat_no' => '3A', 'source' => 'New City', 'destination' => 'Old City', 'type' => 3 );

  	$reservation = new Reservations;
  	$reservation_data = $reservation->applyPattern($record);

	$length = strlen($reservation_data);

	$this->assertGreaterThan(2, $length);
  }

}


