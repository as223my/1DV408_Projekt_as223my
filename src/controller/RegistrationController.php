<?php

namespace controller;

require_once("./src/view/RegistrationView.php");
require_once("./src/model/User.php");
require_once("./src/model/UserRepository.php");

class RegistrationController{
	
	private $registrationView;
	private $user;
	private $userRepository;
	private $groupName;
	
	public function __construct(){
		
		$this->registrationView = new \view\RegistrationView();
		$this->user = new \model\User();
		$this->userRepository = new \model\UserRepository();
	}
	
	public function RegistrationForm(){
		$regformInput = $this->registrationView->didUserPressRegGroup();
		$groupname = $regformInput[0];
		$numberOfUsers = $regformInput[1];
		
		if($regformInput === null){
			return $this->registrationView->showRegistrationForm1();
		}else{
			
			if($this->user->checkGroupName($groupname) && !$this->user->tagInInput()){
				
				if($this->userRepository->checkGroupName($this->user)){
					return $this->registrationView->showRegistrationForm1();
				}else{
					return $this->registrationView->showRegistrationForm2($groupname,$numberOfUsers);
				}
			}else{
				return $this->registrationView->showRegistrationForm1();
			}
	
			
		}
	}
	
}
