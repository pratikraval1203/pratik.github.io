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
        // echo $last_id;
        $append = "WHERE part_master_ten_ex.part_id = '$last_id' ";
    } else {
        $append = "";
    }
    $action = $_SERVER['PHP_SELF']."?change_id=".$last_id;

    if (isset($_POST['final_submit'])) {

        $final_part_id = $_POST['final_part_id'];
        $final_tm_id = $_POST['final_tm_id'];
        $final_part_qty = $_POST['final_part_qty'];
        $updated_time = date('Y-m-d H:i:s');
        $updated_by = $_SESSION['user_id'];

        // echo "<pre>";
        // var_dump($_POST);
        // echo "</pre>";

        $count1 = count($_POST['final_part_id']);

        for ($i= 0 ; $i < $count1 ; $i++) {
            $final_sql = "INSERT INTO `part_master_ten`(`part_id`, `tm_id`, `part_qty`, `updated_time`, `updated_by`) VALUES ('{$final_part_id[$i]}','{$final_tm_id[$i]}','{$final_part_qty[$i]}','$updated_time','$updated_by')";

            if (mysqli_error($conn)) {
                $msg = mysqli_error($conn);
                echo "<script type='text/Javascript'>alert('$msg')</script>";
             } 

            if(mysqli_query($conn , $final_sql)) {
                    $alert = "Final Records successfully Inserted";
                } 
        }
        $final_sql2 = "TRUNCATE TABLE  `part_master_ten_ex`"; 

            if(mysqli_query($conn , $final_sql2)) {
                // echo "Final Records successfully Deleted";
            }

    }
    elseif (isset($_POST['submit'])) {
    

        $last_id = $_POST['part_sel_id'];

        if ($last_id == "none") {
            $alert = "Please Select Part";
        }else {

            $part_id = $_POST['part_sel_id'];
            $tm_id = $_POST['tm_sel_id'];
            $part_qty = $_POST['part_qty'];
            $updated_time = date('Y-m-d H:i:s');
            $updated_by = $_SESSION['user_id'];

            $sql = "INSERT INTO `part_master_ten_ex`( `part_id`, `tm_id`, `part_qty`, `updated_time`, `updated_by`) VALUES ('$part_id','$tm_id','$part_qty','$updated_time','$updated_by')";

            if(mysqli_query($conn , $sql)) {
                $alert = "Records successfully Inserted";
            } else {
                $alert = mysqli_error($conn);
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

    <title>Add Part Opening Stock</title>

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
                        } else {
                            echo '<div class="alert alert-danger" role="alert">
                                    '.$alert.'
                                </div>';
                        }

                      ?>
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold float-left text-primary">Add Part Wise Track Machine Entry</h6>
                            <a class="float-right font-weight-bold mylink" href="part-master10.php">
                                <i class="fa fa-eye"></i>
                                View Part Wise Track Machine List
                            </a>                 
                        </div>

                        <form name="myform" class="bootstrap-form-with-validation" action="<?php echo $action; ?>" method="post" onsubmit="return validate()">
                            <div class="row m-3">
                                <div class="form-group col-md-4">
                                    <label>Part:</label>
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
                                <div class="form-group col-md-4">
                                    <label for="tm_sel_id">Track Machine:</label>
                                    <select id="tm_sel_id" name="tm_sel_id" class="form-control mydrpdwn" data-show-subtext="true" data-live-search="true">
                                        <option value="none" selected="" disabled=""></option>
                                        <?php 
                                            $query = "SELECT `tm_id`,`tm_brand`,`tm_type`,`tm_model_no` FROM `track_machine_master_one` ORDER BY `tm_model_no`";

                                            $result = mysqli_query($conn,$query);
                         
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
                                    <label class="form-label" for="part_qty">Part QTY</label>
                                    <input class="form-control" required="required" type="number" id="part_qty" name="part_qty">
                                </div>
                            </div>
                            <div class="row m-3">
                                <div class="form-group mx-3">
                                    <input id="pm3_submit" class="btn btn-success" type="submit" name="submit" value="Add Entry"></input>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.card mb-4 shadow -->

                    <div class="card mb-4 shadow">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold float-left text-primary">Added Part Wise Track Machine Entries</h6>              
                        </div>
                        <!-- <caption>Temp Database Data</caption> -->
                        <form id="part_master32" class="bootstrap-form-with-validation" action="<?php $action ?>" method="post">
                            <table class="table table-bordered">
                                <thead>
                                    <tr style='background: whitesmoke;'>
                                        <th>Sr</th>
                                        <th>Part Name</th>
                                        <th>Track Machine</th>
                                        <th>Part QTY</th>
                                        <th>Delete</th>      
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 

                                    $sql = "SELECT part_master_ten_ex.part_id, `tm_id`, `part_qty`, part_master_one.part_id, part_master_one.part_desc, part_master_one.part_number FROM `part_master_ten_ex` LEFT JOIN `part_master_one` ON part_master_ten_ex.part_id = part_master_one.part_id";

                                    // echo $sql;

                                    $result = mysqli_query($conn,$sql);
                                    $count =  0;

                                    while($row = mysqli_fetch_array($result) ){
                                        $count = $count + 1;
                                        $part_id = $row['part_id'];
                                        $part_number = $row['part_number'];
                                        $part_desc = $row['part_desc'];
                                        $tm_id = $row['tm_id'];
                                        $part_qty = $row['part_qty'];

                                        $query_tm = "SELECT `tm_id`,`tm_brand`,`tm_type`,`tm_model_no` FROM `track_machine_master_one` WHERE tm_id = '$tm_id'";

                                        $result_tm = mysqli_query($conn, $query_tm);

                                        $row_tm = mysqli_fetch_array($result_tm);

                                        $id = $row_tm['tm_id'];
                                        $type = $row_tm['tm_type'];
                                    ?>
                                        <tr>
                                            <td><?php echo $count; ?></td>
                                            <td>
                                                <input type="hidden" name="final_part_id[]" value="<?= $part_id ?>">
                                                <input type='hidden' name='final_tm_id[]' value='<?= $tm_id ?>'>
                                                <input type='text' name='final_desc[]>' value='<?= $part_number."-".$part_desc ?>' readonly>
                                            </td>
                                            <td>
                                                <input type='text' name='final_tm_desc[]' value='<?php echo $type; ?>'>
                                            </td>
                                            <td>
                                                <input type='text' name='final_part_qty[]' value='<?= $part_qty ?>'>
                                            </td>
                                            <td>
                                                <?php
                                                    echo "<a class='btn btn-danger' href='del-pm10.php?del_part_id=".$part_id."&del_tm_id=".$tm_id."&change_id=".$part_id."&table=temp'>Delete</a>";
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
        
</body>

</html>
<?php 
    include ('disconnect.php');
?>