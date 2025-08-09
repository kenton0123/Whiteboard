<!DOCTYPE html>
<html>
<head>
    <title>Assessments</title>
    <style>
        .main-content {
            margin-left: 215px;
            margin-top: 0px;
            padding: 25px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        h2 {
            color: #2c3e50;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
            margin-bottom: 25px;
        }
        
        h3 {
            color: #34495e;
            margin-top: 20px;
        }
        
        h4 {
            color: #2980b9;
            margin-top: 15px;
        }
        
        .assessment-card {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 25px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            border-left: 4px solid #3498db;
        }
        
        .submission-card {
            background-color: #fff;
            border-radius: 6px;
            padding: 15px;
            margin: 15px 0;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border-left: 3px solid #2ecc71;
        }
        
        .overdue {
            color: #e74c3c;
            font-weight: bold;
        }
        
        .on-time {
            color: #27ae60;
            font-weight: bold;
        }
        
        .btn {
            padding: 3px 12px;
            border-radius: 4px;
            border: none;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s ease;
			font-size: 14px;
			display: inline-flex
			align-items: center
			white-space:nowrap;
        }
        
        .btn-primary {
            background-color: #3498db;
            color: white;
        }
        
        .btn-primary:hover {
            background-color: #2980b9;
        }
        
        .btn-success {
            background-color: #2ecc71;
            color: white;
        }
        
        .btn-success:hover {
            background-color: #27ae60;
        }
        
        .form-control {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            width: 100%;
            max-width: 300px;
            margin: 5px 0;
        }
        
        .file-upload {
            margin: 15px 0;
        }
        
        .marks-form {
            margin-top: 10px;
            padding: 10px;
            background-color: #f1f8fe;
            border-radius: 4px;
        }
        
        .divider {
            border-top: 1px solid #eee;
            margin: 20px 0;
        }
        
        .status-badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: bold;
            margin-left: 10px;
        }
        
        .badge-danger {
            background-color: #fadbd8;
            color: #e74c3c;
        }
        
        .badge-success {
            background-color: #d5f5e3;
            color: #27ae60;
        }
        
        .no-assessments {
            text-align: center;
            padding: 30px;
            color: #7f8c8d;
            font-style: italic;
        }
    </style>
</head>
<body>
<?php session_start(); ?>
<?php include 'functions.php';?>
<?=template_header()?>

<link rel="stylesheet" href="main.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

<?php include 'top-nav.php'; ?>
<?php include 'left-nav.php'; ?>

<?php
echo "<div class='main-content'>";
include("db.php");

// Retrieve assessments from the database
$sql = "SELECT id, title, filename, filepath, file_type, deadline, created_at FROM files WHERE file_type = 'assessment'";
$result = $conn->query($sql);

echo "<h2><i class='fas fa-tasks'></i> Assessments</h2>";

if ($result->num_rows > 0) {
    // Divide the display based on the user's identity
    if ($_SESSION['identity'] === 'Teacher') {
        echo "<h3><i class='fas fa-chalkboard-teacher'></i> Teacher View</h3>";

        // Display each assessment 
        while ($row = $result->fetch_assoc()) {
            $assessmentId = $row["id"] ?? "";
            $title = $row["title"];
            $fileName = $row["filename"];
            $filePath = $row["filepath"];
            $deadline = $row["deadline"];

            echo "<div class='assessment-card'>";
            echo "<h4>$title</h4>";
            echo "<p><strong><i class='fas fa-file-alt'></i> File:</strong> <a href='$filePath' download>$fileName</a></p>";
            echo "<p><strong><i class='far fa-clock'></i> Deadline:</strong> $deadline</p>";

            // Retrieve submissions for the assessment
            $submissionsSql = "SELECT id, student_id, file_name, file_path, mark, submitted_at FROM submissions WHERE assessment_id = '{$assessmentId}'";
            $submissionsResult = $conn->query($submissionsSql);

            if ($submissionsResult->num_rows > 0) {
                echo "<h5><i class='fas fa-paper-plane'></i> Submissions</h5>";

                // Display submissions
                while ($submissionRow = $submissionsResult->fetch_assoc()) {
                    $submissionId = $submissionRow["id"];
                    $studentId = $submissionRow["student_id"];
                    $fileName = $submissionRow["file_name"];
                    $filePath = $submissionRow["file_path"];
                    $mark = $submissionRow["mark"];
                    $submittedDateTime = $submissionRow["submitted_at"];
                    
                    $isOverdue = ($submittedDateTime > $deadline);

                    echo "<div class='submission-card'>";
                    echo "<p><strong><i class='fas fa-user-graduate'></i> Student ID:</strong> $studentId</p>";
                    echo "<p><strong><i class='fas fa-file-upload'></i> Submitted file:</strong> <a href='$filePath' download>$fileName</a></p>";
                    echo "<p><strong><i class='fas fa-calendar-check'></i> Submitted at:</strong> $submittedDateTime";
                    
                    if ($isOverdue) {
                        echo " <span class='status-badge badge-danger'><i class='fas fa-exclamation-circle'></i> Overdue</span>";
                    } else {
                        echo " <span class='status-badge badge-success'><i class='fas fa-check-circle'></i> On Time</span>";
                    }
                    echo "</p>";
                    
                    if (!is_null($mark)) {
                        echo "<p><strong><i class='fas fa-star'></i> Marks:</strong> $mark</p>";
                    }
                    
                    echo "<div class='marks-form'>";
                    echo "<form action='' method='post'>";
                    echo "<input type='hidden' name='submission_id' value='$submissionId'>";
                    echo "<label for='marks'><i class='fas fa-edit'></i> Grade this submission:</label><br>";
                    echo "<input type='number' name='marks' placeholder='Enter marks' class='form-control' required>";
                    echo "<button type='submit' name='submit_marks' class='btn btn-primary'><i class='fas fa-save'></i> Submit Marks</button>";
                    echo "</form>";
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "<p class='no-submissions'><i class='fas fa-info-circle'></i> No submissions yet.</p>";
            }
            echo "</div>";
        }
    } elseif ($_SESSION['identity'] === 'Student') {
        echo "<h3><i class='fas fa-user-graduate'></i> Student View</h3>";

        // Display each assessment 
        while ($row = $result->fetch_assoc()) {
            $assessmentId = $row["id"] ?? "";
            $title = $row["title"];
            $fileName = $row["filename"];
            $filePath = $row["filepath"];
            $deadline = $row["deadline"];

            echo "<div class='assessment-card'>";
            echo "<h4>$title</h4>";
            echo "<p><strong><i class='fas fa-file-alt'></i> Assessment File:</strong> <a href='$filePath' download class='btn btn-primary'><i class='fas fa-download'></i> $fileName</a></p>";
            echo "<p><strong><i class='far fa-clock'></i> Deadline:</strong> $deadline</p>";
            echo "<p><strong><i class='fas fa-id-card'></i> Your Student ID:</strong> {$_SESSION['id']}</p>";

            // Check if the student has already submitted the assessment
            $submissionSql = "SELECT id, mark, submitted_at FROM submissions WHERE assessment_id = '{$assessmentId}' AND student_id = '{$_SESSION['id']}'";
            $submissionResult = $conn->query($submissionSql);

            if ($submissionResult->num_rows > 0) {
                $submissionRow = $submissionResult->fetch_assoc();
                $submissionId = $submissionRow["id"];
                $mark = $submissionRow["mark"];
                $submittedDateTime = $submissionRow["submitted_at"];
                $isOverdue = ($submittedDateTime > $deadline);

                echo "<div class='submission-card'>";
                echo "<h5><i class='fas fa-check-circle'></i> Your Submission</h5>";
                echo "<p><strong><i class='fas fa-file-upload'></i> Submitted file:</strong> <a href='$filePath' download>$fileName</a></p>";
                echo "<p><strong><i class='fas fa-calendar-check'></i> Submitted at:</strong> $submittedDateTime";
                
                if ($isOverdue) {
                    echo " <span class='status-badge badge-danger'><i class='fas fa-exclamation-circle'></i> Overdue</span>";
                } else {
                    echo " <span class='status-badge badge-success'><i class='fas fa-check-circle'></i> On Time</span>";
                }
                echo "</p>";
                
                if (!is_null($mark)) {
                    echo "<p><strong><i class='fas fa-star'></i> Your Marks:</strong> $mark</p>";
                } else {
                    echo "<p><i class='fas fa-hourglass-half'></i> Your submission is awaiting grading.</p>";
                }
                echo "</div>";
            } else {
                // Display the submission form for students
                echo '<div class="file-upload">';
                echo '<form action="submit.php" method="post" enctype="multipart/form-data">';
                echo '<input type="hidden" name="assessment_id" value="' . $assessmentId . '">';
                echo '<input type="hidden" name="student_id" value="' . $_SESSION['id'] . '">';
                echo '<div class="form-group">';
                echo '<label for="submission_file"><i class="fas fa-upload"></i> Upload your submission:</label><br>';
                echo '<input type="file" name="submission_file" class="form-control" required>';
                echo '</div>';
                echo '<button type="submit" class="btn btn-success"><i class="fas fa-paper-plane"></i> Submit Assessment</button>';
                echo '</form>';
                echo '</div>';
            }
            echo "</div>";
        }
    }
} else {
    echo "<div class='no-assessments'>";
    echo "<i class='fas fa-folder-open fa-3x'></i><br><br>";
    echo "No assessments found.";
    echo "</div>";
}

// Process marks submission if the form is submitted
if ($_SESSION['identity'] === 'Teacher' && isset($_POST['submit_marks'])) {
    $submissionId = $_POST['submission_id'];
    $marks = $_POST['marks'];

    // Update the marks
    $updateMarksSql = "UPDATE submissions SET mark = '$marks' WHERE id = '$submissionId'";
    if ($conn->query($updateMarksSql) === TRUE) {
        echo "<script>alert('Marks submitted successfully!'); window.location.href=window.location.href;</script>";
    } else {
        echo "<script>alert('Error updating marks: " . $conn->error . "');</script>";
    }
}

echo "</div>";
$conn->close();
?>
</body>
</html>