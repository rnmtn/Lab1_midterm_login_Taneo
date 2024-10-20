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
	<?php $getLawyerById = getLawyerById($pdo, $_GET['lawyer_id']); ?>
	<form action="core/handleForms.php?lawyer_id=<?php echo $_GET['lawyer_id']; ?>" method="POST">
		<p>
			<label for="firstName">First Name</label> 
			<input type="text" name="firstName" value="<?php echo $getLawyerById['first_name']; ?>">
		</p>
		<p>
			<label for="lastName">Last Name</label> 
			<input type="text" name="lastName" value="<?php echo $getLawyerById['last_name']; ?>">
		</p>
		<p>
			<label for="gender">Gender</label>
			<input type="text" name="gender" value="<?php echo $getLawyerById['gender']; ?>">
		</p>
		<p>
			<label for="specialty">Specialty</label>
			<input type="text" name="specialty" value="<?php echo $getLawyerById['specialty']; ?>">
		</p>
		<p>
			<label for="phone">Phone</label>
			<input type="text" name="phone" value="<?php echo $getLawyerById['phone']; ?>">
		</p>
		<p>
			<label for="email">Email</label>
			<input type="text" name="email" value="<?php echo $getLawyerById['email']; ?>"></p>
			<input type="submit" name="editLawyerBtn">
		</p>
	</form>
</body>
</html>