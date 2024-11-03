<?php
session_start();
require_once 'core/dbConfig.php';
require_once 'core/models.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
if (isset($_GET['error'])): ?>
    <div class="error-message" style="color: red; margin: 10px 0;">
        <?php echo htmlspecialchars($_GET['error']); ?>
    </div>
<?php endif; ?>

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Book</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <a href="index.php">← Back to Books</a>

    <?php echo $_SESSION['user_id']; ?>

    <?php $book = getBookByID($pdo, $_GET['book_id']); ?>
    <div class="order-details">
        <h2>Order Details</h2>
        <h3>Book: <?php echo $book['title']; ?></h3>
        <h3>Author: <?php echo $book['author']; ?></h3>
        <h3>Price: $<?php echo $book['price']; ?></h3>
    </div>

    <div class="order-form">
        <h2>Place Your Order</h2>
        <form action="core/handleForms.php?book_id=<?php echo $_GET['book_id']; ?>" method="POST">
            <p>
                <label for="customerName">Your Name</label>
                <input type="text" name="customerName" id="customerName" required>
            </p>
            <p>
                <label for="customerEmail">Your Email</label>
                <input type="email" name="customerEmail" id="customerEmail" required>
            </p>
            <p>
                <label for="paymentMethod">Payment Method</label>
                <select name="paymentMethod" id="paymentMethod" required>
                    <option value="">Select Payment Method</option>
                    <option value="credit_card">Credit Card</option>
                    <option value="debit_card">Debit Card</option>
                    <option value="paypal">PayPal</option>
                    <option value="cash">Cash</option>
                </select>
            </p>
            <input type="submit" name="insertNewOrderBtn" value="Place Order">
        </form>
    </div>
</body>

</html>