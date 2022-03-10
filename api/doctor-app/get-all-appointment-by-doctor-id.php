<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");

	if ($_SERVER['REQUEST_METHOD'] === 'GET') {

		if (isset($_GET['doctor_id'])) {
			include ('connection.php');

			$doctor_id = $_GET['doctor_id'];

			$select_sql = "SELECT * FROM `tbl_appointment` WHERE `doctor_id` = '$doctor_id' ORDER BY `appointment_id` DESC";

			$result = mysqli_query($conn, $select_sql);

			$array = array();

			while($data = mysqli_fetch_assoc($result)) {
				$array[] = $data;
			}

			http_response_code(200);

			$double = array(
							'msg' => 'All Appointments By Doctor ID',
							'statusCode' => 200,
							'data' => $array
						);

			echo json_encode($double);

			include ('disconnect.php');

		} else {
			http_response_code(503);

	        $double = array(
							'msg' => 'Unable to Get All Appointment Data By Doctor ID',
							'statusCode' => 503
							);

			echo json_encode($double);
	    }
     
	} else {
		http_response_code(405);

        $double = array(
						'msg' => 'Incorrect Method...',
						'statusCode' => 405
						);

		echo json_encode($double);	
	}
?>