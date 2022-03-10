<?php session_start(); ?>
<?php
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

  <title>Dashboard</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

  <style type="text/css">
    i {
      /*color: white;*/
      margin-right: 5px;
    }
  </style>

</head>

<body id="page-top">

  <!-- header is included here -->
  <?php
    include ('header.php');
  ?>
  <!-- header ends --> 

  <div id="wrapper">

    <!-- Sidebar is included here -->
    <?php
      include ('sidebar.php');
    ?>
    <!-- Sidebar ends -->

    <div id="content-wrapper" style="background-color: lightblue;">

      <div class="container-fluid">
        <!-- Icon Cards-->
        <div class="row">
          <div class="col-xl-3 col-sm-6 mb-3">
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-primary o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-laptop-code"></i>
                </div>
                <div class="mr-5">IT Department</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="it.php">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-primary o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-microchip"></i>
                </div>
                <div class="mr-5">CE Department</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="ce.php">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
          </div>
        </div> 
        <div class="row">
          <div class="col-xl-1 col-sm-6 mb-3">
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white o-hidden h-100" style="background-color:#007bff; color:white;">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fab fa-searchengin"></i> 
                </div>
                <div class="mr-5">IC Department</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="ic.php">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-4 col-sm-6 mb-3">
            <h1 style="text-align: center; line-height: 107px;">College Complaint</h1>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-primary o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-memory"></i>
                </div>
                <div class="mr-5">EC Department</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="ec.php">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-2 col-sm-6 mb-3">
          </div>
        </div>
        <div class="row">
          <div class="col-xl-1 col-sm-6 mb-3">
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white o-hidden h-100" style="background-color:#007bff; color:white;">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-biohazard"></i>
                </div>
                <div class="mr-5">BM Department</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="bm.php">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-4 col-sm-6 mb-3">
            <h1 style="text-align: center;">Mgmt. System</h1>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-primary o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-charging-station"></i>
                </div>
                <div class="mr-5">EE Department</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="ee.php">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-1 col-sm-6 mb-3">
          </div>
        </div>
        <div class="row">
          <div class="col-xl-3 col-sm-6 mb-3">
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-primary o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-flask"></i>
                </div>
                <div class="mr-5">CH Department</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="ch.php">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-primary o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-globe"></i>
                </div>
                <div class="mr-5">General Department</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="general.php">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
          </div>
        </div> 

      </div>
      <!-- /.container-fluid -->

      <!-- Footer is included here -->
      <?php
        include ('footer.php');
      ?>
      <!-- footer ends -->

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <?php
    include('logout.php');
  ?>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="vendor/chart.js/Chart.min.js"></script>
  <script src="vendor/datatables/jquery.dataTables.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="js/demo/datatables-demo.js"></script>
  <script src="js/demo/chart-area-demo.js"></script>

</body>

</html>
