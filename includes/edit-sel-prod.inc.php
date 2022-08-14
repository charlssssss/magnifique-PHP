<?php

	if(isset($_POST["selected_prod"])) {
		$cart_id = $_POST["cart_id"];
		$sel_prod = $_POST["sel_prod"];

		require_once 'dbh.inc.php';
		require_once 'functions.inc.php';

		updateSelectItem($conn, $cart_id, $sel_prod);
	}
	else{
		header("location: ../mycart.php");
		exit();
	}