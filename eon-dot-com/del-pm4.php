<?php
	if (isset($_GET['delete_id'])) {
		if ($_GET['table'] == "main") {
			$table = "part_master_eight";
		} elseif ($_GET['table'] == "temp") {
			$table = "part_master_eight_ex";
		}
		else {
			echo "table not found";
		}

		// echo "hi";
		include ('connection.php');

		$delete_id = $_GET['delete_id'];

		$sql = "DELETE FROM `$table` WHERE `pm8_id` = '$delete_id'";

		if(mysqli_query($conn , $sql)) {

			if ($table == "part_master_eight") {
				$alert = "Record successfully deleted";
            echo "<script language='javascript' type='text/javascript'>window.location = 'part-master4.php?msg=".$alert."'</script>";			
			}
			else {
				$alert = "Record successfully deleted";
            echo "<script language='javascript' type='text/javascript'>window.location = 'pm4-reg.php?msg=".$alert."'</script>";	
			}
		} 
		echo mysqli_error($conn);
		mysqli_close($conn);
	}
	else {
		echo '<script language="javascript" type="text/javascript">window.location = "index.php"</script>';
	}
?>