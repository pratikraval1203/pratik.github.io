<?php
	if (isset($_GET['delete_id'])) {
		if ($_GET['table'] == "main") {
			$table = "track_machine_master_two";
		} elseif ($_GET['table'] == "temp") {
			$table = "track_machine_master_two_ex";
		}
		else {
			echo "table not found";
		}

		// echo "hi";
		include ('connection.php');

		$delete_id = $_GET['delete_id'];

		$sql = "DELETE FROM `$table` WHERE `tm2_id` = '$delete_id'";

		if(mysqli_query($conn , $sql)) {

			if ($table == "track_machine_master_two") {
				$alert = "Records successfully deleted";
            echo "<script language='javascript' type='text/javascript'>window.location = 'track-machine-master2.php?msg=".$alert."'</script>";			
			}
			else {
				$alert = "Records successfully deleted";
            echo "<script language='javascript' type='text/javascript'>window.location = 'tm2-reg.php?msg=".$alert."'</script>";	
			}
		} 
		echo mysqli_error($conn);
		mysqli_close($conn);
	}
	else {
		echo '<script language="javascript" type="text/javascript">window.location = "index.php"</script>';
	}
?>