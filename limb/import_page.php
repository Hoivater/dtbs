<?

	require "import_table.php";
	/**
	 * формирование логики вывода страницы
	 * Основные функции:
	 * -проверка подключения к бд(этот статус выводится на всех страницах);
	 * -проверка общих настроек;
	 */
	class ImportPage extends ImportTable
	{
		use tPage;

		function __construct()
		{
			parent::__construct();
			$staticPage = new StaticPage();//получение html кода статической части страницы

			$this -> html = $staticPage -> getStaticPage();
			$this -> Page();
		}

		public function Page()
		{
			session_start();
			if(isset($_SESSION["message"]))  unset($_SESSION['message']);
			


			$main_left = file_get_contents('tmplt_dtbs/main/main_left_history.tmplt');


			$main_right = file_get_contents('tmplt_dtbs/main/main_right_import.tmplt');
			


			if(isset($_SESSION["message"])) $message = $_SESSION["message"];
			else $message = "";
			
			$replace = [$main_left, $message, $main_right];
			$this -> page = Necessary::standartReplace($this -> tmplt, $replace, $this -> html);
			
		}

	}
?>