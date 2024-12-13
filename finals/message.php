<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

require_once 'core/dbConfig.php';
require_once 'core/models.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['send_message'])) {
    $applicant_id = $_SESSION['id'];
    $hr_id = $_POST['hr_id']; 
    $content = $_POST['content'];

    if (sendMessageToHR($applicant_id, $hr_id, $content)) {
        header("Location: index.php?message=Message sent successfully!");
    } else {
        header("Location: index.php?error=Failed to send message.");
    }
    exit();
}

$hr_id = $_GET['hr_id'] ?? null;

if (!$hr_id) {
    header("Location: index.php?error=HR ID is required.");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Send Message to HR</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="message-container">
        <h2>Send Message to HR</h2>
        <form method="POST" action="message.php">
            <input type="hidden" name="hr_id" value="<?php echo htmlspecialchars($hr_id); ?>">
            <div>
                <label for="content">Message:</label>
                <textarea id="content" name="content" required></textarea>
            </div>
            <input type="submit" name="send_message" value="Send Message">
        </form>
        <p><a href="index.php">Back to Home</a></p>
    </div>
</body>
</html>