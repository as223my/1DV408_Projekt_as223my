<?php
namespace controller;

require_once("./src/controller/LoginController.php");
require_once("./src/controller/UserPageController.php");
require_once("./src/controller/RegistrationController.php");
require_once("./src/view/NavigationView.php");

class NavigationController{
	
	public function doControll(){
		$controller;
		
		try {
			switch (\view\NavigationView::getAction()){
				case \view\NavigationView::$actionRegistration:
					$controller = new RegistrationController();
					return $controller->RegistrationForm1();
					break;
				case \view\NavigationView::$actionRegistration2:
					$controller = new RegistrationController();
					return $controller->RegistrationForm2();
					break;
				case \view\NavigationView::$actionUserPage:
					// login - securitycheck
					$controller1 = new LoginController();
					$result = $controller1->checkLogin();
					if($result === true){
						$controller2 = new UserPageController();
						return $controller2->test();
					}else{
						return $result;
					}
					break;
					
				default:
					$controller = new LoginController();
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
