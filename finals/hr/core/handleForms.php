<?php
require_once '../core/dbConfig.php';

if (isset($_POST['hr_login'])) {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM hr_users WHERE email = ?");
    $stmt->execute([$email]);
    $hr_user = $stmt->fetch();
    
    if ($hr_user && password_verify($password, $hr_user['password'])) {
        $_SESSION['hr_id'] = $hr_user['id'];
        header("Location: ../hr/index.php");
        exit();
    } else {
        header("Location: ../hr/login.php?error=Invalid email or password");
        exit();
    }
}

if (isset($_POST['add_job'])) {
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
    $requirements = filter_input(INPUT_POST, 'requirements', FILTER_SANITIZE_STRING);

    if (addJob($title, $description, $requirements)) {
        header("Location: ../hr/manage_jobs.php?message=Job added successfully!");
    } else {
        header("Location: ../hr/manage_jobs.php?error=Failed to add job.");
    }
    exit();
}

if (isset($_POST['send_message'])) {
    $hr_id = $_SESSION['hr_id'];
    $applicant_id = filter_input(INPUT_POST, 'applicant_id', FILTER_SANITIZE_NUMBER_INT);
    $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_STRING);

    if (sendMessageToApplicant($hr_id, $applicant_id, $content)) {
        header("Location: ../hr/send_messages.php?message=Message sent successfully!");
    } else {
        header("Location: ../hr/send_messages.php?error=Failed to send message.");
    }
    exit();
}