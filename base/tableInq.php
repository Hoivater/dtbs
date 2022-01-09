<?php

require	"dataBase.php";

	class TableInq extends DataBase{
		private $db;//объект базы данных
		private $query;

		public function __construct(){
			$this -> db = DataBase::getDB();
		}


	}
?>