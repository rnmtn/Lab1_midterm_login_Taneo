<?php
require_once 'dbConfig.php';
require_once 'handleForms.php';

function registerApplicant($email, $password) {
    global $pdo;
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
    return $stmt->execute([$email, $hashedPassword]);
}

function isEmailTaken($email) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    return $stmt->rowCount() > 0;
}

function getApplicantByEmail($email) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function verifyPassword($password, $hashedPassword) {
    return password_verify($password, $hashedPassword);
}

function sendMessageToHR($applicant_id, $hr_id, $content) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO messages (sender_id, receiver_id, content) VALUES (?, ?, ?)");
    
    try {
        $stmt->execute([$applicant_id, $hr_id, $content]);
        return true; 
    } catch (PDOException $e) {
        return false; 
    }
}

function applyForJob($applicant_id, $job_id, $resume) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO job_applications (applicant_id, job_id, resume) VALUES (?, ?, ?)");
    
    try {
        $stmt->execute([$applicant_id, $job_id, $resume]);
        return true; 
    } catch (PDOException $e) {
        return false; 
    }
}

function uploadDocument($user_id, $document_type, $file_path) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO user_documents (user_id, document_type, file_path) VALUES (?, ?, ?)");
    
    try {
        $stmt->execute([$user_id, $document_type, $file_path]);
        return true; 
    } catch (PDOException $e) {
        error_log("Document upload error: " . $e->getMessage());
        return false; 
    }
}

function getUserDocuments($user_id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM user_documents WHERE user_id = ?");
    
    try {
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Get user documents error: " . $e->getMessage());
        return [];
    }
}

function insertNewUser($name, $email, $password) {
    global $db;
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $query = "INSERT INTO users (username, email, password) VALUES ('$name', '$email', '$hashedPassword')";
    return mysqli_query($db, $query);
}

function getAllApplications() {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM job_applications");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

