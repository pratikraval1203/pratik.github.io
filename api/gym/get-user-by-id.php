<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");

	if ($_SERVER['REQUEST_METHOD'] === 'GET') {

		if (isset($_GET['user_id'])) {
			include ('connection.php');

			$user_id = $_GET['user_id'];

			$select_sql = "SELECT * FROM `tbl_user` WHERE `user_id` = '$user_id'";

			$result = mysqli_query($conn, $select_sql);

			$array = array();

			while($data = mysqli_fetch_assoc($result)) {
				$user_id = $data['user_id'];

				$array_img = array();

				$path = "images/".$user_id."/";
				$array_img[]['profile'] = $base_url.$path."profile.png";
				$array_img[]['document'] = $base_url.$path."document.png";

				//$array_img[]['img'] = $base_url.$path."profile.png";
				//$array_img[]['img'] = $base_url.$path."document.png";

				$data['images'] = $array_img;

				$array[] = $data;
			}

			http_response_code(200);

			$double = array(
							'msg' => 'Customer Data by ID',
							'statusCode' => 200,
							'data' => $array
						);

			echo json_encode($double);

			include ('disconnect.php');
			
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