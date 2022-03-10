<?php
  
  session_start();
  date_default_timezone_set("Asia/Kolkata");
  $alert = "";

  include('connection.php');

  if (isset($_GET['edit_id'])) {
    $edit_id = $_GET['edit_id'];
  }

  if(isset($_POST['submit'])) {
    
    $item_id = $_POST['item_id'];
    $item_code = $_POST['item_code'];
    $item_name = $_POST['item_name'];
    $item_unit = $_POST['item_unit'];
    $item_rate_1 = $_POST['item_rate_1'];
    $item_rate_2 = $_POST['item_rate_2'];
    $item_rate_3 = $_POST['item_rate_3'];
    $item_rate_4 = $_POST['item_rate_4'];
    $item_rate_5 = $_POST['item_rate_5'];
    $item_rate_6 = $_POST['item_rate_6'];
    $department_name = $_POST['department_name'];
    $item_type = $_POST['item_type'];
    $updated_time = date('Y-m-d H:i:s');
    $updated_by = $_SESSION['user_id'];

    $update_sql = "UPDATE `item_master` SET `item_code`='$item_code',`item_name`='$item_name',`item_unit`='$item_unit',`item_rate_1`='$item_rate_1',`item_rate_2`='$item_rate_2',`item_rate_3`='$item_rate_3',`item_rate_4`='$item_rate_4',`item_rate_5`='$item_rate_5',`item_rate_6`='$item_rate_6',`department_name`='$department_name',`item_type`='$item_type',`updated_time`='$updated_time',`updated_by`='$updated_by' WHERE `item_id`='$item_id'";

    if(mysqli_query($conn , $update_sql)) {
        $alert = "Item Details Updated Successfully";
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

    <title>Edit Item</title>

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
                    <h1 class="h3 mb-2 text-gray-800">Edit Item</h1>
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
                            <h6 class="m-0 font-weight-bold float-left text-primary">Edit Item</h6>
                            <a class="float-right font-weight-bold mylink" href="item-master.php">
                                <i class="fa fa-eye"></i>
                                View Item List
                            </a>                 
                        </div>
                      <?php
                      }
                      else {
                      ?>
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold float-left text-primary">Edit Item</h6>
                            <a class="float-right font-weight-bold mylink" href="item-master.php">
                                <i class="fa fa-eye"></i>
                                View Item List
                            </a>                 
                        </div>
                      <?php
                      }
                      ?>
                        <div class="card-body p-3">
                            <!-- <div class="text-center mt-5">
                                <h1 class="h4 text-gray-900 mb-4">Add New Item</h1>
                            </div> -->
                            <form name="myform" action="<?php echo $_SERVER['PHP_SELF'].'?edit_id='.$edit_id; ?>" method="POST">
                                <?php

                                $select_sql = "SELECT * FROM `item_master` WHERE `item_id` = '$edit_id'";

                                $result = mysqli_query($conn, $select_sql);

                                while ($data = mysqli_fetch_assoc($result)) {
                                ?>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="item_code">Item Code<span class="star">*</span></label>
                                            <input type="text" class="form-control" id="item_code" name="item_code" placeholder="Item Code" value="<?php echo $data['item_code']; ?>" required="">
                                            <input type="hidden" class="form-control" name="item_id" value="<?php echo $data['item_id']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="item_name">Item Name<span class="star">*</span></label>
                                            <input type="text" class="form-control" id="item_name" name="item_name" placeholder="Item Name" required="" value="<?php echo $data['item_name'];?>">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="item_unit">Item Unit<span class="star">*</span></label>
                                            <input type="text" class="form-control" id="item_unit" name="item_unit" placeholder="Item Unit" value="<?php echo $data['item_unit'];?>" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="department_name">Department Name<span class="star">*</span></label>
                                            <select type="text" class="form-control mydrpdwn" id="department_name" name="department_name" placeholder="Department Name" required="">
                                            <?php 
                                                $department_id = $data['department_name'];

                                                $query_dept = "SELECT * FROM `department_master` WHERE `department_id` = '$department_id'";    
                                                $result_dept = mysqli_query($conn, $query_dept);

                                                while ($data_dept = mysqli_fetch_assoc($result_dept)) {
                                                    $dept_id = $data_dept['department_id'];
                                                    $dept_name = $data_dept['department_name'];
                                            ?>
                                                <option value="<?php echo $dept_id; ?>"><?php echo $dept_name; ?></option>
                                            <?php
                                                }
                                            ?>
                                            <?php 
                                                $query_dept = "SELECT * FROM `department_master` ORDER BY `department_name`";    
                                                $result_dept = mysqli_query($conn, $query_dept);


                                                while ($data_dept = mysqli_fetch_assoc($result_dept)) {
                                                    $dept_id = $data_dept['department_id'];
                                                    $dept_name = $data_dept['department_name'];
                                            ?>
                                                <option value="<?php echo $dept_id; ?>"><?php echo $dept_name; ?></option>
                                            <?php
                                                }
                                            ?>  
                                            </select>
                                            <!-- <input type="text" class="form-control" id="department_name" name="department_name" placeholder="Department Name" value="<?php //echo $data['department_name'];?>" required=""> -->
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="item_type">Item Type<span class="star">*</span></label>
                                            <?php 
                                                if ($data['item_type'] == 0) {
                                            ?>
                                                <select class="form-control mydrpdwn" name="item_type" placeholder="Item Type" required="" id="item_type">
                                                <option value="0" selected="">Raw Matirial</option>
                                                <option value="1">Item Menu</option>
                                            </select>
                                            <?php
                                                } elseif ($data['item_type'] == 1) {
                                            ?>
                                                <select class="form-control mydrpdwn" name="item_type" placeholder="Item Type" required="" id="item_type">
                                                <option value="0">Raw Matirial</option>
                                                <option value="1" selected="">Item Menu</option>
                                            </select>
                                            <?php
                                                }
                                                else { 
                                                    echo "Error";
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="item_rate_1">Item Rate 1 (AC)</label>
                                            <input type="number" class="form-control" id="item_rate_1" name="item_rate_1" placeholder="Item Rate 1" value="<?php echo $data['item_rate_1'];?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="item_rate_2">Item Rate 2 (Non AC)</label>
                                            <input type="number" class="form-control" id="item_rate_2" name="item_rate_2" placeholder="Item Rate 2" value="<?php echo $data['item_rate_2'];?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="item_rate_3">Item Rate 3 (Garden)</label>
                                            <input type="number" class="form-control" id="item_rate_3" name="item_rate_3" placeholder="Item Rate 3" value="<?php echo $data['item_rate_3'];?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="item_rate_4">Item Rate 4 (Banquet)</label>
                                            <input type="number" class="form-control" id="item_rate_4" name="item_rate_4" placeholder="Item Rate 4" value="<?php echo $data['item_rate_4'];?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="item_rate_5">Item Rate 5 (Swiggy)</label>
                                            <input type="number" class="form-control" id="item_rate_5" name="item_rate_5" placeholder="Item Rate 5" value="<?php echo $data['item_rate_5'];?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="item_rate_6">Item Rate 6 (Zomato)</label>
                                            <input type="number" class="form-control" id="item_rate_6" name="item_rate_6" placeholder="Item Rate 6" value="<?php echo $data['item_rate_6'];?>">
                                        </div>
                                    </div>
                                </div>
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