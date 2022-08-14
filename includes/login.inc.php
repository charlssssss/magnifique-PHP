<?php

	if(isset($_POST["login"])) {
		$email = $_POST["email"];
		$passwrd = $_POST["passwrd"];
		$link = "index.php";

		require_once 'dbh.inc.php';
		require_once 'functions.inc.php';

		if (emptyInputLogin($email, $passwrd) !== false) {
			header("location: ../login.php?error=emptyinput");
			exit();
		}

		if (isset($_POST["link"])) {
			$link = $_POST["link"];
		}	

		loginUser($conn, $email, $passwrd, $link);
	}
	else{
		header("location: ../login.php");
		exit();
	}