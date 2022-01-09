<?php
	require	"dataBase.php";

	class Search extends DataBase{
		private $db;//объект базы данных
		private $query;
		
		public function __construct(){
			$this -> db = DataBase::getDB();
		}


		//ИСПОЛЬЗУЕМЫЕ////////////////////////////ИСПОЛЬЗУЕМЫЕ////////////////////////////ИСПОЛЬЗУЕМЫЕ
		//ЧТЕНИЕ ТАБЛИЦ////////////////////////////ЧТЕНИЕ ТАБЛИЦ////////////////////////////ЧТЕНИЕ ТАБЛИЦ
		public function LengthTable($table_name){//возвращает количество записей в таблице
			$count_table = $this -> db -> CountTable($table_name);
			return $count_table;
		}
		public function LengthTableWhere($table_name, $name_cot, $id_category){//возвращает количество записей в таблице с условием
			$count_table = $this -> db -> CountTableWhere($table_name, $name_cot, $id_category);
			return $count_table;
		}
		public function ChoiceTableString($table_name, $value, $key){//выборка из таблицы всей строки
			$query = "SELECT * FROM `".$table_name."` WHERE ".$key."='".$value."' ORDER BY `id`";
			$table = $this -> db -> select($query);
			return $table;
		}
		public function ChoiceTableStringSort($table_name, $value, $key, $sort){//выборка из таблицы всей строки
			$query = "SELECT * FROM `".$table_name."` WHERE ".$key."='".$value."' ORDER BY `".$sort."`";
			$table = $this -> db -> select($query);
			return $table;
		}
		public function ChoiceTableAll($table_name, $length){//выборка из таблицы всего столбца В обратной посл. с ограничением
			$query = "SELECT * FROM `".$table_name."` ORDER BY `id` DESC LIMIT ".$length;
			$table = $this -> db -> select($query);
			return $table;
		}
		public function ChoiceTableAllSort($table_name, $length, $cols){//выборка из таблицы всего столбца В обратной посл. с ограничением
			$query = "SELECT * FROM `".$table_name."` ORDER BY `".$cols."` DESC LIMIT ".$length;
			$table = $this -> db -> select($query);
			return $table;
		}
		public function TableAll($table_name){//выборка из таблицы всего столбца В обратной посл. без ограничения
			$query = "SELECT * FROM `".$table_name."` ORDER BY `id` DESC";
			$table = $this -> db -> select($query);
			return $table;
		}

		public function TableAllSort($table_name, $i, $desc){//выборка из таблицы всего столбца В обратной посл. без ограничения DESC
			$query = "SELECT * FROM `".$table_name."` ORDER BY `".$i."` ".$desc;
			$table = $this -> db -> select($query);
			return $table;
		}
		public function ChoiceTableAllCategory($table_name, $length, $key_category, $value_category){//выборка из таблицы всего столбца В обратной посл.
			$query = "SELECT * FROM `".$table_name."` WHERE ".$key_category." LIKE '%".$value_category."%' ORDER BY `id` DESC LIMIT ".$length;
			$table = $this -> db -> select($query);
			return $table;
		}
		public function ChoiceTableAllTegs($table_name, $length, $string){//выборка из таблицы всего столбца В обратной посл.
			#string == `question` LIKE '%вопрос%' OR `question` LIKE '%авто%' OR `question` LIKE '%авто%'
			$query = "SELECT * FROM `".$table_name."` WHERE ".$string." ORDER BY `id` DESC LIMIT ".$length;
			$table = $this -> db -> select($query);
			return $table;
		}
		public function ChoiceTableContinueTegs($table_name, $length, $startFrom, $string){//выборка из таблицы нужного количество статей в обратной последовательности 
			$query = "SELECT * FROM `".$table_name."` WHERE ".$string." ORDER BY `id` DESC LIMIT ".$startFrom.", ".$length;
			$table = $this -> db -> select($query);
			return $table;
		}
		#SELECT * FROM `git_7459q5sml` WHERE `question` LIKE '%вопрос%' OR `question` LIKE '%авто%'

		public function ChoiceTableContinue($table_name, $length, $startFrom){//выборка из таблицы нужного количество статей в обратной последовательности 
			$query = "SELECT * FROM `".$table_name."` ORDER BY `id` DESC LIMIT ".$startFrom.", ".$length;
			$table = $this -> db -> select($query);
			return $table;
		}
		public function ChoiceTableContinueCategory($table_name, $length, $startFrom, $value_category, $key_category){//выборка из таблицы нужного количество статей в обратной последовательности 

			$query = "SELECT * FROM `".$table_name."` WHERE ".$key_category." LIKE '%".$value_category."%' ORDER BY `id` DESC LIMIT ".$startFrom.", ".$length;
			$table = $this -> db -> select($query);
			return $table;
		}
		public function CommentaryLoad($table_name, $length, $startFrom, $value_category, $key_category){//выборка из таблицы нужного количество статей в обратной последовательности 
			$query = "SELECT * FROM `".$table_name."` WHERE ".$key_category." LIKE '%".$value_category."%' ORDER BY `data` DESC LIMIT ".$startFrom.", ".$length;
			$table = $this -> db -> select($query);
			return $table;
		}
		public function ChoiceSearch($table_name, $key, $value){//выборка из таблицы всей строки 
			$query = "SELECT * FROM `".$table_name."` WHERE ".$key."='".$value."'";
			$table = $this -> db -> select($query);
			return $table;
		}
		public function ChoiceNoSearch($table_name, $key, $value){//выборка из таблицы всей строки 
			$query = "SELECT * FROM `".$table_name."` WHERE ".$key."!='".$value."'";
			$table = $this -> db -> select($query);
			return $table;
		}
		public function ChoiceSearchLike($table_name, $key_category, $value_category){//выборка из таблицы всей строки с условием LIKE
			$query = "SELECT * FROM `".$table_name."` WHERE ".$key_category." LIKE '%".$value_category."%' ORDER BY `id` DESC";
			$table = $this -> db -> select($query);
			return $table;
		}
		public function UpdateStr($table, $key_red, $value_red, $key, $value){
			$query = "UPDATE `".$table."` SET `".$key_red."` = '".$value_red."' WHERE ".$key."='".$value."'";
			$table = $this -> db -> query($query);
			return $table;
		}
		public function EndPgram($table, $value_category, $key_category)//функция возвращает дату написания последнего PGRAM по определенной категории
		{
			$query = "SELECT `date` FROM `".$table."` WHERE `".$key_category."` LIKE '%".$value_category."%' ORDER BY `id`";
			$table = $this -> db -> select($query);
			$newtable = array();
			for($i = 0; $i < count($table); $i++)
			{
				$newtable[$i] = $table[$i]["date"];
			}
			if(count($newtable) > 0)
				$arrayTime = getdate(max($newtable));
			else
				$arrayTime = $newtable;
			$timeArray = array();
			foreach($arrayTime as $key => $value)
			{
				if($value < 10)
				{
					$value = "0".$value;
				}
				$timeArray[] = $value;
			}
			$time_string = $timeArray[2].":".$timeArray[1]." ".$timeArray[3].".".$timeArray[5].".".$timeArray[6];
			return $time_string;
		}
		public function CountPgram($table, $value_category, $key_category){
			$query = "SELECT * FROM `".$table."` WHERE `".$key_category."` LIKE '%".$value_category."%' ORDER BY `id`";
			$table = $this -> db -> select($query);
			return array(count($table), $table);
		}
		//ИСПОЛЬЗУЕМЫЕ////////////////////////////ИСПОЛЬЗУЕМЫЕ////////////////////////////ИСПОЛЬЗУЕМЫЕ
		//ДОБАВЛЕНИЕ ТАБЛИЦ////////////////////////////ЧТЕНИЕ ТАБЛИЦ////////////////////////////ЧТЕНИЕ ТАБЛИЦ
		public function InsertString($name_table, $key_string, $value_string)
		{
			$query = "INSERT INTO `".$name_table."` (".$key_string.") VALUES (".$value_string.")";
			$result = $this -> db -> query($query);
			return $result;
		}
		//`id`, `title`, `keywords`, `description` - key
		//NULL, '".$this -> title."', '".$this -> keywords."', '".$this -> description."' - value

		//ИСПОЛЬЗУЕМЫЕ////////////////////////////ИСПОЛЬЗУЕМЫЕ////////////////////////////ИСПОЛЬЗУЕМЫЕ
		protected function SearchCategory($table_name, $value, $name_cot = false){//'Таблица по которой ищем' , 'значение столбца', 'имя_столбца по которому ищем'
			if(isset($name_cot))
			{
				$query = "";
			}
			else
				$query = "";
			$table = $this -> db -> select($query);
		}
		
		public function DeleteString($table_name, $key, $value){//удаление строки из таблицы $table_name где $name_column = $name_cat
			$query = "DELETE FROM `".$table_name."` WHERE ".$key."='".$value."'";
			$table = $this -> db -> query($query);
			return $table;
		}
		public function CopyString($table_new, $table_old, $key, $value){//удаление строки из таблицы $table_name где $name_column = $name_cat
			$query = "INSERT INTO `".$table_new."` SELECT * FROM `".$table_old."` WHERE ".$key."='".$value."'";
			$table = $this -> db -> query($query);
			return $table;
		}
		public function ChoiceTable($table_name, $name_cat){//выборка из таблицы всего столбца
			$query = "SELECT `".$name_cat."` FROM `".$table_name."` ORDER BY `id`";
			$table = $this -> db -> select($query);
			return $table;
		}
		
		public function RedactionMsg($new_name_article, $message_pgram, $kat_all, $copy, $many, $link)
		{
			$query = "UPDATE `pgram` SET name_article='".$new_name_article."', user_text='".$message_pgram."', Category='".$kat_all."', copy='".$copy."', many='".$many."'  WHERE link='".$link."'";
			$table = $this -> db -> query($query);
			return $table;
			
		}
		
		public function ChoiceTableStringLike($table_name, $name_page, $name_cot){//выборка из таблицы всей строки с условием LIKE ИСПОЛЬЗУЕТСЯ ДЛЯ ЗАГРУЗКИ И ПЕРЕИМЕНОВАНИЙ!!!!!
			$query = "SELECT * FROM `".$table_name."` WHERE ".$name_cot." LIKE '%".$name_page."%' ORDER BY `id`";
			$table = $this -> db -> select($query);
			return $table;
		}
		public function ChoiceTableStringLikeCategory($table_name, $name_page, $name_cot/*, $num_start, $num_end*/){//выборка из таблицы всей строки с условием LIKE
			$query = "SELECT * FROM `".$table_name."` WHERE ".$name_cot." LIKE '%".$name_page."%' ORDER BY `id` DESC";
			$table = $this -> db -> select($query);
			// session_start();
			// $_SESSION["Category"] = $table;
			// $table_new = array();
			// for($i = $num_start; $i <= $num_end; $i++)
			// {
				// if($i <= count($table)-1)
				// {
					// $table_new[] = $table[$i];
				// }
				// else
					// return $table_new;
			// }
			return $table;
		}

		
	}
	
?>