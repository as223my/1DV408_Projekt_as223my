<?php
namespace model;

require_once("./helpers/Session.php");

class User{
	
	private $sessionMessage;
	private $groupName;
	private $tag;

	public function __construct(){
		$this->sessionMessage = new \helpers\Session(); 
	}
	 
	public function checkGroupName($input){ 
	    $checkedInput = $this->checkForTags($input);
	    
		if(strlen($input) >= 1){
			$this->groupName = $checkedInput;
			return true;
			
		}else{
			$this->sessionMessage->setMessage("Gruppnamn saknas!");
			return false;
		}
	}
	
	public function checkForTags($input){
		if(strip_tags($input) === $input){
			$this->tag = false;
			return $input; 
	
		}else{
			$this->tag = true;
			return strip_tags($input);
		}
	}
	
	public function tagInInput(){
		if($this->tag === true){
			$this->sessionMessage->setMessage("Gruppnamnet innehåller ogiltliga tecken!");
			return true;
		}
	    return false;
	}
	
	public function getGroupName(){
		return $this->groupName;
	}
}