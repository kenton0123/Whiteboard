<link rel="stylesheet" href="main.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<?php
//If there are error in validation
if (isset($_COOKIE['errorMsgcreate'])) {
    $errorMessage = $_COOKIE['errorMsgcreate'];
    // Delete cookie
    setcookie('errorMsgcreate', '', time() - 600, '/');
	}

//If there are error in validation
session_start();

$student_name = '';
$email = '';
$safety_question = '';
$answer = '';

if (isset($_SESSION['form_data'])) {
    $form_data = $_SESSION['form_data'];
    $student_name = $form_data['student_name'];
	$email = $form_data['email'];
    $safety_question = $form_data['safety_question'];
    $answer = $form_data['answer'];

    // Clear the session data
    unset($_SESSION['form_data']);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Create Account</title>
	<script>
		//check if the confirm password is same as password entered while the user is entering
        function validatePassword() {
            var password = document.getElementById("password");
            var confirm_password = document.getElementById("confirm_password");
            var error_message = document.getElementById("error_message");

            if (password.value !== confirm_password.value) {
                error_message.innerHTML = "Passwords do not match.";
                confirm_password.setCustomValidity("Passwords do not match."); //Form cant submit
            } else {
                error_message.innerHTML = "";
                confirm_password.setCustomValidity("");
            }
        }
    </script>
</head>
<body>
<br/><br/><div><i class="fas fa-chalkboard"></i><span>Whiteboard</span></div><br/>
    <h1>Create Account</h1>
    <form method="post" action="Createverify.php">
        <label for="student_name">Student Name:</label>
        <input type="text" id="student_name" name="student_name" required value="<?php echo $student_name; ?>"><br><br>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required pattern="(?=.*[a-z])(?=.*[A-Z]).{8,}" 
		title="Password must be at least 8 characters long and contain at least one lowercase letter, and one uppercase letter."><br><br>
        
		<label for="confirm_password">Confirm Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" required oninput="validatePassword()">
        <span id="error_message" style="color: red;"></span><br><br>
		
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,3}$"
		value="<?php echo $email; ?>"><br><br>
        
        <label for="safety_question">Safety Question:</label>
        <select id="safety_question" name="safety_question" required>
            <option value="">Select a Safety Question</option>
            <option value="1" <?php if ($safety_question == '1') echo 'selected'; ?>>
			What is your first pet's name?</option>
            <option value="2" <?php if ($safety_question == '2') echo 'selected'; ?>>
			What is first teacher's name?</option>
            <option value="3" <?php if ($safety_question == '3') echo 'selected'; ?>>
			What is your favorite color?</option>
        </select><br><br>
        
        <label for="answer">Answer:</label>
        <input type="text" id="answer" name="answer" required value="<?php echo $answer; ?>"><br><br>
        
        <input type="submit" value="Create Account">
    </form>
	<?php if (!empty($errorMessage)) { ?>
        <p style="color: red;"><?php echo $errorMessage; ?></p>
    <?php } ?>
</body>
</html>