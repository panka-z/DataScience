<?php 

/* CREATE USER 'suv_user'@'localhost' IDENTIFIED VIA mysql_native_password USING '***';GRANT ALL PRIVILEGES ON *.* TO 'suv_user'@'localhost' REQUIRE NONE WITH GRANT OPTION MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;GRANT ALL PRIVILEGES ON `suvenelearning`.* TO 'suv_user'@'localhost';

CREATE TABLE `suvenelearning`.`websiteusers` ( `fullname` VARCHAR(100) NOT NULL ,  `userName` VARCHAR(100) NOT NULL ,  `email` VARCHAR(100) NOT NULL ,  `pass` VARCHAR(100) NOT NULL ) ENGINE = InnoDB;

 */
 
define('DB_HOST', 'localhost'); 
define('DB_NAME', 'suvenelearning'); 
define('DB_USER','suv_user'); 
define('DB_PASSWORD','Qwerty@123'); 

$con=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: " . mysqli_error()); 
$db=mysqli_select_db(DB_NAME,$con) or die("Failed to connect to database: " . mysqli_error()); 
function NewUser() 
{ 
$fullname = $_POST['name']; 
$userName = $_POST['user']; 
$email = $_POST['email'];
$password = $_POST['pass']; 
$query = "INSERT INTO websiteusers (fullname,userName,email,pass) VALUES ('$fullname','$userName','$email','$password')"; 
$data = mysqli_query ($query)or die(mysqli_error()); 
if($data) 
{ 
echo "YOUR REGISTRATION IS COMPLETED..."; 
} } 

function SignUp() 
{ 
	if(!empty($_POST['user'])) //checking the 'user' name which is from Sign-Up.html, is it empty or have some text 
	{ 
	$query = mysqli_query("SELECT * FROM websiteusers WHERE userName = '$_POST[user]' AND pass = '$_POST[pass]'") or die(mysqli_error()); 
	if(!$row = mysqil_fetch_array($query) or die(mysqli_error())) { newuser(); 
	} 
	else 
	{ 
	echo "SORRY...YOU ARE ALREADY REGISTERED USER..."; 
	} } 
} 

if(isset($_POST['submit'])) 
{ 
SignUp(); 
} 
?>