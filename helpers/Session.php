<?php
namespace helpers;

class Session{
	private static $sessionMessage = "sessionMessage";
	private static $sessionId = "sessionId"; 
	private static $sessionName = "sessionName"; 
	private static $sessionGroupId = "sessionGroupId";
	private static $sessionGroupName = "sessionGroupName";  
	
	public function setMessage($string){
      	$_SESSION[self::$sessionMessage] = $string;
    }
 
    public function getMessage(){
      if(isset($_SESSION[self::$sessionMessage])){
        $message = $_SESSION[self::$sessionMessage];  
        unset($_SESSION[self::$sessionMessage]);	
		
      }else{
        $message = "";
      }
      return $message;
    }
	
	public function setId($number){
      	$_SESSION[self::$sessionId] = $number;
    }
	
	public function getId(){
		return $_SESSION[self::$sessionId];
	}
	
	public function setName($string){
      	$_SESSION[self::$sessionName] = $string;
    }
	
	public function getName(){
		return $_SESSION[self::$sessionName];
	}
	
	public function setGroupId($number){
      	$_SESSION[self::$sessionGroupId] = $number;
    }
	
	public function getGroupId(){
		return $_SESSION[self::$sessionGroupId];
	}
	
	public function setGroupName($string){
		$_SESSION[self::$sessionGroupName] = $string;
	}
	
	public function getGroupName(){
		return $_SESSION[self::$sessionGroupName];
	}
}