<?php
session_start();
include 'db_connection.php';

$user_id = $_SESSION['user_id'];

$deleteQuery = "DELETE FROM user_details WHERE user_id = ?";
$stmt = $conn->prepare($deleteQuery);
$stmt->bind_param("i", $user_id);
$stmt->execute();

$stmt->close();
$conn->close();

header("Location: profile.php");
?>
=