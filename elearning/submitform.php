<?php
include 'db_connection.php';
include 'api.lib.php';

$conn = new DbConnection();

if(isset($_POST['frm']) && $_POST['frm']==2)
{
	//echo $_SERVER['REMOTE_ADDR'];
	if($conn->validateUser($_POST['email'],$_POST['pass']))
	{
		session_regenerate_id();
		$_SESSION['loggedinsuccess']=true;
		echo 'indexsub.php';
	}
	else 
	{
		echo null;
	}
}
else if(isset($_POST['frm']) && $_POST['frm']==1)
{	
	echo "sign up success ";
	$_SESSION["email"]= $_POST["email"];
	
	$password = password_hash($_POST['pass'], PASSWORD_DEFAULT);	
	if($conn->addUser($_POST['name'],$_POST['email'],$_POST['email'],$password) == TRUE)
	{
		echo "Registered succcessfully";
	} 
	else 
	{
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	genCookies();
}

else
{
	clearCookies();
}

$conn->CloseCon();

?>