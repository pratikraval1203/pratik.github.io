
<?php
   header("Access-Control-Allow-Origin: *");
   header("Content-Type: application/json; charset=UTF-8");
   header("Access-Control-Allow-Methods: POST");
   header("Access-Control-Max-Age: 3600");
   header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

   if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {

      $rawdata = file_get_contents("php://input");
      $decoded = json_decode($rawdata);


      if (isset($decoded)) {

         include('connection.php');

         $p_id = $decoded->p_id;

         $sql = "DELETE FROM `wishlist` WHERE `p_id` = '$p_id'";

         if(mysqli_query($con , $sql)) {

            $abc = "images/".$p_id;


            function delete_directory($dirname) {
                if (is_dir($dirname))
                    $dir_handle = opendir($dirname);
                  if (!$dir_handle)
                     return false;
                  while($file = readdir($dir_handle)) {
                        if ($file != "." && $file != "..") {
                          if (!is_dir($dirname."/".$file))
                              unlink($dirname."/".$file);
                          else
                              delete_directory($dirname.'/'.$file);
                        }
                  }
               closedir($dir_handle);
               rmdir($dirname);
               return true;
            }

            delete_directory($abc);

            $alert = "wishlist successfully deleted";

            http_response_code(200);

            $double = array(
               'msg' => $alert,
               'statusCode' => 200,
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
                     'msg' => 'Unable to delete wishlist',
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