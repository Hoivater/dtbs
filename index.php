<?php
	require "dtbs/route.php";
	require "dtbs/visible.php";

	$page = new Route($_SERVER["REQUEST_URI"]);//полноценная html страница
	Visible::PrintRouteArray($page -> getRouteArray());//вывод страницы в браузер

?>
