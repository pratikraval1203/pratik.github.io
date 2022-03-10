<?php
	if (isset($_POST['item_id'])) {
		$item_id = $_POST['item_id'];

		include ('connection.php');
	
		$select_sql = "SELECT * FROM `item_master` WHERE `item_id` = '$item_id'";

		$result = mysqli_query($conn, $select_sql);
		$count = 0;

		if (mysqli_num_rows($result) == 1) {

			$data = mysqli_fetch_assoc($result);

			$double = array(
							'msg' => 'data of item',
							'statusCode' => 200,
							'data' => $data,
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