<?php
include 'functions.php';
include 'left-nav.php';
include 'top-nav.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check that the poll ID exists
if (isset($_GET['id'])) {
    // Select the record that is going to be deleted
    $stmt = $pdo->prepare('SELECT * FROM polls WHERE id = ?');
    $stmt->execute([ $_GET['id'] ]);
    $poll = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$poll) {
        header('Location: polling.php');
    }
    // Make sure the user confirms beore deletion
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            // User clicked the "Yes" button, delete record
            $stmt = $pdo->prepare('DELETE FROM polls WHERE id = ?');
            $stmt->execute([ $_GET['id'] ]);
            // We also need to delete the answers for that poll
            $stmt = $pdo->prepare('DELETE FROM poll_answers WHERE poll_id = ?');
            $stmt->execute([ $_GET['id'] ]);
			// We also need to delete the answers for poll student
            $stmt = $pdo->prepare('DELETE FROM poll_student WHERE poll_id = ?');
            $stmt->execute([ $_GET['id'] ]);
            // Output msg
            $msg = 'You have deleted the poll!';			
        } else {
            // User clicked the "No" button, redirect them back to the home/polling page
            header('Location: polling.php');
            exit;
        }
    }
} else {
    header('Location: polling.php');
}
?>
<?=template_header()?>
<br/><br/><br/><br/><br/>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body>
<div class="content delete">
	<h2>Delete Poll [<?=$poll['title']?>]</h2>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php else: ?>
	<p>Are you sure you want to delete poll [<?=$poll['title']?>]?</p>
	<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
    <div class="yesno">
        <a href="delete.php?id=<?=$poll['id']?>&confirm=yes">Yes</a>
        <a href="delete.php?id=<?=$poll['id']?>&confirm=no">Go Back</a>
    </div>
	
    <?php endif; ?>
</div>

</body>
</html>