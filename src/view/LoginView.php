<?php
namespace view;

require_once("./helpers/Session.php");
require_once("./helpers/CookieStorage.php");

class LoginView{
	
	private $sessionHelper;
	private $cookies;
	
	private static $group = "group";
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
			return array($_POST[self::$group], $_POST[self::$username], $_POST[self::$password]);
		}else{
			return null;
		}	
	}
	
	public function checkbox(){
		if(isset($_POST["checkbox"])){
			$this->cookies->saveCookies($_POST[self::$group], $_POST[self::$username], $_POST[self::$password]);
		}	
	}
	
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
	
	public function showLoginForm(){
		$this->cookies->deleteCookies();
		
		$message = $this->sessionHelper->getMessage();
		
		$html = "
		<div id='LoginForm'>
		 <a href='?action=" .NavigationView::$actionRegistration. "'>Ny användare?</a>
			 <h1>FamilyBook</h1>
			 <h2>Login</h2>
			 <form method='post' action='?action=" .NavigationView::$actionLogin. "'>
				 <label for='" .self::$group. "'>Grupp</label><br />
				 <input type='text' name='" .self::$group. "' maxlength='50' value=''><br />
				 <label for='" .self::$username. "'>Användarnamn</label><br />
				 <input type='text' name='" .self::$username. "'  maxlength='50' value=''><br />
				 <label for='" . self::$password . "' >Lösenord</label><br />
				 <input type='text' name='" .self::$password. "' maxlength='50' value=''>
				  <label for='" .self::$checkbox. "'>Håll mig inloggad</label>
				 <input type='checkbox' name='" .self::$checkbox. "'class = 'checkbox'>	
				 <input type='submit' name='login'  value='Logga in' class ='submitbutton'/>
				  <p>$message</p>
			 </form>
		 </div>";
		
		return $html;
	}
	
	
}
