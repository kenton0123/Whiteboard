<?php
session_start();

if($_SESSION['identity'] == 'Student'  ){
	header("Location: stdpolling.php");
}else {
	header("Location: teachpolling.php");
}
?>
