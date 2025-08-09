<?php
session_start();
?>
<div class="nav-bar">
  <ul>
    <li><div class="speed-label">SPEED</div></li>
    <li><a href="Profile.php"><i class="fas fa-user-circle"></i>Profile</a></li>
    <li><a href="Calendar.php"><i class="fas fa-calendar-alt"></i>Calendar</a></li>
    <li><a href="content.php"><i class="fas fa-solid fa-list"></i>Content</a></li>
    <li><a href="comment.php"><i class="fas fa-comments"></i>Forum</a></li>
    <li><a href="assessment.php"><i class="fas fa-clipboard-list"></i>Assessment</a></li>
    <li><a href="AboutUs.php"><i class="fas fa-info-circle"></i>About Us</a></li>
    <li><a href="polling.php"><i class="fas fa-poll-h"></i>Polling</a></li>
    <div class="separator"></div>
    <?php
    

    if ($_SESSION['identity'] == 'Admin') {
        echo '<li><a href="AdminPage.php"><i class="fas fa-user-shield"></i>Admin</a></li>';
    }
    ?>
    <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout Account</a></li>
  </ul>
</div>