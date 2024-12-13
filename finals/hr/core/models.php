<?php
require_once '../core/dbConfig.php';
require_once 'hr/core/handleForms.php';

function addJob($title, $description, $requirements) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO jobs (title, description, requirements) VALUES (?, ?, ?)");
    
    try {
        $stmt->execute([$title, $description, $requirements]);
        return true; 
    } catch (PDOException $e) {
        return false; 
    }
}

function getAllJobs() {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM jobs");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getAllApplications() {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM job_applications");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function sendMessageToApplicant($hr_id, $applicant_id, $content) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO messages (sender_id, receiver_id, content) VALUES (?, ?, ?)");
    
    try {
        $stmt->execute([$hr_id, $applicant_id, $content]);
        return true; 
    } catch (PDOException $e) {
        return false; 
    }
}

function getAllApplicants() {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM users");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}