<?php
	session_start();

	if(!isset($_SESSION["customer_id"]) || !isset($_POST["check_out"]))
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
	<title>Place Order | Magnifique</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="stylesheet" type="text/css" href="css/order.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Playfair+Display+SC&display=swap" rel="stylesheet">
	<script src="js/city.js"></script>	
	<script>	
	window.onload = function() {	

		// ---------------
		// basic usage
		// ---------------
		var $ = new City();
		$.showProvinces("#province");
		$.showCities("#city");

		// ------------------
		// additional methods 
		// -------------------

		// will return all provinces 
		console.log($.getProvinces());
		
		// will return all cities 
		console.log($.getAllCities());
		
		// will return all cities under specific province (e.g Batangas)
		// console.log($.getCities("Batangas"));	
		
	}
	</script>
</head>
<body>
	<div class="nav-container">
		<div class="nav">
			<?php
				if(isset($_SESSION["customer_id"])) {
					echo "<a href='includes/logout.inc.php'>Logout</a>";
					echo "<a class='active'href='mycart.php'>My Cart</a>";
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
	<div class="content-container">
		<form method="POST" action="includes/placeorder.inc.php" class="content-wrapper">
			<div class="order-container">
				<div class="order-header main">
					<h2>DELIVERY INFORMATION</h2>
				</div>
				<div class="delivery-info-container">
					<div class="customer-info-side">
						<div>
							<label for="fName">First name</label><br>
							<input type="text" name="firstname" id="fName" placeholder="First name" value='<?php echo $_SESSION["firstname"]; ?>' required>
						</div>
						<div>
							<label for="lName">Last name</label><br>
							<input type="text" name="lastname" id="lName" placeholder="Last name" value='<?php echo $_SESSION["lastname"]; ?>' required>
						</div>
						<div>
							<label for="phone">Mobile Number</label><br>
							<input type="text" name="phone" id="phone" placeholder="Please enter your mobile number" value='<?php echo $_SESSION["phone"]; ?>' required>
						</div>
					</div>
					<div class="address-info-side">		
						<div>
							<label for="province">Province</label><br>
							<select id="province" name="province" required></select>
							<!-- <input type="text" name="province" id="province" placeholder="Please enter your province" required> -->
						</div>
						<div>
							<label for="city">City/Municipality</label><br>
							<select id="city" name="city" required></select>	
							<!-- <input type="text" name="city" id="city" placeholder="Please enter your city/municipality" required> -->
						</div>
						<div>
							<label for="brgy">Barangay</label><br>
							<input type="text" name="barangay" id="brgy" placeholder="Enter Barangay" required>
						</div>
						<div>
							<label for="strtName">House Number and Street Name</label><br>
							<input type="text" name="street" id="strtName" placeholder="Enter House No. and Street Name" required>
						</div>
					</div>
				</div>
				<?php
					$order_itms = unserialize($_POST['order_items']);
				?>
				<div class="package-container">
					<?php
					$subcount = 0;
					$subtotal = 0;

					for ($i=0; $i < count($order_itms) ; $i++) { 
						$getProduct = getProduct($conn, $order_itms[$i]['prod_id']);
						
						$subtotal = $subtotal + ($getProduct["product_price"] * $order_itms[$i]['qty']);
						$subcount+=$order_itms[$i]['qty'];
						?>
						<div class="package-box">
							<div class="pack-image-side">
								<img src="<?php echo $order_itms[$i]['img_path']; ?>" style="height: auto; width: 50px;">
							</div>
							<div class="pack-detail-side">
								<h4><?php echo $getProduct["product_name"]; ?></h4>
								<p>Price: <b>₱ <?php echo number_format($getProduct["product_price"], 2, '.', ','); ?></b></p>
								<p>Package <?php echo $i+1; ?> of <?php echo count($order_itms); ?></p>
							</div>
							<div class="pack-qty-side">
								<h5 style="font-weight: normal;">Qty: <b><?php echo $order_itms[$i]['qty']; ?></b></h5>
							</div>
							<div class="pack-price-side">
								<h4>₱ <?php echo number_format($getProduct["product_price"] * $order_itms[$i]['qty'], 2, '.', ','); ?></h4>
							</div>				
						</div>
						<?php
					}
				?>
				</div>
			</div>
				
			<div class="payment-method-container">
				<h4>SELECT PAYMENT METHOD</h4>
				<div class="payment-method-wrapper" style="margin-bottom: 20px;">
					<div id="cod1" class="payment-method-box" style="margin-bottom: 10px;">
						<div class="payment-row">
							<h5>Cash On Delivery</h5><input type="radio" name="payment_method" id="pay_Method1" value="cod" onclick="payMethodChangeBorder()" required>
						</div>
						<p>Pay when you receive</p>
					</div>
					
					<div id="card2" class="payment-method-box">
						<div class="payment-row">
							<h5>Credit/Debit Card</h5><input type="radio" name="payment_method" id="pay_Method2" value="card" onclick="payMethodChangeBorder()" required>
						</div>
						<p>Pay with your card</p>
					</div>
				</div>
				<script src="js/javascript.js"></script>

				<h4>Order Summary</h4>
				<div class="payment-method-wrapper">
					<div class="total-row stl">
						<p>Subtotal (<?php echo $subcount; ?> items)</p>
						<p>₱ <?php echo number_format($subtotal, 2, '.', ','); ?></p>
					</div>
					<div class="total-row stl">
						<p>Shipping Fee</p>
						<p>₱ 0.00</p>
					</div>
					
					<hr style="border-top: 1px solid #bcbec1; margin: 20px 0;">

					<div class="total-row">
						<b><p>Total</p></b>
						<b><p>₱ <?php echo number_format($subtotal, 2, '.', ','); ?></p></b>
					</div>
				</div>
				<input type="hidden" name="item_qty" value="<?php echo $subcount; ?>">
				<input type="hidden" name="total" value="<?php echo $subtotal; ?>">
				<input type="hidden" name="order_date" value='<?php echo "".date("Y-m-d"); ?>'>
				<input type="hidden" name="order_items" value="<?php echo htmlentities(serialize($order_itms)); ?>">
				<button type="submit" name="place_order" class="check-btn">PLACE ORDER NOW</button>
			</div>
		</form>			
	</div>
	
	<?php
		if(isset($_GET["item"])) {
			if($_GET["item"] == "removed") {
				echo '<script>alert("Item has removed!")</script>';
			}

			if($_GET["item"] == "updated") {
				echo '<script>alert("Item has updated!")</script>';
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