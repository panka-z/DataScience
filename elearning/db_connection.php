<?php

include 'db.constants.php';

class DbConnection
{
	private static $connection;
	private static $dbhost;
	private static $dbuser;
	private static $dbpass;
	private static $db;
	
	
	function __construct(){
	 $dbhost = DB_HOST;
	 $dbuser = DB_USER;
	 $dbpass = "";
	 $db = DATABASE;
	 $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) 
			 or
			 die("Connect failed: %s\n". $conn -> error);
	 self::$connection = $conn;
	 }
	 
	function setConnection(){
		self::$connection = OpenCon();
	}
 
 	function getConnection(){
		return self::$connection;
	}

	function insert($sql){		
		return self::$connection->multi_query($sql);
	} 

	function addUser($name,$uname,$email,$pass){		
		$sql = "INSERT INTO websiteusers 
		(fullname,userName,email,pass) 
		VALUES ('$name','$uname','$email','$pass')"; 
		return self::$connection->multi_query($sql);
	}

	function validateUser($email,$pass){
		return true;
	}	
	
	function CloseCon(){
	 self::$connection -> close();
	 }
}  
?>