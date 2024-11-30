<?php
// Database connection
$servername = "localhost"; // Change if your server is different
$username = "your_username"; // Your database username
$password = "your_password"; // Your database password
$dbname = "velvet_vogue"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch product details
$sql = "SELECT * FROM products WHERE id = 1"; // Fetching product with id 1
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    $row = $result->fetch_assoc();
} else {
    echo "0 results";
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $row['title']; ?></title>
    <link rel="stylesheet" href="details.css">
</head>
<body>

    <!-- Navigation Bar -->
    <header>
        <nav class="navbar">
            <div class="logo"><b><a href="index.html">Velvet Vogue</a></b></div>
            <div class="nav_menu">
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li><a href="products.html">Products</a></li>
                    <li><a href="categories.html">Categories</a></li>
                    <li><a href="support.html">Support</a></li>
                    <li><a href="join.html">Join</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- Production details page -->
    <center>
        <section class="details">
            <h2><b><?php echo $row['title']; ?></b></h2>
            <div class="details-container">
                <div class="details-box">
                    <img src="<?php echo $row['image']; ?>" alt="" class="details-img" style="display: inline;">
                    <div class="product-details">
                        <h3><?php echo $row['category']; ?></h3>
                        <p><?php echo $row['description']; ?></p>
                        <p class="price" style="font-size:16px;">Price $<?php echo $row['price']; ?></p>
                        <a href="products.html" class="details-button">Add to cart</a>
                    </div>
                </div>
            </div>
        </section>
    </center>

    <!-- Contact Info Section -->
    <footer>
        <div class="contact">
            <h2><b>Contact Us</b></h2>
            <div class="address">
                <div class="add-box">
                    <h3><b>Velvet Vogue</b></h3>
                    <p>500/A,<br>Ananda Coomaraswamy Maw