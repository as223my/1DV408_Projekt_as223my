<?php
namespace view;

require_once("./Settings.php");

class NavigationView{
	public static $action = "action";
	
	public static $actionLogin = "login";
	public static $actionLoggedIn = "loggedin";
	
	public static function getAction(){
		if (isset($_GET[self::$action])){
			return $_GET[self::$action];
			
		}else{
			return self::$actionLogin;
		}
	}
	
	public static function RedirectHome(){
		header('Location: /' . \Settings::$ROOT_PATH. '/');
	}

}