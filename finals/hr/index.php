<?php
session_start();
require_once '../core/dbConfig.php';
require_once '../core/models.php';

if (isset($_SESSION['hr_id'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>HR Dashboard</title>
    <link rel="stylesheet" href="../styles/styles.css">
</head>
<body>
    <div class="container">
        <h2>Welcome to the HR Dashboard</h2>
        <p><a href="logout.php">Logout</a></p>
        
        <h3>Job Applications</h3>
        <p>No job applications available at the moment.</p>
        
        <h3>Actions</h3>
        <ul>
            <li><a href="view_applications.php">View Applications</a></li>
            <li><a href="manage_jobs.php">Manage Jobs</a></li>
            <li><a href="send_messages.php">Send Messages to Applicants</a></li>
        </ul>
    </div>
</body>
</html>