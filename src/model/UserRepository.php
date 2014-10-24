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
	
	// Returnerar userID för användaren om denna finns i databasen, annars är $result tom. 
	public function checkUser($username,$password){
		
		$db = $this->connection();
		$sql = "SELECT " . self::$userID . " FROM $this->userTable WHERE " . self::$username . " = ? AND " . self::$password. "= ?";
		
		$params = array($username,$password);
		$query = $db->prepare($sql);
		$query->execute($params);
		
		$result = $query->fetch();
		
		return $result;
	}
	
	// Kontrollerar om användarnamnet som en ny användare vill ha är ledigt eller ej.
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
			$this->sessionHelper->setMessage("Användarnamnet finns redan registrerat, välj ett annat!");
			return false;
		}
	}
	
	// Kontrollerar om användare finns, när man vill skapa en ny grupp. 
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
	
	// Lägger till ny användare till databas.
	public function addUser($username, $password){
		
		$db = $this->connection();
		$sql = "INSERT INTO $this->userTable(" .self::$userID. "," .self::$username. "," .self::$password. ") VALUES (?, ?, ?)";
	
		$params = array("",$username, md5($password));
		$query = $db->prepare($sql);
		$query->execute($params);	
			
		$this->sessionHelper->setMessage("Du har nu registrerats! Välkommen $username ");
	}
	
	// Lägger till användare till grupp ner denna skapas. 
	public function addUserToGroup($userID, $groupID, $groupname){
		
		$db = $this->connection();
		$sql = "INSERT INTO $this->groupMemberTable(" .self::$groupMemberID. "," .self::$groupID. "," .self::$userID. ") VALUES (?, ?, ?)";
		
		$params = array("",$groupID, $userID[0]);
		$query = $db->prepare($sql);
		$query->execute($params);	

		$this->sessionHelper->setMessage("Gruppen $groupname är skapad!");
	}
	
	// Returnerar användarnamn utifrån userID.
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