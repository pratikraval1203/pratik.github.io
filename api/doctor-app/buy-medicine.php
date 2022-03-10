<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Methods: POST");
	header("Access-Control-Max-Age: 3600");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {

		$rawdata = file_get_contents("php://input");
		$decoded = json_decode($rawdata);


		if (isset($decoded->prescription_id) && isset($decoded->cust_id) && isset($decoded->first_name) && isset($decoded->last_name) && isset($decoded->house_no) && isset($decoded->apartment) && isset($decoded->area) && isset($decoded->city) && isset($decoded->state) && isset($decoded->mobile)) {

			include('connection.php');

			$prescription_id = $decoded->prescription_id;
			$cust_id = $decoded->cust_id;
			$first_name = $decoded->first_name;
			$last_name = $decoded->last_name;
			$house_no = $decoded->house_no;
			$apartment = $decoded->apartment;
			$area = $decoded->area;
			$city = $decoded->city;
			$state = $decoded->state;
			$mobile = $decoded->mobile;
			
			$insert_sql = "INSERT INTO `tbl_medicine`(`prescription_id`, `cust_id`, `first_name`, `last_name`, `house_no`, `apartment`, `area`, `city`, `state`, `mobile`) VALUES ('$prescription_id','$cust_id','$first_name','$last_name','$house_no','$apartment','$area','$city','$state','$mobile')";

			if(mysqli_query($conn , $insert_sql)) {
		        $alert = "Medicine Added Successfully";

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