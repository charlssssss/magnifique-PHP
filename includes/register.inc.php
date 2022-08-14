<?php

	if(isset($_POST["register"])) {
		
		$firstname = $_POST["firstname"];
		$lastname = $_POST["lastname"];
		$address = $_POST["address"];
		$phone = $_POST["phone"];
		$email = $_POST["email"];
		$passwrd = $_POST["passwrd"];
		$passwrdrepeat = $_POST["passwrdrepeat"];

		session_start();
		$_SESSION["retryregister"] = array(
			'fname' => $firstname, 
			'lname' => $lastname, 
			'add' => $address, 
			'phn' => $phone, 
			'eml' => $email
		);

		require_once 'dbh.inc.php';
		require_once 'functions.inc.php';

		if(emptyInputRegister($firstname, $lastname, $address, $phone, $email, $passwrd, $passwrdrepeat) !== false) {
			header("location: ../register.php?error=emptyinput");
			exit();
		}
		if(phoneInvalid($phone)!== false) {
			header("location: ../register.php?error=phoneinvalid");
			exit();
		}
		if(passwrdInvalid($passwrd) !== false) {
			header("location: ../register.php?error=passwordinvalid");
			exit();
		}
		if(passwrdUnmatch($passwrd, $passwrdrepeat) !== false) {
			header("location: ../register.php?error=passwordsdontmatch");
			exit();
		}
		if(emailExists($conn, $email) !== false) {
			header("location: ../register.php?error=emailtaken");
			exit();
		}

		createCustomer($conn, $firstname, $lastname, $address, $phone, $email, $passwrd);	
	}
	else {
		header("location: ../register.php");
		exit();
	}