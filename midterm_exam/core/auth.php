<?php
session_start();
require_once 'dbConfig.php';

if(isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    
    if($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['user_id'];
        header("Location: ../index.php");
        exit();
    } else {
        header("Location: ../login.php?error=Invalid email or password");
        exit();
    }
}

if(isset($_POST['register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if(empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        header("Location: ../register.php?error=Please fill in all fields");
        exit();
    }

    if($password !== $confirm_password) {
        header("Location: ../register.php?error=Passwords do not match");
        exit();
    }

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if($stmt->fetch()) {
        header("Location: ../register.php?error=Email already exists");
        exit();
    }


    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    
    try {
        $stmt->execute([$username, $email, $hashed_password]);
        $_SESSION['user_id'] = $pdo->lastInsertId();
        $_SESSION['username'] = $username;
        header("Location: ../index.php?registration=success");
        exit();
    } catch (PDOException $e) {
        header("Location: ../register.php?error=Registration failed: " . $e->getMessage());
        exit();
    }
}