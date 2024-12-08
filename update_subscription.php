<?php
include 'db.php';
session_start();

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $newsletter = isset($_POST['newsletter']) ? 1 : 0;

    $query = "UPDATE users SET newsletter = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ii', $newsletter, $user_id);

    if ($stmt->execute()) {
        header("Location: profile.php");
    } else {
        echo "Error updating subscription.";
    }
}
?>
