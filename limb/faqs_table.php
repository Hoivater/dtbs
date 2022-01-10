<?

	/**
	 * работа с данными таблицы faqs
	 * либо, как в этом случае, работа с файлами
	 */
	class FaqsTable
	{

		function __construct()
		{
			
		}

		protected function searchPage($name_page)
		{
			//ищем в каталоге файлы с таким именем и возвращаем
			$filename = 'off_db/'.$name_page;
			if(file_exists($filename)){
				$result = file_get_contents($filename);
			}
			else
			{
				$result = "Указанный файл не был найден";
			}

			$main_right = file_get_contents('tmplt_dtbs/main/main_right_faqs.tmplt');
			$fin = Necessary::standartReplace(['%text%'], [$result], $main_right);
			return $fin;
		}
	}
?>