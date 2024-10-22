<?php require_once 'core/models.php'; ?>
<?php require_once 'core/dbConfig.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<h1>Are you sure you want to delete this book?</h1>
	<?php $getBookByID = getBookByID($pdo, $_GET['book_id']); ?>
	<div class="container" style="border-style: solid; height: 400px;">
		<h2>Title: <?php echo $getBookByID['tile']; ?></h2>
		<h2>Author: <?php echo $getBookByID['author']; ?></h2>
		<h2>Price: <?php echo $getBookByID['book']; ?></h2>

		<div class="deleteBtn" style="float: right; margin-right: 10px;">
			<form action="core/handleForms.php?book_id=<?php echo $_GET['book_id']; ?>" method="POST">
				<input type="submit" name="deleteBookBtn" value="Delete">
			</form>			
		</div>	

	</div>
</body>
</html>