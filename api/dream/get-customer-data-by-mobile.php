<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");

	if ($_SERVER['REQUEST_METHOD'] === 'GET') {

		if (isset($_GET['cust_mobile'])) {
			include ('connection.php');

			$cust_mobile = $_GET['cust_mobile'];
			
			$string = str_replace(" ", "+", $cust_mobile);

			$select_sql = "SELECT * FROM `tbl_customer` WHERE `cust_mobile` = '$string'";
		
			$result = mysqli_query($conn, $select_sql);

			$array = array();

			if (mysqli_num_rows($result) == 1) {
				while($data = mysqli_fetch_assoc($result)) {
					$array[] = $data;
				}

				http_response_code(200);

				$double = array(
								'msg' => 'Customer Data By Mobile',
								'statusCode' => 200,
								'data' => $array
							);

				echo json_encode($double);
				
			} else {
				http_response_code(400);

		        $double = array(
								'msg' => 'Unable to Get Customer Data by Mobile',
								'statusCode' => 400
							);

				echo json_encode($double);
			}

			include ('disconnect.php');

		} else {
			http_response_code(503);

	        $double = array(
							'msg' => 'Unable to Get Customer Data by Mobile',
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