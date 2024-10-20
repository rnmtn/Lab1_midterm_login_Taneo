<?php 

require_once 'dbConfig.php';

function insertIntoLawyerRecords($pdo,$first_name, $last_name, $gender, $specialty, $phone, $email) {

	$sql = "INSERT INTO lawyer_records (first_name,last_name,gender,specialty,phone,email) VALUES (?,?,?,?,?,?)";

	$stmt = $pdo->prepare($sql);

	$executeQuery = $stmt->execute([$first_name, $last_name, $gender, $specialty, 
		$phone, $email]);

	if ($executeQuery) {
		return true;	
	}
}

function seeAllLawyerRecords($pdo) {
	$sql = "SELECT * FROM lawyer_records";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute();
	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}

function getLawyerByID($pdo, $lawyer_id) {
	$sql = "SELECT * FROM lawyer_records WHERE lawyer_id = ?";
	$stmt = $pdo->prepare($sql);
	if ($stmt->execute([$lawyer_id])) {
		return $stmt->fetch();
	}
}

function updateALawyer($pdo, $lawyer_id, $first_name, $last_name, 
	$gender, $specialty, $phone, $email) {

	$sql = "UPDATE lawyer_records 
				SET first_name = ?, 
					last_name = ?, 
					gender = ?, 
					specialty = ?, 
					phone = ?, 
					email = ? 
			WHERE lawyer_id = ?";
	$stmt = $pdo->prepare($sql);
	
	$executeQuery = $stmt->execute([$first_name, $last_name, $gender, 
		$specialty, $phone, $email, $lawyer_id]);

	if ($executeQuery) {
		return true;
	}
}



function deleteALawyer($pdo, $lawyer_id) {

	$sql = "DELETE FROM lawyer_records WHERE lawyer_id = ?";
	$stmt = $pdo->prepare($sql);

	$executeQuery = $stmt->execute([$lawyer_id]);

	if ($executeQuery) {
		return true;
	}

}




?>