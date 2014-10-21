<?php
namespace model;

require_once("./helpers/Session.php");

class User{
	
	private $sessionMessage;
	
	private $tagUserName;
	private $emptyUserName;
	private $userName; 

	public function __construct(){
		$this->sessionMessage = new \helpers\Session(); 
	}
	 
	public function checkUserName($name){
		if($name === ""){
			$this->emptyUserName = true;
		}
			$this->checkForTagsUserName($name);	
	}

	public function emptyUserName(){
		if($this->emptyUserName == true){
			$this->sessionMessage->setMessage("Användarnamn måste vara ifylld!");
			return true;
		}
		return false;
	}
	
	public function checkPassword($password, $password2){
		if($password !== $password2){
			$this->sessionMessage->setMessage("Lösenorden matchar inte!");
			return true;	
		}

		if(strlen($password) < 3){
			$this->sessionMessage->setMessage("Lösenordet måste minst innehålla 3 tecken!");
			return true;
		}
	}
	
	public function checkForTagsUserName($name){
		if(strip_tags($name) === $name){
			$this->userName = $name; 
		}else{
			$this->userName = strip_tags($name);
			$this->tagUserName = true;
		}
	}
	
	public function tagUserName(){
		if($this->tagUserName == true){
			$this->sessionMessage->setMessage("Användarnamnet får inte innehålla ogiltliga tecken!");
			return true;
		}
		return false;
	}

	public function getUserName(){
		return $this->userName;
	}
}