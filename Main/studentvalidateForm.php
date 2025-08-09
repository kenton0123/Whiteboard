<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("db.php");
session_start();

// Function to validate email format
function validEmailtype($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

// Function to validate email uniqueness
function validEmail($email)
{
    global $conn;

    $email = mysqli_real_escape_string($conn, $email);

    $sql = "SELECT email FROM user WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        return false; // Email already exists, return false
    }

    return true; // Email is unique, return true
}

// Function to validate password format
function validPassword($password)
{
    return preg_match('/^(?=.*[a-z])(?=.*[A-Z]).{8,}$/', trim($password));
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
if (!empty($_POST["name"]) && validEmailtype($_POST["email"]) && validPassword($_POST["password"])) {
    $name = ucwords(strtolower(trim($_POST['name'])));
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];

    if (validEmail($email)) {
		$stmt = $conn->prepare("INSERT INTO user (ID, Name, Pw, email) VALUES (?, ?, ?, ?)");
		$stmt->bind_param("ssss", $newId, $name, $password, $email);
		$stmt->execute();
        /*$sql = "INSERT INTO user (ID,Name, Pw, email) VALUES ('$newId','$name', '$password', '$email')";
        if (mysqli_query($conn, $sql)) {
            echo "<br/>Record inserted successfully.<br/>";
        } else {
            echo "<br/>Error inserting record: " . mysqli_error($conn) . "<br/>";
        }*/
        unset($_SESSION['Sname']);
        unset($_SESSION['Semail']);
        unset($_SESSION['Smsg']);

        header("Location: AdminPage.php");
        exit();
    } else {
        $message = "ERROR!<br>";
        $message .= "The email has already been used. <br>";

        $_SESSION['Sname'] = $_POST['name'];
        $_SESSION['Semail'] = $_POST['email'];
        $_SESSION['Smsg'] = $message;

        header("Location: AdminPage.php");
        exit();
    }
} else {
    $message = "ERROR!<br>";

    if (empty($_POST["name"])) {
        $message .= "Please enter your name. <br>";
    }

    if (!validPassword($_POST["password"])) {
        $message .= "The password should be 8 or more characters with at least one uppercase and one lowercase character. <br>";
    }

    if (!validEmailtype($_POST["email"])) {
        $message .= "Please enter a valid email address. <br>";
    }

    $_SESSION['Sname'] = $_POST['name'];
    $_SESSION['Semail'] = $_POST['email'];
    $_SESSION['Smsg'] = $message;

    header("Location: AdminPage.php");
    exit();
}
?>
