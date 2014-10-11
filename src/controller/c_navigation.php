<?php
namespace controller;

require_once("./src/controller/c_login.php");
require_once("./src/view/v_navigation.php");

class Navigation{
	
	public function doControll(){
		$controller;
		
		try {
			switch (\view\NavigationView::getAction()){
				case \view\NavigationView::$actionLoggedIn:
					return "Du är inloggad!!";
					break;
					
				default:
					$controller = new Login();
					return $controller->LoginForm();
					break;
			}

		}catch (\Exception $e){
			error_log($e->getMessage() . "\n", 3, \Settings::$ERROR_LOG);
			
			if(\Settings::$DO_DEBUG){
				throw $e;
				
			}else{
				\view\NavigationView::RedirectToErrorPage();
				die();
			}
		}
	}
}
