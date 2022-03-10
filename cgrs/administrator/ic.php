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

  <title>IC Department</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
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

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Page Content -->
        <h1>IC Department</h1>
        <hr>
        <h3>All Complaints</h3>
        <hr>
        <?php
      
          //$select= "SELECT * FROM db_form";
          $select= "SELECT * FROM db_form WHERE is_accepted=0 AND is_rejected=0 AND is_solved =0 AND `d_ment` = 'IC' ";

          $result= mysqli_query($conn,$select);
        ?>
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Sr</th>
                <th>Student Name</th>
                <th>En_no</th>
                <th>Description</th>
                <th>Accept</th>
                <th>Reject</th>
                <th>Solve</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Sr</th>
                <th>Student Name</th>
                <th>En_no</th>
                <th>Description</th>
                <th>Accept</th>
                <th>Reject</th>
                <th>Solve</th>
              </tr>
            </tfoot>
            <tbody>
              <?php
                echo mysqli_error($conn);
                while ($allcomplaints = mysqli_fetch_assoc($result)) {  
                  echo "<tr>";
                   echo "<td>".$allcomplaints['sr']."</td>";
                   echo "<td>".$allcomplaints['s_name']."</td>";
                   echo "<td>".$allcomplaints['en_no']."</td>";
                   echo "<td>".$allcomplaints['description']."</td>"; 
                   //------------Accepted button code----------
                   echo '<td><a href="is-accepted.php?acc_id='.$allcomplaints['sr'].'&pg_id=IC" class="btn btn-primary btn-sm">Accepted</a></td>';
                   //------------Rejected button code----------
                   echo '<td><a href="is-rejected.php?rej_id='.$allcomplaints['sr'].'&pg_id=IC" class="btn btn-danger btn-sm">Rejected</a></td>';
                   //------------Deleted button code-----------
                    echo '<td><a href="is-solved.php?sol_id='.$allcomplaints['sr'].'&pg_id=IC" class="btn btn-success btn-sm">Solved</a></td>';   
                  echo "</tr>";
                }
              ?>
            </tbody>
          </table>
        </div>
    <!--all complaint finish->

    <!-accepted table-->
    <hr>
    <h3>Accepted complaints</h3>
    <hr>
    <?php
      
      $temp="SELECT * FROM db_form WHERE is_accepted=1 AND `d_ment` = 'IC'";

      $result = mysqli_query($conn,$temp);
    ?>
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Sr</th>
                <th>Student Name</th>
                <th>En_no</th>
                <th>Description</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Sr</th>
                <th>Student Name</th>
                <th>En_no</th>
                <th>Description</th>
              </tr>
            </tfoot>
            <tbody>
            <?php
            while ($allcomplaints = mysqli_fetch_assoc($result)) {
              echo "<tr>";
               echo "<td>".$allcomplaints['sr']."</td>";
               echo "<td>".$allcomplaints['s_name']."</td>";
               echo "<td>".$allcomplaints['en_no']."</td>";
               echo "<td>".$allcomplaints['description']."</td>";
              echo "</tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    <!--accepted table finish->

     <!-rejected table-->
    <hr>
    <h3>Rejected complaints</h3>
    <hr>
    <?php

      $temp="SELECT * FROM db_form WHERE is_rejected=1 AND `d_ment` = 'IC'";

      $result = mysqli_query($conn,$temp);
    ?>
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Sr</th>
              <th>student_Name</th>
              <th>En_no</th>
              <th>Description</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Sr</th>
              <th>Student_Name</th>
              <th>En_no</th>
              <th>Description</th>
            </tr>
          </tfoot>
          <tbody>
            <?php
            while ($allcomplaints = mysqli_fetch_assoc($result)) {
              echo "<tr>";
               echo "<td>".$allcomplaints['sr']."</td>";
               echo "<td>".$allcomplaints['s_name']."</td>";
               echo "<td>".$allcomplaints['en_no']."</td>";
               echo "<td>".$allcomplaints['description']."</td>"; 
              echo "</tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    <!---rejected table finish->

    <!-Solved table-->
    <hr>
    <h3>Solved complaints</h3>
    <hr>
    <?php
      $temp="SELECT * FROM db_form WHERE is_solved=1 AND d_ment = 'IC'";
      $result = mysqli_query($conn,$temp);
    ?>
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Sr</th>
              <th>Student Name</th>
              <th>En_no</th>
              <th>Description</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Sr</th>
              <th>Student Name</th>
              <th>En_no</th>
              <th>Description</th>
            </tr>
          </tfoot>
          <tbody>
            <?php
            while ($allcomplaints = mysqli_fetch_assoc($result)) { 
              echo "<tr>";
               echo "<td>".$allcomplaints['sr']."</td>";
               echo "<td>".$allcomplaints['s_name']."</td>";
               echo "<td>".$allcomplaints['en_no']."</td>";
               echo "<td>".$allcomplaints['description']."</td>";    
              echo "</tr>";
            }
            ?>
          </tbody>
         </table>
      </div>

      <!--solved table finish-->
</div>
      <!-- /.container-fluid -->
    <?php
      include ('footer.php');
    ?>
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
  <script src="vendor/datatables/jquery.dataTables.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="js/demo/datatables-demo.js"></script>

</body>

</html>
