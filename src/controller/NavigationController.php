<?php
namespace controller;

require_once("./src/controller/LoginController.php");
require_once("./src/controller/UserPageController.php");
require_once("./src/controller/RegistrationController.php");
require_once("./src/controller/GroupPageController.php");
require_once("./src/view/NavigationView.php");

class NavigationController{
	
	public function doControll(){
		
		try {
			
			switch (\view\NavigationView::getAction()){
				case \view\NavigationView::$actionRegistration:
					$controller = new RegistrationController();
					return $controller->registrationForm();
					break;
					
				case \view\NavigationView::$actionUserPage:
					// login - securitycheck
					$controller1 = new LoginController();
					$result = $controller1->checkLogin();
					if($result === true){
						$controller2 = new UserPageController();
						return $controller2->userPage();
					}else{
						return $result;
					}
					break;
					
				case \view\NavigationView::$actionUserPageSelect:
					// login - securitycheck
					$controller1 = new LoginController();
					$result = $controller1->checkLogin();
					if($result === true){
						$controller2 = new UserPageController();
						return $controller2->userPageSelect();
					}else{
						return $result;
					}
					break;
					
				case \view\NavigationView::$actionGroup:
					// login - securitycheck
					$controller1 = new LoginController();
					$result = $controller1->checkLogin();
					if($result === true){
						$controller2 = new GroupPageController();
						return $controller2->groupPage();
					}else{
						return $result;
					}
					break;
					
				case \view\NavigationView::$actionLogout:
					$controller = new LoginController();
					return $controller->logout();
					break;
					
				default:
					$controller = new LoginController();
					return $controller->loginForm();
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
