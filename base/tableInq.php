<?php

require_once "dataBase.php";

	class TableInq extends DataBase{
		private $db;//объект базы данных
		private $query;

		public function __construct(){
			$this -> db = DataBase::getDB();
		}

		#получить названия присутсвующих таблиц
		public function showTable()
		{
			$query = "SHOW TABLES";
			$table = $this -> db -> select($query);
			return $table;
		}
		#получить названия присутсвующих таблиц
		public function structureTable($table_name)
		{
			$query = "SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name='".$table_name."'";
			$table = $this -> db -> select($query);
			return $table;
		}
		public function LengthTable($table_name){//возвращает количество записей в таблице
			$count_table = $this -> db -> CountTable($table_name);
			return $count_table;
		}
		public function ChoiceTableContinue($table_name, $length, $startFrom){//выборка из таблицы нужного количество статей в обратной последовательности 
			$query = "SELECT * FROM `".$table_name."` ORDER BY `id` DESC LIMIT ".$startFrom.", ".$length;
			$table = $this -> db -> select($query);
			return $table;
		}

	}
?>