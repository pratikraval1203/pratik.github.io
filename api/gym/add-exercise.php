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
			$exercise_name = $decoded->exercise_name;
			$exercise_description = $decoded->exercise_description;
			$exercise_repetation = $decoded->exercise_repetation;
			$exercise_count = $decoded->exercise_count; 

			$insert_sql = "INSERT INTO `tbl_exercise`(`exercise_name`, `exercise_description`, `exercise_repetation`, `exercise_count`, `user_id`) VALUES ('$exercise_name','$exercise_description','$exercise_repetation','$exercise_count','$user_id')";

			if(mysqli_query($conn , $insert_sql)) {
		        $alert = "Exercise Added Successfully";

		        $exercise_id = mysqli_insert_id($conn);

		        http_response_code(200);

		        $double = array(
					'msg' => $alert,
					'statusCode' => 200,
					'data' => array(
						array(
							'exercise_id' => $exercise_id
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
							'msg' => 'Unable to add Exercise',
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