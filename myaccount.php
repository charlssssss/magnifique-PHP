<?php
	session_start();

	if(!isset($_SESSION["customer_id"]))
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
	<title>My Account | Magnifique</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="stylesheet" type="text/css" href="css/myaccount.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Playfair+Display+SC&display=swap" rel="stylesheet">
	<script src="js/javascript.js"></script>
</head>
<body>
	<div class="nav-container">
		<div class="nav">
			<?php
				if(isset($_SESSION["customer_id"])) {
					echo "<a href='includes/logout.inc.php'>Logout</a>";
					echo "<a href='mycart.php'>My Cart</a>";
					echo "<a class='active' href='myaccount.php#my-orders'>My Orders</a>";
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
	
	<div class="content-container">
		<div class="categories-side">
			<div id="categoriesWrapper" >
				<ul class="category-links">
					<li><a href="#my-account">My Account</a></li>
					<li><a href="#my-orders">My Orders</a></li>	
				</ul>
			</div>	
		</div>
		<div class="items-side">
			<div class="items-container">
				<?php
					$firstname = "";
					$lastname = "";
					$address = "";
					$phone = "";
					if (isset($_SESSION["customer_id"])) {
						$getCustomerInfo = getCustomerInfo($conn, $_SESSION["customer_id"]);
						
						$firstname = $getCustomerInfo["firstname"];
						$lastname = $getCustomerInfo["lastname"];
						$address = $getCustomerInfo["address"];
						$phone = $getCustomerInfo["phone"];
					}
				?>
				<div class="items-group">
					<h4 id="my-account" style="padding-top: 43px; margin-bottom: 40px;">Manage My Account</h4>
					<div class="my-account-container">
						<form method="POST" action="includes/edit-profile.inc.php" class="account-box">
							<h3>Edit Profile</h3>
							<div>
								<label for="fName">First name</label><br>
								<input type="text" name="firstname" id="fName" placeholder="First name" value='<?php echo $firstname; ?>' required>
							</div>
							<div>
								<label for="lName">Last name</label><br>
								<input type="text" name="lastname" id="lName" placeholder="Last name" value='<?php echo $lastname; ?>' required>
							</div>
							<div>
								<label for="phone">Mobile Number</label><br>
								<input type="text" name="phone" id="phone" placeholder="Mobile number" value='<?php echo $phone; ?>' required>
							</div>
							<div>
								<label for="address">Address</label><br>
								<input type="text" name="address" id="address" placeholder="Address" value='<?php echo $address; ?>' required>
							</div>
							<input type="hidden" name="cust_id" value='<?php echo $_SESSION["customer_id"]; ?>'>
							<button type="submit" name="edit_prof" onclick='if(!confirm("Are you sure to save changes?")){ return false;}' class="submit-btn">Edit Profile</button>
						</form>

						<form method="POST" action="includes/change-pass.inc.php" class="account-box">
							<h3>Change Password</h3>
							<div>
								<label for="curpass">Current Password</label><br>
								<input type="password" name="curpass" id="curpass" placeholder="Current Password" required>
							</div>
							<div>
								<label for="newpass">New Password</label><br>
								<input type="password" name="newpass" id="newpass" placeholder="New Password" required>
							</div>
							<div>
								<label for="cfmpass">Confirm Password</label><br>
								<input type="password" name="cfmpass" id="cfmpass" placeholder="Confirm Password" required>
							</div>
							<input type="hidden" name="cust_id" value='<?php echo $_SESSION["customer_id"]; ?>'>
							<button type="submit" name="change_pass" onclick='if(!confirm("Are you sure to change password?")){ return false;}' class="submit-btn">Change Password</button>
						</form>
					</div>
				</div>

				<div class="items-group">
					<h4 id="my-orders" style="padding-top: 43px;">My Orders</h4>
					<?php
						if (isset($_SESSION["customer_id"])) {
							$getAllOrderDetail = getAllOrderDetail($conn, $_SESSION["customer_id"]);
							if (!mysqli_num_rows($getAllOrderDetail) > 0) { 
						?>
							<div class="orders-container" style="flex-direction: column;">
								<h3 class='no-item-added'>No Orders Added</h3>
								<a href='index.php' class='shop-now-btn'>Shop Now</a>
							</div>
						<?php 
							}
						}
					?>
					<?php
						if (isset($_SESSION["customer_id"])) {
							$getAllOrderDetail = getAllOrderDetail($conn, $_SESSION["customer_id"]);
							while ($row = mysqli_fetch_assoc($getAllOrderDetail)) {
					?>
					<div onclick='editQty(<?php echo "".$row["order_detail_id"]; ?>)' class="orders-container ordr-cont">
						<div class="order-box">
							<div class="order-header">
								<img src='img/magnifique-bornz.png' alt='logo' class='logo ordr'>
								<p href='index.php' class='logo-text ordr-txt'>MAGNIFIQUE</p>
								<p class='header'>Get by <?php echo date('D d M', strtotime($row["date"]. ' + 4 days')); ?> - <?php echo date('D d M', strtotime($row["date"]. ' + 7 days')); ?></p>
								<p class='header pending'>Payment Pending</p>
							</div>
							<hr style="border-top: 1px solid #ddd; margin: 0 1%; ">
							<div class="order-detail">
								<div class="img-side">
									<img src='<?php echo $row["product_img_path"]; ?>'>
								</div>
								<div class="detail-side">
									<h5><?php echo $row["product_name"]; ?></h5>
									<p>Price: ₱ <?php echo number_format(($row["product_price"]), 2, '.', ','); ?></p>
								</div>
								<div class="price-side">
									<p>Total: ₱ <b><?php echo number_format(($row["product_price"] * $row["quantity"]), 2, '.', ','); ?></b></p>
								</div>
								<div class="qty-side">
									<p>Qty: <b><?php echo $row["quantity"]; ?></b></p>
								</div>
							</div>
						</div>
					</div>
					<?php
						$orderId = "";
						$date = "";
						$fullname = "";
						$full_address = "";
						$phone = "";

						$getOrderOrder = getOrderOrder($conn, $row["order_detail_id"]);
						if ($r = mysqli_fetch_assoc($getOrderOrder)) {
							$orderId = $r["order_id"];
							$date = $r["date"];
							$fullname = $r["firstname"] . " ". $r["lastname"];
							$full_address = $r["address1"] . ", ". $r["address4"] . ", ". $r["address3"] . " City, ". $r["address2"];
							$phone = $r["phone"];
						}
					?>
					<div id="<?php echo "".$row["order_detail_id"]; ?>" class="modal">
						<div class="modal-content">
							<span class="close" onclick='closeQty(<?php echo "".$row["order_detail_id"]; ?>)'>&times;</span>
							<div class="order-detail-date">
								<h5>Get by <?php echo date('D d M', strtotime($date. ' + 4 days')); ?> - <?php echo date('D d M', strtotime($date. ' + 7 days')); ?></h5>
							</div>
							<form method="POST" action="includes/cancelorder.inc.php" class="order-detail-form"> 
								<div class="img-side">
									<img src='<?php echo $row["product_img_path"]; ?>'>
								</div>
								<div class="detail-side">
									<h5><?php echo $row["product_name"]; ?></h5>
									<p>Price: ₱ <?php echo number_format(($row["product_price"]), 2, '.', ','); ?></p>
								</div>
								<div class="price-side">
									<p>Total: ₱ <b><?php echo number_format(($row["product_price"] * $row["quantity"]), 2, '.', ','); ?></b></p>
								</div>
								<div class="qty-side">
									<p>Qty: <b><?php echo $row["quantity"]; ?></b></p>
								</div>
								<div class="cancel-side">
									<input type="hidden" name="ordr_dtl_id" value='<?php echo $row["order_detail_id"]; ?>'>
									<button type="submit" name="cancel_order" onclick='if(!confirm("Are you sure you want to cancel order?")){ return false;}' class="cancel-ordr-btn">Cancel Order</button>
								</div>
							</form>
							<div class="order-detail-box" style="flex-direction: column;">
								<h5>Order <?php echo $row["order_detail_id"]; ?></h5>
								<p>Placed on <?php echo date('F d Y', strtotime($date)); ?></p>
							</div>
							<div class="order-detail-box lower">
								<div class="order-detail-box low-left" style="flex-direction: column;">
									<h5><?php echo $fullname; ?></h5>
									<p><?php echo $full_address; ?></p>
									<h5 style="padding-top: 7px;"><?php echo $phone; ?></h5>
								</div>
								<div class="order-detail-box low-right" style="flex-direction: column;">
									<h5 style="padding-bottom: 5px;">Total Summary</h5>
									<div class="subtl-txt">
										<p>Subtotal(<?php echo $row["quantity"]; ?> item)</p>
										<p>₱ <b><?php echo number_format(($row["product_price"] * $row["quantity"]), 2, '.', ','); ?></b></p>
									</div>
									<div class="subtl-txt">
										<p>Shipping Fee</p>
										<p>₱ <b>0.00</b></p>
									</div>
									<hr style="border-top: 1px solid #eee; margin: 5px 0 10px;">
									<div class="subtl-txt">
										<p>Total</p>
										<p>₱ <b><?php echo number_format(($row["product_price"] * $row["quantity"]), 2, '.', ','); ?></b></p>
									</div>
								</div>
							</div>
						</div>
					</div>	
					<script src="js/javascript.js"></script>
					<?php			
							}
						}
					?>	
				</div>
			</div>
		</div>
	</div>
	<?php 
		if(isset($_GET["order"])) {
			if($_GET["order"] == "canceled") {
				echo '<script>alert("Order has been canceled successfully!")</script>';
			}
		}

		if(isset($_GET["account"])) {
			if($_GET["account"] == "profedited") {
				echo '<script>alert("Account updated successfully!")</script>';
			}
			else if($_GET["account"] == "passchanged") {
				echo '<script>alert("Password changed successfully!")</script>';
			}
		}

		if(isset($_GET["error"])) {
			if($_GET["error"] == "phoneinvalid") {
				echo '<script>alert("Invalid phone number!")</script>';
			}
			else if($_GET["error"] == "wrongpassword") {
				echo '<script>alert("Wrong password!")</script>';
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