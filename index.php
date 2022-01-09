<?php
	require "data/route.php";
	require "data/visible.php";

	$page = new Route($_SERVER["REQUEST_URI"]);//полноценная html страница
	Visible::PrintPage($page -> getHtml());//вывод страницы в браузер

?>
