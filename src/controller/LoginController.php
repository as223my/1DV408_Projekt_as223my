<?php

namespace controller;

require_once("./src/view/LoginView.php");
require_once("./src/model/Login.php");

class LoginController{
	
	private $loginView;
	private $loginModel;
	
	public function __construct(){
		$this->loginView = new \view\LoginView();
		$this->loginModel = new \model\Login();
	}
	
	public function logout(){
		$this->loginView->checkCookiesDeleted();
		$this->loginModel->sessionDestroy();
		return $this->loginView->showLoginForm("");
	}
	
	/*
	 *  Kontrollerar om man är inloggad (returnar då true).
	 * 	Om felaktiga/manipulerade uppgifter finns i kakorna eller om session stöld förekommigt, loggas man ut. 
	 */
	public function checkLogin(){
	
		if($this->loginModel->session($this->loginView->getHttpUserAgent()) === false){
			$this->loginModelmodel->sessionDestroy();
			return $this->loginView->showLoginForm(""); 
		}
		 
		if($this->loginModel->checkLoggedInSession()){
			return true; 
		}
		
		if(!$this->loginModel->checkLoggedInSession()){
			$cookies = $this->loginView->checkLoggedInCookies();
			if($cookies !== null){
				$username = $cookies[0];
				$password = $cookies[1];
				$cookieTime = $this->loginView->checkTimeStampCookie();
				
				if($this->loginModel->checkUserCredentials($username, $password, $cookieTime)){
					return true;
				}else{
					return $this->loginView->showLoginForm("");
				}
			}
		}
	
		return $this->loginView->showLoginForm(""); 
	}
	
	/*
	 * Om man redan är inloggad skickas man vidare till sin användarsida (userpage),
	 * om inte så kontrolleras inloggningsformuläret med dess uppgifter. 
	 */
	public function loginForm(){

		if($this->checkLogin() === true){
			\view\NavigationView::RedirectToUser();
		}else{
			
			$loginformInput = $this->loginView->didUserPressLogin();
			
			if($loginformInput === null){
				return $this->loginView->showLoginForm("");
			}
			
			$username = $loginformInput[0];
			$password = $loginformInput[1]; 
		
			if($this->loginModel->checkUserCredentialsLogin($username, $password)){
					$this->loginView->checkbox();
		
				\view\NavigationView::RedirectToUser();
			}else{	
				return $this->loginView->showLoginForm($username);
			}
		}
	}

}
