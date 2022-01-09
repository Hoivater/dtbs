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

		function __construct()
		{
			parent::__construct();
			$staticPage = new StaticPage();//получение html кода статической части страницы
			echo $staticPage -> getStaticPage();
		}


	}
?>