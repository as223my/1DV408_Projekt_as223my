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
	
	public function getNumberAndGroup(){
		if(isset($_POST["regUsers"])){
			return array($_POST[self::$numberOfUsers], $_POST[self::$group]);
		}else{
			return null;
		}	
	}
	
	public function getUserNames($numberOfUsers){
		if(isset($_POST["regUsers"])){
			$arr  = array();
			for($i=1; $i <= $numberOfUsers; $i++){
				array_push($arr,$_POST[self::$name.strval($i)]);
			}
			return $arr;
		}
	}
	
	public function getPasswords($numberOfUsers){
		if(isset($_POST["regUsers"])){
			$arr  = array();
			for($i=1; $i <= $numberOfUsers; $i++){
				array_push($arr,$_POST[self::$password.strval($i)]);
			}
			return $arr;
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

	public function showRegistrationForm2($groupName,$numberOfUsers, array $usernames){
		$message = $this->sessionHelper->getMessage();
		
		$html = "
		<div id='RegForm2'>
		 <a href='?action=" .NavigationView::$actionRegistration. "'>Tillbaka</a>
			<h1>FamilyBook</h1>
			<h2>Registrering - Steg 2</h2>
			<form method='post' action='?action=" .NavigationView::$actionRegistration2. "'>";
				$html .= "<input type='hidden' name='" .self::$group."' value='$groupName'>
			 	<input type='hidden' name='" .self::$numberOfUsers."' value='$numberOfUsers'>";
			 	
			  	if(empty($usernames)){
					for($i=1; $i<=$numberOfUsers; $i++){
						$html .="	
						<label for='" .self::$name. "'>Användarnamn</label>
						<label for='" .self::$password. "' class = 'labelPassword'>Lösenord</label><br />
						<input type='text' name='" .self::$name."$i' maxlength='30' value=''>
						<input type='password' name='" .self::$password. "$i' maxlength='30' placeholder = '******' value=''><br />";
					}
					
			  }else{
				$numberInArray = 0;
				
				for($i=1; $i <= count($usernames); $i++){
					$html .="	
					<label for='" .self::$name. "'>Användarnamn</label>
					<label for='" .self::$password. "' class = 'labelPassword'>Lösenord</label><br />
					<input type='text' name='" .self::$name."$i' maxlength='30' value='$usernames[$numberInArray]'>
					<input type='password' name='" .self::$password. "$i' maxlength='30' placeholder = '******' value=''><br />";
					$numberInArray++;
				}
				
				$number = count($usernames) + 1;
				$usersAfter = $numberOfUsers - count($usernames);
			
				for($i=0; $i < $usersAfter; $i++){
					$html .="	
					<label for='" .self::$name. "'>Användarnamn</label>
					<label for='" .self::$password. "' class = 'labelPassword'>Lösenord</label><br />
					<input type='text' name='" .self::$name."$number' maxlength='30' value=''>
					<input type='password' name='" .self::$password. "$number' maxlength='30' placeholder = '******' value=''><br />";
					$number++;
				}
			}
			$html .=" 
			<input type='submit' name='regUsers'  value='Registrera användare' class ='regbutton2'/>
			<p>$message</p>
			
			</form>
		</div>";
		
		return $html;	
	}
	
}