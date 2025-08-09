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
	background-color:#ffffff;
	padding:10px;
	font-size:18px;
	min-width:600px;
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
	width:300px;
	text-align:center;
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
		<form method="post" action="ProfileEditcheck.php">
		<table border="2" class="al" >


		<tr>
			<td class="al1">ID: </td>
			<td><span style="font-size:18px;">
			<?php
				echo $row['ID'];
			?>
			</td></span>
		</tr>
		<tr>
			<td class="al1">Name: </td>
			<td>
			<input type="text" size="20" id="name" name="name" value="<?= $row['Name'] ?>" style="font-size:18px;"/>
			</td></span>
		</tr>
		<tr>
			<td class="al1">Email: </td>
			<td>
			<input type="text" size="20" id="email" name="email" placeholder="example@gmail.com" value="<?= $row['email'] ?>" style="font-size:18px;"/>
			</td>
		</tr>
		<tr>
			<td class="al2">Safty Question: </td>
			<td>
			<select id="question_type" name="question_type" required>
				<option value="">Select a Safety Question</option>
				<option value="1" <?php if ($row['saftyquestion'] == '1') echo 'selected'; ?>>What is your first pet's name?</option>
				<option value="2" <?php if ($row['saftyquestion'] == '2') echo 'selected'; ?>>What is first teacher's name?</option>
				<option value="3" <?php if ($row['saftyquestion'] == '3') echo 'selected'; ?>>What is your favorite color?</option>
			</select><br>
			<input type="text" id="answer" name="answer" required value="<?php echo htmlspecialchars($row['Answer']); ?>">
			</td></span>
		</tr>
		<tr>
			<td><input type="reset" id="reset" value="Reset" style="font-size:18px;border-color:#292961"/></td>
            <td><input type="submit" id="btn-submit" value="Reserve Now" style="font-size:18px;border-color:#292961"/></td>
		</tr>
		</table>
		</form>
	</div>
</body>
</html>