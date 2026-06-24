<!DOCTYPE html>
<head>
<style>
	table, th, td 
	{
		border: 1px solid black;
	}
</style>
</head>

<?php
	session_start();
	include 'A-left-nav.php';
	include 'top-nav.php';
	$name = isset($_SESSION["Sname"]) ? $_SESSION["Sname"] : "";
	$email = isset($_SESSION["Semail"]) ? $_SESSION["Semail"] : "";
	$msg = isset($_SESSION["Smsg"]) ? $_SESSION["Smsg"] : "";
?>

<html>
<body>
<div class="main-content">
	
	<p style="color:#ff0000";><?= $msg ?></p>
	
	<form method="POST" action ="studentvalidateForm.php">
		<table style="width:100%">	
			<tr>
				<th>Student Name:</th>
				<th><input type="text" placeholder="Student Name" name="name" id="name" required value="<?= $name ?>" ></th>
			</tr>
		
			<tr>
				<th>Password:</th>
				<th><input type="password" placeholder="Password" name="password" id="password" required></th>
			</tr>
			
			<tr>
				<th>Email:</th>
				<th><input type="email" placeholder="XXX@xxx.com" name="email" id="email" required value="<?= $email ?>"></th>
			</tr>
		
			<tr>
				<th colspan="2"><input type="submit" id="button" name="Submit" value="Submit" ></th>
			</tr>
			
		</table>
	</form>
	
	<?php
		if(isset($_GET['back']))
		{
			unset($_SESSION['Sname']);
			unset($_SESSION['Semail']);
			unset($_SESSION['Smsg']);
		}
	?>
<div>
</body>
</html>
