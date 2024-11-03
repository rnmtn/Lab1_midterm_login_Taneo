<?php
require_once 'models.php';
require_once 'dbConfig.php';

if (isset($_POST['login'])) {
    session_start();
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['user_id'];
        header("Location: ../index.php");
        exit();
    } else {
        header("Location: ../login.php?error=Invalid email or password");
        exit();
    }
}

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    if ($password !== $confirm_password) {
        header("Location: register.php?error=Passwords do not match");
        exit();
    }
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        header("Location: register.php?error=Email already exists");
        exit();
    }
    $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->execute([$username, $email, password_hash($password, PASSWORD_DEFAULT)]);
    $_SESSION['user_id'] = $pdo->lastInsertId();
    header("Location: index.php");
    exit();
}
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        session_regenerate_id(true);
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['last_activity'] = time();
        header("Location: ../index.php");
        exit();
    } else {
        header("Location: ../login.php?error=Invalid email or password");
        exit();
    }
}

if (isset($_POST['insertNewOrderBtn'])) { 
    if (!empty($_POST['customerName']) && 
        !empty($_POST['customerEmail']) && 
        !empty($_GET['book_id']) && 
        !empty($_POST['paymentMethod'])) { 
        $query = insertOrder( 
            $pdo, 
            $_POST['customerName'], 
            $_POST['customerEmail'], 
            $_GET['book_id'], 
            $_POST['paymentMethod'] 
        ); 

        if ($query) { 
            header("Location: ../order-success.php"); 
            exit(); 
        } else { 
            header("Location: ../order.php?book_id=" . $_GET['book_id'] . "&error=Order insertion failed"); 
            exit(); 
        } 
    } else { 
        header("Location: ../order.php?book_id=" . $_GET['book_id'] . "&error=Please fill in all required fields"); 
        exit(); 
    } 
}

if (isset($_POST['editOrderBtn'])) {

    if (!empty($_POST['customerName']) && !empty($_POST['customerEmail']) && !empty($_GET['order_id'])) {

        $query = updateOrder($pdo, $_POST['customerName'], $_POST['customerEmail'], $_GET['order_id'], $_SESSION['user_id']);

        if ($query) {
            header("Location: ../vieworders.php?book_id=" . $_GET['book_id']);
        } else {
            echo "Update failed";
        }
    }
}


if (isset($_POST['deleteOrderBtn'])) {
    $query = deleteOrder($pdo, $_GET['order_id']);

    if ($query) {
        header("Location: ../vieworders.php?book_id=" . $_GET['book_id']);
    } else {
        echo "Deletion failed";
    }
}