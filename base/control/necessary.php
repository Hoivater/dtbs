<?php
namespace hoivater\dtbs\base\control;
use hoivater\dtbs\base as Base;
	// Класс содержит часто используемые методы на разных этапах
	class Necessary
	{
		public static function standartReplace($tmplt, $replace, $html)
		{
			return str_replace($tmplt, $replace, $html);
		}
		//имена одинаковые но не в том порядке (обязательно массивы)
		//так, массив tmplt - ['%re%', '%be%', '%fe%']
		//массив $replace - ['be' => 'jioo', 'fe' => 'huhu', '%re%' => 'defrwrgrer']
		//получаем - ['defrwrgrer', 'jioo', 'huhu']

		public static function asortReplace($tmplt, $replace, $html)
		{
			$sortReplace = [];//отсортированный массив $replace под $tmplt
			$control = false;
			foreach ($tmplt as $true_key) {
				$true_key = str_replace('%', '', $true_key);
				foreach ($replace as $key => $value) {
					if($true_key == $key)
					{
						$sortReplace[] = $value;
						$control = true;
						break;
					}
				}
				if($control === false)
				{
					$sortReplace[] = "";
				}
			}
			//проверка массивов
			//self::CompareArrayInTable($tmplt, $sortReplace);
			//
			return  self::standartReplace($tmplt, $sortReplace, $html);
		}

		//выводит сравнение двух массивов в таблицу
		public static function CompareArrayInTable($arr1, $arr2)
		{
			echo "<table class = 'table table-bordered'><tr>";

			foreach ($arr1 as $key) {
				echo "<td>";
				echo $key;
				echo "</td>";
			}
			echo "</tr><tr>";

			foreach ($arr2 as $key) {
				echo "<td>";
				echo $key;
				echo "</td>";
			}

			echo "</tr></table>";
		}
		//конвертация файла в текст формата Ini
		public static function ConvertInIni($arr)
		{
			$ini_text = "[setting]\n";
			foreach ($arr as $key => $value) {
				$ini_text .= $key."='".$value."';\n";
			}
			return $ini_text;
		}

		// public static function ReplaceRepeat($tmplt, $replace, $html)
		// {
		// 	$result = "";
		// 	for($i = 0; $i <= count($replace)-1; $i++)
		// 	{
		// 		$result .= self::asortReplace($tmplt, $replace, $html);
		// 	}
		// 	return $result;
		// }
		public static function ReplaceRepeat($tmplt, $replace, $html)
		{
			$result = "";
			for($i = 0; $i <= count($replace)-1; $i++)
			{

				$result .= self::standartReplace($tmplt, $replace[$i], $html);
			}
			return $result;
		}

		public static function ToCodeSql($code)
		{
			$result = '';
			$result_array = [];
			$i = 0;
			$code_array = explode("\n", $code);

			foreach ($code_array as $key)
			{
				$key = trim($key);#убираем пробелы вначале и в конце
				$sym = substr($key, 0,2);#получаем первых два символа
				$key = str_replace('"', '"', $key);
				//  || $sym == "/*"
				if($sym == "--" || $sym == NULL || $sym == "")
				{

				}
				else
				{

					$result .= $key."\n<br />";
					if(substr($key, -1) == ";")
					{
						//$key = substr($key, 0, -1);
						//$key .= '"';
						$result_array[] = $result;
						$result = "";
					}


					//echo substr($key, 0,2)."<br />";
				}

			}
			return $result_array;
		}
		public static function delete_table($name_table)
		{
			$tq = new Base\TableInq();
			$tq -> dropTable($name_table);
		}
		public static function ScanDirF($folder)
		{
			$result = [];
			$files = scandir($folder);
			foreach ($files as $key) {
			 	if($key == '.' || $key == '..')
			 	{
			 		
			 	}
			 	else
			 	{
			 		$result[] = $key;
			 	}
			 }
			 return $result; 
		}
		public static function ReplaceSqlValue($ini, $num, $value, $name)#собираем SQL запрос для создания таблицы
		{
			$end = "";
			foreach ($value as $keys) {
				if($keys == "this_id")
				{
					$end = ", ".$ini["this_id_end"];
				}
			}
			
			$new_value = [];
			for($i = 0; $i <= count($value)-1; $i++)
			{
				foreach ($ini as $key => $val) {
					if($key == $value[$i])
					{
						$new_value[] = $val;
					}
				}
			}

			for($j = 0; $j <= count($new_value)-1; $j++)
			{
				$new_value[$j] = str_replace("%num%", $num[$j], $new_value[$j]);
			}
			
			for($j = 0; $j <= count($value)-1; $j++)
			{
				$value[$j] = str_replace($value[$j], $new_value[$j], $value[$j]);
				$value[$j] = "`".$name[$j]."` ".$value[$j];
			}

			$string_sql = implode(', ', $value).$end;
			return $string_sql;

		}
	}
?>