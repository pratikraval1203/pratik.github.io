<?php
  
  session_start();
  date_default_timezone_set("Asia/Kolkata");
  $alert = "";

  include('admin/connection.php');

  if(isset($_POST['submit'])){

  $name = $_POST['name'];
  $email = $_POST['email'];
  $subject = $_POST['subject'];
  $details = $_POST['details'];
  $updated_time = date('Y-m-d H:i:s');
    // $updated_by = $_SESSION['user_id'];

  $insert_sql = "INSERT INTO `tbl_contact_us`(`name`, `email`, `subject`, `details`, `updated_time`, `updated_by`) VALUES ('$name','$email','$subject','$details','$updated_time','1')";

  if(mysqli_query($conn, $insert_sql)){
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

  <title>Home | Mitesh Industries</title>
  <meta content="We are manufacturer, exporter and supplier of Stainless Steel, Mild Steel and Alloys Steel flanges, pipe fittings, fasteners, dairy fittings, oil and gas industries equipments and special mechanical customised jobs." name="descriptison">
  <meta content="Mitesh Industries, Bapunagar, Ahmedabad, Gujarat, Stainless Steel Pipe Holding Clamp, SS316 Stainless Steel Tee, Stainless Steel Lap Joint Flange, Stainless Steel Nipple Set, Polished Stainless Steel Pipe Reducer, Alloy, Metal, Plastic Pipe Fittings, Manufacturer from Ahmedabad , Heavy Duty stainless Steel Bayonet Clamp, Bayonet clamp, headers, vessals, screw conveyor,4D to 12D bend, sealing stand machine" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,400i,600,700|Raleway:300,400,400i,500,500i,700,800,900" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="assets/vendor/nivo-slider/css/nivo-slider.css" rel="stylesheet">
  <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
</head>

<body data-spy="scroll" data-target="#navbar-example">

  <!-- ======= Header ======= -->
  <?php
    include('header.php');
  ?>
  <!-- End Header -->

  <!-- ======= Slider Section ======= -->
  <div id="home" class="slider-area">
    <div class="bend niceties preview-2">
      <div id="ensign-nivoslider" class="slides">
        <img src="assets/img/slider/slider1.jpg" alt="" title="#slider-direction-1" />
        <img src="assets/img/slider/slider2.jpg" alt="" title="#slider-direction-2" />
        <img src="assets/img/slider/slider3.jpg" alt="" title="#slider-direction-3" />
      </div>
      <!-- direction 1 -->
      <div id="slider-direction-1" class="slider-direction slider-one">
        <div class="container">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="slider-content">
                <!-- layer 1 -->
                <div class="layer-1-2 wow animate__fadeIn animate__animated" data-wow-duration="2s" data-wow-delay=".2s">
                  <h1 class="title2">Mitesh Industries</h1>
                </div>
                <!-- layer 2 -->
                <div class="layer-1-1 hidden-xs wow animate__slideInDown animate__animated" data-wow-duration="2s" data-wow-delay=".2s">
                  <h2 class="title1">Total Engineering Solutions...</h2>
                </div>
                <!-- layer 3 -->
                <div class="layer-1-3 hidden-xs wow animate__slideInUp animate__animated" data-wow-duration="2s" data-wow-delay=".2s">
                  <a class="ready-btn right-btn page-scroll" href="#services">View Products</a>
                  <a class="ready-btn page-scroll" href="#contact">Get a Quote</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div><!-- End Slider -->

  <main id="main">

    <!-- ======= Portfolio Section ======= -->
    <div id="portfolio" class="portfolio-area area-padding fix">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="section-headline text-center">
              <h2>Our Product Range</h2>
            </div>
          </div>
        </div>
        <!-- <div class="row wesome-project-1 fix">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="awesome-menu ">
              <ul class="project-menu">
                <li>
                  <a href="#" class="active" data-filter="*">All</a>
                </li>
                <li>
                  <a href="#" data-filter=".development">Clamps</a>
                </li>
                <li>
                  <a href="#" data-filter=".design">Flanges</a>
                </li>
                <li>
                  <a href="#" data-filter=".photo">Nipple</a>
                </li>
              </ul>
            </div>
          </div>
        </div> -->
        <div class="row awesome-project-content">
          <div class="col-md-4 col-sm-4 col-xs-12 design development">
            <div class="single-awesome-project">
              <div class="awesome-img">
                <a href="#"><img src="assets/img/blog/ssclamp/stainless-steel-bayonet-clamp-250x250.jpg" alt="" /></a>
                <div class="add-actions text-center">
                  <div class="project-dec">
                    <a href="products.php#ssclamp">
                      <h4>Stainless Steel Clamp</h4>
                      <span>Click to see details</span>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4 col-sm-4 col-xs-12 photo">
            <div class="single-awesome-project">
              <div class="awesome-img">
                <a href="#"><img src="assets/img/blog/sselbow/ss-elbow-500x500.jpg" alt=""/></a>
                <div class="add-actions text-center">
                  <div class="project-dec">
                    <a href="products.php#sselbow">
                      <h4>Stainless Steel Elbow</h4>
                      <span>Click to see details</span>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4 col-sm-4 col-xs-12 design">
            <div class="single-awesome-project">
              <div class="awesome-img">
                <a href="#"><img src="assets/img/blog/ssnipple/stainless-steel-hex-nipple-250x250.jpg" alt=""/></a>
                <div class="add-actions text-center">
                  <div class="project-dec">
                    <a href="products.php#ssnipple">
                      <h4>Stainless Steel Nipple</h4>
                      <span>Click to see details</span>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4 col-sm-4 col-xs-12 photo development">
            <div class="single-awesome-project">
              <div class="awesome-img">
                <a href="#"><img src="assets/img/blog/ssflange/ss-flange-250x250.jpg" alt=""/></a>
                <div class="add-actions text-center">
                  <div class="project-dec">
                    <a href="products.php#ssflange">
                      <h4>Stainless Steel Flange</h4>
                      <span>Click to see details</span>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4 col-sm-4 col-xs-12 development">
            <div class="single-awesome-project">
              <div class="awesome-img">
                <a href="#"><img src="assets/img/blog/sstee/stainless-steel-special-solid-tee-250x250.jpg" alt="" /></a>
                <div class="add-actions text-center text-center">
                  <div class="project-dec">
                    <a href="products.php#sstee">
                      <h4>Stainless Steel Tee</h4>
                      <span>Click to see details</span>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4 col-sm-4 col-xs-12 design photo">
            <div class="single-awesome-project">
              <div class="awesome-img">
                <a href="#"><img src="assets/img/blog/ssreducer/ss-reducer-500x500.jpg" alt="" /></a>
                <div class="add-actions text-center">
                  <div class="project-dec">
                    <a href="products.php#ssreducer">
                      <h4>Stainless Steel Reducer</h4>
                      <span>Click to see details</span>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div><!-- End Portfolio Section -->

    <!-- ======= Rviews Section ======= -->
    <!-- <div class="reviews-area" id="special-product">
      <div class="row no-gutters">
        <div class="col-lg-5 py-0">
          <img src="assets/img/about/6.png" alt="" class="img-fluid">
        </div>
        <div class="col-lg-7 work-right-text d-flex align-items-center">
          <div class="px-5 py-5 py-lg-0">
            <h2>BAYONET CLAMP</h2>
            <h5 style="font-family: Arial">SS316L Polished Heavy Duty Stainless Steel BAYONET CLAMP.</h5>
            <a href="sp.php#about" class="ready-btn scrollto">See Details</a>
          </div>
        </div>
      </div>
    </div> --><!-- End Rviews Section -->

    <!-- ======= Portfolio Section ======= -->
    <div id="portfolio" class="portfolio-area area-padding fix">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="section-headline text-center">
              <h2>Special Products</h2>
            </div>
          </div>
        </div>
        <!-- <div class="row wesome-project-1 fix">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="awesome-menu ">
              <ul class="project-menu">
                <li>
                  <a href="#" class="active" data-filter="*">All</a>
                </li>
                <li>
                  <a href="#" data-filter=".development">Clamps</a>
                </li>
                <li>
                  <a href="#" data-filter=".design">Flanges</a>
                </li>
                <li>
                  <a href="#" data-filter=".photo">Nipple</a>
                </li>
              </ul>
            </div>
          </div>
        </div> -->
        <div class="row awesome-project-content">
          <div class="col-md-6 col-sm-6 col-xs-12 design development">
            <div class="single-awesome-project">
              <div class="awesome-img">
                <a href="#"><img src="assets/img/about/s1i2.png" alt="" /></a>
                <div class="add-actions text-center">
                  <div class="project-dec">
                    <a href="sp.php#hdssbc">
                      <h4>Stainless Steel BAYONET CLAMP</h4>
                      <span>Click to see details</span>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-sm-6 col-xs-12 photo">
            <div class="single-awesome-project">
              <div class="awesome-img">
                <a href="#"><img src="assets/img/about/s2i1.png" alt=""/></a>
                <div class="add-actions text-center">
                  <div class="project-dec">
                    <a href="sp.php#4t1b">
                      <h4>4D to 12D Bend</h4>
                      <span>Click to see details</span>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-sm-6 col-xs-12 design">
            <div class="single-awesome-project">
              <div class="awesome-img">
                <a href="#"><img src="assets/img/about/s3i1.png" alt=""/></a>
                <div class="add-actions text-center">
                  <div class="project-dec">
                    <a href="sp.php#sc">
                      <h4>Screw Conveyor</h4>
                      <span>Click to see details</span>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-sm-6 col-xs-12 photo development">
            <div class="single-awesome-project">
              <div class="awesome-img">
                <a href="#"><img src="assets/img/about/s4i1.png" alt=""/></a>
                <div class="add-actions text-center">
                  <div class="project-dec">
                    <a href="sp.php#headers">
                      <h4>Headers</h4>
                      <span>Click to see details</span>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-sm-6 col-xs-12 development">
            <div class="single-awesome-project">
              <div class="awesome-img">
                <a href="#"><img src="assets/img/about/s5i1.png" alt="" /></a>
                <div class="add-actions text-center text-center">
                  <div class="project-dec">
                    <a href="sp.php#vessals">
                      <h4>Vessals</h4>
                      <span>Click to see details</span>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-sm-6 col-xs-12 design photo">
            <div class="single-awesome-project">
              <div class="awesome-img">
                <a href="#"><img src="assets/img/about/s6i1.png" alt="" /></a>
                <div class="add-actions text-center">
                  <div class="project-dec">
                    <a href="sp.php#sms">
                      <h4>Sealing Machine Stand</h4>
                      <span>Click to see details</span>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div><!-- End Portfolio Section -->

    <!-- ======= Team Section ======= -->
    <div id="team" class="our-team-area area-padding">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="section-headline text-center">
              <h2>Catalogues</h2>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3 col-sm-3 col-xs-12">
            <div class="single-team-member">
              <div class="team-img">
                <a href="assets/pdf/flange_fittings.pdf">
                  <img src="assets/pdf/1.png" alt="">
                </a>
                <div class="team-social-icon text-center">
                  <h4>Flange Fittings</h4>
                  <p>Click to see details</p>
                </div>
              </div>
            </div>
          </div>
          <!-- End column -->
          <div class="col-md-3 col-sm-3 col-xs-12">
            <div class="single-team-member">
              <div class="team-img">
                <a href="assets/pdf/pipe_and_tubes.pdf">
                  <img src="assets/pdf/2.png" alt="">
                </a>
                <div class="team-social-icon text-center">
                  <h4>Pipe & Tubes</h4>
                  <p>Click to see details</p>
                </div>
              </div>
            </div>
          </div>
          <!-- End column -->
          <div class="col-md-3 col-sm-3 col-xs-12">
            <div class="single-team-member">
              <div class="team-img">
                <a href="assets/pdf/pipe_and_tubes_fittings.pdf">
                  <img src="assets/pdf/3.png" alt="">
                </a>
                <div class="team-social-icon text-center">
                  <h4>Pipe & Tubes Fittings</h4>
                  <p>Click to see details</p>
                </div>
              </div>
            </div>
          </div>
          <!-- End column -->
          <div class="col-md-3 col-sm-3 col-xs-12">
            <div class="single-team-member">
              <div class="team-img">
                <a href="assets/pdf/chemical_compositions_and_physical_properties.pdf">
                  <img src="assets/pdf/4.png" alt="">
                </a>
                <div class="team-social-icon text-center">
                  <h4>Chemical Compositions & Physical Properties</h4>
                  <p>Click to see details</p>
                </div>
              </div>
            </div>
          </div>
          <!-- End column -->
        </div>
        <div class="row mt-5">
          <div class="col-md-3 col-sm-3 col-xs-12">
            <div class="single-team-member">
              <div class="team-img">
                <a href="assets/pdf/tube_fittings.pdf">
                  <img src="assets/pdf/5.png" alt="">
                </a>
                <div class="team-social-icon text-center">
                  <h4>Tube Fittings</h4>
                  <p>Click to see details</p>
                </div>
              </div>
            </div>
          </div>
          <!-- End column -->
        </div>
      </div>
    </div><!-- End Team Section -->

    <!-- ======= Contact Section ======= -->
    <div id="contact" class="contact-area">
      <div class="contact-inner area-padding">
        <div class="contact-overly"></div>
        <div class="container ">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="section-headline text-center">
                <h2>Contact us</h2>
              </div>
            </div>
          </div>
          <div class="row">

            <!-- Start Google Map -->
            <div class="col-md-6 col-sm-6 col-xs-12">
              <!-- Start Map -->
              <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d29377.045062262234!2d72.5929322395995!3d23.018975300000005!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x45455219b3ed768e!2sKrishna%20Estate!5e0!3m2!1sen!2sin!4v1606903671673!5m2!1sen!2sin" width="100%" height="380" frameborder="0" style="border: 1px solid lightgrey;" allowfullscreen></iframe> -->
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d117513.68047272635!2d72.608778613191!3d23.012662245980952!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e8767dea75071%3A0x495d2889628500d1!2sMitesh%20Industries!5e0!3m2!1sen!2sin!4v1619332711023!5m2!1sen!2sin" width="100%" height="380" frameborder="0" style="border: 1px solid lightgrey;" allowfullscreen></iframe>
              <!-- End Map -->
            </div>
            <!-- End Google Map -->

            <!-- Start  contact -->
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="form contact-form">
                <form action="<?php echo $_SERVER['PHP_SELF'].'#contact'?>" method="post" role="form" class="my-form">
                  <div class="form-group">
                    <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                    <div class="validate"></div>
                  </div>
                  <div class="form-group">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                    <div class="validate"></div>
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control" name="subject" id="subject" placeholder="Requirement subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                    <div class="validate"></div>
                  </div>
                  <div class="form-group">
                    <textarea class="form-control" name="details" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Requirement Details"></textarea>
                    <div class="validate"></div>
                  </div>
                  <div class="mb-3">
                    <!-- <div class="loading">Loading</div> -->
                    <div class="sent-message">
                      <?php
                        echo $alert;
                      ?>
                    </div>
                  </div>
                  <div class="text-center">
                    <input class="btn btn-primary" type="submit" name="submit" value="Submit Requirements">
                  </div>
                </form>
              </div>
            </div>
            <!-- End Left contact -->
          </div>
          <div class="row contact-upper-spacer">
            <!-- Start contact icon column -->
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="contact-icon text-center">
                <div class="single-icon">
                  <i class="fa fa-mobile"></i>
                  <p>
                    Phone: +91 85306 62779<br>
                    <span>GST: 24BRZPP6472L1ZQ</span>
                  </p>
                </div>
              </div>
            </div>
            <!-- Start contact icon column -->
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="contact-icon text-center">
                <div class="single-icon">
                  <i class="fa fa-envelope-o"></i>
                  <p>
                    Email: info@mitesh-industries.com<br>
                    <span>Web: www.mitesh-industries.com</span>
                  </p>
                </div>
              </div>
            </div>
            <!-- Start contact icon column -->
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="contact-icon text-center">
                <div class="single-icon">
                  <i class="fa fa-map-marker"></i>
                  <p>
                    Address: Shop No-3, Krishna Estate,<br>
                    Near Arvind Estate, B/H Anil Starch Mill,<br>
                    Bapunagar, Ahmedabad -380024
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php 
    include('footer.php');
  ?>
  <!-- End  Footer -->

  <!-- <div class="bottom" id="alert">
    This website use cookies, click here for accpet cookies 
    <button onclick="accpetCookie()" class="ready-btn">
      Accept
    </button>

    <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
    <div id="preloader"></div>
  </div> -->
  <!-- <div class="scroll">
    website content
  </div> -->

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/appear/jquery.appear.js"></script>
  <script src="assets/vendor/knob/jquery.knob.js"></script>
  <script src="assets/vendor/parallax/parallax.js"></script>
  <script src="assets/vendor/wow/wow.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/nivo-slider/js/jquery.nivo.slider.js"></script>
  <script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="assets/vendor/venobox/venobox.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

  <!--<script>
      // if user has already checked the confirmation button
      // the alert panel should be hidden.   
      if (getCookie('accepted') === 'yes') {
          document.getElementById("alert").style.display = "none";
      }

      // user clicks the confirmation -> set the 'yes' value to cookie and set 'accepted' as name
      function accpetCookie() {
          setCookie('accepted', 'yes', 100);
      }

      // code from :http://stackoverflow.com/a/4825695/191220
      // set cookie method
      function setCookie(c_name, value, exdays) {
          var exdate = new Date();
          exdate.setDate(exdate.getDate() + exdays);
          var c_value = escape(value) + ((exdays == null) ? "" : "; expires=" + exdate.toUTCString());
          document.cookie = c_name + "=" + c_value;
      }

      // get cookie method   
      function getCookie(c_name) {
          var i, x, y, ARRcookies = document.cookie.split(";");
          for (i = 0; i < ARRcookies.length; i++) {
              x = ARRcookies[i].substr(0, ARRcookies[i].indexOf("="));
              y = ARRcookies[i].substr(ARRcookies[i].indexOf("=") + 1);
              x = x.replace(/^\s+|\s+$/g, "");
              if (x == c_name) {
                  return unescape(y);
              }
          }
      }
  </script> -->

</body>

</html>
<?php
  include('admin/disconnect.php');
?>