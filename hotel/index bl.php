<?php 
  session_start();

  function calculateFiscalYearForDate($month)
  {
    if($month > 4)
    {
      $y = date('y');
      $z = $y + 1;
      return '20'.$y.'-'.$z;
    }
    else
    {
      $y = date('y');
      $y = $y - 1;
      $z = $y + 1;
      return '20'.$y.'-'.$z;
    }
    return $fy;
  }

  $curr_date_month = date('m');
  $calculate_fiscal_year_for_date = calculateFiscalYearForDate($curr_date_month);
  // echo $calculate_fiscal_year_for_date;

  if (isset($_REQUEST['submit'])) {
    include('connection.php');

    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];
    $fin_year = $_REQUEST['fin_year'];

    // echo $fin_year;

    if ($fin_year == "None") {
        $msg = "Please Select Financial Year !!!";
        echo "<script type='text/Javascript'>alert('$msg')</script>";
    }else {
        // echo md5($_REQUEST['password']);
        $sql = "SELECT * FROM `tbl_admin` WHERE `username` = '$username' AND `password` = '$password'";

        $result = mysqli_query($conn, $sql);

        // echo mysqli_error($conn);

        // print_r($result);

        if ($result) {
            // echo "hi";
          $totalrows = mysqli_num_rows($result);
          if($totalrows == 1) { 

            $x = mysqli_fetch_row($result);
            $id = $x['0'];
            $username = $x['2'];

          // $arr = explode('@' , $username);
                  
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $username;
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
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Admin Login
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--nts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="assets/css/material-dashboard.css?v=2.1.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="assets/demo/demo.css" rel="stylesheet" />

  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <style type="text/css">
      /*.table {
        color: red;
      }*/
      .ops {
        /*background-color: red;*/
        /*color: red;*/
      }

        .bg-effect {
            box-shadow: 0px 0px 20px 1px grey;
        }
        .bg-whitesmoke {
            background-color: #f2f2f2;
        }
    </style>

</head>

<body class="bg-whitesmoke">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-4 col-lg-4 col-md-6">

                <div class="card o-hidden border-0 bg-effect my-5 mx-auto">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <!-- <div class="col-lg-6 d-none d-lg-block bg-login-image"></div> -->
                            <div class="col-lg-12 mx-auto">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-dark text-uppercase font-weight-bold mb-4">Admin Login</h1>
                                    </div>
                                    <form class="user" action="" method="post">
                                        <div class="form-group">
                                            <input type="text" name="username" class="form-control"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Username" required="">
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
                                    <hr>
                                    <div class="text-center">
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

    <script src="assets/js/core/jquery.min.js"></script>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap-material-design.min.js"></script>
  <script src="https://unpkg.com/default-passive-events"></script>
  <script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!-- Place this tag in your head or just before your close body tag. -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chartist JS -->
  <script src="assets/js/plugins/chartist.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/material-dashboard.js?v=2.1.0"></script>
  <!-- Material Dashboard DEMO methods, don't include it in your project! -->
  <script src="assets/demo/demo.js"></script>

</body>

</html>