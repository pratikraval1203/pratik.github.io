<?php

  session_start();
  date_default_timezone_set("Asia/Kolkata");
  $alert = "";

  include('connection.php');

  if(isset($_POST['submit'])){

  $cust_name = $_POST['cust_name'];
  $cust_mobile = $_POST['cust_mobile'];
  $cust_email = $_POST['cust_email'];
  $cust_consumer_no = $_POST['cust_consumer_no'];
  $cust_address = $_POST['cust_address'];
  $cust_message = $_POST['cust_message'];
  $updated_time = date('Y-m-d H:i:s');
  // $updated_by = $_SESSION['user_id'];

  $insert_sql = "INSERT INTO `tbl_support`(`cust_name`, `cust_mobile`, `cust_email`, `cust_consumer_no`, `cust_address`, `cust_message`, `updated_time`, `updated_by`) VALUES ('$cust_name','$cust_mobile','$cust_email','$cust_consumer_no','$cust_address','$cust_message','$updated_time','1')";

  if(mysqli_query($conn, $insert_sql)) {
    $alert = "Message send Successfully";
    }
    else {
      $alert = mysqli_error($conn);
      echo $alert;
    }
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Support | Ample Solar</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,400i,600,700|Raleway:300,400,400i,500,500i,700,800,900" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: eBusiness - v4.5.0
  * Template URL: https://bootstrapmade.com/ebusiness-bootstrap-corporate-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <?php
    include('header.php');
  ?>
  <!-- End Header -->

  <main id="main">

    <!-- ======= Contact Section ======= -->
    <div id="contact" class="contact-area">
      <div class="contact-inner area-padding">
        <div class="contact-overly"></div>
        <div class="container ">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="section-headline text-center">
                <h3 style="margin-top:2%;">Welcome to Ample Support</h3>
                <p>Empowering your future with solar energy.</p>
                <p>A new way to save money and energy.</p> 
              </div>
            </div>
          </div>
          <div class="row">
            <!-- Start contact icon column -->
            <!-- <div class="col-md-4">
              <div class="contact-icon text-center">
                <div class="single-icon">
                  <i class="bi bi-phone"></i>
                  <p>
                    Call: +1 5589 55488 55<br>
                    <span>Monday-Friday (9am-5pm)</span>
                  </p>
                </div>
              </div>
            </div> -->
            <!-- Start contact icon column -->
            <!-- <div class="col-md-4">
              <div class="contact-icon text-center">
                <div class="single-icon">
                  <i class="bi bi-envelope"></i>
                  <p>
                    Email: info@example.com<br>
                    <span>Web: www.example.com</span>
                  </p>
                </div>
              </div>
            </div> -->
            <!-- Start contact icon column -->
            <!-- <div class="col-md-4">
              <div class="contact-icon text-center">
                <div class="single-icon">
                  <i class="bi bi-geo-alt"></i>
                  <p>
                    Location: A108 Adam Street<br>
                    <span>NY 535022, USA</span>
                  </p>
                </div>
              </div>
            </div>
          </div>-->
          <div class="row mt-5"> 

            <!-- Start  contact -->
                <div class="form contact-form col-md-6">
                  <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" role="form">
                    <div class="row">
                      <div class="form-group col-md-6">
                        <input type="text" name="cust_name" class="form-control" id="cust_name" placeholder="Your Name" required>
                      </div>
                      <div class="form-group col-md-6">
                        <input type="text" name="cust_mobile" class="form-control" id="cust_mobile" placeholder="Your Mobile No." required>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-md-6 mt-3">
                        <input type="email" class="form-control" name="cust_email" id="cust_email" placeholder="Your Email" required>
                      </div>
                      <div class="form-group col-md-6 mt-3">
                        <input type="text" class="form-control" name="cust_consumer_no" id="cust_consumer_no" placeholder="Your Consumer Number" required>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-md-6 mt-3">
                        <textarea class="form-control" name="cust_address" rows="5" placeholder="Your Address" required></textarea>
                      </div>
                      <div class="form-group col-md-6 mt-3">
                        <textarea class="form-control" name="cust_message" rows="5" placeholder="Message" required></textarea>
                      </div>
                    </div>
                    <div class="my-3">
                      <!-- <div class="loading">Loading</div> -->
                      <!-- <div class="error-message"></div> -->
                    <div class="sent-message">
                      <?php
                        echo $alert;
                      ?>
                    </div>
                    </div>
                    <div class="text-right">
                      <!-- <button type="submit">Send message</button> -->
                      <input type="submit" name="submit" value="Send message">  
                    </div>
                  </form>
                </div>
            <!-- End Left contact -->

            <!-- Start support image -->
            <div class="col-md-6">
              <!-- Start Map -->
              <img src="assets/img/hero-carousel/support-img.png" alt="" style="margin-top: -10%; margin-left: 10%;">
              <!-- End Map -->
            </div>
            <!-- End support image -->

          </div>
        </div>
      </div>
    </div> <!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php 
    include('footer.php');
  ?>
  <!-- End  Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>