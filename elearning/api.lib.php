<?php 
session_start();
require_once('db.constants.php');

function genCookies(){
	$cookie_value = "Pankaj cookie";
	$cookie_expiration_time = time() + COOKIEEXPIRY;	
	setcookie( USERCOOKIE, $cookie_value, time() + COOKIEEXPIRY, '/');	
	//setcookie( 'UserName', 'Bob', 0, '/forums', 'www.example.com', isset($_SERVER["HTTPS"]), true);	
}

function clearCookies(){
	setcookie( USERCOOKIE, "", time()-30, '/');		
}
?>