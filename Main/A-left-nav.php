<?php
session_start();
?>
<link rel="stylesheet" href="main.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<div class="nav-bar">
  <ul>
  
    <li><div class="speed-label">SPEED</div></li>
    <li><a href="studentform.php"><i class="fas fa-solid fa-user-plus"></i>Create New Student Account</a></li>
    <li><a href="studentview.php"><i class="fas fa-address-card"></i>Student List</a></li>
    <li><a href="teacherform.php"><i class="fas fa-solid fa-user-plus"></i>Create New Teacher Account</a></li>
    <li><a href="teacherview.php"><i class="fas fa-address-card"></i>Teacher List</a></li>
	<li><a href="mainpage.php"><i class="fas fa-solid fa-rotate-left"></i>Return to Main Page</a></li>

    <div class="separator"></div>
    <?php
    

    if ($_SESSION['identity'] == 'Admin') {
        echo '<li><a href="AdminPage.php"><i class="fas fa-user-shield"></i>Admin</a></li>';
    }
    ?>
    <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout Account</a></li>
  </ul>
</div>