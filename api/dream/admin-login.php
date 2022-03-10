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

            $admin_email  = $decoded->username;
            $admin_password = $decoded->password;

            $sql = "SELECT `admin_id`, `admin_email`, `admin_password` FROM `tbl_admin` WHERE `admin_email` = '$admin_email' AND `admin_password` = '$admin_password'";

            $result = mysqli_query($conn, $sql);

            if ($result) {

                $totalrows = mysqli_num_rows($result);
                if($totalrows == 1) { 

                    $x = mysqli_fetch_row($result);
                    $id = $x[0];
                    $name = $x[1];

                    $msg = "Admin Login Successful";

                    http_response_code(200);
                      
                    $double = array(
                        'msg' => $msg,
                        'statusCode' => 200,
                        'data' => array(
                            array(
                                'admin_id' => $id,
                                'admin_name' => $name
                            )
                        ) 
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
                            'msg' => 'Unable to Login',
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