<head>
<style>
	table, th, td 
	{
		border: 1px solid black;
	}
</style>
</head>

<?php
	include("database.php");
	
	echo $id = $_GET['id'];
	echo $name = $_GET['name'];
	echo $email = $_GET['email'];
	$type = $_GET['type'];
	
?>


<html>
<body>
	
	<form method="POST">
		<table style="width:100%">	
			<tr>
				<th>Student Name:</th>
				<th><input type="text" placeholder="name" name="name" id="name" required value="<?= $name ?>" ></th>
			</tr>
		
			<tr>
				<th>Password:</th>
				<th><input type="text" placeholder="password" name="password" id="password"></th>
			</tr>
			
			<tr>
				<th>Email:</th>
				<th><input type="text" placeholder="email" name="email" id="email" required value="<?= $email ?>"></th>
			</tr>
			
			<input type="hidden" name="origemail" value="<?= $email ?>" />
			
			<input type="hidden" name="type" value="<?= $type ?>" />
			
			<tr>
				<th colspan="2"><input type="submit" id="button" name="update" value="update" ></th>
			</tr>
		</table>
		
		<form method="post">
			<button type="submit" name="changeLocation">Change Location</button>
		</form>

		<?php
			if (isset($_POST['changeLocation']))
			{
				$temp = $type."view";
				header("Location: $temp.php");
				exit();
			}
		?>
		
	</form>
	
<?php

	// in form  XXX@common.cpce-polyu.edu.hk
	function validEmailtype($email)
	{
		return preg_match('/^[a-zA-Z0-9._%+-]+@/', trim($email));
	}
	
	function validEmail($email, $origemail)
	{
		if ($email === $origemail) 
		{
			echo "yes";
			return true; // Email is unique
		} 
		else 
		{
			echo "no";
			return isEmailRepeated($email);
		}
    }

	function isEmailRepeated($email)
	{
		global $conn;
		
		$query = "SELECT COUNT(*) FROM user WHERE email = '$email'";
		$result = mysqli_query($conn, $query);
		$count = mysqli_fetch_row($result)[0];
		if ($count > 1)
		{
			echo "re";
			return false;
		}
		else 
		{
			echo "No re";
			return true;
		}
	}
	
	function validpassword($Spassword)
	{
		return preg_match('/^(?=.*[a-z])(?=.*[A-Z]).{8,}$/', trim($Spassword));
	}
		
	if(isset($_POST['update']))
	{
		if (trim($_POST["name"]) != "" && validEmail($_POST["email"], $_POST["origemail"]) && validEmailtype($_POST["email"]) && validpassword($_POST["password"]))
		{
			$name = $_POST['name'];
			$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
			$email = $_POST['email'];		
		
			$origemail = $_POST['origemail'];

		
			$sql = "Update user SET ID = '$id', Name = '$name', Pw = '$password', email = '$email' where ID = '$id'" ;
			$data = mysqli_query($conn, $sql);
		
			if($data)
			{
				echo "<br>update successfully</br>";
			}
			else
			{
				echo "<br>update is failed</br>";
			}
			$temp = $type."view";
			header("Location: $temp.php");
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
				$message .= "The password should be 8 or more charcter with uppercase and lowercase <br>";
			}
			
			if(!validEmailtype($_POST["email"]))
			{
				$message .= "This is not a valid email address <br>";
			}
		
			if(!validEmail($_POST["email"], $_POST["origemail"]))
			{
				$message .= "The email have been used. <br>";
			}
					
			echo $message;
		}
	}
?>

</body>
</html>