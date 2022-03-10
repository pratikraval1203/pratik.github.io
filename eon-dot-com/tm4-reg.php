<?php
    session_start();

    include('connection.php');

    $alert = "";
    $last_name = "";
    $last_catagory = "";
    $append = "";
    $action = "";

    if (isset($_GET['msg'])) {
        $alert = $_GET['msg'];
    }

    if (isset($_POST['final_submit'])) {
        // echo "<pre>";
        // print_r($_POST);
        // echo "</pre>";

        $tm2_id = $_POST['tm2_id'];
        $final_part_id = $_POST['final_part_id'];
        // $tm_catagory = $_POST['tm_catagory'];
        $first_poh_qty = $_POST['first_poh_qty'];
        $second_poh_qty = $_POST['second_poh_qty'];
        $third_poh_qty = $_POST['third_poh_qty'];
        $first_mc = $_POST['first_mc'];
        $second_mc = $_POST['second_mc'];
        $third_mc = $_POST['third_mc'];
        $updated_time = date('Y-m-d H:i:s');
        $updated_by = $_SESSION['user_id'];

        $count1 = count($_POST['final_part_id']);

        for ($i= 0 ; $i < $count1 ; $i++) {
            $first_mc_tm_id = $tm2_id[$i];
            $first_mc_final = $first_mc[$first_mc_tm_id];
            // echo $first_mc_final;
            $second_mc_tm_id = $tm2_id[$i];
            $second_mc_final = $second_mc[$second_mc_tm_id];
            // echo $second_mc_final;
            $third_mc_tm_id = $tm2_id[$i];
            $third_mc_final = $third_mc[$third_mc_tm_id];

            $final_sql = "UPDATE `track_machine_master_two` SET `first_poh_qty`='{$first_poh_qty[$i]}',`first_mc`='$first_mc_final',`second_poh_qty`='{$second_poh_qty[$i]}',`second_mc`='$second_mc_final',`third_poh_qty`='{$third_poh_qty[$i]}',`third_mc`='$third_mc_final',`updated_time`='$updated_time',`updated_by`='$updated_by' WHERE `tm2_id`= '{$tm2_id[$i]}' && `part_id`= '{$final_part_id[$i]}'";

            // echo $final_sql;

            if(mysqli_query($conn , $final_sql)) {
                $alert = "Final Records successfully Inserted";
            }

            if (mysqli_error($conn)) {
                $msg = mysqli_error($conn);
                echo "<script type='text/Javascript'>alert('$msg')</script>";
             } 
        }
        $final_sql2 = "TRUNCATE TABLE  `track_machine_master_two_ex`"; 

            if(mysqli_query($conn , $final_sql2)) {
                // echo "Final Records successfully Deleted";
            }

    }
    elseif (isset($_POST['submit'])) {    

        // $last_name = $_POST['tm_catagory'];

        $tm_sel_id = $_POST['tm_sel_id'];
        $tm_catagory = $_POST['tm_catagory'];
        $part_sel_id = $_POST['part_sel_id'];
        $part_desc = $_POST['part_desc'];
        $first_poh_qty = $_POST['first_poh_qty'];
        $second_poh_qty = $_POST['second_poh_qty'];
        $third_poh_qty = $_POST['third_poh_qty'];
        $first_mc = $_POST['first_mc'];
        $second_mc = $_POST['second_mc'];
        $third_mc = $_POST['third_mc'];
        $updated_time = date('Y-m-d H:i:s');
        $updated_by = $_SESSION['user_id'];

        $sql = "INSERT INTO `track_machine_master_two_ex`(`tm_id`,`tm_catagory`, `part_id`, `tm_part_desc`, `updated_time`, `updated_by`) VALUES ('$tm_sel_id','$tm_catagory','$part_sel_id','$part_desc','$updated_time','$updated_by')";

        if(mysqli_query($conn , $sql)) {
            $alert = "Records successfully Inserted";
        } 
        echo mysqli_error($conn);  
    }

    if (isset($_POST['first_tm_id'])) {
        // echo "string";
        $last_id = $_POST['first_tm_id'];
        $last_catagory = $_POST['first_tm_catagory'];
        // echo $last_id;
        $append = "WHERE track_machine_master_two.tm_id = '$last_id' && track_machine_master_two.tm_catagory = '$last_catagory'";
    } else {
        $append = "WHERE track_machine_master_two.tm_id = 'none' ";
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

    <title>Add Track Machine Wise Part Details</title>

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

        @media print {
          .noprint{
            display:none;
          }
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
                                    Record successfully Insterted/Updated
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
                            <h6 class="m-0 font-weight-bold float-left text-primary">Add Track Machine Wise Part Details</h6>
                            <a class="float-right font-weight-bold mylink" href="track-machine-master2.php">
                                <i class="fa fa-eye"></i>
                                View Track Machine Wise Part Details
                            </a>                 
                        </div>

                        <form name="myform" class="bootstrap-form-with-validation" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" onsubmit="return validate()">
                            <div class="row mx-3 mt-3">
                                <div id="result"></div>
                                <div class="form-group col-md-4">
                                    <label for="tm_sel_id">Track Machine:</label>
                                    <select id="tm_sel_id" name="first_tm_id" class="form-control mydrpdwn">
                                        <?php 
                                            if ($last_id != "") {

                                                $query = "SELECT `tm_id`,`tm_brand`,`tm_type`,`tm_model_no` FROM `track_machine_master_one` WHERE `tm_id`= ".$last_id." ORDER BY `tm_model_no`";
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
                                            }
                                        ?>
                                        <?php 
                                            $query = "SELECT `tm_id`,`tm_brand`,`tm_type`,`tm_model_no` FROM `track_machine_master_one` ORDER BY `tm_model_no`";
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
                                <div class="form-group col-md-4">
                                    <label for="tm_catagory" class="form-label">Catagory</label>
                                    <input type="text" id="tm_catagory" list="catagory" name="first_tm_catagory"  required="" class="form-control" onchange="this.form.submit()" value="<?php echo $last_catagory; ?>" />
                                    <datalist id="catagory">
                                        <?php
                                            $query = "SELECT DISTINCT `tm_catagory` FROM `track_machine_master_two`";

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
                                    <div id="result"></div>
                                </div>
                            </div>
                        </form>
                        <hr>
                        <form name="myform" class="bootstrap-form-with-validation" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" onsubmit="return validate()">
                            <div class="mx-3">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                                        <thead>
                                            <tr>
                                                <th width="4%">Sr</th>
                                                <th width="16%">Item</th>
                                                <th width="26%">Item Desc</th>
                                                <th>1st POH QTY</th>
                                                <th>1st M/C</th>
                                                <th>2nd POH QTY</th>
                                                <th>2nd M/C</th>
                                                <th>3rd POH QTY</th>
                                                <th>3rd M/C</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $sql = "SELECT `tm2_id`, `tm_id`, `tm_catagory`, track_machine_master_two.part_id, `tm_part_desc`, `first_poh_qty`, `first_mc`, `second_poh_qty`, `second_mc`, `third_poh_qty`, `third_mc`, part_master_one.part_id, part_master_one.part_desc, part_master_one.part_number FROM `track_machine_master_two` LEFT JOIN `part_master_one` ON track_machine_master_two.part_id = part_master_one.part_id ".$append;

                                            $result = mysqli_query($conn,$sql);
                                            $count = 0;

                                            while($row = mysqli_fetch_array($result) ){
                                                $count = $count + 1;
                                                $tm2_id = $row['tm2_id'];
                                                $tm_id = $row['tm_id'];
                                                $tm_part_id = $row['part_id'];
                                                $part_desc = $row['part_desc'];
                                                $part_number = $row['part_number'];
                                                $tm_part_desc = $row['tm_part_desc'];
                                                $tm_catagory = $row['tm_catagory'];
                                                $first_poh_qty = $row['first_poh_qty'];
                                                $second_poh_qty = $row['second_poh_qty'];
                                                $third_poh_qty = $row['third_poh_qty'];
                                                $first_mc = $row['first_mc'];
                                                $second_mc = $row['second_mc'];
                                                $third_mc = $row['third_mc'];
                                        ?>
<tr>
    <td>
        <?php echo $count; ?>
        <input type="hidden" name="tm2_id[]" value="<?= $tm2_id ?>">
        <input type="hidden" name="final_part_id[]" value="<?= $tm_part_id ?>">
    </td>
    <td><?php echo $part_number."-".$part_desc; ?></td>
    <td><?php echo $part_desc; ?></td>
    <td>
        <input class="form-control" required="required" type="number" id="first_poh_qty" name="first_poh_qty[]" value="<?php echo $first_poh_qty; ?>">
    </td>
    <td>
        <?php
            if ($first_mc == '1') {
        ?>
            <div class="form-check float-left ml-2">
                <?php 
                    echo '<input class="form-check-input" type="radio" name="first_mc['.$tm2_id.']" id="first_mc_'.$tm2_id.'1" value="1" checked="">
                        <label class="form-check-label" for="first_mc_'.$tm2_id.'1"> Yes</label>';
                ?>
            </div>
            <div class="form-check float-left ml-2">
                <?php
                    echo '<input class="form-check-input" type="radio" name="first_mc['.$tm2_id.']" id="first_mc_'.$tm2_id.'2" value="0">
                <label class="form-check-label" for="first_mc_'.$tm2_id.'2"> No</label>';
                ?>
            </div>
        <?php   
            } else {
        ?>
            <div class="form-check float-left ml-2">
                <?php 
                    echo '<input class="form-check-input" type="radio" name="first_mc['.$tm2_id.']" id="first_mc_'.$tm2_id.'1" value="1">
                        <label class="form-check-label" for="first_mc_'.$tm2_id.'1"> Yes</label>';
                ?>
            </div>
            <div class="form-check float-left ml-2">
                <?php
                    echo '<input class="form-check-input" type="radio" name="first_mc['.$tm2_id.']" id="first_mc_'.$tm2_id.'2" value="0" checked="">
                <label class="form-check-label" for="first_mc_'.$tm2_id.'2"> No</label>';
                ?>
            </div>
        <?php
            }
        ?>
    </td>
    <td>
        <input class="form-control" required="required" type="number" id="second_poh_qty" name="second_poh_qty[]" value="<?php echo $second_poh_qty; ?>">
    </td>
    <td>
        <?php
            if ($second_mc == '1') {
        ?>
            <div class="form-check float-left ml-2">
                <?php 
                    echo '<input class="form-check-input" type="radio" name="second_mc['.$tm2_id.']" id="second_mc_'.$tm2_id.'1" value="1" checked="">
                        <label class="form-check-label" for="second_mc_'.$tm2_id.'1"> Yes</label>';
                ?>
            </div>
            <div class="form-check float-left ml-2">
                <?php
                    echo '<input class="form-check-input" type="radio" name="second_mc['.$tm2_id.']" id="second_mc_'.$tm2_id.'2" value="0">
                <label class="form-check-label" for="second_mc_'.$tm2_id.'2"> No</label>';
                ?>
            </div>
        <?php   
            } else {
        ?>
            <div class="form-check float-left ml-2">
                <?php 
                    echo '<input class="form-check-input" type="radio" name="second_mc['.$tm2_id.']" id="second_mc_'.$tm2_id.'1" value="1">
                        <label class="form-check-label" for="second_mc_'.$tm2_id.'1"> Yes</label>';
                ?>
            </div>
            <div class="form-check float-left ml-2">
                <?php
                    echo '<input class="form-check-input" type="radio" name="second_mc['.$tm2_id.']" id="second_mc_'.$tm2_id.'2" value="0" checked="">
                <label class="form-check-label" for="second_mc_'.$tm2_id.'2"> No</label>';
                ?>
            </div>
        <?php
            }
        ?>
    </td>
    <td>
        <input class="form-control" required="required" type="number" id="third_poh_qty" name="third_poh_qty[]" value="<?php echo $third_poh_qty; ?>">
    </td>
    <td>
        <?php
            if ($third_mc == '1') {
        ?>
            <div class="form-check float-left ml-2">
            <?php 
                echo '<input class="form-check-input" type="radio" name="third_mc['.$tm2_id.']" id="third_mc_'.$tm2_id.'1" value="1" checked="">
                    <label class="form-check-label" for="third_mc_'.$tm2_id.'1"> Yes</label>';
            ?>
        </div>
        <div class="form-check float-left ml-2">
            <?php
                echo '<input class="form-check-input" type="radio" name="third_mc['.$tm2_id.']" id="third_mc_'.$tm2_id.'2" value="0">
            <label class="form-check-label" for="third_mc_'.$tm2_id.'2"> No</label>';
            ?>
        </div>
        <?php   
            } else {
        ?>
            <div class="form-check float-left ml-2">
            <?php 
                echo '<input class="form-check-input" type="radio" name="third_mc['.$tm2_id.']" id="third_mc_'.$tm2_id.'1" value="1">
                    <label class="form-check-label" for="third_mc_'.$tm2_id.'1"> Yes</label>';
            ?>
        </div>
        <div class="form-check float-left ml-2">
            <?php
                echo '<input class="form-check-input" type="radio" name="third_mc['.$tm2_id.']" id="third_mc_'.$tm2_id.'2" value="0" checked="">
            <label class="form-check-label" for="third_mc_'.$tm2_id.'2"> No</label>';
            ?>
        </div>
        <?php
            }
        ?>
    </td>
</tr>


                                        <?php
                                            }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row mx-4 mt-2 mb-3">
                                <div class="form-group">
                                    <input id="vendor2_submit" class="btn btn-success noprint" type="submit" name="final_submit" value="Add Qty Entry"></input>
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="select2.min.js"></script>
    <script>
        $("select").select2( {
            // placeholder: "Select Country"
            // allowClear: true
            } );
    </script>

    <script type="text/javascript">
       //  $('#part_sel_id').on('change', function (e) {
       //  var optionSelected = $("option:selected", this);
       //  var valueSelected = this.value;
       //  var form_field = '#tm_catagory';
       //  var form_field2 = '#part_desc';
       //  var field = 'part_catagory';
       //  var field2 = 'part_desc';

       // // load_data(valueSelected,field,form_field);

       // load_data(valueSelected,field2,form_field2);

       // function load_data(query,field,form_field)
       // {
       //  $.ajax({
       //   url:"fetch-tm2-part-details.php",
       //   method:"POST",
       //   data:{query:query , field:field},
       //   success:function(data)
       //   {
       //    $(form_field).val(data);
       //   }
       //  });
       // }

           // $("#cust_mobile").focus();
        // });

        $('#tm_sel_id').on('change', function (e) {
            var valueSelected = this.value;

            load_data1(valueSelected);

            function load_data1(query)
           {
                $.ajax({
                 url:"fetch-categories.php",
                 method:"POST",
                 data:{query:query},
                 success:function(data)
                 {
                  $('#catagory').html(data);
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