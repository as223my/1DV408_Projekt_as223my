<?php

namespace controller;

require_once("./src/view/RegistrationView.php");
require_once("./src/view/LoginView.php");
require_once("./src/model/User.php");
require_once("./src/model/UserRepository.php");

class RegistrationController{
	private $loginView;
	private $registrationView;
	private $user;
	private $userRepository;
	private $groupName;
	
	public function __construct(){
		
		$this->registrationView = new \view\RegistrationView();
		$this->loginView = new \view\LoginView();
		$this->user = new \model\User();
		$this->userRepository = new \model\UserRepository();
	}
	
	public function registrationForm(){
		$regformInput = $this->registrationView->didUserPressRegUser();
		$username = $regformInput[0];
		$password1 = $regformInput[1];
		$password2 = $regformInput[2];
		
		if($regformInput === null){
			return $this->registrationView->showRegistrationForm("");
		}else{
			$incorrectPassword = $this->user->checkPassword($password1,$password2); 
			$this->user->checkUserName($username); 
			if($this->user->emptyUserName() || $this->user->tagUserName() || $incorrectPassword === true){
				return $this->registrationView->showRegistrationForm($this->user->getUserName());
			}else{
				// check if user exist in database
				if($this->userRepository->checkUserName($username)){
					$this->userRepository->addUser($username, $password1);
				}else{
					return $this->registrationView->showRegistrationForm("");
				}
			return $this->loginView->showLoginForm("");	
			}
		}
	}
}
