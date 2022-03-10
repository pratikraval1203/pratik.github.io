<?php
	if (isset($_GET['delete_id'])) {
		if ($_GET['table'] == "main") {
			$table = "part_master_six";
		} elseif ($_GET['table'] == "temp") {
			$table = "part_master_six_ex";
		}
		else {
			echo "table not found";
		}

		// echo "hi";
		include ('connection.php');

		$delete_id = $_GET['delete_id'];

		$sql = "DELETE FROM `$table` WHERE `amb_id` = '$delete_id'";

		if(mysqli_query($conn , $sql)) {

			if ($table == "part_master_six") {
				$alert = "Record successfully deleted";
            echo "<script language='javascript' type='text/javascript'>window.location = 'part-master6.php?msg=".$alert."'</script>";			
			}
			else {
				$alert = "Record successfully deleted";
            echo "<script language='javascript' type='text/javascript'>window.location = 'pm6-reg.php?msg=".$alert."'</script>";	
			}
		} 
		echo mysqli_error($conn);
		mysqli_close($conn);
	}
	else {
		echo '<script language="javascript" type="text/javascript">window.location = "index.php"</script>';
	}
?>