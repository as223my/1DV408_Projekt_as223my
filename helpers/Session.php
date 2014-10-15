<?php
namespace helpers;

class Session{
	private static $sessionMessage = "sessionMessage";
	private static $sessionId = "sessionId"; 
	
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
	
}