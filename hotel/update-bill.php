<?php
	session_start();

	include 'connection.php';  

	$bill_id = $_POST['bill_id'];
	$table_no = $_POST['table_no'];
	$total_person = $_POST['total_person'];
	$cust_id = $_POST['cust_id'];
	$sub_total = $_POST['sub_total'];
	$discount = $_POST['discount'];
	$sgst_amount = $_POST['sgst_amount'];
	$cgst_amount = $_POST['cgst_amount'];
	$grand_total = $_POST['grand_total'];
	$payment_type = $_POST['payment_type'];
	$bill_status = $_POST['bill_status'];
	$bill_date = date('Y-m-d');
	$updated_time = date('Y-m-d H:i:s');
	// $updated_by = $_SESSSION['user_id'];
	$updated_by = 1;

	$sql = "UPDATE `tbl_bills` SET `table_no`='$table_no',`total_person`='$total_person',`cust_id`='$cust_id',`sub_total`='$sub_total',`discount`='$discount',`cgst_amount`='$cgst_amount',`sgst_amount`='$sgst_amount',`payment_type`='$payment_type',`grand_total`='$grand_total',`bill_status`='$bill_status',`updated_time`='$updated_by',`updated_by`='$updated_by' WHERE `bill_id` = '$bill_id'";

	if (mysqli_query($conn, $sql)) {
		$response = array(
						"statusCode" => 200,
						"msg" => "Bill Saved Successfully",
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
 