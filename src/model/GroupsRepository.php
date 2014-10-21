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
		
	private static $groupID = "groupID";
	private static $groupmemberID = "groupmemberID";
	private static $name = "name";
	private static $userID = "userID";
	private static $username = "username";
	
	public function __construct(){
		$this->sessionHelper = new \helpers\Session(); 
		$this->userRepository = new \model\UserRepository();
	}
		
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
	
	public function addGroup($groupName){
	
			$db = $this->connection();
			
			$sql = "INSERT INTO `$this->groupTable`(" .self::$groupID. "," .self::$name. ") VALUES (?, ?)";
			$params = array("",$groupName);
			$query = $db->prepare($sql);
			$query->execute($params);	
			$this->sessionHelper->setMessage("Skapat en ny grupp: $groupName");
	}
	
	public function findGroupId($groupName){
		
		$db = $this->connection();
		
		$sql ="SELECT " . self::$groupID . " FROM `$this->groupTable` WHERE " . self::$name . " = ?";
		
		$params = array($groupName);
		$query = $db->prepare($sql);
		$query->execute($params);
		
		$result = $query->fetch();

		return $result;
	}
	
	public function checkIfMemberHasGroup($groupID){
		$db = $this->connection();
		
		$sql ="SELECT " . self::$groupID . " FROM $this->groupMemberTable WHERE " . self::$groupID . " = ? AND " . self::$userID . "= ?";
		
		$params = array($groupID,$this->sessionHelper->getId());
		$query = $db->prepare($sql);
		$query->execute($params);
			
		$result = $query->fetch();

		return $result;
		
	}
	
	public function getGroups(){
		$id = $this->sessionHelper->getId();
		
		$db = $this->connection();
		$sql = "SELECT " . self::$groupID . " FROM $this->groupMemberTable WHERE " . self::$userID . "= ?";
		
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
		foreach ($arr as $value) {
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
		}
	}
}