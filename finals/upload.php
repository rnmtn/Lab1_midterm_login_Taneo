<?php 
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

require_once 'core/dbConfig.php'; 
require_once 'core/models.php'; 
?> 

<!DOCTYPE html> 
<html> 
<head> 
    <title>Upload Document</title> 
    <link rel="stylesheet" href="styles.css"> 
</head> 
<body> 
    <div class="upload-container"> 
        <h2>Upload Document</h2> 
        <?php if (isset($_SESSION['error'])): ?> 
            <p class="error"><?php echo htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?></p> 
        ```html
        <?php endif; ?> 
        <form action="upload.php" method="POST" enctype="multipart/form-data"> 
            <div> 
                <label for="document_type">Document Type:</label> 
                <select name="document_type" required> 
                    <option value="">Select Document Type</option> 
                    <option value="resume">Resume</option> 
                    <option value="certificate">Certificate</option> 
                    <option value="identification">Identification</option> 
                    <option value="other">Other</option> 
                </select> 
            </div> 
            <div> 
                <label for="document">Upload Document:</label> 
                <input type="file" name="document" required> 
            </div> 
            <input type="submit" name="upload_document" value="Upload"> 
        </form> 
        <p><a href="index.php">Back to Home</a></p> 
    </div> 
</body> 
</html>