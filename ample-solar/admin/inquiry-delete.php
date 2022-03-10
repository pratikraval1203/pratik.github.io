<?php
	if (isset($_GET['delete_id'])) {
		connection
		include ('.php');

		$delete_id = $_GET['delete_id'];

		$sql = "DELETE FROM `tbl_inquiry` WHERE `inquiry_id` = '$delete_id'";

		if(mysqli_query($conn , $sql)) {
		 	$alert = "Inquiry successfully deleted";
  		    echo "<script language='javascript' type='text/javascript'>window.location ='inquiry-responses.php?msg=".$alert."'</script>";
		}

		include('disconnect.php');
	}
	else {
		echo '<script language="javascript" type="text/javascript">window.location = "index.php"</script>';
	}
?>
