<?php
require_once '../core/dbConfig.php';
require_once '../core/models.php';
require_once '../core/auth.php';

    if (isset($_POST['login'])) {
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'];

        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['id'] = $user['id'];
            header("Location: ../index.php");
            exit();
        } else {
            header("Location: ../login.php?error=Invalid email or password");
            exit();
        }
    }

    if (isset($_POST['register'])) {
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
    
        if (empty($name) || empty($email) || empty($password) || empty($confirm_password)) {
            header("Location: ../login.php?error=Please fill in all fields");
            exit();
        }
    
        if ($password !== $confirm_password) {
            header("Location: ../login.php?error=Passwords do not match");
            exit();
        }
    
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            header("Location: ../login.php?error=Email already exists");
            exit();
        }
    
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    
        try {
            $stmt->execute([$name, $email, $hashed_password]); // Correctly include `$name`.
            $_SESSION['id'] = $pdo->lastInsertId();
            header("Location: ../index.php?registration=success");
            exit();
        } catch (PDOException $e) {
            header("Location: ../login.php?error=Registration failed: " . $e->getMessage());
            exit();
        }
    }
    

    if (isset($_POST['send_message'])) {
        $applicant_id = $_SESSION['id'];
        $hr_id = filter_input(INPUT_POST, 'hr_id', FILTER_SANITIZE_NUMBER_INT);
        $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_STRING);

        if (sendMessageToHR($applicant_id, $hr_id, $content)) {
            header("Location: ../index.php?message=Message sent successfully!");
        } else {
            header("Location: ../index.php?error=Failed to send message.");
        }
        exit();
    }

    if (isset($_POST['apply'])) {
        $applicant_id = $_SESSION['id'];
        $job_id = filter_input(INPUT_POST, 'job_id', FILTER_SANITIZE_NUMBER_INT);
        $resume = filter_input(INPUT_POST, 'resume', FILTER_SANITIZE_STRING);

        if (applyForJob($applicant_id, $job_id, $resume)) {
            header("Location: ../index.php?message=Application submitted successfully!");
        } else {
            header("Location: ../index.php?error=Failed to submit application.");
        }
        exit();
    }

    if (isset($_POST['upload_document'])) {
        $user_id = $_SESSION['id'];
        $document_type = filter_input(INPUT_POST, 'document_type', FILTER_SANITIZE_STRING);

        if (uploadDocument($user_id, $document_type, $file_path)) {
            header("Location: index.php?message=Document uploaded successfully");
        } else {
            header("Location: upload.php?error=Failed to save document");
        }
        exit();
    }


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['upload_document'])) {
    $user_id = $_SESSION['id'];
    $document_type = filter_input(INPUT_POST, 'document_type', FILTER_SANITIZE_STRING);

    if (isset($_FILES['document']) && $_FILES['document']['error'] == 0) {
        $file = $_FILES['document'];

        $allowed_types = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'image/jpeg', 'image/png'];
        $max_file_size = 5 * 1024 * 1024;

        $file_mime_type = mime_content_type($file['tmp_name']);
        $file_ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        if (!in_array($file_mime_type, $allowed_types)) {
            $_SESSION['error'] = "Invalid file type";
            header("Location: upload.php");
            exit();
        }

        if ($file['size'] > $max_file_size) {
            $_SESSION['error'] = "File too large";
            header("Location: upload.php");
            exit();
        }

        $upload_dir = 'uploads/' . $user_id . '/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        $new_filename = uniqid() . '.' . $file_ext;
        $upload_path = $upload_dir . basename($new_filename);

        if (move_uploaded_file($file['tmp_name'], $upload_path)) {
            if (uploadDocument($user_id, $document_type, $upload_path)) {
                $_SESSION['message'] = "Document uploaded successfully";
                header("Location: index.php");
            } else {
                unlink($upload_path);
                $_SESSION['error'] = "Failed to save document";
                header("Location: upload.php");
            }
        } else {
            $_SESSION['error'] = "File upload failed";
            header("Location: upload.php");
        }
        exit();
    } else {
        $_SESSION['error'] = "No file uploaded";
        header("Location: upload.php");
        exit();
    }
}
?>