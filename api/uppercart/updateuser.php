

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

    $id=$decoded->id;
    $name=$decoded->name;
    $email=$decoded->email;
    $password=$decoded->password;
    $lastname=$decoded->lastname;
    $profilephoto=$decoded->profilephoto;
 


      $insert_sql = "UPDATE `user` SET
'name'='$name', 'email'='$email','password'='$password','lastname'='$lastname','profilephoto'='$profilephoto' WHERE 'id'='$id'"
      if(mysqli_query($con , $insert_sql)) {
            $alert = "User Data Updated Successfully";

            http_response_code(200);

            $double = array(
          'msg' => $alert,
          'statusCode' => 200,
          'data' => array(
            array(
              'id' => $id
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