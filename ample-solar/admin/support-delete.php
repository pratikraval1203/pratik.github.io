<?php
	if (isset($_GET['delete_id'])) {
		
		include ('connection.php');

		$delete_id = $_GET['delete_id'];

		$sql = "DELETE FROM `tbl_support` WHERE `support_id` = '$delete_id'";

		if(mysqli_query($conn , $sql)) {
		 	$alert = "Message successfully deleted";
  		    echo "<script language='javascript' type='text/javascript'>window.location ='support-responses.php?msg=".$alert."'</script>";
		}

		include('disconnect.php');
	}
	else {
		echo '<script language="javascript" type="text/javascript">window.location = "index.php"</script>';
	}
?>
