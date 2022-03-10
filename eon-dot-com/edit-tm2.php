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

        $last_name = $_POST['tm_catagory'];

        $tm2_id = $_POST['tm2_id'];
        $tm_sel_id = $_POST['tm_sel_id'];
        $tm_catagory = $_POST['tm_catagory'];
        $part_sel_id = $_POST['part_sel_id'];
        $part_desc = $_POST['part_desc'];
        // $first_poh_qty = $_POST['first_poh_qty'];
        // $second_poh_qty = $_POST['second_poh_qty'];
        // $third_poh_qty = $_POST['third_poh_qty'];
        // $first_mc = $_POST['first_mc'];
        // $second_mc = $_POST['second_mc'];
        // $third_mc = $_POST['third_mc'];
        $updated_time = date('Y-m-d H:i:s');
        $updated_by = $_SESSION['user_id'];

        // $sql = "UPDATE `track_machine_master_two` SET `tm_id` ='$tm_sel_id',`tm_catagory`='$tm_catagory',`part_id`='$part_sel_id',`tm_part_desc`='$part_desc',`first_poh_qty`='$first_poh_qty',`first_mc`='$first_mc',`second_poh_qty`='$second_poh_qty',`second_mc`='$second_mc',`third_poh_qty`='$third_poh_qty',`third_mc`='$third_mc',`updated_time`='$updated_time',`updated_by`='$updated_by' WHERE `tm2_id`= '$tm2_id'";

        $sql = "UPDATE `track_machine_master_two` SET `tm_id` ='$tm_sel_id',`tm_catagory`='$tm_catagory',`part_id`='$part_sel_id',`tm_part_desc`='$part_desc',`updated_time`='$updated_time',`updated_by`='$updated_by' WHERE `tm2_id`= '$tm2_id'";

        if(mysqli_query($conn , $sql)) {
            $alert = "Records successfully updated";
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

    <title>Edit Track Machine Details</title>

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
                                    Record Edited Successfully
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
                            <h6 class="m-0 font-weight-bold float-left text-primary">Edit Track Machine Details</h6>
                            <a class="float-right font-weight-bold mylink" href="track-machine-master2.php">
                                <i class="fa fa-eye"></i>
                                View Track Machine Details
                            </a>                 
                        </div>

                        <form name="myform" class="bootstrap-form-with-validation" action="<?php echo $_SERVER['PHP_SELF'].'?edit_id='.$edit_id; ?>" method="post" onsubmit="return validate()">
                            <?php
                                $select_sql = "SELECT track_machine_master_two.part_id, `tm2_id`, `tm_id`, `tm_part_desc`, `tm_catagory`, part_master_one.part_id, part_master_one.part_desc FROM `track_machine_master_two` LEFT JOIN `part_master_one` ON track_machine_master_two.part_id = part_master_one.part_id WHERE `tm2_id` = '$edit_id'";

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
                                            $type = $row['tm_type'];
                                                // foreach ($row as $i) {  
                                        ?>
                                                <option value="<?php echo $id; ?>"><?php echo $type; ?></option>
                                        <?php
                                                // }
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-3 mx-3">
                                <div class="form-group col-md-4">
                                    <label for="part_sel_id">Part:</label>
                                    <select id="part_sel_id" name="part_sel_id" class="form-control mydrpdwn">
                                        <option value="<?php echo $data['part_id']; ?>"><?php echo $data['part_desc']; ?></option>
                                        <?php 
                                            $query = "SELECT `part_id`,`part_number`,`part_catagory` FROM `part_master_one` ORDER BY `part_catagory`";
                                            $result = mysqli_query($conn,$query);
                                        
                                            echo mysqli_error($conn);

                                            print_r($row);
                         
                                            while($row = mysqli_fetch_array($result) ){
                                            $id = $row['part_id'];
                                            $number = $row['part_number'];
                                            $catagory = $row['part_catagory'];
                                                // foreach ($row as $i) {  
                                            ?>
                                                <option value="<?php echo $id; ?>"><?php echo $catagory."-".$number; ?></option>
                                            <?php
                                                // }
                                            }
                                            ?>
                                    </select>
                                </div>
                               <!--  <div class="form-group col-md-4">
                                    <label for="part_sel_id">Part:</label>
                                    <select id="part_sel_id" name="part_sel_id" class="form-control mydrpdwn">
                                        <option value="<?php echo $data['part_id']; ?>"><?php echo $data['part_desc']; ?></option>
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
                                </div> -->
                                <div class="form-group col-md-4">
                                    <label for="tm_catagory" class="form-label">Catagory</label>
                                    <input type="hidden" name="tm2_id" value="<?php echo $data['tm2_id']; ?>">
                                    <input type="text" id="tm_catagory" list="catagory" name="tm_catagory"  required="" class="form-control" value="<?php echo $data['tm_catagory']; ?>" readonly="" />
                                    <datalist id="catagory">
                                        <?php
                                            $query = "SELECT DISTINCT `tm_catagory` FROM `track_machine_master_two` ORDER BY `tm_catagory`";

                                            $result = mysqli_query($conn,$query);
                                        
                                            echo mysqli_error($conn);

                                            while($row = mysqli_fetch_array($result)){
                                                $tm_catagory = $row['tm_catagory'];
                                            ?>
                                                <option><?php echo $tm_catagory; ?></option>
                                            <?php
                                            }
                                        ?>
                                    </datalist>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="part_desc">Part Description</label>
                                    <!-- <span class="red"></span> -->
                                    <input id="part_desc" class="form-control" type="text" name="part_desc" required="required" value="<?php echo $data['tm_part_desc']; ?>" readonly="">
                                </div>
                            </div>
                            <div class="row mx-4 mt-2 mb-3">
                                <div class="form-group">
                                    <input id="vendor2_submit" class="btn btn-success" type="submit" name="submit" value="Edit Track Machine"></input>
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
        $('#part_sel_id').on('change', function (e) {
        var optionSelected = $("option:selected", this);
        var valueSelected = this.value;
        var form_field = '#tm_catagory';
        var form_field2 = '#part_desc';
        var field = 'part_catagory';
        var field2 = 'part_desc';

       load_data(valueSelected,field,form_field);

       load_data(valueSelected,field2,form_field2);

       function load_data(query,field,form_field)
       {
        $.ajax({
         url:"fetch-tm2-part-details.php",
         method:"POST",
         data:{query:query , field:field},
         success:function(data)
         {
          $(form_field).val(data);
         }
        });
       }

           // $("#cust_mobile").focus();
        });
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