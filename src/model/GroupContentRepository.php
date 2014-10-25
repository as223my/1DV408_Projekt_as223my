<?php
namespace model;

require_once ("./src/model/Repository.php");
require_once ("./src/model/UserRepository.php");
require_once("./helpers/Session.php");

class GroupContentRepository extends base\Repository{
	
	private $sessionHelper;
	private $userRepository;
	private $textTable = "text"; 
	private $stickynoteTable = "stickynote";
	
	private static $textID = "textID"; 
	private static $userID = "userID";
	private static $groupID = "groupID";
	private static $text = "text";
	
	private static $stickynoteID = "stickynoteID"; 
	private static $time = "time";
	
	public function __construct(){
		$this->sessionHelper = new \helpers\Session(); 
		$this->userRepository = new \model\UserRepository(); 
	}
		
	// Lägger till text till meddelande i databasen. 
	public function addText($text, $groupId){
		
		$userId = $this->sessionHelper->getId();
		 
		$db = $this->connection();
		$sql = "INSERT INTO $this->textTable(" .self::$textID. "," .self::$text. ", ".self::$groupID.", ".self::$userID.") VALUES (?, ?, ?, ?)";
		
		$params = array("",$text, $groupId, $userId);
		$query = $db->prepare($sql);
		$query->execute($params);		
	}
	
	// Hämtar texten till meddelanden i gruppen, sorteras på textID.  
	public function getText(){
		
		$groupId = $this->sessionHelper->getGroupId(); 
		
		$db = $this->connection();
		$sql ="SELECT " . self::$text . ", ".self::$textID." FROM $this->textTable WHERE " . self::$groupID . " = ? ORDER BY ".self::$textID."";
		
		$params = array($groupId);
		$query = $db->prepare($sql);
		$query->execute($params);
			
		$result = $query->fetchAll();
		
		if(!empty($result)){
			foreach($result as $value){
				$arr[] = $value[self::$text];
			}
		}else{
			$arr = ""; 
		}
		return $arr;
	}
	
	// Hämtar textID till meddelanden i gruppen, sorteras på textID.  
	public function getTextID(){
		
		$groupId = $this->sessionHelper->getGroupId(); 
		
		$db = $this->connection();
		$sql ="SELECT " . self::$textID . " FROM $this->textTable WHERE " . self::$groupID . " = ? ORDER BY ".self::$textID."";
		
		$params = array($groupId);
		$query = $db->prepare($sql);
		$query->execute($params);
			
		$result = $query->fetchAll();
		
		if(!empty($result)){
			foreach($result as $value){
				$arr[] = $value[self::$textID];
			}
		}else{
			$arr = ""; 
		}
		return $arr;
	}
	
	// Hämtar användarnamn till meddelanden i gruppen, sorteras på textID.  
	public function getUserText(){
		
		$groupId = $this->sessionHelper->getGroupId(); 
		
		$db = $this->connection();
		$sql ="SELECT " . self::$userID . ", ".self::$textID." FROM $this->textTable WHERE " . self::$groupID . " = ? ORDER BY ".self::$textID."";
		
		$params = array($groupId);
		$query = $db->prepare($sql);
		$query->execute($params);
			
		$result = $query->fetchAll();
		
		if(!empty($result)){
			foreach($result as $value){
			$arr[] = $this->userRepository->getUserName($value[self::$userID]); 
			}
		}else{
			$arr = ""; 
		}
		return $arr;
	}
	
	// Tar bort meddelande. 
	public function deleteText($textID){
		
		$db = $this->connection();
		$sql = "DELETE FROM $this->textTable WHERE " . self::$textID . " = ?";
		
		$params = array($textID);
		$query = $db->prepare($sql);
		$query->execute($params);
	}
	
	// Lägger till en sticky note i databasen. 
	public function addStickynote($text, $time, $groupId, $userId){
		
		$db = $this->connection();
		$sql = "INSERT INTO $this->stickynoteTable(" .self::$stickynoteID. "," .self::$text. ", ".self::$time.", ".self::$groupID.", ".self::$userID.") VALUES (?, ?, ?, ?, ?)";
		$params = array("",$text, $time , $groupId, $userId);
		$query = $db->prepare($sql);
		
		$query->execute($params);		
	}
	
	// Hämtar texten till sticky note, om tiden har gått ut raderas sticky noten. 
	public function getStickyNote(){
		
		$groupId = $this->sessionHelper->getGroupId(); 
		
		$db = $this->connection();
		$sql ="SELECT * FROM $this->stickynoteTable WHERE " . self::$groupID . " = ? ORDER BY ".self::$stickynoteID."";
		
		$params = array($groupId);
		$query = $db->prepare($sql);
		$query->execute($params);
			
		$result = $query->fetchAll();
		
		if(!empty($result)){
			foreach($result as $value){
				
				if($value[self::$time] > time()){
					$arr[] = $value[self::$text];
				}else{
					$sql = "DELETE FROM $this->stickynoteTable WHERE " . self::$time . " = ? AND " . self::$groupID . "= ?";
					$params = array($value[self::$time] , $groupId);
					$query = $db->prepare($sql);
					$query->execute($params);
				}
			}
		}
		
		if(empty($arr)){
			$arr = "";
			return $arr;
		}
		return $arr;
	}
	
	// Hämtar stickynoteID. 
	public function getStickyID(){
		
		$groupId = $this->sessionHelper->getGroupId(); 
		
		$db = $this->connection();
		$sql ="SELECT " . self::$stickynoteID . " FROM $this->stickynoteTable WHERE " . self::$groupID . " = ? ORDER BY ".self::$stickynoteID."";
		
		$params = array($groupId);
		$query = $db->prepare($sql);
		$query->execute($params);
			
		$result = $query->fetchAll();
		
		if(!empty($result)){
			foreach($result as $value){
				$arr[] = $value[self::$stickynoteID];
			}
		}else{
			$arr = ""; 
		}
		return $arr;
	}
	
	// Hämtar användarnamn till sticky note, sorteras på stickynoteID.
	public function getStickyNoteUser(){
		
		$groupId = $this->sessionHelper->getGroupId(); 
		
		$db = $this->connection();
		$sql ="SELECT " . self::$userID . " , ".self::$stickynoteID." FROM $this->stickynoteTable WHERE " . self::$groupID . " = ? ORDER BY ".self::$stickynoteID."";
		
		$params = array($groupId);
		$query = $db->prepare($sql);
		$query->execute($params);
			
		$result = $query->fetchAll();
		
		if(!empty($result)){
			foreach($result as $value){
			$arr[] = $this->userRepository->getUserName($value[self::$userID]); 
			}
		}else{
			$arr = ""; 
		}
		return $arr;
	}
	
	// Tar bort sticky note från databasen.
	public function deleteSticky($stickynoteID){
		
		$db = $this->connection();
		$sql = "DELETE FROM $this->stickynoteTable WHERE " . self::$stickynoteID . " = ?";
		
		$params = array($stickynoteID);
		$query = $db->prepare($sql);
		$query->execute($params);
	}
}
	