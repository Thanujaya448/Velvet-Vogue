<?php
include 'db.php';
session_start();

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = $_POST['full_name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $query = "UPDATE users SET full_name = ?, phone = ?, address = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('sssi', $full_name, $phone, $address, $user_id);

    if ($stmt->execute()) {
        header("Location: testprofile.php");
    } else {
        echo "Error updating profile.";
    }
}
?>
