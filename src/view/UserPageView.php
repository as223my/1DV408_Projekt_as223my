<?php
namespace view;

require_once("./helpers/Session.php");
require_once("./src/model/GroupsRepository.php");

class UserPageView{
	
	private $sessionHelper;
	private $readGroupRepository;
	
	private static $groupname = "groupname";
	private static $groupID = "groupID";
	private static $numberOfUsers = "numberOfUsers";
	private static $image = "image";
	private static $name = "name";
	
	public function __construct(){
		$this->sessionHelper = new \helpers\Session();
		$this->readGroupsRepository = new \model\GroupsRepository();
	}
	
	public function didUserPressRegGroup(){
		if(isset($_POST["regGroup"])){
			return array($_POST[self::$groupname], $_POST[self::$numberOfUsers]);
		}else{
			return null;
		}	
	}
	
	public function didUserPressDeleteGroup(){
		if(isset($_POST["deleteGroup"])){
			return $_POST[self::$groupname];
		}else{
			return null;
		}	
	}
		
	public function didUserPressRegUsers($numberOfUsers){
		if(isset($_POST["regUsers"])){
			$arr  = array();
			for($i=1; $i <= $numberOfUsers; $i++){
				array_push($arr,$_POST[self::$name.strval($i)]);
			}
			return $arr;
		}
	}
	
	public function getNumberAndGroup(){
		if(isset($_POST["regUsers"])){
			return array($_POST[self::$numberOfUsers], $_POST[self::$groupname]);
		}else{
			return null;
		}	
	}
	
	public function showUserPage(){
		$groups = $this->showGroups();
		$name = $this->sessionHelper->getName();
		$message = $this->sessionHelper->getMessage(); 
		$deleteMessage = $this->sessionHelper->getDeleteMessage(); 
		$html = "
		
		<div id = 'head'> <a href='?action=" .NavigationView::$actionLogout. "'>Logga ut</a>
		<h1>FamilyBook</h1>
		<h2>$name</h2>
		</div>
		<div id = 'newGroups'>";
		$html .= $groups;
		$html .= "</div>
		<div id='GroupForm'>
		<h3>Skapa ny grupp!</h3>
			 <form method='post' action='?action=" .NavigationView::$actionUserPage. "'>
				 <label for='" .self::$groupname. "'>Grupp namn</label><br />
				 <input type='text' name='" .self::$groupname. "'  maxlength='15' value=''><br />
				 <label for='" . self::$numberOfUsers ."'>Antal användare</label>
				<select name='" . self::$numberOfUsers . "'>
	  				<option value='1'>1</option>
	  				<option value='2'>2</option>
	  				<option value='3'>3</option>
	  				<option value='4'>4</option>
	  				<option value='5'>5</option>
	  				<option value='6'>6</option>
	  				<option value='7'>7</option>
				  </select><br />
				 <input type='submit' name='regGroup'  value='Skapa grupp' class ='submitbuttonCreateGroup'/>
				  <p>$message</p>
			 </form>
		 </div>
		 <div id='DeleteGroupForm'>
		 <h3> Ta bort grupp!</h3>
		 	 <form method='post' action='?action=" .NavigationView::$actionUserPage. "'>
				 <label for='" .self::$groupname. "'>Gruppens namn</label><br />
				 <input type='text' name='" .self::$groupname. "'  maxlength='15' value=''><br />
				 <input type='submit' name='deleteGroup'  value='Ta bort grupp' class ='buttonDeleteGroup'/>
				  <p>$deleteMessage</p>
			 </form>
		 </div>";
		return $html;
	}

		public function showSelectUser($groupName, $numberOfUsers, array $users){
		$countUsers = count($users); 
		$name = $this->sessionHelper->getName();
		$groups = $this->showGroups();	
		$message = $this->sessionHelper->getMessage();
		
		$html = "
		<div id = 'head'>
		 	<a href='?action=" .NavigationView::$actionLogout. "'>Logga ut</a>
			<h1>FamilyBook</h1>
			<h2>$name</h2>
		</div>
		<div id = 'newGroups'>"; 
			$html .= $groups;
			$html .= "</div>	 
		<div id='GroupForm'>
		 <a href='?action=" .NavigationView::$actionUserPage. "'>Tillbaka</a>
		 <h3>Medlemmar till $groupName</h3>
			<form method='post' action='?action=" .NavigationView::$actionUserPageSelect. "'>
			<input type='hidden' name='" .self::$groupname."' value='$groupName'>
			 <input type='hidden' name='" .self::$numberOfUsers."' value='$numberOfUsers'>";
			 		$count = 0; 
					for($i=1; $i<=$numberOfUsers; $i++){
						$html .="	
						<label for='" .self::$name. "'>$i</label>";
						if($countUsers < 1){
							$html .="<input type='text' name='" .self::$name."$i' maxlength='30' value=''><br />";
						}else{
							$html .="<input type='text' name='" .self::$name."$i' maxlength='30' value='$users[$count]'><br />";
						}
						$count ++; 
						$countUsers --;
					}			
		
		$html .="<input type='submit' name='regUsers'  value='Lägg till medlemmar' class ='submitbuttonCreateGroup1'/>
			<p>$message</p>
			
			</form>
		</div>";
		
		return $html;	
			
		}
		
	public function didUserPressShowGroup(){
		if(isset($_POST[self::$groupname])){
			return array($_POST[self::$groupname], $_POST[self::$groupID]);
		}else{
			return null;
		}	
	}
	
	
	public function showGroups(){
				
		$groups = $this->readGroupsRepository->getGroups();
			
		$html = ""; 
		foreach($groups as $value){
			$html .="<div class = 'groupDiv'>
				<form method='post' action='?action=" .NavigationView::$actionGroup. "&amp;".self::$groupname."=" .urlencode($value)."'>
					<input type='submit' name='".self::$groupname."'  value='$value' class ='groupButton'/><br />";
					$groupID = $this->readGroupsRepository->findGroupId($value);
					$members = $this->readGroupsRepository->getGroupsMemberName($groupID[0]);
					
					for($i = 0; $i < count($members); $i++){
						// users name not written out
						if($members[$i] !== $this->sessionHelper->getName()){
						$html .= "<p> $members[$i]</p>";
						}		
					}	
					$html .= "<input type='hidden' name='" .self::$groupID."' value='$groupID[0]'>
				</form>
			</div>";
		}
		return $html;	
	}
}