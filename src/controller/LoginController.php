<?php

namespace controller;

require_once("./src/view/LoginView.php");

class LoginController{
	
	private $loginView;
	
	public function __construct(){
		
		$this->loginView = new \view\LoginView();
	}
	
	public function LoginForm(){
		
		if($this->loginView->didUserPressLogin()){
			
			//Validera input i model
			//cookies? 
			//Lägg medelande i sessionhelper
			
		}else{
			return $this->loginView->showLoginForm();
		}
	}

}
