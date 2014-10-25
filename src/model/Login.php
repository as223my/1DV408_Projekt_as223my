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
	
	// kontrollerar användar uppgifter vid login.  
	public function checkUserCredentialsLogin($username, $password){
		if($username == ""){
			$this->sessionHelper->setMessage("Användarnamn saknas!");
			return false;
		}
		
		if($password == ""){
			$this->sessionHelper->setMessage("Lösenord saknas!");
			return false;
		}
			
		$result = $this->userRepository->checkUser($username,md5($password));
		
		if(empty($result)){
			$this->sessionHelper->setMessage("Fel lösenord/användarnamn!");
			return false;
		}else{
			$this->sessionHelper->setId($result[0]);
			$this->sessionHelper->setName($username);
			$_SESSION['username'] = $username;
			return true;
		}
	}
	
	// kontrollerar användar uppgifter vid inloggning mha kakor.  
	public function checkUserCredentials($username, $password, $cookieTime){
		
		$result = $this->userRepository->checkUser($username,$password);
		
		if(empty($result) || $cookieTime === false){
			$this->sessionHelper->setMessage("Fel på cookies!");
			return false;
		}else{
			$this->sessionHelper->setId($result[0]);
			$this->sessionHelper->setName($username);
			$_SESSION['username'] = $username;
			return true;
		}
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
	
	public function sessionDestroy(){
		session_destroy();
	}
}

