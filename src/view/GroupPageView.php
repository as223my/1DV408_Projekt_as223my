<?php
namespace view;

require_once("./src/model/GroupContentRepository.php");

class GroupPageView{
	
	private $groupContentRepository;
	
	private static $groupname = "groupname";
	private static $text = "text";
	private static $textDelete = "textDelete";
	private static $stickyDelete = "stickyDelete";
	private static $checkboxNotice = "checkboxNotice"; 
	private static $numberOfDays = "days"; 
	
	public function __construct(){
		$this->groupContentRepository = new \model\GroupContentRepository();
	}
	
	public function getText(){
		if(isset($_POST["saveText"])){
			return $_POST[self::$text];
		}else{
			return null;
		}	
	}
	
	public function checkboxNotice(){
		if(isset($_POST[self::$checkboxNotice])){
			return $_POST[self::$numberOfDays]; 
		}else{
			return null;
		}
	}
	
	public function deleteText(){
		if(isset($_POST["deleteText"])){
			return $_POST[self::$textDelete];
		}else{
			return null;
		}	
	}
	
	public function deleteSticky(){
		if(isset($_POST["deleteSticky"])){
			return $_POST[self::$stickyDelete];
		}else{
			return null;
		}	
	}
	
	public function showGroupPage($groupname, array $groupsMemberName, $userName){
		$textToGroup = $this->groupContentRepository->getText();
		$nameToGroup = $this->groupContentRepository->getUserText(); 
		$stickyNote = $this->groupContentRepository->getStickyNote(); 
		$nameToStickyNote = $this->groupContentRepository->getStickyNoteUser(); 
		
		$html = "<div id = 'containerGroup'>
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
							if($nameToGroup[$i] == $userName){
								$html .= "<div class = 'textMessage1'><form method='post' action='?action=" .NavigationView::$actionGroup. "&amp;".self::$groupname."=" .urlencode($groupname)."'>
								<input type='submit' name='deleteText'  value='Ta bort' class ='deleteText'/>
								<input type='hidden' name='" .self::$textDelete."' value='$textToGroup[$i]'>		
								<p class = 'userNameGroup1'>$nameToGroup[$i]</p><p class = 'textGroup'>$textToGroup[$i]</p>
								</form></div>"; 
							}else{
								$html .= "<div class = 'textMessage'><p class = 'userNameGroup'>$nameToGroup[$i]</p><p class = 'textGroup'>$textToGroup[$i]</p></div>"; 
							}
						}
					}
					$html .= "</div>
						<form method='post' action='?action=" .NavigationView::$actionGroup. "&amp;".self::$groupname."=" .urlencode($groupname)."'>		
							<textarea name='".self::$text."' maxlength='200'></textarea> <br />
							<input type='submit' name='saveText'  value='Skicka' class ='buttonsaveText'/>
							 <label for='" .self::$checkboxNotice. " 'class = 'labelbox'>sticky note</label>
							 <input type='checkbox' name='" .self::$checkboxNotice. "'class = 'checkboxGroup'>
							  <label for='" . self::$numberOfDays ."' class = 'labeldays'>Antal dagar</label>
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
						</form>
					</div>
				<div id = 'noteDiv'>";
				if($stickyNote !== ""){
					for($i=0;$i<count($nameToStickyNote);$i++){
						if($nameToStickyNote[$i] == $userName){
							$html .= "<div class = 'note'><p class = 'stickyText'>$stickyNote[$i]</p><form method='post' action='?action=" .NavigationView::$actionGroup. "&amp;".self::$groupname."=" .urlencode($groupname)."'>
							<input type='submit' name='deleteSticky'  value='X' class ='deleteSticky'/>
							<input type='hidden' name='" .self::$stickyDelete."' value='$stickyNote[$i]'></form></div>";	
						}else{
							$html .= "<div class = 'note'><p class = 'stickyText'>$stickyNote[$i]</p></div>";	
						}
					}
				}
				$html .= "</div></div>";
		return $html;
	}
	
}