<?php
    session_start();

    if (isset($_REQUEST['submit'])) {

        include('connection.php');

        $username = strtoupper($_REQUEST['username']);
        $password = $_REQUEST['password'];

        $sql = "SELECT * FROM `tbl_admin` WHERE `username` = '$username' AND `password` = '$password'";

        $result = mysqli_query($conn, $sql);


        if ($result) {

          $totalrows = mysqli_num_rows($result);
          if($totalrows == 1) { 

            $x = mysqli_fetch_row($result);
            $id = $x['0'];
            $username = $x['2'];
            $user_role = $x['5'];

                  
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $username;
            $_SESSION['user_role'] = $user_role;
            echo '<script language="javascript" type="text/javascript">window.location = "contact-us-responses.php"</script>';
          }
          else {
            $msg = "Invalid username or password !!!";
            echo "<script type='text/Javascript'>alert('$msg')</script>";
          }
          echo mysqli_error($conn);
        }
    }
?>

<!-- logout code -->
<?php
  if (isset($_REQUEST['lo_submit'])) {
    unset($_SESSION['username']);
    session_destroy();
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

    <title>Admin Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/mycss.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-4 col-lg-4 col-md-6 my-5">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0 bg-white">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4 font-weight-bold">Mitesh Industries</h1>
                            </div>
                            <form class="user" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" autocomplate="off">
                                <div class="form-group">
                                    <input type="text" name="username" class="form-control form-control-user" placeholder="Enter Username" required="">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control form-control-user" placeholder="Enter Password" required="">
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="submit" class="btn btn-primary btn-user btn-block" value="Login">
                                </div>
                                <!-- <a href="index.html" class="btn btn-primary btn-user btn-block">
                                    Login
                                </a> -->
                                <!-- <hr> -->
                                <!-- <a href="index.html" class="btn btn-google btn-user btn-block">
                                    <i class="fab fa-google fa-fw"></i> Login with Google
                                </a>
                                <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                    <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                </a> -->
                            </form>
                           <!--  <hr>
                            <div class="text-center">
                                <a class="small" href="#">Forgot Password?</a>
                            </div> -->
                            <!-- <div class="text-center">
                                <a class="small" href="register.html">Create an Account!</a>
                            </div> -->
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>