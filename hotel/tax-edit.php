<?php
  
  session_start();
  date_default_timezone_set("Asia/Kolkata");
  $alert = "";

  include('connection.php');

  if (isset($_GET['edit_id'])) {
    $edit_id = $_GET['edit_id'];
  }

  if(isset($_POST['submit'])) {
    
    $tax_id = $_POST['tax_id'];
    $tax_cgst = $_POST['tax_cgst'];
    $tax_sgst = $_POST['tax_sgst'];
    // $tax_igst = $_POST['tax_igst'];
    $tax_igst = 12;
    $updated_time = date('Y-m-d H:i:s');
    $updated_by = $_SESSION['user_id'];

    $update_sql = "UPDATE `tax_master` SET `tax_cgst`='$tax_cgst',`tax_sgst`='$tax_sgst',`tax_igst`='$tax_igst',`updated_time`='$updated_time',`updated_by`='$updated_by' WHERE `tax_id`='$tax_id'";

    if(mysqli_query($conn , $update_sql)) {
        $alert = "Tax Details Edited Successfully";
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

    <title>Edit Tax</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/mycss.css" rel="stylesheet">

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
                    <h1 class="h3 mb-2 text-gray-800">Edit Tax</h1>
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
                            <h6 class="m-0 font-weight-bold float-left text-primary">Edit Tax</h6>
                           <!--  <a class="float-right font-weight-bold mylink" href="tax-master.php">
                                <i class="fa fa-eye"></i>
                                View Tax List
                            </a>   -->               
                        </div>
                      <?php
                      }
                      else {
                      ?>
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold float-left text-primary">Edit Tax</h6>
                            <!-- <a class="float-right font-weight-bold mylink" href="tax-master.php">
                                <i class="fa fa-eye"></i>
                                View Tax List
                            </a>   -->               
                        </div>
                      <?php
                      }
                      ?>
                        <div class="card-body p-3">
                            <!-- <div class="text-center mt-5">
                                <h1 class="h4 text-gray-900 mb-4">Add New Department</h1>
                            </div> -->
                            <form name="myform" action="<?php echo $_SERVER['PHP_SELF'].'?edit_id='.$edit_id; ?>" method="POST">
                                <?php

                                $select_sql = "SELECT * FROM `tax_master` WHERE `tax_id` = '$edit_id'";

                                $result = mysqli_query($conn, $select_sql);

                                while ($data = mysqli_fetch_assoc($result)) {
                                ?>
                                <div class="row mx-3 mt-3">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tax_cgst">CGST<span class="star">*</span></label>
                                            <input type="text" class="form-control" id="tax_cgst" name="tax_cgst" placeholder="CGST" required="" value="<?php echo $data['tax_cgst']; ?>">
                                            <input type="hidden" class="form-control" name="tax_id" value="<?php echo $data['tax_id']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tax_sgst">SGST<span class="star">*</span></label>
                                            <input type="text" class="form-control" id="tax_sgst" name="tax_sgst" placeholder="SGST" required="" value="<?php echo $data['tax_sgst']; ?>">
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tax_igst">IGST<span class="star">*</span></label>
                                            <input type="text" class="form-control" id="tax_igst" name="tax_igst" placeholder="IGST" value="<?php echo $data['tax_igst']; ?>">
                                        </div>
                                    </div> -->
                                </div>
                                <div class="mx-4 mb-2">
                                <input type="submit" name="submit" class="btn btn-primary pull-left" value="submit">
                                </div>
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