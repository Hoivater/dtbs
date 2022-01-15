<?php
namespace hoivater\dtbs\base;

	class SearchInq extends DataBase{
		private $db;//объект базы данных
		private $query;
		private $name;

		public function __construct($name){
			$this -> db = DataBase::getDB();
			$this -> name = $name;
		}


		//по принципу LARAVEL?? ГДЕ КАЖДАЯ ФУНКЦИЯ ДОБАВЛЯЕТ КУСОЧЕК КОДА В КОД
		public function select()
		{
			#создает SELECT * FROM `".$table_name."`
			$this -> query = "SELECT * FROM `".$this -> name."`";
		}
		public function where($key, $value, $operator)
		{
			if($operator == "LIKE")
				$value = "%".$value."%";
			$this -> query .= " WHERE ".$key.$operator."'".$value."'";
		}
		public function orderDesc($field = "")
		{
			if($field == "")
				$field = "id";
			$this -> query .= " ORDER BY `".$field."` DESC'";
		}
		public function orderAsc($field = "")
		{
			if($field == "")
				$field = "id";
			$this -> query .= " ORDER BY `".$field."` ASC'";
		}
		public function limit($start, $length)
		{
			$this -> query .= " LIMIT ".$startFrom.", ".$length;
		}
		public function res()
		{
			$table = $this -> db -> select($this -> query);
			return $table;
		}
	}
?>