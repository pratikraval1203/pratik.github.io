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

	$check_sql = "SELECT `transaction_id` FROM `customer_acc_master` WHERE `cust_bill_no` = '$bill_id'";

	$result = mysqli_query($conn, $check_sql);

	$total_rows = mysqli_num_rows($result);

	if ($total_rows == 0) {
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
	} else {
		$sql = "UPDATE `customer_acc_master` SET `cust_id` = '$cust_id',`cust_bill_amount`='$grand_total',`is_paid`='$is_paid',`updated_time`='$updated_time',`updated_by`='$updated_by' WHERE `cust_bill_no` = '$bill_id'";

		if (mysqli_query($conn, $sql)) {
			$response = array(
							"statusCode" => 200,
							"msg" => "Bill Updated & Added Successfully to the Customer Account",
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

	}

	include 'disconnect.php';


?>