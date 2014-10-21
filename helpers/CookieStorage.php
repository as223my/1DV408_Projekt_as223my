<?php
namespace helpers;

class CookieStorage{
	
	private $timeLengthCookie;
	
	public function __construct(){
		$this->timeLengthCookie = 60;
	}
	
	public function getCookies(){
		if($this->getCookieUsername() === null || $this->getCookiePassword() === null || $this->getCookieTimestamp() === null){
			$this->deleteCookies();
			return null;
		}else{
			return array($this->getCookieUsername(), $this->getCookiePassword());
		}
	}
	

	public  function getCookieUsername(){
		if(isset($_COOKIE["username"])){
			return $_COOKIE["username"];
		}else{
			return null;
		}		
	}
	
	public  function getCookiePassword(){
		if(isset($_COOKIE["password"])){
			return $_COOKIE["password"];
		}else{
			return null;
		}		
	}
		
	public function saveCookies($username, $password){
		setcookie("username",$username,time() + $this->timeLengthCookie,'/');
		setcookie("password",md5($password),time() + $this->timeLengthCookie,'/');
		
		$timestamp = time() + $this->timeLengthCookie;
		setcookie("timestamp",$timestamp,time() + $this->timeLengthCookie,'/');
		
	}
	
	public function deleteCookies(){

		if (isset($_COOKIE['username']) || isset($_COOKIE['password']) || isset($_COOKIE['timestamp'])) {
			setcookie("username", '', time() - $this->timeLengthCookie, '/');
			setcookie("password", '', time() - $this->timeLengthCookie,'/');
			setcookie("timestamp", '', time() - $this->timeLengthCookie, '/');
		}
	
	}
	
	public function checkTime(){
		$time = $this->getCookieTimestamp(); 
		if($time < time()){
			return false;
		}
		return true;
	}
	
	public function getCookieTimestamp(){
		if (isset($_COOKIE['timestamp'])){
			return $_COOKIE['timestamp'];
		}else{
			return null;
		}
	}
}
