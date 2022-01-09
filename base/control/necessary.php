<?php
	// Класс содержит часто используемые методы на разных этапах
	class Necessary
	{
		public static function standartReplace($tmplt, $replace, $html)
		{
			return str_replace($tmplt, $replace, $html);
		}
	}
?>