<?php

require "limb/STATICPAGE.php";
require	"limb/faqs_page.php";
require	"limb/main_page.php";
require	"limb/import_page.php";
require	"limb/export_page.php";
require	"limb/template_page.php";
require	"limb/setting_page.php";
require	"limb/table_page.php";
/**
 *
 */
class Route
{
	private $html;
	private $route_array;//содержит массив имен пути

	function __construct($requestUri)
	{
		$arr = explode('/', $requestUri);
		$new_arr = array_diff($arr, array(''));
		$this -> route_array = array_values($new_arr);

		$this -> routeLimb();//ищем в "лимбе" адрес и обрабатываем
	}

	private function routeLimb()
	{
		$route_arr = $this -> route_array;

		if(count($route_arr) >= 1)
		{
				if($route_arr[0] == "import")
				{
					$html = new ImportPage();
				}
				elseif($route_arr[0] == "export")
				{
					$html = new ExportPage();
				}
				elseif($route_arr[0] == "template")
				{
					$html = new TemplatePage();
				}
				elseif($route_arr[0] == "setting")
				{
					$html = new SettingPage();
				}
				elseif($route_arr[0] == "table")
				{
					$html = new TablePage();
				}
				elseif($route_arr[0] == "faqs")
				{
					if(isset($route_arr[1]))
					{
						$html = new FaqsPage($route_arr[1]);//открываем заданную
					}
					else
					{
						$html = new FaqsPage(0);//открываем первую статью
					}
					$this -> html = $html -> page;
				}
				else
				{
					session_start();
					$_SESSION['message'] = "Страница не найдена";
					$html = new MainPage();
				}

		}
		else
		{
			$html = new MainPage();
		}
	}


	public function getHtml()
	{
		return $this -> html;
	}
	public function getRouteArray()
	{
		return $this -> route_array;
	}
}

?>