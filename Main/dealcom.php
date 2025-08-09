<?php
	session_start();
	require_once 'db.php';
	$msag	 = $_POST['msag'];
	$id	= $_SESSION['id'];
	
	$sql = "INSERT INTO `discuss` (`dis_id`, `com_time`, `studentid`, `msag`) VALUES (NULL, current_timestamp(), '$id' ,'$msag');";	
	mysqli_query($conn, $sql);
	
	header("Location: comment.php");
	
?>