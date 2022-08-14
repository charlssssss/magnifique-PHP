<?php
	session_start();
	//check if user logged in
	if(isset($_POST["addcart"]) && isset($_SESSION["customer_id"])) {
		$prod_link = $_POST["prod_link"];
		$prod_img_path = $_POST["prod_img_path"];
		$customer_id = $_POST["prod_cust_id"];
		$product_id =  $_GET["prod_id"];
		$quantity = $_POST["prod_quantity"];

		require_once 'dbh.inc.php';
		require_once 'functions.inc.php';

		//execute if this item has not been in the cart
		if (itemInCartExists($conn, $customer_id, $product_id) == false) {
			addItemToCart($conn, $prod_link, $prod_img_path, $customer_id, $product_id, $quantity);
		}//if item exists arleady in the cart, update only quantity
		else {
			updateQtyItem($conn, $prod_link, $customer_id, $product_id, $quantity);
		}
	}
	else{
		header("location: ../mycart.php");
		exit();
	}
	// else {//execute if user not logged in
	// 	if(isset($_SESSION["cart"])) {
	// 		$session_array_id = array_column($_SESSION["cart"], "id");
	// 		//insert if product not in cart
	// 		if (!in_array($_GET["prod_id"], $session_array_id)) {

	// 			$sesssion_array = array(
	// 			'id' => $_GET["prod_id"],
	// 			'name' => $_POST["prod_name"],
	// 			'price' => $_POST["prod_price"],
	// 			'quantity' => $_POST["prod_quantity"]
	// 			);

	// 			$_SESSION["cart"][] = $sesssion_array;
	// 		}
	// 		else {//insert only quantity if product already in cart
	// 			for ($i=0; $i < count($_SESSION["cart"]); $i++) { 
	// 				if($_SESSION["cart"][$i]['id'] == $_GET["prod_id"]) {
	// 					$_SESSION["cart"][$i]['quantity'] += $_POST["prod_quantity"];
	// 				}
	// 			}
	// 		}

	// 	}
	// 	else {//initialize cart
	// 		$sesssion_array = array(
	// 			'id' => $_GET["prod_id"],
	// 			'name' => $_POST["prod_name"],
	// 			'price' => $_POST["prod_price"],
	// 			'quantity' => $_POST["prod_quantity"]
	// 		);

	// 		$_SESSION["cart"][] = $sesssion_array;
	// 	}
	// 	echo "<pre>";
	// 	var_dump($_SESSION["cart"]);

	// 	echo "</pre>";
	// }
	
			// $prod_name = $_POST["prod_name"];
		// $prod_price = $_POST["prod_price"];
		// $prod_quantity = $_POST["prod_quantity"];

		// echo "name = $prod_name";
		// echo "price = $prod_price";
		// echo "quantity = $prod_quantity";