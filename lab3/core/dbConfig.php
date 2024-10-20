<?php  

$host = "localhost";
$user = "root";
$password = "";
$dbname = "lab3";
$dsn = "mysql:host={$host};dbname={$dbname}";
$pdo = new PDO($dsn, $user, $password);

?>