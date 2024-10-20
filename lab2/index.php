<?php require_once 'core/dbConfig.php'; ?>

<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Hotel List</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .success-message {
            color: green;
            font-weight: bold;
        }
        .error-message {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Hotel List</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>

        <?php
        // Fetching all the hotels from the hotels table
        $stmt = $pdo->prepare("SELECT * FROM hotels");
        if ($stmt->execute()) {
            $hotels = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($hotels as $hotel) {
                echo "<tr>
                        <td>{$hotel['id']}</td>
                        <td>{$hotel['name']}</td>
                        <td>{$hotel['address']}</td>
                        <td>{$hotel['phone']}</td>
                        <td>{$hotel['email']}</td>
                        <td>
                            <form method='POST' style='display:inline;'>
                                <input type='hidden' name='delete_id' value='{$hotel['id']}'>
                                <input type='submit' value='Delete' onclick='return confirm(\"Are you sure you want to delete this hotel?\");'>
                            </form>
                            <form method='POST' style='display:inline;'>
                                <input type='hidden' name='update_id' value='{$hotel['id']}'>
                                <input type='text' name='update_name' placeholder='New Name' required>
                                <input type='text' name='update_address' placeholder='New Address' required>
                                <input type='text' name='update_phone' placeholder='New Phone' required>
                                <input type='email' name='update_email' placeholder='New Email' required>
                                <input type='submit' value='Update'>
                            </form>
                        </td>
                      </tr>";
            }
        }

        // Inserting a new hotel into the table
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['new_hotel'])) {
            $query = "INSERT INTO hotels (name, address, phone, email) VALUES (?, ?, ?, ?)";
            $stmt = $pdo->prepare($query);
            $executeQuery = $stmt->execute([$_POST['new_name'], $_POST['new_address'], $_POST['new_phone'], $_POST['new_email']]);
            echo $executeQuery ? "<tr><td colspan='6' class='success-message'>New hotel added successfully!</td></tr>" : "<tr><td colspan='6' class='error-message'>Failed to add new hotel.</td></tr>";
        }

        // Deleting a hotel
        if (isset($_POST['delete_id'])) {
            $deleteQuery = "DELETE FROM hotels WHERE id = ?";
            $stmt = $pdo->prepare($deleteQuery);
            $executeDelete = $stmt->execute([$_POST['delete_id']]);
            echo $executeDelete ? "<tr><td colspan='6' class='success-message'>Hotel deleted successfully!</td></tr>" : "<tr><td colspan='6' class='error-message'>Failed to delete hotel.</td></tr>";
        }

        // Updating a hotel
        if (isset($_POST['update_id'])) {
            $updateQuery = "UPDATE hotels SET name = ?, address = ?, phone = ?, email = ? WHERE id = ?";
            $stmt = $pdo->prepare($updateQuery);
            $executeUpdate = $stmt->execute([$_POST['update_name'], $_POST['update_address'], $_POST['update_phone'], $_POST['update_email'], $_POST['update _id']]);
            echo $executeUpdate ? "<tr><td colspan='6' class='success-message'>Hotel updated successfully!</td></tr>" : "<tr><td colspan='6' class='error-message'>Failed to update hotel.</td></tr>";
        }
        ?>
    </table>

    <h2>Add New Hotel</h2>
    <form method='POST'>
        <label for='new_name'>Name:</label>
        <input type='text' id='new_name' name='new_name' required><br><br>
        <label for='new_address'>Address:</label>
        <input type='text' id='new_address' name='new_address' required><br><br>
        <label for='new_phone'>Phone:</label>
        <input type='text' id='new_phone' name='new_phone' required><br><br>
        <label for='new_email'>Email:</label>
        <input type='email' id='new_email' name='new_email' required><br><br>
        <input type='submit' name='new_hotel' value='Add Hotel'>
    </form>
</body>
</html>