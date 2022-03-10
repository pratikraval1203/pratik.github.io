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

            $username  = $decoded->username;
            $password = $decoded->password;

            $sql = "SELECT * FROM `tbl_user` WHERE `username` = '$username' AND `password` = '$password'";

            $result = mysqli_query($conn, $sql);

            if ($result) {

                $array = array();
                $totalrows = mysqli_num_rows($result);

                if($totalrows == 1) { 

                    while ($data = mysqli_fetch_assoc($result)) {
                        $array[] = $data;
                    }

                    $msg = "User Login Successful";

                    http_response_code(200);
                      
                    $double = array(
                        'msg' => $msg,
                        'statusCode' => 200,
                        'data' =>  $array
                    );
                    echo json_encode($double);

                } else {
                    $msg = "Invalid username or password";

                    http_response_code(400);

                    $double = array(
                            'msg' => $msg,
                            'statusCode' => 400
                            );

                    echo json_encode($double);
                }

            } else {
                $msg = mysqli_error($conn);

                http_response_code(400);

                $double = array(
                            'msg' => $msg,
                            'statusCode' => 400
                            );

                echo json_encode($double);
            }

            include ('disconnect.php');

        } else {
            http_response_code(503);

            $double = array(
                            'msg' => 'Unable to add Customer',
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