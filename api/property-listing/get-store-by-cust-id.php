<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");

	if ($_SERVER['REQUEST_METHOD'] === 'GET') {

		if (isset($_GET['cust_id'])) {
			include ('connection.php');

			$cust_id = $_GET['cust_id'];

			$select_sql = "SELECT * FROM `tbl_store` WHERE `cust_id` = '$cust_id'";

			$result = mysqli_query($conn, $select_sql);

			$array = array();

			while($data = mysqli_fetch_assoc($result)) {

				$store_id = $data['store_id'];

				$select_img = "SELECT * FROM `tbl_store_images` WHERE `store_id` = '$store_id'";

				$result_img = mysqli_query($conn, $select_img);

				$array_img = array();

				while($data_img = mysqli_fetch_assoc($result_img)) {

					$path = "images/store/".$store_id."/";
					$path_img = $base_url.$path.$data_img['img_source'];


					$array_img[]['img'] = $path_img;
				}


				$data['images'] = $array_img;


				$array[] = $data;

			}

			http_response_code(200);

			$double = array(
							'msg' => 'Store Data By Customer ID',
							'statusCode' => 200,
							'data' => $array
						);

			echo json_encode($double);

			include ('disconnect.php');

		} else {
			http_response_code(503);

	        $double = array(
							'msg' => 'Unable to Get Store Data By Customer ID',
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