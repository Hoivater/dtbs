<?php
namespace hoivater\dtbs\form;
require "../autoload.php";

	class FormRoute extends FormBase
	{

		private $result;

		function __construct($name_form, $data)
		{
			parent::__construct($data);
			
			$this -> routeF($name_form);
		}

		private function routeF($name_form)
		{
			if($name_form == "connect")
			{
				
				$this -> result = $this -> tab_newIni();// перезаписывает db.ini возвращает либо true Либо false
				
			}
			elseif($name_form == 'importBD')
			{
				$this -> result = $this -> ImportBD();
			}
		}


		public function result()
		{
			return $this -> result;
		}
	}

	
	if(isset($_POST))
	{
		$fRoute = new FormRoute($_POST["nameForm"], $_POST);//вход данных и их обработка
		session_start();
		$_SESSION["message"] = $fRoute -> result();
		header('Location: '.$_SERVER['HTTP_REFERER']);
	}

?>