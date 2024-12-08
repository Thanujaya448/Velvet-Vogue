<?php
session_start();
include 'db_connection.php';

$user_id = $_SESSION['user_id'];
$full_name = $_POST['full_name'];
$phone = $_POST['phone'];
$address = $_POST['address'];

// Check if details exist
$checkQuery = "SELECT * FROM user_details WHERE user_id = ?";
$stmt = $conn->prepare($checkQuery);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();

if ($result->num_rows > 0) {
    // Update details
    $updateQuery = "UPDATE user_details SET full_name = ?, phone = ?, address = ? WHERE user_id = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("sssi", $full_name, $phone, $address, $user_id);
    $stmt->execute();
} else {
    // Insert new details
    $insertQuery = "INSERT INTO user_details (user_id, full_name, phone, address) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($insertQuery);
    $stmt->bind_param("isss", $user_id, $full_name, $phone, $address);
    $stmt->execute();
}
$stmt->close();
$conn->close();

header("Location: profile.php");
?>
