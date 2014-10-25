<?php
namespace view;

require_once("./Settings.php");

class NavigationView{
	
	public static $action = "action";
	public static $actionLogin = "login";
	public static $actionLogout = "logout"; 
	public static $actionRegistration = "registration"; 
	public static $actionUserPage = "userPage";
	public static $actionUserPageSelect = "userPageSelect";
	public static $actionGroup = "group"; 
	
	
	public static function getAction(){
		
		if(isset($_GET[self::$action])){
			return $_GET[self::$action];
		}else{
			return self::$actionLogin;
		}
	}
	
	public static function RedirectToUser(){
		header('Location: /' . \Settings::$ROOT_PATH. '/?'.self::$action.'=' .self::$actionUserPage);
	}
}