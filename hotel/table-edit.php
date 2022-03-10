<?php
  
  session_start();
  date_default_timezone_set("Asia/Kolkata");
  $alert = "";

  include('connection.php');

  if (isset($_GET['edit_id'])) {
    $edit_id = $_GET['edit_id'];
  }

  if (isset($_POST['submit'])) {

    $table_id = $_POST['table_id'];
    $table_no = $_POST['table_no'];
    // $table_rate_type = $_POST['table_rate_type'];
    $table_type = $_POST['table_type'];
    // $table_cgst = $_POST['table_cgst'];
    // $table_sgst = $_POST['table_sgst'];
    // $table_discount = $_POST['table_discount'];
    $updated_time = date('Y-m-d H:i:s');
    $updated_by = $_SESSION['user_id'];

    $update_sql = "UPDATE `new_table_master` SET `table_no`='$table_no',`table_type`='$table_type',`updated_time`='$updated_time',`updated_by`='$updated_by' WHERE `table_id`='$table_id'";

    // $update_sql = "UPDATE `new_table_master` SET `table_no`='$table_no',`table_rate_type`='$table_rate_type',`table_type`='$table_type',`table_cgst`='$table_cgst',`table_sgst`='$table_sgst',`table_discount`='$table_discount',`updated_time`='$updated_time',`updated_by`='$updated_by' WHERE `table_id`='$table_id'";

    if(mysqli_query($conn , $update_sql)) {
        $alert = "Table Details Updated Successfully";
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

    <title>Edit Table Details</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/mycss.css" >

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php
          include('sidebar.php');
        ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php
                  include('topbar.php');
                ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Edit Table Details</h1>
                    <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                        For more information about DataTables, please visit the <a target="_blank"
                            href="https://datatables.net">official DataTables documentation</a>.
                    </p> -->

                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <?php 
                            if ($alert != "") {
                        ?>
                        <div class="alert alert-info">
                          <?php echo $alert; ?>
                        </div>
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold float-left text-primary">Edit Table Details</h6>
                            <a class="float-right font-weight-bold mylink" href="table-master.php">
                                <i class="fa fa-eye"></i>
                                View Table List
                            </a>                 
                        </div>
                      <?php
                      }
                      else {
                      ?>
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold float-left text-primary">Edit Table Details</h6>
                            <a class="float-right font-weight-bold mylink" href="table-master.php">
                                <i class="fa fa-eye"></i>
                                View Table List
                            </a>                 
                        </div>
                      <?php
                      }
                      ?>
                        <div class="card-body p-3">
                            <!-- <div class="text-center mt-5">
                                <h1 class="h4 text-gray-900 mb-4">Add New Table</h1>
                            </div> -->
                            <form name="myform" action="<?php echo $_SERVER['PHP_SELF'].'?edit_id='.$edit_id;?>" method="POST">
                                <?php

                                $select_sql = "SELECT * FROM `new_table_master` WHERE `table_id` = '$edit_id'";

                                $result = mysqli_query($conn, $select_sql);

                                while ($data = mysqli_fetch_assoc($result)) {
                                ?>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="table_no" class="mb-0">Table No.<span class="star">*</span></label>
                                            <input type="text" class="form-control" id="table_no" name="table_no" placeholder="Table No." value="<?php echo $data['table_no']; ?>" required="">
                                            <input type="hidden" class="form-control" name="table_id" value="<?php echo $data['table_id']; ?>">
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="table_rate_type" class="mb-0">Table Ratetype<span class="star">*</span></label>
                                            <input type="text" class="form-control" id="table_rate_type" name="table_rate_type" placeholder="Table Ratetype" required="" value="<?php echo $data['table_rate_type']; ?>">
                                        </div>
                                    </div> -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="table_type" class="mb-0">Table Type<span class="star">*</span></label>
                                            <select class="form-control mydrpdwn" name="table_type" placeholder="Table Type" required="" id="table_type">
                                                <?php 
                                                    $table_type = $data['table_type']; 

                                                    if ($table_type == 1) {
                                                        echo '<option value="1" selected>AC</option>';
                                                    } elseif ($table_type == 2) {
                                                        echo '<option value="2" selected>Non AC</option>';
                                                    } elseif ($table_type == 3) {
                                                        echo '<option value="3" selected>Garden</option>';
                                                    } elseif ($table_type == 4) {
                                                        echo '<option value="4" selected>Banquet</option>';
                                                    } elseif ($table_type == 5) {
                                                        echo '<option value="5" selected>Swiggy</option>';
                                                    } elseif ($table_type == 6) {
                                                        echo '<option value="6" selected>Zomato</option>';
                                                    }
                                                ?>

                                                <option value="1">AC</option>
                                                <option value="2">Non AC</option>
                                                <option value="3">Garden</option>
                                                <option value="4">Banquet</option>
                                                <option value="5">Swiggy</option>
                                                <option value="6">Zomato</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="table_cgst" class="mb-0">Table CGST<span class="star">*</span></label>
                                            <input type="text" class="form-control" id="table_cgst" name="table_cgst" placeholder="Table CGST" required="" value="<?php echo $data['table_cgst']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="table_sgst" class="mb-0">Table SGST<span class="star">*</span></label>
                                            <input type="text" class="form-control" id="table_sgst" name="table_sgst" placeholder="Table SGST" required="" value="<?php echo $data['table_sgst']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="table_discount" class="mb-0">Table Discount</label>
                                            <input type="text" class="form-control" id="table_discount" name="table_discount" placeholder="Table Discount" value="<?php echo $data['table_discount']; ?>">
                                        </div>
                                    </div>
                                </div> -->
                                <input type="submit" name="submit" class="btn btn-primary pull-left" value="submit">
                                <div class="clearfix"></div>
                                <?php
                                }
                                ?>
                            </form>
                        </div>
                        <div class="card-footer"></div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php
                include('footer.php');
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
        include('logout-model.php');
    ?>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <script type="text/javascript" src="js/myjs.js"></script>

</body>
</html>
<?php
 include('disconnect.php');
?>