<?php
    session_start();
    date_default_timezone_set("Asia/Kolkata");
    $alert = "";

    if (isset($_GET['view_id'])) {
        $view_id = $_GET['view_id'];
    }

    include('connection.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Inquiry Details</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- for masters -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/mycss.css" >

    <style type="text/css">
        td {
            padding: 1% !important;
        }
        th {
            /*color: red !important;*/
            white-space: pre-wrap !important;
        }
        th.mywrap {
            white-space: nowrap !important;
        }
    </style>

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
                <!-- <h1 class="h3 mb-2 text-gray-800">Hotel Master</h1> -->
                <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                    For more information about DataTables, please visit the <a target="_blank"
                        href="https://datatables.net">official DataTables documentation</a>.
                </p> -->

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <?php 
                        if ($alert != "") {
                    ?>
                        <div class="alert alert-info">
                          <?php echo $alert; ?>
                        </div>
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold float-left text-primary">Inquiry Details</h6> 
                            <a class="float-right font-weight-bold mylink" href="inquiry-responses.php">
                                <i class="fa fa-eye"></i>
                                View all Inquiry
                            </a>              
                        </div>
                    <?php
                       }
                        else {
                    ?>
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold float-left text-primary">Inquiry Details</h6> 
                            <a class="float-right font-weight-bold mylink" href="inquiry-responses.php">
                                <i class="fa fa-eye"></i>
                                View all Inquiry
                            </a>                
                        </div>
                    <?php
                       }
                    ?>
                    
                    <div class="card-body">
                        <form name="myform" action="<?php echo $_SERVER['PHP_SELF'].'?view_id='.$view_id; ?>" method="POST" autocomplete="off">

                                <?php

                                    $select_sql = "SELECT * FROM `tbl_inquiry` WHERE `inquiry_id` = '$view_id'";

                                    $result = mysqli_query($conn, $select_sql);

                                    while ($data = mysqli_fetch_assoc($result)) {
                                ?>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" id="name" name="name" readonly="" value="<?php echo $data['name']; ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="mobile">Mobile No.</label>
                                            <input type="text" class="form-control" id="mobile" name="mobile" readonly="" value="<?php echo $data['mobile']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" readonly="" value="<?php echo $data['email']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="area_type">Area</label>
                                            <input type="text" class="form-control" id="area_type" name="area_type" readonly="" value="<?php echo $data['area_type']; ?>">
                                        </div>
                                    </div>      
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <input type="text" class="form-control" id="address" name="address" readonly="" value="<?php echo $data['address']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="updated_time">Date & Time</label>
                                            <input type="text" class="form-control" id="updated_time" name="updated_time" readonly="" value="<?php echo $data['updated_time']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <!-- <input type="submit" name="submit" class="btn btn-primary pull-left" value="submit"> -->
                                <div class="clearfix"></div>
                                <?php
                                }
                                ?>
                            </form>
                            <!-- <h4 class="font-weight-bold">Area : <?php echo $data['area_type']; ?></h4>
                            <hr>
                            <h5>Sent by : <?php echo $data['name'];?></h5>
                            <hr>
                            <h5>Mobile No.: <?php echo $data['mobile']; ?></h5>
                            <hr>
                            <h5>Email: <?php echo $data['email']; ?></h5>
                            <hr>
                            <h5>Address: <?php echo $data['address']; ?></h5> -->
                    </div>
                    <div class="card-footer">
                        <!-- <p>
                        Date & Time: <?php echo date('d-m-Y H:i:s',strtotime($data['updated_time'])); ?>
                        </p> -->
                    </div>
                    
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

    <!-- for masters -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="js/demo/datatables-demo.js"></script>

</body>
</html>
<?php
 include('disconnect.php');
?>