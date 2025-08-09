<link rel="stylesheet" href="main.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<br/><br/><div><i class="fas fa-chalkboard"></i><span>Whiteboard</span></div><br/>
<?php
session_start();

// Include the database connection file
include 'db.php';

// Retrieve the submitted form data
$studentName = trim($_POST['student_name']);
$password = $_POST['password']; //if there is space redirect back
$confirmPassword = $_POST['confirm_password'];
$email = trim($_POST['email']);	
$safetyQuestion = trim($_POST['safety_question']);
$answer = trim($_POST['answer']);

// Check if the password contains spaces
function isPasswordValid($password) {
    return strpos($password, ' ') === false;
}

// Check if the email valid
function validEmailtype($email)
	{
		return preg_match('/^[\w.-]+@[a-zA-Z_-]+?.[a-zA-Z]{2,3}$/', trim($email));
	}

function isEmailUnique($conn, $email) {
    $checkStmt = $conn->prepare("SELECT ID FROM user WHERE email = ?");
    $checkStmt->bind_param("s", $email);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();
    
    return $checkResult->num_rows === 0;
}

function doPasswordsMatch($password, $confirmPassword) {
    return $password === $confirmPassword;
}

//validation check
if(!isPasswordValid($password) || !validEmailtype($email) || !isEmailUnique($conn, $email) || !doPasswordsMatch($password, $confirmPassword)){
	$_SESSION['form_data'] = [
        'student_name' => $studentName,
        'email' => $email,
        'safety_question' => $safetyQuestion,
        'answer' => $answer
    ];
	
	$errorMsg = '';
	
	if (!isPasswordValid($password))
		$errorMsg .= 'Password cannot contain spaces.<br>';
	if (!validEmailtype($email))
		$errorMsg .= 'Wrong email format.<br>';
	if (!isEmailUnique($conn, $email))
		$errorMsg .= 'An account with this email already exists. Please use a different email.<br>';
	if (!doPasswordsMatch($password, $confirmPassword))
		$errorMsg .= 'Password and confirm password do not match.<br>';
	
	setcookie('errorMsgcreate', $errorMsg, time() + 60, '/');
	header("Location: createacc.php");
    exit();
}

// Retrieve all existing student IDs
$stmt = $conn->prepare("SELECT ID FROM user WHERE ID LIKE 'S%'");
$stmt->execute();
$result = $stmt->get_result();
$existingIds = $result->fetch_all(MYSQLI_ASSOC);

// Find the maximum ID and increment it
$maxId = 0;
foreach ($existingIds as $row) {
    $numericPart = intval(substr($row['ID'], 1));
    if ($numericPart > $maxId) {
        $maxId = $numericPart;
    }
}


// Generate the new student ID
$newId = 'S' . ($maxId + 1);

// Hash the password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);


// Prepare and execute the SQL statement to insert the user data into the table
$stmt = $conn->prepare("INSERT INTO user (ID, Name, Pw, email, saftyquestion, Answer) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssis", $newId, $studentName, $hashedPassword, $email, $safetyQuestion, $answer);
$stmt->execute();

// Check if the insertion was successful
if ($stmt->affected_rows === 1) {
    // Password and user creation successful
    echo "Account created successfully!<br>";
	echo "Your ID is ".$newId;
	
	//succes then unset session
	unset($_SESSION['form_data']);
} else {
    // Password and user creation failed
    echo "Failed to create account.";
	echo "Error: " . $stmt->error;
}

// Close the database connection and statement
$stmt->close();
$conn->close();
?>