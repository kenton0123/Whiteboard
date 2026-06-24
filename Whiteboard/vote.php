<?php
include 'functions.php';
include 'left-nav.php';
include 'top-nav.php';

// Connect to MySQL
$pdo = pdo_connect_mysql();

// If the GET request "id" exists (poll id)...
if (isset($_GET['id'])) {
    // Save poll id to session
    $pollid = $_GET['id'];

    // MySQL query that selects the poll records by the GET request "id"
    $stmt = $pdo->prepare('SELECT * FROM polls WHERE id = ?');
    $stmt->execute([$_GET['id']]);

    // Fetch the record
    $poll = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if the poll record exists with the id specified
    if ($poll) {
        // Save poll answer id to session
        $pollansid = $_GET['id'];

        // MySQL query that selects all the poll answers
        $stmt = $pdo->prepare('SELECT * FROM poll_answers WHERE poll_id = ?');
        $stmt->execute([ $_GET['id'] ]);
        // Fetch all the poll anwsers
        $poll_answers = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
        // MySQL query that selects the poll answer chosen by the student
        $stmt = $pdo->prepare('SELECT * FROM poll_student WHERE poll_id = ? AND student_id = ?');
        $stmt->execute([$pollid, $_SESSION['id']]);
        $stupoll = $stmt->fetch(PDO::FETCH_ASSOC);
		
        // If the user clicked the "Vote" button and hasn't voted before...
        if (isset($_POST['poll_answer'])){
			 if (empty($stupoll)) {
            // Decrement the votes of the previously selected answer (if any)
            $stmt = $pdo->prepare('UPDATE poll_answers SET votes = votes - 1 WHERE id = ?');
            $stmt->execute([$pollansid]);

            // Update and increase the vote for the answer the user voted for
            $stmt = $pdo->prepare('UPDATE poll_answers SET votes = votes + 1 WHERE id = ?');
            $stmt->execute([$_POST['poll_answer']]);

            // Insert the student's vote into the poll_student table
            $stmt = $pdo->prepare('INSERT INTO poll_student (poll_id, student_id, poll_ans_id) VALUES (?, ?, ?)');
            $stmt->execute([$pollid, $_SESSION['id'], $_POST['poll_answer']]);

            // Redirect user to the result page
            header('Location: pollresult.php?id=' . $_GET['id']);
            exit;
			
			} else {
				header('Location: pollalready.php');
			}
		}
    } else {
        exit('Poll with that ID does not exist.');
    }
} else {
    exit('No poll ID specified.');
}
?>
<?=template_header()?>
<br/><br/><br/><br/><br/>

<div class="content poll-vote">
	<h2><?=$poll['title']?></h2>
	<p><?=$poll['description']?></p>
    <form action="vote.php?id=<?=$_GET['id']?>" method="post">
        <?php for ($i = 0; $i < count($poll_answers); $i++): ?>
        <label>
            <input type="radio" name="poll_answer" value="<?=$poll_answers[$i]['id']?>"<?=$i == 0 ? ' checked' : ''?>>
            <?=$poll_answers[$i]['title']?>
        </label>
        <?php endfor; ?>
        <div>
            <input type="submit" value="Vote">
			<a href="polling.php">Go Back</a>
        </div>
    </form>
</div>