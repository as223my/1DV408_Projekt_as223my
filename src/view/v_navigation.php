<?php
namespace view;

require_once("./Settings.php");

class NavigationView{
	public static $action = "action";
	
	public static $actionLoggIn = "loggin";
	public static $actionLoggedIn = "loggedin";
	
	public static function getAction(){
		if (isset($_GET[self::$action])){
			return $_GET[self::$action];
			
		}else{
			return self::$actionLoggIn;
		}
	}
	
	public static function RedirectHome(){
		header('Location: /' . \Settings::$ROOT_PATH. '/');
	}

}