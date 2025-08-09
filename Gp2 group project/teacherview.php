<!DOCTYPE html>

<head>
</head>

<?php
	include 'A-left-nav.php';
	include 'top-nav.php';
?>

<html>
<body>
<div class="main-content">
		<table border='3'>
			<tr>
			<th>Teacher_ID</th>
			<th>Teacher_Name</th>
			<th>Password</th>
			<th>email</th>
			<th>Last_login_time</th>
			<th colspan="2" align="center">Operation</th>
		<?php
			include("db.php");
			$sql = "SELECT * FROM user where ID like 'T%'";
			$result = mysqli_query($conn, $sql);
			$type = "teacher";
			
			if (mysqli_num_rows($result) > 0)
			{
				while($row = mysqli_fetch_assoc($result))
				{
					
					echo "<tr>
							<td>".$row["ID"]. "</td>
							<td>".$row["Name"]. "</td>
							<td>".$row["Pw"]. "</td>
							<td>".$row["email"]. "</td>
							<td>".$row["Last_login_time"]. "</td>
							
							<td> <a href = 'delete.php?id=$row[ID]&type=$type'> Delete </td>
							
							<td> <a href = 'edit.php?id=$row[ID]&name=$row[Name]&email=$row[email]&type=$type'> edit </td>
						</tr>";
				}
				echo "</table>";
			}
			else
				echo "No records";
			
		?>

<div>
</body>
</html>