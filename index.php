<?php
// Start the session
session_start();
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-site-verification" content="pxrP0TaIZMiZ5tKKZs01g6m02B7gBCCzbbb2UiEmd70" />
    <title>Velvet Vogue</title>
    <link rel="stylesheet" href="home.css">
</head>
<body>

    <!-- Navigation Bar -->
    <header>
        <nav class="navbar">
            <div class="logo"><b><a href="index.php">Velvet Vogue</a></b></div>
            <div class="nav_menu">
                <ul>
                    <li><a class="active" href="index.php">Home</a></li>
                    <li><a href="product.php">Products</a></li>
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

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>Discover Your Style</h1>
            <p>Explore the latest trends in fashion with us</p>
            <a href="product.php" class="hero-button">Shop Now</a>
        </div>
    </section>

    <!-- Promotion Section -->
    <section class="promotion">
        <h2><b>Promotions</b></h2>
        <div class="promotion-container">
            <!-- Promotion 1 -->
            <div class="promo-box">
                <img src="Images/5.PNG" alt="Promotion 1" class="promo-img">
                <div class="promo-details">
                    <h3>Summer Sale</h3>
                    <p>Up to 50% off</p>
                    <a href="product.php" class="promo-button">Shop Now</a>
                </div>
            </div>

            <!-- Promotion 2 -->
            <div class="promo-box">
                <img src="Images/2.PNG" alt="Promotion 2" class="promo-img">
                <div class="promo-details">
                    <h3>New Arrivals</h3>
                    <p>Check out the latest trends</p>
                    <a href="product.php" class="promo-button">Shop Now</a>
                </div>
            </div>

            <!-- Promotion 3 -->
            <div class="promo-box">
                <img src="Images/3.PNG" alt="Promotion 3" class="promo-img">
                <div class="promo-details">
                    <h3>Exclusive Offer</h3>
                    <p>Buy 1 get 1 free on select items</p>
                    <a href="product.php" class="promo-button">Shop Now</a>
                </div>
            </div>

            <!-- Promotion 4 -->
            <div class="promo-box">
                <img src="Images/6 (2).jpg" alt="Promotion 3" class="promo-img">
                <div class="promo-details">
                    <h3>Exclusive Offer</h3>
                    <p>Buy 1 get 1 free on select items</p>
                    <a href="product.php" class="promo-button">Shop Now</a>
                </div>
            </div>
            <!-- Promotion 5 -->
            <div class="promo-box">
                <img src="Images/6.PNG" alt="Promotion 3" class="promo-img">
                <div class="promo-details">
                    <h3>Exclusive Offer</h3>
                    <p>Buy 1 get 1 free on select items</p>
                    <a href="product.php" class="promo-button">Shop Now</a>
                </div>
            </div>
        </div>
    </section>

    <!-- New Arrivals Section -->
    <section class="newarrivals">
        <h2><b>New Arrivals</b></h2>
        <div class="newarrivals-container">
            <!-- New Arrivals 1 -->
            <div class="newarr-box">
                <img src="Images/6 (4).jpg" alt="newarrival 1" class="arr-img">
                <div class="arr-details">
                    <h3>Casual Wear</h3>
                    <p>casual wear for women</p>
                    <a href="product.php" class="arr-button">Shop Now</a>
                </div>
            </div>

            <!-- New Arrivals 2 -->
            <div class="newarr-box">
                <img src="Images/MFor.jpg" alt="newarrival 2" class="arr-img">
                <div class="arr-details">
                    <h3>Formal Wear</h3>
                    <p>Latest formal wear for men</p>
                    <a href="product.php" class="arr-button">Shop Now</a>
                </div>
            </div>

            <!-- New Arrivals 3 -->
            <div class="newarr-box">
                <img src="Images/HW.jpg" alt="newarrival 3" class="arr-img">
                <div class="arr-details">
                    <h3>Special Event Wear</h3>
                    <p>Special day celebrations</p>
                    <a href="product.php" class="arr-button">Shop Now</a>
                </div>
            </div>

            <!-- New Arrivals 4 -->
            <div class="newarr-box">
                <img src="Images/7.PNG" alt="newarrival 2" class="arr-img">
                <div class="arr-details">
                    <h3>Formal Wear</h3>
                    <p>Latest formal wear for men</p>
                    <a href="product.php" class="arr-button">Shop Now</a>
                </div>
            </div>

            <!-- New Arrivals 5 -->
            <div class="newarr-box">
                <img src="Images/Com.jfif" alt="newarrival 3" class="arr-img">
                <div class="arr-details">
                    <h3>Special Event Wear</h3>
                    <p>Special day celebrations</p>
                    <a href="product.php" class="arr-button">Shop Now</a>
                </div>
            </div>
        </div>
    </section>

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

</body>
</html>
