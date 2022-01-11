<?php
	require "form_base.php";
	require "../base/control/necessary.php";
	/**
	 *
	 */

	class FormRoute extends FormBase
	{

		private $result;

		function __construct($name_form, $data)
		{
			parent::__construct($data);
			
			$this -> routeF($name_form);
		}

		private function routeF($name_form)
		{
			if($name_form == "connect")
			{
				
				$this -> result = $this -> tab_newIni();// перезаписывает db.ini возвращает либо true Либо false
				
			}
			elseif($name_form == 'importBD')
			{
				$this -> result = $this -> ImportBD();
			}
		}


		public function result()
		{
			return $this -> result;
		}
	}

?>