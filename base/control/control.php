<?php
	namespace hoivater\dtbs\base\control;
	
	use hoivater\dtbs\base as Base;
	/**
	 * Класс который задействуется в различных проверках
	 *
	 */
	class Control
	{

		function __construct()
		{
			// code...
		}

		// проверка на корректное соединение с бд
		public function ConnectDB()
		{
			$errors = "";
			// сразу проверяем на заполненность db.ini
			$ini = parse_ini_file('base/db.ini');

			foreach($ini as $key => $value)
			{
				if($key == 'host')
				{
					if(!$value)
					{
						$errors .= "<br />Не заполнено имя Хоста;";
					}
				}
				elseif($key == 'name_db')
				{
					if(!$value)
					{
						$errors .= "<br />Не заполнено имя название базы данных;";
					}
				}
				elseif($key == 'user')
				{
					if(!$value)
					{
						$errors .= "<br />Не заполнено имя пользователя базы данных;";
					}
				}
			}
			if($errors == "")
			{
				// затем проверяем на возможность фактического подключения
				$connects = Base\DataBase::getDB();
				$result_connect = $connects -> connect();
				return $result_connect;
			}
			else
			{
				return $errors;
			}
		}
	}
?>