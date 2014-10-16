<?php

namespace controller;

require_once("./src/view/UserPageView.php");

class UserPageController{
	private $userpageView;
	
	public function __construct(){
		
		$this->userpageView = new \view\UserPageView();
	
	}
		
	public function userPage(){
		return $this->userpageView->showUserPage();
	
	}
	
}
