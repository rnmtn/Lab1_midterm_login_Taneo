<?php
session_start();
require_once '../core/dbConfig.php';
require_once '../core/models.php';

if (isset($_SESSION['hr_id'])) {
    header("Location: index.php");
    exit();
}

$applications = [];
$applications = getAllApplications();

?>
<!DOCTYPE html>
<html>
<head>
    <title>View Applications</title>
    <link rel="stylesheet" href="../styles/styles.css">
</head>
<body>
    <div class="container">
        <h2>Job Applications</h2>
        <table>
            <tr>
                <th>Applicant ID</th>
                <th>Job ID</th>
                <th>Resume</th>
                <th>Status</th>
</tr>
            <?php foreach ($applications as $application): ?>
                <tr>
                    <td><?php echo htmlspecialchars($application['applicant_id']); ?></td>
                    <td><?php echo htmlspecialchars($application['job_id']); ?></td>
                    <td><a href="<?php echo htmlspecialchars($application['resume']); ?>" target="_blank">View Resume</a></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>