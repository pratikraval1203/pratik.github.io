<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Methods: POST");
	header("Access-Control-Max-Age: 3600");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {

		$rawdata = file_get_contents("php://input");
		$decoded = json_decode($rawdata);


		if (isset($decoded->property_id) && isset($decoded->owner_cust_id) && isset($decoded->booking_cust_id)) {

			include('connection.php');

			$property_id = $decoded->property_id;
			$owner_cust_id = $decoded->owner_cust_id;
			$booking_cust_id = $decoded->booking_cust_id;
			

			$insert_sql = "INSERT INTO `tbl_private_inspection`(`owner_cust_id`, `property_id`, `booking_cust_id`) VALUES ('$owner_cust_id','$property_id','$booking_cust_id')";

			if(mysqli_query($conn , $insert_sql)) {
		        $alert = "Private Inspection Booking Successfull";

		        http_response_code(200);

		        $double = array(
								'msg' => $alert,
								'statusCode' => 200,
								);
				
				echo json_encode($double);

		    }
		    else {
		        $alert = mysqli_error($conn);

		        http_response_code(400);

		        $double = array(
								'msg' => $alert,
								'statusCode' => 400
								);

				echo json_encode($double);
		    }

		    include ('disconnect.php');

		} else {
			http_response_code(503);

	        $double = array(
							'msg' => 'Data Not Complete',
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