<?php
	session_start();

	if(isset($_POST["edit-qty"])) {
		$prod_link = "";
		$customer_id = $_SESSION["customer_id"];
		$product_id =  $_POST["prod_id"];
		$quantity = $_POST["new_qty"];

		require_once 'dbh.inc.php';
		require_once 'functions.inc.php';	

		updateQtyItem($conn, $prod_link, $customer_id, $product_id, $quantity);
	}
	else{
		header("location: ../mycart.php");
		exit();
	}