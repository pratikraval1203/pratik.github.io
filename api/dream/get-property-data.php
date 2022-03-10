<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");

	if ($_SERVER['REQUEST_METHOD'] === 'GET') {
		
		include ('connection.php');

		$select_sql = "SELECT * FROM `tbl_property`";

		$result = mysqli_query($conn, $select_sql);

		// $data = mysqli_fetch_assoc($result);
		$array = array();

		while($data = mysqli_fetch_assoc($result)) {

			$property_id = $data['property_id'];

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
						'msg' => 'All Property Data',
						'statusCode' => 200,
						'data' => $array
					);

		echo json_encode($double);

		include ('disconnect.php');
		
	} else {
		http_response_code(405);

        $double = array(
						'msg' => 'Incorrect Method...',
						'statusCode' => 405
						);

		echo json_encode($double);	
	}
?>