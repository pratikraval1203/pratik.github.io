<?php
	if (isset($_POST['table_no'])) {
		$table_no = $_POST['table_no'];

		include ('connection.php');
	
		$select_sql = "SELECT * FROM `new_table_master` WHERE `table_id` = '$table_no'";

		$result = mysqli_query($conn, $select_sql);
		$count = 0;

		if (mysqli_num_rows($result) == 1) {

			$data = mysqli_fetch_assoc($result);

			$double = array(
							'msg' => 'data of item',
							'statusCode' => 200,
							'data' => $data
							);

			echo json_encode($double);

			// echo json_encode(array("statusCode"=>200));
		} else {
			echo json_encode(array("statusCode"=>201));
		}

		include ('disconnect.php');
	}
	else {
		echo json_encode(array("statusCode"=>201));
	}
?>