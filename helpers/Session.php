<?php
namespace helpers;

class Session{
	private static $sessionMessage = "sessionMessage";
	//private static $sessionGroupName = "sessionGroupName";
	
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
	
	
/*	public function setGroupName($string){
      $_SESSION[self::$sessionGroupName] = $string;
    }

    public function getGroupName(){
      if(isset($_SESSION[self::$sessionGroupName])){
        $groupName = $_SESSION[self::$sessionGroupName];  
        unset($_SESSION[self::$sessionGroupName]);	
	  }
      return $groupName;
    }*/
}