<?php

namespace controller;

require_once("./src/view/v_loginView.php");

class Login{
	
	private $loginView;
	
	public function __construct(){
		
		$this->loginView = new \view\LoginView();
	}
	
	public function LoginForm(){
		
		return $this->loginView->showLoginForm();
	}

}
