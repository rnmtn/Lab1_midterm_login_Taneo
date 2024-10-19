<?php
session_start();
require_once('dbConfig.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (isset($_POST['register'])) {
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $username, $password);
        
        if ($stmt->execute()) {
            echo "Registration successful!";
        } else {
            echo "Error: " . $stmt->error;
        }
    }

    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        $sql = "SELECT id, password FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($user_id, $hashed_password);
        
        if ($stmt->fetch() && password_verify($password, $hashed_password)) {
            $result = $conn->query("SELECT * FROM sessions WHERE status = 'active'");
            
            if ($result->num_rows > 0) {
                echo "Another user is already logged in. Please wait.";
            } else {
                $_SESSION['user_id'] = $user_id;
                $conn->query("INSERT INTO sessions (user_id, status) VALUES ($user_id, 'active')");
                echo "Login successful!";
            }
        } else {
            echo "Invalid credentials.";
        }
    }
}

if (isset($_POST['logout'])) {
    if (isset($_SESSION['user_id'])) {
        $conn->query("UPDATE sessions SET status = 'inactive' WHERE user_id = ".$_SESSION['user_id']);
        session_destroy();
        echo "Logged out successfully.";
    } else {
        echo "No user is logged in.";
    }
}
?>
