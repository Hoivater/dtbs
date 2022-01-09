<?php

/**
 *
 */
class Route
{
	private $html;
	private $route_array;

	function __construct($requestUri)
	{
		$this -> route_array = explode('/', $requestUri);
	}




	public function getHtml()
	{
		return $this -> html;
	}
	public function getRouteArray()
	{
		return $this -> route_array;
	}
}

?>