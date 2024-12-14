<?php
session_start();
// Database Connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "velvet_vogue";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch Products
$products = $conn->query("SELECT * FROM products");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Velvet Vogue</title>
    <link rel="stylesheet" href="products.css">
</head>
<body>

    <!-- Navigation Bar -->
    <header>
        <nav class="navbar">
            <div class="logo"><b><a href="index.php">Velvet Vogue</a></b></div>
            <div class="nav_menu">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a class="active" href="products.html">Products</a></li>
                    <li><a href="accessories.html">Accessories</a></li>
                    <li><a href="support.html">Support</a></li>
                    <li id="join-profile">
                        <?php if (isset($_SESSION['username'])): ?>
                            <a href="testprofile.php"><?php echo htmlspecialchars($_SESSION['username']); ?></a>
                        <?php else: ?>
                            <a href="join.php">Join</a>
                        <?php endif; ?>
                    </li>
                    <?php if (isset($_SESSION['username'])): ?>
                    <li><a href="logout.php">Logout</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
    </header>

    <!-- Header with Search Bar -->
    <div class="header-search">
        <h1>Explore Velvet Vogue Collection</h1>
        <input type="text" id="searchBar" placeholder="Search for products..." onkeyup="filterProducts()">
    </div>

    <!-- Main Product Gallery -->
    <main>
        <div class="section-gap">
            <section class="Product-1">
                <h2><b>Products</b></h2>
                <div class="product-gallery" id="productGallery">
                    <?php if ($products && $products->num_rows > 0): ?>
                        <?php 
                        $count = 0; // Initialize product counter
                        while ($product = $products->fetch_assoc()): 
                            if ($count % 5 == 0 && $count > 0): // Close row after 5 products
                                echo '</div><div class="product-gallery">';
                            endif;
                        ?>
                            <div class="product-card" data-name="<?php echo htmlspecialchars($product['title']); ?>">
                                <a href="details.php?id=<?php echo $product['id']; ?>">
                                    <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['title']); ?>" class="promo-img">
                                </a>
                                <div class="promo-details">
                                    <h3><?php echo htmlspecialchars($product['title']); ?></h3>
                                    <p>$<?php echo number_format($product['price'], 2); ?></p>
                                    <a href="details.php?id=<?php echo $product['id']; ?>" class="promo-button">View Details</a>
                                </div>
                            </div>
                        <?php 
                            $count++;
                        endwhile; 
                        ?>
                    <?php else: ?>
                        <p>No products available at the moment.</p>
                    <?php endif; ?>
                </div>
            </section>
        </div>
    </main>

    <!-- Contact Info Section -->
    <footer>
        <div class="contact">
            <h2><b>Contact Us</b></h2>
            <div class="address">
                <div class="add-box">
                    <h3><b>Velvet Vogue</b></h3>
                    <p>500/A,<br>Ananda Coomaraswamy Mawatha,<br>Colombo 00700</p>
                    <div class="tel">
                        <p><b>Tel No:</b><br> +94 758 6957</p>
                    </div>
                    <div><p><b>Email:</b> Velvetvogue@support.com</p></div>
                </div>
            </div>
        </div>
    </footer>

    <!-- JavaScript for Search -->
    <script src="script.js"></script>
</body>
</html>
