<?php
session_start();
require_once('dbConfig.php');

if (isset($_SESSION['user_id'])) {
    echo "Already logged in. Please log out first.";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT id, password FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            echo "Login successful!";
            // Check if there's an active session
            $checkSession = "SELECT * FROM sessions WHERE status = 'active'";
            $sessionResult = $conn->query($checkSession);
            if ($sessionResult->num_rows > 0) {
                echo "Another user is already logged in. Please wait.";
            } else {
                $conn->query("INSERT INTO sessions (user_id, status) VALUES (".$row['id'].", 'active')");
                header("Location: index.php");
                exit();
            }
        } else {
            echo "Invalid credentials.";
        }
    } else {
        echo "Invalid credentials.";
    }
}
?>

<form method="POST">
    Username: <input type="text" name="username" required>
    Password: <input type="password" name="password" required>
    <input type="submit" name="login" value="Login">
</form>