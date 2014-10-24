<?php
namespace model;

require_once("./src/model/UserRepository.php");
require_once ("./src/model/Repository.php");
require_once("./helpers/Session.php");

class GroupsRepository extends base\Repository{
	
	private $userRepository;
	private $sessionHelper;
	private $groupTable = "group";
	private $groupMemberTable = "groupmember";
	private $textTable = "text"; 
		
	private static $groupID = "groupID";
	private static $groupmemberID = "groupmemberID";
	private static $name = "name";
	private static $userID = "userID";
	private static $username = "username";
	
	public function __construct(){
		$this->sessionHelper = new \helpers\Session(); 
		$this->userRepository = new \model\UserRepository();
	}
		
	/*
	 * Kontrollerar om gruppnamnet redan finns hos användaren vid skapandet av en ny grupp. 
	 * Om inte gruppnamnet finns i databasen så returneras false (kollar först hela databasen, sen specifikt för användaren). 
	 */ 
	public function checkIfGroupNameExists($groupName){
		
		$result = $this->findGroupId($groupName); 
		
		if(empty($result)){
			return false; 
		}else{
		
			$userID = $this->sessionHelper->getId(); 
			$groupID = $result[0]; 
		 	
			$db = $this->connection();
			$sql ="SELECT " . self::$groupmemberID . " FROM $this->groupMemberTable WHERE " . self::$groupID . " = ? AND " . self::$userID . "= ?";
		
			$params = array($groupID,$userID);
			$query = $db->prepare($sql);
			$query->execute($params);
			
			$groupmemberID = $query->fetch();
			
			if(empty($groupmemberID)){
				return false;
			}else{
				$this->sessionHelper->setMessage("Du har redan en grupp med namnet: $groupName");
				return true;
			}
		}	
	}
	
	// Lägger till ny grupp till databasen.
	public function addGroup($groupName){
	
		$db = $this->connection();
		$sql = "INSERT INTO `$this->groupTable`(" .self::$groupID. "," .self::$name. ") VALUES (?, ?)";
		
		$params = array("",$groupName);
		$query = $db->prepare($sql);
		$query->execute($params);	
		
		$this->sessionHelper->setMessage("Skapat en ny grupp: $groupName");
	}
	
	// Returnerar gruppId utifrån gruppens namn. 
	public function findGroupId($groupName){
		
		$db = $this->connection();
		$sql ="SELECT " . self::$groupID . " FROM `$this->groupTable` WHERE " . self::$name . " = ?";
		
		$params = array($groupName);
		$query = $db->prepare($sql);
		$query->execute($params);
		
		$result = $query->fetch();

		return $result;
	}
	
	// Kontrollerar om användaren har några grupper. 
	public function checkIfMemberHasGroup($groupID){
		
		$db = $this->connection();
		$sql ="SELECT " . self::$groupID . " FROM $this->groupMemberTable WHERE " . self::$groupID . " = ? AND " . self::$userID . "= ?";
		
		$params = array($groupID,$this->sessionHelper->getId());
		$query = $db->prepare($sql);
		$query->execute($params);
			
		$result = $query->fetch();

		return $result;
	}
	
	/*
	 * Hämtar alla grupper (gruppId) som tillhör användaren, sorteras på gruppId. 
	 * Därefter hämtas gruppens namn. 
	 */ 
	
	public function getGroups(){
		
		$id = $this->sessionHelper->getId();
		
		$db = $this->connection();
		$sql = "SELECT " . self::$groupID . " FROM $this->groupMemberTable WHERE " . self::$userID . "= ? ORDER BY " . self::$groupID . "";
		
		$params = array($id);
		$query = $db->prepare($sql);
		$query->execute($params);
		$arr = array();
		
		foreach ($query->fetchAll() as $result){
			
			foreach ($result as $key => $value){
				
				if($key === self::$groupID){		
    				array_push($arr,$value);
    			}
			}
		}
		
		$arrName = array();
		foreach ($arr as $value){
			
			$sql = "SELECT " . self::$name. " FROM `$this->groupTable` WHERE " . self::$groupID . " = ?";
			$params = array($value);
			$query = $db->prepare($sql);
			$query->execute($params);
			
			$result = $query->fetch();
			
			if(!empty($result)){
				
				foreach ($result as $key => $value){
					
					if($key === self::$name){		
	    				array_push($arrName,$value);
	    			}
				}
			}
		}
		return $arrName;
	}
	
	// Hämtar alla användare till en grupp.
	public function getGroupsMemberName($groupID){
		
		$db = $this->connection();
		$sql ="SELECT " . self::$userID . " FROM $this->groupMemberTable WHERE " . self::$groupID . " = ? ";
		
		$params = array($groupID);
		$query = $db->prepare($sql);
		$query->execute($params);
		$result = $query->fetchAll();
		
		foreach($result as $value){
			$name = $this->userRepository->getUserName($value[self::$userID]);
			$arr[] = $name;
		}
		return $arr;
	}
	
	/* 
	 * Tar bort grupp från användare. Om det då bara finns en användare kvar till gruppen tas gruppen bort helt. 
	 * Då vi inte vill ha en grupp med bara en användare (sig själv). 
	 */
	public function deleteGroupFromMember($groupID){
		
		$db = $this->connection();
		$sql = "DELETE FROM $this->groupMemberTable WHERE " . self::$groupID . " = ? AND " . self::$userID . "= ?";
		
		$params = array($groupID,$this->sessionHelper->getId());
		$query = $db->prepare($sql);
		$query->execute($params);
			
		$sql ="SELECT " . self::$userID . " FROM $this->groupMemberTable WHERE " . self::$groupID . " = ? ";
		
		$params = array($groupID);
		$query = $db->prepare($sql);
		$query->execute($params);
		
		$result = $query->fetchAll();

		if(count($result) <= 1){
			
			$sql = "DELETE FROM `$this->groupTable` WHERE " . self::$groupID . " = ?";
			$params = array($groupID);
			$query = $db->prepare($sql);
			$query->execute($params);
			
			$sql = "DELETE FROM $this->textTable WHERE " . self::$groupID . " = ?";
			$params = array($groupID);
			$query = $db->prepare($sql);
			$query->execute($params);	
		}
	}
}