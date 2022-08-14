<?php

	if(isset($_POST["del_review"])) {
		$prod_link = $_POST["prod_link"];
		$customer_id = $_POST["customer_id"];
		$product_id = $_POST["product_id"];

		require_once 'dbh.inc.php';
		require_once 'functions.inc.php';

		deleteReview($conn, $prod_link, $customer_id, $product_id);
	}
	else{
		header("location: ../" . $prod_link . "?product_id=" . $product_id);
		exit();
	}