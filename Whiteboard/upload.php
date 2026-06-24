<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// Check if the identity is "Teacher"
if ($_SESSION['identity'] !== 'Teacher') {
    echo "You are not authorized to upload files.";
    exit;
}

include("db.php");

$title = $_POST['title'];
$fileType = $_POST['file_type'];
$deadline = null;


// Check if the file type is "assessment" to validate the deadline field
if ($fileType === 'assessment') {
    $deadline = !empty($_POST['deadline']) ? $_POST['deadline'] : null;
    // Perform any additional validation or processing related to the deadline field if required
}

$fileName = $_FILES['file']['name'];
$fileTmpName = $_FILES['file']['tmp_name'];
$fileSize = $_FILES['file']['size'];
$fileError = $_FILES['file']['error'];

// Check upload errors
if ($fileError !== UPLOAD_ERR_OK) {
    echo "Error uploading file: " . $fileError;
    exit;
}
// Check for existing file names in the database
$sql = "SELECT COUNT(*) as count FROM files WHERE filename = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $fileName);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($row['count'] > 0) {
    // Redirect back to content page with an error message
    header("Location: content.php?error=duplicate");
    exit;
}

// File upload directory
$uploadDir = 'uploads/';
$filePath = $uploadDir . $fileName;

// Move the uploaded file to the desired directory
if (move_uploaded_file($fileTmpName, $filePath)) {
    // Insert file details into the database
    $insertSql = "INSERT INTO files (filename, filepath, title, file_type" . 
                  ($deadline ? ", deadline" : "") . 
                  ") VALUES ('$fileName', '$filePath', '$title', '$fileType" . 
                  ($deadline ? "', '$deadline'" : "'") . 
                  ")";


    if ($conn->query($insertSql) === true) {
        echo "<h3>File uploaded successfully,redirecting to content page...</h3>";
    } else {
        echo "Error uploading file: " . $conn->error;
    }
} else {
    echo "Error moving the uploaded file";
}
header("refresh:5;url=content.php");
$conn->close();
?>