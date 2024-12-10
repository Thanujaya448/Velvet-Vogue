<?php
// Start the session
include 'db.php';

session_start();

if(!isset($_SESSION['user_id']))
{
	header("Location: ./join.php");
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="styles.css">
    <script src="scripts.js" defer></script>
</head>
<body>

    <?php 
        $user_id = $_SESSION['user_id'];

        $detailsQuery = "SELECT * FROM users WHERE id = ?";
        $stmt = $conn->prepare($detailsQuery);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $user = $stmt->get_result()->fetch_assoc();
    ?>

    <header class="profile-header">
        <div class="profile-picture">
            <form action="upload_picture.php" method="POST" enctype="multipart/form-data">
                <img src="<?php echo $user['profile_picture']; ?>" alt="Profile Picture">
                <input type="file" name="profile_picture" accept="image/*">
                <button type="submit">Update Picture</button>
            </form>
        </div>
        <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
    </header>

    <main class="profile-content">
        <!-- Personal Information -->


        <section>
            <h2>Personal Information</h2>
            <form action="update_profile.php" method="POST">
                <label for="full_name">Full Name</label>
                <input type="text" name="full_name" value="<?php echo $user['full_name']; ?>" required>
                <label for="email">Email Address</label>
                <input type="email" name="email" value="<?php echo $user['email']; ?>" readonly>
                <label for="phone">Phone Number</label>
                <input type="text" name="phone" value="<?php echo $user['phone']; ?>">
                <label for="address">Address</label>
                <textarea name="address"><?php echo $user['address']; ?></textarea>
                <button type="submit">Save Changes</button>
            </form>
        </section>

        <!-- Account Settings -->
        <section>
            <h2>Account Settings</h2>
            <form action="update_password.php" method="POST">
                <label for="password">New Password</label>
                <input type="password" name="password" required>
                <button type="submit">Update Password</button>
            </form>
            <form action="update_subscription.php" method="POST">
                <label for="newsletter">Newsletter Subscription</label>
                <input type="checkbox" name="newsletter" <?php echo $user['newsletter'] ? 'checked' : ''; ?>>
                <button type="submit">Save Preferences</button>
            </form>
        </section>

        <!-- Order History -->
        <section>
            <h2>Order History</h2>
            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Date</th>
                        <th>Items</th>
                        <th>Total Amount</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?php echo $order['id']; ?></td>
                        <td><?php echo $order['order_date']; ?></td>
                        <td>
                            <?php foreach ($order['items'] as $item): ?>
                                <p><?php echo $item['product_name']; ?> x <?php echo $item['quantity']; ?></p>
                            <?php endforeach; ?>
                        </td>
                        <td><?php echo $order['total_amount']; ?></td>
                        <td><?php echo $order['status']; ?></td>
                        <td><a href="view_invoice.php?order_id=<?php echo $order['id']; ?>">View Invoice</a></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>

        <!-- Wishlist -->
        <section>
            <h2>Wishlist</h2>
            <ul>
                <?php foreach ($wishl-ist as $item): ?>
                <li>
                    <?php echo $item['product_name']; ?>
                    <button onclick="moveToCart(<?php echo $item['product_id']; ?>)">Move to Cart</button>
                    <button onclick="removeWishlistItem(<?php echo $item['id']; ?>)">Remove</button>
                </li>
                <?php endforeach; ?>
            </ul>
        </section>

        <!-- Payment Methods -->
        <section>
            <h2>Payment Methods</h2>
            <ul>
                <?php foreach ($payment_methods as $method): ?>
                <li>
                    <?php echo '**** **** **** ' . substr($method['card_number'], -4); ?>
                    <button onclick="deletePaymentMethod(<?php echo $method['id']; ?>)">Delete</button>
                </li>
                <?php endforeach; ?>
            </ul>
            <form action="add_payment_method.php" method="POST">
                <label for="card_number">Card Number</label>
                <input type="text" name="card_number" required>
                <label for="card_name">Name on Card</label>
                <input type="text" name="card_name" required>
                <label for="expiry_date">Expiry Date</label>
                <input type="date" name="expiry_date" required>
                <button type="submit">Add Card</button>
            </form>
        </section>

        <!-- Logout -->
        <section>
            <form action="logout.php" method="POST">
                <button type="submit">Logout</button>
            </form>
        </section>
    </main>
</body>
</html>
