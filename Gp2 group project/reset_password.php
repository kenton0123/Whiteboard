<link rel="stylesheet" href="main.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<br/><br/><div><i class="fas fa-chalkboard"></i><span>Whiteboard</span></div><br/>
<?php
// Include the database connection file
include 'db.php';
session_start();

// Retrieve the submitted new password and verify password
$newPassword = $_POST['new_password'];
$verifyPassword = $_POST['verify_password'];
$id = $_SESSION['ID'];

// Check if the password contains spaces
function isPasswordValid($password) {
    return strpos($password, ' ') === false;
}

function doPasswordsMatch($password, $confirmPassword) {
    return $password === $confirmPassword;
}

if(!isPasswordValid($newPassword) || !doPasswordsMatch($newPassword, $verifyPassword)){
	$errorMsg = '';
	
	if (!isPasswordValid($newPassword))
		$errorMsg .= 'Password cannot contain spaces.<br>';
	if (!doPasswordsMatch($newPassword, $verifyPassword))
		$errorMsg .= 'Password and confirm password do not match.<br>';
	
	setcookie('resetError', $errorMsg, time() + 60, '/');
	header("Location: validate_forgot_password.php?error=1");
    exit();
}
/*
// Validate if the new password and verify password match
if ($newPassword !== $verifyPassword) {
    setcookie('fgError', 'Passwords do not match.', time() + 60, '/');
    header("Location: validate_forgot_password.php?error=1");
}*/ 
else {
	// Check if the new password is the same as the old password
	$checkStmt = $conn->prepare("SELECT Pw FROM user WHERE ID = ?");
	$checkStmt->bind_param("s", $id);
	$checkStmt->execute();
	$checkResult = $checkStmt->get_result();

	if ($checkResult->num_rows > 0) {
		$row = $checkResult->fetch_assoc();
		$oldPassword = $row['Pw'];

		if (password_verify($newPassword, $oldPassword)) {
			// New password is the same as the old password
			setcookie('resetError', 'New password cannot be the same as the old password.', time() + 60, '/');
			header("Location: validate_forgot_password.php?error=1");
			exit;
		}
	}

	
    // Hash the new password
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    // Update the password in the database
    $updateStmt = $conn->prepare("UPDATE user SET Pw = ? WHERE ID = ?");
    $updateStmt->bind_param("ss", $hashedPassword, $id);
    $updateResult = $updateStmt->execute();

    if ($updateResult) {
        echo "Password reset successful.";
		unset($_SESSION['reset_data']);
		header("refresh:5;url=login.php");
    } else {
        echo "Failed to reset password. Please try again.";	
    }
}

// Close the database connection
$conn->close();
?>