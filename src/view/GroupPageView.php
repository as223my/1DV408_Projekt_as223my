<?php
namespace view;

require_once("./src/model/GroupContentRepository.php");

class GroupPageView{
	
	private $groupContentRepository;
	
	private static $groupname = "groupname";
	private static $text = "text";
	private static $textDelete = "textDelete";
	private static $checkboxText = "checkboxText"; 
	private static $checkboxNotice = "checkboxNotice"; 
	
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
	
	public function deleteText(){
		if(isset($_POST["deleteText"])){
			return $_POST[self::$textDelete];
		}else{
			return null;
		}	
	}
	
	public function showGroupPage($groupname, array $groupsMemberName, $userName){
		$textToGroup = $this->groupContentRepository->getText();
		$nameToGroup = $this->groupContentRepository->getUserText(); 
		
		$html = "<div id = 'containerGroup'>
		<div id = 'headGroup'>
			<a href='?action=" .NavigationView::$actionLogout. "'>Logga ut</a>
			<a href='?action=" .NavigationView::$actionUserPage. "'>Tillbaka</a>
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
								<input type='hidden' name='" .self::$textDelete."' value='$textToGroup[$i]'>		
								<p class = 'userNameGroup1'>$nameToGroup[$i]</p><p class = 'textGroup'>$textToGroup[$i]</p><input type='submit' name='deleteText'  value='Ta bort' class ='deleteText'/>
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
							<label for='" .self::$checkboxText. "' class = 'labelbox1'>textbox</label>
							 <input type='checkbox' name='" .self::$checkboxText. "'class = 'checkboxGroup' checked>
							 <label for='" .self::$checkboxNotice. " 'class = 'labelbox2'>notice</label>
							 <input type='checkbox' name='" .self::$checkboxNotice. "'class = 'checkboxGroup'>
						</form>
					</div>
				<div id = 'noteDiv'></div></div>";
		return $html;
	}
	
}