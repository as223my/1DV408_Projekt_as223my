<?php
namespace view;

require_once("./helpers/Session.php");

class UserPageView{
	
	private $sessionHelper;
	
	public function __construct(){
		$this->sessionHelper = new \helpers\Session();
	}
	
	public function showUserPage(){
		
		$html = "
		<div id='UserPage'>
		 <a href='?action=" .NavigationView::$actionLogout. "'>Logga ut</a>
		 </div>";
		return $html;
		
	}
}