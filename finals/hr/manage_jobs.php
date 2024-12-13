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
    <title>Manage Jobs</title>
    <link rel="stylesheet" href="../styles/styles.css">
</head>
<body>
    <div class="container">
        <h2>Manage Jobs</h2>
        <form method="POST" action="manage_jobs.php">
            <div>
                <label for="title">Job Title:</label>
                <input type="text" name="title" required>
            </div>
            <div>
                <label for="description">Job Description:</label>
                <textarea name="description" required></textarea>
            </div>
            <div>
                <label for="requirements">Job Requirements:</label>
                <textarea name="requirements" required></textarea>
            </div>
            <input type="submit" name="add_job" value="Add Job">
        </form>
    </div>
</body>
</html>