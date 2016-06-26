<?php

require 'lib/route.php';

use lib\Route\Route as Routes;

require 'app/controllers/reservations.php';

$routes = [ 
			array ('name' => 'reservation', 'controller' => 'Reservations', 'action' => 'postReservation')
		  ];



$routing = new Routes($routes, $route);
echo $routing->route();
