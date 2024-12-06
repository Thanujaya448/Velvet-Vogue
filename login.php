<?php
session_start();
require 'db_connection.php'; // Ensure you connect to the database

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check credentials
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $user['username'];
            header("Location: join.php");
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No such user exists.";
    }
    $stmt->close();
    $conn->close();
}
?>
