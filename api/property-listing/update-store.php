<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Methods: POST");
	header("Access-Control-Max-Age: 3600");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

	if ($_SERVER['REQUEST_METHOD'] === 'PUT') {

		$rawdata = file_get_contents("php://input");
		$decoded = json_decode($rawdata);


		if (isset($decoded->store_id) && isset($decoded->cust_id) && isset($decoded->name) && isset($decoded->email) && isset($decoded->mobile) && isset($decoded->address) && isset($decoded->services) && isset($decoded->description) && isset($decoded->working_hours) && isset($decoded->latitude) && isset($decoded->longitude) && isset($decoded->status)) {

			include('connection.php');

			$store_id = $decoded->store_id;
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
			
			$update_sql = "UPDATE `tbl_store` SET `cust_id`='$cust_id',`name`='$name',`email`='$email',`mobile`='$mobile',`address`='$address',`services`='$services',`description`='$description',`working_hours`='$working_hours',`latitude`='$latitude',`longitude`='$longitude',`status`='$status' WHERE `store_id`='$store_id'";

			if(mysqli_query($conn , $update_sql)) {
		        $alert = "Store Data Updated Successfully";


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