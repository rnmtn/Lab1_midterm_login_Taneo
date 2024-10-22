<?php require_once 'core/models.php'; ?>
<?php require_once 'core/dbConfig.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Orders</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <a href="index.php">Return to home</a>
    
    <?php 
    $book = getAllInfoByBookID($pdo, $_GET['book_id']); 
    $orders = getOrdersByBook($pdo, $_GET['book_id']);
    ?>
    
    <h1>Orders for: <?php echo $book['title']; ?></h1>
    
    <!-- Orders Table -->
    <table style="width:100%; border-collapse: collapse; margin-top: 20px;">
        <thead>
            <tr>
                <th style="padding: 10px; border: 1px solid #ddd;">Order ID</th>
                <th style="padding: 10px; border: 1px solid #ddd;">Customer Name</th>
                <th style="padding: 10px; border: 1px solid #ddd;">Customer Email</th>
                <th style="padding: 10px; border: 1px solid #ddd;">Price</th>
                <th style="padding: 10px; border: 1px solid #ddd;">Payment Method</th>
                <th style="padding: 10px; border: 1px solid #ddd;">Date Bought</th>
                <th style="padding: 10px; border: 1px solid #ddd;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($orders && count($orders) > 0): ?>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td style="padding: 10px; border: 1px solid #ddd;"><?php echo htmlspecialchars($order['order_id']); ?></td>
                        <td style="padding: 10px; border: 1px solid #ddd;"><?php echo htmlspecialchars($order['customer_name']); ?></td>
                        <td style="padding: 10px; border: 1px solid #ddd;"><?php echo htmlspecialchars($order['customer_email']); ?></td>
                        <td style="padding: 10px; border: 1px solid #ddd;">$<?php echo htmlspecialchars($order['price']); ?></td>
                        <td style="padding: 10px; border: 1px solid #ddd;"><?php echo htmlspecialchars($order['payment_method']); ?></td>
                        <td style="padding: 10px; border: 1px solid #ddd;"><?php echo htmlspecialchars($order['date_bought']); ?></td>
                        <td style="padding: 10px; border: 1px solid #ddd;">
                            <a href="editorder.php?order_id=<?php echo $order['order_id']; ?>&book_id=<?php echo $_GET['book_id']; ?>">Edit</a>
                            <a href="deleteorder.php?order_id=<?php echo $order['order_id']; ?>&book_id=<?php echo $_GET['book_id']; ?>">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" style="padding: 10px; border: 1px solid #ddd; text-align: center;">No orders found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    
    <!-- Add New Order Form -->
    <h1>Add New Order</h1>
    <form action="core/handleForms.php?book_id=<?php echo $_GET['book_id']; ?>" method="POST">
        <p>
            <label for="customerName">Your Name</label> 
            <input type="text" name="customerName" required>
        </p>
        <p>
            <label for="customerEmail">Your Email</label> 
            <input type="email" name="customerEmail" required>
        </p>
        <p>
            <label for="paymentMethod">Payment Method</label>
            <select name="paymentMethod" required>
                <option value="">Select Payment Method</option>
                <option value="credit_card">Credit Card</option>
                <option value="debit_card">Debit Card</option>
                <option value="paypal">PayPal</option>
                <option value="cash">Cash</option>
            </select>
        </p>
        <input type="submit" name="insertNewOrderBtn" value="Place Order">
    </form>
</body>
</html>