<?php

require 'config/database.php';

class Reservations extends lib\DB\Database {
	
	public $table = 'reservations';


	public function getPassesDetails($boarding_passes){

		$search = implode(', ', $boarding_passes);
		$data = $this->getBoardingPasses($search);

		$records = array();
		while ( $record = $this->fetchObject($data) ) {
			$records[] = $this->applyPattern($record);
		}

		if (count($records)>0) $records[] = "You have arrived at your final destination.";

		return $records;
	}


	public function getBoardingPasses($search){
		$query = " SELECT boarding_pass, source_area_id, destination_area_id, type, seat_no, 
		   flight_no, gate_no, bagging_ticket_counter, bagging_from_last, ar1.name as source, ar2.name as destination
		   FROM $this->table as res
		   LEFT JOIN areas as ar1 ON ar1.id = res.source_area_id 
		   LEFT JOIN areas as ar2 ON ar2.id = res.destination_area_id 
		   WHERE boarding_pass IN ($search) ";
		return $this->query($query);
	}


	public function applyPattern($record){
		if (!isset($record)) return "";

		switch ($record->type) {
			case 1: # FLight
				return $this->getFlightPattern($record);
			case 2: # Train
				return $this->getTrainPattern($record);
			case 3: # Bus
				return $this->getBusPattern($record);
			default: 
				return "";
		}

	}

	# Private Methods
	
	# Type = 1
	private function getFlightPattern($record){
		
		$sitting = 'No seat assignment.';
		$gate = '';
		$baggage = '';
		$bagging_from_last = '';

		if ( isset($record->seat_no) ) $sitting = "Seat $record->seat_no.";
		if ( isset($record->gate_no) ) $gate = "Gate $record->gate_no,";
		if ( isset($record->bagging_ticket_counter) ) $baggage = "Baggage drop at ticket counter $record->bagging_ticket_counter.";
		if ( $record->bagging_from_last == 1 ) $bagging_from_last = "Bagging will be automatically transferred from your last leg.";

		$resp = "From $record->source, take flight $record->flight_no to $record->destination. $gate $sitting $baggage $bagging_from_last";
		return $resp;

	}

	# Type = 2
	private function getTrainPattern($record){

		$sitting = 'No seat assignment.';		
		if (isset($record->seat_no)) $sitting = "Sit in $record->seat_no.";

		$resp = "Your train $record->flight_no from $record->source to $record->destination. $sitting";
		return $resp;

	}

	# Type = 3
	private function getBusPattern($record){

		$sitting = 'No seat assignment.';
		if (isset($record->seat_no)) $sitting = "Sit in $record->seat_no.";

		$resp = "Take the bus from $record->source to $record->destination. $sitting";
		return $resp;

	}


}