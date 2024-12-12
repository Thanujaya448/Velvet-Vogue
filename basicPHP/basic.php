<?php 

$_SESSION['footer'] = '
		<div class="col">
			<img class="logo" src="../img/gym_logo.png" alt="" style="width: 50px; height: 50px;">
			<h4>Contact</h4>
			<p><strong>Address:</strong> No. 456 Test Road, Street test, TestCountry</p>
			<p><strong>Phone:</strong> (+94) 21 4151 1245 / (+94) 01 2341 5153</p>
			<p><strong>Hours:</strong> 09:00 - 18:00, Mon - Sat</p>
			
			<div class="follow">
				<h4>Follow us</h4>
				<div class="icon">
					<i class="fab fa-facebook-f"></i>
					<i class="fab fa-twitter"></i>
					<i class="fab fa-instagram"></i>
					<i class="fab fa-pinterest"></i>
					<i class="fab fa-youtube"></i>
				</div>
			</div>
		</div>
		
		<div class="col">
			<h4>About</h4>
			<a href="./about.php">About us</a>
			<a href="#">Delivery Information</a>
			<a href="./policy.php">Privacy Policy</a>
			<a href="./policy.php#terms">Terms & Conditions</a>
			<a href="./contact.php">Contact us</a>
		</div>
		
		<div class="col">
			<h4>My Account</h4>
			<a href="./login/login.php">Sign In</a>
			<a href="./cart.php">View Cart</a>
			<a href="#">Track My Order</a>
			<a href="./contact.php">Help</a>
		</div>
		
		<div class="col_install">
			<h4>Install Our App</h4>
			<p>From App Store or Google Play</p>
			<div class="row">
				<a href="https://www.apple.com/app-store/" target="_blank">
					<img src="../img/appStore.png" alt="" width="150px">
				</a>
				<a href="https://play.google.com/store/games?hl=en&gl=US" target="_blank">
					<img src="../img/google_play.png" alt="" width="150px">
				</a>
			</div>
			
			<p class="payment_text">Secured Payment Gateways </p>
			<span class="customImg">
			<img src="../img/payment/visa.png" alt="">
			<img src="../img/payment/master_card.png" alt="">
			<img src="../img/payment/mae_logo.png" alt="">
			<img src="../img/payment/american-express.png" alt="">
			</span>
		</div>
		
		<div class="copy-right">
			<p><i class="fa-regular fa-copyright"></i> 2024. DeSH etc - WAD E-commerce Website</p>
		</div>';



if($_SESSION['userType'] == "Admin")
{
	$_SESSION['navi2'] = '
	<ul id="nav-bar2" class="nav-bar">
	<form action="./search.php" method="POST">
		<input type="search" id="search1" name="search1" placeholder="Search anything...">
	</form>
	<li id="search-icon" name="search-icon" class="search-icon"> <i class="fa-solid fa-magnifying-glass"></i></li>
	<li><a href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a></li>
	<li><a href="addProduct.php"><i class="fa-solid fa-user"></i></a></li></ul>';
}
else if($_SESSION['userType'] == "User")
{
	$_SESSION['navi2'] = '
	<ul id="nav-bar2" class="nav-bar">
	<form action="./search.php" method="POST">
		<input type="search" id="search1" name="search1" placeholder="Search anything...">
	</form>
	<li id="search-icon" name="search-icon" class="search-icon"> <i class="fa-solid fa-magnifying-glass"></i></li>
	<li><a href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a></li>
	<li><a href="./basicPHP/logout.php" onclick="alert("Logged out Succesfully");"><i class="fa-solid fa-user"></i></a></li></ul>';
}
else
{
	$_SESSION['userType'] = 'new';
	$_SESSION['navi2'] = '
	<ul id="nav-bar2" class="nav-bar">
	<form action="./search.php" method="POST">
		<input type="search" id="search1" name="search1" placeholder="Search anything...">
	</form>
	<li id="search-icon" name="search-icon" class="search-icon"> <i class="fa-solid fa-magnifying-glass"></i></li>
	<li><a href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a></li>
	<li><a href="login/login.php"><i class="fa-solid fa-user"></i></a></li></ul>';
}



    
	
?>