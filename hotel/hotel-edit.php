<?php
  
  session_start();
  date_default_timezone_set("Asia/Kolkata");
  $alert = "";

  include('connection.php');

  if (isset($_GET['edit_id'])) {
    $edit_id = $_GET['edit_id'];
  }

  if(isset($_POST['submit'])) {
    
    $hotel_id = $_POST['hotel_id'];
    $hotel_name = $_POST['hotel_name'];
    $hotel_mobile = $_POST['hotel_mobile'];
    $hotel_website = $_POST['hotel_website'];
    $hotel_reg_no = $_POST['hotel_reg_no'];
    $hotel_gst_no = $_POST['hotel_gst_no'];
    $hotel_email = $_POST['hotel_email'];
    $hotel_address = $_POST['hotel_address'];
    $updated_time = date('Y-m-d H:i:s');
    $updated_by = $_SESSION['user_id'];

    $update_sql = "UPDATE `hotel_master` SET `hotel_name`='$hotel_name',`hotel_mobile`='$hotel_mobile',`hotel_website`='$hotel_website',`hotel_reg_no`='$hotel_reg_no',`hotel_gst_no`='$hotel_gst_no',`hotel_email`='$hotel_email',`hotel_address`='$hotel_address',`updated_time`='$updated_time',`updated_by`='$updated_by' WHERE `hotel_id`='$hotel_id'";

    if(mysqli_query($conn , $update_sql)) {
        $alert = "Hotel Details Updated Successfully";
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

    <title>Edit Hotel Details</title>

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

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Edit Hotel Details</h1>
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
                            <h6 class="m-0 font-weight-bold float-left text-primary">Edit Hotel Details</h6>
                            <!-- <a class="float-right font-weight-bold mylink" href="hotel-master.php">
                                <i class="fa fa-eye"></i>
                                View Hotel List
                            </a>   -->               
                        </div>
                      <?php
                      }
                      else {
                      ?>
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold float-left text-primary">Edit Hotel Details</h6>
                            <!-- <a class="float-right font-weight-bold mylink" href="hotel-master.php">
                                <i class="fa fa-eye"></i>
                                View Hotel List
                            </a> -->                 
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
                                    
                                    $select_sql = "SELECT * FROM `hotel_master` WHERE `hotel_id` = '$edit_id'";

                                    $result = mysqli_query($conn, $select_sql);

                                    while ($data = mysqli_fetch_assoc($result)) {

                                ?>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="hotel_name">Hotel Name<span class="star">*</span></label>
                                            <input type="text" class="form-control" id="hotel_name" name="hotel_name" placeholder="Hotel Name" required="" value="<?php echo $data['hotel_name'];?>">
                                            <input type="hidden" class="form-control" name="hotel_id" value="<?php echo $data['hotel_id'];?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="hotel_mobile">Hotel Mobile No.<span class="star">*</span></label>
                                            <input type="number" class="form-control" id="hotel_mobile" name="hotel_mobile" placeholder="Hotel Mobile No." required="" value="<?php echo $data['hotel_mobile'];?>">
                                            <span id="numloc"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="hotel_website">Hotel Website</label>
                                            <input type="text" class="form-control" id="hotel_website" name="hotel_website" placeholder="Hotel Website" value="<?php echo $data['hotel_website'];?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="hotel_reg_no">Hotel Reg No.</label>
                                            <input type="text" class="form-control" id="hotel_reg_no" name="hotel_reg_no" placeholder="Hotel Reg No." value="<?php echo $data['hotel_reg_no'];?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="hotel_gst_no">Hotel GST No.</label>
                                            <input type="text" class="form-control" id="hotel_gst_no" name="hotel_gst_no" placeholder="Hotel GST No." value="<?php echo $data['hotel_gst_no']?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="hotel_email">Hotel Email</label>
                                            <input type="email" class="form-control" id="hotel_email" name="hotel_email" placeholder="Hotel Email" value="<?php echo $data['hotel_email']?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="hotel_address">Hotel Address</label>
                                            <input type="text" class="form-control" id="hotel_address" name="hotel_address" placeholder="Hotel Address" value="<?php echo $data['hotel_address']?>">
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