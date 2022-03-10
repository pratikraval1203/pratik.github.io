<?php
  
  session_start();
  date_default_timezone_set("Asia/Kolkata");
  $alert = "";

  include('connection.php');

  if (isset($_GET['edit_id'])) {
    $edit_id = $_GET['edit_id'];
  }

  if(isset($_POST['submit'])) {
    $role_id = $edit_id;

    if (isset($_POST['customer_entry'])) {
        $customer_entry = 1;
    } else {
        $customer_entry = 0;
    }

    if (isset($_POST['bill_entry'])) {
        $bill_entry = 1;
    } else {
        $bill_entry = 0;
    }

    if (isset($_POST['item_entry'])) {
        $item_entry = 1;
    } else {
        $item_entry = 0;
    }

    if (isset($_POST['dept_entry'])) {
        $dept_entry = 1;
    } else {
        $dept_entry = 0;
    }

    if (isset($_POST['table_entry'])) {
        $table_entry = 1;
    } else {
        $table_entry = 0;
    }

    if (isset($_POST['stock_entry'])) {
        $stock_entry = 1;
    } else {
        $stock_entry = 0;
    }

    if (isset($_POST['tax_entry'])) {
        $tax_entry = 1;
    } else {
        $tax_entry = 0;
    }

    if (isset($_POST['hotel_master'])) {
        $hotel_master = 1;
    } else {
        $hotel_master = 0;
    }

    if (isset($_POST['customer_account'])) {
        $customer_account = 1;
    } else {
        $customer_account = 0;
    }

    if (isset($_POST['bill_report'])) {
        $bill_report = 1;
    } else {
        $bill_report = 0;
    }

    if (isset($_POST['table_report'])) {
        $table_report = 1;
    } else {
        $table_report = 0;
    }

    if (isset($_POST['item_report'])) {
        $item_report = 1;
    } else {
        $item_report = 0;
    }

    if (isset($_POST['customer_report'])) {
        $customer_report = 1;
    } else {
        $customer_report = 0;
    }

    if (isset($_POST['settlement_report'])) {
        $settlement_report = 1;
    } else {
        $settlement_report = 0;
    }

    if (isset($_POST['deleted_bill_report'])) {
        $deleted_bill_report = 1;
    } else {
        $deleted_bill_report = 0;
    }

    if (isset($_POST['deleted_bill'])) {
        $deleted_bill = 1;
    } else {
        $deleted_bill = 0;
    }

    if (isset($_POST['view_bill'])) {
        $view_bill = 1;
    } else {
        $view_bill = 0;
    }

    if (isset($_POST['edit_bill'])) {
        $edit_bill = 1;
    } else {
        $edit_bill = 0;
    }

    if (isset($_POST['manage_user'])) {
        $manage_user = 1;
    } else {
        $manage_user = 0;
    }

    if (isset($_POST['update_data'])) {
        $update_data = 1;
    } else {
        $update_data = 0;
    }

    if (isset($_POST['customer_account_report'])) {
        $customer_account_report = 1;
    } else {
        $customer_account_report = 0;
    }

    if (isset($_POST['monthly_report'])) {
        $monthly_report = 1;
    } else {
        $monthly_report = 0;
    }

    $update_sql = "UPDATE `admin_role` SET `customer_entry`='$customer_entry',`bill_entry`='$bill_entry',`item_entry`='$item_entry',`dept_entry`='$dept_entry',`table_entry`='$table_entry',`stock_entry`='$stock_entry',`tax_entry`='$tax_entry',`hotel_master`='$hotel_master',`customer_account`='$customer_account',`bill_report`='$bill_report',`table_report`='$table_report',`item_report`='$item_report',`customer_report`='$customer_report',`settlement_report`='$settlement_report', `customer_account_report` = '$customer_account_report' , `monthly_report` = '$monthly_report',`deleted_bill_report`='$deleted_bill_report',`deleted_bill`='$deleted_bill',`view_bill`='$view_bill',`edit_bill`='$edit_bill',`manage_user`='$manage_user',`update_data`='$update_data' WHERE `role_id` ='$role_id'";

    if(mysqli_query($conn , $update_sql)) {
        $alert = "User Rights Updated Successfully";
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

    <title>Assign User Rights</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/mycss.css" rel="stylesheet">
    <style type="text/css">
        #numloc {
          color: red !important;
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

                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <?php 
                            if ($alert != "") {
                        ?>
                        <div class="alert alert-info">
                          <?php echo $alert; ?>
                        </div>
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold float-left text-primary">Assign User Rights</h6>
                            <a class="float-right font-weight-bold mylink" href="admin-rights-master.php">
                                <i class="fa fa-eye"></i>
                                Admin Rights Master
                            </a>                 
                        </div>
                      <?php
                      }
                      else {
                      ?>
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold float-left text-primary">Assign User Rights</h6>
                            <a class="float-right font-weight-bold mylink" href="admin-rights-master.php">
                                <i class="fa fa-eye"></i>
                                Admin Rights Master
                            </a>                 
                        </div>
                      <?php
                      }
                      ?>
                        <div class="card-body p-3">
                            <!-- <div class="text-center mt-5">
                                <h1 class="h4 text-gray-900 mb-4">Add New Customer</h1>
                            </div> -->
                            <form name="myform" action="<?php echo $_SERVER['PHP_SELF'].'?edit_id='.$edit_id; ?>" method="POST" onsubmit ="return validate()" autocomplete="off">
                                <?php
                                 
                                 $select_sql = "SELECT * FROM `admin_role` WHERE `role_id` = '$edit_id'";

                                 $result = mysqli_query($conn ,$select_sql);

                                 while($data = mysqli_fetch_assoc($result)){

                                ?>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="username">Admin Role</label>
                                            <input type="text" class="form-control" id="admin_role" name="admin_role" value="<?php echo strtoupper($data['role_name']); ?>" readonly>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="table-responsive table-wrapper">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="m-2">
                                                        <div class="form-group">
                                                            <input type="checkbox" class="m-1" id="customer_entry" name="customer_entry" <?php if ($data['customer_entry'] == 1){?> checked="" <?php } else { ?>  <?php } ?>>
                                                            <label for="customer_entry">Customer Entry</label>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="m-2">
                                                        <div class="form-group">
                                                            <input type="checkbox" class="m-1" id="bill_entry" name="bill_entry" <?php if ($data['bill_entry'] == 1){?> checked="" <?php } else { ?>  <?php } ?>>
                                                            <label for="bill_entry">Bill Entry</label>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="m-2">
                                                        <div class="form-group">
                                                            <input type="checkbox" class="m-1" id="item_entry" name="item_entry" <?php if ($data['item_entry'] == 1){?> checked="" <?php } else { ?>  <?php } ?>>
                                                            <label for="item_entry">Item Entry</label>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="m-2">
                                                        <div class="form-group">
                                                            <input type="checkbox" class="m-1" class="" id="dept_entry" name="dept_entry" <?php if ($data['dept_entry'] == 1){?> checked="" <?php } else { ?>  <?php } ?>>
                                                            <label for="dept_entry">Department Entry</label>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="m-2">
                                                        <div class="form-group">
                                                            <input type="checkbox" class="m-1" id="table_entry" name="table_entry" <?php if ($data['table_entry'] == 1){?> checked="" <?php } else { ?>  <?php } ?>>
                                                            <label for="table_entry">Table Entry</label>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="m-2">
                                                        <div class="form-group">
                                                            <input type="checkbox" class="m-1" class="" id="stock_entry" name="stock_entry" <?php if ($data['stock_entry'] == 1){?> checked="" <?php } else { ?>  <?php } ?>>
                                                            <label for="stock_entry">Stock Entry</label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="m-2">
                                                        <div class="form-group">
                                                            <input type="checkbox" class="m-1" class="" id="tax_entry" name="tax_entry" <?php if ($data['tax_entry'] == 1){?> checked="" <?php } else { ?>  <?php } ?>>
                                                            <label for="tax_entry">Tax Entry</label>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="m-2">
                                                        <div class="form-group">
                                                            <input type="checkbox" class="m-1" id="hotel_master" name="hotel_master" <?php if ($data['hotel_master'] == 1){?> checked="" <?php } else { ?>  <?php } ?>>
                                                            <label for="hotel_master">Hotel Master</label>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="m-2">
                                                        <div class="form-group">
                                                            <input type="checkbox" class="m-1" id="customer_account" name="customer_account" <?php if ($data['customer_account'] == 1){?> checked="" <?php } else { ?>  <?php } ?>>
                                                            <label for="customer_account">Customer Account</label>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="m-2">
                                                        <div class="form-group">
                                                            <input type="checkbox" class="m-1" class="" id="table_report" name="table_report" <?php if ($data['table_report'] == 1){?> checked="" <?php } else { ?>  <?php } ?>>
                                                            <label for="table_report">Table Report</label>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="m-2">
                                                        <div class="form-group">
                                                            <input type="checkbox" class="m-1" class="" id="customer_report" name="customer_report" <?php if ($data['customer_report'] == 1){?> checked="" <?php } else { ?>  <?php } ?>>
                                                            <label for="customer_report">Customer Report</label>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="m-2">
                                                        <div class="form-group">
                                                            <input type="checkbox" class="m-1" class="" id="customer_account_report" name="customer_account_report" <?php if ($data['customer_account_report'] == 1){?> checked="" <?php } else { ?>  <?php } ?>>
                                                            <label for="customer_account_report">Customer Account Report</label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="m-2">
                                                        <div class="form-group">
                                                            <input type="checkbox" class="m-1" class="" id="monthly_report" name="monthly_report" <?php if ($data['monthly_report'] == 1){?> checked="" <?php } else { ?>  <?php } ?>>
                                                            <label for="monthly_report">Monthly Report</label>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="m-2">
                                                        <div class="form-gro">
                                                            <input type="checkbox" class="m-1" class="" id="settlement_report" name="settlement_report" <?php if ($data['settlement_report'] == 1){?> checked="" <?php } else { ?>  <?php } ?>>
                                                            <label for="settlement_report">Settlement Report</label>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="m-2">
                                                        <div class="form-group">
                                                            <input type="checkbox" class="m-1" class="" id="deleted_bill_report" name="deleted_bill_report" <?php if ($data['deleted_bill_report'] == 1){?> checked="" <?php } else { ?>  <?php } ?>>
                                                            <label for="deleted_bill_report">Deleted Bil Report</label>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="m-2">
                                                        <div class="form-group">
                                                            <input type="checkbox" class="m-1" class="" id="deleted_bill" name="deleted_bill" <?php if ($data['deleted_bill'] == 1){?> checked="" <?php } else { ?>  <?php } ?>>
                                                            <label for="deleted_bill">View Deleted Bill</label>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="m-2">
                                                        <div class="form-group">
                                                            <input type="checkbox" class="m-1" class="" id="manage_user" name="manage_user" <?php if ($data['manage_user'] == 1){?> checked="" <?php } else { ?>  <?php } ?>>
                                                            <label for="manage_user">Manage User</label>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    
                                    <!-- <div class="m-2">
                                        <div class="form-group">
                                            <input type="checkbox" class="m-1" class="" id="view_bill" name="view_bill" <?php if ($data['view_bill'] == 1){?> checked="" <?php } else { ?>  <?php } ?>>
                                            <label for="view_bill">View Bills</label>
                                        </div>
                                    </div>
                                    <div class="m-2">
                                        <div class="form-group">
                                            <input type="checkbox" class="m-1" class="" id="edit_bill" name="edit_bill" <?php if ($data['edit_bill'] == 1){?> checked="" <?php } else { ?>  <?php } ?>>
                                            <label for="edit_bill">Edit Bills</label>
                                        </div>
                                    </div>
                                    <div class="m-2">
                                        <div class="form-group">
                                            <input type="checkbox" class="m-1" class="" id="update_data" name="update_data" <?php if ($data['update_data'] == 1){?> checked="" <?php } else { ?>  <?php } ?>>
                                            <label for="update_data">Update</label>
                                        </div>
                                    </div> -->
                                    
                                </div>
                                <hr>
                                <input type="submit" name="submit" class="btn btn-primary pull-left" value="submit">
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
    
    <script type="text/javascript">
        function validate(){
            
        // for mobile number
        var num=document.myform.admin_mobile.value;
        if (isNaN(num)){
          document.getElementById("").innerHTML="Please Enter Numeric value only";
          return false;
          var phoneno = /^\d{10}$/;
          if(!num.match(phoneno))
          {
             document.getElementById("numloc").innerHTML="Not a valid Phone Number";
            return false;
          }
          else {
            document.getElementById("numloc").innerHTML="";
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
            document.getElementById("numloc").innerHTML="";
          }
        }
      }
    </script>
</body>
</html>
<?php
 include('disconnect.php');
?>