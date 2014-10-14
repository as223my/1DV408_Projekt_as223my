<?php
namespace model;

require_once ("./src/model/Repository.php");
require_once("./helpers/Session.php");

class UserRepository extends base\Repository{
	
	private $sessionHelper;
	private $groupTable = "group";
	private $userTable = "user";
	private static $groupID = "groupID";
	private static $name = "name";

	private static $userID = "userID";
	private static $username = "username";
	private static $password = "password";
	
	public function __construct(){
		$this->sessionHelper = new \helpers\Session(); 
	}
	
	public function checkIfGroupNameExists($groupName, $numberOfUsers){
	    $db = $this->connection();
		$sql = "SELECT " . self::$name . " FROM `$this->groupTable`";
		
		$query = $db->prepare($sql);
		$query->execute();
		
		foreach ($query->fetchAll() as $result){
			foreach ($result as $key => $value){
				if($key === self::$name){		
    				if($value === $groupName){
    					$this->sessionHelper->setMessage("Gruppnamnet är redan upptaget!");
    					return true;
    				}
    			}
			}
		}
	    return false;
	}
	
	public function addGroup($groupName){
	
			$db = $this->connection();
			
			$sql = "INSERT INTO `$this->groupTable`(" .self::$groupID. "," .self::$name. ") VALUES (?, ?)";
			$params = array("",$groupName);
			$query = $db->prepare($sql);
			$query->execute($params);	
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
	
	public function addUsers(array $usernames, array $passwords, $numberOfUsers, $groupID, $groupName){
		
		$db = $this->connection();
		
		for($i=0; $i<$numberOfUsers; $i++){
			$sql = "INSERT INTO $this->userTable(" .self::$userID. "," .self::$username. "," .self::$password. "," .self::$groupID. ") VALUES (?, ?, ?, ?)";
			// Byt ut md5 mot hasssched?? (Funkar ej med aptana)
			$params = array("",$usernames[$i], md5($passwords[$i]), $groupID);
			$query = $db->prepare($sql);
			$query->execute($params);	
			
			$this->sessionHelper->setMessage("Gruppen ".$groupName ." har registrerats med ".$numberOfUsers. " användare, Välkommen!");
		}
	}
}