<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome to FindHire</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Welcome to FindHire!</h2>
        <p><a href="apply.php">Apply for a Job</a></p>
        <p><a href="upload.php">Upload Documents</a></p>
        <p><a href="message.php">Send Message to HR</a></p>
        <p><a href="logout.php">Logout</a></p>
    </div>
</body>
</html>