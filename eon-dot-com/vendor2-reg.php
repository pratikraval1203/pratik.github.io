 <?php
    session_start();

    include('connection.php');

    $alert = "";
    $last_id = "";
    $last_name = "";
    $append = "";
    $action = "";

    if (isset($_GET['msg'])) {
        $alert = $_GET['msg'];
    }

    if (isset($_GET['change_id'])) {
        $last_id = $_GET['change_id'];
    }

    if (isset($_POST['final_submit'])) {

        $final_id = $_POST['final_id'];
        $final_cp_name = $_POST['final_cp_name'];
        $final_cp_dept = $_POST['final_cp_dept'];
        $final_cp_designation = $_POST['final_cp_designation'];
        $final_cp_email = $_POST['final_cp_email'];
        $final_cp_mobile = $_POST['final_cp_mobile'];
        $final_cp_address = $_POST['final_cp_address'];
        $updated_time = date('Y-m-d H:i:s');
        $updated_by = $_SESSION['user_id'];

        $count1 = count($_POST['final_id']);

        for ($i= 0 ; $i < $count1 ; $i++) {
            $final_sql = "INSERT INTO `vendor_master_two`(`ven_id`, `cp_name`, `cp_dept`, `cp_designation`, `cp_mobile`, `cp_email`, `cp_address`, `updated_time`, `updated_by`) VALUES ('{$final_id[$i]}','{$final_cp_name[$i]}','{$final_cp_dept[$i]}','{$final_cp_designation[$i]}','{$final_cp_mobile[$i]}','{$final_cp_email[$i]}','{$final_cp_address[$i]}','$updated_time',$updated_by)";

            if (mysqli_error($conn)) {
                $msg = mysqli_error($conn);
                echo "<script type='text/Javascript'>alert('$msg')</script>";
             } 

            if(mysqli_query($conn , $final_sql)) {
                    $alert = "Final Records successfully Inserted";
                } 
        }
        $final_sql2 = "TRUNCATE TABLE  `vendor_master_two_ex`"; 

            if(mysqli_query($conn , $final_sql2)) {
                // echo "Final Records successfully Deleted";
            }

    }
    elseif (isset($_POST['submit'])) {

        // print_r($_POST);
    

        $last_id = $_POST['ven_sel_id'];

        $ven_sel_id = $_POST['ven_sel_id'];
        $cp_name = $_POST['cp_name'];
        $cp_dept = $_POST['cp_dept'];
        $cp_designation = $_POST['cp_designation'];
        $cp_email = $_POST['cp_email'];
        $cp_mobile = $_POST['cp_mobile'];
        $cp_address = $_POST['cp_address'];
        $updated_time = date('Y-m-d H:i:s');
        $updated_by = $_SESSION['user_id'];

        $sql = "INSERT INTO `vendor_master_two_ex`(`ven_id`, `cp_name`, `cp_dept`, `cp_designation`, `cp_mobile`, `cp_email`, `cp_address`, `updated_time`, `updated_by`) VALUES ('$ven_sel_id','$cp_name','$cp_dept','$cp_designation','$cp_mobile','$cp_email','$cp_address','$updated_time',$updated_by)";

        if(mysqli_query($conn , $sql)) {
            $alert = "Records successfully Inserted";
        } 
        echo mysqli_error($conn);  
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

    <title>Add Vendor Contact Person Details</title>

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

    <style type="text/css">
        .half {
            width: 40%;
            float: left;
            padding: 2%;
            /*border : black solid 1px;*/
        }
        .quater {
            width: 20%;
            float: left;
            padding: 5%;
        }
        #part_master3 , #part_master32 {
            /*border : solid 1px black;*/
        }
        .clear {
            width: auto;
            clear: both;
        }

        input {
            border: 0;
        }

        label {
            display: revert;
            margin-bottom: 50px;
        }
    </style>

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
                            <h6 class="m-0 font-weight-bold float-left text-primary">Add Contact Person Details</h6>
                            <a class="float-right font-weight-bold mylink" href="vendor-master2.php">
                                <i class="fa fa-eye"></i>
                                View Contact Person List
                            </a>                 
                        </div>

                        <form name="myform" class="bootstrap-form-with-validation" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" onsubmit="return validate()">
                            <div class="row mx-3 mt-3">
                                <div class="form-group col-md-4">
                                    <label for="ven_sel_id" class="form-label">Vendor:</label>
                                    <select id="ven_sel_id" class="mydrpdwn form-control" name="ven_sel_id" required="required">
                                        <!-- I took out onchange="self.location= 'vendor2-reg.php?change_id='+this.selectedIndex" from select -->
                                        <?php

                                            if ($last_id == "") {
                                                $last_name = "";
                                            } else {
                                                $query = "SELECT `ven_id`,`ven_name` FROM `vendor_master` WHERE ven_id = '$last_id'";

                                                $result1 = mysqli_query($conn,$query);

                                                while($row = mysqli_fetch_array($result1)) {
                                                    $id = $row['ven_id'];
                                                    $name = $row['ven_name'];
                                                    if ($last_id == $id) {
                                                        $last_name = $name;
                                                    }
                                                }
                                            }
                                        ?>
                                            <option value="<?php echo $id; ?>"><?php echo $last_name; ?></option>
                                        <?php

                                            $query = "SELECT `ven_id`,`ven_name` FROM `vendor_master` ORDER BY `ven_name`";

                                            $result = mysqli_query($conn,$query);
                                        
                                            echo mysqli_error($conn);

                                            while($row = mysqli_fetch_array($result)){
                                                $id = $row['ven_id'];
                                                $name = $row['ven_name'];
                                            ?>
                                                <option value="<?php echo $id; ?>"><?php echo $name; ?></option>
                                            <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-3 mx-3">
                                <div class="form-group col-md-4">
                                    <label class="">Contact Person Name</label>
                                    <!-- <span class="red"></span> -->
                                    <input class="form-control" type="text" name="cp_name" required="required">
                                    <span id="nameloc"></span>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="">Department</label>
                                    <?php
                                        if ($_SESSION['admin_level'] == 1 || $_SESSION['admin_level'] == 2) {
                                    ?>
                                        <input type="text" list="department" name="cp_dept" required="" class="form-control" />
                                        <datalist id="department">
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
                                        </datalist>
                                    <?php
                                        }   
                                        else {
                                    ?>
                                        <select name="cp_dept" required="required" class="form-control">
                                            <option value="" selected="" disabled=""></option>
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
                                        <input type="text" list="designation" name="cp_designation" required="" class="form-control" />
                                        <datalist id="designation">
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
                                        </datalist>
                                    <?php
                                        }   
                                        else {
                                    ?>
                                        <select name="cp_designation" class="form-control" required="required">
                                            <option value="" selected="" disabled=""></option>
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
                                    <input class="form-control" type="email" name="cp_email" required="required">
                                </div>
                                <div class="form-group col-md-2">
                                    <label class="">Mobile</label>
                                    <!-- <span class="red"></span> -->
                                    <input class="form-control" type="text" name="cp_mobile" required="required">
                                    <span id="numloc"></span>
                                </div>
                                <div class="form-group col-md-7">
                                    <label class="">Address(Not Mandatory)</label>
                                    <!-- <span class="red"></span> -->
                                    <input class="form-control" type="text" name="cp_address">
                                </div>
                            </div>
                            <div class="row mx-4 mt-2 mb-3">
                                <div class="form-group">
                                    <input id="vendor2_submit" class="btn btn-success" type="submit" name="submit" value="Add Contact Person"></input>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.card mb-4 shadow -->

                    <div class="card mb-4 shadow">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold float-left text-primary">Added Contact Person List</h6>
                            <!-- <a class="float-right font-weight-bold mylink" href="part-master3.php">
                                <i class="fa fa-eye"></i>
                                View Part Master 3 List
                            </a>   -->               
                        </div>
                        <!-- <caption>Temp Database Data</caption> -->
                        <form id="part_master32" class="bootstrap-form-with-validation" action="<?php $action ?>" method="post">
                            <div class="table-responsive">
                                <table class="table table-bordered nowrap" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr style='background: whitesmoke;'>
                                            <th>Vendor Name</th>
                                            <th>Contact Person Name</th>
                                            <th>Mobile</th>
                                            <th>Email</th>
                                            <th>Department</th>
                                            <th>Designation</th>
                                            <th>Address</th>
                                            <th>Delete</th>      
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 

                                        $sql = "SELECT vendor_master_two_ex.ven_id, `vm2_id`, `cp_name`, `cp_dept`, `cp_designation`, `cp_mobile`, `cp_email`, `cp_address`, vendor_master.ven_id, vendor_master.ven_name FROM `vendor_master_two_ex` LEFT JOIN `vendor_master` ON vendor_master_two_ex.ven_id = vendor_master.ven_id ORDER BY `vm2_id` DESC";

                                        $result = mysqli_query($conn,$sql);

                                        while($row = mysqli_fetch_array($result) ){
                                            $vm2_id = $row['vm2_id'];
                                            $ven_id = $row['ven_id'];
                                            $ven_name = $row['ven_name'];
                                            $cp_name = $row['cp_name'];
                                            $cp_mobile = $row['cp_mobile'];
                                            $cp_dept = $row['cp_dept'];
                                            $cp_designation = $row['cp_designation'];
                                            $cp_email = $row['cp_email'];
                                            $cp_address = $row['cp_address'];
                                        ?>
                                            <tr>
                                                <td>
                                                    <!-- <input type='checkbox' name='update[]' value='<?= $part_id ?>'> -->
                                                    <input type="hidden" name="final_id[]" value="<?= $ven_id ?>">
                                                    <input type="hidden" name="vm2_id[]" value="<?= $vm2_id ?>">
                                                    <input type='text' name='final_ven_name[]>' value='<?= $ven_name ?>' readonly>
                                                </td>
                                                <td><input type='text' name='final_cp_name[]' value='<?= $cp_name ?>'></td>
                                                <td><input type='text' name='final_cp_mobile[]' value='<?= $cp_mobile ?>'></td>
                                                <td><input type='email' name='final_cp_email[]>' value='<?= $cp_email ?>'></td>
                                                <td><input type='text' name='final_cp_dept[]>' value='<?= $cp_dept ?>'></td>
                                                <td><input type='text' name='final_cp_designation[]>' value='<?= $cp_designation ?>'></td>
                                                <td><input type='text' name='final_cp_address[]>' value='<?= $cp_address ?>'></td>
                                                <td>
                                                    <?php
                                                        echo "<a class='btn btn-danger' href='del-vendor2.php?delete_id=".$vm2_id."&change_id=".$ven_id."&table=temp'>Delete</a>";
                                                    ?>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="4">
                                                <input class="btn btn-primary" type="submit" name="final_submit" value="Final Submit">
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </form>
                    </div>
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