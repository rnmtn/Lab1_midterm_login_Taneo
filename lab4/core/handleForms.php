<?php  
require_once 'models.php';  
require_once 'dbConfig.php'; 

if (isset($_POST['insertBookBtn'])) {
    if (!empty($_POST['title']) && !empty($_POST['author']) && !empty($_POST['price'])) {
        $query = insertBook($pdo, $_POST['title'], $_POST['author'], $_POST['price']);

        if ($query) {
            header("Location: ../index.php");
        }
        else {
            echo "Insertion failed";
        }
    } else {
        echo "Make sure that no input fields are empty!";
    }
}
if (isset($_POST['editBookBtn'])) {

	if (!empty($_POST['title']) && !empty($_POST['author']) && !empty($_POST['price']) && !empty($_GET['book_id'])) {

		$query = updateBook ($pdo, $_POST['title'], $_POST['author'],$_POST['price'], $_GET['book_id']);

		if ($query) {
			header("Location: ../index.php");
		}

		else {
			echo "Edit failed";
		}

	} else {
		echo "Make sure no input fields are empty before updating!";
	}

}


if (isset($_POST['deleteBookBtn'])) {
	$query = deleteBook ($pdo, $_GET['book_id']);

	if ($query) {
		header("Location: ../index.php");
	}

	else {
		echo "Deletion failed";
	}
}

if (isset($_POST['insertNewOrderBtn'])) {
    if (!empty($_POST['customerName']) && !empty($_POST['customerEmail']) && !empty($_GET['book_id']) && !empty($_POST['paymentMethod'])) {
        
        $query = insertOrder($pdo, 
            $_POST['customerName'], 
            $_POST['customerEmail'], 
            $_GET['book_id'],
            $_POST['paymentMethod']
        );

        if ($query) {
            header("Location: ../vieworders.php?book_id=" . $_GET['book_id']);
            exit();
        } else {
            echo "Insertion failed. Please check the error logs.";
        }
    } else {
        echo "Please check your details and fill the required inputs";
    }
}

if (isset($_POST['editOrderBtn'])) {

	if (!empty($_POST['customerName']) && !empty($_POST['customerEmail']) && !empty($_GET['order_id'])) {

		$query = updateOrder($pdo, $_POST['customerName'], $_POST['customerEmail'], $_GET['order_id']);

		if ($query) {
			header("Location: ../vieworders.php?book_id=" .$_GET['book_id']);
		}
		
		else {
			echo "Update failed";
		}

	}


}


if (isset($_POST['deleteOrderBtn'])) {
	$query = deleteOrder($pdo, $_GET['order_id']);

	if ($query) {
		header("Location: ../vieworders.php?book_id=" .$_GET['book_id']);
	}
	else {
		echo "Deletion failed";
	}
}


?>