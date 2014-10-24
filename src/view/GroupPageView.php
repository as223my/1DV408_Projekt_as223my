<?php
namespace view;

require_once("./src/model/GroupContentRepository.php");

class GroupPageView{
	
	private $groupContentRepository;
	
	private static $groupname = "groupname";
	private static $text = "text";
	private static $textID = "textID"; 
	private static $stickyID = "stickyID";
	private static $checkboxNotice = "checkboxNotice"; 
	private static $numberOfDays = "days"; 
	
	public function __construct(){
		$this->groupContentRepository = new \model\GroupContentRepository();
	}
	
	// returnerar texten från textarean, när skapa nytt meddelande valts. 
	public function getText(){
		if(isset($_POST["saveText"])){
			return $_POST[self::$text];
		}else{
			return null;
		}	
	}
	
	public function getTextID(){
		if(isset($_POST["deleteText"])){
			return $_POST[self::$textID];
		}else{
			return null;
		}	
	}
	
	// returnar hur många dagar sticky noten ska finnas. 
	public function checkboxNotice(){
		if(isset($_POST[self::$checkboxNotice])){
			return $_POST[self::$numberOfDays]; 
		}else{
			return null;
		}
	}
	
	public function getStickyID(){
		if(isset($_POST["deleteSticky"])){
			return $_POST[self::$stickyID];
		}else{
			return null;
		}	
	}
	
	/*
	 * Läser från databasen om gruppens innehåll (meddelanden i chatten, stickynotes).
	 * Returnerar html till gruppsidan.
	 */ 	
	public function showGroupPage($groupname, array $groupsMemberName, $userName){
		
		$textToGroup = $this->groupContentRepository->getText();
		$textID = $this->groupContentRepository->getTextID();
		$nameToGroup = $this->groupContentRepository->getUserText(); 
		
		$stickyNote = $this->groupContentRepository->getStickyNote(); 
		$stickyID = $this->groupContentRepository->getStickyID(); 
		$nameToStickyNote = $this->groupContentRepository->getStickyNoteUser(); 
		
		$html = "
		<div id = 'containerGroup'>
			<div id = 'headGroup'>
				<a href='?action=" .NavigationView::$actionLogout. "' class = 'logoutGroup'>Logga ut</a>
				<a href='?action=" .NavigationView::$actionUserPage. "' class = 'backGroup'>Tillbaka</a>
				<h1>FamilyBook</h1>
			</div>
			<div id = 'userDiv'>
				<h2>$groupname</h2>
				<ul>";
					foreach($groupsMemberName as $value){
						$html .= "<li>$value</li>"; 
					}
				
				$html .= "</ul></div>
				<div id = 'GroupMessage'>
					<div id = 'messageDiv'>";
						for($i=0;$i<count($nameToGroup);$i++){
							if($nameToGroup !== ""){
								
								// Om användarnamnet till texten från databasen är samma som användaren, skapas rättigheter att ta bort meddelandet. 
								if($nameToGroup[$i] == $userName){
								
								$html .= "<div class = 'textMessage1'><form method='post' action='?action=" .NavigationView::$actionGroup. "&amp;".self::$groupname."=" .urlencode($groupname)."'>
								<input type='submit' name='deleteText'  value='Ta bort' class ='deleteText'/>
								<input type='hidden' name='" .self::$textID."' value='$textID[$i]'>		
								<p class = 'userNameGroup1'>$nameToGroup[$i]</p><p class = 'textGroup'>$textToGroup[$i]</p>	
								</form></div>"; 
							}else{
								$html .= "<div class = 'textMessage'><p class = 'userNameGroup'>$nameToGroup[$i]</p><p class = 'textGroup'>$textToGroup[$i]</p></div>"; 
							}
						}
					}
					
					$html .= "</div>
						<form method='post' action='?action=" .NavigationView::$actionGroup. "&amp;".self::$groupname."=" .urlencode($groupname)."'>		
							<textarea name='".self::$text."' maxlength='400'></textarea> <br />
							<input type='submit' name='saveText'  value='Skicka' class ='buttonsaveText'/>
							<label for='" .self::$checkboxNotice. "' class = 'labelbox'>sticky note</label>
							<input type='checkbox' name='" .self::$checkboxNotice. "' id = '" .self::$checkboxNotice. "' class = 'checkboxGroup'>
							<label class = 'labeldays'>Antal dagar</label>
							<select name='" . self::$numberOfDays. "'>
				  				<option value='1'>1</option>
				  				<option value='2'>2</option>
				  				<option value='3'>3</option>
				  				<option value='4'>4</option>
				  				<option value='5'>5</option>
				  				<option value='6'>6</option>
				  				<option value='7'>7</option>
				  				<option value='8'>8</option>
				  				<option value='9'>9</option>
				  				<option value='10'>10</option>
				  				<option value='11'>11</option>
				  				<option value='12'>12</option>
				  				<option value='13'>13</option>
				  				<option value='14'>14</option>
				 		 </select><br />
					</form></div>
				<div id = 'noteDiv'>";
					if($stickyNote !== ""){
						for($i=0;$i<count($nameToStickyNote);$i++){
							
							// Om användarnamnet till sticky note från databasen är samma som användaren, skapas rättigheter att ta bort stickynoten. 
							if($nameToStickyNote[$i] == $userName){
								$html .= "<div class = 'note'><form method='post' action='?action=" .NavigationView::$actionGroup. "&amp;".self::$groupname."=" .urlencode($groupname)."'>
								<input type='submit' name='deleteSticky'  value='X' class ='deleteSticky'/>
								<p class = 'stickyText'>$stickyNote[$i]</p>
								<input type='hidden' name='" .self::$stickyID."' value='$stickyID[$i]'></form></div>";	
						}else{
							$html .= "<div class = 'note'><p class = 'stickyText1'>$stickyNote[$i]</p></div>";	
						}
					}
				}

		$html .= "</div></div>";
		
		return $html;
	}
}