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
			
			$insert_sql = "INSERT INTO `tbl_doctor`(`uid`, `email`, `name`, `password`, `mobile`) VALUES ('$uid','$email','$name','$password','$mobile')";

			if(mysqli_query($conn , $insert_sql)) {

				$doctor_id = mysqli_insert_id($conn);

				$profile_sql = "INSERT INTO `tbl_doctor_profile`(`doctor_id`, `address`, `speciality`, `about`, `fees`) VALUES ('$doctor_id','','','','')";

				if(mysqli_query($conn , $profile_sql)) {

					$flag = 1;

					for ($i = 1; $i <= 7 ; $i++) {
						$timeslot_sql = "INSERT INTO `tbl_doctor_timeslot`(`doctor_id`, `day`, `is_available`, `start_time`, `end_time`, `duration`) VALUES ('$doctor_id','$i','1','09:00:00','13:00:00','00:30:00')";

						if(mysqli_query($conn , $timeslot_sql)) {			
							$flag = 1;
						}
						else {
					        $flag = 0;
					        exit();
					    } 	
					}

					if($flag == 1) {
							
						$alert = "doctor Added Successfully";

						

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