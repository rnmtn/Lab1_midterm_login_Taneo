<?php  

// Registration functions
function registerUser($username, $email, $password) {
    global $db;
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashedPassword')";
    return mysqli_query($db, $query);
}

function isEmailTaken($email) {
    global $db;
    $query = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($db, $query);
    return mysqli_num_rows($result) > 0;
}

// Login functions
function getUserByEmail($email) {
    global $db;
    $query = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($db, $query);
    return mysqli_fetch_assoc($result);
}

function verifyPassword($password, $hashedPassword) {
    return password_verify($password, $hashedPassword);
}

// Helper function
function sanitizeInput($input) {
    global $db;
    return mysqli_real_escape_string($db, $input);
}
function getAllBooks($pdo) {
    try {
        $sql = "SELECT * FROM books";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error fetching books: " . $e->getMessage());
        return false;
    }
}

function getBookByID($pdo, $book_id) {
	$sql = "SELECT * FROM books WHERE book_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$book_id]);

	if ($executeQuery) {
		return $stmt->fetch();
	}
}

function getOrdersByBook($pdo, $book_id) {
    $sql = "SELECT 
                orders.order_id AS order_id,
                orders.customer_name AS customer_name,
                orders.customer_email AS customer_email,
                orders.date_bought AS date_bought,
                orders.payment_method AS payment_method,
                books.price AS price,
                CONCAT(books.title,' ',books.author) AS book_selling
            FROM orders
            JOIN books ON orders.book_id = books.book_id
            WHERE orders.book_id = ? 
            ORDER BY orders.date_bought DESC";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$book_id]);
    if ($executeQuery) {
        return $stmt->fetchAll();
    }
}
function getAllInfoByBookID($pdo, $book_id) {
	$sql = "SELECT * FROM books WHERE book_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$book_id]);
	if ($executeQuery) {
		return $stmt->fetch();
	}
}

function insertOrder($pdo, $customer_name, $customer_email, $book_id, $payment_method) { 
    $sql = "INSERT INTO orders (customer_name, customer_email, book_id, payment_method) VALUES (?, ?, ?, ? )"; 
    $stmt = $pdo->prepare($sql); 
    $executeQuery = $stmt->execute([$customer_name, $customer_email, $book_id, $payment_method]); 
    if ($executeQuery) { 
        return $pdo->lastInsertId(); 
    } 
    return false; 
}

function getOrdersByID($pdo, $order_id) {
    $sql = "SELECT 
                orders.order_id AS order_id,
                orders.customer_name AS customer_name,
                orders.customer_email AS customer_email,
                orders.date_bought AS date_bought,
                orders.payment_method AS payment_method,
                books.price AS price,
                CONCAT(books.title,' ',books.author) AS book_sold
            FROM orders
            JOIN books ON orders.book_id = books.book_id
            WHERE orders.order_id = ?";

    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$order_id]);
    if ($executeQuery) {
        return $stmt->fetch();
    }
}


function updateOrder($pdo, $customerName, $customerEmail, $book_id, $order_id) {
    $sql = "UPDATE orders SET customer_name = ?, customer_email = ?, book_id = ? WHERE order_id = ?";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$customerName, $customerEmail, $book_id, $order_id]);
}

function deleteOrder($pdo, $order_id) {
	$sql = "DELETE FROM orders WHERE order_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$order_id]);

	if ($executeQuery) {
		return true;
	}
}


?>