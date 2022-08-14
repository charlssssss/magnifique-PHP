<?php

	function emptyInputRegister($firstname, $lastname, $address, $phone, $email, $passwrd, $passwrdrepeat) {
		$result;
		if(empty($firstname) || empty($lastname) || empty($address) || empty($phone) || empty($email) || empty($passwrd) || empty($passwrdrepeat)) {
			$result = true;
		}
		else {
			$result = false;
		}
		return $result;
	}

	function phoneInvalid($phone){
		$result;
		if(preg_match('/^[0-9]{11}+$/', $phone) && (substr($phone, 0, 2) == '09')) {
		    $result = false;
		}
		else{
		    $result = true;
		}

		return $result;
	}

	function passwrdInvalid($passwrd) {
		$result;
		$uppercase = preg_match('@[A-Z]@', $passwrd);
		$lowercase = preg_match('@[a-z]@', $passwrd);
		$number    = preg_match('@[0-9]@', $passwrd);
		$specialChars = preg_match('@[^\w]@', $passwrd);

		if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($passwrd) < 8) {
			$result = true;
		}
		else{
			$result = false;
		}

		return $result;
	}

	function passwrdUnmatch($passwrd, $passwrdrepeat) {
		$result;
		if($passwrd !== $passwrdrepeat) {
			$result = true;
		}
		else {
			$result = false;
		}
		return $result;
	}

	function emailExists($conn, $email) {
		$sql = "SELECT * FROM customer WHERE email = ?;";
		$stmt = mysqli_stmt_init($conn);

		if(!mysqli_stmt_prepare($stmt, $sql)) {
			header("location: ../register.php?error=stmtfailed");
			exit();
		}

		mysqli_stmt_bind_param($stmt, "s", $email);
		mysqli_stmt_execute($stmt);

		$resultData = mysqli_stmt_get_result($stmt);

		if($row = mysqli_fetch_assoc($resultData)) {
			return $row;
		}
		else {
			$result = false;
			return $result;
		}
		mysqli_stmt_close($stmt);
	}

	function createCustomer($conn, $firstname, $lastname, $address, $phone, $email, $passwrd) {
		$sql = "INSERT INTO customer(firstname, lastname, address, phone, email, passwrd) VALUES(?,?,?,?,?,?);";
		$stmt = mysqli_stmt_init($conn);

		if(!mysqli_stmt_prepare($stmt, $sql)) {
			header("location: ../register.php?error=stmtfailed");
			exit();
		}

		//Hashing password
		$hashedPwd = password_hash($passwrd, PASSWORD_DEFAULT);

		mysqli_stmt_bind_param($stmt, "ssssss", $firstname, $lastname, $address, $phone, $email, $hashedPwd);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
		header("location: ../register.php?error=none");
		exit();
	}

	function emptyInputLogin($email, $passwrd) {
		$result;
		if(empty($email) || empty($passwrd)) {
			session_start();
			$_SESSION["retrylogin"] = $email;
			$result = true;
		}
		else {
			$result = false;
		}
		return $result;
	}

	function loginUser($conn, $email, $passwrd, $prev_link) {
		$emailExists  = emailExists($conn, $email);

		if($emailExists === false) {
			session_start();
			$_SESSION["retrylogin"] = $email;

			header("location: ../login.php?error=wronglogin");
			exit();
		}

		$passwrdHased = $emailExists["passwrd"];
		$checkPasswrd = password_verify($passwrd, $passwrdHased);

		if($checkPasswrd === false) {
			session_start();
			$_SESSION["retrylogin"] = $email;

			header("location: ../login.php?error=wronglogin");
			exit();
		}
		else if($checkPasswrd === true) {
			session_start();
			$_SESSION["customer_id"] = $emailExists["customer_id"];
			$_SESSION["firstname"] = $emailExists["firstname"];
			$_SESSION["lastname"] = $emailExists["lastname"];
			$_SESSION["email"] = $emailExists["email"];
			$_SESSION["phone"] = $emailExists["phone"];

			header("location: ../".$prev_link);
			exit();
		}
	}

	function getProduct($conn, $product_id) {
		$sql = "SELECT * FROM product WHERE product_id = ?;";
		$stmt = mysqli_stmt_init($conn);

		if(!mysqli_stmt_prepare($stmt, $sql)) {
			header("location: ../index.php?error=stmtfailed");
			exit();
		}

		mysqli_stmt_bind_param($stmt, "s", $product_id);
		mysqli_stmt_execute($stmt);

		$resultData = mysqli_stmt_get_result($stmt);

		if($row = mysqli_fetch_assoc($resultData)) {
			return $row;
		}
		
		mysqli_stmt_close($stmt);
	}

	function getProductByType($conn, $prod_type) {
		$sql = "SELECT * FROM product WHERE product_type = ?;";
		$stmt = mysqli_stmt_init($conn);

		if(!mysqli_stmt_prepare($stmt, $sql)) {
			header("location: ../index.php?error=stmtfailed");
			exit();
		}

		mysqli_stmt_bind_param($stmt, "s", $prod_type);
		mysqli_stmt_execute($stmt);

		$resultData = mysqli_stmt_get_result($stmt);

		return $resultData;
		
		mysqli_stmt_close($stmt);
	}

	function getReview($conn, $prod_id) {
		// $sql = "SELECT * FROM review WHERE product_id = ?;";
		$sql = "SELECT rev.customer_id, concat(firstname,' ',lastname) AS customer_name, rating, review, date FROM customer AS cust, review AS rev WHERE cust.customer_id = rev.customer_id AND rev.product_id = ? ORDER BY date, customer_name;";

		$stmt = mysqli_stmt_init($conn);

		if(!mysqli_stmt_prepare($stmt, $sql)) {
			header("location: ../index.php?error=stmtfailed");
			exit();
		}

		mysqli_stmt_bind_param($stmt, "s", $prod_id);
		mysqli_stmt_execute($stmt);

		$resultData = mysqli_stmt_get_result($stmt);

		return $resultData;
		
		mysqli_stmt_close($stmt);
	}

	function getRating($conn, $prod_id) {
		$sql = "SELECT count(review_id) AS review_count, avg(rating) AS rating_sum FROM review WHERE product_id = ?;";

		$stmt = mysqli_stmt_init($conn);

		if(!mysqli_stmt_prepare($stmt, $sql)) {
			header("location: ../index.php?error=stmtfailed");
			exit();
		}

		mysqli_stmt_bind_param($stmt, "s", $prod_id);
		mysqli_stmt_execute($stmt);

		$resultData = mysqli_stmt_get_result($stmt);

		return $resultData;
		
		mysqli_stmt_close($stmt);
	}

	function createReview($conn, $prod_link, $customer_id, $product_id, $review, $rating, $date) {
		$sql = "INSERT INTO review(customer_id, product_id, review, rating, date) VALUES(?,?,?,?,?);";
		$stmt = mysqli_stmt_init($conn);

		if(!mysqli_stmt_prepare($stmt, $sql)) {
			header("location: ../index.php?error=stmtfailed");
			exit();
		}

		mysqli_stmt_bind_param($stmt, "issss", $customer_id, $product_id, $review, $rating, $date);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);

		header("location: ../" . $prod_link . "?product_id=" . $product_id . "&error=none");
		exit();
	}

	function customerReviewAlready($conn, $customer_id, $product_id) {
		$sql = "SELECT * FROM review WHERE customer_id = ? AND product_id = ?;";
		$stmt = mysqli_stmt_init($conn);

		if(!mysqli_stmt_prepare($stmt, $sql)) {
			header("location: ../index.php?error=stmtfailed");
			exit();
		}

		mysqli_stmt_bind_param($stmt, "is", $customer_id, $product_id);
		mysqli_stmt_execute($stmt);

		$resultData = mysqli_stmt_get_result($stmt);

		if($row = mysqli_fetch_assoc($resultData)) {
			return $row;
		}
		else {
			$result = false;
			return $result;
		}
		mysqli_stmt_close($stmt);
	}

	function updateReview($conn, $prod_link, $customer_id, $product_id, $review, $rating, $date) {
		$sql = "UPDATE review SET review = ?, rating = ?, date = ? WHERE customer_id = ? AND product_id = ?;";

		$stmt = mysqli_stmt_init($conn);

		if(!mysqli_stmt_prepare($stmt, $sql)) {
			header("location: ../index.php?error=stmtfailed");
			exit();
		}

		mysqli_stmt_bind_param($stmt, "sssis", $review, $rating, $date, $customer_id, $product_id);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);

		header("location: ../" . $prod_link . "?product_id=" . $product_id . "&error=none");
		exit();
	}

	function deleteReview($conn, $prod_link, $customer_id, $product_id) {
		$sql = "DELETE from review WHERE customer_id = ? AND product_id = ?;";

		$stmt = mysqli_stmt_init($conn);

		if(!mysqli_stmt_prepare($stmt, $sql)) {
			header("location: ../index.php?error=stmtfailed");
			exit();
		}

		mysqli_stmt_bind_param($stmt, "is", $customer_id, $product_id);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);

		header("location: ../" . $prod_link . "?product_id=" . $product_id . "&review=deleted");
		exit();
	}

	//Add to Cart functions//
	function getAllItem($conn, $customer_id) {
		$sql = "SELECT cart_id, c.product_id as prod_id, product_name, concat(product_img_path, product_image_1) as prod_img_path, product_price, quantity, select_prod FROM cart as c, product as p WHERE customer_id = ? and c.product_id = p.product_id ORDER BY select_prod desc;";
		$stmt = mysqli_stmt_init($conn);

		if(!mysqli_stmt_prepare($stmt, $sql)) {
			header("location: ../index.php?error=stmtfailed");
			exit();
		}

		mysqli_stmt_bind_param($stmt, "i", $customer_id);
		mysqli_stmt_execute($stmt);

		$resultData = mysqli_stmt_get_result($stmt);

		return $resultData;
		
		mysqli_stmt_close($stmt);
	}

	function getItemCount($conn, $customer_id) {
		$sql = "SELECT sum(quantity) as item_count FROM cart WHERE customer_id = ?;";
		$stmt = mysqli_stmt_init($conn);

		if(!mysqli_stmt_prepare($stmt, $sql)) {
			header("location: ../index.php?error=stmtfailed");
			exit();
		}

		mysqli_stmt_bind_param($stmt, "i", $customer_id);
		mysqli_stmt_execute($stmt);

		$resultData = mysqli_stmt_get_result($stmt);

		return $resultData;
		
		mysqli_stmt_close($stmt);
	}

	function addItemToCart($conn, $prod_link, $prod_img_path, $customer_id, $product_id, $quantity) {
		$sql = "INSERT INTO cart(customer_id, product_id, quantity, select_prod, product_img_path) VALUES(?,?,?, 'removed',?);";
		$stmt = mysqli_stmt_init($conn);

		if(!mysqli_stmt_prepare($stmt, $sql)) {
			header("location: ../index.php?error=stmtfailed");
			exit();
		}

		mysqli_stmt_bind_param($stmt, "isis", $customer_id, $product_id, $quantity, $prod_img_path);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);

		header("location: ../" . $prod_link . "?product_id=" . $product_id . "&addtocart=success");
		exit();
	}

	function updateQtyItem($conn, $prod_link, $customer_id, $product_id, $quantity) {
		$sql = "UPDATE cart SET quantity = quantity + ? WHERE customer_id = ? AND product_id = ?;";
		if($prod_link == "") {
			$sql = "UPDATE cart SET quantity = ? WHERE customer_id = ? AND product_id = ?;";
		}

		$stmt = mysqli_stmt_init($conn);

		if(!mysqli_stmt_prepare($stmt, $sql)) {
			header("location: ../index.php?error=stmtfailed");
			exit();
		}

		mysqli_stmt_bind_param($stmt, "iis", $quantity, $customer_id, $product_id);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
		if($prod_link != "") {
			header("location: ../" . $prod_link . "?product_id=" . $product_id . "&addtocart=success");
		}
		else {
			header("location: ../mycart.php?item=updated");
		}
		exit();
	}

	function itemInCartExists($conn, $customer_id, $product_id) {
		$sql = "SELECT * FROM cart WHERE customer_id = ? AND product_id = ?;";
		$stmt = mysqli_stmt_init($conn);

		if(!mysqli_stmt_prepare($stmt, $sql)) {
			header("location: ../index.php?error=stmtfailed");
			exit();
		}

		mysqli_stmt_bind_param($stmt, "is", $customer_id, $product_id);
		mysqli_stmt_execute($stmt);

		$resultData = mysqli_stmt_get_result($stmt);

		if($row = mysqli_fetch_assoc($resultData)) {
			return $row;
		}
		else {
			$result = false;
			return $result;
		}
		mysqli_stmt_close($stmt);
	}

	function removeItem($conn, $cart_id) {
		$sql = "DELETE FROM cart WHERE cart_id = ?;";

		$stmt = mysqli_stmt_init($conn);

		if(!mysqli_stmt_prepare($stmt, $sql)) {
			header("location: ../mycart.php?error=stmtfailed");
			exit();
		}

		mysqli_stmt_bind_param($stmt, "i", $cart_id);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);

		header("location: ../mycart.php?item=removed");
		exit();
	}

	function updateSelectItem($conn, $cart_id, $sel_prod) {
		$sql = "UPDATE cart SET select_prod =  ? WHERE cart_id = ?;";

		$stmt = mysqli_stmt_init($conn);

		if(!mysqli_stmt_prepare($stmt, $sql)) {
			header("location: ../index.php?error=stmtfailed");
			exit();
		}
		// $selected_array = array();
		// if($sel_prod == "selected") {} 
		// if(empty($selected_array)) {
		// 	array_push($selected_array, $cart_id);
		// }
		// else {
		// 	for ($i=0; $i < count($selected_array); $i++) {
		// 		$res = false;
		// 		if ($selected_array[$i] ==  $cart_id) {
		// 			$res = true;
		// 		}
				
		// 	}
		// }
		
		mysqli_stmt_bind_param($stmt, "si", $sel_prod, $cart_id);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);

		if($sel_prod == "selected") {
			header("location: ../mycart.php?item=selected");
		}
		else {
			header("location: ../mycart.php?item=unselected");
		}
		exit();
	}


	function createOrder($conn, $customer_id, $firstname, $lastname, $phone, $street, $province, $city, $barangay, $payment_method, $item_qty, $total, $order_date) {

		$order_id = rand(10000000,99999999);

		$sql = "INSERT INTO myorder(order_id, customer_id, firstname, lastname, phone, address1, address2, address3, address4,  payment_method, item_qty, total, date) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?);";
		$stmt = mysqli_stmt_init($conn);

		if(!mysqli_stmt_prepare($stmt, $sql)) {
			header("location: ../mycart.php?error=stmtfailed");
			exit();
		}

		mysqli_stmt_bind_param($stmt, "iissssssssids", $order_id, $customer_id, $firstname, $lastname, $phone, $street, $province, $city, $barangay, $payment_method, $item_qty, $total, $order_date);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);

		return $order_id;
	}

	function createOrderDetail($conn, $order_id, $product_id, $product_price, $quantity, $product_img_path) {
		$sql = "INSERT INTO myorderdetail(order_id, product_id, product_price, quantity, product_img_path) VALUES(?,?,?,?,?);";
		$stmt = mysqli_stmt_init($conn);

		if(!mysqli_stmt_prepare($stmt, $sql)) {
			header("location: ../mycart.php?error=stmtfailed");
			exit();
		}

		mysqli_stmt_bind_param($stmt, "isdis", $order_id, $product_id, $product_price, $quantity, $product_img_path);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	}

	function removeCartAfterOrder($conn, $cart_id) {
		$sql = "DELETE FROM cart WHERE cart_id = ?;";

		$stmt = mysqli_stmt_init($conn);

		if(!mysqli_stmt_prepare($stmt, $sql)) {
			header("location: ../mycart.php?error=stmtfailed");
			exit();
		}

		mysqli_stmt_bind_param($stmt, "i", $cart_id);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	}


	function getOrderDetail($conn, $order_id) {
		$sql = "SELECT order_detail_id, order_id, o.product_price, p.product_name, quantity, product_img_path FROM myorderdetail as o, product as p WHERE order_id = ? AND o.product_id = p.product_id;";
		$stmt = mysqli_stmt_init($conn);

		if(!mysqli_stmt_prepare($stmt, $sql)) {
			header("location: ../purchased.php?error=stmtfailed");
			exit();
		}

		mysqli_stmt_bind_param($stmt, "i", $order_id);
		mysqli_stmt_execute($stmt);

		$resultData = mysqli_stmt_get_result($stmt);

		return $resultData;
		
		mysqli_stmt_close($stmt);
	}

	function getOrder($conn, $order_id) {
		$sql = "SELECT * FROM myorder WHERE order_id = ?;";
		$stmt = mysqli_stmt_init($conn);

		if(!mysqli_stmt_prepare($stmt, $sql)) {
			header("location: ../purchased.php?error=stmtfailed");
			exit();
		}

		mysqli_stmt_bind_param($stmt, "i", $order_id);
		mysqli_stmt_execute($stmt);

		$resultData = mysqli_stmt_get_result($stmt);

		return $resultData;
		
		mysqli_stmt_close($stmt);
	}

	function getAllOrderDetail($conn, $customer_id) {
		$sql = "SELECT order_detail_id, o.order_id, o.product_price, p.product_name, quantity, product_img_path, c.date FROM myorderdetail as o, product as p, myorder as c WHERE c.customer_id = ? AND o.order_id = c.order_id AND o.product_id = p.product_id order by order_detail_id, o.order_id;";
		$stmt = mysqli_stmt_init($conn);

		if(!mysqli_stmt_prepare($stmt, $sql)) {
			header("location: ../purchased.php?error=stmtfailed");
			exit();
		}

		mysqli_stmt_bind_param($stmt, "i", $customer_id);
		mysqli_stmt_execute($stmt);

		$resultData = mysqli_stmt_get_result($stmt);

		return $resultData;
		
		mysqli_stmt_close($stmt);
	}

	function getOrderOrder($conn, $order_detail_id) {
		$sql = "SELECT o.order_id, customer_id, firstname, lastname, phone, address1, address2, address3, address4 , payment_method, item_qty, total, date FROM myorder as o, myorderdetail as od WHERE o.order_id = od.order_id AND order_detail_id = ?; ";
		$stmt = mysqli_stmt_init($conn);

		if(!mysqli_stmt_prepare($stmt, $sql)) {
			header("location: ../purchased.php?error=stmtfailed");
			exit();
		}

		mysqli_stmt_bind_param($stmt, "i", $order_detail_id);
		mysqli_stmt_execute($stmt);

		$resultData = mysqli_stmt_get_result($stmt);

		return $resultData;
		
		mysqli_stmt_close($stmt);
	}

	function cancelOrder($conn, $ordr_dtl_id) {
		$sql = "DELETE FROM myorderdetail WHERE order_detail_id = ?;";

		$stmt = mysqli_stmt_init($conn);

		if(!mysqli_stmt_prepare($stmt, $sql)) {
			header("location: ../mycart.php?error=stmtfailed");
			exit();
		}

		mysqli_stmt_bind_param($stmt, "i", $ordr_dtl_id);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);

		header("location: ../myaccount.php?order=canceled#my-orders");
		exit();
	}

	function editProfile($conn, $customer_id, $firstname, $lastname, $address, $phone) {
		$sql = "UPDATE customer SET firstname =  ?, lastname =  ?, address =  ?, phone =  ? WHERE customer_id = ?;";

		$stmt = mysqli_stmt_init($conn);

		if(!mysqli_stmt_prepare($stmt, $sql)) {
			header("location: ../myaccount.php?error=stmtfailed#my-account");
			exit();
		}

		mysqli_stmt_bind_param($stmt, "ssssi", $firstname, $lastname, $address, $phone, $customer_id);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);

		header("location: ../myaccount.php?account=profedited#my-account");
		exit();
	}

	function getCustomerInfo($conn, $customer_id) {
		$sql = "SELECT * FROM customer WHERE customer_id = ?;";
		$stmt = mysqli_stmt_init($conn);

		if(!mysqli_stmt_prepare($stmt, $sql)) {
			header("location: ../myaccount.php?error=stmtfailed#my-account");
			exit();
		}

		mysqli_stmt_bind_param($stmt, "i", $customer_id);
		mysqli_stmt_execute($stmt);

		// $resultData = mysqli_stmt_get_result($stmt);

		// return $resultData;
		
		// mysqli_stmt_close($stmt);
		$resultData = mysqli_stmt_get_result($stmt);

		if($row = mysqli_fetch_assoc($resultData)) {
			return $row;
		}
		else {
			$result = false;
			return $result;
		}
		mysqli_stmt_close($stmt);
	}

	function changePassword($conn, $customer_id, $curpass, $newpass) {
		$getCustomerInfo  = getCustomerInfo($conn, $customer_id);

		if($getCustomerInfo === false) {
			header("location: ../myaccount.php?error=wrongaccount#my-account");
			exit();
		}

		$passwrdHased = $getCustomerInfo["passwrd"];
		$checkPasswrd = password_verify($curpass, $passwrdHased);

		if($checkPasswrd === false) {
			header("location: ../myaccount.php?error=wrongpassword#my-account");
			exit();
		}
		else if($checkPasswrd === true) {
			$sql = "UPDATE customer SET passwrd =  ? WHERE customer_id = ?;";
			$stmt = mysqli_stmt_init($conn);

			if(!mysqli_stmt_prepare($stmt, $sql)) {
				header("location: ../myaccount.php?error=stmtfailedt#my-account");
				exit();
			}

			//Hashing password
			$hashedPwd = password_hash($newpass, PASSWORD_DEFAULT);

			mysqli_stmt_bind_param($stmt, "si", $hashedPwd, $customer_id);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);

			header("location: ../myaccount.php?account=passchanged#my-account");
			exit();
		}
	}

	














						// $sql =  "SELECT * FROM product WHERE product_type = 'Backpacks';";
					// $result = mysqli_query($conn, $sql);

					// while ($row = mysqli_fetch_array($result)) {
					// 	echo $row["product_name"];
					// }