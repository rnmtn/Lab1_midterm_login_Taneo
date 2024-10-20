<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<style>
		body {
			font-family: "Arial";
		}
		input {
			font-size: 1.5em;
			height: 50px;
			width: 200px;
		}
		table, th, td {
		  border:1px solid black;
		}
	</style>
</head>
<body>
	<h1>Are you sure you want to delete this user?</h1>
	<?php $getLawyerById = getLawyerById($pdo, $_GET['lawyer_id']); ?>
	<form action="core/handleForms.php?lawyer_id=<?php echo $_GET['lawyer_id']; ?>" method="POST">

		<div class="lawyerContainer" style="border-style: solid; 
		font-family: 'Arial';">
			<p>First Name: <?php echo $getLawyerById['first_name']; ?></p>
			<p>Last Name: <?php echo $getLawyerById['last_name']; ?></p>
			<p>Gender: <?php echo $getLawyerById['gender']; ?></p>
			<p>Specialty: <?php echo $getLawyerById['specialty']; ?></p>
			<p>Phone: <?php echo $getLawyerById['phone']; ?></p>
			<p>Email: <?php echo $getLawyerById['email']; ?></p>
			<input type="submit" name="deleteLawyerBtn" value="Delete">
		</div>
	</form>
</body>
</html>