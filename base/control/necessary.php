<?php
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
	}
?>