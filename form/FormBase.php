<?php
namespace hoivater\dtbs\form;

use hoivater\dtbs\base as Base;

	class FormBase
	{	
		public $ini_new;//перезаписанный массив
		public $data;//массив данных полученный через форму

		function __construct($data)
		{
			$this -> data = $data;
		}

		public function tab_newIni()
		{
			// print_r($this -> data);
			$this -> ini_new = Base\control\Necessary::ConvertInIni($this -> data);
			// print_r($this -> ini_new);
			file_put_contents('../base/db.ini', $this -> ini_new);
			return true;
		}
		public function ImportBD()
		{
			$code = $this -> data['file_sql'];
			$tableInq = new Base\TableInq();
			//$code_array = Necessary::ToCodeSql($code);
			$result = $tableInq -> ImportBDU($code);
			if($result == true)
			{
				$result = "База данных успешно импортирована";
			}
			else
			{
				$result = "При импорте произошла ошибка";
			}
			return $result;
		}
	}
?>