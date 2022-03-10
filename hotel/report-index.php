<?php
    session_start();

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

    <title>Reports Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/mycss.css">

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
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Reports Dashboard</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <?php
                            $user_role = $_SESSION['user_role'];

                            $role_sql = "SELECT * FROM `admin_role` WHERE `role_id` = '$user_role'";

                            $role_result = mysqli_query($conn, $role_sql);

                            $total_rows = mysqli_num_rows($role_result);

                            if ($total_rows == 1) {

                                while($role_data = mysqli_fetch_assoc($role_result)) {
                                    // echo $role_data['role_name'];
                                    if ($role_data['bill_report'] == '1') {
                        ?>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow py-2">
                                <a href="report-bill-wise.php" class="text-decoration-none">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class=" font-weight-bold text-primary text-uppercase mb-1">
                                                    Bill Wise Report
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-fw fa-file-invoice fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <?php
                                    } 

                                    if ($role_data['item_report'] == '1') {
                        ?>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow py-2">
                                <a href="report-item-wise.php" class="text-decoration-none">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class=" font-weight-bold text-primary text-uppercase mb-1">
                                                    Item Wise Report
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-fw fa-hamburger fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <?php
                                    } 

                                    if ($role_data['deleted_bill_report'] == '1') {
                        ?>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow py-2">
                                <a href="report-deleted-bills.php" class="text-decoration-none">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class=" font-weight-bold text-primary text-uppercase mb-1">
                                                    Deleted Bills Report
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-fw fa-ban fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                </div>
                                </a>
                            </div>
                        </div>

                        <?php
                                    } 

                                    if ($role_data['settlement_report'] == '1') {
                        ?>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow py-2">
                                <a href="report-settlement.php" class="text-decoration-none">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class=" font-weight-bold text-primary text-uppercase mb-1">
                                                    Settlement Report
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-receipt fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <?php
                                    } 

                                    if ($role_data['table_report'] == '1') {
                        ?>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow py-2">
                                <a href="report-table-wise.php" class="text-decoration-none">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class=" font-weight-bold text-primary text-uppercase mb-1">
                                                    Table Wise Report
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-utensils fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <?php
                                    } 

                                    if ($role_data['customer_report'] == '1') {
                        ?>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow py-2">
                                <a href="report-customer.php" class="text-decoration-none">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class=" font-weight-bold text-primary text-uppercase mb-1">
                                                    Customer Report
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-users fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <?php
                                    } 

                                    if ($role_data['customer_account_report'] == '1') {
                        ?>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow py-2">
                                <a href="report-cust-acc.php" class="text-decoration-none">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class=" font-weight-bold text-primary text-uppercase mb-1">
                                                    Customer Account Report
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-users fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <?php
                                    } 

                                    if ($role_data['monthly_report'] == '1') {
                        ?>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow py-2">
                                <a href="report-monthly.php" class="text-decoration-none">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class=" font-weight-bold text-primary text-uppercase mb-1">
                                                    Monthly Report
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fa fa-calendar fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <!-- <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow py-2">
                                <a href="report-item-wise-with-bill-desc.php" class="text-decoration-none">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class=" font-weight-bold text-primary text-uppercase mb-1">
                                                    Item Wise Report With Bill Desc. (ex)
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-hamburger fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div> -->

                        <?php
                                    }
                                }
                            }
                        ?>
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

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>
<?php
    include('disconnect.php');
?>