<?php
namespace hoivater\dtbs\data;
use hoivater\dtbs\limb\dtbs as Limb;
use hoivater\dtbs\limb\site as LimbSite;
use hoivater\dtbs\base\control as Control;

class Route
{
	private $html;
	private $route_array;//содержит массив имен пути

	function __construct($requestUri)
	{
		$arr = explode('/', $requestUri);
		$new_arr = array_diff($arr, array(''));
		$this -> route_array = array_values($new_arr);

		// $this -> routeLimb();//ищем в "лимбе" адрес и обрабатываем
		$this -> routePublicLimb(); #ваш проект
	}

	private function routePublicLimb()
	{
		$route_arr = $this -> route_array;

		$html = new LimbSite\MainPage();
		$this -> html = $html -> page;
	}
	private function routeLimb()
	{
		$route_arr = $this -> route_array;

		if(count($route_arr) >= 1)
		{
				if($route_arr[0] == "import")
				{
					$html = new Limb\ImportPage();
				}
				elseif($route_arr[0] == "export")
				{
					$html = new Limb\ExportPage();
				}
				elseif($route_arr[0] == "template")
				{
					$html = new Limb\TemplatePage();
				}
				elseif($route_arr[0] == "setting")
				{
					$html = new Limb\SettingPage();
				}
				elseif($route_arr[0] == "table")
				{
					if(isset($route_arr[1])) $html = new Limb\TablePage($route_arr[1]);//открываем заданную
					else $html = new Limb\TablePage(0);//открываем первую статью
				}
				elseif($route_arr[0] == "delete_table")
				{
					if(isset($route_arr[1]))
					{
						Control\Necessary::delete_table($route_arr[1]);
					}
					header('Location: '.$_SERVER['HTTP_REFERER']);//возвращаем наместо
				}
				elseif($route_arr[0] == "faqs")
				{
					if(isset($route_arr[1])) $html = new Limb\FaqsPage($route_arr[1]);//открываем заданную
					else $html = new Limb\FaqsPage(0);//открываем первую статью
				}
				else
				{
					session_start();
					$_SESSION['message'] = "Страница не найдена";
					if(isset($route_arr[0])) $html = new Limb\MainPage($route_arr[0]);//открываем заданную
					else $html = new Limb\MainPage(0);//открываем первую статью
				}

		}
		else
		{
			if(isset($route_arr[1])) $html = new Limb\MainPage($route_arr[1]);//открываем заданную
			else $html = new Limb\MainPage(0);//открываем первую статью
		}
		$this -> html = $html -> page;
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