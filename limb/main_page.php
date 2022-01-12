<?

	require "main_table.php";
	/**
	 * формирование логики вывода страницы
	 * Основные функции:
	 * -проверка подключения к бд(этот статус выводится на всех страницах);
	 * -проверка общих настроек;
	 */
	class MainPage extends MainTable
	{

		
		use tPage;

		function __construct($name_page)
		{
			parent::__construct();
			$staticPage = new StaticPage();//получение html кода статической части страницы

			$this -> html = $staticPage -> getStaticPage();
			$this -> Page($name_page);
		}

		public function Page($name_page)
		{
			session_start();
			if(isset($_SESSION["message"]))  unset($_SESSION['message']);
			
			if($name_page === 0)
			{
				$main_right = $this -> MainRight('standart');
			}
			else
			{
				$main_right = $this -> MainRight($name_page);
			}
			$main_left = file_get_contents('tmplt_dtbs/main/main_left_history.tmplt');
			
			if(isset($_SESSION["message"])) $message = $_SESSION["message"];
			else $message = "";
			
			$replace = [$main_left, $message, $main_right];

			$this -> page = Necessary::standartReplace($this -> tmplt, $replace, $this -> html);
		}


	}
?>