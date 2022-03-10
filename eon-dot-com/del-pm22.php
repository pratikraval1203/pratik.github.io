<?php
	if (isset($_GET['delete_id'])) {

		include ('connection.php');

		$delete_id = $_GET['delete_id'];
		$updated_time = date('Y-m-d H:i:s');


		$sql = "DELETE FROM `part_master_twenty_two` WHERE `pm22_id` = '$delete_id'";

		if(mysqli_query($conn , $sql)) {
		 	$alert = "Record successfully deleted";
  		     echo "<script language='javascript' type='text/javascript'>window.location = 'part-master22.php?msg=".$alert."'</script>";
		} 

		echo mysqli_error($conn);
		mysqli_close($conn);
	}
	else {
		echo '<script language="javascript" type="text/javascript">window.location = "index.php"</script>';
	}
?>