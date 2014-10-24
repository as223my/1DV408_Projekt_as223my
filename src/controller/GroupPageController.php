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
	
	/*
	 * Kontrollerar vad som sker i gruppsidan.
	 * Meddelanden och stickyn notes läggs till och tas bort från databasen.
	 * Skickar med gruppens namn, medlemmarnas namn som tillhör gruppen samt användarens namn.
	 */
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
		$checkboxNotice = $this->grouppageView->checkboxNotice(); 
		
		if($text !== null &&  $text !== ""){
			
			if($checkboxNotice !== null){
				$time = time()+3600*24*$checkboxNotice; 
				$this->groupContentRepository->addStickynote(nl2br($text, false),$time, $groupId, $userId); 
				
			}else{
				$this->groupContentRepository->addText(nl2br($text, false),$groupId,$userId); 
			}
		}
		
		$deleteTextID = $this->grouppageView->getTextID();
		
		if($deleteTextID !== null){
			$this->groupContentRepository->deleteText($deleteTextID);
		}
		
		$deleteStickyID = $this->grouppageView->getStickyID();
		
		if($deleteStickyID !== null){
			$this->groupContentRepository->deleteSticky($deleteStickyID);
		}
		
		return $this->grouppageView->showGroupPage($groupName, $this->groupsRepository->getGroupsMemberName($groupId),$this->userRepository->getUserName($userId));	
	}
}
