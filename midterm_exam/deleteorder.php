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
	<?php $getOrdersByID = getOrdersByID($pdo, $_GET['order_id']); ?>
	<h1>Are you sure you want to delete this order?</h1>
	<div class="container" style="border-style: solid; height: 400px;">
		<h2>Customer Name: <?php echo $getOrdersByID['customer_name'] ?></h2>
		<h2>Customer Email: <?php echo $getOrdersByID['customer_email'] ?></h2>
		<h2>Price: <?php echo $getOrdersByID['price'] ?></h2>
		<h2>Date Bought: <?php echo $getOrdersByID['date_bought'] ?></h2>

		<div class="deleteBtn" style="float: right; margin-right: 10px;">
			<form action="core/handleForms.php?order_id=<?php echo $_GET['order_id']; ?>&book_id=<?php echo $_GET['book_id']; ?>" method="POST">
				<input type="submit" name="deleteOrderBtn" value="Delete">
			</form>			
		</div>	

	</div>
</body>
</html>