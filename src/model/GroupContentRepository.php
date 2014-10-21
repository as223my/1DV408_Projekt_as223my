<?php
namespace model;

require_once ("./src/model/Repository.php");
require_once ("./src/model/UserRepository.php");
require_once("./helpers/Session.php");

class GroupContentRepository extends base\Repository{
	
	private $sessionHelper;
	private $userRepository;
	private $textTable = "text"; 
	
	private static $textID = "textID"; 
	private static $userID = "userID";
	private static $groupID = "groupID";
	private static $text = "text";
	
	public function __construct(){
		$this->sessionHelper = new \helpers\Session(); 
		$this->userRepository = new \model\UserRepository(); 
	}
		
	public function addText($text, $groupId){
		$userId = $this->sessionHelper->getId(); 
		
		$db = $this->connection();
			
		$sql = "INSERT INTO $this->textTable(" .self::$textID. "," .self::$text. ", ".self::$groupID.", ".self::$userID.") VALUES (?, ?, ?, ?)";
		$params = array("",$text, $groupId, $userId);
		$query = $db->prepare($sql);
		$query->execute($params);		
	}
	
	public function getText(){
		$groupId = $this->sessionHelper->getGroupId(); 
		
		$db = $this->connection();
		
		$sql ="SELECT " . self::$text . " FROM $this->textTable WHERE " . self::$groupID . " = ?";
		
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
	
	public function getUserText(){
		$groupId = $this->sessionHelper->getGroupId(); 
		
		$db = $this->connection();
		
		$sql ="SELECT " . self::$userID . " FROM $this->textTable WHERE " . self::$groupID . " = ?";
		
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
	
	public function deleteText($text, $groupId, $userId){
		$db = $this->connection();
		
		$sql = "DELETE FROM $this->textTable WHERE " . self::$text . " = ? AND " . self::$groupID . "= ? AND " . self::$userID . "= ?";
		$params = array($text, $groupId, $userId);
		$query = $db->prepare($sql);
		$query->execute($params);
	}
}
	