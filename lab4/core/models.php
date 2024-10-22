<?php  

function insertBook($pdo, $title, $author, $price) {

	$sql = "INSERT INTO books (title, author, price) VALUES(?,?,?)";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$title, $author, $price]);

	if ($executeQuery) {
		return true;
	}
}

function getAllBooks($pdo) {
	$sql = "SELECT * FROM books";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute();

	if ($executeQuery) {
		return $stmt->fetchAll();
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

function updateBook($pdo, $title, $author, 
	$price, $book_id) {

	$sql = "UPDATE books
				SET title = ?,
					author = ?,
					price = ?, 
				WHERE book_id = ?
			";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$title, $author, 
		$price, $book_id]);
	
	if ($executeQuery) {
		return true;
	}

}

function deleteBook($pdo, $book_id) {
	$deleteWebDevProj = "DELETE FROM books WHERE book_id = ?";
	$deleteStmt = $pdo->prepare($deleteWebDevProj);
	$executeDeleteQuery = $deleteStmt->execute([$book_id]);

	if ($executeDeleteQuery) {
		$sql = "DELETE FROM books WHERE book_id = ?";
		$stmt = $pdo->prepare($sql);
		$executeQuery = $stmt->execute([$book_id]);

		if ($executeQuery) {
			return true;
		}

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
    try {
        $sql = "INSERT INTO orders (customer_name, customer_email, book_id, payment_method) VALUES (?,?,?,?)";
        $stmt = $pdo->prepare($sql);
        $executeQuery = $stmt->execute([$customer_name, $customer_email, $book_id, $payment_method]);
        
        if ($executeQuery) {
            return true;
        }
        return false;
    } catch (PDOException $e) {
        error_log("Error inserting order: " . $e->getMessage());
        return false;
    }
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


function updateOrder($pdo, $customer_name, $customer_email, $order_id) {
	$sql = "UPDATE orders
			SET customer_name = ?,
				customer_email = ?
			WHERE order_id = ?
			";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$customer_name, $customer_email, $order_id]);

	if ($executeQuery) {
		return true;
	}
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