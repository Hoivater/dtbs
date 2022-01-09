<?

	/**
	 * работа с данными таблицы faqs
	 * либо, как в этом случае, работа с файлами
	 */
	class FaqsTable
	{

		function __construct()
		{
			echo "Экземпляр класса FaqsTable создан<br />";
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
			return $result;
		}
	}
?>