<?php

	if(isset($_POST["edit_prof"])) {
		$customer_id = $_POST["cust_id"];
		$firstname = $_POST["firstname"];
		$lastname = $_POST["lastname"];
		$address = $_POST["address"];
		$phone = $_POST["phone"];

		require_once 'dbh.inc.php';
		require_once 'functions.inc.php';

		if(phoneInvalid($phone)!== false) {
			header("location: ../myaccount.php?error=phoneinvalid#my-account");
			exit();
		}

		editProfile($conn, $customer_id, $firstname, $lastname, $address, $phone);	
	}
	else {
		header("location: ../myaccount.php?#my-account");
		exit();
	}