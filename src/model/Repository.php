<?php

namespace model\base;

class Repository{
	
	protected $dbConnection;
	protected $dbTable;
	
	/*
	 * Hämtar databas inställningar från settingsfilen. 
	 */
	protected function connection(){
		
		if ($this->dbConnection === null){
			$this->dbConnection = new \PDO(\Settings::$DB_CONNECTION, \Settings::$DB_USERNAME, \Settings::$DB_PASSWORD);
		}else{
			$this->dbConnection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		}
		
		return $this->dbConnection;
	}
}
