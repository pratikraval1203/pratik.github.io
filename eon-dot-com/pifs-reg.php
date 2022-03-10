<?php
    session_start();

    $issue_id = 1;

    include('connection.php');

    $alert = "";
    $last_id = "";
    $last_name = "";
    $append = "";
    $action = "";

    $temp_issue_id = "";
    $temp_issue_date = "";
    $temp_auth_person = "";
    $temp_remarks = "";

    if (isset($_GET['msg'])) {
        $alert = $_GET['msg'];
    }

    if (isset($_GET['change_id'])) {
        $last_id = $_GET['change_id'];
        // echo $last_id;
        // $append = "WHERE part_master_.part_id = '$last_id' ";
    } else {
        $append = "";
    }
    $action = $_SERVER['PHP_SELF']."?change_id=".$last_id;

    if (isset($_POST['final_submit'])) {

        $final_issue_id = $temp_issue_id;
        $final_issue_date = $temp_issue_date;
        $final_auth_person = $temp_auth_person;
        $final_remarks = $temp_remarks;
        $updated_time = date('Y-m-d H:i:s');
        $updated_by = $_SESSION['user_id'];

        $insert_main = "INSERT INTO `part_issue_from_store`(`pifs_id`, `pifs_date`, `pifs_auth_person`, `pifs_remarks`, `updated_time`, `updated_by`, `fin_year`) VALUES ('$final_issue_id','$final_issue_date','$final_auth_person','$final_remarks','$updated_time','$updated_by','2021-22')";


        $final_part_id = $_POST['final_part_id'];
        $final_part_qty = $_POST['final_part_qty'];
        $final_storage_location = $_POST['final_storage_location'];
        $updated_time = date('Y-m-d H:i:s');
        $updated_by = $_SESSION['user_id'];

        $count1 = count($_POST['final_part_id']);

        for ($i= 0 ; $i < $count1 ; $i++) {
            $final_sql = "INSERT INTO `pifs_entries`( `pifs_id`, `part_id`, `part_qty`, `part_storage_location`, `updated_time`, `updated_by`, `fin_year`) VALUES ('$temp_issue_id','{$final_part_id[$i]}','{$final_part_qty[$i]}','{$final_storage_location[$i]}','$updated_time','$updated_by','2021-22')";

            if (mysqli_error($conn)) {
                $msg = mysqli_error($conn);
                echo "<script type='text/Javascript'>alert('$msg')</script>";
             } 

            if(mysqli_query($conn , $final_sql)) {
                    $alert = "Final Records successfully Inserted";
                } 
        }
        // $final_sql2 = "TRUNCATE TABLE  `pifs_entries_ex`"; 

            if(mysqli_query($conn , $final_sql2)) {
                // echo "Final Records successfully Deleted";
            }

    }
    elseif (isset($_POST['submit'])) {
    

        $last_id = $_POST['part_sel_id'];

        // print_r($_POST);

        if ($last_id == "none") {
            $alert = "Please Select Part";
        }else {

            if ($_POST['part_op_stock_check'] == 1) {
                $storage_location = $_POST['part_storage_location'];
            } 
            else {
                if ($_POST['stl_s'] < 10) {
                    $stl_s = "S0".$_POST['stl_s'];
                } else {
                    $stl_s = "S".$_POST['stl_s'];
                }

                if ($_POST['stl_r'] < 10) {
                    $stl_r = "R0".$_POST['stl_r'];
                } else {
                    $stl_r = "R".$_POST['stl_r'];
                }

                if ($_POST['stl_c'] < 10) {
                    $stl_c = "C0".$_POST['stl_c'];
                } else {
                    $stl_c = "C".$_POST['stl_c'];
                }

                if ($_POST['stl_h'] < 10) {
                    $stl_h = "H0".$_POST['stl_h'];
                } else {
                    $stl_h = "H".$_POST['stl_h'];
                }

                $storage_location = $stl_s.$stl_r.$stl_c.$stl_h;
            }

            $temp_issue_id = $_POST['pifs_id'];
            $temp_issue_date = $_POST['pifs_date'];
            $temp_auth_person = $_POST['pifs_auth_person'];
            $temp_remarks = $_POST['pifs_remarks'];
            $part_sel_id = $_POST['part_sel_id'];
            $part_qty = $_POST['part_qty'];
            $updated_time = date('Y-m-d H:i:s');
            $updated_by = $_SESSION['user_id'];

            $sql = "INSERT INTO `pifs_entries_ex`(`pifs_id`, `part_id`, `part_qty`, `part_storage_location`, `updated_time`, `updated_by`, `fin_year`) VALUES ('$issue_id','$part_sel_id','$part_qty','$storage_location','$updated_time','$updated_by','2021-22')";

            if(mysqli_query($conn , $sql)) {
                $alert = "Records successfully Inserted";
            } 
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

    <title>Add Part Issue From Store Entry</title>

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
        input {
            border: 0;
        }

        label {
            display: revert;
            margin-bottom: 50px;
        }
    </style>
</head>

<body id="page-top" onload="myFunction()">

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
                        } elseif ($alert == "Please Select Part") {
                            echo '<div class="alert alert-danger" role="alert">
                                    Please Select Part
                                </div>';
                        }

                      ?>
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold float-left text-primary">Add Part Issue From Store Entry</h6>
                            <a class="float-right font-weight-bold mylink" href="pifs-master.php">
                                <i class="fa fa-eye"></i>
                                View Part Issue From Store Entries
                            </a>                 
                        </div>

                        <form name="myform" class="bootstrap-form-with-validation" action="<?php echo $action; ?>" method="post" onsubmit="return validate()">
                            <?php
                                if (isset($_POST['submit'])) {
                            ?>
                                <div class="row mx-3 mt-3">
                                    <div class="form-group col-md-3">
                                        <label for="pifs_id" class="form-label">Issue ID:</label>
                                        <input class="form-control" required="required" type="number" id="pifs_id" name="pifs_id" required="required" readonly="" value="<?php echo $_POST['pifs_id']; ?>">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="pifs_date" class="form-label">Issue Date:</label>
                                        <input class="form-control" required="required" type="date" id="pifs_date" name="pifs_date" required="required" value="<?php echo date('Y-m-d',strtotime($_POST['pifs_date'])); ?>">
                                    </div>
                                </div>
                                <div class="row mx-3 mt-3">
                                    <div class="form-group col-md-3">
                                        <label for="pifs_auth_person" class="form-label">Authorized Person</label>
                                        <select id="pifs_auth_person" name="pifs_auth_person" required="required" class="form-control mydrpdwn">
                                            <?php 
                                                $pifs_auth_person = $_POST['pifs_auth_person'];

                                                $query = "SELECT `usr_id`,`usr_name` FROM `user_master` WHERE `usr_id` = '$pifs_auth_person'";

                                                $result = mysqli_query($conn,$query);
                                            
                                                echo mysqli_error($conn);
                             
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
                                    <div class="form-group col-md-9">
                                        <label for="pifs_remarks" class="form-label">Remakrs</label>
                                        <input class="form-control" type="text" id="pifs_remarks" name="pifs_remarks" value="<?php echo $_POST['pifs_remarks']; ?>">
                                    </div>
                                </div>
                            <?php
                                }
                                else {
                            ?>
                                <div class="row mx-3 mt-3">
                                    <div class="form-group col-md-3">
                                        <label for="pifs_id" class="form-label">Issue ID:</label>
                                        <input class="form-control" required="required" type="number" id="pifs_id" name="pifs_id" required="required" readonly="" value="<?php echo $issue_id; ?>">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="pifs_date" class="form-label">Issue Date:</label>
                                        <input class="form-control" required="required" type="date" id="pifs_date" name="pifs_date" required="required" value="<?php echo date('Y-m-d'); ?>">
                                    </div>
                                </div>
                                <div class="row mx-3 mt-3">
                                    <div class="form-group col-md-3">
                                        <label for="pifs_auth_person" class="form-label">Authorized Person</label>
                                        <select id="pifs_auth_person" name="pifs_auth_person" required="required" class="form-control mydrpdwn">
                                            <option selected="" disabled=""></option>
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
                                    <div class="form-group col-md-9">
                                        <label for="pifs_remarks" class="form-label">Remakrs</label>
                                        <input class="form-control" type="text" id="pifs_remarks" name="pifs_remarks">
                                    </div>
                                </div>
                            <?php
                                }
                            ?>
                            <hr>
                            <div class="row mx-3">
                                <div class="form-group ml-3">
                                    <label class="form-label float-left">How will you enter storage code?</label>
                                    <div class="form-check float-left ml-2">
                                        <input class="form-check-input" type="radio" name="part_op_stock_check" id="formCheck-2" value="1" checked="">
                                        <label class="form-check-label" for="formCheck-2">Direct</label>
                                    </div>
                                    <div class="form-check float-left ml-2">
                                        <input class="form-check-input" type="radio" name="part_op_stock_check" id="formCheck-3" value="0">
                                        <label class="form-check-label" for="formCheck-3">With DropDown</label>
                                    </div>
                                </div>   
                            </div>
                            <div class="row mx-3 mb-3">
                                <div class="form-group col-md-3">
                                    <label for="part_sel_id" class="form-label">Select Part:</label>
                                    <select id="part_sel_id" class="mydrpdwn form-control" name="part_sel_id" required="required">
                                        <?php
                                            $number = "";

                                            if ($last_id == "") {
                                                $id = "none";
                                                $last_name = "Part";
                                            } else {
                                                $query = "SELECT `part_id`,`part_number`,`part_desc` FROM `part_master_one` WHERE part_id = '$last_id'";

                                                $result1 = mysqli_query($conn,$query);

                                                while($row = mysqli_fetch_array($result1)) {
                                                    $id = $row['part_id'];
                                                    $number = $row['part_number'];
                                                    $desc = $row['part_desc'];
                                                    if ($last_id == $id) {
                                                        $last_name = $desc;
                                                    }
                                                }
                                            }
                                        ?>
                                            <option value="<?php echo $id; ?>"><?php echo $number."-".$last_name; ?></option>
                                        <?php

                                            $query = "SELECT `part_id`,`part_number`,`part_desc` FROM `part_master_one`";

                                            $result = mysqli_query($conn,$query);
                                        
                                            echo mysqli_error($conn);

                                            while($row = mysqli_fetch_array($result)){
                                                $id = $row['part_id'];
                                                $number = $row['part_number'];
                                                $desc = $row['part_desc'];
                                            ?>
                                                <option value="<?php echo $id; ?>"><?php echo $number."-".$desc; ?></option>
                                            <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="form-label" for="text-input">Part QTY</label>
                                    <input class="form-control" required="required" type="number" id="text-input" name="part_qty" required="required">
                                </div>
                                <div class="form-group col-md-5" id="show-me-2">
                                    <label class="form-label" for="text-input">Storage Location</label>
                                    <input class="form-control" type="text" id="text-input" name="part_storage_location" list="storage" />
                                    <datalist id="storage">
                                        <?php
                                            $query = "SELECT DISTINCT `part_storage_location` FROM `part_master_three`";

                                            $result = mysqli_query($conn,$query);
                                        
                                            echo mysqli_error($conn);

                                            while($row = mysqli_fetch_array($result)){
                                                $part_storage_location = $row['part_storage_location'];
                                            ?>
                                                <option><?php echo $part_storage_location; ?></option>
                                            <?php
                                            }
                                        ?>
                                    </datalist>
                                    <span id="stlloc"></span>
                                </div>
                                <div class="col-md-5 row" id="show-me-3">
                                    <div class="form-group col-md-3">
                                        <label class="form-label" for="text-input">St. Location</label>
                                        <select class="form-control" name="stl_s">
                                        <?php 
                                            for ($i=0; $i < 100 ; $i++) { 
                                                if ($i < 10) {
                                                    echo '<option value="'.$i.'">0'.$i.'</option>';
                                                } else {
                                                    echo '<option value="'.$i.'">'.$i.'</option>';
                                                }
                                            }
                                        ?>  
                                        </select>
                                        <!-- <span id="stlloc"></span> -->
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="form-label" for="text-input">Row</label>
                                        <select class="form-control" name="stl_r">
                                        <?php 
                                            for ($i=0; $i < 100 ; $i++) { 
                                                if ($i < 10) {
                                                    echo '<option value="'.$i.'">0'.$i.'</option>';
                                                } else {
                                                    echo '<option value="'.$i.'">'.$i.'</option>';
                                                }
                                            }
                                        ?>  
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="form-label" for="text-input">Column</label>
                                        <select class="form-control" name="stl_c">
                                        <?php 
                                            for ($i=0; $i < 100 ; $i++) { 
                                                if ($i < 10) {
                                                    echo '<option value="'.$i.'">0'.$i.'</option>';
                                                } else {
                                                    echo '<option value="'.$i.'">'.$i.'</option>';
                                                }
                                            }
                                        ?>  
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="form-label" for="text-input">Height</label>
                                        <select class="form-control" name="stl_h">
                                        <?php 
                                            for ($i=0; $i < 100 ; $i++) { 
                                                if ($i < 10) {
                                                    echo '<option value="'.$i.'">0'.$i.'</option>';
                                                } else {
                                                    echo '<option value="'.$i.'">'.$i.'</option>';
                                                }
                                            }
                                        ?>  
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-1 mt-3">
                                    <input id="pm3_submit" class="btn btn-success" type="submit" name="submit" value="Add"></input>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="card mb-4 shadow">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold float-left text-primary">Added Parts</h6>
                            <!-- <a class="float-right font-weight-bold mylink" href="part-master3.php">
                                <i class="fa fa-eye"></i>
                                View Part Master 3 List
                            </a>   -->               
                        </div>
                        <!-- <caption>Temp Database Data</caption> -->
                        <form id="part_master32" class="bootstrap-form-with-validation" action="<?php $action ?>" method="post">
                            <table class="table table-bordered">
                                <thead>
                                    <tr style='background: whitesmoke;'>
                                        <th>Sr</th>
                                        <th>Part</th>
                                        <th>Part QTY</th>
                                        <th>Storage Location</th>
                                        <!-- <th>Edit</th> -->
                                        <th>Delete</th>      
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 

                                    $sql = "SELECT pifs_entries_ex.part_id, `entry_id`,`pifs_id`, `part_qty`, `part_storage_location`, part_master_one.part_id, part_master_one.part_desc, part_master_one.part_number FROM `pifs_entries_ex` LEFT JOIN `part_master_one` ON pifs_entries_ex.part_id = part_master_one.part_id";

                                    $result = mysqli_query($conn,$sql);
                                    $count = 0;

                                    while($row = mysqli_fetch_array($result) ){
                                        $count = $count + 1;
                                        $entry_id = $row['entry_id'];
                                        $pifs_id = $row['pifs_id'];
                                        $part_id = $row['part_id'];
                                        $part_number = $row['part_number'];
                                        $part_desc = $row['part_desc'];
                                        $part_qty = $row['part_qty'];
                                        $part_storage_location = $row['part_storage_location'];
                                    ?>
                                        <tr>
                                            <td>
                                                <?php echo $count; ?>
                                            </td>
                                            <td>
                                                <input type="hidden" name="final_part_id[]" value="<?= $part_id ?>">
                                                <input type="hidden" name="final_pifs_id[]" value="<?= $pifs_id ?>">
                                                <input type='text' name='final_desc[]>' value='<?= $part_number."-".$part_desc ?>' readonly>
                                            </td>
                                            <td><input type='text' name='final_part_qty[]' value='<?= $part_qty ?>'></td>
                                            <td><input type='text' name='final_storage_location[]' value='<?= $part_storage_location ?>'></td>
                    
                                            <td>
                                                <?php
                                                    echo "<a class='btn btn-danger' href='del-pm3.php?delete_id=".$entry_id."&change_id=".$part_id."&table=temp'>Delete</a>";
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

        function myFunction() {
            $('#show-me-2').show();
            $('#show-me-3').hide();
        }

        $(document).ready(function() {
           $('input[name="part_op_stock_check"]').click(function() {
               if($(this).attr('id') == 'formCheck-2') {
                    $('#show-me-2').show();  
                    $('#show-me-3').hide();       
               }
               else {
                    $('#show-me-2').hide();
                    $('#show-me-3').show();  
               }
           });
        });

        function validate(){

        //for Storage Location
        var check = document.myform.part_op_stock_check.value;
        var stl = document.myform.part_storage_location.value;
        var l= stl.length;
        var statusmsc = "";
        var statuslsn = "";
        var statuswsn = "";
        var statushsn = "";

        if (check == 1) {
            if (l != 12) {
            status = "storage code must be of 12 digit";
            document.getElementById('stlloc').innerHTML = status;
            return false;
        } else {
            var msca = stl[0];
            var msc = stl[1]+stl[2];
            var lsna = stl[3];
            var lsn = stl[4]+stl[5];
            var wsna = stl[6];
            var wsn = stl[7]+stl[8];
            var hsna = stl[9];
            var hsn = stl[10]+stl[11];

            for(i = 83 ; i < 84 ; i++) {
                var charCode = String.fromCharCode(i);

                if (msca == charCode) {
                    // document.write(String.fromCharCode(i));
                    for(i = 1 ; i < 100 ; i++) {
                        if (msc == i) {
                            statusmsc = 1;
                            // document.write(i);
                            break;
                        } 
                        else {
                            statusmsc = "Main Storage Code not set";
                        }   
                    }
                    break;
                } 
                else {
                    for( j = 115 ; j < 116 ; j++) {
                        var charCode2 = String.fromCharCode(j);
                        if (msca == charCode2) {
                            statusmsc = "Main Storage Code Must Be in Capital";
                            // document.write(String.fromCharCode(i));
                            break;
                        }
                        else {
                            statusmsc = "Main Storage Code not set";
                        }
                    }
                }
                   
            }

            for(i = 82 ; i < 83 ; i++) {
                var charCode = String.fromCharCode(i);
                if (lsna == charCode) {
                    // document.write(String.fromCharCode(i));
                    for(i = 1 ; i < 100 ; i++) {
                        if (lsn == i) {
                            statuslsn = 1;
                            // document.write(i);
                            break;
                        } 
                        else {
                            statuslsn = "Length Scale Number not set";
                        }   
                    }
                    break;
                } 
                else {
                    for( j = 114 ; j < 115 ; j++) {
                        var charCode2 = String.fromCharCode(j);
                        if (lsna == charCode2) {
                            statuslsn = "Length Scale Number Must Be in Capital";
                            // document.write(String.fromCharCode(i));
                            break;
                        }
                        else {
                            statuslsn = "Length Scale Number not set";
                        }
                    }
                }   
            }

            for(i = 67 ; i < 68 ; i++) {
                var charCode = String.fromCharCode(i);
                if (wsna == charCode) {
                    // document.write(String.fromCharCode(i));
                    for(i = 1 ; i < 100 ; i++) {
                        if (wsn == i) {
                            statuswsn = 1;
                            // document.write(i);
                            break;
                        } 
                        else {
                            statuswsn = "Width Scale Number not set";
                        }   
                    }
                    break;
                } 
                else {
                    for( j = 99 ; j < 100 ; j++) {
                        var charCode2 = String.fromCharCode(j);
                        if (wsna == charCode2) {
                            statuswsn = "Width Scale Number Must Be in Capital";
                            // document.write(String.fromCharCode(i));
                            break;
                        }
                        else {
                            statuswsn = "Width Scale Number not set";
                        }
                    }
                }   
            }

            for(i = 72 ; i < 73 ; i++) {
                var charCode = String.fromCharCode(i);
                if (hsna == charCode) {
                    // document.write(String.fromCharCode(i));
                    for(i = 1 ; i < 100 ; i++) {
                        if (hsn == i) {
                            statushsn = 1;
                            // document.write(i);
                            break;
                        } 
                        else {
                            statushsn = "Height Scale Number not set";
                        }   
                    }
                    break;
                } 
                else {
                    for( j = 108 ; j < 109 ; j++) {
                        var charCode2 = String.fromCharCode(j);
                        if (hsna == charCode2) {
                            statushsn = "Height Scale Number Must Be in Capital";
                            // document.write(String.fromCharCode(i));
                            break;
                        }
                        else {
                            statushsn = "Height Scale Number not set";
                        }
                    }
                }   
            }

            // for(i = 1 ; i < 100 ; i++) {
            //     if (lsn == i) {
            //         statuslsn = 1;
            //         // document.write(statuslsn);
            //         break;
            //     } 
            //     else {
            //         statuslsn = "Length Scale Number not set";
            //     }   
            // }

            // for(i = 65 ; i < 90 ; i++) {
            //     var charCode = String.fromCharCode(i);
            //     if (wsn == charCode) {
            //         statuswsn = 1;
            //         // document.write(String.fromCharCode(i));
            //         break;
            //     } 
            //     else {
            //         for( j = 90 ; j < 122 ; j++) {
            //             var charCode2 = String.fromCharCode(j);
            //             if (wsn == charCode2) {
            //                 statuswsn = "Width Scale Number Must Be in Capital";
            //                 // document.write(String.fromCharCode(i));
            //                 break;
            //             }
            //             else {
            //                 statuswsn = "Width Scale Number not set";
            //             }
            //         }
            //     }   
            // }

            // for(i = 1 ; i < 100 ; i++) {
            //     if (hsn == i) {
            //         statushsn = 1;
            //         // document.write(i);
            //         break;
            //     } 
            //     else {
            //         statushsn = "Height Scale Number not set";
            //     }   
            // }

            if ( statusmsc == 1) {
                // document.write(statuslsn);
                if (statuslsn == 1) {

                    if (statuswsn == 1) {
                        if (statushsn == 1) {
                            // document.write("hello");
                            document.getElementById("stlloc").innerHTML= "";
                        }
                        else {
                            // document.write("hello");
                            document.getElementById("stlloc").innerHTML= statushsn;
                            return false;
                        }
                    }
                    else {
                        // document.write("hello");
                        document.getElementById("stlloc").innerHTML= statuswsn;
                        return false;
                    }
                }
                else {
                    // document.write("hello");
                    document.getElementById("stlloc").innerHTML= statuslsn;
                    return false;
                }
            }
            else {
                // document.write("hello");
                document.getElementById("stlloc").innerHTML= statusmsc;
                return false;
            }
        }

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