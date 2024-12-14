<?php 
session_start();
require './basicPHP/basic.php'; // load basic html from session
include './basicPHP/functions.php'; //basic functions
require 'db.php';


if(!isset($_SESSION['user_id']))
{
	header("Location: ./join.php");
}

?>



<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href= "style.css" rel= "stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
<title>Cart</title>
</head>

<body onload="showTotal(<?php echo $_SESSION['user_id']; ?>)">
	
	  <!-- Navigation Bar -->
	  <header>
        <nav class="navbar">
            <div class="logoT"><b><a href="index.php">Velvet Vogue</a></b></div>
            <div class="nav_menu">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a class="active" href="products.html">Products</a></li>
                    <li><a href="accessories.html">Accessories</a></li>
                    <li><a href="support.html">Support</a></li>
                    <li><a href="join.php">Join</a></li>
                </ul>
            </div>
        </nav>
    </header>

	
	
	
	
	<section id="cart" class="cart section-p1">
		<table width="100%">
			
			<thead>
				<tr>
					<td>Image</td>
					<td>Product</td>
					<td>Price</td>
					<td>Quantity</td>
					<td>Subtotal</td>
					<td>Remove</td>
				</tr>
			</thead>
			
			<tbody>

				<?php

					$sql = "SELECT * FROM cartitems WHERE uid = '{$_SESSION['user_id']}'";

					$result = dbFunction($sql);

					if (mysqli_num_rows($result) > 0) {

						while($dA1 = mysqli_fetch_assoc($result)) { ?>

							
							<?php //getting product details
							$productSQL = "SELECT * FROM products WHERE id = '{$dA1['pid']}'";
							$resultP = dbFunction($productSQL);
							$dP = mysqli_fetch_assoc($resultP);
							
							$firstPrice = (int)$dA1['quantity'] * (float)$dP['price'];
							
							?>


							<tr id="tablerowOfProduct<?php echo $dA1['pid'] ?>">
								<td><img src="<?php echo $dA1['image'] ?>" alt=""></td>
								<td><?php echo $dP['title']; ?></td>
								<td><?php echo priceFormat($dP['price']); ?></td>
								<td><input type="number" value="<?php echo $dA1['quantity']; ?>" min="1" max="50" name="inputQnt" onchange="sendAndChangePrice(this.value, '<?php echo $dA1['pid']; ?>', '<?php echo $dA1['uid']; ?>')"></td>

								<td id="totalPrice<?php echo $dA1['pid']; ?>"> <?php echo priceFormat($firstPrice) ?></td>
								<td class="specialAlign"><a href="#" data-pid="<?php echo $dA1['pid'];?>" onclick="deleteItemFromCart(event, this.getAttribute('data-pid'), '<?php echo $dA1['uid'] ?>')"><i id="close1" class="fa-regular fa-rectangle-xmark" ></i></a></td>
							</tr>

				<?php
						}
					}
				?>
				
				
			</tbody>
			
		</table>
	</section>
	
	<section id="cart-add" class="section-p1 cart-add">
		<div id="discount" class="discount">
			<h3>Apply Discount Code: </h3>
			<div>
				<input type="text" placeholder="Enter Your Coupon">
				<button class="normal">Apply</button>
			</div>
		</div>
		
		<div id="total" class="total">
			<h3>Cart Total</h3>
			<table>
				<tr>
					<td>Cart Subtotal</td>
					<td id="subtotal-cart"></td>
				</tr>
				
				<tr>
					<td>Tax(18%)</td>
					<td id="tax-cart"></td>
				</tr>
				
				<tr>
					<td>Shipping</td>
					<td id="shipping-cart"></td>
				</tr>
				
				<tr>
					<td><strong>Total</strong></td>
					<td id="total-cart"><strong></strong></td>
				</tr>
			</table>
			
			<button class="normal">Check Out</button>
		</div>
	</section>
	

	<footer>
        <div class="contact2">
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
	
	<script src="script.js"></script>
</body>
</html>
