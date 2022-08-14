<?php

	if(isset($_POST["remove"])) {
		$cart_id = $_POST["cart_id"];

		require_once 'dbh.inc.php';
		require_once 'functions.inc.php';

		removeItem($conn, $cart_id);
	}
	else{
		header("location: ../mycart.php");
		exit();
	}