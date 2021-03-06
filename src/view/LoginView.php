<?php
namespace view;

require_once("./helpers/Session.php");
require_once("./helpers/CookieStorage.php");

class LoginView{
	
	private $sessionHelper;
	private $cookies;
	
	private static $username = "username";
	private static $password = "password";
	private static $checkbox = "checkbox"; 
	
	public function __construct(){
		$this->sessionHelper = new \helpers\Session();
		$this->cookies = new \helpers\CookieStorage();
	}
	
	public function getHttpUserAgent(){
		return $_SERVER["HTTP_USER_AGENT"];
	}
	
	public function didUserPressLogin(){
		if(isset($_POST["login"])){
			return array($_POST[self::$username], $_POST[self::$password]);
		}else{
			return null;
		}	
	}
	
	// Om checkbox är ikryssad så spara kakor med användarnamn och lösenord. 
	public function checkbox(){
		if(isset($_POST["checkbox"])){
			$this->cookies->saveCookies($_POST[self::$username], $_POST[self::$password]);
		}	
	}
	
	// kollar om man kakor finns tillgängliga för inloggning. 
	public function checkLoggedInCookies(){
		$cookies = $this->cookies->getCookies();
		
		if($cookies === null){
			return null;
		}else{
			return $cookies;
		}	
	}
	
	public function checkTimeStampCookie(){
		return $this->cookies->checkTime();
	}
	
	public function checkCookiesDeleted(){
		return $this->cookies->deleteCookies();
	}
	
	// returnerar html till login formuläret, om något är fel på kakorna som är satta raderas de.
	public function showLoginForm($username){
		
		$message = $this->sessionHelper->getMessage();
		
		if($message === "Fel på cookies!"){
			$this->checkCookiesDeleted();
		}
		
		$html = "
		<div id='LoginForm'>
		 	<a href='?action=" .NavigationView::$actionRegistration. "'>Ny användare?</a>
			<h1>FamilyBook</h1>
			<h2>Login</h2>
			 <form method='post' action='?action=" .NavigationView::$actionLogin. "'>
				 <label for='" .self::$username. "'>Användarnamn</label><br />
				 <input type='text' name='" .self::$username. "' id='" .self::$username. "' maxlength='50' value='$username'><br />
				 <label for='" . self::$password . "' >Lösenord</label><br />
				 <input type='password' name='" .self::$password. "' id='" .self::$password. "' maxlength='50' value=''>
				 <label for='" .self::$checkbox. "'>Håll mig inloggad</label>
				 <input type='checkbox' name='" .self::$checkbox. "' id='" .self::$checkbox. "' class = 'checkbox'>	
				 <input type='submit' name='login'  value='Logga in' class ='submitbutton'/>
				 <p>$message</p>
			 </form>
		 </div>";
		
		return $html;
	}
}
