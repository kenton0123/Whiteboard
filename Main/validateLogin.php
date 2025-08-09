<?php
// Retrieve the submitted student ID and password
$id = trim($_POST['id']);
$pwd = trim($_POST['pw']);

// Check if the password is empty
if (empty($pwd)) {
    setcookie('loginError', 'Please enter a password', time() + 60, '/');
    header("Location: login.php?error=1");
    exit();
}

// Include the database connection file
include 'db.php';

// Prepare the SQL statement to retrieve the user record based on the student ID
$stmt = $conn->prepare("SELECT ID, Pw FROM user WHERE ID = ?");
$stmt->bind_param("s", $id);
$stmt->execute();

// Get the result
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    // Account does not exist
	setcookie('loginError', 'Account does not exist', time() + 60, '/');
	header("Location: login.php?error=1");
	exit();
}

$row = $result->fetch_assoc();

// Verify the submitted password against the stored password
    if (password_verify($pwd, $row['Pw'])) {
		
		//identity check
		$identity = '';
		$firstChar = substr($id, 0, 1);
		if ($firstChar === 'S') {
			$identity = 'Student';
		} elseif ($firstChar === 'T') {
			$identity = 'Teacher';
		} else {
			$identity = 'Admin';
		}
		
		// Update the last login date and time
        $currentDateTime = date("Y-m-d H:i:s");
        $updateStmt = $conn->prepare("UPDATE user SET Last_login_time = ? WHERE ID = ?");
        $updateStmt->bind_param("ss", $currentDateTime, $id);
        $updateStmt->execute();

        session_start();
		$_SESSION['id'] = $id;//for further use
		$_SESSION['identity'] = $identity;
        header("Location: mainpage.php");
        exit();
    }
	else {
        // Incorrect password
        setcookie('loginError', 'Wrong Student ID or Password', time() + 60, '/');
        header("Location: login.php?error=1");
        exit();
    }
// Close the database connection
$stmt->close();
$conn->close();
?>