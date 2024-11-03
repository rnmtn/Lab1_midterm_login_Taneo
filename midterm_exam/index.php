<?php
session_start();
require_once 'core/dbConfig.php';
require_once 'core/models.php';

// Check if user is logged in
$isLoggedIn = isset($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookstore</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <!-- Navigation Bar -->
    <nav style="background-color: #333; padding: 1em; margin-bottom: 20px;">
        <?php if ($isLoggedIn): ?>
            <!-- Show these links when user is logged in -->
            <span style="color: white;">Welcome, <?php echo htmlspecialchars($_SESSION['username'] ?? 'User'); ?>!</span>
            <a href="logout.php" style="color: white; float: right; margin-left: 20px;">Logout</a>
        <?php else: ?>
            <!-- Show these links when user is not logged in -->
            <a href="login.php" style="color: white; float: right; margin-left: 20px;">Login</a>
            <a href="register.php" style="color: white; float: right;">Register</a>
        <?php endif; ?>
    </nav>

    <h1>Welcome To Our Bookstore!</h1>
    <?php echo $_SESSION['user_id']; ?>

    <?php if ($isLoggedIn): ?>
        <?php $getAllBooks = getAllBooks($pdo); ?>
        <div class="books-container">
            <?php if ($getAllBooks): ?>
                <?php foreach ($getAllBooks as $row): ?>
                    <div class="book-card">
                        <h3>Title: <?php echo htmlspecialchars($row['title']); ?></h3>
                        <h3>Author: <?php echo htmlspecialchars($row['author']); ?></h3>
                        <h3>Price: $<?php echo htmlspecialchars($row['price']); ?></h3>
                        <a href="order.php?book_id=<?php echo $row['book_id']; ?>">Order This Book</a>
                        <a href="vieworders.php?book_id=<?php echo $row['book_id']; ?>">View Orders</a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No books available at the moment.</p>
            <?php endif; ?>
        </div>
    <?php else: ?>
        <div style="text-align: center; margin-top: 50px;">
            <h2>Please login or register to view and order books</h2>
            <p>
                <a href="login.php" class="button">Login</a>
                <a href="register.php" class="button">Register</a>
            </p>
        </div>
    <?php endif; ?>
</body>

</html>