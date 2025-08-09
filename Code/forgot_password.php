<link rel="stylesheet" href="main.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<?php
// if the loginError cookie exist
if (isset($_COOKIE['fgError'])) {
    $errorMessage = $_COOKIE['fgError'];
    // Delete cookie
    setcookie('fgError', '', time() - 600, '/');
	}
	
//If there are error in validation
session_start();

$email = '';
$questionType = '';
$answer = '';

if (isset($_SESSION['forgot_password_data'])) {
    $form_data = $_SESSION['forgot_password_data'];
    $email = $form_data['email'];
    $questionType = $form_data['question_type'];
    $answer = $form_data['answer'];

    // Clear the session data
    unset($_SESSION['forgot_password_data']);
}
?>

<html>
<title>Forgot Password</title>

<body>
<br/><br/><div><i class="fas fa-chalkboard"></i><span>Whiteboard</span></div><br/>
    <h1>Forgot Password</h1>

    <form method="post" action="validate_forgot_password.php">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required value="<?php echo $email; ?>"><br><br>
		
		<select id="question_type" name="question_type" required>
            <option value="">Select a Safety Question</option>
            <option value="1" <?php if ($questionType == '1') echo 'selected'; ?>>What is your first pet's name?</option>
            <option value="2" <?php if ($questionType == '2') echo 'selected'; ?>>What is first teacher's name?</option>
            <option value="3" <?php if ($questionType == '3') echo 'selected'; ?>>What is your favorite color?</option>
        </select><br>
        <input type="text" id="answer" name="answer" required value="<?php echo $answer; ?>"><br>

        <input type="submit" value="Submit">
    </form>
	<?php
	// Display the error message if it exists
	if (isset($errorMessage)) {
		echo "<p style='color:#ff0000'>$errorMessage</p>";
	}
	?>
</body>

</html>