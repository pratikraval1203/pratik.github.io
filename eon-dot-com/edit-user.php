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
        $is_active = $_POST['active_'.$id.''];
        $usr_admin_level = $_POST['usr_admin_level'];
        $usr_remarks = $_POST['usr_remarks'];
        $updated_time = date('Y-m-d H:i:s');
        $updated_by = $_SESSION['user_id'];

        // print_r($_POST);

        $select_sql = "SELECT `usr_password` FROM `user_master` WHERE `usr_id` = '$id'";

        $select_result = mysqli_query($conn, $select_sql);

        // $rec = mysqli_fetch_assoc($select_result);

        while ($rec = mysqli_fetch_assoc($select_result)) {
            // echo "hiii";
            // echo $rec['usr_password'];

            if ($pass == $rec['usr_password']) {

                $update_sql = "UPDATE `user_master` SET `usr_name`='$name', `usr_department`='$dept',`usr_designation`='$designation',`usr_email`='$email',`usr_mobile`='$mobile',`usr_admin_level`='$usr_admin_level',`usr_is_active`='$is_active',`usr_updated_time`='$updated_time',`usr_updated_by`='$updated_by' WHERE `usr_id` = '$id'";

                if(mysqli_query($conn , $update_sql)) {
                $alert = "User Details Edited Successfully";
                }
                else {
                    $alert = mysqli_error($conn);
                }
            } 
            else {
                $new_pass = md5($_POST['usr_password']);

                $update_sql = "UPDATE `user_master` SET `usr_name`='$name', `usr_password` = '$new_pass', `usr_department`='$dept',`usr_designation`='$designation',`usr_email`='$email',`usr_mobile`='$mobile',`usr_admin_level`='$usr_admin_level',`usr_is_active`='$is_active',`usr_updated_time`='$updated_time',`usr_updated_by`='$updated_by' WHERE `usr_id` = '$id'";

                if(mysqli_query($conn , $update_sql)) {
                $alert = "User Details Edited Successfully";
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

    <title>Edit User Details</title>

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
                            <h6 class="m-0 font-weight-bold float-left text-primary">Edit User Details</h6>
                            <a class="float-right font-weight-bold mylink" href="user-master.php">
                                <i class="fa fa-eye"></i>
                                View User List
                            </a>                 
                        </div>
                      <?php
                      }
                      else {
                      ?>
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold float-left text-primary">Edit User Details</h6>
                            <a class="float-right font-weight-bold mylink" href="user-master.php">
                                <i class="fa fa-eye"></i>
                                View User List
                            </a>                 
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
                                    <label class="form-label" for="text-input">Username</label>
                                    <input type="hidden" name="usr_id" value="<?php echo $data['usr_id']; ?>">
                                    <input class="form-control" type="text" id="text-input" name="usr_name" value="<?php echo $data['usr_name']; ?>" required="required" autocomplete="off">
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
                                    <?php
                                        if ($_SESSION['admin_level'] == 1 || $_SESSION['admin_level'] == 2) {
                                    ?>
                                        <input id="usr_dept" name="usr_dept" class="form-control mydrpdwn" required="required" type="text" list="department" value="<?php echo $data['usr_department']?>" />
                                        <datalist id="department">
                                            <?php
                                                $query = "SELECT DISTINCT `usr_department` FROM `user_master`";

                                                $result = mysqli_query($conn,$query);
                                            
                                                echo mysqli_error($conn);

                                                while($row = mysqli_fetch_array($result)){
                                                    $usr_department = $row['usr_department'];
                                                ?>
                                                    <option><?php echo $usr_department; ?></option>
                                                <?php
                                                }
                                            ?>
                                        </datalist>
                                    <?php
                                        }   
                                        else {
                                    ?>
                                        <select id="usr_dept" name="usr_dept" class="form-control mydrpdwn" required="required">
                                            <option value="<?php echo $data['usr_department']?>" ><?php echo $data['usr_department']?></option>
                                            <?php
                                                $query = "SELECT DISTINCT `usr_department` FROM `user_master`";

                                                $result = mysqli_query($conn,$query);
                                            
                                                echo mysqli_error($conn);

                                                while($row = mysqli_fetch_array($result)){
                                                    $usr_department = $row['usr_department'];
                                                ?>
                                                    <option><?php echo $usr_department; ?></option>
                                                <?php
                                                }
                                            ?>
                                        </select>
                                    <?php
                                        }
                                    ?>
                                </div>
                                <div class="form-group mb-3 col-md-4">
                                    <label for="usr_designation">Designation</label>
                                    <?php
                                        if ($_SESSION['admin_level'] == 1 || $_SESSION['admin_level'] == 2) {
                                    ?>
                                        <input id="usr_designation" name="usr_designation" class="form-control mydrpdwn" required="required" type="text" list="designation" value="<?php echo $data['usr_designation']?>" />
                                        <datalist id="designation">
                                            <?php
                                                $query = "SELECT DISTINCT `usr_designation` FROM `user_master`";

                                                $result = mysqli_query($conn,$query);
                                            
                                                echo mysqli_error($conn);

                                                while($row = mysqli_fetch_array($result)){
                                                    $usr_designation = $row['usr_designation'];
                                                ?>
                                                    <option><?php echo $usr_designation; ?></option>
                                                <?php
                                                }
                                            ?>
                                        </datalist>
                                    <?php
                                        }   
                                        else {
                                    ?>
                                        <select id="usr_designation" name="usr_designation" class="form-control mydrpdwn" required="required">
                                            <option value="<?php echo $data['usr_designation']?>" ><?php echo $data['usr_designation']?></option>
                                            <?php
                                                $query = "SELECT DISTINCT `usr_designation` FROM `user_master`";

                                                $result = mysqli_query($conn,$query);
                                            
                                                echo mysqli_error($conn);

                                                while($row = mysqli_fetch_array($result)){
                                                    $usr_designation = $row['usr_designation'];
                                                ?>
                                                    <option><?php echo $usr_designation; ?></option>
                                                <?php
                                                }
                                            ?>
                                        </select>
                                    <?php
                                        }
                                    ?>
                                </div>
                                <div class="form-group mb-3 col-md-4">
                                    <label for="admin_level">Admin Level</label>
                                    <select id="admin_level" name="usr_admin_level" class="form-control mydrpdwn" required="">
                                        <?php
                                            $admin_level = $data['usr_admin_level'];
                                            if ($admin_level == 1) {
                                                echo '<option value="1">Level 1</option>';
                                            } elseif ($admin_level == 2) {
                                                echo '<option value="2">Level 2</option>';
                                            } elseif ($admin_level == 3) {
                                                echo '<option value="3">Level 3</option>';
                                            } elseif ($admin_level == 4) {
                                                echo '<option value="4">Level 4</option>';
                                            } elseif ($admin_level == 5) {
                                                echo '<option value="5">View Only</option>';
                                            }
                                        ?>
                                        <option value="1">Level 1</option>
                                        <option value="2">Level 2</option>
                                        <option value="3">Level 3</option>
                                        <option value="4">Level 4</option>
                                        <option value="5">View Only</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-8">
                                    <label class="form-label" for="remarks">Remarks(Not Mendatory)</label>
                                    <input class="form-control" type="text" id="remarks" name="usr_remarks" value="<?php echo $data['usr_remarks']; ?>">
                                    <!-- <span id="numloc"></span> -->
                                </div>
                                <div class="form-group mb-3 col-md-4 clearfix">
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
                                <!-- <div class="form-group mb-3 ml-3 clearfix">
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
    <script type="text/javascript" src="js/myjs.js"></script>


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