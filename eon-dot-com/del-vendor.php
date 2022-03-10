<?php
	if (isset($_GET['delete_id'])) {
		// $table = "vendor_master";
		// $change_id = $_GET['change_id'];

		// echo "hi";
		include ('connection.php');

		$delete_id = $_GET['delete_id'];
		$updated_time = date('Y-m-d H:i:s');

		//to delete whole employee from the table

		$sql = "DELETE FROM `vendor_master` WHERE `ven_id` = '$delete_id'";

		if(mysqli_query($conn , $sql)) {
		 	$alert = "User successfully deleted";
  		     echo "<script language='javascript' type='text/javascript'>window.location = 'vendor-master.php?msg=".$alert."'</script>";
		} 

		//to make emp active status to false

		// $sql2 = "UPDATE '$table' SET `is_active`= 0 ,`updated_time`='$updated_time' WHERE `emp_id` = '$delete_id'";

		// if(mysqli_query($conn , $sql2)) {
		//  	$alert = "Employee successfully deleted";
  // 		     echo "<script language='javascript' type='text/javascript'>window.location = 'emp-master.php?msg=".$alert."'</script>";
		// } 

		echo mysqli_error($conn);
		mysqli_close($conn);
	}
	else {
		echo '<script language="javascript" type="text/javascript">window.location = "index.php"</script>';
	}
?>