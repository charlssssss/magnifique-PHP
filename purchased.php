<?php
	session_start();

	if(!isset($_SESSION["customer_id"]) || !isset($_GET["order_id"]))
	{
		header("location: index.php");
		exit;
		
	}

	require_once 'includes/dbh.inc.php';
	require_once 'includes/functions.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Purchased! | Magnifique</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="stylesheet" type="text/css" href="css/purchased.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Playfair+Display+SC&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/05f5e3eb98.js" crossorigin="anonymous"></script>
</head>
<body>
	<div class="nav-container">
		<div class="nav">
			<?php
				if(isset($_SESSION["customer_id"])) {
					echo "<a href='includes/logout.inc.php'>Logout</a>";
					echo "<a href='mycart.php'>My Cart</a>";
					echo "<a href='myaccount.php#my-orders'>My Orders</a>";
					echo "<a href='index.php'>Home</a>";
					echo "<img src='img/magnifique-bornz.png' alt='logo' class='logo'>";
					echo "<a class='customer-name' href='myaccount.php#my-account'>welcome! " . $_SESSION["firstname"] . " ". $_SESSION["lastname"] . "</a>";
				}
				else {
					echo "<a href='login.php'>Login</a>";
					echo "<a href='register.php'>Register</a>";
					echo "<a class='active' href='index.php'>Home</a>";
					
					echo "<img src='img/magnifique-bornz.png' alt='logo' class='logo'>";
					echo "<p href='index.php' class='logo-text'>MAGNIFIQUE</p>";
				}	
			?>
		</div>
	</div>

	<button onclick="topFunction()" id="goTopBtn" title="Go to top">&#129081;</button>
	<script src="js/javascript.js"></script>

	<div class="menu-container">
		<div class="menu-wrapper">
			<ul class="menu">
				<li>
					<a href="womens-clothing.php">WOMEN'S CLOTHING</a>
					<ul class="drop-menu">
						<li><a href="womens-clothing.php#wc-dress">Dress</a></li>
						<li><a href="womens-clothing.php#wc-top">Tops</a></li>
						<li><a href="womens-clothing.php#wc-jackets-coats">Jackets & Coats</a></li>
						<li><a href="womens-clothing.php#wc-hoodies-sweatshirts">Hoodies & Sweatshirts</a></li>
						<li><a href="womens-clothing.php#wc-jeans">Jeans</a></li>
					</ul>
				</li>
				<li>
					<a href="womens-shoes.php">WOMEN'S SHOES</a>
					<ul class="drop-menu">
						<li><a href="womens-shoes.php#ws-sneakers">Sneakers</a></li>
						<li><a href="womens-shoes.php#ws-sandals">Sandals</a></li>
						<li><a href="womens-shoes.php#ws-flat-shoes">Flat Shoes</a></li>
						<li><a href="womens-shoes.php#ws-slides-flipflops">Slides & Flip Flops</a></li>
						<li><a href="womens-shoes.php#ws-heels">Heels</a></li>
					</ul>
				</li>
				<li>
					<a href="lingerie-lounge.php">LINGERIE & LOUNGE</a>
					<ul class="drop-menu">
						<li><a href="lingerie-lounge.php#ll-bras">Bras</a></li>
						<li><a href="lingerie-lounge.php#ll-panties">Panties</a></li>
						<li><a href="lingerie-lounge.php#ll-lingerie-sets">Lingerie Sets</a></li>
						<li><a href="lingerie-lounge.php#ll-sexy-lingerie">Sexy Lingerie</a></li>
						<li><a href="lingerie-lounge.php#ll-sleep-loungewear">Sleep & Loungewear</a></li>
					</ul>
				</li>
				<li>
					<a href="accessories.php">ACCESSORIES</a>
					<ul class="drop-menu">
						<li><a href="accessories.php#ac-socks-tights">Socks & Tights</a></li>
						<li><a href="accessories.php#ac-belts">Belts</a></li>
						<li><a href="accessories.php#ac-scarves">Scarves</a></li>
						<li><a href="accessories.php#ac-umbrellas">Umbrellas</a></li>
						<li><a href="accessories.php#ac-hats-caps">Hats & Caps</a></li>
					</ul>
				</li>
				<li>
					<a href="womens-bag.php">WOMEN'S BAG</a>
					<ul class="drop-menu">
						<li><a href="womens-bag.php#wb-tote-bags">Tote Bags</a></li>
						<li><a href="womens-bag.php#wb-wristlets">Wristlets</a></li>
						<li><a href="womens-bag.php#wb-top-handle-bags">Top-Handle Bags</a></li>
						<li><a href="womens-bag.php#wb-clutches">Clutches</a></li>
						<li><a href="womens-bag.php#wb-backpacks">Backpacks</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
	<?php
		$subtotal = "";
		$est_date = "";
		if (isset($_GET["order_id"])) {
			$getOrder = getOrder($conn, $_GET["order_id"]);
			if ($r = mysqli_fetch_assoc($getOrder)) {
				$subtotal = $r["total"];
				$est_date = $r["date"];
			}
		}
	?>
	<div class="content-container">
		<div class="thankyou-part">
			<h2 style="margin: 10px;"><i class="fa-solid fa-clock"></i> &nbsp; Thank you for your purchase!</h2>
			<h2>₱ <?php echo number_format($subtotal, 2, '.', ','); ?></h2>
			<p style="font-size: 15px;">Your order number is 
			
			<?php
				$i = 0;
				if (isset($_GET["order_id"])) {
					$getOrderDetail = getOrderDetail($conn, $_GET["order_id"]);
					while ($row = mysqli_fetch_assoc($getOrderDetail)) {
						if ($i!=0) {
							echo ", ";
						}
						$i++;
						echo $row["order_detail_id"];
					}
				}
			?>
			</p>
		</div>
		<div class="details-part">
			<p style="font-size: 15px; padding-bottom: 15px;">Please have this amount ready on delivery day.</p>
			<h2 style="padding-bottom: 20px;">₱ <?php echo number_format($subtotal, 2, '.', ','); ?></h2>

			<div class="delivery-dates">
				<h3>Your Delivery Dates</h3>
				<div class="deliver-dates-wrapper">
					<div class="deliver-box header">
						<h3>Item</h3>
						<h3>Estimated Date</h3>
					</div>
					<?php
						if (isset($_GET["order_id"])) {
							$getOrderDetail = getOrderDetail($conn, $_GET["order_id"]);
							while ($row = mysqli_fetch_assoc($getOrderDetail)) {
					?>
						<hr style="border-top: 1px solid #ccc; width: 95%; margin: 0 auto;">
						<div class="deliver-box">
							<div class="deliver-img-side">
								<img src='<?php echo $row["product_img_path"]; ?>'>
							</div>
							<div class="deliver-name-side">
								<h4><?php echo $row["product_name"]; ?></h4>
								<p>Qty: <?php echo $row["quantity"]; ?></p>
								<p>Price: ₱ <?php echo number_format($row["product_price"], 2, '.', ','); ?><p>
							</div>
							<div class="deliver-date-side">
								<h4><?php echo date('d M', strtotime($est_date. ' + 4 days')); ?> - <?php echo date('d M', strtotime($est_date. ' + 7 days')); ?></h4>
							</div>
						</div>

					<?php			
							}
						}
					?>		
				</div>
				<div class="email-part">
					<p style="padding-right: 20px; font-size: 22px; color: #202225;"><i class="fa-regular fa-envelope"></i></p>
					<h5>We've sent a confirmation email to <?php echo $_SESSION["email"]; ?> with the order details.</h5>
				</div>
			</div>
		</div>
		<div class="button-container">
			<a href="index.php" style="width: 200px;"><button class="shop-btn">Shop More</button></a>
			<a href="myaccount.php#my-orders" style="width: 200px;"><button class="shop-btn order">View Orders</button></a>
		</div>
		
	</div>
	<?php 
		if(isset($_GET["error"])) {
			if($_GET["error"] == "none") {
				echo '<script>alert("Purchased successfully!")</script>';
			}
		}
	?>
	<footer>
		<div class="footer-content">
			<h3>Magnifique</h3>
			<p>Be exclusive, be divine, be yourself, be Magnifique.</p>
			<ul class="socials">
				<li><a href="#" class="fa fa-facebook"></a></li>
				<li><a href="#" class="fa fa-twitter"></a></li>
				<li><a href="#" class="fa fa-instagram"></a></li>
				<li><a href="#" class="fa fa-youtube"></a></li>
			</ul>
		</div>
		<div class="footer-bottom">
			<p>copyright &copy; 2022 Magnifique.</p>
		</div>
	</footer>
	
</body>
</html>