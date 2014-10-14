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
	
	public function RegistrationForm1(){
		$regformInput = $this->registrationView->didUserPressRegGroup();
		$groupname = $regformInput[0];
		$numberOfUsers = $regformInput[1];
		
		if($regformInput === null){
			return $this->registrationView->showRegistrationForm1();
		}else{
			
			if($this->user->checkGroupName($groupname) && !$this->user->tagInGroupName()){
				
				if($this->userRepository->checkIfGroupNameExists($groupname, $numberOfUsers)){
					return $this->registrationView->showRegistrationForm1();
				}else{
					return $this->registrationView->showRegistrationForm2($groupname,$numberOfUsers, array());
				}
			}else{
				return $this->registrationView->showRegistrationForm1();
			}
		}
	}
	
	public function RegistrationForm2(){

		$numberAndGroup = $this->registrationView->getNumberAndGroup();
		if($numberAndGroup === null){
			\view\NavigationView::RedirectHome(); 
		}
		$numberOfUsers = $numberAndGroup[0];
		$groupName = $numberAndGroup[1];
		$userNames = $this->registrationView->getUserNames($numberOfUsers);
		$passwords = $this->registrationView->getPasswords($numberOfUsers);
		
		$this->user->checkUserNames($userNames);
		$this->user->checkPasswords($passwords);
		if($this->user->tagUserName() || $this->user->emptyUserName() || $this->user->checkPasswords($passwords) || $this->user->userNameUnique()){
			return $this->registrationView->showRegistrationForm2($groupName,$numberOfUsers, $this->user->getokUsernames());
		}else{
			$this->userRepository->addGroup($groupName);
			$groupID = $this->userRepository->findGroupId($groupName);
			$this->userRepository->addUsers($userNames,$passwords, $numberOfUsers, $groupID[0], $groupName);
			return $this->loginView->showLoginForm();
		}
		
	}
}
