<?php

	if(isset($_POST["change_pass"])) {
		$customer_id = $_POST["cust_id"];
		$curpass = $_POST["curpass"];
		$newpass = $_POST["newpass"];
		$cfmpass = $_POST["cfmpass"];

		require_once 'dbh.inc.php';
		require_once 'functions.inc.php';


		if(passwrdInvalid($newpass) !== false) {
			header("location: ../myaccount.php?error=passwordinvalid#my-account");
			exit();
		}
		if(passwrdUnmatch($newpass, $cfmpass) !== false) {
			header("location: ../myaccount.php?error=passwordsdontmatch#my-account");
			exit();
		}

		changePassword($conn, $customer_id, $curpass, $newpass);
	}
	else {
		header("location: ../myaccount.php?#my-account");
		exit();
	}