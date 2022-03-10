<?php
	if (isset($_GET['delete_id'])) {
		// $table = "user_master";
		// $change_id = $_GET['change_id'];

		// echo "hi";
		include ('connection.php');

		$delete_id = $_GET['delete_id'];
		$updated_time = date('Y-m-d H:i:s');

		//to delete whole employee from the table

		$sql = "DELETE FROM `part_master_five` WHERE `part_id` = '$delete_id'";

		if(mysqli_query($conn , $sql)) {
		 	$alert = "Record successfully deleted";
  		     echo "<script language='javascript' type='text/javascript'>window.location = 'part-master5.php?msg=".$alert."'</script>";
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