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

			$first_name = $decoded->first_name;
			$last_name = $decoded->last_name;
			$mobile_no = $decoded->mobile_no;
			$start_date = $decoded->start_date; 
			$with_per = $decoded->with_per;
			$username = $decoded->username;
			$password = $decoded->password;
			$gym_time = $decoded->gym_time;

			$insert_sql = "INSERT INTO `tbl_user`(`first_name`, `last_name`, `mobile_no`, `start_date`, `with_per`, `username`, `password`, `gym_time`) VALUES ('$first_name','$last_name','$mobile_no','$start_date','$with_per','$username','$password','$gym_time')";

			if(mysqli_query($conn , $insert_sql)) {
		        $alert = "User Added Successfully";

		        $user_id = mysqli_insert_id($conn);
		        mkdir("images/".$user_id);

		        http_response_code(200);

		        $double = array(
					'msg' => $alert,
					'statusCode' => 200,
					'data' => array(
						array(
							'user_id' => $user_id
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
							'msg' => 'Unable to add User',
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