<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");

	if ($_SERVER['REQUEST_METHOD'] === 'GET') {

		if (isset($_GET['doctor_id']) && isset($_GET['keyword'])) {
			include ('connection.php');

			$doctor_id = $_GET['doctor_id'];
			$search = mysqli_real_escape_string($conn, $_GET['keyword']);

			$select_sql = "SELECT * FROM `tbl_appointment` LEFT JOIN `tbl_customer` ON tbl_appointment.doctor_id = tbl_customer.cust_id WHERE `doctor_id` = '$doctor_id' && (tbl_customer.name LIKE '%".$search."%' OR `description` LIKE '%".$search."%') ORDER BY `appointment_id` DESC";

			$result = mysqli_query($conn, $select_sql);

			$array = array();

			while($data = mysqli_fetch_assoc($result)) {
				$array[] = $data;
			}

			http_response_code(200);

			$double = array(
							'msg' => 'Search Results for appointments By Doctor ID',
							'statusCode' => 200,
							'data' => $array
						);

			echo json_encode($double);

			include ('disconnect.php');

		} else {
			http_response_code(503);

	        $double = array(
							'msg' => 'Unable to Get Search Results for appointment Data By Doctor ID',
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