<?php

	if (isset($_POST['entry_id'])) {
		
		include ('connection.php');

		$delete_id = $_POST['entry_id'];

		$sql = "DELETE FROM `bill_items` WHERE `entry_id` = '$delete_id'";

		if(mysqli_query($conn , $sql)) {
		 	$alert = "Item successfully deleted";
		} 

		echo mysqli_error($conn);

		include('disconnect.php');
	}
	else {
		echo '<script language="javascript" type="text/javascript">window.location = "index.php"</script>';
	}
?>