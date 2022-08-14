<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Register | Magnifique</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="stylesheet" type="text/css" href="css/login-register.css">
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
			<a href="login.php">Login</a>
			<a class="active" href="register.php">Register</a>
			<a href="index.php">Home</a>
			
			<img src='img/magnifique-bornz.png' alt='logo' class='logo'>
			<p href='index.php' class='logo-text'>MAGNIFIQUE</p>
		</div>
	</div>
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
		$firstname = "";
		$lastname = "";
		$address = "";
		$phone = "";
		$email = "";

		if(isset($_SESSION["retryregister"])) {
			$firstname = $_SESSION["retryregister"]["fname"];
			$lastname = $_SESSION["retryregister"]["lname"];
			$address = $_SESSION["retryregister"]["add"];
			$phone = $_SESSION["retryregister"]["phn"];
			$email = $_SESSION["retryregister"]["eml"];
		}
	?>
	<div class="content-container">
		<form method="POST" action="includes/register.inc.php" class="login-register reg">
			<! –– Arlert messages ––> 
			<?php
				if(isset($_GET["error"])) {
					if($_GET["error"] == "none") {
						echo "<h3 class='alert'>You have sucessfully registered! Thank you!</h3>";
						$firstname = "";
						$lastname = "";
						$address = "";
						$phone = "";
						$email = "";
						
						session_unset();
						session_destroy();
					}
				}
			?>	
			<ul>
				<li><h2>Register</h2></li>
				<li>
					<input type="text" name="firstname" placeholder="First Name" value="<?php echo $firstname; ?>">
				</li>
				<li>
					<input type="text" name="lastname" placeholder="Last Name" value="<?php echo $lastname; ?>">
				</li>
				<li>
					<input type="text" name="address" placeholder="Address" value="<?php echo $address; ?>">
				</li>
				<li>
					<input type="number" name="phone" class="phone-textbox" placeholder="Phone Number" value="<?php echo $phone; ?>">
				</li>
				<li>
					<input type="email" name="email" placeholder="Email" value="<?php echo $email; ?>">
				</li>
				<li>
					<input type="password" name="passwrd" placeholder="Password">
				</li>
				<li>
					<input type="password" name="passwrdrepeat" placeholder="Repeat Password">
				</li>
				<! –– Error messages ––> 
				<?php
					if(!isset($_SESSION)) {
						session_unset();
						session_destroy();
					}			
					if(isset($_GET["error"])) {
						if($_GET["error"] == "emptyinput") {
							echo "<li><p class='error-text'>Fill up all feilds.</p></li>";	
						}
						else if($_GET["error"] == "phoneinvalid") {
							echo "<li><p class='error-text'>Phone number invalid.</p></li>";
						}
						else if($_GET["error"] == "passwordinvalid") {
							echo "<li><p class='error-text'>At least 8 characters, at least 1 digit and special character, and both upper and lower case.</p></li>";
							echo "<li><p class='error-text'>Password invalid.</p></li>";	
						}
						else if($_GET["error"] == "passwordsdontmatch") {
							echo "<li><p class='error-text'>Password do not match.</p></li>";	
						}
						else if($_GET["error"] == "emailtaken") {
							echo "<li><p class='error-text'>Email already taken!</p></li>";	
						}
					}
				?>
				<li>
					<button type="submit" name="register" class="login-register-btn">Register</button>
				</li>
				<li style="padding-top: 15px;">
					<p>Have an account?
					<a href="login.php">Log in.</a>
					</p>
				</li>
	
			</ul>
		</form>	
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