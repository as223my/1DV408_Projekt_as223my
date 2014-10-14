<?php
namespace view;

require_once("./helpers/Session.php");

class LoginView{
	
	private $sessionHelper;
	
	private static $group = "group";
	private static $username = "username";
	private static $password = "password";
	private static $checkbox = "checkbox"; 
	
	public function __construct(){
		$this->sessionHelper = new \helpers\Session();
	}
	
	public function didUserPressLogin(){
		if(isset($_POST["login"])){
			return array($_POST[self::$group], $_POST[self::$username], $_POST[self::$password], $_POST[self::$checkbox]);
		}else{
			return null;
		}	
	}
	public function showLoginForm(){
		
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
