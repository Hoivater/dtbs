<?php 
	require "../form/core/form_route.php";

	if(isset($_POST))
	{
		$fRoute = new FormRoute($_POST["nameForm"], $_POST);//вход данных и их обработка
		session_start();
		$_SESSION["message"] = $fRoute -> result();
		header('Location: /setting/');
	}
?>