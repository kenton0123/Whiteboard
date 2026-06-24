<?php
// Include the database connection file
include 'db.php';

// Admin details
$adminID = 'A1';
$adminName = 'Admin'; 
$email = 'aaa@admin.com';
$password = '12345678aA';

// Hash the password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Prepare and execute the SQL statement to insert the admin data into the table
$stmt = $conn->prepare("INSERT INTO user (ID, Name, Pw, email) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss",$adminID, $adminName, $hashedPassword, $email);

$stmt->execute();

// Check if the insertion was successful
if ($stmt->affected_rows === 1) {
    // Admin account created successfully
    echo "Admin account created successfully!<br>";
    echo "Admin Name: " . $adminName . "<br>";
    echo "Email: " . $email;
} else {
    // Admin account creation failed
    echo "Failed to create admin account.";
}

// Close the statement
$stmt->close();

// Close the database connection
$conn->close();
?>