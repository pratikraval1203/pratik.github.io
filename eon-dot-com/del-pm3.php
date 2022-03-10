<?php
	if (isset($_GET['delete_id'])) {
		if ($_GET['table'] == "main") {
			$table = "part_master_three";
		} elseif ($_GET['table'] == "temp") {
			$table = "part_master_three_ex";
		}
		else {
			echo "table not found";
		}

		// echo "hi";
		include ('connection.php');

		$delete_id = $_GET['delete_id'];

		$sql = "DELETE FROM `$table` WHERE `pm3_id` = '$delete_id'";

		if(mysqli_query($conn , $sql)) {

			if ($table == "part_master_three") {
				$alert = "Record successfully deleted";
            echo "<script language='javascript' type='text/javascript'>window.location = 'part-master3.php?msg=".$alert."'</script>";			
			}
			else {
				$alert = "Records successfully deleted";
            echo "<script language='javascript' type='text/javascript'>window.location = 'pm3-reg.php?msg=".$alert."'</script>";	
			}
		} 
		echo mysqli_error($conn);
		mysqli_close($conn);
	}
	else {
		echo '<script language="javascript" type="text/javascript">window.location = "index.php"</script>';
	}
?>