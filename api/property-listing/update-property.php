<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Methods: POST");
	header("Access-Control-Max-Age: 3600");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

	if ($_SERVER['REQUEST_METHOD'] === 'PUT') {

		$rawdata = file_get_contents("php://input");
		$decoded = json_decode($rawdata);


		if (isset($decoded->property_id) && isset($decoded->owner_cust_id) && isset($decoded->location) && isset($decoded->type) && isset($decoded->min_price) && isset($decoded->max_price) && isset($decoded->bedroom) && isset($decoded->bathroom) && isset($decoded->parking) && isset($decoded->min_landsize) && isset($decoded->max_landsize) && isset($decoded->is_promoted) && isset($decoded->pets) && isset($decoded->gas) && isset($decoded->balcony) && isset($decoded->study) && isset($decoded->ac) && isset($decoded->wordrobes) && isset($decoded->garden) && isset($decoded->laundary) && isset($decoded->pool) && isset($decoded->is_established) && isset($decoded->on_lease) && isset($decoded->keyword) &&  isset($decoded->visiting_day) && isset($decoded->visiting_timeslot) && isset($decoded->latitude) && isset($decoded->longitude) && isset($decoded->likes) && isset($decoded->share) && isset($decoded->view)) {

			include('connection.php');

			$property_id = $decoded->property_id;
			$owner_cust_id = $decoded->owner_cust_id;
			$location = $decoded->location;
			$type = $decoded->type;
			$min_price = $decoded->min_price; 
			$max_price = $decoded->max_price;
			$bedroom = $decoded->bedroom;
			$bathroom = $decoded->bathroom;
			$parking = $decoded->parking;
			$min_landsize = $decoded->min_landsize;
			$max_landsize = $decoded->max_landsize;
			$is_promoted = $decoded->is_promoted;
			$pets = $decoded->pets;
			$gas = $decoded->gas;
			$balcony = $decoded->balcony;
			$study = $decoded->study;
			$ac = $decoded->ac;
			$wordrobes = $decoded->wordrobes;
			$garden = $decoded->garden;
			$laundary = $decoded->laundary;
			$pool = $decoded->pool;
			$is_established = $decoded->is_established;
			$on_lease = $decoded->on_lease;
			$keyword = $decoded->keyword;
			$visiting_day = $decoded->visiting_day;
			$visiting_timeslot = $decoded->visiting_timeslot;
			$latitude = $decoded->latitude;
			$longitude = $decoded->longitude;
			$likes = $decoded->likes;
			$share = $decoded->share;
			$view = $decoded->view;

			$update_sql = "UPDATE `tbl_property` SET `owner_cust_id`='$owner_cust_id', `location`='$location',`type`='$type',`min_price`='$min_price',`max_price`='$max_price',`bedroom`='$bedroom',`bathroom`='$bathroom',`parking`='$parking',`min_landsize`='$min_landsize',`max_landsize`='$max_landsize',`is_promoted`='is_promoted',`pets`='$pets',`gas`='$gas',`balcony`='$balcony',`study`='$study',`ac`='$ac',`wordrobes`='$wordrobes',`garden`='$garden',`laundary`='$laundary',`pool`='$pool',`is_established`='$is_established',`on_lease`='$on_lease',`keyword`='$keyword',`visiting_day`='$visiting_day',`visiting_timeslot`='$visiting_timeslot',`latitude`='$latitude',`longitude`='$longitude',`likes`='$likes',`share`='$share',`view`='$view' WHERE `property_id` = '$property_id'";

			if(mysqli_query($conn , $update_sql)) {
		        $alert = "Property Data Updated Successfully";

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