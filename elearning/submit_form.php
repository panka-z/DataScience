<?php
/* cd c:\xampp\mysql\bin mysql.exe -u root --password */
define('DB_HOST', 'localhost'); 
define('DB_NAME', 'suvenelearning'); 
define('DB_USER','suv_user'); 
define('DB_PASSWORD','Qwerty@123'); 

$con=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: " . mysqli_error()); 
$db=mysqli_select_db(DB_NAME,$con) or die("Failed to connect to database: " . mysqli_error()); 

if(isset($_POST['contactFrmSubmit']) && !empty($_POST['name']) && !empty($_POST['email']) && (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) && !empty($_POST['message'])){
    
    // Submitted form data
    $name    = $_POST['name'];
    $email   = $_POST['email'];
    $message = $_POST['message'];
	$pass    = $_POST['pass'];
    
    /*
     * Send email to admin
     */
    $to     = 'admin@example.com';
    $subject= 'Contact Request Submitted';
    
    $htmlContent = '
    <h4>Contact request has submitted at CodexWorld, details are given below.</h4>
    <table cellspacing="0" style="width: 300px; height: 200px;">
        <tr>
            <th>Name:</th><td>'.$name.'</td>
        </tr>
        <tr style="background-color: #e0e0e0;">
            <th>Email:</th><td>'.$email.'</td>
        </tr>
        <tr>
            <th>Message:</th><td>'.$message.'</td>
        </tr>
    </table>';
    
    // Set content-type header for sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    
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
    echo $status;die;
	
}