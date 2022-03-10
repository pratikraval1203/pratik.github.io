<?php
  session_start();

  // print_r( timezone_identifiers_list());
    date_default_timezone_set("Asia/Kolkata");

    // print_r(getdate(2019-01-02));

    if (isset($_SESSION['username'])) {
      include('connection.php');
      // $servername = "localhost";
      // $dbuser = "root";
      // $dbpass = "";
      // $database = "db_gri_red_sys"; 

      // $conn = mysqli_connect($servername, $dbuser, $dbpass);

      // if (!$conn) {
      //   echo "Database Connection Failed.";
      // }
      // mysqli_select_db($conn, $database);

      if (isset($_REQUEST['submit'])) {

        $fname = $_REQUEST['fname'];
        $lname = $_REQUEST['lname'];
        $email = $_REQUEST['email'];
        $password = md5($_REQUEST['password']);
        $con_password = md5($_REQUEST['con-password']);
        if ($password == $con_password) {
           
          $sql = "INSERT INTO `admin_data`(`fname`, `lname`, `email`, `password`) VALUES ('$fname','$lname','$email','$password')";
          mysqli_query($conn, $sql);
          if(!mysqli_query($conn, $sql)) {
            $msg = mysqli_error($conn);
          echo "<script type='text/Javascript'>alert('$msg');</script>";
          }
          header('location:index.php');
        }
        else {
          $msg = "Password Not Match!!!";
          echo "<script type='text/Javascript'>alert('$msg');</script>";
        }
      }
      include('disconnect.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>GRS Admin - Register</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">

  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Add New Admin</div>
      <div class="card-body">
        <form action="" method="post">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="firstName" name="fname" class="form-control" placeholder="First name" required="required" autofocus="autofocus">
                  <label for="firstName">First name</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="lastName" name="lname" class="form-control" placeholder="Last name" required="required">
                  <label for="lastName">Last name</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="email" id="Email" name="email" class="form-control" placeholder="Email address" required="required">
              <label for="Email">Email address</label>
            </div> 
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="password" id="Password" name="password" class="form-control" placeholder="Password" required="required">
                  <label for="Password">Password</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="password" id="confirmPassword" name="con-password" class="form-control" placeholder="Confirm password" required="required">
                  <label for="confirmPassword">Confirm password</label>
                </div>
              </div>
            </div>
          </div>
          <input type="submit" name="submit" value="Register" class="btn btn-primary btn-block" href="index.php">
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="index.php">Login Page</a>
          <!-- <a class="d-block small" href="forgot-password.html">Forgot Password?</a> -->
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>

<?php
 }
  else {
    echo '<script language="javascript" type="text/javascript">window.location = "index.php"</script>';
    // header('location:index.php');
  }
?>