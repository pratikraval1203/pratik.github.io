<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Methods: POST");
	header("Access-Control-Max-Age: 3600");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {

		$rawdata = file_get_contents("php://input");
		$decoded = json_decode($rawdata);


		if (isset($decoded->admin_email) && isset($decoded->admin_password) && isset($decoded->admin_commision) && isset($decoded->admin_level)) {

			include('connection.php');

			$admin_email = $decoded->admin_email;
			$admin_password = $decoded->admin_password;
			$admin_commision = $decoded->admin_commision;
			$admin_level = $decoded->admin_level;
			
			$insert_sql = "INSERT INTO `tbl_admin`(`admin_email`, `admin_password`, `admin_commision`, `admin_level`) VALUES ('$admin_email','$admin_password','$admin_commision','$admin_level')";

			if(mysqli_query($conn , $insert_sql)) {

				$doctor_id = mysqli_insert_id($conn);
							
				$alert = "SignUp Successful";	

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