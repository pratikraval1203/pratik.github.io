<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");

	if ($_SERVER['REQUEST_METHOD'] === 'GET') {

		if (isset($_GET['latitude']) && isset($_GET['longitude']) && isset($_GET['distance'])) {

			include ('connection.php');

			$latitude = $_GET['latitude'];
			$longitude = $_GET['longitude'];
			$distance = $_GET['distance'];

			$select_sql = "SELECT * , (3956 * 2 * ASIN(SQRT( POWER(SIN(( '$latitude' - `latitude`) *  pi()/180 / 2), 2) + COS( '$latitude' * pi()/180) * COS(`latitude` * pi()/180) * POWER(SIN(( '$longitude' - `longitude`) * pi()/180 / 2), 2) ))) as distance from `tbl_property` having distance <= '$distance' order by distance";

			$result = mysqli_query($conn, $select_sql);

			$array = array();

			while($data = mysqli_fetch_assoc($result)) {

				$property_id = $data['property_id'];

				$select_img = "SELECT * FROM `tbl_property_images` WHERE `property_id` = '$property_id'";

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
							'msg' => 'Get Nearby Properties',
							'statusCode' => 200,
							'data' => $array
						);

			echo json_encode($double);

			include ('disconnect.php');

		} else {
			http_response_code(503);

	        $double = array(
							'msg' => 'Unable to Get Nearby Properties',
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