<?php
    session_start();

    include('connection.php');

    $alert = "";
    $last_name = "";
    $append = "";
    $action = "";

    if (isset($_GET['edit_id'])) {
      $edit_id = $_GET['edit_id'];
    }

    if (isset($_GET['msg'])) {
        $alert = $_GET['msg'];
    }

    if (isset($_POST['submit'])) {    

        $tmse_id = $_POST['tmse_id'];
        $tm_sel_id = $_POST['tm_sel_id'];
        $tmse_unique_machine_no = $_POST['tmse_unique_machine_no'];
        $tmse_purchase_date = $_POST['tmse_purchase_date'];
        $tmse_rlway_with = $_POST['tmse_rlway_with'];
        $tmse_division_with = $_POST['tmse_division_with'];
        $tmse_first_poh = $_POST['tmse_first_poh'];
        $tmse_second_poh = $_POST['tmse_second_poh'];
        $tmse_third_poh = $_POST['tmse_third_poh'];
        $tmse_other_work = $_POST['tmse_other_work'];
        $tmse_tdd_1st_poh = $_POST['tmse_tdd_1st_poh'];
        $tmse_tdd_2nd_poh = $_POST['tmse_tdd_2nd_poh'];
        $tmse_tdd_3rd_poh = $_POST['tmse_tdd_3rd_poh'];
        $updated_time = date('Y-m-d');
        $updated_by = $_SESSION['user_id'];


        $sql = "UPDATE `track_machine_schedule_entry` SET `tmse_tm_id`='$tm_sel_id',`tmse_unique_machine_no`='$tmse_unique_machine_no',`tmse_purchase_date`='$tmse_purchase_date',`tmse_rlway_with`='$tmse_rlway_with',`tmse_division_with`='$tmse_division_with',`tmse_first_poh`='$tmse_first_poh',`tmse_second_poh`='$tmse_second_poh',`tmse_third_poh`='$tmse_third_poh',`tmse_other_work`='$tmse_other_work',`tmse_tdd_1st_poh`='$tmse_tdd_1st_poh',`tmse_tdd_2nd_poh`='$tmse_tdd_2nd_poh',`tmse_tdd_3rd_poh`='$tmse_tdd_3rd_poh',`updated_time`='$updated_time',`updated_by`='$updated_by' WHERE `tmse_id`='$tmse_id'";

        // echo $sql;

        if(mysqli_query($conn , $sql)) {
            $alert = "Records successfully Inserted";
        } else {
            echo mysqli_error($conn);  
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

    <title>Edit Schedule Entry Details</title>

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
                                    Record Successfully Inserted
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
                            <h6 class="m-0 font-weight-bold float-left text-primary">Edit Schedule Entry Details</h6>
                            <a class="float-right font-weight-bold mylink" href="schedule-entry.php">
                                <i class="fa fa-eye"></i>
                                View Schedule Entry Details
                            </a>                 
                        </div>

                        <form name="myform" class="bootstrap-form-with-validation" action="<?php echo $_SERVER['PHP_SELF'].'?edit_id='.$edit_id; ?>" method="post" onsubmit="return validate()">
                            <?php
                                $select_sql = "SELECT * FROM `track_machine_schedule_entry` LEFT JOIN `track_machine_master_one` ON track_machine_schedule_entry.tmse_tm_id = track_machine_master_one.tm_id WHERE `tmse_id` = '$edit_id'";

                                $result = mysqli_query($conn, $select_sql);

                                while ($data = mysqli_fetch_assoc($result)) {
                            $tm_id = $data['tm_id'];
                            ?>
                            <div class="row mx-3 mt-3">
                                <div class="form-group col-md-4">
                                    <label for="tm_sel_id">Track Machine:</label>
                                    <select id="tm_sel_id" name="tm_sel_id" class="form-control mydrpdwn">

                                        <?php 
                                            $query = "SELECT `tm_id`,`tm_brand`,`tm_type`,`tm_model_no` FROM `track_machine_master_one` WHERE `tm_id` = '$tm_id' ORDER BY `tm_model_no`";
                                            $result = mysqli_query($conn,$query);
                                        
                                            // echo mysqli_error($conn);

                                            // print_r($row);
                         
                                           while($row = mysqli_fetch_array($result) ){
                                            $id = $row['tm_id'];
                                            $brand = $row['tm_brand'];
                                            $type = $row['tm_type'];
                                            $model_no = $row['tm_model_no'];
                                                // foreach ($row as $i) {  
                                        ?>
                                                <option value="<?php echo $id; ?>"><?php echo $type."-".$brand."-".$model_no; ?></option>
                                        <?php
                                                // }
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-3 mx-3">
                                <div class="form-group col-md-3">
                                    <label for="tmse_unique_machine_no">Unique Machine No.</label>
                                    <!-- <span class="red"></span> -->
                                    <input id="tmse_unique_machine_no" class="form-control" type="text" name="tmse_unique_machine_no" required="required" value="<?php echo $data['tmse_unique_machine_no']; ?>">
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="form-label" for="tmse_purchase_date">Date of Purchase</label>
                                    <input class="form-control mydrpdwn" required="required" type="date" id="tmse_purchase_date" name="tmse_purchase_date"  value="<?php echo $data['tmse_purchase_date']; ?>">
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="form-label" for="tmse_rlway_with">Rlway With</label>
                                    <input class="form-control" required="required" type="text" id="tmse_rlway_with" name="tmse_rlway_with" list="rlway" value="<?php echo $data['tmse_rlway_with']; ?>" />
                                    <datalist id="rlway">
                                        <?php
                                            $query = "SELECT DISTINCT `tmse_rlway_with` FROM `track_machine_schedule_entry` ORDER BY `tmse_rlway_with`";

                                            $result = mysqli_query($conn,$query);
                                        
                                            echo mysqli_error($conn);

                                            while($row = mysqli_fetch_array($result)){
                                                $tmse_rlway_with = $row['tmse_rlway_with'];
                                            ?>
                                                <option><?php echo $tmse_rlway_with; ?></option>
                                            <?php
                                            }
                                        ?>
                                    </datalist>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="form-label" for="tmse_division_with">Division With</label>
                                    <input class="form-control" required="required" type="text" id="tmse_division_with" name="tmse_division_with" list="division" value="<?php echo $data['tmse_division_with']; ?>" />
                                    <datalist id="division">
                                        <?php
                                            $query = "SELECT DISTINCT `tmse_division_with` FROM `track_machine_schedule_entry` ORDER BY `tmse_division_with`";

                                            $result = mysqli_query($conn,$query);
                                        
                                            echo mysqli_error($conn);

                                            while($row = mysqli_fetch_array($result)){
                                                $tmse_division_with = $row['tmse_division_with'];
                                            ?>
                                                <option><?php echo $tmse_division_with; ?></option>
                                            <?php
                                            }
                                        ?>
                                    </datalist>
                                </div>  
                                <div class="form-group col-md-3">
                                    <label class="form-label" for="tmse_first_poh">1st POH Date</label>
                                    <input class="form-control mydrpdwn" required="required" type="date" id="tmse_first_poh" name="tmse_first_poh"  value="<?php echo $data['tmse_first_poh']; ?>">
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="form-label" for="tmse_second_poh">2nd POH Date</label>
                                    <input class="form-control mydrpdwn" required="required" type="date" id="tmse_second_poh" name="tmse_second_poh"  value="<?php echo $data['tmse_second_poh']; ?>">
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="form-label" for="tmse_third_poh">3rd POH Date</label>
                                    <input class="form-control mydrpdwn" required="required" type="date" id="tmse_third_poh" name="tmse_third_poh"  value="<?php echo $data['tmse_third_poh']; ?>">
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="form-label" for="tmse_other_work">Other Work</label>
                                    <input class="form-control mydrpdwn" required="required" type="date" id="tmse_other_work" name="tmse_other_work"  value="<?php echo $data['tmse_other_work']; ?>">
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="form-label" for="tmse_tdd_1st_poh">Tentative Date of Departure from CPOH ADI  AFTER 1ST POH</label>
                                    <input class="form-control mydrpdwn" required="required" type="date" id="tmse_tdd_1st_poh" name="tmse_tdd_1st_poh"  value="<?php echo $data['tmse_tdd_1st_poh']; ?>">
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="form-label" for="tmse_tdd_2nd_poh">Tentative Date of Departure from CPOH ADI  AFTER 2nd POH</label>
                                    <input class="form-control mydrpdwn" required="required" type="date" id="tmse_tdd_2nd_poh" name="tmse_tdd_2nd_poh"  value="<?php echo $data['tmse_tdd_2nd_poh']; ?>">
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="form-label" for="tmse_tdd_3rd_poh">Tentative Date of Departure from CPOH ADI  AFTER 3rd POH</label>
                                    <input class="form-control mydrpdwn" required="required" type="date" id="tmse_tdd_3rd_poh" name="tmse_tdd_3rd_poh"  value="<?php echo $data['tmse_tdd_3rd_poh']; ?>">
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