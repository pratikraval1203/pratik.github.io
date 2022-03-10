<?php
    session_start();

    include('connection.php');

    $alert = "";

    if (isset($_GET['edit_id'])) {
        $edit_id = $_GET['edit_id'];
    }
    
    if (isset($_POST['submit'])) {

        $vm2_id = $_POST['vm2_id'];
        $ven_sel_id = $_POST['ven_sel_id'];
        $cp_name = $_POST['cp_name'];
        $cp_dept = $_POST['cp_dept'];
        $cp_designation = $_POST['cp_designation'];
        $cp_email = $_POST['cp_email'];
        $cp_mobile = $_POST['cp_mobile'];
        $cp_address = $_POST['cp_address'];
        $updated_time = date('Y-m-d H:i:s');
        $updated_by = $_SESSION['user_id'];

        $sql = "UPDATE `vendor_master_two` SET `ven_id`='$ven_sel_id',`cp_name`='$cp_name',`cp_dept`='$cp_dept',`cp_designation`='$cp_designation',`cp_mobile`='$cp_mobile',`cp_email`='$cp_email',`cp_address`='$cp_address',`updated_time`='$updated_time', `updated_by`='$updated_by' WHERE `vm2_id`='$vm2_id'";

        // echo $sql;

        if(mysqli_query($conn , $sql)) {
            $alert = "Records successfully updated";
        } 
        if (mysqli_error($conn)) {
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

    <title>Edit Contact Person Details</title>

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
                        if ($alert == "Records successfully Inserted") {
                           echo '<div class="alert alert-success" role="alert">
                                    Record Added
                                </div>';
                        } elseif ($alert == "Final Records successfully Inserted") {
                            echo'<div class="alert alert-success" role="alert">
                                    Record successfully Insterted
                                </div>';
                        } elseif ($alert == "Records successfully updated") {
                            echo '<div class="alert alert-success" role="alert">
                                    Record Successfully Updated
                                </div>';
                        } elseif ($alert == "Records successfully deleted") {
                            echo '<div class="alert alert-success" role="alert">
                                    Record Successfully Deleted
                                </div>';
                        }
                      ?>
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold float-left text-primary">Edit Contact Person Details</h6>
                            <a class="float-right font-weight-bold mylink" href="vendor-master2.php">
                                <i class="fa fa-eye"></i>
                                View Contact Person List
                            </a>                 
                        </div>

                        <form name="myform" class="bootstrap-form-with-validation" action="<?php echo $_SERVER['PHP_SELF'].'?edit_id='.$edit_id; ?>" method="post" onsubmit="return validate()">
                            <?php
                                $select_sql = "SELECT vendor_master_two.ven_id, `vm2_id`, `cp_name`, `cp_dept`, `cp_designation`, `cp_mobile`, `cp_email`, `cp_address`, vendor_master.ven_id, vendor_master.ven_name FROM `vendor_master_two` LEFT JOIN `vendor_master` ON vendor_master_two.ven_id = vendor_master.ven_id WHERE vendor_master_two.vm2_id = '$edit_id'";

                                $result = mysqli_query($conn, $select_sql);

                                while ($data = mysqli_fetch_assoc($result)) {
                            ?>
                            <div class="row mx-3 mt-3">
                                <div class="form-group col-md-4">
                                    <input type="hidden" name="vm2_id" value="<?php echo $data['vm2_id'] ?>">
                                    <label for="ven_sel_id" class="form-label">Vendor:</label>
                                    <select id="ven_sel_id" class="mydrpdwn form-control" name="ven_sel_id" required="required">
                                        <option value="<?php echo $data['ven_id'] ?>"><?php echo $data['ven_name'] ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-3 mx-3">
                                <div class="form-group col-md-4">
                                    <label class="">Contact Person Name</label>
                                    <!-- <span class="red"></span> -->
                                    <input class="form-control" type="text" name="cp_name" required="required" value="<?php echo $data['cp_name'] ?>">
                                    <span id="nameloc"></span>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="">Department</label>
                                    <?php
                                        if ($_SESSION['admin_level'] == 1 || $_SESSION['admin_level'] == 2) {
                                    ?>
                                        <input type="text" list="department" name="cp_dept"  required="" class="form-control" value="<?php echo $data['cp_dept'] ?>" />
                                        <datalist id="department">
                                            <?php
                                                $query = "SELECT `cp_dept` FROM `vendor_master_two`";

                                                $result = mysqli_query($conn,$query);
                                            
                                                echo mysqli_error($conn);

                                                while($row = mysqli_fetch_array($result)){
                                                    $department = $row['cp_dept'];
                                                ?>
                                                    <option><?php echo $department; ?></option>
                                                <?php
                                                }
                                            ?>
                                        </datalist>
                                    <?php
                                        }   
                                        else {
                                    ?>
                                        <select iname="cp_dept"  required="required" class="form-control mydrpdwn">
                                            <option  value="<?php echo $data['cp_dept'] ?>"><?php echo $data['cp_dept'] ?></option>
                                            <?php
                                                $query = "SELECT DISTINCT `cp_dept` FROM `vendor_master_two`";

                                                $result = mysqli_query($conn,$query);
                                            
                                                echo mysqli_error($conn);

                                                while($row = mysqli_fetch_array($result)){
                                                    $department = $row['cp_dept'];
                                                ?>
                                                    <option><?php echo $department; ?></option>
                                                <?php
                                                }
                                            ?>
                                        </select>
                                    <?php
                                        }
                                    ?>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="">Designation</label>
                                    <?php
                                        if ($_SESSION['admin_level'] == 1 || $_SESSION['admin_level'] == 2) {
                                    ?>
                                        <input type="text" list="designation" name="cp_designation" required="" class="form-control" value="<?php echo $data['cp_designation'] ?>" />
                                        <datalist id="designation">
                                            <?php
                                                $query = "SELECT `cp_designation` FROM `vendor_master_two`";

                                                $result = mysqli_query($conn,$query);
                                            
                                                echo mysqli_error($conn);

                                                while($row = mysqli_fetch_array($result)){
                                                    $designation = $row['cp_designation'];
                                                ?>
                                                    <option><?php echo $designation; ?></option>
                                                <?php
                                                }
                                            ?>
                                        </datalist>
                                    <?php
                                        }   
                                        else {
                                    ?>
                                        <select name="cp_designation" required="required" class="form-control mydrpdwn">
                                            <option value="<?php echo $data['cp_designation'] ?>"><?php echo $data['cp_designation'] ?></option>
                                            <?php
                                                $query = "SELECT DISTINCT `cp_designation` FROM `vendor_master_two`";

                                                $result = mysqli_query($conn,$query);
                                            
                                                echo mysqli_error($conn);

                                                while($row = mysqli_fetch_array($result)){
                                                    $designation = $row['cp_designation'];
                                                ?>
                                                    <option><?php echo $designation; ?></option>
                                                <?php
                                                }
                                            ?>
                                        </select>
                                    <?php
                                        }
                                    ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="">Email</label>
                                    <!-- <span class="red"></span> -->
                                    <input class="form-control" type="email" name="cp_email" required="required" value="<?php echo $data['cp_email'] ?>">
                                </div>
                                <div class="form-group col-md-2">
                                    <label class="">Mobile</label>
                                    <!-- <span class="red"></span> -->
                                    <input class="form-control" type="text" name="cp_mobile" required="required" value="<?php echo $data['cp_mobile'] ?>">
                                    <span id="numloc"></span>
                                </div>
                                <div class="form-group col-md-7">
                                    <label class="">Address(Not Mendatory)</label>
                                    <!-- <span class="red"></span> -->
                                    <input class="form-control" type="text" name="cp_address" value="<?php echo $data['cp_address'] ?>">
                                </div>
                            </div>
                            <div class="row mx-4 mt-2 mb-3">
                                <div class="form-group">
                                    <input id="vendor2_submit" class="btn btn-success" type="submit" name="submit" value="Submit"></input>
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
            var name = document.myform.cp_name.value;
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
        var num=document.myform.cp_mobile.value;
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