<?php
namespace model;

require_once("./helpers/Session.php");
require_once("./src/model/UserRepository.php");

class Login{
	
	private $sessionHelper;
	private $userRepository;
	
	public function __construct(){
		
		$this->sessionHelper = new \helpers\Session();
		$this->userRepository = new \model\UserRepository();
	}
	
	public function checkLoggedInSession(){
		if(!isset($_SESSION['username'])){
	 	 	return false; 
		}else{
			return true;
		} 
	}
	
	public function checkUserCredentialsLogin($groupname, $username, $password){
		$groupId = $this->userRepository->findGroupId($groupname);
		if(empty($groupId)){;
			$this->sessionHelper->setMessage("Ingen grupp finns med det namnet!");
			return false;
		}else{
			$result = $this->userRepository->checkUser($username,md5($password),$groupId[0]);
			if(empty($result)){
				$this->sessionHelper->setMessage("Fel lösenord/användarnamn!");
				return false;
			}else{
				$this->sessionHelper->setId($result[0]);
				$_SESSION['username'] = $username;
				return true;
			}
		}
		
	}
	
	public function checkUserCredentials($username, $password, $groupname, $cookieTime){
		$cookieWrong = "Fel på cookies!";
		$groupId = $this->userRepository->findGroupId($groupname);
		if(empty($groupId)){
			$this->sessionHelper->setMessage($cookieWrong);
			return false;
		}else{
			
			$result = $this->userRepository->checkUser($username,$password,$groupId[0]);
			if(empty($result) || $cookieTime === false){
				$this->sessionHelper->setMessage($cookieWrong);
				return false;
			}else{
				$this->sessionHelper->setId($result[0]);
				$_SESSION['username'] = $username;
				return true;
			}
		}
	}
	
	public function sessionDestroy(){
		session_destroy();
	}
	
	public function session($httpUserAgent){
	
		if(isset($_SESSION['httpUserAgent']) === false){
			$_SESSION["httpUserAgent"] = $httpUserAgent;
			return true;
		}
	
		if($_SESSION['httpUserAgent'] !== $httpUserAgent){
			return false;
		}
	}
	
	
}

