<?php
	include 'connection.php';

	$mydate = "";

	$sql = "SELECT `part_id`,`part_updated_time` FROM `part_master_one` ORDER BY `part_id` DESC LIMIT 1";

	$result = mysqli_query($conn, $sql);

	// $count = mysqli_insert_id($conn);

	while ($row = mysqli_fetch_array($result)) {
		$count = $row['part_id'];

		$temp = $row['part_updated_time'] ;
		echo $temp;
		$mydate = date('Y', $temp);
	}

	echo $mydate."/".$count;
?>

