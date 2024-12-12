<?php

session_start();

//print_r($_SESSION);

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "velvet_vogue";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get product ID from URL and sanitize it
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 1; // Default to 1 if not provided

// Fetch product details
$sql = "SELECT * FROM products WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $product_id); // Bind the product ID as an integer
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Output data of each row
    $row = $result->fetch_assoc();
} else {
    echo "0 results";
}
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $row['title']; ?></title>
    <link rel="stylesheet" href="test.css">
</head>
<body>
    <!-- Navbar -->
    <header>
        <nav class="navbar">
            <div class="logo"><b><a href="index.php">Velvet Vogue</a></b></div>
            <div class="nav_menu">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="product.php">Products</a></li>
                    <li><a href="accessories.html">Accessories</a></li>
                    <li><a href="support.html">Support</a></li>
                    <li><a href="join.php">Join</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- Product Details Section -->
    <section class="details">
        <h2><?php echo $row['title']; ?></h2>
        <div class="details-container">
            <div class="details-box">
                <img src="<?php echo $row['image']; ?>" alt="Product Image" class="details-img">
                <div class="product-details">
                    <h3>Category: <?php echo $row['category']; ?></h3>
                    <p><?php echo $row['description']; ?></p>
                    <p class="price">Price: $<?php echo $row['price']; ?></p>
                        <form method="POST" style="display:inline">
                            <input type="number" value="1" min="1" max="50" name="qtn">
                            <button class="normal" name="add2cart" value="<?php echo $_GET['id']; ?>">Add to Cart</button>
                        </form>
                </div>
            </div>
        </div>
    </section>


    	<!-- add to cart function -->
	<?php 

        if(isset($_POST['add2cart']))
        {

            if(!isset($_SESSION['user_id']))
            {
                //header('Location:./join.php');
            }


            $proID = $_POST['add2cart'];
            $quantity = $_POST['qtn'];
            $type;
            $sqladdcart;

            $con = mysqli_connect("localhost", "root", "", "velvet_vogue", "3306");

            if (!$con){
                die("Sorry, you can't connect into the database.");
            }

            

            $sql = "SELECT * FROM cartitems WHERE uid = {$_SESSION['user_id']} AND pid = $proID";
            $result = mysqli_query($con, $sql);

            if(mysqli_num_rows($result) > 0)
            {
                $type = "old";
            }
            else{
                $type = "new";
            }


            if($type == "new")
            {
                $imgPath = $row['image'];
                $sqladdcart = "INSERT INTO `cartitems` (`uid`, `pid`, `quantity`, `image`) VALUES ('{$_SESSION['user_id']}', '$proID', '$quantity', '$imgPath')";
            }
            else if($type == "old")
            {

                $sql_count = "SELECT * FROM cartitems WHERE uid = '{$_SESSION['user_id']}' AND pid = '$proID'";
                $row1 = mysqli_fetch_assoc(mysqli_query($con, $sql_count));

                $newcount = (int)$row1['quantity'];
                $newquantity = (int)$quantity;

                $newVal =  $newcount + $newquantity;

                $sqladdcart = "UPDATE `cartitems` SET `quantity` = '$newVal' WHERE uid = '{$_SESSION['user_id']}' AND pid = '$proID'";
            }

            $addItem = mysqli_query($con, $sqladdcart);
        }

    ?>





    <!-- Footer -->
    <footer>
        <div class="contact">
            <h2><b><center>Contact Us</center></b></h2>
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
