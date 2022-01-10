<?php

	require "STATICTABLE.php";
	require "base/control/control.php";
	require "base/control/necessary.php";
	require "TRAITPAGE.php";
	/**
	 * Сборка неизменяемой части страницы
	 */
	class StaticPage extends StaticTable
	{
		private $control;
		private $html_static_page;// собранный итого код неизменяемой части страницы
		private $setting;

		function __construct()
		{
			session_start();
			if(isset($_SESSION['connect'])) unset($_SESSION['connect']);
			$html = file_get_contents("tmplt_dtbs/layouts/main.tmplt");
			$this -> control = new Control();
			$this -> html_static_page = $html;
			$this -> controlConnectDB();
			$this -> setting = parse_ini_file('off_db/setting.ini');
			$menu_left = file_get_contents('tmplt_dtbs/menu/menu_left.tmplt');
			$menu_right = file_get_contents('tmplt_dtbs/menu/menu_right.tmplt');

			$connect = $_SESSION['connect'];

			$tmplt = ['%version%', '%link%', '%menu_left%', '%menu_right%', '%connect%'];
			$replace = [$this -> setting['version'], $this -> setting['link'], $menu_left, $menu_right, $connect];


			$this -> html_static_page = Necessary::standartReplace($tmplt, $replace, $html);

		}


		public function controlConnectDB()
		{
			$error_connection = $this -> control -> ConnectDB();//проверка возможности подключения к бд, при незаполненном возвращается текст описания ошибки, при положительном  = true

			session_start();
			if($error_connection === true)
			{
				$_SESSION['connect'] = "<h5 class='m-3' style='color:green;'>Соединение с бд установлено</h5>";
			}
			else{
				$_SESSION['connect'] = "<h5 class='m-3' >Невозможно подключиться к базе данных:<small style='color:red;'>".$error_connection."<br />Проверьте соответствие пользователя</small></h5>";
			}

			}


		public function getStaticPage()
		{
			return $this -> html_static_page;
		}
	}


?>