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

			$pro_location = $decoded->pro_location;
			$pro_flat_price = $decoded->pro_flat_price;
			$pro_cashback = $decoded->pro_cashback; 
			$pro_bhk = $decoded->pro_bhk;
			$pro_amenities_yoga = $decoded->pro_amenities_yoga;
			$pro_amenities_valet = $decoded->pro_amenities_valet;
			$pro_amenities_laundromat = $decoded->pro_amenities_laundromat;
			$pro_amenities_fire = $decoded->pro_amenities_fire;
			$pro_amenities_water = $decoded->pro_amenities_water;
			$pro_amenities_cctv = $decoded->pro_amenities_cctv;
			$pro_amenities_playarea = $decoded->pro_amenities_playarea;
			$pro_amenities_lift = $decoded->pro_amenities_lift;
			$pro_amenities_vaastu = $decoded->pro_amenities_vaastu;
			$pro_amenities_security = $decoded->pro_amenities_security;
			$pro_amenities_intercom = $decoded->pro_amenities_intercom;
			$pro_amenities_other = $decoded->pro_amenities_other;
			$pro_builder_name = $decoded->pro_builder_name;
			$pro_builder_group = $decoded->pro_builder_group;
			// $images = $decoded->images;

			// print_r($images);

			$insert_sql = "INSERT INTO `tbl_property`(`pro_location`, `pro_flat_price`, `pro_cashback`, `pro_bhk`, `pro_amenities_yoga`, `pro_amenities_valet`, `pro_amenities_laundromat`, `pro_amenities_fire`, `pro_amenities_water`, `pro_amenities_cctv`, `pro_amenities_playarea`, `pro_amenities_lift`, `pro_amenities_vaastu`, `pro_amenities_security`, `pro_amenities_intercom`, `pro_amenities_other`, `pro_builder_name`, `pro_builder_group`) VALUES ('$pro_location','$pro_flat_price','$pro_cashback','$pro_bhk','$pro_amenities_yoga','$pro_amenities_valet','$pro_amenities_laundromat','$pro_amenities_fire','$pro_amenities_water','$pro_amenities_cctv','$pro_amenities_playarea','$pro_amenities_lift','$pro_amenities_vaastu','$pro_amenities_security','$pro_amenities_intercom','$pro_amenities_other','$pro_builder_name','$pro_builder_group')";

			if(mysqli_query($conn , $insert_sql)) {
		        $alert = "Property Added Successfully";

		        $property_id = mysqli_insert_id($conn);

		        mkdir("images/".$property_id);

		    //     $count = count($images);

		    //     for ($i= 0 ; $i < $count ; $i++) {
		    //     	$insert_img = "INSERT INTO `tbl_images`( `property_id`, `img_source`) VALUES ('$property_id','{$images[$i]}')";

		    //         if(mysqli_query($conn , $insert_img)) {
		    //             $alert = "Images Uploaded Successfully";
		    //         }
		    //         else {
				  //       $alert = mysqli_error($conn);

				  //       $double = array(
						// 				'msg' => $alert,
						// 				'statusCode' => 400
						// 				);

						// echo json_encode($double);
				  //   }
		    //     }

		        http_response_code(200);

		        $double = array(
					'msg' => $alert,
					'statusCode' => 200,
					'data' => array(
						array(
							'property_id' => $property_id
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
							'msg' => 'Unable to add Property',
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