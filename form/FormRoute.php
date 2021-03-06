<?php
namespace hoivater\dtbs\form;
use hoivater\dtbs\worker as Worker;
use hoivater\dtbs\base\control as Control;
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
			elseif($name_form == 'newTable')
			{
				$worker_i = new Worker\LogicTable($this -> data);
				$this -> result .= $worker_i -> CreateTable();//создаем таблицу

				if( $worker_i -> getResult() === true)
				{
					$parametr = $worker_i -> getParametr();//получаем массив данных [table_name, tmplt, replace]
					$masterClass = new Worker\MasterClass($parametr[0], $parametr[1], $parametr[2], $parametr[3]);
					$this -> result .= $masterClass -> addTablePageCl();#возвращает успех или нет
				}
			}
			elseif($name_form == 'redTable')
			{
				$worker_i = new Worker\LogicTable($this -> data);
				#копируем данные из таблицы
				Control\Necessary::delete_table($this -> data["name_table"]);

				$this -> result .= $worker_i -> CreateTable();//создаем таблицу
				if( $worker_i -> getResult() === true)
				{
					$parametr = $worker_i -> getParametr();//получаем массив данных [table_name, tmplt, replace]
					$masterClass = new Worker\MasterClass($parametr[0], $parametr[1], $parametr[2], $parametr[3]);
					$this -> result .= $masterClass -> addTablePageCl();#возвращает успех или нет
				}
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