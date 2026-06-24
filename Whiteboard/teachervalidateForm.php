<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

	include("db.php");
	session_start();
		
	// in correct email from
	function validEmailtype($email)
	{
		return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
	}
	
	function validEmail($email)
	{
		global $conn;

		$email = mysqli_real_escape_string($conn, $email);

		$sql = "SELECT email FROM user WHERE email = '$email'";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) 
		{
			return false; // Email already exists, return false
		}

		return true; // Email is unique, return true
	}
	
	//8 or more interger and at least 1 charcter with uppercase and 1 lowercase charcter
	function validpassword($password)
	{
		return preg_match('/^(?=.*[a-z])(?=.*[A-Z]).{8,}$/', trim($password));
	}
	
	if(trim($_POST["name"]) != "" && validEmail($_POST["email"]) && validEmailtype($_POST["email"]) && validpassword($_POST["password"]))
	{
		$sql = "SELECT ID FROM user where ID like 'T%'";
		$result = mysqli_query($conn, $sql);	
		
		$maxId = 0;
		if (mysqli_num_rows($result) > 0)
		{	
			while($row = mysqli_fetch_assoc($result))
			{
				$Id = $row['ID'];
				$idNumber = substr($Id, 1);
				if ($idNumber > $maxId)
				{
					$maxId = $idNumber;
				}
			}
		}
				
		$newId = "T". $maxId + 1;
		
		$name= ucwords(strtolower(trim($_POST['name'])));
		$password=password_hash($_POST['password'], PASSWORD_DEFAULT);
		$email=$_POST['email'];
		
		$stmt = $conn->prepare("INSERT INTO user (ID, Name, Pw, email) VALUES (?, ?, ?, ?)");
		$stmt->bind_param("ssss", $newId, $name, $password, $email);
		$stmt->execute();
		/*		
		if(mysqli_query($conn, $sql))
			echo "<br/>Record inserted successfully <br/>";
		else
			echo "<br/>Error inserting record<br/>" . mysqli_error($conn);
		*/
		unset($_SESSION['Tname']);
		unset($_SESSION['Temail']);
		unset($_SESSION['Tmsg']);
		
		header("Refresh:1; url=AdminPage.php");
		
		
	}
	else
	{
		$message = "ERROR!<br>";
			
		if(trim($_POST["name"]) == "")
		{
			$message .= "Please enter the name. <br>";
		}
		
		if(!validEmail($_POST["password"]))
		{
			$message .= "The password should be 8 or more charcter with uppercase and lowercase <br>";
		}
			
		if(!validEmailtype($_POST["email"]))
		{
			$message .= "Please enter in form XXX@common.cpce-polyu.edu.hk <br>";
		}
		
		if(!validEmail($_POST["email"]))
		{
			$message .= "The email have been used. <br>";
		}
					
		$_SESSION['Tname'] = $_POST['name'];
		$_SESSION['Temail'] = $_POST['email'];
		$_SESSION['Tmsg'] = $message;
		
		header("Refresh:0.01; url=teacherform.php");
	}

?>
