<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");

	if ($_SERVER['REQUEST_METHOD'] === 'GET') {

		if (isset($_GET['cb_id'])) {
		
			include ('connection.php');

			$cb_id = $_GET['cb_id'];

			$cb_sql = "SELECT `property_id` FROM `tbl_cashback` WHERE `cb_id` = '$cb_id'";

			$cb_result = mysqli_query($conn, $cb_sql);

			if (mysqli_num_rows($cb_result) == 1) {
				while ($cb_data = mysqli_fetch_assoc($cb_result)) {
					$property_id = $cb_data['property_id'];

					$select_sql = "SELECT * FROM `tbl_property` WHERE `property_id` = '$property_id'";

					$result = mysqli_query($conn, $select_sql);

					$array = array();

					while($data = mysqli_fetch_assoc($result)) {

						$select_img = "SELECT * FROM `tbl_images` WHERE `property_id` = '$property_id'";

						$result_img = mysqli_query($conn, $select_img);

						// print_r($result_img);

						$array_img = array();


						while($data_img = mysqli_fetch_assoc($result_img)) {

							$path = "images/".$property_id."/";
							$path_img = $base_url.$path.$data_img['img_source'];


							$array_img[]['img'] = $path_img;
						}


						$data['images'] = $array_img;


						$array[] = $data;

					}

					http_response_code(200);

					$double = array(
									'msg' => 'Cashback & Property Data By ID',
									'statusCode' => 200,
									'data' => $array
								);

					echo json_encode($double);

					include ('disconnect.php');
				}
			} else {
		        $alert = mysqli_error($conn);

		        http_response_code(400);

		        $double = array(
								'msg' => $alert,
								'statusCode' => 400
								);

				echo json_encode($double);
		    }
		} else {
			http_response_code(503);

	        $double = array(
							'msg' => 'Unable to Get Customer Code Data',
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