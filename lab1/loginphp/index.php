<?php
session_start();
require_once('dbConfig.php');

if (isset($_SESSION['user_id'])) {
    $result = $conn->query("SELECT username FROM users WHERE id = ".$_SESSION['user_id']);
    $user = $result->fetch_assoc();
    echo "Welcome, " . $user['username'] . "!";
    echo "<form method='POST'><input type='submit' name='logout' value='Logout'></form>";
} else {
    echo "You are not logged in. <a href='login.php'>Login</a> or <a href='register.php'>Register</a>";
}

if (isset($_POST['logout'])) {
    $conn->query("UPDATE sessions SET status = 'inactive' WHERE user_id = ".$_SESSION['user_id']);
    session_destroy();
    header("Location: login.php");
    exit();
}
?>