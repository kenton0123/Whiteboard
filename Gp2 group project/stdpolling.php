<?php
// Include the function file
include 'functions.php';
include 'left-nav.php';
include 'top-nav.php';

// Connect to MySQL
include 'db.php';
// MySQL query that retrieves all the polls and poll answers
$sql = "SELECT p.*, GROUP_CONCAT(pa.title ORDER BY pa.id) AS answers FROM polls p LEFT JOIN poll_answers pa ON pa.poll_id = p.id GROUP BY p.id";
$polls = $conn->query($sql);
?>

<?=template_header()?>
<br/><br/><br/><br/><br/>
<div class="content home">
	<h2>Polling</h2>
	<p>Welcome to the home page! You can view the list of polls and vote below.</p>
	<table>
        <thead>
            <tr>
                <td>Title</td>
				<td>Description</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach($polls as $poll): ?>
            <tr>
                <td><?=$poll['title']?></td>
				<td><?=$poll['description']?></td>
                <td class="actions">
					<a href="pollresult.php?id=<?=$poll['id']?>" class="view" title="Check Result"><i class="fas fa-compass"></i></a> 
					<a href="vote.php?id=<?=$poll['id']?>" class="view" title="View Poll"><i class="fas fa-eye fa-xs"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

