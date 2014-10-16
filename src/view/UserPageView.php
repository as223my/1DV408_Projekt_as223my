<?php
namespace view;

require_once("./helpers/Session.php");

class UserPageView{
	
	private $sessionHelper;
	
	public function __construct(){
		$this->sessionHelper = new \helpers\Session();
	}
	
	public function showUserPage(){
		$group = $this->sessionHelper->getGroupName();
		$name = $this->sessionHelper->getName();
		$html = "
		<div id = 'head'> <a href='?action=" .NavigationView::$actionLogout. "'>Logga ut</a>
			 <h1>FamilyBook</h1></div>
		<div id = 'noteDiv'></div>
		<div id = 'userDiv'></div>
		<div id='UserPage'>
			 <h2>$group</h2>
			 <div id ='pictureDiv'></div>
			 <h3>$name</h3>
			 <div id = 'messageDiv'></div>
			  <form method='post' action='?action=" .NavigationView::$actionUserPage. "'>
			  <textarea rows= '3' class = 'textarea' name='sendValue'></textarea><br />
				<input type='submit' name='send'  value='Skicka' class ='sendButton'/>
			 </form>
		
		 </div>";
		return $html;
		
	}
}