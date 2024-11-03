<?php
session_start();

// If user is already logged in, redirect to index
if(isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="register-container">
        <h2>Register</h2>
        <?php if(isset($_GET['error'])): ?>
            <p class="error"><?php echo htmlspecialchars($_GET['error']); ?></p>
        <?php endif; ?>
        <form action="core/auth.php" method="POST">
            <div>
                <label for="username">Username:</label>
                <input type="text" name="username" required>
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" name="email" required>
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" name="password" required>
            </div>
            <div>
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" name="confirm_password" required>
            </div>
            <input type="submit" name="register" value="Register">
        </form>
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>
</body>
</html>