<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Home | Magnifique</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="stylesheet" type="text/css" href="css/styles.css">
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
					echo "<a href='mycart.php'>My Cart</a>";
					echo "<a href='myaccount.php#my-orders'>My Orders</a>";
					echo "<a class='active' href='index.php'>Home</a>";
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
		<div class="content-wrapper content-1"
			style="background:  url('img/frontpage.jpg');" 
			>
			<div class="main-content">
				<h2 class="h-content-title">BEST OF MAGNIFIQUE</h2>
				<p>Shop now so you don't miss out!</p>
				<a href="lingerie-lounge.php"><button class="h-btn">SHOP NOW!</button></a>
			</div>
		</div>
		<div class="content-wrapper">
			<div class="content-wrapper-side">
				<div class="content">
					<a href="accessories.php#ac-belts">
					<div class="content-box-2">
						<img src="img/index-img/img-4.PNG">
						<div class="overlay"></div>
						<div class="text">New Accessories</div>
					</div></a>
					<a href="accessories.php"><button class="content-btn">SHOP ACCESSORIES</button></a>
				</div>
				<div class="content">
					<a href="womens-shoes.php">
					<div class="content-box-2">
						<img src="img/index-img/img-1.PNG">
						<div class="overlay"></div>
						<div class="text">Trending Shoes</div>
					</div></a>
					<a href="womens-shoes.php#ws-heels"><button class="content-btn">SHOP SHOES & HEELS</button></a>
				</div>
			</div>
		</div>
		<div class="content-wrapper">
			<h2 class="content-title">FEATURED PRODUCTS</h2>
			<h3 class="content-sub-title">Shop your favorite products from the @Magnifique</h2>
			<div class="content-wrapper-side">
				<div class="content">
					<a href="womens-clothing.php#wc-jackets-coats">
					<div class="content-box-3">
						<img src="img/index-img/img-3.PNG">
						<div class="overlay"></div>
						<div class="text">Shop Jackets</div>
					</div>
					</a>
				</div>
				<div class="content">
					<a href="womens-clothing.php#wc-tops">
					<div class="content-box-3">
						<img src="img/index-img/img-5.PNG">
						<div class="overlay"></div>
						<div class="text">Shop Tops</div>
					</div>
					</a>
				</div>
				<div class="content">
					<a href="womens-clothing.php#wc-dress">
					<div class="content-box-3">
						<img src="img/index-img/img-2.PNG">
						<div class="overlay"></div>
						<div class="text">Shop Dress</div>
					</div>
					</a>
				</div>
			</div>
		</div>
	</div>
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