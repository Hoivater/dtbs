<?

	/**
	 * работа с данными таблицы faqs
	 * либо, как в этом случае, работа с файлами
	 */
	class SettingTable
	{
		// #1
		public $tmplt_main_left_setting = ['%host%', '%newClassForTable%', '%name_db%', '%user%', '%password%', '%fornameDB%'];
		public $result_main_left_setting;//финиш для шаблона main/main_left_setting
		public $main_left_setting;
		public $inc_main_left_setting;
		// end#1

		function __construct()
		{
			// #1
			$this -> main_left_setting = file_get_contents('tmplt_dtbs/main/main_left_setting.tmplt');
			$this -> inc_main_left_setting = parse_ini_file('base/db.ini');
			// end#1
		}

		//функция собирающая шаблон main_left_setting
		protected function main_left_settingF()
		{

			$this -> result_main_left_setting = Necessary::asortReplace($this -> tmplt_main_left_setting, $this -> inc_main_left_setting, $this -> main_left_setting);
			return $this -> result_main_left_setting;
		}

	}
?>