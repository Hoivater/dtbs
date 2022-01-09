<?

	require "faqs_table.php";
	/**
	 * формирование логики вывода страницы
	 * Основные функции:
	 * -проверка подключения к бд(этот статус выводится на всех страницах);
	 * -проверка общих настроек;
	 */
	class FaqsPage extends FaqsTable
	{
		public $html;//заготовка
		public $page;//результат работы класса
		public $tmplt;//массив для замены

		function __construct($name_page)
		{
			parent::__construct();
			$staticPage = new StaticPage();//получение html кода статической части страницы

			$this -> tmplt = ["%main_left%", "%message%", "%main_right%"];

			$this -> html = $staticPage -> getStaticPage();
			$this -> Page($name_page);
		}

		public function Page($name_page)
		{
			session_start();
			unset($_SESSION['message']);
			if($name_page === 0)
			{
				$main_right = $this -> searchPage("dtbs");
			}
			else
			{
				$main_right = $this -> searchPage($name_page);
			}

			$main_left = file_get_contents('tmplt_dtbs/main/main_left_faq.tmplt');
			$message = $_SESSION["message"];

			$replace = [$main_left, $message, $main_right];

			$this -> page = Necessary::standartReplace($this -> tmplt, $replace, $this -> html);

		}

	}
?>