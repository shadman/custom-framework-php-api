<?php

require "config/database.php";
use lib\DB\Database as DB;

$DB = new DB();


echo "\nExecuting seeds..\n";

$insert_query = "INSERT INTO areas (id, name, status) VALUES (1,'Madrid',1), (2,'Barcelona',1), (3,'Gerona Airport',1), (4,'Stockholm',1), (5,'New York JFK',1)";

if ($DB->query($insert_query) === TRUE) {
    echo $DB->success();
} else {
    echo $DB->errorOnSeeds();
    exit;
}


# type 1:flight/2:train/3:bus
$insert_query = "INSERT INTO reservations (boarding_pass, source_area_id, destination_area_id, type, seat_no, flight_no, gate_no, bagging_ticket_counter, bagging_from_last, created_by, created_at, updated_by, updated_at) VALUES 
(112233, 1, 2, 2, '45B', '78A', NULL, NULL, NULL, 1, NULL, 1, NULL),
(221144, 2, 3, 3, NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, NULL),
(330055, 3, 4, 1, '3A', 'SK455', '45B', 344, NULL, 1, NULL, 1, NULL),
(441166, 4, 5, 1, '7B', 'SK22', 22, NULL, 1, 1, NULL, 1, NULL)
";

if ($DB->query($insert_query) === TRUE) {
    echo $DB->success();
} else {
    echo $DB->errorOnSeeds();
    exit;
}
