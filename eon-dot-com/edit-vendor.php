<?php 
  session_start();

  include ('connection.php');

  if (isset($_GET['edit_id'])) {
    $edit_id = $_GET['edit_id'];
  }

  $alert= "";
  if(isset($_POST['submit'])){
    // print_r($_POST);
    
    $ven_id = $_POST['ven_id'];
    $ven_name = $_POST['ven_name'];
    $ven_code = $_POST['ven_code'];
    $ven_type = $_POST['ven_type'];
    $ven_email = $_POST['ven_email'];
    $ven_mobile = $_POST['ven_mobile'];
    $ven_website = $_POST['ven_website'];
    $ven_address = $_POST['ven_address'];
    $ven_grade = $_POST['ven_grade'];
    $is_active = $_POST['active_'.$ven_id.''];
    $updated_time = date('Y-m-d H:i:s');
    $updated_by = $_SESSION['user_id'];


    $update_sql = "UPDATE `vendor_master` SET `ven_name`='$ven_name',`ven_code`='$ven_code',`ven_type`='$ven_type',`ven_email`='$ven_email',`ven_mobile`='$ven_mobile',`ven_website`='$ven_website',`ven_address`='$ven_address',`ven_grade`='$ven_grade',`ven_is_active`='$is_active',`ven_updated_time`='$updated_time',`ven_updated_by`='$updated_by' WHERE `ven_id`='$ven_id'";

    if(mysqli_query($conn , $update_sql)) {
        $alert = "Vendor Details Edited Successfully";
    }
    else {
        $alert = mysqli_error($conn);
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

    <title>Edit Vendor Details</title>

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
                            <h6 class="m-0 font-weight-bold float-left text-primary">Edit Vendor Details</h6>
                            <a class="float-right font-weight-bold mylink" href="vendor-master.php">
                                <i class="fa fa-eye"></i>
                                View Vendor List
                            </a>                 
                        </div>
                      <?php
                      }
                      else {
                      ?>
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold float-left text-primary">Edit Vendor Details</h6>
                            <a class="float-right font-weight-bold mylink" href="vendor-master.php">
                                <i class="fa fa-eye"></i>
                                View Vendor List
                            </a>                 
                        </div>
                      <?php
                      }
                      ?>

                      <form name="myform" action="<?php echo $_SERVER['PHP_SELF'].'?edit_id='.$edit_id; ?>" method="post" onsubmit="return validate()">

                        <?php
                            $select_sql = "SELECT * FROM `vendor_master` WHERE `ven_id` = '$edit_id'";

                            $result = mysqli_query($conn, $select_sql);

                            while ($data = mysqli_fetch_assoc($result)) {
                        ?>
                        <div class="row mt-3 mx-3">
                            <div class="form-group col-md-4">
                                <label class="">Vednor Name</label>
                                <!-- <span class="red"></span> -->
                                <input type="hidden" name="ven_id" value="<?php echo $data['ven_id']; ?>">
                                <input class="form-control" type="text" name="ven_name" required="required" value="<?php echo $data['ven_name']; ?>">
                                <!-- <span id="nameloc"></span> -->
                            </div>
                            <div class="form-group col-md-4">
                                <!-- <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">@</span>
                                  </div>
                                  <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                                </div> -->
                                <label class="">Vednor Code</label>
                                <!-- <span class="red"></span> -->
                                <input class="form-control" type="text" name="ven_code" required="required" value="<?php echo $data['ven_code']; ?>">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Vednor Type</label>
                                <select type="text" name="ven_type"  required="" class="form-control mydrpdwn">
                                    <option value="<?php echo $data['ven_type']; ?>"><?php echo $data['ven_type']; ?></option>
                                    <option value="Vendor">Vendor</option>
                                    <option value="Contractor">Contractor</option>
                                    <option value="Repairer">Repairer</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="">Email</label>
                                <!-- <span class="red"></span> -->
                                <input class="form-control" type="email" name="ven_email" required="required" value="<?php echo $data['ven_email']; ?>">
                            </div>
                            <div class="form-group col-md-3">
                                <label class="">Mobile</label>
                                <!-- <span class="red"></span> -->
                                <input class="form-control" type="text" name="ven_mobile" required="required" value="<?php echo $data['ven_mobile']; ?>">
                                <span id="numloc"></span>
                            </div>
                            <div class="form-group col-md-5">
                                <label class="">Website(Not Mendatory)</label>
                                <!-- <span class="red"></span> -->
                                <input class="form-control" type="text" name="ven_website" value="<?php echo $data['ven_website']; ?>">
                            </div>
                            <div class="form-group col-md-9">
                                <label class="">Address</label>
                                <!-- <span class="red"></span> -->
                                <input class="form-control" type="text" name="ven_address" value="<?php echo $data['ven_address']; ?>">
                            </div><div class="form-group col-md-3">
                                <label class="">Vednor Grade(Not Mendatory)</label>
                                <!-- <span class="red"></span> --><!-- 
                                <input class="form-control" type="text" name="ven_grade" required="required" value="<?php echo $data['ven_grade']; ?>"> -->
                                <?php
                                    if ($_SESSION['admin_level'] == 1 || $_SESSION['admin_level'] == 2) {
                                ?>
                                    <input type="text" list="grade" name="ven_grade" class="form-control mydrpdwn" value="<?php echo $data['ven_grade']; ?>">
                                    <datalist id="grade">
                                        <?php
                                            $query = "SELECT DISTINCT `ven_grade` FROM `vendor_master`";

                                            $result = mysqli_query($conn,$query);
                                        
                                            echo mysqli_error($conn);

                                            while($row = mysqli_fetch_array($result)){
                                                $ven_grade = $row['ven_grade'];
                                            ?>
                                                <option><?php echo $ven_grade; ?></option>
                                            <?php
                                            }
                                        ?>
                                    </datalist>
                                <?php
                                    }   
                                    else {
                                ?>
                                    <select id="ven_grade" name="ven_grade" class="form-control mydrpdwn" required="required">
                                        <option value="<?php echo $data['ven_grade']; ?>"><?php echo $data['ven_grade']; ?></option>
                                        <?php
                                            $query = "SELECT DISTINCT `ven_grade` FROM `vendor_master`";

                                            $result = mysqli_query($conn,$query);
                                        
                                            echo mysqli_error($conn);

                                            while($row = mysqli_fetch_array($result)){
                                                $ven_grade = $row['ven_grade'];
                                            ?>
                                                <option><?php echo $ven_grade; ?></option>
                                            <?php
                                            }
                                        ?>
                                    </select>
                                <?php
                                    }
                                ?>
                            </div>
                            <div class="form-group mb-3 col-md-4 clearfix">
                                    <label class="form-label float-left">Is Active?</label>
                                <?php
                                    if ($data['ven_is_active'] == 1) {
                                    echo "

                                    <div class='form-check float-left ml-2'>
                                        <input class='form-check-input' type='radio' id='l1_".$data['ven_id']."' name='active_".$data['ven_id']."' value='1' checked>
                                        <label for='l1_".$data['ven_id']."'>Yes</label>
                                    </div>
                                    <div class='form-check float-left ml-2'>
                                        <input class='form-check-input' type='radio' id='l2_".$data['ven_id']."' name='active_".$data['ven_id']."' value='0'>
                                        <label for='l2_".$data['ven_id']."'>No</label>
                                    </div>
                                       
                                      ";
                                    }
                                    else {
                                    echo "

                                    <div class='form-check float-left ml-2'>
                                        <input class='form-check-input' type='radio' id='l1_".$data['ven_id']."' name='active_".$data['ven_id']."' value='1'>
                                        <label for='l1_".$data['ven_id']."'>Yes</label>
                                    </div>
                                    <div class='form-check float-left ml-2'>
                                        <input class='form-check-input' type='radio' id='l2_".$data['ven_id']."' name='active_".$data['ven_id']."' value='0' checked>
                                        <label for='l2_".$data['ven_id']."'>No</label>
                                    </div>
                                        
                                      ";
                                    }
                                ?>  
                            
                                </div>   
                        </div>
                        <div class="row mx-3">
                            <div class="form-group ml-2 mb-3">
                                <input type="submit" id="submit" name="submit" class="btn btn-primary">
                                <!-- <input type="reset" id="clear" name="clear" value="clear" class="btn btn-danger ml-2"> -->
                                <!-- <i class="fas fa-calendar input-prefix" tabindex=0></i> -->
                            </div>
                        </div>
                      <?php
                          }   
                      ?>
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
    <script type="text/javascript" src="js/myjs.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="select2.min.js"></script>
    <script>
        $("select").select2( {
            // placeholder: "Select Country"
            // allowClear: true
            } );
    </script>

    <script type="text/javascript" src="js/myjs.js"></script>

    <script type="text/javascript">
        function validate(){
            
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
            document.getElementById("nameloc").innerHTML="";
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
            document.getElementById("nameloc").innerHTML="";
          }
        }
      }
    </script>

</body>

</html>
<?php 
    include ('disconnect.php');
?>