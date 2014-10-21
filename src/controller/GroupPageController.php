<?php
namespace controller;

require_once("./src/view/UserPageView.php");
require_once("./src/view/GroupPageView.php");
require_once("./src/model/GroupsRepository.php");
require_once("./src/model/GroupContentRepository.php");
require_once("./src/model/UserRepository.php");
require_once("./helpers/Session.php");

class GroupPageController{
	
	private $userpageView;
	private $grouppageView;
	private $groupsRepository;
	private $userRepository;
	private $groupContentRepository;
	private $sessionHelper;
	
	public function __construct(){
		
		$this->userpageView = new \view\UserPageView();
		$this->grouppageView = new \view\GroupPageView();
		$this->groupsRepository = new \model\GroupsRepository();
		$this->userRepository= new \model\UserRepository();
		$this->groupContentRepository = new \model\GroupContentRepository();
		$this->sessionHelper = new \helpers\Session();
	
	}
	
	public function groupPage(){
		$regGroupInput = $this->userpageView->didUserPressShowGroup();
		if($regGroupInput !== null){
			$this->sessionHelper->setGroupName($regGroupInput[0]); 
			$this->sessionHelper->setGroupId($regGroupInput[1]); 
		}
		
		$groupName = $this->sessionHelper->getGroupName();
		$groupId = $this->sessionHelper->getGroupId();
		$userId = $this->sessionHelper->getId();
		
		$text = $this->grouppageView->getText();
			if($text !== null &&  $text !== ""){
				$this->groupContentRepository->addText($text,$groupId,$userId); 
			}
		
		$deleteText = $this->grouppageView->deleteText(); 
		
		if($deleteText !== null){
			$this->groupContentRepository->deleteText($deleteText, $groupId, $userId);
		}
		
		return $this->grouppageView->showGroupPage($groupName, $this->groupsRepository->getGroupsMemberName($groupId),$this->userRepository->getUserName($userId));
		
	}
}
