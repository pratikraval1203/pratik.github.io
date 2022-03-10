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

			$cust_mobile = $decoded->cust_mobile;
			$cust_name = $decoded->cust_name;
			$cust_email = $decoded->cust_email;
			$cust_address = $decoded->cust_address; 


			$insert_sql = "INSERT INTO `tbl_customer`(`cust_mobile`, `cust_name`, `cust_email`, `cust_address`) VALUES ('$cust_mobile','$cust_name','$cust_email','$cust_address')";

			if(mysqli_query($conn , $insert_sql)) {
		        $alert = "Customer Added Successfully";

		        $cust_id = mysqli_insert_id($conn);

		        http_response_code(200);

		        $double = array(
					'msg' => $alert,
					'statusCode' => 200,
					'data' => array(
						array(
							'cust_id' => $cust_id
						)
					) 
				);
				
				echo json_encode($double);

		    } else {
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
							'msg' => 'Unable to add Customer',
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