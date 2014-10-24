<?php
namespace helpers;

class Session{
	
	private static $sessionMessage = "sessionMessage";
	private static $sessionDeleteMessage = "sessionDeleteMessage";
	private static $sessionId = "sessionId"; 
	private static $sessionName = "sessionName"; 
	private static $sessionGroupId = "sessionGroupId";
	private static $sessionGroupName = "sessionGroupName";  
	
	public function setMessage($string){
      	$_SESSION[self::$sessionMessage] = $string;
    }
 
 	// Om ett meddelande finns så retureras detta, därefter tas det bort.
    public function getMessage(){
    	
      if(isset($_SESSION[self::$sessionMessage])){
      	
        $message = $_SESSION[self::$sessionMessage];  
        unset($_SESSION[self::$sessionMessage]);	
		
      }else{
        $message = "";
      }
      return $message;
    }
	
	public function setMessageDelete($string){
		$_SESSION[self::$sessionDeleteMessage] = $string;
	}
	
	public function getDeleteMessage(){
		
      if(isset($_SESSION[self::$sessionDeleteMessage])){
      
        $deleteMessage = $_SESSION[self::$sessionDeleteMessage];  
        unset($_SESSION[self::$sessionDeleteMessage]);	
		
      }else{
        $deleteMessage = "";
      }
      return $deleteMessage;
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