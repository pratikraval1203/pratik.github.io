<?php
  
  session_start();
  date_default_timezone_set("Asia/Kolkata");
  $alert = "";

  include('connection.php');

  if (isset($_GET['edit_id'])) {
    $edit_id = $_GET['edit_id'];
  }

  if(isset($_POST['submit'])) {
    
    $cust_id = $_POST['cust_id'];
    $cust_name = $_POST['cust_name'];
    $cust_email = $_POST['cust_email'];
    $cust_mobile = $_POST['cust_mobile'];
    $cust_address = $_POST['cust_address'];
    $cust_city = $_POST['cust_city'];
    $cust_dob = $_POST['cust_dob'];
    $cust_annivesary_date = $_POST['cust_annivesary_date'];
    $cust_gst_no = $_POST['cust_gst_no'];
    $updated_time = date('Y-m-d H:i:s');
    $updated_by = $_SESSION['user_id'];

     $update_sql = "UPDATE `customer_master` SET `cust_name`='$cust_name',`cust_address`='$cust_address',`cust_city`='$cust_city',`cust_email`='$cust_email',`cust_mobile`='$cust_mobile',`cust_dob`='$cust_dob',`cust_annivesary_date`='$cust_annivesary_date',`cust_gst_no`='$cust_gst_no',`updated_time`='$updated_time',`updated_by`='$updated_by' WHERE `cust_id`='$cust_id'";

     //echo "$update_sql";

    if(mysqli_query($conn , $update_sql)) {
        $alert = "Customer Details Updated Successfully";
    }
    else {
        $alert = mysqli_error($conn);
        //echo $alert;
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

    <title>Edit Customer</title>

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
                    <h1 class="h3 mb-2 text-gray-800">Edit Customer</h1>
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
                            <h6 class="m-0 font-weight-bold float-left text-primary">Edit Customer</h6>
                            <a class="float-right font-weight-bold mylink" href="cust-master.php">
                                <i class="fa fa-eye"></i>
                                View Customer List
                            </a>                 
                        </div>
                        <?php
                            }
                            else {
                        ?>
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold float-left text-primary">Edit Customer</h6>
                            <a class="float-right font-weight-bold mylink" href="cust-master.php">
                                <i class="fa fa-eye"></i>
                                View Customer List
                            </a>                 
                        </div>
                        <?php
                            }
                        ?>
                        <div class="card-body p-3">
                            <!-- <div class="text-center mt-5">
                                <h1 class="h4 text-gray-900 mb-4">Add New Customer</h1>
                            </div> -->
                            <form name="myform" action="<?php echo $_SERVER['PHP_SELF'].'?edit_id='.$edit_id; ?>" method="POST" onsubmit ="return validate()">
                                <?php

                                $select_sql = "SELECT * FROM `customer_master` WHERE `cust_id` = '$edit_id'";

                                $result = mysqli_query($conn, $select_sql);

                                while ($data = mysqli_fetch_assoc($result)) {
                                ?>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="cust_name">Customer Name<span class="star">*</span></label>
                                            <input type="text" class="form-control" id="cust_name" name="cust_name" placeholder="Customer Name" required="" value="<?php echo $data['cust_name'];?>">
                                            <input type="hidden" class="form-control" name="cust_id" value="<?php echo $data['cust_id']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="cust_mobile">Customer Mobile No.<span class="star">*</span></label>
                                            <input type="number" class="form-control" id="cust_mobile" name="cust_mobile" placeholder="Customer Mobile No." required=""value="<?php echo $data['cust_mobile'];?>">
                                            <span id="numloc"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="cust_email">Customer Email</label>
                                            <input type="email" class="form-control" id="cust_email" name="cust_email" placeholder="Customer Email" value="<?php echo $data['cust_email'];?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="cust_address">Customer Address</label>
                                            <input type="text" class="form-control" id="cust_address" name="cust_address" placeholder="Customer Address" value="<?php echo $data['cust_address'];?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="cust_city">Customer City</label>
                                            <input type="text" class="form-control" id="cust_city" name="cust_city" placeholder="Customer City" value="<?php echo $data['cust_city'];?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">    
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="cust_dob">Customer DOB</label>
                                            <input type="date" class="form-control" id="cust_dob" name="cust_dob" value="<?php echo $data['cust_dob'];?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="cust_annivesary_date">Anniversary Date</label>
                                            <input type="date" class="form-control" id="cust_annivesary_date" name="cust_annivesary_date" value="<?php echo $data['cust_annivesary_date'];?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="cust_gst_no">Customer GST No.</label>
                                            <input type="text" class="form-control" id="cust_gst_no" name="cust_gst_no" placeholder="Customer GST No." value="<?php echo $data['cust_gst_no'];?>">
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
    
    <script type="text/javascript">
        function validate(){
            
        // for mobile number
        var num=document.myform.cust_mobile.value;
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