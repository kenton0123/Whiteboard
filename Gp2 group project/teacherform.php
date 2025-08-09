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
	$name = isset($_SESSION["Tname"]) ? $_SESSION["Tname"] : "";
	$email = isset($_SESSION["Temail"]) ? $_SESSION["Temail"] : "";
	$msg = isset($_SESSION["Tmsg"]) ? $_SESSION["Tmsg"] : "";
?>

<html>
<body>
<div class="main-content">

	<p style="color:#ff0000";><?= $msg ?></p>
	
	<form method="POST" action ="teachervalidateForm.php">
		<table style="width:100%">		
			<tr>
				<th>Teacher Name:</th>
				<th><input type="text" placeholder="Teacher Name" name="name" id="name" required value="<?= $name ?>"></th>
			</tr>
		
			<tr>
				<th>Password:</th>
				<th><input type="text" placeholder="Password" name="password" id="password" required></th>
			</tr>
		
			<tr>
				<th>Email:</th>
				<th><input type="email" placeholder="XXX@xxx" name="email" id="email" required value="<?= $email ?>"></th>
			</tr>
		
			<tr>
				<th colspan="2"><input type="submit" id="button" name="Submit" value="Submit" ></th>
			</tr>
		</table>
	</form>
	
	<?php
		if(isset($_GET['back']))
		{
			unset($_SESSION['Tname']);
			unset($_SESSION['Temail']);
			unset($_SESSION['Tmsg']);
		}
	?>
	
<div>
</body>
</html>
