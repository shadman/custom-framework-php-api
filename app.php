<?php
error_reporting(E_ALL);

$route = str_replace($_SERVER['SCRIPT_NAME'].'/', "", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH ));

require "config/autoload.php";

require "config/routes.php";

