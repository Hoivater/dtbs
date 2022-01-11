<?php
	require "../base/tableInq.php";

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
			$this -> ini_new = Necessary::ConvertInIni($this -> data);
			// print_r($this -> ini_new);
			file_put_contents('../base/db.ini', $this -> ini_new);
			return true;
		}
		public function ImportBD()
		{
			$code = $this -> data['file_sql'];
			$tableInq = new TableInq();
			$code_array = Necessary::ToCodeSql($code);

			foreach ($code_array as $code) {
				$tableInq -> ImportBDU($code);
			}
			//print_r($code_array);
			return true;
		}
	}
?>