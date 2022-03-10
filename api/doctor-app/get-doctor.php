<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");

	if ($_SERVER['REQUEST_METHOD'] === 'GET') {

		include ('connection.php');

		$select_sql = "SELECT * FROM `tbl_doctor` LEFT JOIN `tbl_doctor_profile` ON tbl_doctor.doctor_id = tbl_doctor_profile.doctor_id";

		$result = mysqli_query($conn, $select_sql);

		$array = array();

		while($data = mysqli_fetch_assoc($result)) {

			$doctor_id = $data['doctor_id'];

			// $profile_sql = "SELECT * FROM `tbl_doctor_profile` WHERE `doctor_id` = '$doctor_id'";

			// $profile_result = mysqli_query($conn,$profile_sql);

			// while($profile_data = mysqli_fetch_assoc($profile_result)) {
			// 	$array_profile = $profile_data;
			// }
			// $data['profile'][] = $array_profile;

			$array_img = array();

			$path = "images/doctor/".$doctor_id."/";
			$array_img[]['profile'] = $base_url.$path."profile.png";

			$data['images'] = $array_img;

			$array[] = $data;
		}

		http_response_code(200);

		$double = array(
						'msg' => 'All doctor Data',
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