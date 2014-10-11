<?php
namespace controller;

require_once("./src/controller/c_userController.php");
require_once("./src/view/v_navigation.php");

class Navigation{
	
	public function doControll(){
		$controller;
		
		try {
			switch (\view\NavigationView::getAction()){
				case \view\NavigationView::$actionLoggedIn:
					$controller = new UserController();
					return $controller->addMember();
					break;
					
				default:
					$controller = new UserController();
					return $controller->showLoginForm();
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
