<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Methods: POST");
	header("Access-Control-Max-Age: 3600");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {

		$rawdata = file_get_contents("php://input");
		$decoded = json_decode($rawdata);

		if (isset($decoded)) {

			include('connection.php');

			$cust_id = $decoded->cust_id;
			$property_id = $decoded->property_id;
			$cb_prize = $decoded->cb_prize; 

			$cb_id = chr(rand(65,90)).chr(rand(65,90)).date('i').date('s');

			$insert_sql = "INSERT INTO `tbl_cashback`(`cb_id`, `cust_id`, `property_id`, `cb_prize`) VALUES ('$cb_id','$cust_id','$property_id','$cb_prize')";

			if(mysqli_query($conn , $insert_sql)) {
		        $alert = "Property Visit Booked Successfully";

		        http_response_code(200);

		        $double = array(
					'msg' => $alert,
					'statusCode' => 200,
					'data' => array(
						array(
							'cb_id' => $cb_id
						)
					) 
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
							'msg' => 'Unable to add Cashback Code',
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