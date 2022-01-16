<?
namespace hoivater\dtbs\limb\public;
use hoivater\dtbs\base as Base; #для работы с базой данный
	/**
	 * работа с данными таблицы
	 *
	 */
	class TagsTable
	{
		public $tmpltTags = ['%id%', '%tags%', '%transcript%', '%count%'];//массив из таблиц
		public $resultTags;//финишная сборка для шаблона для возврата в _Page
		public $name = 'my_tavb_tags';//имя таблицы которое используется по умолчанию
		public $table_key = "`id`, `tags`, `transcript`, `count`";
		#public $replace = [$id, $tags, $transcript, $count];


		public function __construct()
		{
			#code...
		}

		//метод достаюший все поля из таблицы
		public function searchFieldCom()
		{
			#$si = new Base\SearchInq($name);
			#$result = $si -> select() ->  where($key, $value, $operator) -> limit() -> res();

			#code...

		}
		#метод добавляющий данные в таблицу, value - строка следующего вида
		#NULL, '".$this -> title."', '".$this -> keywords."', '".$this -> description."'
		public function insertFieldCom($value)
		{
			#$ri = new Base\RedactionInq($this -> name, $this -> table_key);
			#$result = $ri -> insert($value);

			#code...
		}
	}
?>
