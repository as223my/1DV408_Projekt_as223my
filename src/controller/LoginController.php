<?php

namespace controller;

require_once("./src/view/LoginView.php");
require_once("./src/model/Login.php");
require_once("./src/view/LoginView.php");

class LoginController{
	
	private $loginView;
	private $loginModel;
	
	public function __construct(){
		
		$this->loginView = new \view\LoginView();
		$this->loginModel = new \model\Login();
	}
	
	public function checkLogin(){
		// Ser till så att man som inloggad är skyddad mot sessionstöld i en annan typ av webbläsare. 
		if($this->loginModel->session($this->loginView->getHttpUserAgent()) === false){
			$this->loginModelmodel->sessionDestroy();
			return $this->loginView->showLoginForm(); 
		}
		// kolla om inloggad via session och kakor 
		if($this->loginModel->checkLoggedInSession()){
			return true; 
		}
		
		if(!$this->loginModel->checkLoggedInSession()){
			$cookies = $this->loginView->checkLoggedInCookies();
			if($cookies !== null){
				$groupname = $cookies[0];
				$username = $cookies[1];
				$password = $cookies[2];
				$cookieTime = $this->loginView->checkTimeStampCookie();
				
				if($this->loginModel->checkUserCredentials($username, $password, $groupname, $cookieTime)){
					return true;
				}else{
					return $this->loginView->showLoginForm();
				}
			}
		}
	
		return $this->loginView->showLoginForm(); 
	}
	
	public function loginForm(){

		if($this->checkLogin() === true){
			\view\NavigationView::RedirectToUser();
		}else{
		
		$loginformInput = $this->loginView->didUserPressLogin();
		
		if($loginformInput === null){
			return $this->loginView->showLoginForm();
		}
		
		$groupname = $loginformInput[0];
		$username = $loginformInput[1];
		$password = $loginformInput[2]; 
	
		
		if($this->loginModel->checkUserCredentialsLogin($groupname, $username, $password)){
				$this->loginView->checkbox();
	
			\view\NavigationView::RedirectToUser();
		}else{
			return $this->loginView->showLoginForm();
		}
		}
	}

}
