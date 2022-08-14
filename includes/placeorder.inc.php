<?php
	session_start();
	
	if(isset($_POST["place_order"])){
		$customer_id = $_SESSION["customer_id"];
		$firstname = $_POST["firstname"];
		$lastname = $_POST["lastname"];
		$phone = $_POST["phone"];
		$street = $_POST["street"];
		$province = $_POST["province"];
		$city = $_POST["city"];		
		$barangay = $_POST["barangay"];		
		$payment_method = $_POST["payment_method"];
		$item_qty = $_POST["item_qty"];
		$total = $_POST["total"];
		$order_date = $_POST["order_date"];

		//item to be order array
		$order_items = unserialize($_POST['order_items']);

		require_once 'dbh.inc.php';
		require_once 'functions.inc.php';

		$order_id = createOrder($conn, $customer_id, $firstname, $lastname, $phone, $street, $province, $city, $barangay, $payment_method, $item_qty, $total, $order_date);

		

		for ($i=0; $i < count($order_items) ; $i++) {
			// echo "<pre>";
			// var_dump($order_items[$i]);
			// echo "</pre>";
			$product_id = $order_items[$i]['prod_id'];
			$product_price = $order_items[$i]['prod_price']; 
			$quantity = $order_items[$i]['qty'];
			$product_img_path = $order_items[$i]["img_path"];	

			createOrderDetail($conn, $order_id, $product_id, $product_price, $quantity, $product_img_path);

			$cart_id =  $order_items[$i]['cart_id'];

			if ($cart_id != "none") {
				removeCartAfterOrder($conn, $cart_id);
			}
			
		}

		header("location: ../purchased.php?error=none&order_id=".$order_id);
		exit();

		// echo "customer_id: " . $customer_id . "<br>";
		// echo "firstname: " . $firstname . "<br>";
		// echo "lastname: " . $lastname . "<br>";
		// echo "phone: " . $phone . "<br>";
		// echo "street: " . $street . "<br>";
		// echo "city: " . $city . "<br>";
		// echo "province: " . $province . "<br>";
		// echo "payment_method: " . $payment_method . "<br>";
		// echo "item_qty: " . $item_qty . "<br>";
		// echo "order_date: " . $order_date . "<br>";
	}
	else{
		header("location: ../mycart.php");
		exit();
	}