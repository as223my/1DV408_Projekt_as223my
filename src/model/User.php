<?php
namespace model;

require_once("./helpers/Session.php");

class User{
	
	private $sessionMessage;
	
	private $groupName;
	private $numberOfUsers;
	private $tagGroupName;
	
	private $tagUserName;
	private $emptyUserName;
	private $okUsername = array();
	
	
	public function __construct(){
		$this->sessionMessage = new \helpers\Session(); 
	}
	 
	public function checkGroupName($input){ 
	    $checkedInput = $this->checkForTagsGroupName($input);
	    
		if(strlen($input) >= 1){
			$this->groupName = $checkedInput;
			return true;
			
		}else{
			$this->sessionMessage->setMessage("Gruppnamn saknas!");
			return false;
		}
	}
	
	public function checkUserNames(array $names){
		foreach ($names as $value) {
			if($value === ""){
				$this->emptyUserName = true;
			}
  			$checkedInput = $this->checkForTagsUserName($value);
			if($checkedInput !== ""){
				array_push($this->okUsername,$checkedInput);
			}
		}	
	}

	public function userNameUnique(){
		if(count($this->okUsername) != count(array_unique($this->okUsername))){
			$this->sessionMessage->setMessage("Användarnamnen måste vara unika!");
  			return true;
		}
	}
	
	public function checkPasswords(array $passwords){
		foreach($passwords as $value){	    
			if(strlen($value) < 3){
				$this->sessionMessage->setMessage("Lösenorden måste minst innehålla 3 tecken!");
				return true;
			}
		}
		
	}
	
	public function checkForTagsGroupName($input){
		if(strip_tags($input) === $input){
			$this->tagGroupName = false;
			return $input; 
	
		}else{
			$this->tagGroupName = true;
			return strip_tags($input);
		}
	}
	
	public function checkForTagsUserName($input){
		if(strip_tags($input) === $input){
			return $input;
	
		}else{
			$this->tagUserName = true;
			return "";
		}
	}
	
	public function tagInGroupName(){
		if($this->tagGroupName === true){
			$this->sessionMessage->setMessage("Gruppnamnet innehåller ogiltliga tecken!");
			return true;
		}
	    return false;
	}
	
	public function tagUserName(){
		if($this->tagUserName === true){
			$this->sessionMessage->setMessage("Användarnamn som innehåller ogiltliga tecken borttagna!");
			return true;
		}
		return false;
	}
	
	public function emptyUserName(){
		if($this->emptyUserName === true){
			$this->sessionMessage->setMessage("Alla användarnamn måste vara ifyllda!");
			return true;
		}
		return false;
	}
	
	public function getokUsernames(){
		return $this->okUsername;
	}

}