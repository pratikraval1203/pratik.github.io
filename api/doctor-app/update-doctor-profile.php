<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Methods: POST");
	header("Access-Control-Max-Age: 3600");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

	if ($_SERVER['REQUEST_METHOD'] === 'PUT') {

		$rawdata = file_get_contents("php://input");
		$decoded = json_decode($rawdata);


		if (isset($decoded->doctor_id) && isset($decoded->uid) && isset($decoded->name) && isset($decoded->password) && isset($decoded->email) && isset($decoded->mobile)) {

			include('connection.php');

			$doctor_id = $decoded->doctor_id;
			$uid = $decoded->uid;
			$name = $decoded->name;
			$password = $decoded->password;
			$email = $decoded->email;
			$mobile = $decoded->mobile;
			
			$update_sql = "UPDATE `tbl_doctor` SET `uid`='$uid',`email`='$email',`name`='$name',`password`='$password',`mobile`='$mobile' WHERE `doctor_id`='$doctor_id'";

			if(mysqli_query($conn , $update_sql)) {
		        $alert = "doctor Data Updated Successfully";

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