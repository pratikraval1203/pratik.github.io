<?php 
  session_start();

  if (isset($_REQUEST['submit'])) {
    include('connection.php');

    $username = strtoupper($_REQUEST['username']);
    $password = md5($_REQUEST['password']);
    $fin_year = $_REQUEST['fin_year'];

    // echo $fin_year;

    if ($fin_year == "None") {
        $msg = "Please Select Financial Year !!!";
        echo "<script type='text/Javascript'>alert('$msg')</script>";
    }else {
        // echo md5($_REQUEST['password']);
        $sql = "SELECT `usr_id`, `usr_name`, `usr_password`, `usr_admin_level` FROM `user_master` WHERE `usr_name` = '$username' AND `usr_password` = '$password'";

        $result = mysqli_query($conn, $sql);

        // print_r($result);

        if ($result) {

          $totalrows = mysqli_num_rows($result);
          if($totalrows == 1) { 

            $x = mysqli_fetch_row($result);
            $id = $x[0];
            $name = $x[1];
            $admin_level = $x[3];

          // $arr = explode('@' , $username);
                  
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $name;
            $_SESSION['admin_level'] = $admin_level;
            $_SESSION['fin_year'] = $fin_year;
            echo '<script language="javascript" type="text/javascript">window.location = "dashboard.php"</script>';
            //header('location:dashboard.php');
          }
          else {
            $msg = "Invalid username or password !!!";
            echo "<script type='text/Javascript'>alert('$msg')</script>";
          }
          echo mysqli_error($conn);
        }
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

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>EON Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        .bg-effect {
            box-shadow: 0px 0px 20px 1px grey;
        }
        .bg-whitesmoke {
            background-color: #f2f2f2;
        }
        .bg-with-img {
            background-image: url(img/bg-light-img.jpg);
            background-size: 100% 100%;
            background-repeat: no-repeat;
        }
    </style>

</head>

<body class="bg-with-img">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-4 col-lg-4 col-md-6 mt-5">
                <div class="text-center">
                    <img src="img/logo.png" alt="logo">
                </div>
            
                <div class="card o-hidden border-0 bg-effect my-5 mx-auto">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <!-- <div class="col-lg-6 d-none d-lg-block bg-login-image"> -->
                            <!-- </div> -->
                            <div class="col-lg-12 mx-auto">
                                <div class="px-5 pt-5 mb-3">
                                    <div class="text-center">
                                        <!-- <h1 class="h4 text-gray-900 mb-4">Admin Login</h1> -->
                                    </div>
                                    <form class="user" action="" method="post">
                                        <div class="form-group">
                                            <input type="text" name="username" class="form-control"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Username" required="" autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control"
                                                id="exampleInputPassword" placeholder="Password" required="">
                                        </div>
                                        <div class="form-group">
                                            <!-- <input type="" name="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Password"> -->
                                            <select name="fin_year" class="form-control" required="">
                                                <option value="None" selected="">Financial Year</option>
                                                <option value="2020-21">2020-21</option>
                                                <option value="2021-22">2021-22</option>
                                                <option value="2022-23">2022-23</option>
                                                <option value="2023-24">2023-24</option>
                                            </select>
                                        </div>
                                        <!-- <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div> -->
                                        <input type="submit" name="submit" value="Login" class="btn btn-primary btn-block">
                                        <!-- <hr> -->
                                        <!-- <a href="index.html" class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Login with Google
                                        </a>
                                        <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                        </a> -->
                                    </form>
                                    <!-- <hr> -->
                                    <div class="text-center mt-3">
                                        <a class="small" href="#">Forgot Password?</a>
                                    </div>
                                    <!-- <div class="text-center">
                                        <a class="small" href="register.html">Create an Account!</a>
                                    </div> -->
                                </div>
                            </div>
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