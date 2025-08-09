<link rel="stylesheet" href="main.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<br/><br/><div><i class="fas fa-chalkboard"></i><span>Whiteboard</span></div><br/>
<?php
session_start();
unset($_SESSION['reset_data']);
include 'db.php';
//If there is $_Session[reset_data], that's mean redirected to this page, cant get value from Post method
if (isset($_SESSION['reset_data'])){
	$reset_data = $_SESSION['reset_data'];
	$email = $reset_data['email'];
	$question_type = $reset_data['safety_question'];
	$answer = $reset_data['answer'];
	
	// Clear the session data
    unset($_SESSION['reset_data']);
}
else{
	$email = trim($_POST['email']);
	$question_type = trim($_POST['question_type']);
	$answer = trim($_POST['answer']);
}


// Prepare the SQL statement to retrieve the user record based on the email
$stmt = $conn->prepare("SELECT ID, saftyquestion, Answer FROM user WHERE Email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();

// Get the result
$result = $stmt->get_result();

$row = $result->fetch_assoc();
$dbanswer = $row['Answer'];
$safetyQuestion = $row['saftyquestion'];
$id = $row['ID'];

// Check if the safety question answer matches
if (($question_type == $safetyQuestion)&&($answer == $dbanswer)) {
	//succes then unset session for data in forgot_password.php
	unset($_SESSION['form_data']);
	if (isset($_COOKIE['resetError'])) {
    $errorMessage = $_COOKIE['resetError'];
    // Delete cookie
    setcookie('resetError', '', time() - 600, '/');
	}
	$_SESSION['ID'] = $id;// for reset password
	
	//If new password is same as old password, will redirect back to this page and the value got from Post method will lost
	$_SESSION['reset_data'] = [
        'email' => $email,
        'safety_question' => $question_type,
        'answer' => $answer
    ];
	
    // Display the password recovery information
    echo "ID: $id<br>";
	echo "Email: $email<br>";
    echo "<br>You can now reset your password.";
	// Password reset function
?>
	<script>
        function validatePassword() {
            var newPassword = document.getElementById("new_password");
            var confirmPassword = document.getElementById("verify_password");
            var error_message = document.getElementById("error_message");

            if (newPassword.value !== confirmPassword.value) {
                error_message.innerHTML = "Passwords do not match.";
				verify_password.setCustomValidity("Passwords do not match."); //Form cant submit
            } else {
                error_message.innerHTML = "";
				verify_password.setCustomValidity("");
            }
        }
    </script>
	<form method="post" action="reset_password.php">
        <label for="new_password">New Password:</label>
        <input type="password" id="new_password" name="new_password" required pattern="(?=.*[a-z])(?=.*[A-Z]).{8,}" 
		title="Password must be at least 8 characters long and contain at least one lowercase letter, and one uppercase letter."><br><br>

        <label for="verify_password">Verify Password:</label>
        <input type="password" id="verify_password" name="verify_password" required oninput="validatePassword()">
        <span id="error_message" style="color: red;"></span><br><br>

        <input type="submit" value="Reset Password">
    </form>
	<?php
	// Display the error message if it exists
	if (isset($errorMessage)) {
		echo "<p style='color:#ff0000'>$errorMessage</p>";
	}
	?>
<?php
} 
else {
	//If not match the data inputted will still remain
	$_SESSION['forgot_password_data'] = [
        'email' => $email,
        'question_type' => $question_type,
        'answer' => $answer
    ];
	setcookie('fgError', 'Incorrect Email or Safety question answer', time() + 60, '/');
    header("Location: forgot_password.php?error=1");
	exit();
}
	
// Close the database connection
$stmt->close();
$conn->close();
?>