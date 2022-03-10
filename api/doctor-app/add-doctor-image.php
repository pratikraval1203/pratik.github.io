<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Methods: POST");
	header("Access-Control-Max-Age: 3600");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {

		if (isset($_POST['doctor_id'])) { 

			$doctor_id = $_POST['doctor_id'];
		    $filename = $_FILES['image']['name'];
		    $filedata = $_FILES['image']['tmp_name'];
		    $filesize = $_FILES['image']['size'];

		    if ($filedata != '')
		    {
		    	$target_dir = "images/doctor/".$doctor_id."/";
				$target_file = $target_dir . basename($filename);
				$uploadOk = 1;
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

				$check = getimagesize($filedata);

				if($check !== false) {
					$uploadOk = 1;
				} else {

					$msg = "File is not an image.";
					$uploadOk = 0;

					http_response_code(400);

					$double = array(
						'msg' => $msg,
						'statusCode' => 400
					);
					
					echo json_encode($double);
				}

				if($imageFileType != "png") {

				  	$msg = "Sorry, only PNG files are allowed.";
					$uploadOk = 0;

					http_response_code(400);

					$double = array(
						'msg' => $msg,
						'statusCode' => 400
					);
					
					echo json_encode($double);

				}

				if ($uploadOk == 0) {

				} else {
				  	if (move_uploaded_file($filedata, $target_file)) {
				        $alert = "Image Added Successfully";

				        http_response_code(200);

				        $double = array(
							'msg' => $alert,
							'statusCode' => 200
						);
						
						echo json_encode($double);
				  	} else {

				    	$msg = "Sorry, there was an error uploading your file.";

				    	http_response_code(400);

						$double = array(
							'msg' => $msg,
							'statusCode' => 400
						);
						
						echo json_encode($double);
				 	}
				}
		    }
		    else
		    {
		        $msg = "Please select the file";

		        http_response_code(400);

				$double = array(
					'msg' => $msg,
					'statusCode' => 400 
				);
				
				echo json_encode($double);
		    }
		} else {
			http_response_code(503);

	        $double = array(
							'msg' => 'Unable to add Photo',
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