<?php
include 'db.php';
session_start();

if (!isset($_GET['order_id'])) {
    die("Invalid order ID.");
}

$order_id = $_GET['order_id'];
$user_id = $_SESSION['user_id'];

$query = "SELECT * FROM orders WHERE id = ? AND user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('ii', $order_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $order = $result->fetch_assoc();
    echo "<h1>Invoice for Order #" . $order['id'] . "</h1>";
    echo "<p>Date: " . $order['order_date'] . "</p>";
    echo "<p>Total: $" . $order['total_amount'] . "</p>";

    $items_query = "SELECT * FROM order_items WHERE order_id = ?";
    $stmt = $conn->prepare($items_query);
    $stmt->bind_param('i', $order_id);
    $stmt->execute();
    $items_result = $stmt->get_result();

    echo "<h2>Items</h2><ul>";
    while ($item = $items_result->fetch_assoc()) {
        echo "<li>" . $item['product_name'] . " x " . $item['quantity'] . " - $" . $item['price'] . "</li>";
    }
    echo "</ul>";
} else {
    echo "Order not found.";
}
?>
