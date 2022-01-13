<?php
namespace hoivater\dtbs\base;

	class SearchInq extends DataBase{
		private $db;//объект базы данных
		private $query;

		public function __construct(){
			$this -> db = DataBase::getDB();
		}


	}
?>