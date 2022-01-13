<?php
	require "autoload.php";
	
	use hoivater\dtbs\data as Data;

	$page = new Data\Route($_SERVER["REQUEST_URI"]);//полноценная html страница
	Data\Visible::PrintPage($page -> getHtml());//вывод страницы в браузер

?>
