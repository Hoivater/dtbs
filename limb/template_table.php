<?


	/**
	 * работа с данными таблицы faqs
	 * либо, как в этом случае, работа с файлами
	 */
	class TemplateTable
	{

		function __construct()
		{
			// echo "Экземпляр класса TemplateTable создан<br />";
		}
		public function copyF_main_left_table_F()
		{

			$_table = new TableTable();
			return $_table -> main_left_table_F();
		}
	}
?>