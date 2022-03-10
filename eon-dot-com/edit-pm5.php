<?php
    session_start();

    include('connection.php');

    if (isset($_GET['edit_id'])) {
        $edit_id = $_GET['edit_id'];
    }

    $alert = "";
    $image_alert = "";
    $video_alert = "";
    if (isset($_POST['submit'])) {

        // print_r($_POST);

        $pic_target_file = "/";
        $video_target_file = "/";

        $part_og_pic_link = $_POST['part_og_pic_link'];
        $part_og_video_link = $_POST['part_og_video_link'];


        if ($part_og_pic_link == $_FILES['part_pic_link']) {
            $pic_target_file = $part_og_pic_link;
        } else {
            if ($_FILES["part_pic_link"]['size'] != 0) {
                $target_dir = "uploads/";
                $pic_target_file = $target_dir . basename($_FILES["part_pic_link"]["name"]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($pic_target_file,PATHINFO_EXTENSION));

                // Check if image file is a actual image or fake image

                $check = getimagesize($_FILES["part_pic_link"]["tmp_name"]);
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
                if ($_FILES["part_pic_link"]["size"] > 500000) {
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
                    
                  if (move_uploaded_file($_FILES["part_pic_link"]["tmp_name"], $pic_target_file)) {
                    // $image_alert = "The file ". htmlspecialchars( basename( $_FILES["part_pic_link"]["name"])). " has been uploaded.";
                  } else {
                    $file_alert .= "Sorry, there was an error uploading your file.";
                  }
                } 
                // echo "jooo";
            } else {
                $pic_target_file = $part_og_pic_link;
            }
        }

        if ($part_og_video_link == $_FILES['part_video_link']) {
           $video_target_file = $part_og_video_link;
        } else {
            if ($_FILES["part_video_link"]['size'] != 0) {
                $target_dir = "uploads/";
                $video_target_file = $target_dir . basename($_FILES["part_video_link"]["name"]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($video_target_file,PATHINFO_EXTENSION));

                // Check if image file is a actual image or fake image

                $check = getimagesize($_FILES["part_video_link"]["tmp_name"]);
                
                // Check if file already exists
                if (file_exists($video_target_file)) {
                  $video_alert = "Sorry, file already exists.";
                  $uploadOk = 0;
                }

                // Check file size
                if ($_FILES["part_video_link"]["size"] > 50000000) {
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
                    
                  if (move_uploaded_file($_FILES["part_video_link"]["tmp_name"], $video_target_file)) {
                    // $video_alert = "The file ". htmlspecialchars( basename( $_FILES["part_video_link"]["name"])). " has been uploaded.";
                  } else {
                    // $video_alert = "Sorry, there was an error uploading your file.";
                  }
                } 
            } else {
                $video_target_file = $part_og_video_link;   
            }
        }

        if ($image_alert != "") {
            $alert .= " Photo Status:".$image_alert;
        } else {

            if ($video_alert != "") {
                $alert .= " Video Status:".$video_alert;
            } else {

                $part_sel_id = $_POST['part_sel_id'];
                $part_ann_entry_no = $_POST['part_ann_entry_no'];
                $part_spn = $_POST['part_spn'];
                $part_drawing_no = $_POST['part_drawing_no'];
                $part_proposed_by = $_POST['part_proposed_by'];
                $part_pic_link = $pic_target_file;
                $part_video_link = $video_target_file;
                $updated_time = date('Y-m-d H:i:s');


                $update_sql = "UPDATE `part_master_five` SET `part_ann_entry_no`='$part_ann_entry_no',`part_spn`='$part_spn',`part_drawing_no`='$part_drawing_no',`part_proposed_by`='$part_proposed_by',`part_updated_time`='$updated_time' WHERE `part_id`='$part_sel_id'";

                if(mysqli_query($conn , $update_sql)) {
                    $alert = "Data Edited Successfully";
                }
                else {
                    $alert = mysqli_error($conn);
                    // echo $alert;
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

    <title>Edit Part Annexure Details</title>

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

    <link rel="stylesheet" href="select2.min.css" />
</head>

<body id="page-top" OnLoad=“LoadValue();”>

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
                            <h6 class="m-0 font-weight-bold float-left text-primary">Edit Part Annexure Details</h6>
                            <a class="float-right font-weight-bold mylink" href="part-master5.php">
                                <i class="fa fa-eye"></i>
                                View Part Annexure Details List
                            </a>                 
                        </div>
                      <?php
                      }
                      else {
                      ?>
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold float-left text-primary">Edit Part Annexure Details</h6>
                            <a class="float-right font-weight-bold mylink" href="part-master5.php">
                                <i class="fa fa-eye"></i>
                                View Part Annexure Details List
                            </a>                 
                        </div>
                      <?php
                      }
                      ?>
                         <form name="myform" enctype="multipart/form-data" class="bootstrap-form-with-validation" action="<?php echo $_SERVER['PHP_SELF'].'?edit_id='.$edit_id; ?>" method="post" onsubmit="return validate()">
                        <?php
                            $select_sql = "SELECT part_master_five.part_id, `part_ann_entry_no`, `part_spn`, `part_drawing_no`, `part_proposed_by`, `part_pic_link`, `part_video_link`, part_master_one.part_id, part_master_one.part_desc FROM `part_master_five` LEFT JOIN `part_master_one` ON part_master_five.part_id = part_master_one.part_id WHERE part_master_five.part_id = '$edit_id'";

                            $result = mysqli_query($conn, $select_sql);

                            // print_r($result);

                            while ($data = mysqli_fetch_assoc($result)) {
                                // print_r($data);
                        ?>
                            <div class="row mt-3 mx-3">
                                <div class="form-group col-md-4">
                                    <label for="part_sel_id">Part:</label>
                                    <select id="part_sel_id" name="part_sel_id" class="form-control mydrpdwn">
                                        <?php
                                            $part_id = $data['part_id'];

                                            $query = "SELECT `part_id`,`part_number`,`part_desc` FROM `part_master_one` WHERE `parT_id` = '$part_id'";
                                            $result = mysqli_query($conn,$query);
                                        
                                            // echo mysqli_error($conn);

                                            // print_r($row);
                         
                                            while($row = mysqli_fetch_array($result) ){
                                            $id = $row['part_id'];
                                            $number = $row['part_number'];
                                            $desc = $row['part_desc'];
                                                // foreach ($row as $i) {  
                                        ?>
                                            <option value="<?php echo $id; ?>"><?php echo $number."-".$desc; ?></option>
                                        <?php
                                                // }
                                            }
                                        ?>
                                        <?php
                                            $query = "SELECT `part_id`,`part_number`,`part_desc` FROM `part_master_one`";
                                            $result = mysqli_query($conn,$query);
                                        
                                            // echo mysqli_error($conn);

                                            // print_r($row);
                         
                                            while($row = mysqli_fetch_array($result) ){
                                            $id = $row['part_id'];
                                            $number = $row['part_number'];
                                            $desc = $row['part_desc'];
                                                // foreach ($row as $i) {  
                                        ?>
                                            <option value="<?php echo $id; ?>"><?php echo $number."-".$desc; ?></option>
                                        <?php
                                                // }
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="part_ann_entry_no">Annexure No.</label>
                                    <select id="part_ann_entry_no" name="part_ann_entry_no" class="form-control mydrpdwn">
                                        <option value="<?php echo $data['part_ann_entry_no']?>">
                                            <?php echo $data['part_ann_entry_no']; ?>
                                                
                                        </option>
                                        <option value="Annex-I - OEM">Annex-I - OEM</option>
                                        <option value="Annex-II - BRANDED">Annex-II - BRANDED</option>
                                        <option value="Annex-IIIB - CUSTOMISE">Annex-IIIB - CUSTOMISE</option>
                                        <option value="Annex-IIIA- OPEN MARKET">Annex-IIIA- OPEN MARKET</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="form-label" for="text-input">Part SPN(Not Mendatory)</label>
                                    <input class="form-control" type="text" id="text-input" name="part_spn" value="<?php echo $data['part_spn']; ?>">
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="form-label" for="text-input">Drawing No.(Not Mendatory)</label>
                                    <input class="form-control" (Not Mendatory)type="text" id="text-input" name="part_drawing_no" value="<?php echo $data['part_drawing_no']; ?>">
                                    
                                </div>
                                <!-- <div class="form-group col-md-4">
                                    <label class="form-label" for="number-input">Specification No.</label>
                                    <input class="form-control" required="required" type="number" id="text-input" name="part_specification_no" step="any" value="<?php echo $data['part_specification_no']; ?>"> 
                                </div> -->
                                <div class="form-group col-md-4">
                                    <label for="part_proposed_by">Proposed By(Not Mendatory)</label>
                                    <select id="part_proposed_by" name="part_proposed_by" class="form-control mydrpdwn">
                                        <?php 
                                            $query = "SELECT `usr_id`,`usr_name` FROM `user_master` WHERE `usr_id` = '".$data['part_proposed_by']."'";
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
                                <div class="form-group col-md-2">
                                    <label class="form-label" for="file-input">Picture<span style="font-size: 12px;">(Not Mendatory)</span></label> 
                                    <!-- <a class="link-blue" src="<?php echo $data['part_pic_link'] ?>">View</a> -->
                                    <input class="form-control" type="file" id="file-input" name="part_pic_link">
                                    <input type="hidden" name="part_og_pic_link" value="<?php echo $data['part_pic_link']; ?>">
                                </div>
                                <div class="form-group col-md-2">
                                    <!-- <label style="visibility: hidden;" class="form-label" for="file-input">Picture</label> -->
                                    <a target="_blank" href="<?php echo $data['part_pic_link'] ?>" class="btn btn-sm btn-primary mt-4">View Image</a>
                                </div>
                                <div class="form-group col-md-2">
                                    <label class="form-label" for="file-input">Video(Not Mendatory)</label>
                                    <input class="form-control" type="file" id="file-input" name="part_video_link">
                                    <input type="hidden" name="part_og_video_link" value="<?php echo $data['part_video_link']; ?>">
                                </div>
                                <div class="form-group col-md-2">
                                    <!-- <label style="visibility: hidden;" class="form-label" for="file-input">Pictureeeee</label> -->
                                    <a target="_blank" href="<?php echo $data['part_video_link'] ?>" class="btn btn-sm btn-primary mt-4"> View Video</a>
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
                        <?php
                            }
                        ?>
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