<?php
namespace view;

require_once("./helpers/Session.php");

class RegistrationView{
	
	private $sessionHelper;
	
	private static $group = "group"; 
	private static $numberOfUsers = "numberOfUsers";
	private static $name = "name";
	private static $password = "password"; 
	
	
	public function __construct(){
		$this->sessionHelper = new \helpers\Session();
	}
	
	public function didUserPressRegGroup(){
		if(isset($_POST["regGroup"])){
			return array($_POST[self::$group], $_POST[self::$numberOfUsers]);
		}else{
			return null;
		}	
	}
	
	public function showRegistrationForm1(){
	$message = $this->sessionHelper->getMessage();
		
		$html = "
		<div id='RegForm1'>
		 <a href='?action=" .NavigationView::$actionLogin. "'>Tillbaka</a>
			 <h1>FamilyBook</h1>
			 <h2>Registrering - Steg 1</h2>
			 <form method='post' action='?action=" .NavigationView::$actionRegistration. "'>
				<label for='" .self::$group. "'>Grupp</label><br />
				<input type='text' name='" .self::$group. "' maxlength='50' value=''><br />	
				<label for='" . self::$numberOfUsers ."'>Antal användare</label>
				<select name='" . self::$numberOfUsers . "'>
	  				<option value='1'>1</option>
	  				<option value='2'>2</option>
	  				<option value='3'>3</option>
	  				<option value='4'>4</option>
	  				<option value='5'>5</option>
	  				<option value='6'>6</option>
	  				<option value='7'>7</option>
	  				<option value='8'>8</option>
				  </select><br />
				<input type='submit' name='regGroup'  value='Registrera Grupp' class ='regbutton'/>
				<p>$message</p>
			
			 </form>
		 </div>";
		
		return $html;
	}

	public function showRegistrationForm2($groupName,$numberOfUsers){
		$message = $this->sessionHelper->getMessage();
		
		$html = "
		<div id='RegForm2'>
		 <a href='?action=" .NavigationView::$actionRegistration. "'>Tillbaka</a>
			<h1>FamilyBook</h1>
			<h2>Registrering - Steg 2</h2>
			<h3>Grupp namn: $groupName </h3>";
			for($i=1; $i<=$numberOfUsers; $i++){
				$html .="	
				<label for='" .self::$name. "'>Användarnamn</label>
				<label for='" .self::$password. "' class = 'labelPassword'>Lösenord</label><br />
				<input type='text' name='" .self::$name."$i' maxlength='30' value=''>
				<input type='password' name='" .self::$password. "$i' maxlength='30' value=''><br />";
				}
			$html .=" 
			
				<input type='submit' name='regGroup'  value='Registrera Grupp' class ='regbutton'/>
				<p>$message</p>
			
			 </form>
		 </div>";
		
		return $html;
			
	}
	
}