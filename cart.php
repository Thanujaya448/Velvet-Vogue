<?php 
session_start();
require './basicPHP/basic.php'; // load basic html from session
include './basicPHP/functions.php'; //basic functions


if(!isset($_SESSION['email']))
{
	header("Location: ./login/login.php");
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

<body onload="showTotal(<?php echo $_SESSION['uid']; ?>)">
	
	<section id="header" class="header">
		
		<a href="#">
			<img src= "../img/gym_logo.png" alt= "Gym Logo" class="logo">
		</a>
		
		<div>
			
			<ul id="nav-bar" class="nav-bar">
				<li><a href="index.php">Home</a></li>
				<li><a href="products.php">Products</a></li>
				<li><a href="./login/login.php">Login/Registe</a></li>
				<li><a href="about.php">About</a></li>
				<li><a href="contact.php">Contact us</a></li>
			</ul>
			
		</div>
		
		<div>
			<?php echo $_SESSION['navi2']; ?>
		</div>
		
	</section>
	
	
	<section id="contact-header" class="contact-header">
		
		<h2>#We're_almost_there!</h2>
		<p style="line-height: 25px;">Thank you for shopping with us!<br>Your satisfaction is our priority.</p>

	</section>
	
	
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

					$sql = "SELECT * FROM cartitems WHERE uid = '{$_SESSION['uid']}'";

					$result = dbFunction($sql);

					if (mysqli_num_rows($result) > 0) {

						while($dA1 = mysqli_fetch_assoc($result)) { ?>


							<?php //getting product details
							$productSQL = "SELECT * FROM product WHERE pid = '{$dA1['pid']}'";
							$resultP = dbFunction($productSQL);
							$dP = mysqli_fetch_assoc($resultP);
							
							$firstPrice = (int)$dA1['quantity'] * (int)$dP['price'];
							
							?>


							<tr id="tablerowOfProduct<?php echo $dA1['pid'] ?>">
								<td><img src="<?php echo $dA1['image'] ?>" alt=""></td>
								<td><?php echo $dP['product_Name']; ?></td>
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
	


<footer class="section-p1" >
	<?php echo $_SESSION['footer']?>
</footer>
	
	<script src="script.js"></script>
</body>
</html>
