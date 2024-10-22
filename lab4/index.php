<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookstore</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Welcome To Our Bookstore!</h1>
    
    <?php $getAllBooks = getAllBooks($pdo); ?>
    <div class="books-container">
        <?php foreach ($getAllBooks as $row) { ?>
        <div class="book-card" style="border: 1px solid #ccc; padding: 20px; margin: 10px; width: 300px;">
            <h3>Title: <?php echo $row['title']; ?></h3>
            <h3>Author: <?php echo $row['author']; ?></h3>
            <h3>Price: $<?php echo $row['price']; ?></h3>
            <a href="order.php?book_id=<?php echo $row['book_id']; ?>" class="order-button">
                Order This Book
            </a>
        </div> 
        <?php } ?>
    </div>
</body>
</html>