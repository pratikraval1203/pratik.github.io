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

			$user_id = $decoded->user_id;
			$supplement_name = $decoded->supplement_name;
			$supplement_price = $decoded->supplement_price;

			$insert_sql = "INSERT INTO `tbl_supplement`(`user_id`, `supplement_name`, `supplement_price`) VALUES ('$user_id','$supplement_name','$supplement_price')";

			if(mysqli_query($conn , $insert_sql)) {
		        $alert = "Supplement Added Successfully";

		        $supplement_id = mysqli_insert_id($conn);

		        http_response_code(200);

		        $double = array(
					'msg' => $alert,
					'statusCode' => 200,
					'data' => array(
						array(
							'supplement_id' => $supplement_id
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
							'msg' => 'Unable to add Supplement',
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