<?php
// Include database connection file
require_once 'db.php';

// Start session
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    // Display error message if user is not logged in
    echo "No user is logged in.";
    exit;
}

// Get user data from database
$user = getUserData($_SESSION['username']);

// Get order history from database
$orders = getOrderHistory($_SESSION['username']);

// Get wishlist from database
$wishlist = getWishlist($_SESSION['username']);

// Get payment methods from database
$payment_methods = getPaymentMethods($_SESSION['username']);

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

    <header class="profile-header">
        <div class="profile-picture">
            <form action="upload_picture.php" method="POST" enctype="multipart/form-data">
                <img src="uploads/<?php echo $user['profile_picture']; ?>" alt="Profile Picture">
                <input type="file" name="profile_picture" accept="image/*">
                <button type="submit">Update Picture</button>
            </form>
        </div>
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
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
                <?php foreach ($wishlist as $item): ?>
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

<?php
// Function to get user data from database
function getUserData($username) {
    // Connect to database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "velvet_vogue";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query to get user data
    $query = "SELECT * FROM users WHERE username = '$username'";

    // Execute query
    $result = $conn->query($query);

    // Fetch user data
    $user = $result->fetch_assoc();

    // Close connection
    $conn->close();

    // Return user data
    return $user;
}

// Function to get order history from database
function getOrderHistory($username) {
    // Connect to database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "velvet_vogue";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query to get order history
    $query = "SELECT * FROM orders WHERE username = '$username'";

    // Execute query
    $result = $conn->query($query);

    // Fetch order history
    // $orders = array();
    // while ($row = $result->fetch_assoc()) {
    //     $orders[] = $row;
    // }

    // // Close connection
    // $conn->close();

    // // Return order history
    // return $orders;
}

// Function to get wishlist from database
function getWishlist($username) {
    // Connect to database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "velvet_vogue";
    
    // Create a connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query to get wishlist
    $query = "SELECT * FROM wishlist WHERE username = '$username'";

    // Execute query
    $result = $conn->query($query);

    // Fetch wishlist
    // $wishlist = array();
    // while ($row = $result->fetch_assoc()) {
    //     $wishlist[] = $row;
    // }

    // // Close connection
    // $conn->close();

    // // Return wishlist
    // return $wishlist;
}

// Function to get payment methods from database
function getPaymentMethods($username) {
    // Connect to database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "velvet_vogue";
    
    // Create a connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query to get payment methods
    $query = "SELECT * FROM payment_methods WHERE username = '$username'";

    // Execute query
    $result = $conn->query($query);

    // Fetch payment methods
    // $payment_methods = array();
    // while ($row = $result->fetch_assoc()) {
    //     $payment_methods[] = $row;
    // }

    // // Close connection
    // $conn->close();

    // // Return payment methods
    // return $payment_methods;
}
?>
```