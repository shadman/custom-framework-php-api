<?php

require "config/database.php";
use lib\DB\Database as DB;

$DB = new DB();


echo "\nCreating tables ..\n";

// Creating reservations table
$query = "CREATE TABLE reservations (
id INT(20) AUTO_INCREMENT PRIMARY KEY, 
boarding_pass INT(20) UNIQUE KEY, 
source_area_id INT(20) NOT NULL,
destination_area_id INT(20) NOT NULL,
type TINYINT(1) NOT NULL DEFAULT 1, 
seat_no VARCHAR(10),
flight_no VARCHAR(10),
gate_no VARCHAR(4),
bagging_ticket_counter INT(5),
bagging_from_last TINYINT(1),
created_by INT(20),
created_at TIMESTAMP,
updated_by INT(20),
updated_at TIMESTAMP
)";

if ($DB->query($query) === TRUE) {
    echo $DB->tableCreatedSuccess('reservations');
} else {
    echo $DB->errorOnMigration();
    exit;
}


# Creating areas table
$query = "CREATE TABLE areas (
id INT(20) AUTO_INCREMENT PRIMARY KEY, 
name VARCHAR(50), 
status TINYINT(1) NOT NULL DEFAULT 0
)";

if ($DB->query($query) === TRUE) {
    echo $DB->tableCreatedSuccess('areas');
} else {
    echo $DB->errorOnMigration();
    exit;
}



