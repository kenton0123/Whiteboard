<?php
	//host name, database name, username and password
	$dbhostname = "localhost";
	$dbname = "GP";
	$dbusername = "root";
	$dbpassword = "KQ:DhbCG/cM6";
	
	//connect and check
	$conn = mysqli_connect($dbhostname,$dbusername,$dbpassword,$dbname);
	
	if(!$conn)
		die("connection failed: ".mysqli_connect_error());
?>