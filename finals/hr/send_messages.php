<?php
session_start();
require_once '../core/dbConfig.php';
require_once '../core/models.php';

if (isset($_SESSION['hr_id'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['send_message'])) {
    $hr_id = $_SESSION['hr_id'];
    $applicant_id = filter_input(INPUT_POST, 'applicant_id', FILTER_SANITIZE_NUMBER_INT);
    $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_STRING);

    if (sendMessageToApplicant($hr_id, $applicant_id, $content)) {
        header("Location: send_messages.php?message=Message sent successfully!");
    } else {
        header("Location: send_messages.php?error=Failed to send message.");
    }
    exit();
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Send Messages to Applicants</title>
    <link rel="stylesheet" href="../styles/styles.css">
</head>
<body>
    <div class="container">
        <h2>Send Message to Applicants</h2>
        <form method="POST" action="send_messages.php">
            <div>
                <label for="applicant_id">Select Applicant:</label>
                <select name="applicant_id" required>
                    <option value="">Select Applicant</option>
                    <?php foreach ($applicants as $applicant): ?>
                        <option value="<?php echo htmlspecialchars($applicant['id']); ?>">
                            <?php echo htmlspecialchars($applicant['email']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label for="content">Message:</label>
                <textarea id="content" name="content" required></textarea>
            </div>
            <input type="submit" name="send_message" value="Send Message">
        </form>
        <p><a href="../hr/index.php">Back to HR Dashboard</a></p>
    </div>
</body>
</html>