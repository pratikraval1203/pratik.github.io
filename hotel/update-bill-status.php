<?php
	if (isset($_GET['delete_id'])) {

		include 'connection.php';  

		$bill_id = $_GET['delete_id'];
		$bill_status = 3;
		$updated_time = date('Y-m-d H:i:s');
		$updated_by = 1;

		$sql = "UPDATE `tbl_bills` SET `bill_status`='$bill_status',`updated_time`='$updated_by',`updated_by`='$updated_by' WHERE `bill_id` = '$bill_id'";

		if (mysqli_query($conn, $sql)) {

			$sql_acc = "DELETE FROM `customer_acc_master` WHERE `cust_bill_no` = '$bill_id'";

			if(mysqli_query($conn , $sql_acc)) {

				$alert = "Bill deleted successfully";
				echo "<script language='javascript' type='text/javascript'>window.location = 'bill-master.php?msg=".$alert."'</script>";
			 	
			} else {
				$alert = mysqli_error($conn);
				echo "<script language='javascript' type='text/javascript'>window.location = 'bill-master.php?msg=".$alert."'</script>";

			}
		} 
		else {
			$alert = mysqli_error($conn);
			echo "<script language='javascript' type='text/javascript'>window.location = 'bill-master.php?msg=".$alert."'</script>";

		}
		include 'disconnect.php';
	} else {
		echo '<script language="javascript" type="text/javascript">window.location = "index.php"</script>';
	}
?>
 