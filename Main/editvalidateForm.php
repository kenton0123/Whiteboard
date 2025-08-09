<?php
	include("database.php");
	session_start();
	
	$type = $_POST['type'];
		
	// any charcter + @ + any charcter with charcter"mail"
	function validEmailtype($email)
	{
		return preg_match('/.+@.+mail/', trim($email));
	}
	
	function validEmail($email)
	{
		global $conn;
		global $type;

		$email = mysqli_real_escape_string($conn, $email);

		$sql = "SELECT email FROM $type WHERE email = '$email'";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) {
			return false; // Email already exists, return false
		}

		return true; // Email is unique, return true
	}
	
	
	//8 or more interger and at least 1 charcter with uppercase and 1 lowercase charcter
	function validpassword($password)
	{
		return preg_match('/^(?=.*[a-z])(?=.*[A-Z]).{8,}$/', trim($password));
	}
	
	if(trim($_POST["name"]) != "" && validEmail($_POST["email"]) &&validEmailtype($_POST["email"]) && validpassword($_POST["password"]))
	{	
		$id=$_SESSION['editid'];
		$n= ucwords(strtolower(trim($_POST['name'])));
		$p=$_POST['password'];
		$e=$_POST['email'];
		
		$idtemp = $type."_ID";
		$nametemp = $type."_Name";
		
		$sql="update $type ($idtemp, $nametemp, Password, email)" . "VALUES ('$Si', '$Sn', '$Sp', '$Se')";
		if(mysqli_query($conn, $sql))
			echo "<br/>Record inserted successfully <br/>";
		else
			echo "<br/>Error inserting record<br/>" . mysqli_error($conn);
		
		unset($_SESSION['editid']);
		unset($_SESSION['editname']);
		unset($_SESSION['editpassword']);
		unset($_SESSION['editemail']);
		unset($_SESSION['msg']);
		
		$temp = $type."view";
		header("Refresh:1; url=studentview.php");
		
		
	}
	else
	{
		$message = "ERROR!<br>";
			
		if(trim($_POST["name"]) == "")
		{
			$message .= "Please enter your name. <br>";
		}
		
		if(!validpassword($_POST["password"]))
		{
			$message .= "The password should be 10 or more charcter with uppercase and lowercase <br>";
		}
			
		if(!validEmailtype($_POST["email"]))
		{
			$message .= "Please enter a correct email. <br>";
		}
		
		if(!validEmail($_POST["email"]))
		{
			$message .= "The email have been used. <br>";
		}
		
		$_SESSION['editname'] = $_POST['name'];
		$_SESSION['editpassword'] = $_POST['password'];
		$_SESSION['editemail'] = $_POST['email'];
		$_SESSION['msg'] = $message;
		
		header("Refresh:1231; url=editform.php");
	}

?>
