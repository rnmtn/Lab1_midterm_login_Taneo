<?php
session_start();
require_once 'core/dbConfig.php';
require_once 'core/models.php';

$_SESSION['last_activity'] = time();

if (!isset($_SESSION['user_id']) || (time() - $_SESSION['last_activity'] > 1800)) {
    session_destroy();
    header("Location: login.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <a href="vieworders.php?book_id=<?php echo $_GET['book_id']; ?>">
        View The Orders</a>
    <h1>Edit the Order!</h1>
    <?php $getOrdersByID = getOrdersByID($pdo, $_GET['order_id']); ?>

    <form action="core/handleForms.php?order_id=<?php echo $_GET['order_id']; ?>&book_id=<?php echo $_GET['book_id']; ?>" method="POST">
        <p>
            <label for="customerName">Customer Name</label>
            <input type="text" name="customerName"
                value="<?php echo $getOrdersByID['customer_name']; ?>">
        </p>
        <p>
            <label for="customerEmail">Customer Email</label>
            <input type="email" name="customerEmail"
                value="<?php echo $getOrdersByID['customer_email']; ?>">
        </p>
        <input type="submit" name="editOrderBtn" value="Update Order">
    </form>
</body>

</html>