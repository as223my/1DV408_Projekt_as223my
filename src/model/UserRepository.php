<?php
namespace model;

require_once ("./src/model/Repository.php");
require_once("./helpers/Session.php");

class UserRepository extends base\Repository{
	
	private $sessionHelper;
	private $groupTable = "group";
	private $userTable = "user";
	private $groupMemberTable = "groupmember";
	
	private static $groupMemberID = "groupmemberID";
		
	private static $groupID = "groupID";
	private static $name = "name";

	private static $userID = "userID";
	private static $username = "username";
	private static $password = "password";
	
	public function __construct(){
		$this->sessionHelper = new \helpers\Session(); 
	}
	
	public function checkUser($username,$password){
		
		$db = $this->connection();
		$sql = "SELECT " . self::$userID . " FROM $this->userTable WHERE " . self::$username . " = ? AND " . self::$password. "= ?";
		
		$params = array($username,$password);
		$query = $db->prepare($sql);
		$query->execute($params);
		
		$result = $query->fetch();
		
		return $result;
	}
	
	public function checkUserName($username){
		
		$db = $this->connection();
		$sql = "SELECT " . self::$userID . " FROM $this->userTable WHERE " . self::$username . " = ? ";
		
		$params = array($username);
		$query = $db->prepare($sql);
		$query->execute($params);
		
		$result = $query->fetch();
		if(empty($result)){
			return true;
		}else{
			$this->sessionHelper->setMessage("Användarnamnet finns redan registrerat, var vänlig välj ett annat!");
			return false;
		}
	}
	
	public function checkIfUserExist($username){
		
		$db = $this->connection();
		$sql = "SELECT " . self::$userID . " FROM $this->userTable WHERE " . self::$username . " = ? ";
		
		$params = array($username);
		$query = $db->prepare($sql);
		$query->execute($params);
		
		$result = $query->fetch();
		if(empty($result)){
				$this->sessionHelper->setMessage("Användare som inte finns vald!");
			return $result;
		}else{
			$arr = array();
			foreach ($result as $key => $value){
				if($key === self::$userID){		
    				array_push($arr,$value);
    				}
			}
			return $arr;
		}
		
	}
	
	public function addUser($username, $password){
		
		$db = $this->connection();
		
		$sql = "INSERT INTO $this->userTable(" .self::$userID. "," .self::$username. "," .self::$password. ") VALUES (?, ?, ?)";
			// Byt ut md5 mot hasssched?? (Funkar ej med aptana)
			$params = array("",$username, md5($password));
			$query = $db->prepare($sql);
			$query->execute($params);	
			
			$this->sessionHelper->setMessage("Du har nu registrerats! Välkommen $username ");
	}
	
	public function addUserToGroup($userID, $groupID, $groupname){
		$db = $this->connection();
			
		$sql1 = "INSERT INTO $this->groupMemberTable(" .self::$groupMemberID. "," .self::$groupID. "," .self::$userID. ") VALUES (?, ?, ?)";
		$params1 = array("",$groupID, $userID[0]);
		$query1 = $db->prepare($sql1);
		$query1->execute($params1);	

		$this->sessionHelper->setMessage("Gruppen $groupname är skapad!");
	}
	
	public function getUserName($userID){
			$db = $this->connection();
			$sql = "SELECT " . self::$username . " FROM $this->userTable WHERE " . self::$userID . " = ? ";
			$params = array($userID);
			$query = $db->prepare($sql);
			$query->execute($params);
			$result = $query->fetch();
			return $result[self::$username];
		
	}	
	
}