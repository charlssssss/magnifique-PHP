<?php

	if(isset($_POST["edit-review-rate"])) {
		$prod_link = $_POST["prod_link"];
		$customer_id = $_POST["customer_id"];
		$product_id = $_POST["product_id"];
		$review = $_POST["review"];
		$rating = $_POST["rating"];
		$date = $_POST["date"];

		require_once 'dbh.inc.php';
		require_once 'functions.inc.php';

		// echo "<p>" . $prod_link ."</p>";
		// echo "<p>" . $customer_id ."</p>";
		// echo "<p>" . $product_id ."</p>";
		// echo "<p>" . $review ."</p>";
		// echo "<p>" . $rating ."</p>";
		// echo "<p>" . $date ."</p>";

		updateReview($conn, $prod_link, $customer_id, $product_id, $review, $rating, $date);
	}
	else{
		header("location: ../" . $prod_link . "?product_id=" . $product_id);
		exit();
	}