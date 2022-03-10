<?php
	if (isset($_POST['delete_id'])) {
		
		include ('connection.php');

		$delete_id = $_POST['delete_id'];

		$sql = "DELETE FROM `tbl_bills` WHERE `bill_id` = '$delete_id'";

		if(mysqli_query($conn , $sql)) {

			$delete_items_sql = "DELETE FROM `bill_items` WHERE `bill_id` = '$delete_id'";

			if(mysqli_query($conn , $delete_items_sql)) {
				echo json_encode(array("statusCode"=>200));
			}
			else {
				echo json_encode(array("statusCode"=>201));	
			}
		} else {
			echo json_encode(array("statusCode"=>201));
		}

		include('disconnect.php');
	}
	else {
		echo '<script language="javascript" type="text/javascript">window.location = "index.php"</script>';
	}
?>