<?php

namespace controller;

require_once("./src/view/UserPageView.php");
require_once("./src/model/UserRepository.php");
require_once("./src/model/GroupsRepository.php");
require_once("./helpers/Session.php");

class UserPageController{
	private $userpageView;
	private $userRepository;
	private $groupRepository;
	private $session; 
	
	public function __construct(){
		
		$this->userpageView = new \view\UserPageView();
		$this->userRepository = new \model\UserRepository();
		$this->groupRepository = new \model\GroupsRepository();
		$this->session = new \helpers\Session();
	
	}
	
	/*
	 * Hämtar de grupper som finns registrerat hos användaren. 
	 * Kontrollerar om skapa eller radera grupp har valts. 
	 * Returnerar olika vyer beroende av resultat. 
	 */
	public function userPage(){
		
		$getGroups = $this->groupRepository->getGroups();
		$deleteGroup = $this->userpageView->didUserPressDeleteGroup();
	
		if($deleteGroup !== null){
			
			$groupID = $this->groupRepository->findGroupId($deleteGroup);
			$group = $this->groupRepository->checkIfMemberHasGroup($groupID[0]);
			
			if(empty($groupID) || empty($group)){
				$this->session->setMessageDelete("Det finns ingen grupp med det namnet!");
			}else{
				$this->groupRepository->deleteGroupFromMember($groupID[0]); 
				$this->session->setMessageDelete("Gruppen $deleteGroup är borttagen!");
			}
		}

		$regGroupInput = $this->userpageView->didUserPressRegGroup();
		
		$groupName = $regGroupInput[0];
		$numberOfUsers = $regGroupInput[1];

		if($groupName == "" || $this->groupRepository->checkIfGroupNameExists($groupName)){
			return $this->userpageView->showUserPage($getGroups);
		}else{
			return $this->userpageView->showSelectUser($groupName,$numberOfUsers, array());
		}
	}
	
	/*
	 * Om skapa ny grupp har valts, kontrolleras de valda användarna. 
	 * Användarna måste finnas registrerade i databasen och man kan inte skapa en grupp med sig själv som medlem. 
	 * Om allt stämmer skapas en ny grupp och de valda användarna läggs till gruppen, annars så sätts felmeddelande och användaren får en ny chans att göra rätt.
	 */
	public function userPageSelect(){
	
		$getGroups  = $this->groupRepository->getGroups();
		$NumberAndGroup = $this->userpageView->getNumberAndGroup(); 
		$arrUserID = array(); 
		$arrUserName = array();
		 
		if($NumberAndGroup !== null){
			$number = $NumberAndGroup[0];
			$group = $NumberAndGroup[1];
			
			$regUsers = $this->userpageView-> didUserPressRegUsers($number);
	
			foreach($regUsers as $username){
				
				if($username == $this->session->getName()){
					$this->session->setMessage("Du kan inte bilda grupp med dig själv!");
					return $this->userpageView->showSelectUser($group,$number, array());
				}
				
				$result = $this->userRepository->checkIfUserExist($username);
				
				if(!empty($result)){
					array_push($arrUserID,$result);
					array_push($arrUserName,$username);
				} 
			}
			
			if(count($arrUserID) == $number){
				$this->groupRepository->addGroup($group);
				$groupID = $this->groupRepository->findGroupId($group);
				array_push($arrUserID,array($this->session->getId()));
				
				foreach ($arrUserID as $value) {
					$this->userRepository->addUserToGroup($value, $groupID[0], $group);
				}
			
				return $this->userpageView->showUserPage($getGroups);

			}else{
				return $this->userpageView->showSelectUser($group,$number, $arrUserName);
			}
			
		}else{
			return $this->userpageView->showUserPage($getGroups);	
		}
	}
}
