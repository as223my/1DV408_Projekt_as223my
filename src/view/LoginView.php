<?php
namespace view;

require_once("./helpers/Session.php");

class LoginView{
	
	private $sessionHelper;
	
	private static $name = 'name';
	
	public function __construct(){
		$this->sessionHelper = new \helpers\Session();
		
	}
	public function showLoginForm(){
		
		$message = $this->sessionHelper->getMessage();
		
		$html = "<div id='LoginForm'>
		 <h1>Lägg till medlem</h1>
		 <form method='post' action='?action=".NavigationView::$actionUserPage."'>
		 <label for='" . self::$name . "'>Förnamn: </label>
		 <input type='text' name='" . self::$name . "' placeholder='Förnamn' maxlength='30' value=''><br />
		 <label for='" . self::$name . "'>Efternamn: </label>
		 <input type='text' name='" . self::$name . "' placeholder='Efternamn' maxlength='60' value=''><br />	
		 <label for='" . self::$name . "'>Personnummer : </label>
		 <input type='text' name='" . self::$name . "' placeholder='xxxxxxxxxx' maxlength='10' value=''><br /><br />
		 <input type='submit' value='Lägg till Medlem' />
		 </form>
		 <p>$message</p>
		 </div>";
		
		return $html;
	}
	
	
}
