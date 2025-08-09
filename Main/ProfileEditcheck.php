
<?php
	session_start();
	require_once 'db.php';
	include 'functions.php';
	include 'top-nav.php'; 
    include 'left-nav.php'; 
	$id		= $_SESSION['id'];
	$name	= $_POST['name'];
	$email	= $_POST['email'];
	$question_type	= $_POST['question_type'];
	$answer	= $_POST['answer'];
	$sql	= "Update user set Name = '".$name."' where ID = '".$id."'";
	$result	= mysqli_query($conn,$sql);
	$sql	= "Update user set email = '".$email."' where ID = '".$id."'";
	$result	= mysqli_query($conn,$sql);
	$sql	= "Update user set saftyquestion = '".$question_type."' where ID = '".$id."'";
	$result	= mysqli_query($conn,$sql);
	$sql	= "Update user set Answer = '".$answer."' where ID = '".$id."'";
	$result	= mysqli_query($conn,$sql);
	$message = "Your update success!<br>";
?>
<?=template_header()?>
<html lang='en'>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Whiteboard - Main Page</title>
<link rel="stylesheet" href="main.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<?=template_header()?>
<style>
  <!--Start of LeungWH's style-->
  h2, h3.al{
	margin-left:40px;
  }
  p.al{
	font-size:18px;
	margin-left:80px;
	margin-right:auto;
	width:50%;
  }
  table.al{
	margin-left:215px;
	margin-top:45px;
	padding:10px;
	font-size:18px;
	min-width:600px;
  }
  td
  {
	width: 150px;
	text-align: center;
  }
</style>
</head>
<body>
<script>
</script>
	<div class="main-content">
		<h3><?php echo $message;?></h3>
	</div>
</body>
</html>