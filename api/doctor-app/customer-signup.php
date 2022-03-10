<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Methods: POST");
	header("Access-Control-Max-Age: 3600");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {

		$rawdata = file_get_contents("php://input");
		$decoded = json_decode($rawdata);


		if (isset($decoded->uid) && isset($decoded->name) && isset($decoded->password) && isset($decoded->email) && isset($decoded->mobile)) {

			include('connection.php');

			$uid = $decoded->uid;
			$name = $decoded->name;
			$password = $decoded->password;
			$email = $decoded->email;
			$mobile = $decoded->mobile;
			
			$insert_sql = "INSERT INTO `tbl_customer`(`uid`, `email`, `name`, `password`, `mobile`) VALUES ('$uid','$name','$password','$email','$mobile')";

			if(mysqli_query($conn , $insert_sql)) {
		        $alert = "Customer Added Successfully";

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