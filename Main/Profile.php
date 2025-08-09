<?php
	session_start();
	include 'functions.php';
	include 'db.php';
	include 'left-nav.php';
	include 'top-nav.php';
	//Connecting data with id
	$id		= $_SESSION['id'];
	$sql	= "Select * from user where id = '".$id."'";
	$result	= mysqli_query($conn,$sql);
	$row	= mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Whiteboard - Profile</title>
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
	background-color:#ffffff;
	padding:10px;
	font-size:18px;
	width:900px;
  }
  td.al1
  {
	width:100px;
	font-size:18px;
	text-align:center;
  }
  td.al2
  {
	width:350px;
	font-size:18px;
  }
  td.al3
  {
	width:450px;
	text-align:center;
  }

  <!--End of LeungWH's style-->
</style>
</head>
<body>
<script>
  function toeditprofile(){
	window.location.href = "ProfileEdit.php";
  }

  function todelac(){
	window.location.href = "delac.php";
  }
</script>

<div class="main-content">
	<table class="al">
		<tr>
			<td class="al1" rowspan="4"><img src="DefaultUser.jpg" style="width:150px;height:150px;"></td>
			<td class="al1">ID: </td>
			<td class="al2">
			<?php
				echo $row['ID'];
			?>
			</td>
		</tr>
		<tr>
			<td class="al1">Name: </td>
			<td class="al2">
			<?php
				echo $row['Name'];
			?>
			</td>
		</tr>
		<tr>
			<td class="al1">Email: </td>
			<td class="al2">
			<?php
				echo $row['email'];
			?>
			</td>
		</tr>
		<tr>
			<td class="al1">Safty Question: </td>
			<td class="al2">
			<?php
				if ($_SESSION['identity'] == 'Admin') {
					$question = ""; // Admins have no safety question
				} else {
					if ($row['saftyquestion'] == "1"){
						$question = "What is your first pet's name?";
					}
					elseif ($row['saftyquestion'] == "2"){
						$question = "What is first teacher's name?";
					}
					elseif ($row['saftyquestion'] == "3"){
						$question = "What is your favorite color?";
					}
					else {
						$question = "You haven't select a Safty question. Please update your Profile.";
					}
				}
				echo $question;
			?>
			</td>
		</tr>
	</table>
	<table  class="al">
		<tr>
			<td class="al3">
			<input type="button" id="editprofile" value="Edit Profile" onclick="toeditprofile()" style="font-size:18px;border-color:#292961"/>
			</td>
			<td class="al3">
			<input type="button" id="deleteac" value="Deleted Account" onclick="todelac()" style="font-size:18px;border-color:#292961"/>
			</td>
		</tr>
	</table>
</div>
</body>
</html>