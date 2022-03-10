<?php
	session_start();

	include 'connection.php';

	$item_id=$_POST['item_id'];
	$item_rate=$_POST['item_rate'];
	$item_qty=$_POST['item_qty'];
	$bill_id=$_POST['bill_id'];
	$updated_time = date('Y-m-d H:i:s');
	$updated_by = $_SESSION['user_id'];

	$sql = "INSERT INTO `bill_items`( `bill_id`, `item_id`, `item_qty`, `item_rate`, `updated_time`, `updated_by`) VALUES ('$bill_id','$item_id','$item_qty','$item_rate','$updated_time','$updated_by')";

	if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}

	include 'disconnect.php';
?>
 