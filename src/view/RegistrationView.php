<?php
namespace view;

require_once("./helpers/Session.php");

class RegistrationView{
	
	private $sessionHelper;
	
	private static $username = "username";
	private static $password = "password";
	private static $password2 = "password2";
	
	
	public function __construct(){
		$this->sessionHelper = new \helpers\Session();
	}
	
	public function didUserPressRegUser(){
		if(isset($_POST["regUser"])){
			return array($_POST[self::$username], $_POST[self::$password], $_POST[self::$password2]);
		}else{
			return null;
		}	
	}
	
	public function showRegistrationForm($name){
	$message = $this->sessionHelper->getMessage();
		
		$html = "
		<div id='RegForm'>
		 <a href='?action=" .NavigationView::$actionLogin. "'>Tillbaka</a>
			 <h1>FamilyBook</h1>
			 <h2>Registrera ny användare</h2>
			 <form method='post' action='?action=" .NavigationView::$actionRegistration. "'>
				 <label for='" .self::$username. "'>Användarnamn</label><br />
				 <input type='text' name='" .self::$username. "'  maxlength='50' value='$name'><br />
				 <label for='" . self::$password . "' >Lösenord</label><br />
				 <input type='password' name='" .self::$password. "'placeholder = '******' maxlength='50' value=''><br />		
				 <label for='" . self::$password2 . "' >Upprepa lösenord</label><br />
				 <input type='password' name='" .self::$password2. "' placeholder = '******' maxlength='50' value=''><br />
				 <input type='submit' name='regUser'  value='Registrera' class ='regbutton'/>
				  <p>$message</p>
			 </form>
		 </div>";
		
		return $html;
	}	
}