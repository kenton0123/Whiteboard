<?php
// Start session at the very beginning
session_start();

// Include necessary files
include("db.php");
include 'functions.php';

$uploadError = '';

	// Check for error in the URL
	if (isset($_GET['error']) && $_GET['error'] === 'duplicate') {
		$uploadError = '<div class="alert alert-error">A file with the same name already exists. Please rename your file and try again.</div>';
	}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Content Page</title>
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .main-content {
            margin-left: 215px;
            padding: 25px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        h1 {
            color: #2c3e50;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        
        .upload-section {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
            border-left: 4px solid #3498db;
        }
        
        .file-section {
            margin-top: 30px;
        }
        
        .file-card {
            background: white;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .file-info {
            flex: 1;
        }
        
        .file-title {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 5px;
        }
        
        .file-name {
            color: #7f8c8d;
            font-size: 14px;
        }
        
        .file-type {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 12px;
            margin-right: 10px;
        }
        
        .type-assessment {
            background: #e3f2fd;
            color: #1976d2;
        }
        
        .type-notes {
            background: #e8f5e9;
            color: #388e3c;
        }
        
        .btn {
            padding: 8px 15px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 14px;
            margin-left: 10px;
            display: inline-block;
        }
        
        .btn-download {
            background: #3498db;
            color: white;
        }
        
        .btn-download:hover {
            background: #2980b9;
        }
        
        .btn-delete {
            background: #e74c3c;
            color: white;
        }
        
        .btn-delete:hover {
            background: #c0392b;
        }
        
        .form-input {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            width: 100%;
            max-width: 400px;
            margin-bottom: 15px;
        }
        
        .form-submit {
            background: #3498db;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        
        .form-submit:hover {
            background: #2980b9;
        }
        
        .empty-message {
            text-align: center;
            color: #7f8c8d;
            padding: 30px;
        }
        
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        
        .alert-success {
            background: #d4edda;
            color: #155724;
        }
        
        .alert-error {
            background: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>

<?php 
// Include navigation after session start
include 'top-nav.php'; 
include 'left-nav.php';
echo template_header();
?>

<div class='main-content'>
    <h1>Course Content</h1>

    <?php
	// Display upload error if it exists
    if ($uploadError) {
        echo $uploadError;
    }
	
    // Show success/error messages
    if (isset($_GET['delete']) && isset($_GET['fileId']) && isset($_GET['filepath'])) {
    $filePath = urldecode($_GET['filepath']);
    $fileId = intval($_GET['fileId']);
    
    // Check if the file exists before deleting
    if (file_exists($filePath)) {
        // Attempt to delete the file
        if (unlink($filePath)) {
            // File deleted successfully, now delete from the database
            $deleteSql = "DELETE FROM files WHERE id = $fileId";
            if ($conn->query($deleteSql)) {
                echo '<div class="alert alert-success">File deleted successfully</div>';
            } else {
                echo '<div class="alert alert-error">Error deleting file record: '.$conn->error.'</div>';
            }
        } else {
            echo '<div class="alert alert-error">Error deleting the file from the server</div>';
        }
    } else {
        echo '<div class="alert alert-error">File does not exist</div>';
		}
	}
    ?>

    <?php if (isset($_SESSION['identity']) && $_SESSION['identity'] === 'Teacher'): ?>
    <div class="upload-section">
        <h3>Upload New File</h3>
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <input type="text" class="form-input" name="title" placeholder="File Title" required>
            
            <select class="form-input" name="file_type" onchange="toggleDeadline(this)">
                <option value="notes">Notes</option>
                <option value="assessment">Assessment</option>
            </select>
            
            <div id="deadlineField" style="display:none;">
                <input type="datetime-local" class="form-input" name="deadline">
            </div>
            
            <input type="file" class="form-input" name="file" required>
            
            <button type="submit" class="form-submit">Upload File</button>
        </form>
    </div>
    <?php endif; ?>

    <div class="file-section">
        <?php
        $sql = "SELECT id, filename, filepath, title, file_type FROM files";
        $result = $conn->query($sql);
        
        if ($result && $result->num_rows > 0):
            while ($row = $result->fetch_assoc()):
                $type_class = $row["file_type"] === "assessment" ? "type-assessment" : "type-notes";
                $type_icon = $row["file_type"] === "assessment" ? "fa-clipboard-check" : "fa-book";
        ?>
        <div class="file-card">
            <div class="file-info">
                <div class="file-title">
                    <span class="file-type <?php echo $type_class; ?>">
                        <i class="fas <?php echo $type_icon; ?>"></i> 
                        <?php echo ucfirst($row["file_type"]); ?>
                    </span>
                    <?php echo htmlspecialchars($row["title"]); ?>
                </div>
                <div class="file-name">
                    <i class="fas fa-file"></i> <?php echo htmlspecialchars($row["filename"]); ?>
                </div>
            </div>
            <div>
                <a href="<?php echo htmlspecialchars($row["filepath"]); ?>" download class="btn btn-download">
                    <i class="fas fa-download"></i> Download
                </a>
                <?php if (isset($_SESSION['identity']) && $_SESSION['identity'] === 'Teacher'): ?>
                <a href="content.php?delete=true&fileId=<?php echo $row["id"]; ?>&filepath=<?php echo urlencode($row["filepath"]); ?>" 
                   class="btn btn-delete" 
                   onclick="return confirm('Are you sure you want to delete this file?')">
                    <i class="fas fa-trash"></i> Delete
                </a>
                <?php endif; ?>
            </div>
        </div>
        <?php endwhile; ?>
        <?php else: ?>
        <div class="empty-message">
            <i class="fas fa-folder-open fa-3x"></i>
            <p>No files have been uploaded yet.</p>
        </div>
        <?php endif; ?>
        
        <?php $conn->close(); ?>
    </div>
</div>

<script>
    function toggleDeadline(select) {
        const deadlineField = document.getElementById("deadlineField");
        deadlineField.style.display = select.value === "assessment" ? "block" : "none";
    }
</script>

</body>
</html>