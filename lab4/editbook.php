
<?php require_once 'core/handleForms.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<?php $getBookByID = getBookByID($pdo, $_GET['book_id']); ?>
	<h1>Edit the book!</h1>
	<form action="core/handleForms.php?book_id=<?php echo $_GET['book_id']; ?>" method="POST">
		<p>
			<label for="firstName">Title</label> 
			<input type="text" name="title" value="<?php echo $getBookByID['title']; ?>">
		</p>
		<p>
			<label for="firstName">Author</label> 
			<input type="text" name="author" value="<?php echo $getBookByID['author']; ?>">
		</p>
		<p>
			<label for="firstName">Price</label> 
			<input type="input" name="price" value="<?php echo $getBookByID['price']; ?>">
		</p>
	</form>
</body>
</html>
