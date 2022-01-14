<?php 
	namespace hoivater\dtbs\worker;
	use hoivater\dtbs\base\control as Control;
	use hoivater\dtbs\base as Base;
	/**
	 * 
	 */
	class LogicTable 
	{
		private $data;
		private $commands;

		private $name_db;//имя базы данных
		private $table_name;//имя таблицы
		private $fields_array;
		private $fields_parametr;
		
		//в конструкторе записываем полученные данные, в функциях выполянем основное назначение 
		function __construct($data)
		{
			$filename = "temporary.ini";
			$commands = $data["code_user"];//текст запроса пользователя
			file_put_contents($filename, $commands);//запись в временный файл
			$commands_array = parse_ini_file($filename);//массив запроса пользователей
			unlink($filename);//удаляем временный файл


			#достаем name_db
			$ini_db = parse_ini_file(__DIR__.'/../base/db.ini');
			$this -> name_db = $ini_db["name_db"];

			$this -> table_name = $commands_array["table_name"];


			foreach($commands_array as $key => $value)
			{
				if($key !== 'table_name')
				{
					if($key !== '' && $value !== '')
					{
						$this -> fields_array[] = $key;
						$this -> fields_parametr[] = $value;
					}
				}
			}

			//Control\Necessary::CompareArrayInTable($this -> fields_array, $this -> fields_parametr);
		}

		public function CreateTable()
		{
			$sql = parse_ini_file(__DIR__."/../off_db/command/sql.ini");
			$sql = $sql['create'];
			$query = $sql['sql'];
			$history = $sql['history'];
			$rollback = $sql['rollback'];
			$tmplt_sql = ['%name_db%', '%table_name%', '%fields%'];
			$tnplt_history = ['%table_name%', '%fields_history%'];
			
			$result = Control\Control::SecurityFields($this -> fields_parametr);//проверка на верность наличия уточняющей длины
			if($result[0] === true)#проверка пройдена, создаем таблицу, пишем логи
			{
				$fields = $this -> forCreateSqlFields($this -> fields_parametr);
				$replace = [$this -> name_db, $this -> table_name, $fields];
				$result_sql = Control\Necessary::standartReplace($tmplt_sql, $replace, $query);
				$tableInq = new Base\TableInq();
				// echo $result_sql;
				$result = $tableInq -> querySql($result_sql);
				if($result === true)
				{
					return "Таблица ".$this -> table_name." создана.";
				}
				else
				{
					return "Произошли проблемы. Попробуйте снова";
				}
			}
			else#проверка не пройдена
			{
				return $result[0];
			}
		}

		private function forCreateSqlFields($f)
		{
			$sql_value = parse_ini_file(__DIR__."/../off_db/command/sql_value.ini");
			$result = Control\Control::SecurityFields($f);//проверка на верность наличия уточняющей 
			$value = $result[1];
			$key = $result[2];
			#print_r($key);Array ( [0] => [1] => (250) [2] => (60) [3] => (255) [4] => (32) [5] => (50) [6] => )
			#print_r($value);Array ( [0] => this_id [1] => varchar [2] => varchar [3] => varchar [4] => varchar [5] => varchar [6] => this_date )

			$c = Control\Necessary::ReplaceSqlValue($sql_value, $key, $value, $this -> fields_array);//сразу выстраиваем 

			return $c;
		}

	}
?>