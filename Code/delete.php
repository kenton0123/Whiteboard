<?php
	include("database.php");
	$id = $_GET['id'];
	$type = $_GET['type'];

	
	$sql = "DELETE FROM user where ID = '$id' ";
	
	$result = mysqli_query($conn, $sql);
	
	if($result)
	{
		echo "<br>delete successfully</br>";
	}
	else
	{
		echo "<br>delete is failed</br>";
	}

	$temp = $type."view";
	header("Location: $temp.php");
?>
