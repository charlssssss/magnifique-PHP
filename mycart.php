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
	<title>My Cart | Magnifique</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="stylesheet" type="text/css" href="css/mycart.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Playfair+Display+SC&display=swap" rel="stylesheet">

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
		<div class="content-wrapper">
			<div class="cart-container">
				<?php
					$itemCount = "";
					if (isset($_SESSION["customer_id"])) {
						$getItemCount = getItemCount($conn, $_SESSION["customer_id"]);
						if ($r = mysqli_fetch_assoc($getItemCount)) {
							$itemCount = $r["item_count"];
						}
					}	
				?>
				<div class="cart-header main">
					<h2>MY CART (<?php echo ($itemCount == "") ? "0" : $itemCount; ?>)</h2>
				</div>
				<div class="cart-header">
					<div style="width: 11%;">

					</div>
					<div class="cart-header" style="width: 89%;">
						<h4>PRODUCT</h4>
						<h4>TOTAL PRICE</h4>
					</div>
				</div>
				<hr style="border-top: 1px solid #bcbec1;">
				<?php
					if($itemCount == 0) {
						echo "<h3 class='no-item-added'>No Item Added</h3>";
						echo "<a href='index.php' class='shop-now-btn'>Shop Now</a>";
					}
					$subcount = 0;
					$subtotal = 0;
					$order_items = array();

					if (isset($_SESSION["customer_id"])) {
						$getAllItem = getAllItem($conn, $_SESSION["customer_id"]);

						while ($row = mysqli_fetch_assoc($getAllItem)) {
								if($row["select_prod"] == "selected") {
									$subcount+= $row["quantity"];
									$subtotal = $subtotal + ($row["product_price"] * $row["quantity"]);
									$order_detail = array(
										'prod_id' => $row["prod_id"],
										'prod_price' => $row["product_price"],
										'qty' => $row["quantity"],
										'img_path' => $row["prod_img_path"],
										'cart_id' =>  $row["cart_id"]
									);

									$order_items[] = $order_detail;
									// array_push($order_items, $row["cart_id"]);
								}
							?>
				<div class="item-container">
					<div class="item-box">
						<div class="item-select-side">
							<form method="POST" action="includes/edit-sel-prod.inc.php">
								<input type="hidden" name="cart_id" value="<?php echo $row["cart_id"]; ?>">
								<input type='hidden' name='sel_prod' value='<?php echo ($row["select_prod"] == "selected") ? "removed": "selected"; ?>'>

								<button type="submit" name="selected_prod" style="background-color: <?php echo ($row["select_prod"] == "selected") ? "#36393f": "white"; ?>;">&#10004;</button>

								<!-- <?php 
									if ($row["select_prod"] == "removed") {
										echo "<input type='checkbox' name='sel_prod' value='selected' onchange='this.form.submit()'>";
									}
									else if ($row["select_prod"] == "selected") {
										echo "<input type='checkbox' name='sel_prod' value='removed' onchange='this.form.submit()'>";
									}
								?> -->
								<!-- <input type="checkbox" name="sel_prod" value='<?php echo ($row["select_prod"] == "removed") ? "selected": "removed"; ?>' onchange="this.form.submit()" > -->
							</form>		
						</div>
						<div class="item-image-side">
							<img src="<?php echo $row["prod_img_path"]; ?>">
						</div>
						<div class="item-detail-side">
							<h4><b><?php echo $row["product_name"]; ?></b></h5>
							<h5>Qty: <?php echo $row["quantity"]; ?></h5>
							<h5><b>Price: ₱ <?php echo number_format($row["product_price"], 2, '.', ','); ?></b></h4>
							<!-- remove edit part -->
							<form method="POST" action="includes/remove-item.inc.php" class="total-row rem">
								<input type="hidden" name="cart_id" value="<?php echo $row["cart_id"]; ?>">
								<button type="submit" name="remove" onclick="return confirm('Do you want to remove this item?')">remove</button>
								<button type="button" onclick="editQty(<?php echo "".$row["cart_id"]; ?>)">edit</button>
							</form>
							<!-- edit update part -->
							<div id="<?php echo "".$row["cart_id"]; ?>" class="modal">
								<div class="modal-content">
									<span class="close" onclick="closeQty(<?php echo "".$row["cart_id"]; ?>)">&times;</span>
									<form method="POST" action="includes/edit-qty.inc.php" class="edit-form">
										<div class="edit-image-side">
											<img src="<?php echo $row["prod_img_path"]; ?>">
										</div>
										<div class="edit-detail-side">
											<h2><b><?php echo $row["product_name"]; ?></b></h2>
											<h4>Price: ₱ <?php echo number_format($row["product_price"], 2, '.', ','); ?></h4>
											<input type="hidden" name="prod_id" value='<?php echo $row["prod_id"]; ?>'>
											<label for="new_qty">quantity: 
												<select id="new_qty" name="new_qty">
													<option value="1">1</option>
													<option value="2">2</option>
													<option value="3">3</option>
													<option value="4">4</option>
													<option value="5">5</option>
													<option value="6">6</option>
													<option value="7">7</option>
													<option value="8">8</option>
													<option value="9">9</option>
													<option value="10">10</option>
												</select>
											</label>
											<button type="submit" name="edit-qty">update</button>
										</div>
									</form>
								</div>
							</div>	
							<script src="js/javascript.js"></script>
						</div>
					</div>
					<div class="price">

						<h4 style="float: right;">₱ <?php echo number_format(($row["product_price"] * $row["quantity"]), 2, '.', ','); ?></h4>
					</div>
				</div>
				<hr style="border-top: 1px solid #bcbec1;">
				<?php	
						}
					}
				?>
			</div>
			<!-- <?php 
				// echo "<pre>";
				// var_dump($order_items);
				// echo "</pre>";
			?> -->
			<form method="POST" action="order.php" class="total-container" id="total-ctnr">
				<h4>ORDER SUMMARY</h4>
				<div class="total-wrapper">
					<div class="total-row stl">
						<p>Subtotal (<?php echo $subcount;?> items)</p>
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
				<input type="hidden" name="order_items" value="<?php echo htmlentities(serialize($order_items)); ?>">
				<button  type="submit" name="check_out" class="check-btn" <?php echo ($subcount == 0) ? "disabled": ""; ?>>PROCEED TO CHECKOUT (<?php echo $subcount; ?>)</button>
			</form>
		</div>			
	</div>
	
	<?php
		if($itemCount == 0) {
			echo "<script>document.getElementById('total-ctnr').style.display='none';</script>";
		}

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