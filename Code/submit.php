<?php
session_start();

include("db.php");

// Retrieve the submitted form data
$assessmentId = $_POST['assessment_id'];
$studentId = $_POST['student_id'];
$submissionFile = $_FILES['submission_file'];

// Get the current date and time
$currentDateTime = date('Y-m-d H:i:s');

// Check upload
if ($submissionFile['error'] === UPLOAD_ERR_OK) {
    $fileName = $submissionFile['name'];
    $fileTmpPath = $submissionFile['tmp_name'];

    // Move the uploaded file to a desired location
    $uploadDirectory = 'uploads/';
    $fileDestination = $uploadDirectory . $fileName;
    move_uploaded_file($fileTmpPath, $fileDestination);

    // Insert the submission into the database
    $sql = "INSERT INTO submissions (assessment_id, student_id, file_name, file_path, submitted_at) 
            VALUES ('$assessmentId', '$studentId', '$fileName', '$fileDestination', '$currentDateTime')";

    if ($conn->query($sql) === TRUE) {
        echo "Assessment submitted successfully!Redirecting to Assessment Page";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "File upload error: " . $submissionFile['error'];
}

header("refresh:5;url=assessment.php");
$conn->close();
?>