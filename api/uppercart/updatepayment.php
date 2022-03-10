
 <?php
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Methods: POST");
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  if ($_SERVER['REQUEST_METHOD'] === 'PUT') {

    $rawdata = file_get_contents("php://input");
    $decoded = json_decode($rawdata);

    if (isset($decoded)) {

      include('connection.php');

          $pay_id=$decoded->pay_id;
         $cartnumber = $decoded->cartnumber;
         $mm = $decoded->mm;
         $yy = $decoded->yy;
         $cvv = $decoded->cvv;
         $name = $decoded->name;
         $country = $decoded->country;
         $zip= $decoded->zip; 
 


      $insert_sql = "UPDATE `payment` SET 'cartnumber'='$cartnumber','mm'='$mm','yy'='$yy','cvv'='$cvv','name'='$name','country'='$country','zip'='$zip' WHERE 'pay_id'='$pay_id'";
      if(mysqli_query($con , $insert_sql)) {
            $alert = "payment Data Updated Successfully";

            http_response_code(200);

            $double = array(
          'msg' => $alert,
          'statusCode' => 200,
          'data' => array(
            array(
              'pay_id' => $pay_id
            )
          ) 
        );
        
        echo json_encode($double);

        }
        else {
            $alert = mysqli_error($con);

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
              'msg' => 'Unable to add Cashback Code',
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