<?php
include 'db.php';
session_start();

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $card_number = $_POST['card_number'];
    $card_name = $_POST['card_name'];
    $expiry_date = $_POST['expiry_date'];

    $query = "INSERT INTO payment_methods (user_id, card_number, card_name, expiry_date) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('isss', $user_id, $card_number, $card_name, $expiry_date);

    if ($stmt->execute()) {
        header("Location: profile.php");
    } else {
        echo "Error adding payment method.";
    }
}
?>
