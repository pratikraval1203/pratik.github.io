<?php 
  session_start();

  if (isset($_REQUEST['submit'])) {
    include('../connection.php');

    $username = $_REQUEST['email'];
    $password = md5($_REQUEST['password']);

    // echo md5($_REQUEST['password']);
    $sql = "SELECT email,password FROM `admin_data` WHERE email = '$username' AND password = '$password'";

    $result = mysqli_query($conn, $sql);
    $totalrows = mysqli_num_rows($result);
    echo mysqli_error($conn);

    $arr = explode('@' , $username);
    if($totalrows == 1) {         
      $_SESSION['username'] = $arr[0];
      echo '<script language="javascript" type="text/javascript">window.location = "dashboard.php"</script>';
      //header('location:dashboard.php');
    }
    else {
      $msg = "Invalid username or password !!!";
      echo "<script type='text/Javascript'>alert('$msg')</script>";
    }
    include('disconnect.php');  
  }
?>
<!-- logout code -->
<?php
  if (isset($_REQUEST['lo_submit'])) {
    unset($_SESSION['username']);
    session_destroy();
  }
?>
<!-- logout code ends -->
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>GRS Admin - Login</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">

  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Login</div>
      <div class="card-body">
        <form action="" method="post">
          <div class="form-group">
            <div class="form-label-group">
              <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required="required" autofocus="autofocus">
              <label for="inputEmail">Email address</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required="required">
              <label for="inputPassword">Password</label>
            </div>
          </div>
          <!-- <div class="form-group">
            <div class="checkbox">
              <label>
                <input type="checkbox" value="remember-me">
                Remember Password
              </label>
            </div>
          </div> -->
          <input type="submit" name="submit" value="Login" class="btn btn-primary btn-block">
        </form>
        <div class="text-center">
          <!-- <a class="d-block small mt-3" href="register.php">Register an Account</a> -->
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
