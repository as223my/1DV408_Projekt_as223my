<?php
namespace helpers;

class CookieStorage{
	
	private $timeLengthCookie = 60;
	
	public function getCookies(){
		if($this->getCookieGroupName() === null || $this->getCookieUsername() === null || $this->getCookiePassword() === null || $this->getCookieTimestamp() === null){
			$this->deleteCookies();
			return null;
		}else{
			return array($this->getCookieGroupName(), $this->getCookieUsername(), $this->getCookiePassword());
		}
	}
	
	public  function getCookieGroupName(){
		if(isset($_COOKIE["groupname"])){
			return $_COOKIE["groupname"];
		}else{
			return null;
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
		
	public function saveCookies($groupname, $username, $password){
		setcookie("groupname",$groupname,time() + $this->timeLengthCookie,'/');
		setcookie("username",$username,time() + $this->timeLengthCookie,'/');
		setcookie("password",md5($password),time() + $this->timeLengthCookie,'/');
		
		$timestamp = time() + $this->timeLengthCookie;
		setcookie("timestamp",$timestamp,time() + $this->timeLengthCookie,'/');
		
	}
	
	public function deleteCookies(){
		setcookie("groupname", '', time() - $this->timeLengthCookie, '/');
		setcookie("username", '', time() - $this->timeLengthCookie, '/');
		setcookie("password", '', time() - $this->timeLengthCookie,'/');
		setcookie("timestamp", '', time() - $this->timeLengthCookie, '/');
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
