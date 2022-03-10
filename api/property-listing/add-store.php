<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Methods: POST");
	header("Access-Control-Max-Age: 3600");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {

		$rawdata = file_get_contents("php://input");
		$decoded = json_decode($rawdata);


		if (isset($decoded->cust_id) && isset($decoded->name) && isset($decoded->email) && isset($decoded->mobile) && isset($decoded->address) && isset($decoded->services) && isset($decoded->description) && isset($decoded->working_hours) && isset($decoded->latitude) && isset($decoded->longitude) && isset($decoded->status)) {

			include('connection.php');

			$cust_id = $decoded->cust_id;
			$name = $decoded->name;
			$email = $decoded->email;
			$mobile = $decoded->mobile;
			$address = $decoded->address;
			$services = $decoded->services;
			$description = $decoded->description;
			$working_hours = $decoded->working_hours;
			$latitude = $decoded->latitude;
			$longitude = $decoded->longitude;
			$status = $decoded->status;
			
			$insert_sql = "INSERT INTO `tbl_store`(`cust_id`, `name`, `email`, `mobile`, `address`, `services`, `description`, `working_hours`, `latitude`, `longitude`, `status`) VALUES ('$cust_id','$name','$email','$mobile','$address','$services','$description','$working_hours','$latitude','$longitude','$status')";

			if(mysqli_query($conn , $insert_sql)) {
		        $alert = "Store Added Successfully";

		        $store_id = mysqli_insert_id($conn);

		        mkdir("images/store/".$store_id);

		        http_response_code(200);

		        $double = array(
								'msg' => $alert,
								'statusCode' => 200,
								'data' => array(
									array(
										'store_id' => $store_id
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