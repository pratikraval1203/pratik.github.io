<?php 
  session_start();

  include ('connection.php');

  $alert= "";
  $image_alert = "";
  $video_alert = "";
  if(isset($_POST['submit'])){
    // print_r($_POST);

    $pic_target_file = "/";
    $video_target_file = "/";

    if ($_FILES["tm_pic_link"]['size'] != 0) {
        $target_dir = "uploads/";
        $pic_target_file = $target_dir . basename($_FILES["tm_pic_link"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($pic_target_file,PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image

        $check = getimagesize($_FILES["tm_pic_link"]["tmp_name"]);
        if($check !== false) {
            // $image_alert = "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            $image_alert .= "File is not an image.";
            $uploadOk = 0;
        }


        // Check if file already exists
        if (file_exists($pic_target_file)) {
          $image_alert .= "Sorry, file already exists.";
          $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["tm_pic_link"]["size"] > 500000) {
          $image_alert .= "Sorry, your file is too large.";
          $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
          $image_alert .= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
          $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
          // $image_alert .= "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            
          if (move_uploaded_file($_FILES["tm_pic_link"]["tmp_name"], $pic_target_file)) {
            // $image_alert = "The file ". htmlspecialchars( basename( $_FILES["tm_pic_link"]["name"])). " has been uploaded.";
          } else {
            $file_alert .= "Sorry, there was an error uploading your file.";
          }
        } 
    }

    if ($_FILES["tm_video_link"]['size'] != 0) {
        $target_dir = "uploads/";
        $video_target_file = $target_dir . basename($_FILES["tm_video_link"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($video_target_file,PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image

        $check = getimagesize($_FILES["tm_video_link"]["tmp_name"]);
        
        // Check if file already exists
        if (file_exists($video_target_file)) {
          $video_alert = "Sorry, file already exists.";
          $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["tm_video_link"]["size"] > 50000000) {
          $video_alert = "Sorry, your file is too large.";
          $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "mp4" && $imageFileType != "mov") {
          $video_alert = "Sorry, only MP4 & Mov files are allowed.";
          $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
          // $video_alert = "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            
          if (move_uploaded_file($_FILES["tm_video_link"]["tmp_name"], $video_target_file)) {
            // $video_alert = "The file ". htmlspecialchars( basename( $_FILES["tm_video_link"]["name"])). " has been uploaded.";
          } else {
            // $video_alert = "Sorry, there was an error uploading your file.";
          }
        } 
    }

    if ($image_alert != "") {
        $alert .= " Photo Status:".$image_alert;
    } else {

        if ($video_alert != "") {
            $alert .= " Video Status:".$video_alert;
        } else {

            $tmem_sel_id = $_POST['tmem_sel_id'];
            $tm_type = $_POST['tm_type'];
            $tm_make = $_POST['tm_make'];
            // $tm_brand = $_POST['tm_brand'];
            $tm_model_no = $_POST['tm_model_no'];
            $tm_is_active = $_POST['tm_is_active'];
            $tm_pic_link = $pic_target_file;
            $tm_video_link = $video_target_file;
            $updated_time = date('Y-m-d H:i:s');
            $updated_by = $_SESSION['user_id'];

            $insert_sql = "INSERT INTO `track_machine_master_one`(`tmem_id`,`tm_type`, `tm_make`, `tm_brand`, `tm_model_no`, `tm_is_active`, `tm_pic_link`, `tm_video_link`, `updated_time`, `updated_by`) VALUES ('$tmem_sel_id','$tm_type','$tm_make','','$tm_model_no','$tm_is_active','$tm_pic_link','$tm_video_link','$updated_time','$updated_by')";

            // $tm_brand hidden and blank added to database


            if(mysqli_query($conn , $insert_sql)) {
                $alert = "Track Machine Details Submitted Successfully";
            }
            else {
                $alert = mysqli_error($conn);
            }
        }
    }
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Add Track Machine</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="stylesheet" type="text/css" href="css/mycss.css">

    <link rel="stylesheet" href="select2.min.css" />

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php
            include ('sidebar.php');
        ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php
                    include ('topbar.php');
                ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="card mb-4 shadow">
                      <?php 
                        if ($alert != "") {
                      ?>
                        <div class="alert alert-info">
                          <?php echo $alert; ?>
                        </div>
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold float-left text-primary">Add New Track Machine</h6>
                            <a class="float-right font-weight-bold mylink" href="track-machine-master1.php">
                                <i class="fa fa-eye"></i>
                                View Track Machine List
                            </a>                 
                        </div>
                      <?php
                      }
                      else {
                      ?>
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold float-left text-primary">Add New Track Machine</h6>
                            <a class="float-right font-weight-bold mylink" href="track-machine-master1.php">
                                <i class="fa fa-eye"></i>
                                View Track Machine List
                            </a>                 
                        </div>
                      <?php
                      }
                      ?>

                      <form name="myform" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" onsubmit="return validate()">
                        <!-- <div class="row mx-3 mt-3">
                            <div class="form-group col-md-4">
                                <label for="tmem_sel_id">Engine:</label>
                                <select id="tmem_sel_id" name="tmem_sel_id" class="form-control mydrpdwn">
                                    <?php 
                                        $query = "SELECT `tmem_id`,`tmem_brand`,`tmem_model_no` FROM `track_machine_engine_master` ORDER BY `tmem_brand`";

                                        $result = mysqli_query($conn,$query);
                                    
                                        // echo mysqli_error($conn);

                                        // print_r($row);
                     
                                        while($row = mysqli_fetch_array($result) ){
                                        $id = $row['tmem_id'];
                                        $model_no = $row['tmem_model_no'];
                                        $brand = $row['tmem_brand'];
                                            // foreach ($row as $i) {  
                                        ?>
                                            <option value="<?php echo $id; ?>"><?php echo $brand."-".$model_no; ?></option>
                                        <?php
                                            // }
                                        }
                                        ?>
                                </select>
                            </div>
                        </div> -->
                        <div class="row mt-3 mx-3">
                            <div class="form-group col-md-4">
                                <label for="tm_type">Track Machine Type</label>
                                <input id="tm_type" name="tm_type" class="form-control mydrpdwn" required="required" type="text" list="type" />
                                <datalist id="type">
                                    <?php
                                        $query = "SELECT DISTINCT `tm_type` FROM `track_machine_master_one`";

                                        $result = mysqli_query($conn,$query);
                                    
                                        echo mysqli_error($conn);

                                        while($row = mysqli_fetch_array($result)){
                                            $tm_type = $row['tm_type'];
                                        ?>
                                            <option><?php echo $tm_type; ?></option>
                                        <?php
                                        }
                                    ?>
                                </datalist>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="">Track Machine Make</label>
                                <!-- <span class="red"></span> -->
                                <input class="form-control" type="text" name="tm_make" required="required">
                            </div>
                            <!-- <div class="form-group col-md-4">
                                <label for="tm_brand">Track Machine Brand</label>
                                <input id="tm_brand" name="tm_brand" class="form-control mydrpdwn" required="required" type="text" list="brand" />
                                <datalist id="brand">
                                    <?php
                                        $query = "SELECT DISTINCT `tm_brand` FROM `track_machine_master_one`";

                                        $result = mysqli_query($conn,$query);
                                    
                                        echo mysqli_error($conn);

                                        while($row = mysqli_fetch_array($result)){
                                            $tm_brand = $row['tm_brand'];
                                        ?>
                                            <option><?php echo $tm_brand; ?></option>
                                        <?php
                                        }
                                    ?>
                                </datalist>
                            </div> -->
                            <div class="form-group col-md-4">
                                <label class="">Model No.</label>
                                <!-- <span class="red"></span> -->
                                <input class="form-control" type="text" name="tm_model_no" required="required">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="tmem_sel_id">Engine:</label>
                                <select id="tmem_sel_id" name="tmem_sel_id" class="form-control mydrpdwn">
                                    <?php 
                                        $query = "SELECT `tmem_id`,`tmem_brand`,`tmem_model_no` FROM `track_machine_engine_master` ORDER BY `tmem_brand`";

                                        $result = mysqli_query($conn,$query);
                                    
                                        // echo mysqli_error($conn);

                                        // print_r($row);
                     
                                        while($row = mysqli_fetch_array($result) ){
                                        $id = $row['tmem_id'];
                                        $model_no = $row['tmem_model_no'];
                                        $brand = $row['tmem_brand'];
                                            // foreach ($row as $i) {  
                                    ?>
                                        <option value="<?php echo $id; ?>"><?php echo $brand."-".$model_no; ?></option>
                                    <?php
                                            // }
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label" for="file-input">Picture(Not Mendatory)</label>
                                <input class="form-control" type="file" id="file-input" name="tm_pic_link">
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label" for="file-input">Video(Not Mendatory)</label>
                                <input class="form-control" type="file" id="file-input" name="tm_video_link">
                            </div>
                        </div>
                        <div class="row mx-3">
                            <div class="form-group mb-3 col-md-4 clearfix">
                                <label class="form-label float-left">Is Active?</label>
                                <div class="form-check float-left ml-2">
                                    <input class="form-check-input" type="radio" name="tm_is_active" id="formCheck-2" value="1" checked="">
                                    <label class="form-check-label" for="formCheck-2">Yes</label>
                                </div>
                                <div class="form-check float-left ml-2">
                                    <input class="form-check-input" type="radio" name="tm_is_active" id="formCheck-3" value="0">
                                    <label class="form-check-label" for="formCheck-3">No</label>
                                </div>
                            </div> 
                        </div>
                        <div class="row mx-3">
                            <div class="form-group ml-2 mb-3">
                                <input type="submit" id="submit" name="submit" class="btn btn-primary">
                                <input type="reset" id="clear" name="clear" value="clear" class="btn btn-danger ml-2">
                                <!-- <i class="fas fa-calendar input-prefix" tabindex=0></i> -->
                            </div>
                        </div>
                      </form>
                    </div>
                    <!-- /. card mb-3 -->
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php
                include ('footer.php');
            ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <?php
        include ('logout.php');
    ?>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Page level plugin JavaScript-->
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

    <!-- Demo scripts for this page-->
    <script src="js/demo/datatables-demo.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="select2.min.js"></script>
    <script>
        $("select").select2( {
            // placeholder: "Select Country"
            // allowClear: true
            } );
    </script>

    <script type="text/javascript">
          function validate(){
            // for name
            var name = document.myform.ven_name.value;
            var letters = /^[A-Za-z\s]+$/;
          if(!name.match(letters))
          {
            document.getElementById("nameloc").innerHTML="Please Enter Valid Name";
          return false;         
          }
          else {
            document.getElementById("nameloc").innerHTML="";
          }
        // for mobile number
        var num=document.myform.ven_mobile.value;
        if (isNaN(num)){
          document.getElementById("numloc").innerHTML="Please Enter Numeric value only";
          return false;
          var phoneno = /^\d{10}$/;
          if(!num.match(phoneno))
          {
             document.getElementById("numloc").innerHTML="Not a valid Phone Number";
            return false;
          }
          else {
            document.getElementById("numloc").innerHTML="valid Phone Number ";
          }
        }
        else{
            var phoneno = /^\d{10}$/;
          if(!num.match(phoneno))
          {
             document.getElementById("numloc").innerHTML="Not a valid Phone Number";
            return false;
          }
          else {
            document.getElementById("numloc").innerHTML="valid Phone Number ";
          }
        }
      }
    </script>

</body>

</html>
<?php 
    include ('disconnect.php');
?>