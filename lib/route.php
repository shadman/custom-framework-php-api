<?php
namespace lib\Route;

class Route
{

  public $route, $controller, $action;

  public function __construct($routes, $required_route){
	foreach ($routes as $key) {
		if ($key['name'] == $required_route) {
			$this->route = $key['name'];
			$this->controller = $key['controller'].'Controller';
			$this->action = $key['action'];
		}
	}
  }

  public function route() {
  	if ( empty($this->controller) ) return "Sorry, invalid route found.";

    $controller = new $this->controller;
    $action = $controller->{$this->action}();
    return $action;

  }

}