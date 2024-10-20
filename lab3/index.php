<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>
<?php require_once 'core/handleForms.php'; ?>
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
	<h3>Welcome to the Lawyer Management System. Input your details here to register</h3>
	<form action="core/handleForms.php" method="POST">
		<p><label for="firstName">First Name</label> <input type="text" name="firstName"></p>
		<p><label for="lastName">Last Name</label> <input type="text" name="lastName"></p>
		<p><label for="gender">Gender</label> <input type="text" name="gender"></p>
		<p><label for="specialty">Specialty</label> <input type="text" name="specialty"></p>
		<p><label for="phone">Phone</label> <input type="text" name="phone"></p>
		<p><label for="email">Email</label> <input type="text" name="email"></p>
			<input type="submit" name="insertNewLawyerBtn">
		</p>
	</form>

	<table style="width:50%; margin-top: 50px;">
	  <tr>
	    <th>Lawyer ID</th>
	    <th>First Name</th>
	    <th>Last Name</th>
	    <th>Gender</th>
	    <th>Specialty</th>
	    <th>Phone</th>
	    <th>Email</th>
	    <th>Action</th>
	  </tr>

	  <?php $seeAllLawyerRecords = seeAllLawyerRecords($pdo); ?>
	  <?php foreach ($seeAllLawyerRecords as $row) { ?>
	  <tr>
	  	<td><?php echo $row['lawyer_id']; ?></td>
	  	<td><?php echo $row['first_name']; ?></td>
	  	<td><?php echo $row['last_name']; ?></td>
	  	<td><?php echo $row['gender']; ?></td>
	  	<td><?php echo $row['specialty']; ?></td>
	  	<td><?php echo $row['phone']; ?></td>
	  	<td><?php echo $row['email']; ?></td>
	  	<td>
	  		<a href="editlawyer.php?lawyer_id=<?php echo $row['lawyer_id'];?>">Edit</a>
	  		<a href="deletelawyer.php?lawyer_id=<?php echo $row['lawyer_id'];?>">Delete</a>
	  	</td>
	  </tr>
	  <?php } ?>
	</table>



</body>
</html>