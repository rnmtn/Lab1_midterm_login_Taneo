<?php 
require_once 'dbConfig.php'; 
require_once 'models.php';

if (isset($_POST['insertNewLawyerBtn'])) {
	$firstName = trim($_POST['firstName']);
	$lastName = trim($_POST['lastName']);
	$gender = trim($_POST['gender']);
	$specialty = trim($_POST['specialty']);
	$phone = trim($_POST['phone']);
	$email = trim($_POST['email']);

	if (!empty($firstName) && !empty($lastName) && !empty($gender) && !empty($specialty) && !empty($phone) && !empty($email)) { 
			$query = insertIntoLawyerRecords($pdo, $firstName, $lastName, 
			$gender, $specialty, $phone, $email);

		if ($query) {
			header("Location: index.php");
		}

		else {
			echo "Insertion failed";
		}
	}

	else {
		echo "Make sure that no fields are empty";
	}
	
}

if (isset($_POST['editLawyerBtn'])) {
	$lawyer_id = $_GET['lawyer_id'];
	$firstName = trim($_POST['firstName']);
	$lastName = trim($_POST['lastName']);
	$gender = trim($_POST['gender']);
	$specialty = trim($_POST['specialty']);
	$phone = trim($_POST['phone']);
	$email = trim($_POST['email']);


	if (!empty($firstName) && !empty($lastName) && !empty($gender) && !empty($specialty) && !empty($phone) && !empty($email)) { 

		$query = updateALawyer($pdo, $lawyer_id, $firstName, $lastName, $gender, $specialty, $phone, $email);

		if ($query) {
			header("Location: index.php");
		}
		else {
			echo "Update failed";
		}

	}

	else {
		echo "Make sure that no fields are empty";
	}

}

if (isset($_POST['deleteLawyerBtn'])) {

	$query = deleteALawyer($pdo, $_GET['lawyer_id']);

	if ($query) {
		header("Location: index.php");
	}
	else {
		echo "Deletion failed";
	}
}

?>