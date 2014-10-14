<?php
namespace model;

require_once ("./src/model/Repository.php");
require_once("./helpers/Session.php");

class UserRepository extends base\Repository{
	
	private $sessionHelper;
	private static $groupTable = "group";
	private static $name = "name";

	public function __construct(){
		$this->sessionHelper = new \helpers\Session(); 
	}
	
	public function checkIfGroupNameExists($groupName, $numberOfUsers){
	    $db = $this -> connection();
		$sql = "SELECT " . self::$name . " FROM `" . self::$groupTable . "`";
		
		$query = $db -> prepare($sql);
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
}