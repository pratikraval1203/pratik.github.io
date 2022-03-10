<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Methods: POST");
	header("Access-Control-Max-Age: 3600");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {

		$rawdata = file_get_contents("php://input");
		$decoded = json_decode($rawdata);


		if (isset($decoded->cust_id) && isset($decoded->doctor_id) && isset($decoded->date) && isset($decoded->title) && isset($decoded->description)) {

			include('connection.php');

			$cust_id = $decoded->cust_id;
			$doctor_id = $decoded->doctor_id;
			$date = $decoded->date;
			$title = $decoded->title;
			$description = $decoded->description;
			
			$insert_sql = "INSERT INTO `tbl_prescription`(`doctor_id`, `cust_id`, `date`, `title`, `description`) VALUES ('$doctor_id','$cust_id','$date','$title','$description')";

			if(mysqli_query($conn , $insert_sql)) {
		        $alert = "Prescription Added Successfully";

		        $prescription_id = mysqli_insert_id($conn);

		        $timestamp = strtotime($date);

		        $cust_sql = "SELECT * FROM `tbl_customer` WHERE `cust_id` = '$cust_id'";

		        $cust_result = mysqli_query($conn, $cust_sql);

		        while($data_cust = mysqli_fetch_assoc($cust_result)) {
		        	$cust_data = $data_cust;
		        }

		        $doctor_sql = "SELECT * FROM `tbl_doctor` WHERE `doctor_id` = '$doctor_id'";

		        $doctor_result = mysqli_query($conn, $doctor_sql);

		        while($data_doctor = mysqli_fetch_assoc($doctor_result)) {
		        	$doctor_data = $data_doctor;
		        }

				require('fpdf/fpdf.php');

				// require "connection.php";//connection to database
				//SQL to get 10 records
				// $sql="select * from tbl_doctor LIMIT 0,10";

				//create a FPDF object
				$pdf=new FPDF();

				//set font for the entire document
				$pdf->SetFont('times','',12);
				$pdf->SetTextColor(50,60,100);

				//set up a page
				$pdf->AddPage('P');
				$pdf->SetDisplayMode('default','default');

				//Set x and y position for the main text, reduce font size and write content
				// $pdf->SetXY (10,60);
				// $pdf->SetFontSize(12);
				// $pdf->Write(5,'Dear Ms.XYX');

				$width_cell=array(190);
				$pdf->SetFont('Arial','B',16);

				//Background color of header//
				$pdf->SetFillColor(193,229,252);

				// Header starts /// 
				//First header column //
				$pdf->Cell($width_cell[0],10,'Prescription',1,0,'C',true);

				$pdf->SetFont('Arial','',14);
				//Background color of header//
				$pdf->SetFillColor(235,236,236); 

				$pdf->SetXY (10,25);
				$pdf->Write(5,"Date: ".date('d-m-Y',$timestamp));

				$pdf->Line(0, 35, 210, 35);

				$pdf->SetXY (10,40);
				$pdf->Write(5,"Patient: ".$cust_data['name']);

				$pdf->SetXY (10,50);
				$pdf->Write(5,"Doctor: ".$doctor_data['name']);

				$pdf->Line(0, 60, 210, 60);

				$pdf->SetXY (10,65);
				$pdf->Write(5,"Title: ".$title);

				$pdf->SetXY (10,75);
				$pdf->Write(5,"Description: ".$description);

				$filename=$prescription_id.".pdf";
				//Output the document
				$filename="prescription/".$prescription_id.".pdf";
				$pdf->Output($filename,'F');

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