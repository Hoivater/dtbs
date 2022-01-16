<?php
	namespace hoivater\dtbs\worker;
	use hoivater\dtbs\base\control as Control;
	use hoivater\dtbs\base as Base;

	/**
	 * Класс для создания классов согласно шаблонов
	 */
	class MasterClass
	{
		public $replace;
		public $tmplt;
		public $table_name;
		public $for_table_key;

		public function __construct($table_name, $tmplt, $replace, $for_table_key)
		{
			$this -> table_name = $table_name;
			$this -> tmplt = $tmplt;
			$this -> replace = $replace;
			$this -> for_table_key = $for_table_key;
		}
		public function addTablePageCl()
		{
			$result = "";
			$php_file_Page = file_get_contents(__DIR__."/../off_db/classes/namepage.tm");
			$php_file_Table = file_get_contents(__DIR__."/../off_db/classes/nametable.tm");

			$ini = parse_ini_file(__DIR__."/../base/db.ini");

			$table_name = str_replace($ini['fornameDB'], "", $this -> table_name);
			$table_name =  ucfirst(mb_strtolower($table_name));

			$php_file_Page_result = Control\Necessary::standartReplace(["_NAME_"], [$table_name], $php_file_Page);
			$php_file_Table_result = Control\Necessary::standartReplace(["_NAME_", "_TMPLT_", "_REPLACE_", "_TABLENAME_", "_FORTABLEKEY_"], [$table_name, $this -> tmplt, $this -> replace, $this -> table_name, $this -> for_table_key], $php_file_Table);

			$filenamePage = __DIR__."/../limb/site/".$table_name."Page.php";
			$filenameTable = __DIR__."/../limb/site/".$table_name."Table.php";

			$res = file_put_contents($filenamePage, $php_file_Page_result);
			if($res === true)
			{
				$result = "<br /> /limb/public/".$table_name."Page.php успешно создан.";
			}
			$res = file_put_contents($filenameTable, $php_file_Table_result);

			if($res === true)
			{
				$result .= "<br /> /limb/public/".$table_name."Table.php успешно создан.";
			}
			return $result;
		}

	}

?>