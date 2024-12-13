<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$job_id = filter_input(INPUT_GET, 'job_id', FILTER_SANITIZE_NUMBER_INT);

if (!$job_id) {
    header("Location: index.php?error=Job ID is required.");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Apply for Job</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="apply-container">
        <h2>Apply for Job</h2>
        <form method="POST" action="core/handleForms.php">
            <input type="hidden" name="job_id" value="<?php echo htmlspecialchars($job_id); ?>">
            <div>
                <label for="resume">Resume:</label>
                <textarea id="resume" name="resume" required></textarea>
            </div>
            <input type="submit" name="apply" value="Submit Application">
        </form>
        <p><a href="index.php">Back to Home</a></p>
    </div>
</body>
</html>