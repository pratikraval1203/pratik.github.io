<?php
  
  session_start();
  date_default_timezone_set("Asia/Kolkata");
  $alert = "";

  include('connection.php');

  if(isset($_POST['submit'])) {

    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $admin_mobile = $_POST['admin_mobile'];
    // $user_role = $_POST['user_role'];
    $updated_time = date('Y-m-d H:i:s');
    $updated_by = $_SESSION['user_id'];

    $insert_sql = "INSERT INTO `tbl_admin`(`email`, `username`, `password`, `admin_mobile`, `updated_time`, `updated_by`) VALUES ('$email','$username','$password','$admin_mobile','$updated_time', '$updated_by')";

    if(mysqli_query($conn , $insert_sql)) {
        $alert = "User Added Successfully";
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

    <title>Add User</title>

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
                    <h1 class="h3 mb-2 text-gray-800">Add User</h1>
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
                            <h6 class="m-0 font-weight-bold float-left text-primary">Add User</h6>
                            <a class="float-right font-weight-bold mylink" href="admin-master.php">
                                <i class="fa fa-eye"></i>
                                View User List
                            </a>                 
                        </div>
                      <?php
                      }
                      else {
                      ?>
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold float-left text-primary">Add User</h6>
                            <a class="float-right font-weight-bold mylink" href="admin-master.php">
                                <i class="fa fa-eye"></i>
                                View User List
                            </a>                 
                        </div>
                      <?php
                      }
                      ?>
                        <div class="card-body p-3">
                            <!-- <div class="text-center mt-5">
                                <h1 class="h4 text-gray-900 mb-4">Add New Customer</h1>
                            </div> -->
                            <form name="myform" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" onsubmit ="return validate()" autocomplete="off">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="email">Email<span class="star">*</span></label>
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="username">User Name<span class="star">*</span></label>
                                            <input type="text" class="form-control" id="username" name="username" placeholder="User Name" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="password">Password<span class="star">*</span></label>
                                            <input type="text" class="form-control" id="password" name="password" placeholder="Password" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="admin_mobile">User Mobile No.</label>
                                            <input type="number" class="form-control" id="admin_mobile" name="admin_mobile" placeholder="User Mobile No.">
                                            <span id="numloc"></span>
                                        </div>
                                    </div>      
                                    <div class="col-md-4">
                                        <!-- <div class="form-group">
                                            <label for="user_role">Admin Level<span class="star">*</span></label>
                                            <select class="form-control mydrpdwn" id="user_role" name="user_role" placeholder="Admin Level" required="">
                                                <option value="1" selected="">Admin</option>
                                                <option value="2">Manager</option>
                                                <option value="3">Cashier</option>
                                            </select>
                                        </div> -->
                                    </div>
                                </div>
                                <input type="submit" name="submit" class="btn btn-primary pull-left" value="Add User">
                                <div class="clearfix"></div>
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