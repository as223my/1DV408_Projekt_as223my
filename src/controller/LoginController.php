<?php

namespace controller;

require_once("./src/view/LoginView.php");

class LoginController{
	
	private $loginView;
	
	public function __construct(){
		
		$this->loginView = new \view\LoginView();
	}
	
	public function LoginForm(){
		
		return $this->loginView->showLoginForm();
	}

}
