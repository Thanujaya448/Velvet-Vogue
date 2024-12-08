<?php
include 'db.php';
session_start();

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $query = "UPDATE users SET password = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('si', $password, $user_id);

    if ($stmt->execute()) {
        echo "Password updated successfully!";
    } else {
        echo "Error updating password.";
    }
}
?>
