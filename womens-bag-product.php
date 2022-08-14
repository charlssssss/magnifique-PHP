<?php
	session_start();

	require_once 'includes/dbh.inc.php';
	require_once 'includes/functions.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Women's Bag</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="stylesheet" type="text/css" href="css/products.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Playfair+Display+SC&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/05f5e3eb98.js" crossorigin="anonymous"></script>
	<script src="js/javascript.js"></script>
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
		if(isset($_GET["product_id"])) {
			$product_id = $_GET["product_id"];
			$getProduct = getProduct($conn, $product_id);
			$getRating = getRating($conn, $product_id);
			$img1 = "\"img/magnifique-items/womens-bag/" . $getProduct["product_image_1"]. "\"";
			$img2 = "\"img/magnifique-items/womens-bag/" . $getProduct["product_image_2"]. "\"";
			$img3 = "\"img/magnifique-items/womens-bag/" . $getProduct["product_image_3"]. "\"";
			$img4 = "\"img/magnifique-items/womens-bag/" . $getProduct["product_image_4"]. "\"";

			$reviewCount = "";
			$ratingSum = "";
			if ($r = mysqli_fetch_assoc($getRating)) {
				$reviewCount = $r["review_count"];
				$ratingSum = number_format($r["rating_sum"], 1, '.');
			}
		}
	?>
	<div class="breadcrumb-container">
		<div class="breadcrumb">
			<p>
				<a href="womens-bag.php">Women's Bag</a>
				 / 
				 <?php
				 	if (str_contains($product_id,"wbtb")) {
				 		echo "<a href='womens-bag.php#wb-tote-bags'>Tote Bags</a>";
				 	}
				 	if (str_contains($product_id,"wbw")) {
				 		echo "<a href='womens-bag.php#wb-wristlets'>Wristlets</a>";
				 	}
				 	if (str_contains($product_id,"wbthb")) {
				 		echo "<a href='womens-bag.php#wb-top-handle-bags'>Top-Handle Bags</a>";
				 	}
				 	if (str_contains($product_id,"wbc")) {
				 		echo "<a href='womens-bag.php#wb-clutches'>Clutches</a>";
				 	}
				 	if (str_contains($product_id,"wbb")) {
				 		echo "<a href='womens-bag.php#wb-backpacks'>Backpacks</a>";
				 	}
				 ?>
				 / 
				<a href="womens-bag-product.php?product_id=<?php echo $product_id; ?>"><?php echo $getProduct["product_name"]; ?></a>
			</p>
		</div>
	</div><!-- image thumbnail section -->
	<div class="content-container">
		<div class="thumbnail-side">
			<div id="image1" class="thumb-box">
				<img onclick='img1(<?php echo $img1; ?>)' src="img/magnifique-items/womens-bag/<?php echo $getProduct["product_image_1"]; ?>" >
			</div>
			<div id="image2" class="thumb-box">
				<img onclick='img2(<?php echo $img2; ?>)' src="img/magnifique-items/womens-bag/<?php echo $getProduct["product_image_2"]; ?>" >
			</div>
			<div id="image3" class="thumb-box">
				<img onclick='img3(<?php echo $img3; ?>)' src="img/magnifique-items/womens-bag/<?php echo $getProduct["product_image_3"]; ?>" >
			</div>
			<div id="image4" class="thumb-box">
				<img onclick='img4(<?php echo $img4; ?>)' src="img/magnifique-items/womens-bag/<?php echo $getProduct["product_image_4"]; ?>" >
			</div>
		</div>
		<div class="image-side"> <!-- main image section -->
			<img id="main-img" src="img/magnifique-items/womens-bag/<?php echo $getProduct["product_image_1"]; ?>" >
		</div>
		<form method="POST" action="includes/addcart.inc.php?prod_id=<?php echo $getProduct["product_id"]; ?>" class="details-side"><!-- details section -->


			<h1><?php echo $getProduct["product_name"]; ?></h1>
			<h3><p class="fa fa-star checked"></p> <?php echo $ratingSum; ?> (<?php echo ($reviewCount== 0) ? "No" : $reviewCount;; ?> Reviews)</h3>
			<h2>₱ <?php echo number_format($getProduct["product_price"], 2, '.', ','); ?></h2>
			<!-- hidden variables for session in add to cart table -->
			<input type="hidden" name="prod_name" value="<?php echo $getProduct["product_name"]; ?>">
			<input type="hidden" name="prod_price" value="<?php echo $getProduct["product_price"]; ?>">
			<input type="hidden" name="prod_cust_id" value="<?php echo (isset($_SESSION["customer_id"])) ? $_SESSION["customer_id"] : ""; ?>">
			<input type="hidden" name="prod_img_path" value="img/magnifique-items/womens-bag/">
			<input type="hidden" name="prod_link" value="womens-bag-product.php">
			<input type="hidden" name="prod_quantity" value="1">

			<?php
				$order_items = array();
				$order_detail = array(
					'prod_id' => $product_id,
					'prod_price' => $getProduct["product_price"],
					'qty' => '1',
					'img_path' => "img/magnifique-items/womens-bag/". $getProduct["product_image_1"],
					'cart_id' =>  "none"
				);

				$order_items[] = $order_detail;
			?>
			
			<input type="hidden" name="order_items" value="<?php echo htmlentities(serialize($order_items)); ?>">
			<?php
				if(isset($_SESSION["customer_id"])) {
					echo "<button type='submit' name='addcart' class='prod-btn'>Add to Cart</button>";
					echo "<button name='check_out' formaction='order.php' class='prod-btn order'>Order Now</button>";
				}
				else {
					echo "<input type='hidden' name='prev_link' value='womens-bag-product.php?product_id=".$getProduct['product_id']."'>";
					echo "<button type='submit' name='addcart' onclick='if(!confirm(\"Login first to proceed. Do you want to login?\")){ return false;}' formaction='login.php' class='prod-btn'>Add to Cart</button>";
					echo "<button typ='submit' name='ordernow' onclick='if(!confirm(\"Login first to proceed. Do you want to login?\")){ return false;}' formaction='login.php' class='prod-btn order'>Order Now</button>";
				}
			?>
			<!-- description section -->
			<h3 style="margin: 30px 0 20px;">Description</h3>
			<ul>
				<li>Lorem ipsum dolor sit amet consectetuer adipiscing</li>
				<li>Amet consectetuer adipiscing elit</li>
				<li>Sed diam nonummy nibh euismod tincidunt dolore</li>
				<li>Diam nonummy nibh euismod tincidunt ut laoreet</li>
				<li>elit sed diam nonummy nibh euismod laoreet dolore</li>
			</ul>
		</form>
	</div>
	<!-- reviews section -->
	<div class="review-container">
		<div class="review-wrapper">
			<div class="review-product">
				<h3><b>OVERALL RATING</b> (<?php echo ($reviewCount== 0) ? "No" : $reviewCount; ?> Reviews)</h3>
				<div class="oa-rating">
					<?php
						for ($i=1; $i <= 5; $i++) { 
							if ($i <= $ratingSum) {
								echo "<span class='fa fa-star checked'></span>";
							}
							else {
								echo "<span class='fa fa-star'></span>";
							}
						}	
					?>
					<span><?php echo $ratingSum; ?></span>
				</div>
				<?php
					if(isset($_SESSION["customer_id"]) && isset($_GET["product_id"])) {
						$reviewAlready = customerReviewAlready($conn, $_SESSION["customer_id"], $_GET["product_id"]);
						
						if ($reviewAlready == false) {
							//no review yet on this customer
							echo "<button id='review-btn' class='review-btn'>Review this Item</button>";
						}
						else {
							//edit
							echo "<button id='edit-review-btn' class='review-btn'>Edit Review</button>";
						}
					}
					// else {
					// 	echo "<button class='review-btn'>Review this Item</button>";
					// }
					
				?> 	
			</div>
		</div>
		<div class="customer-review">
			<?php
				if(isset($_GET["product_id"])) {
					$product_id = $_GET["product_id"];
					$getReview = getReview($conn, $product_id);

					while ($row = mysqli_fetch_assoc($getReview)) { ?>
			<div class="review-box">
				<div class="ra-box">
					<h3><b><?php echo $row["customer_name"]; ?></b> <?php echo (isset($_SESSION["customer_id"])) ? (($row["customer_id"]==$_SESSION["customer_id"]) ? "(You)" : ""): ""; ?></h3>
					<div class="rating">
						<?php
							for ($i=1; $i <= 5; $i++) { 
								if ($i <= $row["rating"]) {
									echo "<span class='fa fa-star checked'></span>";
								}
								else {
									echo "<span class='fa fa-star'></span>";
								}
							}	
						?>
						<span><?php echo date('F d Y', strtotime($row["date"])); ?></span>
					</div>
				</div>
				<div class="re-box">
					<P><?php echo $row["review"]; ?></P>
				</div>
			<hr>
			</div>

			<?php
					}
				}

			?>
		</div>
	</div>
	<!-- Add review item modal -->
	<div id="review-modal" class="modal">
		<div class="modal-content">
			<span class="close">&times;</span>
			<form method="POST" action="includes/review-rate.inc.php" class="review-form">
				<h3>RATE THIS ITEM</h3>
				<div class="rev-form-content">
					<div class="rev-image-side">
						<img src="img/magnifique-items/womens-bag/<?php echo $getProduct["product_image_1"]; ?>">
					</div>
					<div class="rev-content-side">
						<h2><?php echo $getProduct["product_name"]; ?></h2>
						<div class="rate">
							<?php

								$reviewAlready = customerReviewAlready($conn, $_SESSION["customer_id"], $_GET["product_id"]);

							?>
							<input type="radio" id="star5" name="rating" value="5" />
							<label for="star5" title="text">5 stars</label>
							<input type="radio" id="star4" name="rating" value="4" />
							<label for="star4" title="text">4 stars</label>
							<input type="radio" id="star3" name="rating" value="3" />
							<label for="star3" title="text">3 stars</label>
							<input type="radio" id="star2" name="rating" value="2" />
							<label for="star2" title="text">2 stars</label>
							<input type="radio" id="star1" name="rating" value="1" />
							<label for="star1" title="text">1 star</label>
						 </div>
						<h4><b>Share your thoughts with the MAGNIFIQUE community!</b> <i>(optional)</i></h4>
						<textarea maxlength="500" placeholder="Review here..." name="review"></textarea>
						<input type="hidden" name="date" value="<?php echo date('Y-m-d');?>">
						<input type="hidden" name="customer_id" value='<?php echo $_SESSION["customer_id"]; ?>'>
						<input type="hidden" name="product_id" value="<?php echo $_GET["product_id"]; ?>">
						<input type="hidden" name="prod_link" value="womens-bag-product.php">
						<button type="submit" name="review-rate" class="review-btn">Submit my review</button>
					</div>
				</div>		
			</form>
		</div>
	</div>
	<script src="js/javascript.js"></script>

	<!-- edit item modal -->
	<div id="edit-review-modal" class="modal">
		<div class="modal-content">
			<span class="edit-close">&times;</span>
			<form method="POST" action="includes/update-review-rate.inc.php" class="review-form">
				<div class="rev-form-header">
					<h3>EDIT REVIEW</h3>
					<button type="submit" name="del_review" formaction="includes/delete-review.inc.php" class="del-review-btn" onclick='if(!confirm("Are you sure to delete review?")){ return false;}'><i class="fa-solid fa-trash-can"></i></button>
				</div>
				<div class="rev-form-content">
					<div class="rev-image-side">
						<img src="img/magnifique-items/womens-bag/<?php echo $getProduct["product_image_1"]; ?>">
					</div>
					<div class="rev-content-side">
						<h2><?php echo $getProduct["product_name"]; ?></h2>
						<div class="rate">
							<?php
								if(isset($_SESSION["customer_id"]) && isset($_GET["product_id"])) {
									$reviewAlready = customerReviewAlready($conn, $_SESSION["customer_id"], $_GET["product_id"]);						

									for ($i=5; $i >= 1; $i--) { 
										if($i == $reviewAlready["rating"]) {
											echo "<input type='radio' id='estar$i' name='rating' value='$i' checked />";
											echo "<label for='estar$i' title='text'>$i stars</label>";
										}	
										else {
											echo "<input type='radio' id='estar$i' name='rating' value='$i'/>";
											echo "<label for='estar$i' title='text'>$i stars</label>";
										}
									}
								}
							?>
						 </div>
						<h4><b>Share your thoughts with the MAGNIFIQUE community!</b> <i>(optional)</i></h4>
						<textarea maxlength="500" placeholder="Review here..." name="review"><?php echo $reviewAlready["review"]; ?></textarea>
						<input type="hidden" name="date" value="<?php echo date('Y-m-d');?>">
						<input type="hidden" name="customer_id" value='<?php echo $_SESSION["customer_id"]; ?>'>
						<input type="hidden" name="product_id" value="<?php echo $_GET["product_id"]; ?>">
						<input type="hidden" name="prod_link" value="womens-bag-product.php">
						<button type="submit" name="edit-review-rate" class="review-btn">Edit Review</button>
					</div>
				</div>		
			</form>
		</div>
	</div>
	<script src="js/editModal.js"></script>

	<!-- review confirm notification -->
	<?php
		if(isset($_GET["error"])) {
			if($_GET["error"] == "none") {
				echo '<script>alert("Thank you for reviewing our item!")</script>';
			}
		}

		if(isset($_GET["addtocart"])) {
			if($_GET["addtocart"] == "success") {
				echo '<script>alert("Item added to your cart!")</script>';
			}
		}

		if(isset($_GET["review"])) {
			if($_GET["review"] == "deleted") {
				echo '<script>alert("Review deleted successfully!")</script>';
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
	<script src="js/javascript.js"></script>
	</body>
</html>