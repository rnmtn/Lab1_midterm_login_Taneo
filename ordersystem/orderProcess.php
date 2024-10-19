<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $order = $_POST['order'];
    $quantity = $_POST['quantity'];
    $cash = $_POST['cash'];


    $prices = [
        "Burger" => 50,
        "Fries" => 75,
        "Steak" => 150
    ];

    $totalPrice = $prices[$order] * $quantity;

    if ($cash >= $totalPrice) {
        $change = $cash - $totalPrice;
        echo "Order placed successfully!<br>";
        echo "You ordered $quantity $order(s).<br>";
        echo "Total Price: $totalPrice<br>";
        echo "Cash: $cash<br>";
        echo "Change: $change<br>";
    } else {
        echo "Insufficient funds! Total price is $totalPrice and you provided $cash.";
    }
}
?>
