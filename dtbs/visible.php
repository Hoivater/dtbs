<?php
	/**
	 *
	 */
	class Visible
	{

		function __construct()
		{
			// code...
		}

		public static function PrintRouteArray($route_array)
		{
			foreach ($route_array as $key) {
				echo $key."<br />";
			}
		}
		public static function PrintPage($code)
		{
			echo $code;
		}
	}
?>