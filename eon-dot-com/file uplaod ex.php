<?php
    session_start();

    include('connection.php');

    $alert = "";
    $image_alert = "";
    $video_alert = "";
    if (isset($_POST['submit'])) {

        $pic_target_file = "/";
        $video_target_file = "/";

        if (isset($_FILES["part_pic_link"])) {
            $target_dir = "uploads/";
            $pic_target_file = $target_dir . basename($_FILES["part_pic_link"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($pic_target_file,PATHINFO_EXTENSION));

            // Check if image file is a actual image or fake image

            $check = getimagesize($_FILES["part_pic_link"]["tmp_name"]);
            if($check !== false) {
                $image_alert = "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                $image_alert = "File is not an image.";
                $uploadOk = 0;
            }


            // Check if file already exists
            if (file_exists($pic_target_file)) {
              $image_alert = "Sorry, file already exists.";
              $uploadOk = 0;
            }

            // Check file size
            if ($_FILES["part_pic_link"]["size"] > 500000) {
              $image_alert = "Sorry, your file is too large.";
              $uploadOk = 0;
            }

            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
              $image_alert = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
              $uploadOk = 0;

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
              $image_alert = "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
            } else {
                
              if (move_uploaded_file($_FILES["part_pic_link"]["tmp_name"], $pic_target_file)) {
                // $image_alert = "The file ". htmlspecialchars( basename( $_FILES["part_pic_link"]["name"])). " has been uploaded.";
              } else {
                $file_alert = "Sorry, there was an error uploading your file.";
              }
            } 
        }

        if (isset($_FILES["part_video_link"])) {
            $target_dir = "uploads/";
            $video_target_file = $target_dir . basename($_FILES["part_video_link"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($video_target_file,PATHINFO_EXTENSION));

            // Check if image file is a actual image or fake image

            $check = getimagesize($_FILES["part_video_link"]["tmp_name"]);
            if($check !== false) {
                $video_alert = "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                $video_alert = "File is not an image.";
                $uploadOk = 0;
            }


            // Check if file already exists
            if (file_exists($video_target_file)) {
              $video_alert = "Sorry, file already exists.";
              $uploadOk = 0;
            }

            // Check file size
            if ($_FILES["part_video_link"]["size"] > 500000) {
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
              $video_alert = "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
            } else {
                
              if (move_uploaded_file($_FILES["part_video_link"]["tmp_name"], $video_target_file)) {
                // $video_alert = "The file ". htmlspecialchars( basename( $_FILES["part_video_link"]["name"])). " has been uploaded.";
              } else {
                $video_alert = "Sorry, there was an error uploading your file.";
              }
            } 
        }

        $part_sel_id = $_POST['part_sel_id'];
        $part_ann_entry_no = $_POST['part_ann_entry_no'];
        $part_spn = $_POST['part_spn'];
        $part_drawing_no = $_POST['part_drawing_no'];
        $part_specification_no = $_POST['part_specification_no'];
        $part_proposed_by = $_POST['part_proposed_by'];
        $part_pic_link = $pic_target_file;
        $part_video_link = $video_target_file;
        $updated_time = date('Y-m-d H:i:s');


        $insert_sql = "INSERT INTO `part_master_five`(`part_id`, `part_ann_entry_no`, `part_spn`, `part_drawing_no`, `part_specification_no`, `part_proposed_by`, `part_pic_link`, `part_video_link`, `part_updated_time`, `part_updated_by`) VALUES ('$part_sel_id','$part_ann_entry_no','$part_spn','$part_drawing_no','$part_specification_no','$part_proposed_by','$part_pic_link','$part_video_link','$updated_time','')";

        if(mysqli_query($conn , $insert_sql)) {
            $alert = "Part Master 5 Data Added Successfully";
        }
        else {
            $alert = mysqli_error($conn);
            // echo $alert;
        }

        if (($image_alert != "") OR ($video_alert != "") ) {
            $alert = $image_alert." ".$video_alert;
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

    <title>Add Part Master 5</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="stylesheet" type="text/css" href="css/mycss.css">
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
                            <h6 class="m-0 font-weight-bold float-left text-primary">Add PM5 </h6>
                            <a class="float-right font-weight-bold mylink" href="part-master5.php">
                                <i class="fa fa-eye"></i>
                                View Part Master 5 List
                            </a>                 
                        </div>
                      <?php
                      }
                      else {
                      ?>
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold float-left text-primary">Add PM5</h6>
                            <a class="float-right font-weight-bold mylink" href="part-master5.php">
                                <i class="fa fa-eye"></i>
                                View Part Master 5 List
                            </a>                 
                        </div>
                      <?php
                      }
                      ?>
                        <form name="myform" enctype="multipart/form-data" class="bootstrap-form-with-validation" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" onsubmit="return validate()">
                            <div class="row mt-3 mx-3">
                                <div class="form-group col-md-4">
                                    <label for="part_sel_id">Select Part:</label>
                                    <select id="part_sel_id" name="part_sel_id" class="form-control mydrpdwn">
                                        <?php 
                                            $query = "SELECT `part_id`,`part_desc` FROM `part_master_one`";
                                            $result = mysqli_query($conn,$query);
                                        
                                            echo mysqli_error($conn);

                                            print_r($row);
                         
                                            while($row = mysqli_fetch_array($result) ){
                                            $id = $row['part_id'];
                                            $desc = $row['part_desc'];
                                                // foreach ($row as $i) {  
                                            ?>
                                                <option value="<?php echo $id; ?>"><?php echo $desc; ?></option>
                                            <?php
                                                // }
                                            }
                                            ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="part_ann_entry_no">Select Part</label>
                                    <select id="part_ann_entry_no" name="part_ann_entry_no" class="form-control mydrpdwn">
                                        <option value="Annex-I - OEM">Annex-I - OEM</option>
                                        <option value="Annex-II - BRANDED">Annex-II - BRANDED</option>
                                        <option value="Annex-IIIB - CUSTPMISE">Annex-IIIB - CUSTPMISE</option>
                                        <option value="Annex-IIIA- OPEN MARKET">Annex-IIIA- OPEN MARKET</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="form-label" for="text-input">Part SPN</label>
                                    <input class="form-control" required="required" type="text" id="text-input" name="part_spn">
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="form-label" for="text-input">Drawing No.</label>
                                    <input class="form-control" required="required" type="text" id="text-input" name="part_drawing_no">
                                    
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="form-label" for="number-input">Specification No.</label>
                                    <input class="form-control" required="required" type="number" id="text-input" name="part_specification_no" step="any">
                                    
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="part_proposed_by">Proposed By</label>
                                    <select id="part_proposed_by" name="part_proposed_by" class="form-control mydrpdwn">
                                        <?php 
                                            $query = "SELECT `usr_id`,`usr_name` FROM `user_master`";
                                            $result = mysqli_query($conn,$query);
                                        
                                            echo mysqli_error($conn);

                                            print_r($row);
                         
                                            while($row = mysqli_fetch_array($result) ){
                                            $id = $row['usr_id'];
                                            $name = $row['usr_name'];
                                                // foreach ($row as $i) {  
                                            ?>
                                                <option value="<?php echo $id; ?>"><?php echo $name; ?></option>
                                            <?php
                                                // }
                                            }
                                            ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="form-label" for="file-input">Picture</label>
                                    <input class="form-control" type="file" id="file-input" name="part_pic_link">
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="form-label" for="file-input">Video</label>
                                    <input class="form-control" type="file" id="file-input" name="part_video_link">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group ml-5">
                                    <input class="btn btn-primary" type="submit" name="submit"></input>
                                </div>
                                <div class="form-group ml-3">
                                    <input class="btn btn-danger" type="reset" name="clear" value="Clear"></input>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.card mb-4 shadow -->
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

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugin JavaScript-->
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

    <!-- Demo scripts for this page-->
    <script src="js/demo/datatables-demo.js"></script>

    <script type="text/javascript">
          function validate(){
            // for name
            var name = document.myform.usr_name.value;
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
        var num=document.myform.usr_mobile.value;
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