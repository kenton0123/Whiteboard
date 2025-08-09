<?php
$servername = "localhost";
$username = "root";
$dbpassword = "KQ:DhbCG/cM6";
$dbname = "gp";

// Create connection
$conn = mysqli_connect($servername, $username, $dbpassword, $dbname);

// Check connection
if(!$conn) 
{
  die("Connection failed: " .mysqli_connect_error());
}
echo "Connected successfully";

?>