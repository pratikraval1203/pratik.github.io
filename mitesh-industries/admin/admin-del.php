<?php
	if (isset($_GET['delete_id'])) {
		
		include ('connection.php');

		$delete_id = $_GET['delete_id'];
		$updated_time = date('Y-m-d H:i:s');

		//to delete whole employee from the table

		$sql = "DELETE FROM `tbl_admin` WHERE `admin_id` = '$delete_id'";

		if(mysqli_query($conn , $sql)) {
		 	$alert = "Admin successfully deleted";
  		     echo "<script language='javascript' type='text/javascript'>window.location = 'admin-master.php?msg=".$alert."'</script>";
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
<?php
 include('disconnect.php');
?>