<?php
	session_start();

	include 'connection.php';  

	$bill_id = $_POST['bill_id'];
	$cust_id = $_POST['cust_id'];
	$grand_total = $_POST['grand_total'];
	$bill_date = date('Y-m-d');
	$bill_time = date('H:i:s');
	$is_paid = $_POST['is_paid'];
	$updated_time = date('Y-m-d H:i:s');
	$updated_by = $_SESSSION['user_id'];

	$sql = "INSERT INTO `customer_acc_master`( `cust_id`, `cust_bill_no`, `cust_bill_date`, `cust_bill_time`, `cust_bill_amount`, `is_paid`, `updated_time`, `updated_by`) VALUES ('$cust_id','$bill_id','$bill_date','$bill_time','$grand_total','$is_paid','$updated_time','$updated_by')";

	if (mysqli_query($conn, $sql)) {
		$response = array(
						"statusCode" => 200,
						"msg" => "Bill Added Successfully to the Customer Account",
					);
		echo json_encode($response);
	} 
	else {

		$error_msg = mysqli_error($conn);

		$response = array(
						"statusCode" => 201,
						"msg" => $error_msg,
					);
		echo json_encode($response);
	}

	include 'disconnect.php';
?>
 