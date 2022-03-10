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

    <title>Master Dashboard</title>

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
                        <h1 class="h3 mb-0 text-gray-800">Master Dashboard</h1>
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
                                    if ($role_data['customer_entry'] == '1') {
                        ?>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow py-2">
                                <a href="cust-reg.php" class="text-decoration-none">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class=" font-weight-bold text-primary text-uppercase mb-1">
                                                    Customer Master
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

                                    if ($role_data['item_entry'] == '1') {
                        ?>  

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow py-2">
                                <a href="item-reg.php" class="text-decoration-none">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class=" font-weight-bold text-primary text-uppercase mb-1">
                                                    Item Master
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

                                    if ($role_data['table_entry'] == '1') {
                        ?>  

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow py-2">
                                <a href="table-reg.php" class="text-decoration-none">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class=" font-weight-bold text-primary text-uppercase mb-1">
                                                    Table Master
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

                                    if ($role_data['dept_entry'] == 1) {
                        ?>  

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow py-2">
                                <a href="department-reg.php" class="text-decoration-none">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class=" font-weight-bold text-primary text-uppercase mb-1">
                                                    Department Master
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-table fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <?php
                                    }

                                    if ($role_data['manage_user'] == 1) {
                        ?>  

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow py-2">
                                <a href="admin-reg.php" class="text-decoration-none">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class=" font-weight-bold text-primary text-uppercase mb-1">
                                                    Manage User
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-user fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <?php
                                    }

                                    if ($role_data['hotel_master'] == 1) {
                        ?>  

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow py-2">
                                <a href="hotel-edit.php?edit_id=1" class="text-decoration-none">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class=" font-weight-bold text-primary text-uppercase mb-1">
                                                    Hotel Master
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-hotel fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <?php
                                    }

                                    if ($role_data['tax_entry'] == 1) {
                        ?>  

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow py-2">
                                <a href="tax-edit.php?edit_id=4" class="text-decoration-none">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class=" font-weight-bold text-primary text-uppercase mb-1">
                                                    Tax Master
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

                                    if ($role_data['stock_entry'] == 1) {
                        ?>  

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow py-2">
                                <a href="stock-reg.php" class="text-decoration-none">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class=" font-weight-bold text-primary text-uppercase mb-1">
                                                    Stock Master
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-layer-group fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <?php
                                    }

                                    if ($role_data['customer_account'] == 1) {
                        ?>  

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow py-2">
                                <a href="cust-acc-master.php" class="text-decoration-none">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class=" font-weight-bold text-primary text-uppercase mb-1">
                                                    Customer Account
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-address-book fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <?php
                                    }

                                    if ($role_data['deleted_bill'] == 1) {
                        ?>  

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow py-2">
                                <a href="view-deleted-bills.php" class="text-decoration-none">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class=" font-weight-bold text-primary text-uppercase mb-1">
                                                    View Deleted Bills
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-ban fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <?php
                                    }

                                    if ($role_data['manage_user'] == 1) {
                        ?>  

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow py-2">
                                <a href="admin-rights-master.php" class="text-decoration-none">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class=" font-weight-bold text-primary text-uppercase mb-1">
                                                    Admin Rights
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-user-shield fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>

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