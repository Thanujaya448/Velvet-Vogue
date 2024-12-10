<?php
session_start();
include 'db_connection.php';

// Simulate logged-in user
//$_SESSION['user_id'] = 1;
$user_id = $_SESSION['user_id'];

// Fetch user data
$userQuery = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($userQuery);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$userResult = $stmt->get_result()->fetch_assoc();

$detailsQuery = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($detailsQuery);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$detailsResult = $stmt->get_result()->fetch_assoc();

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="profile.css">
</head>
<body>
    <div class="profile-container">
        <h1>Welcome, <?php echo $userResult['username']; ?></h1>
        
        <h2>Your Details</h2>
        <?php if ($detailsResult) { ?>
            <p><strong>Full Name:</strong> <?php echo $detailsResult['full_name']; ?></p>
            <p><strong>Phone:</strong> <?php echo $detailsResult['phone']; ?></p>
            <p><strong>Address:</strong> <?php echo $detailsResult['address']; ?></p>
            <form action="delete_details.php" method="POST">
                <button type="submit">Delete Details</button>
            </form>
        <?php } else { ?>
            <p>No details found. Please add them below:</p>
        <?php } ?>

        <h2>Update/Add Details</h2>
        <form action="sava_details.php" method="POST">
            <label for="full_name">Full Name</label>
            <input type="text" name="full_name" id="full_name" value="<?php echo $detailsResult['full_name'] ?? ''; ?>" required>

            <label for="phone">Phone</label>
            <input type="text" name="phone" id="phone" value="<?php echo $detailsResult['phone'] ?? ''; ?>" required>

            <label for="address">Address</label>
            <textarea name="address" id="address" required><?php echo $detailsResult['address'] ?? ''; ?></textarea>

            <button type="submit">Save Details</button>
