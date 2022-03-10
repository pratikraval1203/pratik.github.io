<?php
	if (isset($_GET['delete_id'])) {
		if ($_GET['table'] == "main") {
			$table = "vendor_master_three";
		} elseif ($_GET['table'] == "temp") {
			$table = "vendor_master_three_ex";
		}
		else {
			echo "table not found";
		}

		// echo "hi";
		include ('connection.php');

		$delete_id = $_GET['delete_id'];

		$sql = "DELETE FROM `$table` WHERE `vm3_id` = '$delete_id'";

		if(mysqli_query($conn , $sql)) {

			if ($table == "vendor_master_three") {
				$alert = "Records successfully deleted";
            	echo "<script language='javascript' type='text/javascript'>window.location = 'vendor-master3.php?msg=".$alert."'</script>";			
			}
			else {
				$alert = "Records successfully deleted";
            	echo "<script language='javascript' type='text/javascript'>window.location = 'vendor3-reg.php?msg=".$alert."'</script>";	
			}
		} 
		echo mysqli_error($conn);
		mysqli_close($conn);
	}
	else {
		echo '<script language="javascript" type="text/javascript">window.location = "index.php"</script>';
	}
?>