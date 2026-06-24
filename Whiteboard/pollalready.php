<?php
// Include the function file
include 'functions.php';
include 'left-nav.php';
include 'top-nav.php';
// Connect to MySQL
$pdo = pdo_connect_mysql();

?>

<?=template_header()?>
<br/><br/><br/><br/><br/>
<div class="content poll-result">
	<h2>You have already voted!</h2>

			<a href="polling.php" class="goback">Go Back</a>

</div>
