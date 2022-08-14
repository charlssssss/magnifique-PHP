<?php
	session_start();
	
	if(isset($_POST["cancel_order"])){
		$ordr_dtl_id = $_POST["ordr_dtl_id"];
		
		require_once 'dbh.inc.php';
		require_once 'functions.inc.php';

		cancelOrder($conn, $ordr_dtl_id);

	}
	else{
		header("location: ../myaccount.php#my-orders");
		exit();
	}