<?php
    session_start();

    include('connection.php');

    if (isset($_GET['edit_id'])) {
        $edit_id = $_GET['edit_id'];
    }

    $alert = "";
    if (isset($_POST['submit'])) {
        // echo "hi";
        // print_r($_POST);

        $id = $_POST['usr_id'];
        $name = strtoupper($_POST['usr_name']);
        $pass = $_POST['usr_password'];
        $email = $_POST['usr_email'];
        $mobile = $_POST['usr_mobile'];
        $dept = $_POST['usr_dept'];
        $designation = $_POST['usr_designation'];
        $updated_time = date('Y-m-d H:i:s');
        $updated_by = $_SESSION['username'];

        // print_r($_POST);

        $select_sql = "SELECT `usr_password` FROM `user_master` WHERE `usr_id` = '$id'";

        $select_result = mysqli_query($conn, $select_sql);

        // $rec = mysqli_fetch_assoc($select_result);

        while ($rec = mysqli_fetch_assoc($select_result)) {
            // echo "hiii";
            // echo $rec['usr_password'];

            if ($pass == $rec['usr_password']) {

                $update_sql = "UPDATE `user_master` SET `usr_name`='$name', `usr_department`='$dept',`usr_designation`='$designation',`usr_email`='$email',`usr_mobile`='$mobile',`usr_updated_time`='$updated_time',`usr_updated_by`='' WHERE `usr_id` = '$id'";

                if(mysqli_query($conn , $update_sql)) {
                $alert = "Admin Details Edited Successfully";
                }
                else {
                    $alert = mysqli_error($conn);
                }
            } 
            else {
                $new_pass = md5($_POST['usr_password']);

                $update_sql = "UPDATE `user_master` SET `usr_name`='$name', `usr_password` = '$new_pass', `usr_department`='$dept',`usr_designation`='$designation',`usr_email`='$email',`usr_mobile`='$mobile',`usr_updated_time`='$updated_time',`usr_updated_by`='$updated_by' WHERE `usr_id` = '$id'";

                if(mysqli_query($conn , $update_sql)) {
                $alert = "Admin Details Edited Successfully";
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

    <title>Edit Admin Details</title>

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
                            <h6 class="m-0 font-weight-bold float-left text-primary">Edit Admin Details</h6>
                            <!-- <a class="float-right font-weight-bold mylink" href="user-master.php">
                                <i class="fa fa-eye"></i>
                                View User List
                            </a> -->                
                        </div>
                      <?php
                      }
                      else {
                      ?>
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold float-left text-primary">Edit Admin Details</h6>
                            <!-- <a class="float-right font-weight-bold mylink" href="user-master.php">
                                <i class="fa fa-eye"></i>
                                View User List
                            </a> -->              
                        </div>
                      <?php
                      }
                      ?>
                        <form name="myform" class="bootstrap-form-with-validation" action="<?php echo $_SERVER['PHP_SELF'].'?edit_id='.$edit_id; ?>" method="post" onsubmit="return validate()">
                        <?php
                            $select_sql = "SELECT * FROM `user_master` WHERE `usr_id` = '$edit_id'";

                            $result = mysqli_query($conn, $select_sql);

                            while ($data = mysqli_fetch_assoc($result)) {
                        ?>  
                            <div class="row mt-3 mx-3">                           
                                <div class="form-group col-md-4">   
                                    <label class="form-label" for="text-input">Name</label>
                                    <input type="hidden" name="usr_id" value="<?php echo $data['usr_id']; ?>">
                                    <input class="form-control" type="text" id="text-input" name="usr_name" value="<?php echo $data['usr_name']; ?>" required="required">
                                    <span id="nameloc"></span>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="form-label" for="password-input">Password</label>
                                    <input class="form-control" type="password" id="password-input" name="usr_password" value="<?php echo $data['usr_password']; ?>" required="required">
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="form-label" for="email-input">Email</label>
                                    <input class="form-control" type="email" id="email-input" name="usr_email" value="<?php echo $data['usr_email']; ?>" required="required">
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="form-label" for="text-input">Mobile Number</label>
                                    <input class="form-control" type="text" id="text-input-1" name="usr_mobile" value="<?php echo $data['usr_mobile']; ?>" required="required">
                                    <span id="numloc"></span>
                                </div>
                                <div class="form-group mb-3 col-md-4">
                                    <label for="usr_dept">Department</label>
                                    <br>
                                    <select id="usr_dept" name="usr_dept" class="form-control mydrpdwn" required="required">
                                        <option value="<?php echo $data['usr_department']?>"><?php echo $data['usr_department']?></option>
                                        <option value="Dept 1">Dept 1</option>
                                        <option value="Dept 2">Dept 2</option>
                                        <option value="Dept 3">Dept 3</option>
                                        <option value="Dept 4">Dept 4</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3 col-md-4">
                                    <label for="usr_designation">Designation</label>
                                    <br>
                                    <select id="usr_designation" name="usr_designation" class="form-control mydrpdwn" required="required">
                                        <option value="<?php echo $data['usr_designation']?>"><?php echo $data['usr_designation']?></option>
                                        <option value="Designation 1">Des 1</option>
                                        <option value="Designation 2">Des 2</option>
                                        <option value="Designation 3">Des 3</option>
                                        <option value="Designation 4">Des 4</option>
                                    </select>
                                </div>
                               <!--  <div class="form-group mb-3 col-md-4 clearfix">
                                    <label class="form-label float-left">Is Active?</label>
                                <?php
                                    if ($data['usr_is_active'] == 1) {
                                    echo "

                                    <div class='form-check float-left ml-2'>
                                        <input class='form-check-input' type='radio' id='l1_".$data['usr_id']."' name='active_".$data['usr_id']."' value='1' checked>
                                        <label for='l1_".$data['usr_id']."'>Yes</label>
                                    </div>
                                    <div class='form-check float-left ml-2'>
                                        <input class='form-check-input' type='radio' id='l2_".$data['usr_id']."' name='active_".$data['usr_id']."' value='0'>
                                        <label for='l2_".$data['usr_id']."'>No</label>
                                    </div>
                                       
                                      ";
                                    }
                                    else {
                                    echo "

                                    <div class='form-check float-left ml-2'>
                                        <input class='form-check-input' type='radio' id='l1_".$data['usr_id']."' name='active_".$data['usr_id']."' value='1'>
                                        <label for='l1_".$data['usr_id']."'>Yes</label>
                                    </div>
                                    <div class='form-check float-left ml-2'>
                                        <input class='form-check-input' type='radio' id='l2_".$data['usr_id']."' name='active_".$data['usr_id']."' value='0' checked>
                                        <label for='l2_".$data['usr_id']."'>No</label>
                                    </div>
                                        
                                      ";
                                    }
                                ?>  
                            
                                </div>
                                <div class="form-group mb-3 ml-3 clearfix">
                                    <label class="form-label float-left">Is Admin?</label>

                                <?php
                                    if ($data['usr_is_admin'] == 1) {
                                    echo "

                                    <div class='form-check float-left ml-2'>
                                        <input class='form-check-input' type='radio' id='r1_".$data['usr_id']."' name='admin_".$data['usr_id']."' value='1' checked>
                                        <label for='r1_".$data['usr_id']."'>Yes</label>
                                    </div>
                                    <div class='form-check float-left ml-2'>
                                        <input class='form-check-input' type='radio' id='r2_".$data['usr_id']."' name='admin_".$data['usr_id']."' value='0'>
                                        <label for='r2_".$data['usr_id']."'>No</label>
                                    </div>
                                       
                                      ";
                                    }
                                    else {
                                    echo "

                                    <div class='form-check float-left ml-2'>
                                        <input class='form-check-input' type='radio' id='r1_".$data['usr_id']."' name='admin_".$data['usr_id']."' value='1'>
                                        <label for='r1_".$data['usr_id']."'>Yes</label>
                                    </div>
                                    <div class='form-check float-left ml-2'>
                                        <input class='form-check-input' type='radio' id='r2_".$data['usr_id']."' name='admin_".$data['usr_id']."' value='0' checked>
                                        <label for='r2_".$data['usr_id']."'>No</label>
                                    </div>
                                        
                                      ";
                                    }
                                ?>

                                </div> -->
                            </div>
                            <div class="row">
                                <div class="form-group ml-5">
                                    <input class="btn btn-primary" type="submit" name="submit"></input>
                                </div>
                                <!-- <div class="form-group ml-3">
                                    <input class="btn btn-danger" type="reset" name="clear" value="Clear"></input>
                                </div> -->
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

    <script type="text/javascript">
        function validate(){
            
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
            document.getElementById("numloc").innerHTML="";
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
            document.getElementById("numloc").innerHTML="";
          }
        }
      }
    </script>

</body>

</html>
<?php 
    include ('disconnect.php');
?>